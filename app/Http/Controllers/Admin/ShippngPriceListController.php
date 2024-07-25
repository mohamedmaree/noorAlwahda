<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\shippngpricelists\Store;
use App\Http\Requests\Admin\shippngpricelists\Update;
use App\Models\ShippngPriceList ;
use App\Traits\Report;


class ShippngPriceListController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $shippngpricelists = ShippngPriceList::search(request()->searchArray)->paginate(30);
            $html = view('admin.shippngpricelists.table' ,compact('shippngpricelists'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.shippngpricelists.index');
    }

    public function create()
    {
        return view('admin.shippngpricelists.create');
    }


    public function store(Store $request)
    {
        ShippngPriceList::create($request->validated());
        Report::addToLog('  اضافه قائمة أسعار الشحن') ;
        return response()->json(['url' => route('admin.shippngpricelists.index')]);
    }
    public function edit($id)
    {
        $shippngpricelist = ShippngPriceList::findOrFail($id);
        return view('admin.shippngpricelists.edit' , ['shippngpricelist' => $shippngpricelist]);
    }

    public function update(Update $request, $id)
    {
        $shippngpricelist = ShippngPriceList::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل قائمة أسعار الشحن') ;
        return response()->json(['url' => route('admin.shippngpricelists.index')]);
    }

    public function show($id)
    {
        $shippngpricelist = ShippngPriceList::findOrFail($id);
        return view('admin.shippngpricelists.show' , ['shippngpricelist' => $shippngpricelist]);
    }
    public function destroy($id)
    {
        $shippngpricelist = ShippngPriceList::findOrFail($id)->delete();
        Report::addToLog('  حذف قائمة أسعار الشحن') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ShippngPriceList::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من قوائم أسعار الشحن') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
