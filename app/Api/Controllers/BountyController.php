<?php

namespace App\Api\Controllers;

use App\Bounty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class BountyController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(Bounty::where('status', 'active')->orderBy('id', 'desc')->get());
    }

    /**
     * 获得某一条
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $data = Bounty::where('id', $request['id'])->first();

        return RetJson::format($data);
    }
}
