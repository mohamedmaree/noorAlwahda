<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Models\Car;
use App\Http\Resources\Api\Cars\CarsCollection;
use App\Http\Resources\Api\Cars\CarResource;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ShippngPriceList;
use App\Http\Resources\Api\Cars\ShippingListsCollection;
use App\Http\Resources\Api\Cars\ShippngPriceListResource;
use App\Http\Requests\Api\Car\assignCarToSubaccountRequest;
use App\Http\Resources\Api\Cars\CarStatusHistoryResource;
use App\Http\Resources\Api\Cars\CarGalleryResource;
use App\Models\PriceCategories;
use App\Models\CarFinance;
use App\Models\Country;

use App\Http\Resources\Api\Cars\CarFinanceResource;

class CarController extends Controller {
  use ResponseTrait;

  public function availableCars(){
    $cars = new CarsCollection(Car::where('available',1)->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function carsByCategory(Request $request){
    $category = Category::findOrFail($request->category_id);
    $ids = auth()->user()->childes()->pluck('id')->toArray();
    $ids[] = auth()->id();
    $cars = new CarsCollection(Car::whereIn('user_id',$ids)->whereIn('car_status_id',$category->car_statuses_ids??[])->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }
  
  public function carDetails(Car $car){
    return $this->successData( new CarResource($car));
  }

  public function carStatusHistory(Car $car){
    return $this->successData(CarStatusHistoryResource::collection($car->statusHistory));
  }

  public function carGallery(Car $car){
    return $this->successData(CarGalleryResource::collection($car->carGalleries));
  }

  public function carFinance(Car $car){
    $priceCats = PriceCategories::orderBy('name','ASC')->get();
    $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
    $data = [];
    $total = 0;
    $total_p = 0;
    foreach($priceCats as $priceCat){
      $total_required = $car->carFinance()->whereIn('price_type_id',$priceCat->price_types_ids)->sum('required_amount') * $exchange_rate;
      $total_paid = $car->carFinance()->whereIn('price_type_id',$priceCat->price_types_ids)->sum('paid_amount') * $exchange_rate;
      $total += $total_required;
      $total_p += $total_paid;
      $data[] = ['id'      => $priceCat->id,
                 'name'    => $priceCat->name,
                 'finance' => CarFinanceResource::collection($car->carFinance->whereIn('price_type_id',$priceCat->price_types_ids)),
                 'subtotal_required' => number_format($total_required),
                 'subtotal_paid'     => number_format($total_paid),
                 'subtotal_outstanding'     => number_format($total_required - $total_paid),
                ];
    }

    return $this->successData(['finances' => $data,'total_required' => number_format($total),'total_paid' => number_format($total_p) ,'total_outstanding' => number_format($total - $total_p)]);
  }
  

  public function carsByUser(Request $request){
    $user = User::findOrFail($request->user_id);
    $cars = new CarsCollection(Car::where('user_id',$user->id)->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function searchCars(Request $request){
    $ids = auth()->user()->childes()->pluck('id')->toArray();
    $ids[] = auth()->id();
    $cars = new CarsCollection(Car::whereIn('user_id',$ids)->where(function($q)use($request){
      $q->where('vin','like','%'.$request->search.'%')
        ->orwhere('lot','like','%'.$request->search.'%');
    })->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function myCars(){
    $ids = auth()->user()->childes()->pluck('id')->toArray();
    $ids[] = auth()->id();
    $cars = new CarsCollection(Car::whereIn('user_id',$ids)->latest()->paginate($this->paginateNum()));
    
    $cars_ids = Car::whereIn('user_id',$ids)->pluck('id')->toArray();
    $carsFinance = CarFinance::whereIn('car_id' ,$cars_ids);

    $total_required = $carsFinance->sum('required_amount');
    $total_paid = $carsFinance->sum('paid_amount');

    $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
    $total_required= number_format(($total_required - $total_paid) * $exchange_rate);

    return $this->successData(['cars' => $cars ,'total_required' =>$total_required ]);
  }

  public function customerOutstanding(){
    $ids = auth()->user()->childes()->pluck('id')->toArray();
    $ids[] = auth()->id();
    $cars_ids = Car::whereIn('user_id',$ids)->pluck('id')->toArray();
    $carsFinance = CarFinance::whereIn('car_id' ,$cars_ids);

    $total_required = $carsFinance->sum('required_amount');
    $total_paid = $carsFinance->sum('paid_amount');

    $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
    $data['total_required']= number_format(($total_required - $total_paid) * $exchange_rate);
    return $this->successData($data);
  }

  public function shippingLists(){
    $lists = new ShippingListsCollection(ShippngPriceList::where(function($q){
                                                                if(auth()->user()->vip == 1 ){
                                                                  $q->where('vip',1);
                                                                }
                                                                if(auth()->user()->middle == 1){
                                                                  $q->orwhere('middle',1);
                                                                }
                                                                if(auth()->user()->usual == 1){
                                                                  $q->orwhere('usual',1);
                                                                }
                                                              })
                                                              ->where(function($q){
                                                                if(auth()->user()->parent_id === null ){
                                                                  $q->where('main_account',1);
                                                                }
                                                                if(auth()->user()->parent_id !== null){
                                                                  $q->orwhere('sub_account',1);
                                                                }
                                                              })
                                                              ->latest()
                                                              ->paginate($this->paginateNum()));
    return $this->successData( $lists);
  }

  public function shippingListDetails(ShippngPriceList $shippingList){
    return $this->successData( new ShippngPriceListResource($shippingList));
  }

  public function assignCarToSubaccount(assignCarToSubaccountRequest $request){
    $ids = auth()->user()->childes()->pluck('id')->toArray();
    $ids[] = auth()->id();
    $car = Car::where('id',$request->car_id)->whereIn('user_id',$ids)->firstOrFail();
    $car->update(['user_id' => $request->user_id]);
    return $this->response('success', __('apis.updated'));
  }

  
}
