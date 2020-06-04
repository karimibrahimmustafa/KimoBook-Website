<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id','user', 'text', 'read','image','page','page_id','group','group_id','shared'
    ];

    
    public function users()
    {
        return $this->belongsTo(User::class,'user');

    }
    public function pages()
    {
        return $this->belongsTo(Page::class,'page_id');

    }
    public function groups()
    {
        return $this->belongsTo(Group::class,'group_id');

    }
    public function likes()
    {
        return $this->hasMany(Like::class,'post_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }
    public function liked($user)
    {
        $post = Like::where('post_id', '=', $this->id)->where('user','=',$user)->first();    
        if($post == null)
        return 0;
        else
        return $post->type;
    }
    public function share(){
        return Post::find($this->shared);
    }
}
