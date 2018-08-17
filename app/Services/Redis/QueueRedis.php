<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/17
 * Time: 16:20
 */

namespace App\Services\Redis;


class QueueRedis extends AbstractRedis
{
    const USER_LIST = 'queue_list_user';
    const USER_HASH = 'queue_hash_user';
    const FREE_TYPE = "free";

    public function popQueueUser()
    {
        return $this->redis::rpop(self::USER_LIST);
    }

    public function pushQueueUser($userInfo)
    {
        return $this->redis::lpush(self::USER_LIST, json_encode($userInfo));
    }

    public function blockPopQueueUser($timeout)
    {
        return $this->redis::brpop(self::USER_LIST, $timeout);
    }

    public function setQueueUser($userId, $user)
    {
        return $this->redis::hset(self::USER_HASH, $userId, json_encode($user));
    }

    public function getQueueUser($userId, $user)
    {
        return $this->redis::hget(self::USER_HASH, $userId);
    }
}