<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/26
 * Time: 17:02
 */

namespace App\Repositories;
use App\Repositories\Contracts\UserInterface;


class UserRepository extends BaseRepository implements UserInterface
{
    function model()
    {
        return 'App\Models\User';
    }

    public function getByPhone($column = '*', string $phone)
    {
           return $this->model->where('phone', $phone)->select($column)->first();
    }
}