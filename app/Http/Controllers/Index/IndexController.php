<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\UserTrait;

class IndexController extends Controller
{
    use UserTrait;
    private $user;


    public function index()
    {
        dd($this->getUserRepository()->find('*', 1), $this->getUserRepository()->getByPhone('phone', 15700082993));
    }
}
