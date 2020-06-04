<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
   
    protected $fillable = [
        'id','admin', 'cover','image','name','about', 'keys'
    ];

    public function admins()
    {
        return $this->belongsToMany(User::class, 'user_page');
    }
    public function Admin()
    {
        $user = User::where('id', '=', $this->admin)->get()->first();
        return $user;   
     }
     public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow');
    }
}
