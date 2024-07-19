<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carstatuses\Store;
use App\Http\Requests\Admin\carstatuses\Update;
use App\Models\CarStatus ;
use App\Traits\Report;


class CarStatusController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carstatuses = CarStatus::search(request()->searchArray)->paginate(30);
            $html = view('admin.carstatuses.table' ,compact('carstatuses'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.carstatuses.index');
    }

    public function create()
    {
        return view('admin.carstatuses.create');
    }


    public function store(Store $request)
    {
        CarStatus::create($request->validated());
        Report::addToLog('  اضافه حالة') ;
        return response()->json(['url' => route('admin.carstatuses.index')]);
    }
    public function edit($id)
    {
        $carstatus = CarStatus::findOrFail($id);
        return view('admin.carstatuses.edit' , ['carstatus' => $carstatus]);
    }

    public function update(Update $request, $id)
    {
        $carstatus = CarStatus::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل حالة') ;
        return response()->json(['url' => route('admin.carstatuses.index')]);
    }

    public function show($id)
    {
        $carstatus = CarStatus::findOrFail($id);
        return view('admin.carstatuses.show' , ['carstatus' => $carstatus]);
    }
    public function destroy($id)
    {
        $carstatus = CarStatus::findOrFail($id)->delete();
        Report::addToLog('  حذف حالة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarStatus::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من حالات السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
