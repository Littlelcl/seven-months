<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/26
 * Time: 18:52
 */

namespace App\Repositories\Contracts;


interface UserInterface
{
    public function getByPhone($column = '*', string $phone);
}