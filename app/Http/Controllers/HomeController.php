<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllSlider(Request $request)
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function CreateSlider()
    {
        return view('admin.slider.create');
    }

    public function AddSlider(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:sliders|max:50',
            'description' => 'required|unique:sliders|max:300',
            'slider_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'title.required' => 'Please input a name',
        ]);

        $slider_image = $request->file('slider_image');


        $img_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1080)->save('image/slider/'.$img_gen);
        $last_img = 'image/slider/'.$img_gen;

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->slider_image = $last_img;
        $slider->save();

        return Redirect()->route('all.slider')->with('success', 'Slider Inserted Successfully!'); 
    }

    public function Edit(Request $request, $id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:300',
        ]);

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->description = $request->description;

        $old_image = $request->old_image;
        $slider_image = $request->file('new_image');

        if ($slider_image) {
            unlink($old_image);

            $img_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920,1080)->save('image/slider/'.$img_gen);
            $last_img = 'image/slider/'.$img_gen; 
            $slider->slider_image = $last_img;
            $slider->update();

            return Redirect()->route('all.slider')->with('success', 'Slider Update Successfully!');
        }
        else{
            $slider->update();
            return Redirect()->route('all.slider')->with('success', 'Slider Update Successfully!');
        }
    }

    public function Delete($id)
    {
        $slider = Slider::find($id);
        $image = $slider->slider_image;
        unlink($image);
        $slider->delete();
        return Redirect()->back()->with('success', 'Slider Delete Successfully!');
    }
}
