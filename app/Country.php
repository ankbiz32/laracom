<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $fillable = [
        'name',
        'language',
    ];

    protected $casts = [
        'id'    => 'integer',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'country_iso_code', 'country_iso_code');
    }
}
