<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\branches\Store;
use App\Http\Requests\Admin\branches\Update;
use App\Models\Branch ;
use App\Traits\Report;


class BranchController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $branches = Branch::search(request()->searchArray)->paginate(30);
            $html = view('admin.branches.table' ,compact('branches'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.branches.index');
    }

    public function create()
    {
        return view('admin.branches.create');
    }


    public function store(Store $request)
    {
        Branch::create($request->validated());
        Report::addToLog('  اضافه فرع') ;
        return response()->json(['url' => route('admin.branches.index')]);
    }
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branches.edit' , ['branch' => $branch]);
    }

    public function update(Update $request, $id)
    {
        $branch = Branch::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل فرع') ;
        return response()->json(['url' => route('admin.branches.index')]);
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branches.show' , ['branch' => $branch]);
    }
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id)->delete();
        Report::addToLog('  حذف فرع') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Branch::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من فروع الشركة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
