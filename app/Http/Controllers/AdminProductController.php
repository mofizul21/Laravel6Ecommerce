<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Str;
use Image;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    public function index(){
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.pages.product.index', compact('products'));
    }

    public function create(){
          return view('admin.pages.product.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'         => 'required|max:150',
            'description'   => 'required',
            'category_id'   => 'required',
            'brand_id'      => 'required',
            'quantity'      => 'required|numeric',
            'price'         => 'required|numeric'
        ]);

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = Str::slug($product->title);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;

        $product->save();

        if(count($request->product_image) > 0){
            $i = 0;
            foreach($request->product_image as $image){            
                //$image = $request->file('product_image');
                $img = time().$i.".".$image->getClientOriginalExtension();
                $location = public_path('images/products/'. $img);
                Image::make($image)->save($location);

                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $img;
                $product_image->save();
                $i++;
            }
        }

        return redirect()->route('admin.product.create')->with('success', 'Product has been added successfully');;
    }    

    public function edit($id){
        $product = Product::find($id);
        return view('admin.pages.product.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title'         => 'required|max:150',
            'description'   => 'required',
            'category_id'   => 'required',
            'brand_id'      => 'required',
            'quantity'      => 'required|numeric',
            'price'         => 'required|numeric'
        ]);

        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Product has been updated successfully');
    }

    public function delete($id){
        $product = Product::find($id);

        if (!is_null($product)) {
            $product->delete();
        }

        // Delete all images under the product
        foreach($product->images as $img){
            // Delete from path
            $file_name = $img->image;
            if (file_exists('public/images/products/'. $file_name)) {
                unlink('public/images/products/' . $file_name);
            }
            // Delete from database
            $img->delete();
        }

        return back()->with('success', 'Product has been deleted successfully');
    }

}
