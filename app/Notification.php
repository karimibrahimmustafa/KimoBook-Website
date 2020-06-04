<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = ['post_id', 'from_id', 'user', 'type', 'text','read'];
    
    public function from()
    {
    	return $this->belongsTo(User::class,'from_id');
    }
    public function post()
    {
    	return $this->hasOne(Post::class,'id','post_id');
    }
    public function reading()
    {    
        $this->read = true;
        $this->save();
        return $this;
    }
}
