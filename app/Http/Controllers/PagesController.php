<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Slider;

class PagesController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('priority', 'ASC')->get();
        $products = Product::orderBy('id', 'desc')->paginate(3); // for home page
        return view('pages.index', compact('products', 'sliders'));
    }

    public function contact(){
        return view('pages.contact');
    }

    public function search(Request $request){
        $search = $request->search;
        $products = Product::orWhere('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhere('quantity', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(2);
        return view('pages.product.search', compact('search', 'products'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
