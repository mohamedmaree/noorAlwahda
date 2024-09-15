<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cars\Store;
use App\Http\Requests\Admin\cars\Update;
use App\Models\Car ;
use App\Traits\Report;
use App\Models\User ;
use App\Models\CarBrands;
use App\Models\CarColors;
use App\Models\CarModels;
use App\Models\CarYears;
use App\Models\CarStatus;
use App\Models\DamageTypes;
use App\Models\BodyTypes;
use App\Models\EngineTypes;
use App\Models\EngineCylinders;
use App\Models\transmissionTypes;
use App\Models\DriveTypes;
use App\Models\FuelTypes;
use App\Models\Auction;
use App\Models\Country;
use App\Models\Region;
use App\Models\Warehouse;
use App\Models\Branch;
use App\Models\PriceTypes ;
use App\Models\CarFinance ;
use App\Models\CarFinanceOperations ;
use App\Models\CarGallery ;
use App\Models\CarGalleryImages ;
use App\Models\CarAttachment ;
use App\Models\SiteSetting;
use App\Traits\ResponseTrait;

class CarController extends Controller
{
    use ResponseTrait;

    public function index($id = null)
    {
        if (request()->ajax()) {
            $cars = Car::search(request()->searchArray)->paginate(30);
            $html = view('admin.cars.table' ,compact('cars'))->render() ;
            return response()->json(['html' => $html]);
        }
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        $statuses = CarStatus::latest()->get();
        $cardamagetypes = DamageTypes::latest()->get();
        $bodytypes = BodyTypes::latest()->get();

        $enginetypes = EngineTypes::latest()->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        $regions = Region::whereIn('country_id',$supported_countries??[])->orderBy('name','ASC')->get();
       
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $branches = Branch::orderBy('name','ASC')->get();
        $auctions = Auction::latest()->get();
        
        $statuses = CarStatus::orderBy('sort','ASC')->get();
        $statusArr = [];
        $carsStatusArr = [];
        foreach($statuses as $status){
            $statusArr[] =  $status->name;
            $carsStatusArr[] = Car::where('car_status_id',$status->id)->count();
        }

        return view('admin.cars.index',get_defined_vars());
    }

    public function changeStatus(Request $request){
        $car = Car::findOrFail($request->car_id);
        $status = CarStatus::findOrFail($request->status_id);
        if($status->fields){
            foreach($status->fields as $field){
                if (is_null($car->$field)) {
                    $fields_text = implode(',',$status->fields);
                    return $this->response('fail', __('admin.field_required',['fields'=>$fields_text]));
                }
            }
        }
       if($previousStatus = $car->statusHistory()->where('car_status_id', $car->car_status_id)->first()){
            $previousStatus->update(['end_date' => date('Y-m-d')]);
       }
       $car->update(['car_status_id' => $status->id]);
       $car->statusHistory()->create(['car_status_id' => $status->id,'start_date' => date('Y-m-d')]);
       return response()->json('success');
    }

    public function carsByStatus()
    {
        $status_id = request()->segment(4);
        if (request()->ajax()) {
            $cars = Car::where('car_status_id',$status_id)->search(request()->searchArray)->paginate(30);
            $html = view('admin.cars.table' ,compact('cars'))->render() ;
            return response()->json(['html' => $html]);
        }
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        $statuses = CarStatus::latest()->get();
        $cardamagetypes = DamageTypes::latest()->get();
        $bodytypes = BodyTypes::latest()->get();
        $enginetypes = EngineTypes::latest()->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        $regions = Region::whereIn('country_id',$supported_countries??[])->orderBy('name','ASC')->get();
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        return view('admin.cars.carsByStatus',get_defined_vars());
    }

    public function create()
    {
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        $statuses = CarStatus::latest()->get();
        $cardamagetypes = DamageTypes::latest()->get();
        $bodytypes = BodyTypes::latest()->get();
        $enginetypes = EngineTypes::latest()->get();
        $enginecylinder = EngineCylinders::latest()->get();
        $transmissiontypes = transmissionTypes::latest()->get();
        $drivetypes = DriveTypes::latest()->get();
        $fueltypes = FuelTypes::latest()->get();
        $auctions = Auction::latest()->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        $regions = Region::whereIn('country_id',$supported_countries??[])->orderBy('name','ASC')->get();
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $branches = Branch::orderBy('name','ASC')->get();
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        


        return view('admin.cars.create',get_defined_vars());
    }

    public function store(Store $request)
    {
        $car = Car::create($request->validated());
        if($status = CarStatus::find($request->car_status_id)){
            $car->statusHistory()->create(['car_status_id' => $status->id,'start_date' => date('Y-m-d')]);
        }else{
            $car_status_id = $car->nextCarStatus()->id??0;
            $car->statusHistory()->create(['car_status_id' => $car_status_id,'start_date' => date('Y-m-d')]);
            $car->update(['car_status_id' => $car_status_id]);
        }

        if($request->required_amount){
            $carFinanceArr = [];
            $i = 0;
            foreach($request->price_type_id as $priceType){
                if(isset($request->required_amount[$i]) ){
                    CarFinance::create(['car_id' => $car->id,'price_type_id' => $priceType,'required_amount' => $request->required_amount[$i]??'' ]);
                    $i++;
                }
            }
        }
        // if($request->operations_price_type_id){
        //     $carFinanceOperationsArr = [];
        //     $i = 0;
        //     foreach($request->operations_price_type_id as $price_type_id){
        //         CarFinanceOperations::create(['car_id' => $car->id,'price_type_id' => $price_type_id,'amount' => $request->amount[$i]??'','image' => $request->operations_image[$i]??'' ]);
        //         $i++;
        //     }
        // }
        if($request->gallery_images){
            foreach($request->car_status_ids as $status_id){
                if(isset($request->gallery_images[$status_id])){
                    $gallery = CarGallery::create(['car_id' => $car->id,'car_status_id' => $status_id]);
                    $this->storeFiles($gallery,$request->gallery_images[$status_id]);
                }
            }
        }

        if($request->images){
            foreach($request->images as $image){
                CarAttachment::create(['car_id' => $car->id,'image' => $image]);
            }
        }

        Report::addToLog('  اضافه سيارة') ;
        return response()->json(['url' => route('admin.cars.index')]);
    }

    private function storeFiles($gallery, $files)
    {    
        foreach ($files as $file) {
            $gallery->images()->create(['image' => $file]);
        }
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        $statuses = CarStatus::latest()->get();
        $cardamagetypes = DamageTypes::latest()->get();
        $bodytypes = BodyTypes::latest()->get();
        $enginetypes = EngineTypes::latest()->get();
        $enginecylinder = EngineCylinders::latest()->get();
        $transmissiontypes = transmissionTypes::latest()->get();
        $drivetypes = DriveTypes::latest()->get();
        $fueltypes = FuelTypes::latest()->get();
        $auctions = Auction::latest()->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        $regions = Region::whereIn('country_id',$supported_countries??[])->orderBy('name','ASC')->get();
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $branches = Branch::orderBy('name','ASC')->get();
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        
        return view('admin.cars.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $car = Car::findOrFail($id);
        $car->update($request->validated());

        if($request->required_amount){
            $car->carFinance()->delete();
            $carFinanceArr = [];
            $i = 0;
            foreach($request->price_type_id as $priceType){
                if(isset($request->required_amount[$i]) ){
                    CarFinance::create(['car_id' => $car->id,'price_type_id' => $priceType,'required_amount' => $request->required_amount[$i]??'' ]);
                    $i++;
                }
            }
        }
        // if($request->operations_image){
        //     $carFinanceOperationsArr = [];
        //     $i = 0;
        //     foreach($request->operations_price_type_id as $price_type_id){
        //         if(isset($request->operations_image[$i])){
        //             $car->carFinanceOperations()->where(['car_id' => $car->id,'price_type_id' => $price_type_id])->delete();
        //             CarFinanceOperations::create(['car_id' => $car->id,'price_type_id' => $price_type_id,'amount' => $request->amount[$i]??'','image' => $request->operations_image[$i]??'' ]);
        //         }
        //         $i++;
        //     }
        // }
        if($request->gallery_images){
            $carGalleryArr = [];
            $i = 0;
            foreach($request->car_status_ids as $status_id){
                if(isset($request->gallery_images[$status_id])){
                    $gallery = CarGallery::firstOrCreate(['car_id' => $car->id,'car_status_id' => $status_id]);
                    $this->storeFiles($gallery,$request->gallery_images[$status_id]);
                }
                $i++;
            }
        }

        if($request->images){
            foreach($request->images as $image){
                CarAttachment::create(['car_id' => $car->id,'image' => $image]);
            }
        }

        Report::addToLog('  تعديل سيارة') ;
        return response()->json(['url' => route('admin.cars.index')]);
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        $statuses = CarStatus::latest()->get();
        $cardamagetypes = DamageTypes::latest()->get();
        $bodytypes = BodyTypes::latest()->get();
        $enginetypes = EngineTypes::latest()->get();
        $enginecylinder = EngineCylinders::latest()->get();
        $transmissiontypes = transmissionTypes::latest()->get();
        $drivetypes = DriveTypes::latest()->get();
        $fueltypes = FuelTypes::latest()->get();
        $auctions = Auction::latest()->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries??[])->orderBy('id','ASC')->get();
        $regions = Region::whereIn('country_id',$supported_countries??[])->orderBy('name','ASC')->get();
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $branches = Branch::orderBy('name','ASC')->get();
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        return view('admin.cars.show' , get_defined_vars());
    }
    public function destroy($id)
    {
        $car = Car::findOrFail($id)->delete();
        Report::addToLog('  حذف سيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Car::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
