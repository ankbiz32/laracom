<?php

namespace App;
use App\Stock;
use App\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
}
