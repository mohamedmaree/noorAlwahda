<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carmodels\Store;
use App\Http\Requests\Admin\carmodels\Update;
use App\Models\CarModels ;
use App\Models\CarBrands ;
use App\Traits\Report;


class CarModelsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carmodels = CarModels::search(request()->searchArray)->paginate(30);
            $html = view('admin.carmodels.table' ,compact('carmodels'))->render() ;
            return response()->json(['html' => $html]);
        }
        $brands = CarBrands::orderBy('name','ASC')->get();
        return view('admin.carmodels.index',get_defined_vars());
    }

    public function create()
    {
        $brands = CarBrands::orderBy('name','ASC')->get();
        return view('admin.carmodels.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        CarModels::create($request->validated());
        Report::addToLog('  اضافه موديل السيارة') ;
        return response()->json(['url' => route('admin.carmodels.index')]);
    }
    public function edit($id)
    {
        $carmodel = CarModels::findOrFail($id);
        $brands = CarBrands::orderBy('name','ASC')->get();
        return view('admin.carmodels.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $carmodel = CarModels::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل موديل السيارة') ;
        return response()->json(['url' => route('admin.carmodels.index')]);
    }

    public function show($id)
    {
        $carmodel = CarModels::findOrFail($id);
        $brands = CarBrands::orderBy('name','ASC')->get();
        return view('admin.carmodels.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $carmodel = CarModels::findOrFail($id)->delete();
        Report::addToLog('  حذف موديل السيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarModels::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من موديلات السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
