<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lib\Service\PhoneSend;
use Lib\Constant\ErrorConstant;

class ServiceController extends Controller
{
    public function phoneSend(Request $request)
    {
        $phoneInfo = PhoneSend::send(15700082993, 156498);
        return jsonReturn(ErrorConstant::SUCCESS, $phoneInfo, true);
    }
}
