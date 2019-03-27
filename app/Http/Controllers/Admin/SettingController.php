<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;

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
}
