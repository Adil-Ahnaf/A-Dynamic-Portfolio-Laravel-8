<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllBrand(Request $request)
    {
    	$brands = Brand::latest()->paginate(5);
    	return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
    	$validated = $request->validate([
	        'brand_name' => 'required|unique:brands|max:20',
	        'brand_image' => 'required|mimes:jpg,jpeg,png',
	    ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.unique' => 'Already Taken This Brand',
        ]);

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        $img_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$img_gen);
        $last_img = 'image/brand/'.$img_gen;

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $last_img;
        $brand->save();

        return Redirect()->back()->with('success', 'Brand Inserted Successfully!'); 
    }

    public function Edit($id)
    {
    	$brands = Brand::find($id);
    	return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id)
    {
    	$validated = $request->validate([
	        'brand_name' => 'required|max:20',
	    ],
        [
            'brand_name.required' => 'Please Input Brand Name',
        ]);

        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {
        	unlink($old_image);
        	$name_gen = hexdec(uniqid());
	        $img_ext = strtolower($brand_image->getClientOriginalExtension());
	        $img_name = $name_gen.'.'.$img_ext;
	        $up_location = 'image/brand/';
	        $last_img = $up_location.$img_name;
	        $brand_image->move($up_location,$img_name);

	        $brand->brand_image = $last_img;
	        $brand->update();
	        return Redirect()->route('all.brand')->with('success', 'Brand Update Successfully!');
        }
        else{
        	$brand->update();
	        return Redirect()->route('all.brand')->with('success', 'Brand Update Successfully!');
        }
    }

    public function Delete($id)
    {
    	$brand = Brand::find($id);
    	$image = $brand->brand_image;
    	unlink($image);
    	$brand->delete();
    	return Redirect()->back()->with('success', 'Brand Delete Successfully!');
    }


    //.......Muti Image all method.....//

    public function MultiPic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request)
    {
        $request->validate([
          'images' => 'required',
        ],
        [
            'images.required' => 'Please Input Image.',
        ]);

        if ($request->hasfile('images')) {
            $images = $request->file('images');

            foreach($images as $image) {
                 $img_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,200)->save('image/multi/'.$img_gen);
                $last_img = 'image/multi/'.$img_gen;

                $file= new Multipic();
                $file->image = $last_img;
                $file->save();
            }
         }

        return back()->with('success', 'Images uploaded successfully');
    }

    public function Logout()
    {
        AUth::logout();
        return Redirect()->route('login')->with('success', 'User Logout');
    }
}
