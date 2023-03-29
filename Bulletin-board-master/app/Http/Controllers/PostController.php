<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Posts\Post;
use Carbon\Carbon;
use App\Models\Users\User;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostCommentFavorite;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{
    //
    public function index(Request $request){
        $my_posts=$request->my_posts;
        $good_posts=$request->good_posts;
        $sub_category_id=$request->sub_category_id;
        $keyword=$request->keyword;
        $query=Post::withCount('comments','postFavorites');
        if(!empty($my_posts)){
            $query->Where('user_id',Auth::id());
         }
        elseif(!empty($good_posts)){
            $query->WhereHas('postFavorites',function($q)use($request){
                $q->where('post_favorites.user_id',Auth::id());
            });
         }
         elseif(!empty($sub_category_id)){
            $query->Where('post_sub_category_id',$sub_category_id);
         }
        elseif(!empty($keyword)){
            $query->WhereHas('subCategory',function($q)use($keyword){
                $q->where('post_sub_categories.sub_category',$keyword);
            })
            ->orWhere('title','like','%'.$keyword.'%')
            ->orWhere('post','like','%'.$keyword.'%');
        }
        $posts=$query->get();
        $main_category=PostMainCategory::get();

        return view('posts.index',['posts'=>$posts,'keyword'=>$keyword,'main_category'=>$main_category]);
    }


    public function postCreateView(){
        $sub_category=\DB::table('post_sub_categories')->get();
        return view('posts.create',['sub_category'=>$sub_category]);
    }

    public function newPost(PostRequest $request){
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
        $post=Post::withCount('comments','postFavorites')->find($id);
        $comment=PostComment::withCount('user','postCommentFavorites')->where('post_id','=',$id)->get();

        return view('posts.detail',['post'=>$post,'comment'=>$comment]);
    }

    public function postEdit($id){
        $sub_category=\DB::table('post_sub_categories')->get();
        $post=Post::find($id);
        $post_subcategory=$post->subCategory->sub_category;
        return view('posts.edit',['post'=>$post,'sub_category'=>$sub_category,'post_subcategory'=>$post_subcategory]);
    }

    public function postUpdate(PostRequest $request,$id){
        $post=Post::find($id);
        $post->user_id=Auth::id();
        $post->post_sub_category_id=$request->sub_category_id;
        $post->title=$request->title;
        $post->post=$request->post;
        $post->updated_at=Carbon::now('Asia/Tokyo');

        $post->save();
        return redirect(route('posts.detail',$id));
    }

    public function delete($id){
        \DB::table('posts')
             ->where('id',$id)
             ->delete();

             return redirect('/top');
    }

}
