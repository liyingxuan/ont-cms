<?php

namespace App\Api\Controllers;

use App\TestnetToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class TestNetTokenController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(TestnetToken::all());
    }

    /**
     * 获得某个类型下的列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $data = TestnetToken::where('status', $request['status'])
            ->orderBy('id')
            ->get();

        return RetJson::format($data);
    }

    /**
     * 获得某一条
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $data = TestnetToken::where('id', $request['id'])->first();

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
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'ont' => $request->get('ont'),
            'ong' => $request->get('ong'),

            'address' => $request->get('address'),
            'project_url' => $request->get('project_url'),
            'plan' => $request->get('plan'),
            'team' => $request->get('team'),

            'status' => 'unaudited'
        ];

        return RetJson::format(TestnetToken::create($data));
    }
}
