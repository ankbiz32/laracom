<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','img_src'
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_iso_code', 'country_iso_code');
    }

    public function Product()
    {
        return $this->hasMany('App\Product');
    }

}
