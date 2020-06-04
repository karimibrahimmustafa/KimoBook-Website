<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'id','admin', 'cover','image','name','about', 'keys'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_group','group_id');
    }
    public function waits()
    {
        return $this->belongsToMany(User::class,'user_group_add','group_id');
    }
    public function Admin()
    {
        $user = User::where('id', '=', $this->admin)->get()->first();
        return $user;
    }
}
