<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\pricetypes\Store;
use App\Http\Requests\Admin\pricetypes\Update;
use App\Models\PriceTypes ;
use App\Traits\Report;


class PriceTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $pricetypes = PriceTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.pricetypes.table' ,compact('pricetypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.pricetypes.index');
    }

    public function create()
    {
        return view('admin.pricetypes.create');
    }


    public function store(Store $request)
    {
        PriceTypes::create($request->validated());
        Report::addToLog('  اضافه سعر') ;
        return response()->json(['url' => route('admin.pricetypes.index')]);
    }
    public function edit($id)
    {
        $pricetypes = PriceTypes::findOrFail($id);
        return view('admin.pricetypes.edit' , ['pricetypes' => $pricetypes]);
    }

    public function update(Update $request, $id)
    {
        $pricetypes = PriceTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل سعر') ;
        return response()->json(['url' => route('admin.pricetypes.index')]);
    }

    public function show($id)
    {
        $pricetypes = PriceTypes::findOrFail($id);
        return view('admin.pricetypes.show' , ['pricetypes' => $pricetypes]);
    }
    public function destroy($id)
    {
        $pricetypes = PriceTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف سعر') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PriceTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع الأسعار') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
