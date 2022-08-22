<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use Auth;
use Carbon\Carbon;

class PostCommentController extends Controller
{
    //
    public function store(Request $request){
        $comment=new PostComment();
        $comment->comment=$request->comment;
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$request->post_id;
        $comment->event_at=Carbon::now('Asia/Tokyo');
        $comment->save();

        return redirect()->action('PostController@postDetail', ['id' =>$request->post_id]);
    }
}
