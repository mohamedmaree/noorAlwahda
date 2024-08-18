<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\auctions\Store;
use App\Http\Requests\Admin\auctions\Update;
use App\Models\Auction ;
use App\Traits\Report;


class AuctionController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $auctions = Auction::search(request()->searchArray)->paginate(30);
            $html = view('admin.auctions.table' ,compact('auctions'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.auctions.index');
    }

    public function create()
    {
        return view('admin.auctions.create');
    }


    public function store(Store $request)
    {
        Auction::create($request->validated());
        Report::addToLog('  اضافه مزاد') ;
        return response()->json(['url' => route('admin.auctions.index')]);
    }
    public function edit($id)
    {
        $auction = Auction::findOrFail($id);
        return view('admin.auctions.edit' , ['auction' => $auction]);
    }

    public function update(Update $request, $id)
    {
        $auction = Auction::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مزاد') ;
        return response()->json(['url' => route('admin.auctions.index')]);
    }

    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        return view('admin.auctions.show' , ['auction' => $auction]);
    }
    public function destroy($id)
    {
        $auction = Auction::findOrFail($id)->delete();
        Report::addToLog('  حذف مزاد') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Auction::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من المزادات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
