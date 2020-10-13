<?php

namespace App\Api\Controllers;

use App\MarketingArticles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class MarketingController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(MarketingArticles::all());
    }

    /**
     * 获得某个类型下的列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $data = MarketingArticles::select(array('id', 'title', 'type'))
            ->where('type', $request['type'])
            ->where('status', '1')
            ->orderBy('id')
            ->get()
            ->groupBy('type'); // 可分组

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
        $data = MarketingArticles::where('id', $request['id'])->first();

        return RetJson::format($data);
    }
}
