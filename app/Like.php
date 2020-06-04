<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'post_id','user', 'type'
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user');
    }   
}

