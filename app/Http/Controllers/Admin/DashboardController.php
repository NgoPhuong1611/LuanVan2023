<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.Home.index');
    }
}
