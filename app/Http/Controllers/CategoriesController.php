<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        
    }


    public function show($id)
    {
        $category = Category::find($id);
        if (!is_null($category)) {
            return view('pages.categories.show', compact('category'));
        }else{
            session()->flash('error', 'Sorry! there is no category by this ID');
            return redirect('/');
        }
    }


}
