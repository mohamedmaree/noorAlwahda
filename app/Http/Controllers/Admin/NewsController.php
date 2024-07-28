<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\news\Store;
use App\Http\Requests\Admin\news\Update;
use App\Models\News ;
use App\Traits\Report;


class NewsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $news = News::search(request()->searchArray)->paginate(30);
            $html = view('admin.news.table' ,compact('news'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
    }


    public function store(Store $request)
    {
        News::create($request->validated());
        Report::addToLog('  اضافه خبر') ;
        return response()->json(['url' => route('admin.news.index')]);
    }
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit' , ['news' => $news]);
    }

    public function update(Update $request, $id)
    {
        $news = News::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل خبر') ;
        return response()->json(['url' => route('admin.news.index')]);
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.show' , ['news' => $news]);
    }
    public function destroy($id)
    {
        $news = News::findOrFail($id)->delete();
        Report::addToLog('  حذف خبر') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (News::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الأخبار') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
