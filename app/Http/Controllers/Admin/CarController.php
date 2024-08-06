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

class CarController extends Controller
{
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
        return view('admin.cars.index',get_defined_vars());
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
        return view('admin.cars.carsByStatus',get_defined_vars());
    }

    public function create()
    {
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        return view('admin.cars.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        Car::create($request->validated());
        Report::addToLog('  اضافه سيارة') ;
        return response()->json(['url' => route('admin.cars.index')]);
    }
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $users = User::orderBy('name','ASC')->get();
        $carbrands = CarBrands::orderBy('name','ASC')->get();
        $carmodels = CarModels::orderBy('name','ASC')->get();
        $carcolors = CarColors::orderBy('name','ASC')->get();
        $caryears = CarYears::orderBy('year','ASC')->get();
        return view('admin.cars.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $car = Car::findOrFail($id)->update($request->validated());
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
