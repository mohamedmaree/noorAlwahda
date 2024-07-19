<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carcolors\Store;
use App\Http\Requests\Admin\carcolors\Update;
use App\Models\CarColors ;
use App\Traits\Report;


class CarColorsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carcolors = CarColors::search(request()->searchArray)->paginate(30);
            $html = view('admin.carcolors.table' ,compact('carcolors'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.carcolors.index');
    }

    public function create()
    {
        return view('admin.carcolors.create');
    }


    public function store(Store $request)
    {
        CarColors::create($request->validated());
        Report::addToLog('  اضافه لون السيارة') ;
        return response()->json(['url' => route('admin.carcolors.index')]);
    }
    public function edit($id)
    {
        $carcolor = CarColors::findOrFail($id);
        return view('admin.carcolors.edit' , ['carcolor' => $carcolor]);
    }

    public function update(Update $request, $id)
    {
        $carcolor = CarColors::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل لون السيارة') ;
        return response()->json(['url' => route('admin.carcolors.index')]);
    }

    public function show($id)
    {
        $carcolor = CarColors::findOrFail($id);
        return view('admin.carcolors.show' , ['carcolor' => $carcolor]);
    }
    public function destroy($id)
    {
        $carcolor = CarColors::findOrFail($id)->delete();
        Report::addToLog('  حذف لون السيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarColors::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من ألوان السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
