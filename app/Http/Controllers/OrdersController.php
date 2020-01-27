<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use PDF;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('admin.pages.orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::find($id);
        $order->is_seen_by_admin = 1;

        $order->save();
        if (!is_null($order)) {
            return view('admin.pages.orders.show', compact('order'));
        }
    }

    public function paid($id){
        $order = Order::find($id);
        if ($order->is_paid) {
            $order->is_paid = 0;
        } else {
            $order->is_paid = 1;
        }

        $order->save();
        session()->flash('success', 'The order makred has been PAID!');
        return back();
    }

    public function completed($id){
        $order = Order::find($id);
        if ($order->is_completed) {
            $order->is_completed = 0;
        }else{
            $order->is_completed = 1;
        }

        $order->save();
        session()->flash('success', 'The order makred has been COMPLETED!');
        return back();
    }

    public function chargeUpdate(Request $request, $id){
        $order = Order::find($id);
        $order->shipping_charge  = $request->shipping_charge;
        $order->custom_discount  = $request->custom_discount;

        $order->save();
        session()->flash('success', 'The order charge and discount has changed!');
        return back();
    }

    public function generateInvoice($id){
        $order = Order::find($id);

        $pdf = PDF::loadView('admin.pages.orders.invoice', compact('order'));
        $pdf->stream('invoice.pdf'); // 'download' is also available instead of 'stream', 'view
        return $pdf->download('invoice.pdf');
        
    }
}
