<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/6
 * Time: 15:05
 */

namespace App\Services\Redis;


class DownRedis extends AbstractRedis
{
    const UP_CHANCE = 'down_hundred_user_info';
    const EXIST_PRO = 'down_hundred_pro';
    const AD_TYPE = 'advertisement';
    const FREE_TYPE = "free";

    public function setUpChance($userId, $userInfo)
    {
        return $this->redis::hset(self::UP_CHANCE, $userId,  json_encode($userInfo));
    }

    public function getUpChance($userId)
    {
        return $this->redis::hget(self::UP_CHANCE, $userId);
    }

    public function setAdProbability($pro)
    {
        return $this->redis::hset(self::EXIST_PRO, self::AD_TYPE,  $pro);
    }

    public function getAdProbability()
    {
        return $this->redis::hget(self::EXIST_PRO, self::AD_TYPE);
    }

    public function setFreeProbability($pro)
    {
        return $this->redis::hset(self::EXIST_PRO, self::FREE_TYPE,  $pro);
    }

    public function getFreeProbability()
    {
        return $this->redis::hget(self::EXIST_PRO, self::FREE_TYPE);
    }
}