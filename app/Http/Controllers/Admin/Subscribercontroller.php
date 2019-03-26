<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Subscriber;
use Auth;

class Subscribercontroller extends Controller
{

    public function index(){
    	$subscribers = Subscriber::latest()->get();
    	return view('admin.subscriber',compact('subscribers'));
    }


    public function destroy($id){
    	$subscriber = Subscriber::findOrFail($id);
    	$subscriber->delete();
    	Toastr::success('Subscriber Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
