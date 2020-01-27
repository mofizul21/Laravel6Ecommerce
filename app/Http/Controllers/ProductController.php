<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(6); // for all_products.blade.php
        return view('pages.product.all_products')->with('products', $products);
    }

    public function show($slug){
        $product = Product::where('slug', $slug)->first();
        if (!is_null($product)) {
            return view('pages.product.show', compact('product'));
        }else{
            return abort(403, 'Unauthorized action.');;
        }        
    }
}
