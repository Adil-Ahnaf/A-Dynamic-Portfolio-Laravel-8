<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AdminAccount()
    {
        return view('admin.body.account');
    }

    public function UpdatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->update();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password Changed Successfully!');
        }else{
            return Redirect()->back()->with('warning', 'Your Current Password Is Invalid.');
        }
    }

    public function AdminProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (($user->name != $request->name) OR ($user->email != $request->email)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();

            $notification = array(
                'message' => 'Profile Information Updated!',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{

            $notification = array(
                'message' => 'Nothing Is Updated!',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function UpdatePhoto(Request $request)
    {
       
        $user = User::find(Auth::user()->id);
        $new_pic = $request->file('new_photo');
        $old_pic = $user->profile_photo_path;

        if ($new_pic) {
            if ($old_pic) {
                unlink("storage/".$old_pic);
                $img_gen = hexdec(uniqid()).'.'.$new_pic->getClientOriginalExtension();
                Image::make($new_pic)->resize(300,300)->save('storage/profile-photos/'.$img_gen);
                $last_img = 'profile-photos/'.$img_gen;
                $user->profile_photo_path = $last_img;
                $user->update();

                $notification = array(
                    'message' => 'Profile Photo Updated!',
                    'alert-type' => 'info'
                );
                return Redirect()->back()->with($notification);
            }else{

                $img_gen = hexdec(uniqid()).'.'.$new_pic->getClientOriginalExtension();
                Image::make($new_pic)->resize(300,300)->save('storage/profile-photos/'.$img_gen);
                $last_img = 'profile-photos/'.$img_gen;
                $user->profile_photo_path = $last_img;
                $user->update();

                $notification = array(
                    'message' => 'Profile Photo Updated!',
                    'alert-type' => 'info'
                );
                return Redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Nothing is Updated!',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function DeletePhoto($id)
    {
        $user = User::find(Auth::user()->id);
        $profile_pic = $user->profile_photo_path;

        if($profile_pic){
            unlink("storage/".$profile_pic);
            $user->profile_photo_path = null;
            $user->update();

            $notification = array(
                'message' => 'Profile Photo Is Removed!',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Photo Already Removed!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
