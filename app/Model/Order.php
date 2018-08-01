<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['status'];

    public function status()
    {
        $status=['-1'=>'已取消','0'=>'待支付','1'=>'待发货','2'=>'待确认','3'=>'完成'];
        return $status[$this->status];
    }
}
