<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\bodytypes\Store;
use App\Http\Requests\Admin\bodytypes\Update;
use App\Models\BodyTypes ;
use App\Traits\Report;


class BodyTypesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $bodytypes = BodyTypes::search(request()->searchArray)->paginate(30);
            $html = view('admin.bodytypes.table' ,compact('bodytypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.bodytypes.index');
    }

    public function create()
    {
        return view('admin.bodytypes.create');
    }


    public function store(Store $request)
    {
        BodyTypes::create($request->validated());
        Report::addToLog('  اضافه نوع الهيكل') ;
        return response()->json(['url' => route('admin.bodytypes.index')]);
    }
    public function edit($id)
    {
        $bodytypes = BodyTypes::findOrFail($id);
        return view('admin.bodytypes.edit' , ['bodytypes' => $bodytypes]);
    }

    public function update(Update $request, $id)
    {
        $bodytypes = BodyTypes::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل نوع الهيكل') ;
        return response()->json(['url' => route('admin.bodytypes.index')]);
    }

    public function show($id)
    {
        $bodytypes = BodyTypes::findOrFail($id);
        return view('admin.bodytypes.show' , ['bodytypes' => $bodytypes]);
    }
    public function destroy($id)
    {
        $bodytypes = BodyTypes::findOrFail($id)->delete();
        Report::addToLog('  حذف نوع الهيكل') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (BodyTypes::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع الهياكل') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
