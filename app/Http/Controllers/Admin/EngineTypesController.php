<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\enginetypes\Store;
use App\Http\Requests\Admin\enginetypes\Update;
use App\Models\EngineTypes ;
use App\Traits\Report;


class EngineTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $enginetypes = EngineTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.enginetypes.table' ,compact('enginetypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.enginetypes.index');
    }

    public function create()
    {
        return view('admin.enginetypes.create');
    }


    public function store(Store $request)
    {
        EngineTypes::create($request->validated());
        Report::addToLog('  اضافه نوع المحرك') ;
        return response()->json(['url' => route('admin.enginetypes.index')]);
    }
    public function edit($id)
    {
        $enginetypes = EngineTypes::findOrFail($id);
        return view('admin.enginetypes.edit' , ['enginetypes' => $enginetypes]);
    }

    public function update(Update $request, $id)
    {
        $enginetypes = EngineTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل نوع المحرك') ;
        return response()->json(['url' => route('admin.enginetypes.index')]);
    }

    public function show($id)
    {
        $enginetypes = EngineTypes::findOrFail($id);
        return view('admin.enginetypes.show' , ['enginetypes' => $enginetypes]);
    }
    public function destroy($id)
    {
        $enginetypes = EngineTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف نوع المحرك') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (EngineTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع المحركات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
