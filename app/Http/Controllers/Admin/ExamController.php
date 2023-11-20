<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Models\Admin;
use App\Models\Exam;
use App\Models\ExamPart;
use App\Models\ExamQuestionGroup;
use App\Models\ExamQuestionSingle;
use App\Models\ExamToExamPart;
use App\Models\QuestionGroup;
use App\Models\Question;
use Exception;

class ExamController extends Controller
{
    public function index()
{
        $adminModel = new Admin();
        $admin = $adminModel->all();

        $examModel = new Exam();
        $exam = $examModel->all();

        $data['exam'] = $exam;
        $data['admin'] = $admin;

        return view('Admin.Exam.index', $data);
    }

    public function detail()
    {
        // $ExamPartModel = new ExamPartModel();
        // $part = $ExamPartModel->get();
        // $part1 = $ExamPartModel::where('part_number', 1)->get();
        // $part2 = $ExamPartModel::where('part_number', 2)->get();
        // $part3 = $ExamPartModel::where('part_number', 3)->get();
        // $part4 = $ExamPartModel::where('part_number', 4)->get();
        // $part5 = $ExamPartModel::where('part_number', 5)->get();
        // $part6 = $ExamPartModel::where('part_number', 6)->get();
        // $part7 = $ExamPartModel::where('part_number', 7)->get();
        // $datas['part1'] = $part1;
        // $datas['part2'] = $part2;
        // $datas['part3'] = $part3;
        // $datas['part4'] = $part4;
        // $datas['part5'] = $part5;
        // $datas['part6'] = $part6;
        // $datas['part7'] = $part7;
        return view('Admin/Exam/detail');
    }
    public function save(Request $request)
    {
        $author = 1; // Sửa nếu cần thiết
        $level = $request->input('level');
        $title = $request->input('title');
        $status = $request->input('status');

        $exam = Exam::create([
            'author' => $author,
            'level' => $level,
            'title' => $title,
            'status' => $status,
        ]);

        if (!$exam) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        $exam_id = $exam->id;

        $examPartModel = new ExamPart();
        $examToExamPartModel = new ExamToExamPart();
        $questionGroupModel = new QuestionGroup();
        $examQuestionGroupModel = new ExamQuestionGroup();
        $examQuestionSingleModel = new ExamQuestionSingle();
        $questionModel = new Question();

        // Them exam_to_exam_part
        $parts = $examPartModel->all();

        for ($i = 1; $i <= 7; $i++) {
            $part = $examPartModel->where('part_number', $i)->inRandomOrder()->first();

            $data_part = [
                'exam_id' => $exam_id,
                'exam_part_id' => $part->id,
            ];

            $examToExamPartModel->create($data_part);
        }

        // Them exam_question_group
        $group6 = $questionGroupModel->where('exam_part_id', $parts[5]->id)->inRandomOrder()->take(4)->get();
        $group7 = $questionGroupModel->where('exam_part_id', $parts[6]->id)->inRandomOrder()->take(15)->get();

        foreach ($group6 as $value) {
            $data_group6 = [
                'question_group_id' => $value->id,
                'exam_id' => $exam_id,
            ];
            $examQuestionGroupModel->create($data_group6);
        }

        foreach ($group7 as $value) {
            $data_group7 = [
                'question_group_id' => $value->id,
                'exam_id' => $exam_id,
            ];
            $examQuestionGroupModel->create($data_group7);
        }

        // Them ExamQuestionSingle
        $questions = [
            $questionModel->where('exam_part_id', $parts[0]->id)->orderBy('id')->limit(6)->get(),
            $questionModel->where('exam_part_id', $parts[1]->id)->orderBy('id')->limit(25)->get(),
            $questionModel->where('exam_part_id', $parts[2]->id)->orderBy('id')->limit(39)->get(),
            $questionModel->where('exam_part_id', $parts[3]->id)->orderBy('id')->limit(30)->get(),
            $questionModel->where('exam_part_id', $parts[4]->id)->inRandomOrder()->take(30)->get(),
        ];

        foreach ($questions as $questionSet) {
            foreach ($questionSet as $value) {
                $data_question = [
                    'question_id' => $value->id,
                    'exam_id' => $exam_id,
                ];
                $examQuestionSingleModel->create($data_question);
            }
        }

        return redirect()->to('dashboard/exam');
    }

    public function delete($id)
    {
        ExamQuestionSingle::where('exam_id', $id)->delete();
        ExamToExamPart::where('exam_id', $id)->delete();
        ExamQuestionGroup::where('exam_id', $id)->delete();

        $exam = Exam::find($id);

        if ($exam) {
            $exam->delete();
        }

        return redirect()->to('dashboard/exam');
    }
    public function edit()
    {
    }
    public function update()
    {
        return view('User/Exam/fullTestListen');
    }
}
