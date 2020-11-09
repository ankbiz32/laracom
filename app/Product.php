<?php

namespace App;
use App\Stock;
use App\ProductAttribute;
use App\ProductImage;
use App\ProductDescription;
use App\ProductInventory;
use App\ProductDiscount;
use App\ProductSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function ProductDescription(){
        return $this->hasMany(ProductDescription::class, 'product_id');
    }

    public function ProductInventory(){
        return $this->hasMany(ProductInventory::class, 'product_id');
    }

    public function ProductDiscount(){
        return $this->hasMany(ProductDiscount::class, 'product_id');
    }

    public function ProductSeo(){
        return $this->hasMany(ProductSeo::class, 'product_id');
    }
}
