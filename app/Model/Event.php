<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function eventprize(){
        return $this->hasMany(EventPrize::class,'events_id','id');
    }
}
