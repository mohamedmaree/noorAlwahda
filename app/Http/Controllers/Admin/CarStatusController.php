<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\carstatuses\Store;
use App\Http\Requests\Admin\carstatuses\Update;
use App\Models\CarStatus ;
use App\Traits\Report;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

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
        $fields = Schema::getColumnListing('cars');
        return view('admin.carstatuses.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        CarStatus::create($request->validated());
        Report::addToLog('  اضافه حالة') ;
        Artisan::call('optimize:clear');
        Artisan::call('optimize');
        return response()->json(['url' => route('admin.carstatuses.index')]);
    }
    public function edit($id)
    {
        $carstatus = CarStatus::findOrFail($id);
        $fields = Schema::getColumnListing('cars');
        return view('admin.carstatuses.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $carstatus = CarStatus::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل حالة') ;
        Artisan::call('optimize:clear');
        Artisan::call('optimize');
        return response()->json(['url' => route('admin.carstatuses.index')]);
    }

    public function show($id)
    {
        $carstatus = CarStatus::findOrFail($id);
        $fields = Schema::getColumnListing('cars');
        return view('admin.carstatuses.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $carstatus = CarStatus::findOrFail($id)->delete();
        Report::addToLog('  حذف حالة') ;
        Artisan::call('optimize:clear');
        Artisan::call('optimize');
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
            Artisan::call('optimize:clear');
            Artisan::call('optimize');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
