<?php

namespace App\Api\Controllers;

use App\BountyClaim;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class BountyClaimController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(BountyClaim::all());
    }

    /**
     * 获得某个进度下的列表
     *
     * @param $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function list($schedule)
    {
        $data = BountyClaim::where('bounty_claims.schedule', $schedule)
            ->leftJoin('bountys', 'bountys.id', '=', 'bounty_claims.bounty_id')
            ->select('bounty_claims.*', 'bountys.name AS bounty_name')
            ->orderBy('bounty_claims.id', 'desc')
            ->get();

        return RetJson::format($data);
    }

    /**
     * 获取进行中的任务
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listInProgress()
    {
        return $this->list('in-progress');
    }

    /**
     * 获取完成的任务
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listDone()
    {
        return $this->list('done');
    }

    /**
     * 获得某一条
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $data = BountyClaim::where('id', $request['id'])->first();

        return RetJson::format($data);
    }

    /**
     * 用户通过前端提交申请
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = [
            'bounty_id' => $request->get('bounty_id'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'github_url' => $request->get('github_url'),
            'completion_time' => $request->get('completion_time'),

            'team' => $request->get('team'),
            'plan' => $request->get('plan'),
            'status' => 'unaudited'
        ];

        return RetJson::format(BountyClaim::create($data));
    }
}
