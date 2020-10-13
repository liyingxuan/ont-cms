<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketingArticles extends Model
{
    protected $table = "marketing_articles";

    protected $fillable = [
        'title',
        'content',
        'language',
        'type',
        'status'
    ];
}
