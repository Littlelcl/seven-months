<?php
/**
 * Created by PhpStorm.
 * User: zhaozhaozemin
 * Date: 2018/7/26
 * Time: 下午10:35
 */

namespace App\Modules;
use App\Repositories\AdminRepository;

trait adminTrait
{
    private $adminRepository;

    protected function getUserRepository()
    {
        !isset($this->adminRepository) && $this->adminRepository = app(AdminRepository::class);
        return $this->adminRepository;
    }
}