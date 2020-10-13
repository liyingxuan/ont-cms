<?php

namespace App\Api\Controllers;

use App\CustodianCollaboration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class CustodianCollaborationController extends Controller
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
            'company' => $request->get('company'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'message' => $request->get('message'),

            'status' => '0'
        ];

        return RetJson::format(CustodianCollaboration::create($data));
    }
}
