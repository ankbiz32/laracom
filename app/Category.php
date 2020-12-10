<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
     //category has childs
    public function childs() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
