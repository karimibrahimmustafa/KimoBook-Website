<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id','user', 'text'
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user');
    }  
}
