<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Image;
use File;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('admin.pages.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.pages.brand.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'         => 'required|max:150',
                'image'        => 'nullable|image'
            ],
            [
                'name.required' =>  'Please provide a brand name',
                'image.image'   =>  'Please upload only image. Another file type is not acceptable.'
            ]
        );

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;

        // Insert image
        if ($request->image) {
            $image = $request->file('image');
            $img = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/brands/' . $img);
            $brand->image = $img;
            Image::make($image)->save($location);
        }

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit($id)
    {
        $brands = Brand::find($id);
        if (!is_null($brands)) {
            return view('admin.pages.brand.edit', compact('brands'));
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
                'name.required' =>  'Please provide a brand name',
                'image.image'   =>  'Please upload only image. Another file type is not acceptable.'
            ]
        );

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->description = $request->description;

        // Insert image
        if ($request->image) {

            // Delete old image
            if (File::exists('public/images/brands/' . $brand->image)) {
                File::delete('public/images/brands/' . $brand->image);
            }
            $image = $request->file('image');
            $img = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/brands/' . $img);
            $brand->image = $img;
            Image::make($image)->save($location);
        }

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);

        if (!is_null($brand)) {

            // Delete brand image
            if (File::exists('public/images/brands/' . $brand->image)) {
                File::delete('public/images/brands/' . $brand->image);
            }

            $brand->delete();
        }

        return back()->with('success', 'The Brand has been deleted successfully');
    }
}
