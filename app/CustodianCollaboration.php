<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustodianCollaboration extends Model
{
    protected $table = "custodian_collaborations";

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'message',

        'status',
        'processing_info',
        'processing_person'
    ];
}
