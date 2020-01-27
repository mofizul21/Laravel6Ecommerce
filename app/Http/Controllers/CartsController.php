<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.carts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'    =>  'required'
        ],[
            'product_id.required'    =>  'Please select a product'
        ]);

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->where('order_id', NULL)
                ->first();
        }else{
            $cart = Cart::where('ip_address', request()->ip())
                ->where('product_id', $request->product_id)
                ->where('order_id', NULL)
                ->first();
        }

        if (!is_null($cart)) {
            $cart->increment('product_quantity');
        }else{
            $cart = new Cart();

            if (Auth::check()) {
                $cart->user_id = Auth::id();
            }
            
            $cart->ip_address = request()->ip();
            $cart->product_id = $request->product_id;

            $cart->save();
        }

        return json_encode(['status'=>'success', 'Message'=>'Item added to cart', 'totalItems'=>Cart::totalItems()]);
        // session()->flash('success', 'Product has added to cart');
        // return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_quantity'    =>  'numeric'
        ]);

        $cart = Cart::find($id);
        if (!is_null($cart)) {
            if ($request->product_quantity >= 1) {
                $cart->product_quantity = $request->product_quantity;
                $cart->save();
            }else{
                session()->flash('error', 'The quantity must be at least 1.');
                return back();
            }            
        }else{
            return redirect()->route('carts');
        }

        session()->flash('success', 'The cart updated successfully');
        return back();
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->delete();
        } else {
            return redirect()->route('carts');
        }

        session()->flash('success', 'The cart deleted successfully');
        return back();
    }
}
