<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carattachments\Store;
use App\Http\Requests\Admin\carattachments\Update;
use App\Models\CarAttachment ;
use App\Traits\Report;
use App\Models\Car ;


class CarAttachmentController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $carattachments = CarAttachment::search(request()->searchArray)->paginate(30);
            $html = view('admin.carattachments.table' ,compact('carattachments'))->render() ;
            return response()->json(['html' => $html]);
        }
        $cars = Car::orderBy('car_num','ASC')->get();
        return view('admin.carattachments.index',get_defined_vars());
    }

    public function create()
    {
        $cars = Car::orderBy('car_num','ASC')->get();
        return view('admin.carattachments.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        CarAttachment::create($request->validated());
        Report::addToLog('  اضافه مرفقات السيارة') ;
        return response()->json(['url' => route('admin.carattachments.index')]);
    }
    public function edit($id)
    {
        $carattachment = CarAttachment::findOrFail($id);
        $cars = Car::orderBy('car_num','ASC')->get();
        return view('admin.carattachments.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $carattachment = CarAttachment::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مرفقات السيارة') ;
        return response()->json(['url' => route('admin.carattachments.index')]);
    }

    public function show($id)
    {
        $carattachment = CarAttachment::findOrFail($id);
        $cars = Car::orderBy('car_num','ASC')->get();
        return view('admin.carattachments.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $carattachment = CarAttachment::findOrFail($id)->delete();
        Report::addToLog('  حذف مرفقات السيارة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarAttachment::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من مرفقات السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = CarAttachment::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
