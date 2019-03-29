<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request,$post_id){
    	$this->validate($request,[
    		'comment' => 'required',
    	]);

    	$comment = new Comment();
    	$comment->post_id = $post_id;
    	$comment->user_id = Auth::user()->id;
    	$comment->comment = $request->comment;
    	$comment->save();
    	Toastr::success('Comment successfully published :)','Success');
        return redirect()->back();
    }
}
