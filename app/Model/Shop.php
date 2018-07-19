<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    protected $fillable=['shop_category_id','shop_name','shop_img','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'];

    public function shop_img(){
        return Storage::url($this->shop_img);
    }

    public function shop_user(){
        return $this->hasOne(ShopUser::class, 'shop_id', 'id');
    }

    public function shop_category(){
        return $this->hasOne(ShopCategory::class, 'id', 'shop_category_id');
    }
}
