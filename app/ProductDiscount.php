<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Product;

class ProductDiscount extends Model
{
    /**
     * @var string
     */
    public $table = 'product_discounts';

    /**
     * @var array
     */
    public $fillable = [
        'product_id',
    ];

    /**
     * The description that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id'  => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'nullable|integer',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
