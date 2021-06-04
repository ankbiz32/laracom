<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    public $table = 'enquiries';

   
    public $fillable = [
        'con_name',
        'con_email',
        'con_subject',
        'con_message'
    ];
}
