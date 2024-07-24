<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use App\Models\Category ;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\categories\Store;
use App\Http\Requests\Admin\categories\Update;
use App\Models\CarStatus ;


class CategoryController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $categories = Category::search(request()->searchArray)->paginate(30);
            $html = view('admin.categories.table' ,compact('categories'))->render() ;
            return response()->json(['html' => $html]);
        }
        $statuses = CarStatus::latest()->get();
        return view('admin.categories.index' ,get_defined_vars());
    }

    public function export() 
    {
        return Excel::download(new CategoryExport, 'users.xlsx');
    }

    public function create($id = null)
    {
        $statuses = CarStatus::latest()->get();
        return view('admin.categories.create' , get_defined_vars());
    }

    public function store(Store $request)
    {
        Category::create($request->validated() );
        Report::addToLog('  اضافه قسم') ;
        return response()->json(['url' => route('admin.categories.index')]);
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $statuses = CarStatus::latest()->get();
        return view('admin.categories.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $category = Category::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل قسم') ;
        return response()->json(['url' => route('admin.categories.index')]);
    }
    
     public function show($id)
     {
         $category = Category::findOrFail($id);
         $statuses = CarStatus::latest()->get();
         return view('admin.categories.show' , get_defined_vars());
     }

    public function destroy($id)
    {
        $category = Category::findOrFail($id)->delete();
        Report::addToLog('  حذف قسم') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Category::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الاقسام') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
