<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllService()
    {
        $services = Service::latest()->get();
        return view('admin.service.index', compact('services'));
    }

    public function AddService(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:services|max:50',
            'description' => 'required|unique:services|max:300',
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->save();

        return Redirect()->back()->with('success', 'Service Add Successfully!');
    }

    public function Edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:300',
        ]);

        $service = Service::find($id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->update();

        return Redirect()->route('all.service')->with('success', 'Service Update Successfully!');
    }

    public function Delete($id)
    {
        $service = Service::find($id);
        $service->delete();

        return Redirect()->back()->with('success', 'Service Delete Successfully!');
    }
}
