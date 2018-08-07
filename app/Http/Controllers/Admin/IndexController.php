<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        dd(Auth::guard('admin')->user(), Auth::guard('web')->user());
    }
}
