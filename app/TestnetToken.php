<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestnetToken extends Model
{
    protected $table = "testnet_tokens";

    protected $fillable = [
        'name',
        'phone',
        'email',
        'ont',
        'ong',

        'address',
        'project_url',
        'plan',
        'team',
        'status'
    ];
}
