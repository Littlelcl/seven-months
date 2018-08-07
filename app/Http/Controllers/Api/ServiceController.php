<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lib\Service\PhoneSend;
use Lib\Constant\ErrorConstant;
use App\Jobs\LogWriter;

class ServiceController extends Controller
{
    public function phoneSend(Request $request)
    {
        $phoneInfo = PhoneSend::send(15700082993, 156498);
        return jsonReturn(ErrorConstant::SUCCESS, $phoneInfo, true);
    }

    public function ceshi()
    {
        $time1 = microtime(true);
        for ($i = 0; $i<1000; $i++)
        {
            LogWriter::dispatch('队列')->onQueue('logWriter');
        }
        $time2 = microtime(true);

        for ($i = 0; $i<1000; $i++)
        {
            LogWriter::dispatch('非队列')->onConnection('sync');
        }
        $time3 = microtime(true);
        dd('队列时间：'.($time2-$time1), '非队列时间：'.($time3-$time2));

    }
}
