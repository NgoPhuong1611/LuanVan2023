<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class Home extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
