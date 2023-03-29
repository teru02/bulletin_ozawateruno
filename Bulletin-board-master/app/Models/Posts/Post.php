<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function subCategory(){
        return $this->belongsTo('App\Models\Posts\PostSubCategory','post_sub_category_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function users(){
        return $this->belongsToMany('App\Models\Users\User')->withTimestamps();
    }

    public function postFavorites(){
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function isFavoritedBy($user): bool {
        return postFavorite::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}
