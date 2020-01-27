<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Image;
use File;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sliders = Slider::orderBy('priority', 'ASC')->get();
        return view('admin.pages.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' =>  'required',
                'image' =>  'required|image',
                'priority' =>  'required|numeric',
                'button_link' =>  'nullable|url',
            ],
            [
                'title.required' =>  'Please provide the slider title',
                'priority.required' =>  'Please provide the slider priority',
                'image.required' =>  'Please provide the slider image',
                'image.image' =>  'Please provide a valid image',
                'button_link.url' =>  'Please provide a valid button URL',
            ]
        );

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->priority = $request->priority;
        $slider->button_link = $request->button_link;
        $slider->button_text = $request->button_text;

        // Insert image
        if ($request->image > 0) {
            $image = $request->file('image');
            $img = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/sliders/' . $img);
            $slider->image = $img;
            Image::make($image)->save($location);
        }

        $slider->save();

        return redirect()->route('admin.sliders')->with('success', 'Slider created successfully.');
    }

    public function update(Request $request, $id)
    {
        $this->validate( $request, [
                'title' =>  'required',
                'image' =>  'nullable|image',
                'priority' =>  'required',
                'button_link' =>  'nullable|url',
            ],
            [
                'title.required' =>  'Please provide the slider title',
                'priority.required' =>  'Please provide the slider priority',
                'button_link.url' =>  'Please provide a valid button URL',
            ]
        );

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->priority = $request->priority;
        $slider->button_link = $request->button_link;
        $slider->button_text = $request->button_text;

        // Insert image
        if ($request->image > 0) {
            // Delete old image
            if (File::exists('public/images/sliders/' . $slider->image)) {
                File::delete('public/images/sliders/' . $slider->image);
            }
            $image = $request->file('image');
            $img = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/sliders/' . $img);
            Image::make($image)->save($location);
            $slider->image = $img;
        }

        $slider->save();

        return redirect()->route('admin.sliders')->with('success', 'Slider updated successfully.');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);

        if (!is_null($slider)) {

            // Delete slider$slider image
            if (File::exists('public/images/sliders/' . $slider->image)) {
                File::delete('public/images/sliders/' . $slider->image);
            }

            $slider->delete();
        }

        return back()->with('success', 'The slider has been deleted successfully');
    }
}
