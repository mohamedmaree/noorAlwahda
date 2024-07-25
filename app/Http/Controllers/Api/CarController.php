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

class CarController extends Controller {
  use ResponseTrait;

  public function availableCars(){
    $cars = new CarsCollection(Car::whereNull('user_id')->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function carsByCategory(Request $request){
    $category = Category::findOrFail($request->category_id);
    $cars = new CarsCollection(Car::whereIn('car_status_id',$category->car_statuses_ids??[])->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }
  
  public function carDetails(Car $car){
    return $this->successData( new CarResource($car));
  }

  public function carsByUser(Request $request){
    $user = User::findOrFail($request->user_id);
    $cars = new CarsCollection(Car::where('user_id',$user->id)->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function searchCars(Request $request){
    $cars = new CarsCollection(Car::where('vin','like','%'.$request->search.'%')->orwhere('lot','like','%'.$request->search.'%')->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function myCars(){
    $cars = new CarsCollection(Car::where('user_id',auth()->id())->latest()->paginate($this->paginateNum()));
    return $this->successData( $cars);
  }

  public function shippingLists(){
    $lists = new ShippingListsCollection(ShippngPriceList::latest()->paginate($this->paginateNum()));
    return $this->successData( $lists);
  }

  public function shippingListDetails(ShippngPriceList $shippingList){
    return $this->successData( new ShippngPriceListResource($shippingList));
  }

  
}
