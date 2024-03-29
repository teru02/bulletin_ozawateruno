<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public function posts(){
        return $this->hasMany('App\Models\Posts\Post');
    }

    public function postMainCategory(){
        return $this->belongsTo('App\Models\Posts\PostSMainCategory');
    }
}
