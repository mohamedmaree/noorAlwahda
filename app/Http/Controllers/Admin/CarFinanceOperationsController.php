<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carfinanceoperations\Store;
use App\Http\Requests\Admin\carfinanceoperations\Update;
use App\Models\CarFinanceOperations ;
use App\Traits\Report;
use App\Models\Car ;
use App\Models\PriceTypes ;

class CarFinanceOperationsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carfinanceoperations = CarFinanceOperations::search(request()->searchArray)->paginate(30);
            $html = view('admin.carfinanceoperations.table' ,compact('carfinanceoperations'))->render() ;
            return response()->json(['html' => $html]);
        }
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinanceoperations.index',get_defined_vars());
    }

    public function create()
    {
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinanceoperations.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        CarFinanceOperations::create($request->validated());
        Report::addToLog('  اضافه سند دفع') ;
        return response()->json(['url' => route('admin.carfinanceoperations.index')]);
    }
    public function edit($id)
    {
        $carfinanceoperations = CarFinanceOperations::findOrFail($id);
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinanceoperations.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $carfinanceoperations = CarFinanceOperations::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل سند دفع') ;
        return response()->json(['url' => route('admin.carfinanceoperations.index')]);
    }

    public function show($id)
    {
        $carfinanceoperations = CarFinanceOperations::findOrFail($id);
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        $cars = Car::latest()->get();
        return view('admin.carfinanceoperations.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $carfinanceoperations = CarFinanceOperations::findOrFail($id)->delete();
        Report::addToLog('  حذف سند دفع') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarFinanceOperations::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من سندات الدفع') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
