<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    protected $fillable = ['content', 'user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function is_liked_by_user()
    {
        $id = Auth::id();

        $likers = [];

        foreach($this->likes as $like):
            array_push($likers, $like->user_id);
        endforeach;

        if(in_array($id, $likers))
        {
            return true;
        } else {
            return false;
        }
    }
}
