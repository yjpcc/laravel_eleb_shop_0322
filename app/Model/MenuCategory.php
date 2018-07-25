<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable=['name','type_accumulation','shop_id','des','is_selected'];

    public function shop(){
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
