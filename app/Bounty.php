<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bounty extends Model
{
    protected $table = "bountys";

    protected $fillable = [
        'type',
        'name',
        'img_url',
        'summary',
        'content',

        'bonus',
        'leader',
        'status' // 状态：'active' => 'Active','done' => 'Done','closed' => 'Closed'
    ];

    /**
     * 为BountyClaimController引入Bounty的内容，提供form使用项目名称。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bountyClaim()
    {
        return $this->hasOne(BountyClaim::class);
    }
}
