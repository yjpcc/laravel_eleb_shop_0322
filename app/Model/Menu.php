<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=['goods_name','rating','shop_id','category_id','goods_price','des','','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img'];

    public function shop(){
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }

    public function category(){
        return $this->hasOne(MenuCategory::class, 'id', 'category_id');
    }
}
