<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'id','product_id', 'user_id','price','text','type'
    ];
    //
    public function product(){
        return Product::where('id','=',$this->product_id)->first();
    }
    public function productName(){
        return Product::where('id','=',$this->product_id)->first()->name;
    }
    public function productId(){
        return Product::where('id','=',$this->product_id)->first()->id;
    }
    public function productImage(){
        return Product::where('id','=',$this->product_id)->first()->image;
    }
}
