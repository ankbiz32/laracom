<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
