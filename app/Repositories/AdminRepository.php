<?php
/**
 * Created by PhpStorm.
 * User: zhaozhaozemin
 * Date: 2018/7/26
 * Time: 下午10:32
 */

namespace App\Repositories;

use App\Repositories\Contracts\AdminInterface;


class AdminRepository extends BaseRepository implements AdminInterface
{
    function model()
    {
        return 'App\Models\Admin';
    }
}