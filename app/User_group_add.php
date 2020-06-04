<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_group_add extends Model
{
    //
    protected $fillable = [
        'user_id','group_id'
    ];
    protected $table = 'user_group_add';
}
