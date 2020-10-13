<?php

namespace App\Api\Controllers;

use App\RequestOrIdea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class RequestOrIdeaController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(RequestOrIdea::all());
    }

    /**
     * 获得某个类型下的列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $data = RequestOrIdea::where('status', $request['status'])
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
        $data = RequestOrIdea::where('id', $request['id'])->first();

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
            'content' => $request->get('content'),

            'status' => 'unaudited'
        ];

        return RetJson::format(RequestOrIdea::create($data));
    }
}
