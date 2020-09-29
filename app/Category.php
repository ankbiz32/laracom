<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     //category has childs
    public function childs() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }
}
