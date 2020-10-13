<?php

namespace App\Api\Controllers;

use App\Help;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class HelpsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(Help::all());
    }

    /**
     * 中文列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listCn()
    {
        $data = Help::select(array('id', 'title', 'type'))
            ->where('status', '1')
            ->where('language', 'cn')
            ->orderBy('id')
            ->get();
//            ->groupBy('type'); // 可分组

        return RetJson::format($data);
    }

    /**
     * 英文列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listEn()
    {
        $data = Help::select('id', 'title', 'type')->where('status', '1')->where('language', 'en')->get();

        return RetJson::format($data);
    }

    /**
     * 获得某一篇
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $data = Help::where('id', $request['id'])->first();

        return RetJson::format($data);
    }
}
