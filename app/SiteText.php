<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteText extends Model
{
    protected $table = "site_texts";

    protected $fillable = [
        'nickname',
        'key',
        'value',
        'language',
        'type',

        'status'
    ];
}
