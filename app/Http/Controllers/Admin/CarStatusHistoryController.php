<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carstatushistories\Store;
use App\Http\Requests\Admin\carstatushistories\Update;
use App\Models\CarStatusHistory ;
use App\Traits\Report;


class CarStatusHistoryController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carstatushistories = CarStatusHistory::search(request()->searchArray)->paginate(30);
            $html = view('admin.carstatushistories.table' ,compact('carstatushistories'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.carstatushistories.index');
    }

    public function create()
    {
        return view('admin.carstatushistories.create');
    }


    public function store(Store $request)
    {
        CarStatusHistory::create($request->validated());
        Report::addToLog('  اضافه أرشيف حالات السيارة') ;
        return response()->json(['url' => route('admin.carstatushistories.index')]);
    }
    public function edit($id)
    {
        $carstatushistory = CarStatusHistory::findOrFail($id);
        return view('admin.carstatushistories.edit' , ['carstatushistory' => $carstatushistory]);
    }

    public function update(Update $request, $id)
    {
        $carstatushistory = CarStatusHistory::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل أرشيف حالات السيارة') ;
        return response()->json(['url' => route('admin.carstatushistories.index')]);
    }

    public function show($id)
    {
        $carstatushistory = CarStatusHistory::findOrFail($id);
        return view('admin.carstatushistories.show' , ['carstatushistory' => $carstatushistory]);
    }
    public function destroy($id)
    {
        $carstatushistory = CarStatusHistory::findOrFail($id)->delete();
        Report::addToLog('  حذف أرشيف حالات السيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarStatusHistory::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أرشيف حالات السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
