<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\damagetypes\Store;
use App\Http\Requests\Admin\damagetypes\Update;
use App\Models\DamageTypes ;
use App\Traits\Report;


class DamageTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $damagetypes = DamageTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.damagetypes.table' ,compact('damagetypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.damagetypes.index');
    }

    public function create()
    {
        return view('admin.damagetypes.create');
    }


    public function store(Store $request)
    {
        DamageTypes::create($request->validated());
        Report::addToLog('  اضافه عطل') ;
        return response()->json(['url' => route('admin.damagetypes.index')]);
    }
    public function edit($id)
    {
        $damagetypes = DamageTypes::findOrFail($id);
        return view('admin.damagetypes.edit' , ['damagetypes' => $damagetypes]);
    }

    public function update(Update $request, $id)
    {
        $damagetypes = DamageTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل عطل') ;
        return response()->json(['url' => route('admin.damagetypes.index')]);
    }

    public function show($id)
    {
        $damagetypes = DamageTypes::findOrFail($id);
        return view('admin.damagetypes.show' , ['damagetypes' => $damagetypes]);
    }
    public function destroy($id)
    {
        $damagetypes = DamageTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف عطل') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (DamageTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع الأعطال') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
