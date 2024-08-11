<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cargalleryimages\Store;
use App\Http\Requests\Admin\cargalleryimages\Update;
use App\Models\CarGalleryImages ;
use App\Traits\Report;


class CarGalleryImagesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $cargalleryimages = CarGalleryImages::search(request()->searchArray)->paginate(30);
            $html = view('admin.cargalleryimages.table' ,compact('cargalleryimages'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.cargalleryimages.index');
    }

    public function create()
    {
        return view('admin.cargalleryimages.create');
    }


    public function store(Store $request)
    {
        CarGalleryImages::create($request->validated());
        Report::addToLog('  اضافه صورة') ;
        return response()->json(['url' => route('admin.cargalleryimages.index')]);
    }
    public function edit($id)
    {
        $cargalleryimages = CarGalleryImages::findOrFail($id);
        return view('admin.cargalleryimages.edit' , ['cargalleryimages' => $cargalleryimages]);
    }

    public function update(Update $request, $id)
    {
        $cargalleryimages = CarGalleryImages::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل صورة') ;
        return response()->json(['url' => route('admin.cargalleryimages.index')]);
    }

    public function show($id)
    {
        $cargalleryimages = CarGalleryImages::findOrFail($id);
        return view('admin.cargalleryimages.show' , ['cargalleryimages' => $cargalleryimages]);
    }
    public function destroy($id)
    {
        $cargalleryimages = CarGalleryImages::findOrFail($id)->delete();
        Report::addToLog('  حذف صورة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarGalleryImages::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من صور معرض الصور') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
