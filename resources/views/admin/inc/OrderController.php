<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Model\Order;
use App\Model\Setting;

class OrderController extends BaseController
{
    public function index()
    {
        // set page and title ------------------
        $page  = 'order.add';
        $title = 'Order';
        $data  = compact('page', 'title');
        // return data to view
        return view('admin.layout', $data);
    }

    public function list()
    {
         $setting = Setting::find(1);
        $lists = Order::latest()->paginate(10);

        // set page and title ------------------
        $page  = 'order.list';
        $title = 'Order List';
        $data  = compact('page', 'title', 'lists', 'setting');
        // return data to view
        return view('admin.layout', $data);
    }

    public function infopage()
    {
        $setting = Setting::find(1);
        $lists = Order::latest()->paginate(10);
        // set page and title ------------------
        $page  = 'order.list2';
        $title = 'Order';
        $data  = compact('page', 'title', 'lists', 'setting');
        // return data to view
        return view('admin.layout', $data);
    }

    public function add(Request $request)
    {
        $record         = new Order;
        $input          = $request->record;
        $record->fill('$input');
        if ($record->save()) {
            return redirect(url('restaurent-control/order/list'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(url('restaurent-control/order/list'))->with('danger', 'Error! Something going wrong.');
        }
    }
    
    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        
        Order::whereIn('id', $ids)->delete();
        return response()->json(['status' => true]);
    }

    public function change_status(Request $request, Order $order)
    {
        $order->update([ $request->field => $request->status ]);

        return redirect()->back()->with('success', "{$request->field} status has been changed.");
    }
}
