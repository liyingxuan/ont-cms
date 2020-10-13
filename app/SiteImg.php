<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteImg extends Model
{
    protected $table = "site_imgs";

    protected $fillable = [
        'nickname',
        'key',
        'img_url',
        'language',
        'type',

        'status'
    ];
}
