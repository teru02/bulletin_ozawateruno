<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Posts\Post;
use Carbon\Carbon;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostComment;


class PostController extends Controller
{
    //
    public function index(){
        $posts=Post::get();
        return view('posts.index',['posts'=>$posts]);
    }

    public function postCreateView(){
        $sub_category=\DB::table('post_sub_categories')->get();
        return view('posts.create',['sub_category'=>$sub_category]);
    }

    public function newPost(Request $request){
        $user_id=Auth::id();
        $event_at=Carbon::now('Asia/Tokyo');
        Post::create([
        'user_id'=>$user_id,
        'post_sub_category_id'=>$request->sub_category_id,
        'title'=>$request->title,
        'post'=>$request->post,
        'event_at'=>$event_at
        ]);
        return redirect("/top");
    }

    public function postDetail($id){
        $post=Post::find($id);
        $comment=PostComment::get();
        return view('posts.detail',['post'=>$post,'comment'=>$comment]);
    }

    public function postEdit($id){
        $sub_category=\DB::table('post_sub_categories')->get();
        $post=Post::find($id);
        $post_subcategory=$post->subCategory->sub_category;
        return view('posts.edit',['post'=>$post,'sub_category'=>$sub_category,'post_subcategory'=>$post_subcategory]);
    }

    public function postUpdate(Request $request,$id){
        $post=Post::find($id);
        $post->user_id=Auth::id();
        $post->post_sub_category_id=$request->sub_category_id;
        $post->title=$request->title;
        $post->post=$request->post;

        $post->save();
        return redirect(route('detail',$id));
    }
}
