<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Image;
use File;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        $main_categories = Category::orderBy('id', 'DESC')->where('parent_id', NULL)->get();
        return view('admin.pages.category.create', compact('main_categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'         => 'required|max:150',
            'image'        => 'nullable|image'
        ],
        [
            'name.required' =>  'Please provide a category name',
            'image.image'   =>  'Please upload only image. Another file type is not acceptable.'
        ]
        );

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        // Insert image
        if ($request->image) {
            $image = $request->file('image');
            $img = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/categories/' . $img);
            $category->image = $img;
            Image::make($image)->save($location);
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id){
        $main_categories = Category::orderBy('id', 'DESC')->where('parent_id', NULL)->get();
        $categories = Category::find($id);
        if (!is_null($categories)) {
            return view('admin.pages.category.edit', compact('categories', 'main_categories'));
        }else{
            return redirect()->route('admin.category.index');
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'         => 'required|max:150',
                'image'        => 'nullable|image'
            ],
            [
                'name.required' =>  'Please provide a category name',
                'image.image'   =>  'Please upload only image. Another file type is not acceptable.'
            ]
        );

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        // Insert image
        if ($request->image) {

            // Delete old image
            if (File::exists('public/images/categories/' . $category->image)) {
                File::delete('public/images/categories/' . $category->image);
            }
            $image = $request->file('image');
            $img = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/categories/' . $img);
            $category->image = $img;
            Image::make($image)->save($location);
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!is_null($category)) {

            if ($category->parent_id == NULL) {
                // If it's parent category, then delete it's sub-category
                $sub_categories = Category::orderBy('name', 'DESC')->where('parent_id', $category->id)->get();
                
                foreach ($sub_categories as $sub) {
                    // Delete sub-category image
                    if (File::exists('public/images/categories/' . $sub->image)) {
                        File::delete('public/images/categories/' . $sub->image);
                    }
                    $sub->delete();
                }
            }

            // Delete category image
            if (File::exists('public/images/categories/' . $category->image)) {
                File::delete('public/images/categories/' . $category->image);
            }

            $category->delete();
        }

        return back()->with('success', 'The category has been deleted successfully');
    }
}
