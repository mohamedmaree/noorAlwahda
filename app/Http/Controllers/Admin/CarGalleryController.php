<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cargalleries\Store;
use App\Http\Requests\Admin\cargalleries\Update;
use App\Models\CarGallery ;
use App\Traits\Report;
use App\Models\Car ;
use App\Models\CarStatus ;
use App\Models\CarGalleryImages ;

class CarGalleryController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $cargalleries = CarGallery::search(request()->searchArray)->paginate(30);
            $html = view('admin.cargalleries.table' ,compact('cargalleries'))->render() ;
            return response()->json(['html' => $html]);
        }
        $cars = Car::latest()->get();
        $statuses = CarStatus::latest()->get();
        return view('admin.cargalleries.index',get_defined_vars());
    }

    public function create()
    {
        $cars = Car::latest()->get();
        $statuses = CarStatus::latest()->get();
        return view('admin.cargalleries.create',get_defined_vars());
    }

    public function store(Store $request)
    {
        $gallery = CarGallery::create($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($gallery, $request->file('images'));
        }

        Report::addToLog('  اضافه معرض الصور') ;
        return response()->json(['url' => route('admin.cargalleries.index')]);
    }

    private function storeFiles($gallery, $files)
    {    
        foreach ($files as $file) {
            $gallery->images()->create(['image' => $file]);
        }
    }


    public function edit($id)
    {
        $cargallery = CarGallery::findOrFail($id);
        $cars = Car::latest()->get();
        $statuses = CarStatus::latest()->get();
        return view('admin.cargalleries.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $cargallery = CarGallery::findOrFail($id);
        $cargallery->update($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($cargallery, $request->file('images'));
        }
        Report::addToLog('  تعديل معرض الصور') ;
        return response()->json(['url' => route('admin.cargalleries.index')]);
    }

    public function show($id)
    {
        $cargallery = CarGallery::findOrFail($id);
        $cars = Car::latest()->get();
        $statuses = CarStatus::latest()->get();
        return view('admin.cargalleries.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $cargallery = CarGallery::findOrFail($id)->delete();
        Report::addToLog('  حذف معرض الصور') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarGallery::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من معرض صور السيارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = CarGalleryImages::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
