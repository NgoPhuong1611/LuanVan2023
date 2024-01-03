<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
class HomeController extends Controller
{
    public function index()
    {
        return view('User.Home.home');
    }
    public function index2()
    {
        return view('User.Home.homeTeacher');
    }
}
