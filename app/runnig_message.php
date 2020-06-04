<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class runnig_message extends Model
{
    protected $table = 'runnig message';
    protected $fillable = [
        'from_id','status','to_id'
    ];
}
