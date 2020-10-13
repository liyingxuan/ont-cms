<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BountyIdea extends Model
{
    protected $table = "bounty_ideas";

    protected $fillable = [
        'name',
        'email',
        'programming_lang',
        'budget_requested',
        'completion_time',

        'summary',
        'content',
        'status'
    ];
}
