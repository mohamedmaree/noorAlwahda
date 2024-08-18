<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\warehouses\Store;
use App\Http\Requests\Admin\warehouses\Update;
use App\Models\Warehouse ;
use App\Traits\Report;


class WarehouseController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $warehouses = Warehouse::search(request()->searchArray)->paginate(30);
            $html = view('admin.warehouses.table' ,compact('warehouses'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.warehouses.index');
    }

    public function create()
    {
        return view('admin.warehouses.create');
    }


    public function store(Store $request)
    {
        Warehouse::create($request->validated());
        Report::addToLog('  اضافه مستودع') ;
        return response()->json(['url' => route('admin.warehouses.index')]);
    }
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.edit' , ['warehouse' => $warehouse]);
    }

    public function update(Update $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مستودع') ;
        return response()->json(['url' => route('admin.warehouses.index')]);
    }

    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.show' , ['warehouse' => $warehouse]);
    }
    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id)->delete();
        Report::addToLog('  حذف مستودع') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Warehouse::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من المستودعات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
