<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var string
     */
    public $table = 'countries';

    /**
     * @var array
     */
    public $fillable = [
        'name',
        'language',
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
        'name'         => 'required|unique:countries,name',
        'language'     => 'required',

    ];
}
