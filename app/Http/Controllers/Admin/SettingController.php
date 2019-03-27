<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index(){
        return view('admin.settings');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);
        
        $slug = str_slug($request->name);
        $image = $request->file('image');

        $user = User::findOrFail(Auth::user()->id);

        if(isset($image)){
            //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             //  check category dir is exists
             if (!Storage::disk('public')->exists('profile'))
             {
                 Storage::disk('public')->makeDirectory('profile');
             }

              // delete old post image
            if(Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imagename,$profile);
        }else{
            $imagename = $user->image;
        }

        $user->name  = trim($request->input('name'));
        $user->email = trim($request->input('email'));
        $user->image = $imagename;
        $user->about = trim($request->input('about'));
        $user->save();

        Toastr::success('Profile Successfully Updated :)','Success');
        return redirect()->back();   
    }


    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }
    }













}
