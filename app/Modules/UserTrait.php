<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/7/26
 * Time: 18:34
 */

namespace App\Modules;

use App\Repositories\UserRepository;

trait UserTrait
{
    private $userRepository;

    protected function getUserRepository()
    {
        !isset($this->userRepository) && $this->userRepository = app(userRepository::class);
        return $this->userRepository;
    }
}