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
use App\Models\CarFinance ;

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
        $operation = CarFinanceOperations::create($request->validated());
        $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->whereJsonContains('price_type_id', (string)$operation->price_type_id[0]??0)->sum('amount');
        CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id[0]??0])->update(['paid_amount' => $paid_amount]);

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
        $operation = CarFinanceOperations::findOrFail($id);
        $operation->update($request->validated());

        $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->whereJsonContains('price_type_id', (string)$operation->price_type_id[0]??0)->sum('amount');
        CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id[0]??0])->update(['paid_amount' => $paid_amount]);

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
        $operation = CarFinanceOperations::findOrFail($id);
        $operation->delete();
       

        $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->whereJsonContains('price_type_id', (string)$operation->price_type_id[0]??0)->sum('amount');
        CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id[0]??0])->update(['paid_amount' => $paid_amount]);

        Report::addToLog('  حذف سند دفع') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            // $ids[] = $id->id;
            $operation = CarFinanceOperations::findOrFail($id->id);
            $operation->delete();
           

            $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->whereJsonContains('price_type_id', (string)$operation->price_type_id[0]??0)->sum('amount');
            CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id[0]??0])->update(['paid_amount' => $paid_amount]);
        }
        
        // if (CarFinanceOperations::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من سندات الدفع') ;
            return response()->json('success');
        // } else {
        //     return response()->json('failed');
        // }
    }
}
