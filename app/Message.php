<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from_id','to_id', 'text', 'image','read'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class,'from_id');
    }
}
