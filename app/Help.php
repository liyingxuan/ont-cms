<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $table = "helps";

    protected $fillable = [
        'title',
        'content',
        'language',
        'type',
        'status'
    ];
}
