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
use App\Traits\ResponseTrait;

class CarFinanceOperationsController extends Controller
{
    use ResponseTrait;
    //------------ AJAX --------------//
    public function getCarOutstandingFinances(Request $request){
        $finances = CarFinance::where('car_id',$request->car_id)->whereRaw('CAST(paid_amount AS DECIMAL(9, 2)) < CAST(required_amount AS DECIMAL(9, 2))')->get();
        return view('admin.carfinanceoperations.car_finances',get_defined_vars());
    }
    //------------ AJAX --------------//

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
        if($request->amount){
            $carFinanceArr = [];
            $i = 0;
            foreach($request->price_type_id as $priceType){
                if(isset($request->amount[$i]) ){
                    if($finance = CarFinance::where('car_id',$request->car_id)->where('price_type_id',$priceType)->first()){
                        $still_amount = str_replace(',','',$finance->required_amount) - str_replace(',','',$finance->paid_amount);
                        if($request->amount[$i] > $still_amount){
                            return $this->response('fail', __('admin.amount_lt_still_amount'));
                        }
                    }else{
                        return $this->response('fail', __('admin.no_outstanding_amount'));
                    }
                    CarFinanceOperations::create(['car_id' => $request->car_id,'price_type_id' => $priceType,'amount' => $request->amount[$i]??'','image' => $request->image ]);
                    
                    $paid_amount = CarFinanceOperations::where('car_id', $request->car_id)->where('price_type_id',$priceType)->sum('amount');
                    CarFinance::where(['car_id' => $request->car_id,'price_type_id' => $priceType])->update(['paid_amount' => $paid_amount]);
                    
                    $i++;
                }
            }
        }



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
       
        if($finance = CarFinance::where('car_id',$request->car_id)->where('price_type_id',$request->price_type_id)->first()){
            $still_amount = str_replace(',','',$finance->required_amount) - str_replace(',','',$finance->paid_amount);
            if($request->amount > $still_amount && $operation->amount < $request->amount){
                return $this->response('fail', __('admin.amount_lt_still_amount'));
            }
        }else{
            return $this->response('fail', __('admin.no_outstanding_amount'));
        }

        $operation->update($request->validated());

        $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->where('price_type_id', $operation->price_type_id)->sum('amount');
        CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id])->update(['paid_amount' => $paid_amount]);

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
       

        $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->where('price_type_id', $operation->price_type_id)->sum('amount');
        CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id])->update(['paid_amount' => $paid_amount]);

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
           

            // $paid_amount = CarFinanceOperations::where('car_id', $operation->car_id)->whereJsonContains('price_type_id', (string)$operation->price_type_id[0]??0)->sum('amount');
            // CarFinance::where(['car_id' => $operation->car_id,'price_type_id' => $operation->price_type_id[0]??0])->update(['paid_amount' => $paid_amount]);
        }
        
        // if (CarFinanceOperations::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من سندات الدفع') ;
            return response()->json('success');
        // } else {
        //     return response()->json('failed');
        // }
    }
}
