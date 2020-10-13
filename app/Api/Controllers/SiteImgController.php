<?php

namespace App\Api\Controllers;

use App\SiteImg;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class SiteImgController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(SiteImg::all());
    }

    /**
     * 中文列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listCn(Request $request)
    {
        $data = SiteImg::where('type', $request['type'])->where('status', '1')->where('language', 'cn')->get();

        return RetJson::format($data);
    }

    /**
     * 英文列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listEn(Request $request)
    {
        $data = SiteImg::where('type', $request['type'])->where('status', '1')->where('language', 'en')->get();

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
        $data = SiteImg::where('id', $request['id'])->first();

        return RetJson::format($data);
    }
}
