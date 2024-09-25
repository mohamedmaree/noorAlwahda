<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\userattachments\Store;
use App\Http\Requests\Admin\userattachments\Update;
use App\Models\UserAttachments ;
use App\Traits\Report;
use App\Models\User ;


class UserAttachmentsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $userattachments = UserAttachments::search(request()->searchArray)->paginate(30);
            $html = view('admin.userattachments.table' ,compact('userattachments'))->render() ;
            return response()->json(['html' => $html]);
        }
        $users = User::orderBy('name','ASC')->get();
        return view('admin.userattachments.index',get_defined_vars());
    }

    public function create()
    {
        $users = User::orderBy('name','ASC')->get();
        return view('admin.userattachments.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        UserAttachments::create($request->validated());
        Report::addToLog('  اضافه مرفقات العميل') ;
        return response()->json(['url' => route('admin.userattachments.index')]);
    }
    public function edit($id)
    {
        $userattachment = UserAttachments::findOrFail($id);
        $users = User::orderBy('name','ASC')->get();
        return view('admin.userattachments.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $userattachment = UserAttachments::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مرفقات العميل') ;
        return response()->json(['url' => route('admin.userattachments.index')]);
    }

    public function show($id)
    {
        $userattachment = UserAttachments::findOrFail($id);
        $users = User::orderBy('name','ASC')->get();
        return view('admin.userattachments.show',get_defined_vars());
    }
    public function destroy($id)
    {
        $userattachment = UserAttachments::findOrFail($id)->delete();
        Report::addToLog('  حذف مرفقات العميل') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (UserAttachments::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من مرفقات العميل') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
