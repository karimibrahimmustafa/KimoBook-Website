<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //types 0 = no offers , 1 = offers , 3 = sold
    protected $fillable = [
        'id','name', 'image','about','keys','from','to','admin','discription','type','contacts'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'admin');
    }
    public function offers()
    {
        return $this->hasMany(Offer::class, 'product_id');
    }
    public function best_offer()
    {
        return $this->offers()->where('type', '=', 0)->orderBy('price', 'desc')->first();
    }
    public function state($id)
    {
        $offers = $this->offers();
        $bestOffer = $offers->where('user_id', '=',$id)->orderBy('price', 'desc')->first();
        if ($bestOffer == null) {
            return 'none';
        }
        if ($bestOffer->type == 1 ||$bestOffer->type == 4) {
            return 'accepted';
        }
        if ($bestOffer->type == 2) {
            return 'refused';
        }
        if($bestOffer->type == 3){
            return $bestOffer->price;
        }
    }
}
