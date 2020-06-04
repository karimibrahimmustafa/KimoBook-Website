<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['id'];
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
