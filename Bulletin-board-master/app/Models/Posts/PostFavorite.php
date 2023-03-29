<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post__id',
    ];

    public function user(){//いいねしているuser
        return $this->belongsTo('App\Models\Users\User');
    }

    public function post(){//いいねしているpost
        return $this->belongsTo('App\Models\Posts\Post');
    }

}
