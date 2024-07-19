<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\drivetypes\Store;
use App\Http\Requests\Admin\drivetypes\Update;
use App\Models\DriveTypes ;
use App\Traits\Report;


class DriveTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $drivetypes = DriveTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.drivetypes.table' ,compact('drivetypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.drivetypes.index');
    }

    public function create()
    {
        return view('admin.drivetypes.create');
    }


    public function store(Store $request)
    {
        DriveTypes::create($request->validated());
        Report::addToLog('  اضافه نوع القيادة') ;
        return response()->json(['url' => route('admin.drivetypes.index')]);
    }
    public function edit($id)
    {
        $drivetypes = DriveTypes::findOrFail($id);
        return view('admin.drivetypes.edit' , ['drivetypes' => $drivetypes]);
    }

    public function update(Update $request, $id)
    {
        $drivetypes = DriveTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل نوع القيادة') ;
        return response()->json(['url' => route('admin.drivetypes.index')]);
    }

    public function show($id)
    {
        $drivetypes = DriveTypes::findOrFail($id);
        return view('admin.drivetypes.show' , ['drivetypes' => $drivetypes]);
    }
    public function destroy($id)
    {
        $drivetypes = DriveTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف نوع القيادة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (DriveTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع القيادة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
