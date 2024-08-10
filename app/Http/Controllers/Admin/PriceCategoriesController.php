<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\pricecategories\Store;
use App\Http\Requests\Admin\pricecategories\Update;
use App\Models\PriceCategories ;
use App\Traits\Report;
use App\Models\PriceTypes ;


class PriceCategoriesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $pricecategories = PriceCategories::search(request()->searchArray)->paginate(30);
            $html = view('admin.pricecategories.table' ,compact('pricecategories'))->render() ;
            return response()->json(['html' => $html]);
        }
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        return view('admin.pricecategories.index',get_defined_vars());
    }

    public function create()
    {
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        return view('admin.pricecategories.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        PriceCategories::create($request->validated());
        Report::addToLog('  اضافه قسم') ;
        return response()->json(['url' => route('admin.pricecategories.index')]);
    }
    public function edit($id)
    {
        $pricecategories = PriceCategories::findOrFail($id);
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        return view('admin.pricecategories.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $pricecategories = PriceCategories::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل قسم') ;
        return response()->json(['url' => route('admin.pricecategories.index')]);
    }

    public function show($id)
    {
        $pricecategories = PriceCategories::findOrFail($id);
        $priceTypes = PriceTypes::orderBy('name','ASC')->get();
        return view('admin.pricecategories.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $pricecategories = PriceCategories::findOrFail($id)->delete();
        Report::addToLog('  حذف قسم') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PriceCategories::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أقسام الأسعار') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
