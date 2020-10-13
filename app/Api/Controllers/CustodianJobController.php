<?php

namespace App\Api\Controllers;

use App\CustodianJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class CustodianJobController extends Controller
{
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
            'phone' => $request->get('phone'),
            'message' => $request->get('message'),
            'linkedin_url' => $request->get('linkedin_url'),

            'resume_url' => $request->get('resume_url'),
            'status' => '0'
        ];

        return RetJson::format(CustodianJob::create($data));
    }
}
