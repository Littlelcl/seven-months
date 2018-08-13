<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/9
 * Time: 15:05
 */

namespace App\Services\Transformer;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractTransformer
{

    public function transformer($data, $keys = [])
    {
        if (!$data) {
            return [];
        }
        // 映射
        $result = array_map(function ($model) use ($keys) {
            return $this->doTransformer($model, $keys);

        }, $this->getRealData($data));
        // 返回

        // 单个模型
        if ($data instanceof Model) {
            return reset($result);
        }

        return $result;
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function getRealData($data)
    {
        if ($data instanceof Model) {
            return [$data];
        }
        if ($data instanceof Collection) {
            return $data->all();
        }
        if ($data instanceof Arrayable) {
            return $data->toArray();
        }
        //
        if (array_depth($data) == 1) {
            return [$data];
        }

        return (array) $data;
    }

    /**
     * @param Model $model
     * @param array $keys
     *
     * @return array
     */
    abstract protected function doTransformer($model, $keys);
}