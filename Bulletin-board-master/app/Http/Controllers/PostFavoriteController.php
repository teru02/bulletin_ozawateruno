<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Posts\PostFavorite;
use Illuminate\Support\Facades\Auth;

class PostFavoriteController extends Controller
{
  public function postFavorite(Request $request){
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post_id = $request->post_id; //2.投稿idの取得
    $already_favorited = postFavorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    if (!$already_favorited) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $favorite = new postFavorite; //4.Likeクラスのインスタンスを作成
        $favorite->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
        $favorite->user_id = $user_id;
        $favorite->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        postFavorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $post_favorites_count = Post::withCount('postFavorites')->findOrFail($post_id)->post_favorites_count;
    $param = [
        'post_favorites_count' => $post_favorites_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
  }

}
