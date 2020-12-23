<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public function order(){
        return $this->belongsTo(Order::class, 'vendor_payment_id','payment_id');
    }
}
