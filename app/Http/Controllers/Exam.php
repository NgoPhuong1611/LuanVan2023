<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('user.exam.index');
    }

    public function testListen()
    {
        return view('user.exam.fullTestListen');
    }

    public function testRead()
    {
        return view('user.exam.fullTestReading');
    }
}
