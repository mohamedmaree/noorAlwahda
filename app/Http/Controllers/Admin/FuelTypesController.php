<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\fueltypes\Store;
use App\Http\Requests\Admin\fueltypes\Update;
use App\Models\FuelTypes ;
use App\Traits\Report;


class FuelTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $fueltypes = FuelTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.fueltypes.table' ,compact('fueltypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.fueltypes.index');
    }

    public function create()
    {
        return view('admin.fueltypes.create');
    }


    public function store(Store $request)
    {
        FuelTypes::create($request->validated());
        Report::addToLog('  اضافه نوع الوقود') ;
        return response()->json(['url' => route('admin.fueltypes.index')]);
    }
    public function edit($id)
    {
        $fueltypes = FuelTypes::findOrFail($id);
        return view('admin.fueltypes.edit' , ['fueltypes' => $fueltypes]);
    }

    public function update(Update $request, $id)
    {
        $fueltypes = FuelTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل نوع الوقود') ;
        return response()->json(['url' => route('admin.fueltypes.index')]);
    }

    public function show($id)
    {
        $fueltypes = FuelTypes::findOrFail($id);
        return view('admin.fueltypes.show' , ['fueltypes' => $fueltypes]);
    }
    public function destroy($id)
    {
        $fueltypes = FuelTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف نوع الوقود') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (FuelTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع الوقود') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
