<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carfinances\Store;
use App\Http\Requests\Admin\carfinances\Update;
use App\Models\CarFinance ;
use App\Traits\Report;
use App\Models\Car ;
use App\Models\PriceTypes ;
use App\Models\User ;


class CarFinanceController extends Controller
{
    public function print($id){
        $car = Car::findOrFail($id);
        return view('admin.carfinances.print' ,get_defined_vars());
    }

    public function printByClient($id){
        $user = User::findOrFail($id);
        return view('admin.carfinances.print-by-client' ,get_defined_vars());
    }

    public function index($id = null)
    {
        if (request()->ajax()) {
            $carfinances = CarFinance::search(request()->searchArray)->paginate(30);
            $html = view('admin.carfinances.table' ,compact('carfinances'))->render() ;
            return response()->json(['html' => $html]);
        }
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        $users = User::orderBy('name','ASC')->get();
        return view('admin.carfinances.index',get_defined_vars());
    }

    public function create()
    {
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinances.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        CarFinance::create($request->validated());
        Report::addToLog('  اضافه مالية') ;
        return response()->json(['url' => route('admin.carfinances.index')]);
    }
    public function edit($id)
    {
        $carfinance = CarFinance::findOrFail($id);
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinances.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $carfinance = CarFinance::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مالية') ;
        return response()->json(['url' => route('admin.carfinances.index')]);
    }

    public function show($id)
    {
        $carfinance = CarFinance::findOrFail($id);
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinances.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $carfinance = CarFinance::findOrFail($id)->delete();
        Report::addToLog('  حذف مالية') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarFinance::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من ماليات السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
