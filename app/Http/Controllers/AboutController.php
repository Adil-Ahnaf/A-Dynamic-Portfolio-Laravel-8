<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Auth;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllAbout()
    {
        $abouts = HomeAbout::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function CreateAbout()
    {
        return view('admin.about.create');
    }

    public function AddAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:home_abouts|max:100',
            'short_des' => 'required|unique:home_abouts|max:300',
            'long_des' => 'required|unique:home_abouts|max:500',
        ]);

        $about = new HomeAbout;
        $about->title = $request->title;
        $about->short_des = $request->short_des;
        $about->long_des = $request->long_des;
        $about->save();

        return Redirect()->route('all.about')->with('success', 'About Inserted Successfully!'); 
    }

     public function Edit($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.about.edit', compact('about'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'short_des' => 'required|max:300',
            'long_des' => 'required|max:500',
        ]);

        $about = HomeAbout::find($id);
        $about->title = $request->title;
        $about->short_des = $request->short_des;
        $about->long_des = $request->long_des;
        $about->update();

        return Redirect()->route('all.about')->with('success', 'Update Successfully!');
    }

    public function Delete($id)
    {
        $about = HomeAbout::find($id);
        $about->delete();
        return Redirect()->back()->with('success', 'Delete Successfully!');
    }
}
