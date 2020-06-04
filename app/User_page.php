<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_page extends Model
{
    //
    protected $fillable = [
        'user_id','page_id'
    ];
    protected $table = 'user_page';

}
