<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'amount', 'currency', 'description','file_number','capturer','payment_type',
    ];

}
