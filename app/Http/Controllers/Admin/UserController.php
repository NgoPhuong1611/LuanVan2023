<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('Admin/User/index');
    }
    public function detail()
    {
        return view('Admin/User/detail');
    }
}
