<?php

namespace App\Api\Controllers;

use App\BountyIdea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class BountyIdeaController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(BountyIdea::all());
    }

    /**
     * 获得某个类型下的列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $data = BountyIdea::where('status', $request['status'])
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
        $data = BountyIdea::where('id', $request['id'])->first();

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
            'email' => $request->get('email'),
            'programming_lang' => $request->get('programming_lang'),
            'budget_requested' => $request->get('budget_requested'),
            'completion_time' => $request->get('completion_time'),

            'summary' => $request->get('summary'),
            'content' => $request->get('content'),

            'status' => 'unaudited'
        ];

        return RetJson::format(BountyIdea::create($data));
    }
}
