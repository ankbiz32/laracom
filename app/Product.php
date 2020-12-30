<?php

namespace App;
use App\Stock;
use App\Brand;
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
    public function Brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function ProductDescription(){
        return $this->hasOne(ProductDescription::class, 'product_id');
    }

    public function ProductInventory(){
        return $this->hasOne(ProductInventory::class, 'product_id');
    }

    public function ProductDiscount(){
        return $this->hasOne(ProductDiscount::class, 'product_id');
    }

    public function ProductSeo(){
        return $this->hasOne(ProductSeo::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }
    
    public function country(){
        return $this->belongsTo(Country::class, 'country_iso_code', 'country_iso_code');
    }
}
