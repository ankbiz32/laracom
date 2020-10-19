<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Product;
use App\Attribute;
use App\AttributeDetail;

class ProductAttribute extends Model
{
    /**
     * @var string
     */
    public $table = 'product_attributes';

    /**
     * @var array
     */
    public $fillable = [
        'product_id',
        'attribute_id',
        'attribute_detail_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id'  => 'integer',
        'attribute_id'  => 'integer',
        'attribute_detail_id'  => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'nullable|integer',
        'attribute_id' => 'nullable|integer',
        'attribute_detail_id' => 'nullable|integer',

    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function attributeDetail(){
        return $this->belongsTo(AttributeDetail::class, 'attribute_detail_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
