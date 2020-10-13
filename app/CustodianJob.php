<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustodianJob extends Model
{
    protected $table = "custodian_jobs";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'linkedin_url',

        'resume_url',
        'status',
        'processing_info',
        'processing_person'
    ];
}
