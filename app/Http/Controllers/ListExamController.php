<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\Exam;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Transaction;

class ListExamController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả đề thi
        $examModel = new Exam();
        $exams = $examModel->all();

        // Lấy thông tin người dùng
        $userId = session()->get('id');
        $user = User::find($userId);

        // Lấy danh sách các đề thi đã mua của người dùng từ bảng transaction
        $purchasedExams = Transaction::where('user_id', $userId)->pluck('title')->toArray();

        // Gán trạng thái đã mua cho từng đề thi trong danh sách
        foreach ($exams as &$exam) {
            $exam['purchased'] = in_array($exam['title'], $purchasedExams);
        }

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
