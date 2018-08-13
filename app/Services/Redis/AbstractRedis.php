<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/6
 * Time: 14:47
 */

namespace App\Services\Redis;
use Illuminate\Support\Facades\Redis;


abstract class AbstractRedis
{
    protected $redis;

    public function  __construct(Redis $redis)
    {
        $this->redis = $redis;
    }


}