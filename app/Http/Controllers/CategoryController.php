<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat()
    {
        $categories = Category::latest()->paginate(5);
        $trashcat = Category::onlyTrashed()->latest()->paginate(3);
    	return view('admin.category.index', compact('categories', 'trashcat'));
    }

    public function AddCat(Request $request)
    {
    	$validated = $request->validate([
	        'category_name' => 'required|unique:categories|max:100',
	    ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.unique' => 'Already Taken This Category',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', 'Category Inserted Successfully!');      
    }

    public function Edit($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::find($id);
        if ($category) {
            $category->category_name = $request->category_name;
            $category->user_id = Auth::user()->id;
            $category->update();
        }
        return Redirect()->route('all.category')->with('success', 'Category Update Successfully!'); 
    }

    public function SoftDelete($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
        }
        return Redirect()->back()->with('success', 'Category Soft Delete Successfully!');
    }

    public function Restore($id)
    {
        $category = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restore Successfully!');
    }

    public function Remove($id)
    {
        $category =  Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Remove Permanently!');
    }
}
