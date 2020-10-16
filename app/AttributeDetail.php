<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Attribute;
use App\ProductAttribute;

class AttributeDetail extends Model
{
    /**
     * @var string
     */
    public $table = 'attribute_details';

    /**
     * @var array
     */
    public $fillable = [
        'attribute_id',
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attribute_id'  => 'integer',
        'name'          => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'attribute_id' => 'nullable|integer',
        'name'         => 'required',
    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class, 'attribute_detail_id');
    }

}
