<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class Subscribercontroller extends Controller
{
    public function store(Request $request){

    	$this->validate($request,[
    		'email' => 'required|email|unique:subscribers'
    	]);

    	$subscriber = new Subscriber();
    	$subscriber->email = trim($request->input('email'));
    	$subscriber->save();

    	Toastr::success('Subscribe Successfully, Thanks :)','Success');
        return redirect()->back();

    }
}
