<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\Exam;
use Illuminate\Support\Facades\View;

class ListExamController extends Controller
{
    public function index()
    {
        $examModel = new Exam();
        $exams = $examModel->all();
        $data['exam'] = $exams;

        return View::make('User.listExam.listExam', $data);
    }

    public function listListen()
    {
        return view('User.listExam.listTestListen');
    }

    public function listRead()
    {
        return view('User.listExam.listTestRead');
    }

    public function examRandom()
    {
        return view('User.listExam.ExamRandom');
    }
}
