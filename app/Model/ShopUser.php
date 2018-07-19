<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ShopUser extends Authenticatable
{

    use Notifiable;

    protected $fillable=['name','email','password','shop_id','status'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
}
