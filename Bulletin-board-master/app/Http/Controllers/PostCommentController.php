<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentFavorite;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\CommentRequest;

class PostCommentController extends Controller
{
    //
    public function store(CommentRequest $request){
        $comment=new PostComment();
        $comment->comment=$request->comment;
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$request->post_id;
        $comment->event_at=Carbon::now('Asia/Tokyo');
        $comment->save();

        return redirect()->action('PostController@postDetail', ['id' =>$request->post_id,'comment' => $request->comment]);
    }

     public function edit(Request $request,$id){
        $comment=PostComment::find($request->comment_id);
        return view('posts.comment_edit',['comment'=>$comment,'id'=>$id]);
     }

    public function update(CommentRequest $request,$id){
        $comment=PostComment::find($request->comment_id);
        $comment->update_user_id=Auth::id();
        $comment->comment=$request->comment;
        $comment->updated_at=Carbon::now('Asia/Tokyo');
        $comment->save();

        return redirect()->action('PostController@postDetail', ['id' =>$id,'comment' => $request->comment]);
    }

    public function delete(Request $request,$id){
        $comment_id=$request->comment_id;

        \DB::table('post_comments')
             ->where('id',$comment_id)
             ->delete();

             return redirect('/top');
     }

     public function postCommentFavorite(Request $request)
    {
    $user_id = Auth::user()->id;
    $post_comment_id = $request->post_comment_id;
    $already_liked = PostCommentFavorite::where('user_id', $user_id)->where('post_comment_id', $post_comment_id)->first();
    if (!$already_liked) {
        $like = new postCommentFavorite;
        $like->post_comment_id = $post_comment_id;
        $like->user_id = $user_id;
        $like->save();
    } else {
        postCommentFavorite::where('post_comment_id', $post_comment_id)->where('user_id', $user_id)->delete();
    }
     $post_comment_favorites_count = PostComment::withCount('postCommentFavorites')->findOrFail($post_comment_id)->post_comment_favorites_count;
    $param = [
        'post_comment_favorites_count' => $post_comment_favorites_count,
    ];
    return response()->json($param);
    }

}
