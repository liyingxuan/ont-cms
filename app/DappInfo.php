<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DappInfo extends Model
{
    protected $table = "dapp_infos";

    protected $fillable = [
        'title',
        'url',
        'img_url',
        'summary',
        'content',

        'ont_id',
        'dapp_screen_urls',
        'telegram',
        'twitter',
        'discord',

        'qq',
        'github_url',
        'contract_hash',
        'abi',
        'byte_code',

        'token_name',
        'token_type',
        'donate_address',
        'type',
        'schedule', // 'coming-soon' => 'Coming Soon', 'online' => 'Online'

        'priority',
        'status' // 状态：'1' => '启用', '0' => '禁用', '2' => '未审核'
    ];
}
