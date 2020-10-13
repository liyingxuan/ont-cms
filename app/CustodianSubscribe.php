<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustodianSubscribe extends Model
{
    protected $table = "custodian_subscribes";

    protected $fillable = [
        'email',
        'status',
        'processing_info',
        'processing_person'
    ];
}
