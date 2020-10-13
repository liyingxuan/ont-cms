<?php

namespace App\Api\Controllers;

use App\CustodianSubscribe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;
use Illuminate\Support\Facades\Mail;

class CustodianSubscribeController extends Controller
{
    /**
     * 用户通过前端提交申请
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255|email'
        ]);

        $data = [
            'email' => $request->get('email'),
            'status' => '0'
        ];

        /**
         * 发送邮件
         */
        $message = '';
        $to = $data['email'];
        $subject = 'Thank you for subscribing with Onchain Custodian!';
        Mail::send(
            'emails.custodianSubscribe',
            ['content' => $message],
            function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );

        return RetJson::format(CustodianSubscribe::create($data));
    }
}
