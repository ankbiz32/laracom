<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\AttributeDetail;
use App\ProductAttribute;

class Attribute extends Model
{
    /**
     * @var string
     */
    public $table = 'attributes';

    /**
     * @var array
     */
    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'         => 'required|unique:attributes,name',
    ];

    public function attributeDetail(){
        return $this->hasMany(AttributeDetail::class, 'attribute_id');
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class, 'attribute_id');
    }
}
