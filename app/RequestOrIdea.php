<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestOrIdea extends Model
{
    protected $table = "request_or_ideas";

    protected $fillable = [
        'name',
        'email',
        'content',
        'status'
    ];
}
