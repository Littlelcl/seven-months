<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/9
 * Time: 15:18
 */

namespace App\Services\Transformer;


class AdvertisementTransformer extends AbstractTransformer
{
    protected function doTransformer($data, $keys = [])
    {
        $res = [
            'id'         => array_get_int($data, 'id'),
            'game_name'  => array_get(config('datas.game_type') , array_get($data, 'game_type')),
            'game_type'  => array_get($data, 'game_type'),
            'yoka'       => array_get_int($data, 'yoka'),
            'other'      => array_get_int($data, 'other'),
            'updated_at' => array_get($data, 'updated_at'),
        ];
        return $res;
    }
}