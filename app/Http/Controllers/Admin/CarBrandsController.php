<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carbrands\Store;
use App\Http\Requests\Admin\carbrands\Update;
use App\Models\CarBrands ;
use App\Traits\Report;

use App\Imports\CarBrandImport;
use Maatwebsite\Excel\Facades\Excel;

class CarBrandsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carbrands = CarBrands::search(request()->searchArray)->paginate(30);
            $html = view('admin.carbrands.table' ,compact('carbrands'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.carbrands.index');
    }

    public function create()
    {
        return view('admin.carbrands.create');
    }


    public function store(Store $request)
    {
        CarBrands::create($request->validated());
        Report::addToLog('  اضافه ماركة السيارة') ;
        return response()->json(['url' => route('admin.carbrands.index')]);
    }
    public function edit($id)
    {
        $carbrand = CarBrands::findOrFail($id);
        return view('admin.carbrands.edit' , ['carbrand' => $carbrand]);
    }

    public function update(Update $request, $id)
    {
        $carbrand = CarBrands::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل ماركة السيارة') ;
        return response()->json(['url' => route('admin.carbrands.index')]);
    }

    public function show($id)
    {
        $carbrand = CarBrands::findOrFail($id);
        return view('admin.carbrands.show' , ['carbrand' => $carbrand]);
    }
    public function destroy($id)
    {
        $carbrand = CarBrands::findOrFail($id)->delete();
        Report::addToLog('  حذف ماركة السيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarBrands::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من ماركات السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function importFile(Request $request)
    {
        Excel::import(new CarBrandImport,request()->file('file'));        
        Report::addToLog('  رفع ملف أنواع السيارات') ;
        return response()->json(['url' => route('admin.carbrands.index')]);
    }
}
