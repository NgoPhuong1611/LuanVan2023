<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        return view('Admin/Admin/index');
    }

    public function detail()
    {
        return view('Admin/Admin/detail');
    }
}
