<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\caryears\Store;
use App\Http\Requests\Admin\caryears\Update;
use App\Models\CarYears ;
use App\Traits\Report;


class CarYearsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $caryears = CarYears::search(request()->searchArray)->paginate(30);
            $html = view('admin.caryears.table' ,compact('caryears'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.caryears.index');
    }

    public function create()
    {
        return view('admin.caryears.create');
    }


    public function store(Store $request)
    {
        CarYears::create($request->validated());
        Report::addToLog('  اضافه سنة صنع السيارة') ;
        return response()->json(['url' => route('admin.caryears.index')]);
    }
    public function edit($id)
    {
        $caryear = CarYears::findOrFail($id);
        return view('admin.caryears.edit' , ['caryear' => $caryear]);
    }

    public function update(Update $request, $id)
    {
        $caryear = CarYears::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل سنة صنع السيارة') ;
        return response()->json(['url' => route('admin.caryears.index')]);
    }

    public function show($id)
    {
        $caryear = CarYears::findOrFail($id);
        return view('admin.caryears.show' , ['caryear' => $caryear]);
    }
    public function destroy($id)
    {
        $caryear = CarYears::findOrFail($id)->delete();
        Report::addToLog('  حذف سنة صنع السيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarYears::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من سنين صنع السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
