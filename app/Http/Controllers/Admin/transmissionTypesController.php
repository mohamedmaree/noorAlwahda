<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\transmissiontypes\Store;
use App\Http\Requests\Admin\transmissiontypes\Update;
use App\Models\transmissionTypes ;
use App\Traits\Report;


class transmissionTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $transmissiontypes = transmissionTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.transmissiontypes.table' ,compact('transmissiontypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.transmissiontypes.index');
    }

    public function create()
    {
        return view('admin.transmissiontypes.create');
    }


    public function store(Store $request)
    {
        transmissionTypes::create($request->validated());
        Report::addToLog('  اضافه نوع ناقل الحركة') ;
        return response()->json(['url' => route('admin.transmissiontypes.index')]);
    }
    public function edit($id)
    {
        $transmissiontypes = transmissionTypes::findOrFail($id);
        return view('admin.transmissiontypes.edit' , ['transmissiontypes' => $transmissiontypes]);
    }

    public function update(Update $request, $id)
    {
        $transmissiontypes = transmissionTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل نوع ناقل الحركة') ;
        return response()->json(['url' => route('admin.transmissiontypes.index')]);
    }

    public function show($id)
    {
        $transmissiontypes = transmissionTypes::findOrFail($id);
        return view('admin.transmissiontypes.show' , ['transmissiontypes' => $transmissiontypes]);
    }
    public function destroy($id)
    {
        $transmissiontypes = transmissionTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف نوع ناقل الحركة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (transmissionTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع ناقل الحركة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
