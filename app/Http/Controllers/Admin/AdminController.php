<?php

namespace App\Controllers\Admin;

use App\Http\Controllers\Controller;

class Admin extends Controller
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
