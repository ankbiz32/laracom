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

    public function brands(){
        return $this->hasMany(Brand::class, 'country_iso_code', 'country_iso_code');
    }

    public function categories(){
        return $this->hasMany(Category::class, 'country_iso_code', 'country_iso_code');
    }

    public function tags(){
        return $this->hasMany(Tag::class, 'country_iso_code', 'country_iso_code');
    }
}
