<?php

namespace App\Api\Controllers;

use App\DappInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;
use App\Api\Helper\SaveImage;

class DappInfoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(
            DappInfo::where('status', '1')
                ->orderBy('priority', 'ASC')
                ->orderBy('title', 'ASC')
                ->get()
        );
    }

    /**
     * 可以根据type或schedule或同时存在获取相关数据
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $retData = null;

        if (isset($request['type']) && isset($request['schedule'])) {
            $retData = DappInfo::where('status', '1')
                ->where('type', $request['type'])
                ->where('schedule', $request['schedule'])
                ->orderBy('priority', 'ASC')
                ->orderBy('title', 'ASC')
                ->get();
        } else if (isset($request['type'])) {
            $retData = DappInfo::where('status', '1')
                ->where('type', $request['type'])
                ->orderBy('priority', 'ASC')
                ->orderBy('title', 'ASC')
                ->get();
        } else if (isset($request['schedule'])) {
            $retData = DappInfo::where('status', '1')
                ->where('schedule', $request['schedule'])
                ->orderBy('priority', 'ASC')
                ->orderBy('title', 'ASC')
                ->get();
        } else {
            $retData = DappInfo::where('status', '1')
                ->orderBy('priority', 'ASC')
                ->orderBy('title', 'ASC')
                ->get();
        }

        return RetJson::format($retData);
    }

    /**
     * 获得某一条
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $data = DappInfo::where('id', $request['id'])->first();

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
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'img_url' => $request->get('img_url'),
            'summary' => $request->get('summary'),
            'content' => $request->get('content'),

            'ont_id' => $request->get('ont_id'),
            'dapp_screen_urls' => $request->get('dapp_screen_urls'),
            'telegram' => $request->get('telegram'),
            'twitter' => $request->get('twitter'),
            'discord' => $request->get('discord'),

            'qq' => $request->get('qq'),
            'github_url' => $request->get('github_url'),
            'contract_hash' => $request->get('contract_hash'),
            'abi' => $request->get('abi'),
            'byte_code' => $request->get('byte_code'),

            'token_name' => $request->get('token_name'),
            'token_type' => $request->get('token_type'),
            'donate_address' => $request->get('donate_address'),
            'schedule' => $request->get('schedule'),
            'type' => $request->get('type'),

            'priority' => 10,
            'status' => '2'
        ];

        return RetJson::format(DappInfo::create($data));
    }

    /**
     * 上传图片
     *
     * @param Request $request
     * @param SaveImage $saveImage
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImg(Request $request, SaveImage $saveImage)
    {
        $logo = $request->file('logo');
        $screen = $request->file('screen');

        if($logo === null && $screen === null) {
            $errMsg = 'The logo or screen is required.';
        } else {
            try {
                if ($logo === null) {
                    $result = $saveImage->save($screen, 'dapp/src', 'screen', 300);
                } else {
                    $result = $saveImage->save($logo, 'dapp/src', 'logo');
                }

                if ($result) {
                    return RetJson::format($result);
                } else {
                    $errMsg = 'It MUST contain a PNG, JPEG/JPG image.';
                }
            } catch (\Exception $e) {
                $errMsg = $e->getMessage();
            }
        }

        return RetJson::formatErrors(['message' => $errMsg]);
    }
}
