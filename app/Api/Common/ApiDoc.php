<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/18
 * Time: 下午3:09
 */

namespace App\Api\Common;

use App\Api\Controllers\BaseController;

/**
 * Class HospitalsController
 * @package App\Api\Controllers
 */
class ApiDoc extends BaseController
{
    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $http = config('app.url', 'http://localhost');
        $prefix = '/api';
        $version = '/v1';
        $url = $http . $prefix . $version;

        $api = [
            '统一说明' => [
                '域名' => $http,
                '数据格式' => 'JSON',
                '数据结构(response字段)' => [
                    'code' => '状态码（1000 | -1）',
                    'info' => '状态信息（success | fail）或报错信息；在HTTP状态码非200时,一般是报错信息',
                    'data' => '数据块',
                    'debug' => '只有内测时某些功能有该字段,用于传递一些非公开数据或调试信息'
                ],
                'url字段' => 'HTTP请求地址; {}表示在链接后直接跟该数据的ID值即可,例:http://api-url/v1/data/77?token=xx,能获取id为77的data信息',
                'method字段' => 'GET / POST',
                'form-data字段' => '表单数据',
                'response字段' => '数据结构',
                'HTTP状态码速记' => [
                    '释义' => 'HTTP状态码有五个不同的类别:',
                    '1xx' => '临时/信息响应',
                    '2xx' => '成功; 200表示成功获取正确的数据; 204表示执行/通讯成功,但是无返回数据',
                    '3xx' => '重定向',
                    '4xx' => '客户端/请求错误; 需检查url拼接和参数; 在我们这会出现可以提示的[message]或需要重新登录获取token的[error]',
                    '5xx' => '服务器错误; 可以提示服务器崩溃/很忙啦~',
                ],
            ],

            '帮助' => $this->help($url),
            '市场' => $this->marketing($url),
            'Bounty' => $this->bounty($url),
            'Bounty Claim' => $this->bountyClaim($url),
            'Requests or Ideas' => $this->requestOrIdea($url),

            'Bounty Ideas' => $this->bountyIdea($url),
            'Test-Net Token' => $this->testNetToken($url),
            '站点文字信息' => $this->siteText($url),
            '站点图片信息' => $this->siteImg($url),
            'dAPP Info' => $this->dappInfo($url),

            'Custodian Collaboration' => $this->custodianCollaboration($url),
            'Custodian Job' => $this->custodianJob($url),
            'Custodian Subscribe' => $this->custodianSubscribe($url),
        ];

        return response()->json(compact('api'));
    }

    /**
     * 帮助
     *
     * @param $url
     * @return array
     */
    public function help($url)
    {
        return [
            '全部帮助' => [
                '说明' => '获取全部帮助列表',
                'url' => $url . '/helps/all',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'title' => '标题',
                            'content' => '内容',
                            'language' => '语言： en | cn',
                            'type' => '类型： Identity | Wallet | Others',
                            'status' => '状态: 1 | 0',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '中文帮助列表' => [
                '说明' => '中文帮助列表',
                'url' => $url . '/helps/list/cn',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'title' => '标题',
                            'type' => '类型： Identity | Wallet | Others'
                        ]
                    ]
                ]
            ],
            '英文帮助列表' => [
                '说明' => '英文帮助列表',
                'url' => $url . '/helps/list/en',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'title' => '标题',
                            'type' => '类型： Identity | Wallet | Others'
                        ]
                    ]
                ]
            ],
            '单个帮助' => [
                '说明' => '获得指定帮助文档；例如获取id为2的：xxx/helps/2',
                'url' => $url . '/helps/{id}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '',
                        'title' => '标题',
                        'content' => '内容',
                        'language' => '语言： en | cn',
                        'type' => '类型： Identity | Wallet | Others',
                        'status' => '状态: 1 | 0',
                        'created_at' => '',
                        'updated_at' => ''
                    ]
                ]
            ]
        ];
    }

    /**
     * 市场文章
     *
     * @param $url
     * @return array
     */
    public function marketing($url)
    {
        return [
            '全部文章' => [
                '说明' => '获取全部列表',
                'url' => $url . '/marketing/all',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'title' => '标题',
                            'content' => '内容',
                            'language' => '语言： en | cn',
                            'type' => '类型： Identity | Wallet | Others',
                            'status' => '状态: 1 | 0',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '指定类型的列表' => [
                '说明' => '例如获取type为bounty的：xxx/marketing/list/bounty',
                'url' => $url . '/marketing/list/{type}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'title' => '标题',
                            'type' => '类型： bounty | official | news | wallet'
                        ]
                    ]
                ]
            ],
            '单个文章' => [
                '说明' => '获得指定的文档；例如获取id为2的：xxx/marketing/2',
                'url' => $url . '/marketing/{id}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '',
                        'title' => '标题',
                        'content' => '内容',
                        'language' => '语言： en | cn',
                        'type' => '类型： bounty | official | news | wallet',
                        'status' => '状态: 1 | 0',
                        'created_at' => '',
                        'updated_at' => ''
                    ]
                ]
            ]
        ];
    }

    /**
     * Bounty
     *
     * @param $url
     * @return array
     */
    public function bounty($url)
    {
        return [
            '全部项目' => [
                '说明' => '获取全部active的列表',
                'url' => $url . '/bounty/all',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'type' => '类型',
                            'name' => '项目名称',
                            'img_url' => '图片url',
                            'summary' => '描述',

                            'content' => '内容',
                            'bonus' => '奖金',
                            'url' => '项目链接',
                            'leader' => '负责人',
                            'team' => '负责团队',
                            'status' => '状态只有active',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '单个项目' => [
                '说明' => '获得指定的项目内容文档；例如获取id为2的：xxx/bounty/2',
                'url' => $url . '/bounty/{id}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '',
                        'type' => '类型',
                        'name' => '项目名称',
                        'img_url' => '图片url',
                        'summary' => '描述',

                        'content' => '内容',
                        'bonus' => '奖金',
                        'url' => '项目链接',
                        'leader' => '负责人',
                        'team' => '负责团队',
                        'status' => '状态: active | in-progress | done | closed',

                        'created_at' => '',
                        'updated_at' => ''
                    ]
                ]
            ]
        ];
    }

    /**
     * Bounty Claim
     *
     * @param $url
     * @return array
     */
    public function bountyClaim($url)
    {
        return [
            '进行中的bounty' => [
                '说明' => '获取全部进度是in-progress的列表',
                'url' => $url . '/bounty-claim/list/in-progress',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => 'ID',
                            'bounty_id' => 'Bounty项目的id',
                            'name' => '申请人姓名（该项优先判断是否有【team_alias】）',
                            'email' => '申请人邮箱',
                            'github_url' => '申请人Github地址',
                            'completion_time' => '预计项目完成的时间',
                            'team' => '团队简介',
                            'plan' => '项目计划',
                            'status' => '状态: unaudited | reject | accept',

                            'schedule' => '进度: in-progress',
                            'team_alias' => '团队别名（如果为空，则显示【name】）',
                            'bounty_name_alias' => '项目别名（如果为空，则显示【bounty_name】）',
                            'project_url' => '项目链接',

                            'bounty_name' => '所属bounty的名称（该项优先判断是否有【bounty_name】）',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '完成中的bounty' => [
                '说明' => '获取全部进度是done的列表',
                'url' => $url . '/bounty-claim/list/done',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => 'ID',
                            'bounty_id' => 'Bounty项目的id',
                            'name' => '申请人姓名（该项优先判断是否有【team_alias】）',
                            'email' => '申请人邮箱',
                            'github_url' => '申请人Github地址',
                            'completion_time' => '预计项目完成的时间',
                            'team' => '团队简介',
                            'plan' => '项目计划',
                            'status' => '状态: unaudited | reject | accept',

                            'schedule' => '进度: done',
                            'team_alias' => '团队别名（如果为空，则显示【name】）',
                            'bounty_name_alias' => '项目别名（如果为空，则显示【bounty_name】）',
                            'project_url' => '项目链接',

                            'bounty_name' => '所属bounty的名称（该项优先判断是否有【bounty_name】）',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '提交申请' => [
                'url' => $url . '/bounty-claim/new',
                'method' => 'POST',
                'params' => [
                    'bounty_id' => 'Bounty项目的id',
                    'name' => '申请人姓名',
                    'email' => '申请人邮箱',
                    'github_url' => '申请人Github地址',
                    'completion_time' => '预计项目完成的时间',
                    'team' => '团队简介',
                    'plan' => '项目计划'
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => 'ID',
                            'bounty_id' => 'Bounty项目的id，【必填项】',
                            'name' => '申请人姓名，【必填项】',
                            'email' => '申请人邮箱，【必填项】',
                            'github_url' => '申请人Github地址',
                            'completion_time' => '预计项目完成的时间（单位：天），【必填项】',
                            'team' => '团队简介，【必填项】',
                            'plan' => '项目计划，【必填项】',
                            'status' => '状态: unaudited | reject | accept',

                            'schedule' => '进度: none | in-progress | done | closed',
                            'project_url' => '项目链接',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Request Or Idea
     *
     * @param $url
     * @return array
     */
    public function requestOrIdea($url)
    {
        return [
            '提交申请' => [
                'url' => $url . '/request-or-idea/new',
                'method' => 'POST',
                'params' => [
                    'name' => '提交者姓名',
                    'email' => '提交者邮箱',
                    'content' => '提交内容'
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => 'ID',
                            'name' => '提交者姓名',
                            'email' => '提交者邮箱',
                            'content' => '提交内容',
                            'status' => '状态: unaudited | reject | accept',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Bounty Idea
     *
     * @param $url
     * @return array
     */
    public function bountyIdea($url)
    {
        return [
            '提交申请' => [
                'url' => $url . '/bounty-idea/new',
                'method' => 'POST',
                'params' => [
                    'name' => '提交者姓名',
                    'email' => '提交者邮箱',
                    'programming_lang' => '编程语言',
                    'budget_requested' => '申请预算',
                    'completion_time' => '完成时间',
                    'summary' => '摘要',
                    'content' => '详情'
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => 'ID',

                            'name' => '提交者姓名',
                            'email' => '提交者邮箱',
                            'programming_lang' => '编程语言',
                            'budget_requested' => '申请预算',
                            'completion_time' => '完成时间',

                            'summary' => '摘要',
                            'content' => '详情',

                            'status' => '状态: unaudited | reject | accept',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Test-Net Token
     *
     * @param $url
     * @return array
     */
    public function testNetToken($url)
    {
        return [
            '提交申请' => [
                'url' => $url . '/test-net-token/new',
                'method' => 'POST',
                'params' => [
                    'name' => '申请人',
                    'phone' => '申请人电话',
                    'email' => '申请人邮箱',
                    'ont' => 'ONT数量',
                    'ong' => 'ONG数量',

                    'address' => '地址',
                    'project_url' => '项目链接',
                    'plan' => '项目计划介绍',
                    'team' => '项目团队简介',
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => 'ID',

                            'name' => '申请人',
                            'phone' => '申请人电话',
                            'email' => '申请人邮箱',
                            'ont' => 'ONT数量',
                            'ong' => 'ONG数量',

                            'address' => '地址',
                            'project_url' => '项目链接',
                            'plan' => '项目计划介绍',
                            'team' => '项目团队简介',

                            'status' => '状态: unaudited | reject | accept',

                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * 站点文字信息
     *
     * @param $url
     * @return array
     */
    public function siteText($url)
    {
        return [
            '全部内容' => [
                'url' => $url . '/site-text/all',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'nickname' => '昵称',
                            'key' => 'Key',
                            'value' => '内容',
                            'language' => '语言： en | cn',
                            'type' => '类型： bounty | official | news | wallet | others',
                            'status' => '状态: 1 | 0',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '中文站点信息' => [
                '说明' => '获得指定类型的中文信息；例如获取type为official的：xxx/site-text/cn/official',
                'url' => $url . '/site-text/list/cn/{type}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'nickname' => '昵称',
                            'key' => 'Key',
                            'value' => '内容',
                            'language' => '语言： cn',
                            'type' => '类型： bounty | official | news | wallet | others',
                            'status' => '状态: 1',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '英文站点信息' => [
                '说明' => '获得指定类型的英文信息；例如获取type为official的：xxx/site-text/en/official',
                'url' => $url . '/site-text/list/en/{type}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [

                            'id' => '',
                            'nickname' => '昵称',
                            'key' => 'Key',
                            'value' => '内容',
                            'language' => '语言： en',
                            'type' => '类型： bounty | official | news | wallet | others',
                            'status' => '状态: 1',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '单个文字信息' => [
                '说明' => '获得指定站点信息；例如获取id为2的：xxx/site-text/2',
                'url' => $url . '/site-text/{id}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '',
                        'nickname' => '昵称',
                        'key' => 'Key',
                        'value' => '内容',
                        'language' => '语言： en | cn',
                        'type' => '类型： bounty | official | news | wallet | others',
                        'status' => '状态: 1 | 0',
                        'created_at' => '',
                        'updated_at' => ''
                    ]
                ]
            ]
        ];
    }

    /**
     * 站点图片信息
     *
     * @param $url
     * @return array
     */
    public function siteImg($url)
    {
        return [
            'Base Url' => 'https://cms.ont.io/uploads/',
            '全部内容' => [
                'url' => $url . '/site-img/all',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'nickname' => '昵称',
                            'key' => 'Key',
                            'img_url' => '图片相对路径',
                            'language' => '语言： en | cn',
                            'type' => '类型： bounty | official | news | wallet | others',
                            'status' => '状态: 1 | 0',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '中文站点图片' => [
                '说明' => '获得指定类型的中文图片；例如获取type为official的：xxx/site-img/cn/official',
                'url' => $url . '/site-img/list/cn/{type}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',
                            'nickname' => '昵称',
                            'key' => 'Key',
                            'img_url' => '图片相对路径',
                            'language' => '语言： cn',
                            'type' => '类型： bounty | official | news | wallet | others',
                            'status' => '状态: 1',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '英文站点图片' => [
                '说明' => '获得指定类型的英文图片；例如获取type为official的：xxx/site-img/en/official',
                'url' => $url . '/site-img/list/en/{type}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [

                            'id' => '',
                            'nickname' => '昵称',
                            'key' => 'Key',
                            'img_url' => '图片相对路径',
                            'language' => '语言： en',
                            'type' => '类型： bounty | official | news | wallet | others',
                            'status' => '状态: 1',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '单张图片信息' => [
                '说明' => '获得指定站点信息；例如获取id为2的：xxx/site-img/2',
                'url' => $url . '/site-img/{id}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '',
                        'nickname' => '昵称',
                        'key' => 'Key',
                        'img_url' => '图片相对路径',
                        'language' => '语言： en | cn',
                        'type' => '类型： bounty | official | news | wallet | others',
                        'status' => '状态: 1 | 0',
                        'created_at' => '',
                        'updated_at' => ''
                    ]
                ]
            ]
        ];
    }

    /**
     * Dapp Info
     *
     * @param $url
     * @return array
     */
    public function dappInfo($url)
    {
        return [
            '全部信息' => [
                '说明' => '获取全部启用的列表',
                'url' => $url . '/dapp-info/all',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',

                            'name' => '项目名称',
                            'url' => '项目链接',
                            'img_url' => '图片url',
                            'summary' => '描述',
                            'content' => '内容',

                            'github_url' => 'GitHub链接',
                            'contract_hash' => '合约Hash',
                            'project_name' => '对应接口的项目名称',
                            'type' => 'wallet | dapp | official | game | other',
                            'schedule' => 'coming-soon | online | other',

                            'status' => '状态只有1',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '指定列表' => [
                '说明' => '获取指定列表：',
                '例子1' => '获取【type的wallet】的列表：/dapp-info/list?type=wallet',
                '例子2' => '获取【schedule是online】的列表：/dapp-info/list?schedule=online',
                '例子3' => '获取【type的wallet】且【schedule是online】的列表：/dapp-info/list?type=wallet&schedule=online',
                'url' => $url . '/dapp-info/list?type=wallet',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        [
                            'id' => '',

                            'name' => '项目名称',
                            'url' => '项目链接',
                            'img_url' => '图片url',
                            'summary' => '描述',
                            'content' => '内容',

                            'github_url' => 'GitHub链接',
                            'contract_hash' => '合约Hash',
                            'project_name' => '对应接口的项目名称',
                            'type' => 'wallet | dapp | official | game  | other',
                            'schedule' => 'coming-soon | online | other',

                            'status' => '状态只有1',
                            'created_at' => '',
                            'updated_at' => ''
                        ]
                    ]
                ]
            ],
            '单个内容' => [
                '说明' => '获得指定的项目内容文档；例如获取id为2的：xxx/dapp-info/2',
                'url' => $url . '/dapp-info/{id}',
                'method' => 'GET',
                'params' => [],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'id' => '',

                        'name' => '项目名称',
                        'url' => '项目链接',
                        'img_url' => '图片url',
                        'summary' => '描述',
                        'content' => '内容',

                        'github_url' => 'GitHub链接',
                        'contract_hash' => '合约Hash',
                        'project_name' => '对应接口的项目名称',
                        'type' => 'wallet | dapp | official | game  | other',
                        'schedule' => 'coming-soon | online | other',

                        'status' => '状态只有1',
                        'created_at' => '',
                        'updated_at' => ''
                    ]
                ]
            ],
            '提交信息' => [
                '说明' => '用户提交新的申请',
                'url' => $url . '/dapp-info/new',
                'method' => 'POST',
                'params' => [
                    'name' => 'Name of the dAPP',
                    'url' => 'Project website',
                    'img_url' => 'Logo，暂时只支持一张',
                    'summary' => 'Short description',
                    'content' => 'Full description',

                    'ont_id' => 'ONT ID',
                    'dapp_screen_urls' => 'dAPP Screen Shot，暂时只支持一张',
                    'telegram' => '',
                    'twitter' => '',
                    'discord' => '',

                    'qq' => '',
                    'github_url' => '',
                    'contract_hash' => '',
                    'abi' => '',
                    'byte_code' => '',

                    'token_name' => '项目GitHub链接',
                    'token_type' => '项目合约Hash',
                    'donate_address' => '项目合约Hash',
                    'type' => '对应前端的【Category】；项目类型；前端使用下拉框，内含值只能为这五种：wallet | dapp | official | game  | other',
                    'schedule' => '项目进度；前端使用下拉框，内含值只能为这三种：coming-soon | online | other',
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => []
                ]
            ],
            '上传图片' => [
                '说明' => '用户上传图片；Logo或者是Screen。一次只能上传一张图片。',
                'url' => $url . '/dapp-info/upload',
                'method' => 'POST',
                'params' => [
                    'logo' => '【文件】；二选一的参数，这个是上传Logo，会压缩成300*300',
                    'screen' => '【文件】；二选一的参数，这个是上传截屏，不会压缩'
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => [
                        'url' => ''
                    ]
                ]
            ]
        ];
    }

    /**
     * Custodian 官网申请合作
     *
     * @param $url
     * @return array
     */
    public function custodianCollaboration($url)
    {
        return [
            '提交申请' => [
                'url' => $url . '/custodian-collaboration/new',
                'method' => 'POST',
                'params' => [
                    'name' => '提交者姓名，【必填项，否则无法入库】',
                    'company' => '提交者公司，【必填项，否则无法入库】',
                    'email' => '提交者邮箱，【必填项，否则无法入库】',
                    'phone' => '提交者手机，【必填项，否则无法入库】',
                    'message' => '留言，【必填项，否则无法入库】',
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => []
                ]
            ]
        ];
    }

    /**
     * Custodian 官网申请加入
     *
     * @param $url
     * @return array
     */
    public function custodianJob($url)
    {
        return [
            '提交申请' => [
                'url' => $url . '/custodian-job/new',
                'method' => 'POST',
                'params' => [
                    'name' => '提交者姓名，【必填项，否则无法入库】',
                    'email' => '提交者邮箱，【必填项，否则无法入库】',
                    'phone' => '提交者手机，【必填项，否则无法入库】',
                    'message' => '留言，【必填项，否则无法入库】',
                    'linkedin_url' => '领英URL，【必填项，否则无法入库】',

                    'resume_url' => '上传简历的URL；【暂不开放】'
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => []
                ]
            ]
        ];
    }

    /**
     * Custodian 官网申请订阅
     *
     * @param $url
     * @return array
     */
    public function custodianSubscribe($url)
    {
        return [
            '提交申请' => [
                'url' => $url . '/custodian-subscribe/new',
                'method' => 'POST',
                'params' => [
                    'email' => '提交者邮箱，【必填项，否则无法入库】',
                ],
                'response' => [
                    'code' => '',
                    'info' => '',
                    'data' => []
                ]
            ]
        ];
    }
}
