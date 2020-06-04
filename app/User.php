<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_user', 'user1_id', 'user2_id');
    }
    public function friendsWait()
    {
        return $this->belongsToMany(User::class, 'userWait', 'user1_id', 'user2_id');
    }
    public function friendsWait2()
    {
        return $this->belongsToMany(User::class, 'userWait', 'user2_id', 'user1_id');
    }
    public function details()
    {
        return $this->hasOne('App\Detail', 'id');
    }
    public function Messages()
    {
        return $this->hasOne('App\Message', 'id');
    }
    public function Notifications()
    {
        return $this->hasMany('App\Notification', 'user')->where('read', '=', 0)->where('type','<',7);
    }
    public function Requests()
    {
        return $this->hasMany('App\Notification', 'user')->where('read', '=', 0)->where('type','=',7);
    }
    public function pages()
    {
        return $this->hasMany(Page::class, 'admin');
        // return $this->belongsToMany(Page::class, 'user_page','user_id','page_id');
    }
    public function groups_admin()
    {
        return $this->hasMany(Group::class, 'admin');
        // return $this->belongsToMany(Page::class, 'user_page','user_id','page_id');
    }
    public function follows()
    {
        return $this->belongsToMany(Page::class, 'user_follow');
        // return $this->belongsToMany(Page::class, 'user_page','user_id','page_id');
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group', 'user_id');
    }
    public function groupswait()
    {
        return $this->belongsToMany(Group::class, 'user_group_add', 'user_id');
    }
    public function friendsNames()
    {
        return $this->friends->pluck('name');
    }
    public function friendsPage($id)
    {
        $i=0;
        $arr=[];
        foreach ($this->friends as $friend) {
            if ($i == 3) {
                break;
            }
            if ($friend->follows->contains($id)) {
                $i++;
                array_push($arr, $friend);
            }
        }
        return collect($arr);
    }
    public function products(){
            return $this->hasMany('App\Product', 'admin')->orderBy('type');
    }
    public function productsOffer(){
        return $this->products->where('type','=',1);
    }
    public function sold_products(){
        $offers = Offer::where('user_id','=',$this->id)->where('type','=','1')->get();
        $offers2 =  Offer::where('user_id','=',$this->id)->where('type','=','4')->get();
        $offers = $offers->merge($offers2);
        return $offers;
    }
    public function offers(){
        $col1=$this->productsOffer();
        $col2=$this->sold_products()->where('type','=','1');
        $offers = $col1->merge($col2);
        return $offers;
    }
}
