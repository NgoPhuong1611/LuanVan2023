<?php

namespace App\Http\Controllers;

use App\Models\FileUser;
use App\Models\Question;
use App\Models\QuestionImage;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MissionTeacherController extends Controller
{
    public function mission(){
        // $mission = FileUser::all(); // Lấy tất cả các giao dịch từ bảng transaction
        
        // return view('user.Teacher.mission.index', ['mission' => $mission]);
        $missions = FileUser::where(function($query) {
            $query->whereNull('teacher_id')
                  ->orWhere('teacher_id', 0);
        })->get();

        return view('User.Teacher.mission.index', ['missions' => $missions]);
    }
    public function showDetail($id)
    {
        $missionDetails = FileUser::with('question')->find($id);
        // dd($missionDetails);
        // Các xử lý khác

        // $questions = Question::all(); // Đây là ví dụ, bạn có thể sửa đổi truy vấn theo yêu cầu của bạn
        $qt = Question::findOrFail($id);
        // dd($rt->id);
        $questions = [
            'id' => $qt->id,
            // 'question_image' => $qt->question_image,
            'exam_part_id' => $qt->exam_part_id,
            'question' => $qt->question,
            // Thêm các thuộc tính khác nếu cần
        ];
  

        $questionImageModel = new QuestionImage();
        $questionImage = $questionImageModel->get();
        $data['question_image'] = $questionImage;
        // Các xử lý khác
    
        // Truyền dữ liệu vào view
        return view('user.Teacher.mission.chamDiem', ['missionDetails' => $missionDetails, 'questions' => $questions]);
    }
}