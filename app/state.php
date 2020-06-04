<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{   
    protected $table = 'state';
    protected $fillable = [
        'id','status'
    ];
}
