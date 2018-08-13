<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/10
 * Time: 15:03
 */

namespace App\Services\Redis;


class CommonRedis extends AbstractRedis
{
    const USER_INFO = '_user_info';
    public function hashSetUserInfo($type, $userId, $userInfo)
    {

        return $this->redis::hset($type.self::USER_INFO, $userId,  json_encode($userInfo));
    }

    public function hashGetUserInfo($type, $userId)
    {
        return $this->redis::hget($type.self::USER_INFO, $userId);
    }
}