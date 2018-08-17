<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\UserTrait;
use Auth;
use App\Models\User;

class IndexController extends Controller
{
    use UserTrait;


    public function index()
    {
        $user1 = factory(User::class)->make();
        $user2 = factory(User::class, 6)->make();
        $user3 = factory(User::class, 5)->states('delinquent')->make();
        $user4 = factory(User::class, 5)->states('delinquent', 'address')->make();
        dd($user1, $user2, $user3, $user4);
//        dd(Auth::guard('admin')->user(), Auth::user());
//        dd($this->getUserRepository()->find('*', 1), $this->getUserRepository()->getByPhone('phone', 15700082993));
    }

    public  function  testFactory()
    {

    }
}
