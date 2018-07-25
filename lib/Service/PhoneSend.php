<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/25
 * Time: 15:22
 */

namespace Lib\Service;


class PhoneSend
{
    public static function send($mobile, $content)
    {
        $self = new self;
        $param = array(
            'mobile' => $mobile,
            'app_key' => config('services.phone')['app_key'],
            'content' => $content . " "
        );
        $param['sign'] = $self->generateSign($param, config('services.phone')['key']);
        return $self->httpPost(config('services.phone')['url'], $param);
    }

    private function generateSign($params, $key)
    {
        ksort($params);
        $stringToBeSigned = $key;
        foreach ($params as $k => $v) {
            if ("@" != substr($v, 0, 1))//判断是不是文件上传
            {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $key;
        return strtoupper(md5($stringToBeSigned));
    }

    private function httpPost($url, $post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        if(curl_errno($ch)) {
            exit("error" . curl_error($ch));
        }
        curl_close($ch);
        //打印获得的数据
        return json_decode($output, true);
    }
}