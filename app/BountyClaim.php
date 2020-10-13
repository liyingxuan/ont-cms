<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BountyClaim extends Model
{
    protected $table = "bounty_claims";

    protected $fillable = [
        'bounty_id',
        'name',
        'email',
        'github_url',
        'completion_time',

        'team',
        'plan',
        'status', // 状态： 'unaudited' => '未审核','reject' => '已拒绝','accept' => '已批准'

        'team_alias',
        'bounty_name_alias',
        'project_url',
        'schedule' // 进度：'none' => 'None', 'in-progress' => 'In Progress','done' => 'Done','closed' => 'Closed'
    ];

    /**
     * 引入Bounty的内容，提供BountyClaimController的form使用项目名称。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bounty()
    {
        return $this->belongsTo(Bounty::class);
    }
}
