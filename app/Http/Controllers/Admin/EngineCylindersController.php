<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\enginecylinders\Store;
use App\Http\Requests\Admin\enginecylinders\Update;
use App\Models\EngineCylinders ;
use App\Traits\Report;


class EngineCylindersController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $enginecylinders = EngineCylinders::search(request()->searchArray)->paginate(30);
            $html = view('admin.enginecylinders.table' ,compact('enginecylinders'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.enginecylinders.index');
    }

    public function create()
    {
        return view('admin.enginecylinders.create');
    }


    public function store(Store $request)
    {
        EngineCylinders::create($request->validated());
        Report::addToLog('  اضافه سعة المحرك') ;
        return response()->json(['url' => route('admin.enginecylinders.index')]);
    }
    public function edit($id)
    {
        $enginecylinders = EngineCylinders::findOrFail($id);
        return view('admin.enginecylinders.edit' , ['enginecylinders' => $enginecylinders]);
    }

    public function update(Update $request, $id)
    {
        $enginecylinders = EngineCylinders::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل سعة المحرك') ;
        return response()->json(['url' => route('admin.enginecylinders.index')]);
    }

    public function show($id)
    {
        $enginecylinders = EngineCylinders::findOrFail($id);
        return view('admin.enginecylinders.show' , ['enginecylinders' => $enginecylinders]);
    }
    public function destroy($id)
    {
        $enginecylinders = EngineCylinders::findOrFail($id)->delete();
        Report::addToLog('  حذف سعة المحرك') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (EngineCylinders::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من سعة المحركات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
