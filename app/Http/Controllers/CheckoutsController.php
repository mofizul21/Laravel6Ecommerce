<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Cart;
use Auth;
use Illuminate\Http\Request;

class CheckoutsController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('priority', 'ASC')->get();
        return view('pages.checkouts', compact('payments'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              =>  'required',
            'phone_no'          =>  'required',
            'shipping_address'  =>  'required',
            'payment_method_id' =>  'required'
        ]);

        $order = new Order();

        // Check transaction ID given or not
        if ($request->payment_method_id != 'cash_in') {
            if ($request->transaction_id == NULL || empty($request->transaction_id)) {
                session()->flash('error', 'Please give a correct transaction ID for your payment.');
                return back();
            }
        }

        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone_no = $request->phone_no;
        $order->shipping_address = $request->shipping_address;
        $order->message = $request->message;
        $order->transaction_id = $request->transaction_id;
        $order->ip_address = request()->ip();
        if (Auth::check()) {
            $order->user_id = Auth::id();
        }
        $order->payment_id = Payment::where('short_name', $request->payment_method_id)->first()->id;

        $order->save();

        foreach (Cart::totalCarts() as $cart) {
            $cart->order_id = $order->id;
            $cart->save();
        }

        session()->flash('success', 'Your order has been placed.');

        return redirect()->route('products');
    }

}
