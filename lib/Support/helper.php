<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/24
 * Time: 14:23
 */

if (!function_exists('jsonReturn')){
    function jsonReturn($code_msg, $data, $extralMsg)
    {
        $code_msg = explode('|', $code_msg);
        $msg = $extralMsg ?: $code_msg[1];
        return response()->json(['code' => $code_msg[0], 'data' => $data, 'msg' => $msg]);
    }
}