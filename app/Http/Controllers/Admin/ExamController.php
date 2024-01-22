<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Admin;
use App\Models\Exam;
use App\Models\ExamPart;
use App\Models\ExamQuestionGroup;
use App\Models\ExamQuestionSingle;
use App\Models\ExamToExamPart;
use App\Models\QuestionGroup;
use App\Models\Question;
use App\Models\ExamHistory;
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
        // part
        $past1 =ExamPart::where('part_number', 1)->get();
        $past2 =ExamPart::where('part_number', 2)->get();
        $past3 =ExamPart::where('part_number', 3)->get();
        $past4 =ExamPart::where('part_number', 4)->get();
        $past5 =ExamPart::where('part_number', 5)->get();
        $past6 =ExamPart::where('part_number', 6)->get();
        $past7 =ExamPart::where('part_number', 7)->get();

        $datas['part1'] = $past1;
        $datas['part2'] = $past2;
        $datas['part3'] = $past3;
        $datas['part4'] = $past4;
        $datas['part5'] = $past5;
        $datas['part6'] = $past6;
        $datas['part7'] = $past7 ;
        //question

        // Sử dụng $datas thay vì $data để truyền dữ liệu vào view
        $questions1=Question::where('exam_part_id', $past1[0]['id'])->inRandomOrder()->take(6)->get();
        //$question1 = Question::where('exam_part_id', $datas['part1'][0]['id'])->inRandomOrder()->take(6)->get();
        $questions2=Question::where('exam_part_id', $datas['part2'][0]['id'])->inRandomOrder()->take(25)->get();
        $questions3=Question::where('exam_part_id', $datas['part3'][0]['id'])->inRandomOrder()->take(39)->get();
        $questions4=Question::where('exam_part_id', $datas['part4'][0]['id'])->inRandomOrder()->take(30)->get();
        $questions5=Question::where('exam_part_id', $datas['part5'][0]['id'])->inRandomOrder()->take(30)->get();
        $questions6=Question::where('exam_part_id', $datas['part6'][0]['id'])->get();
        $questions7=Question::where('exam_part_id', $datas['part7'][0]['id'])->get();
        $questions=Question::get();
        $datas['questions1'] = $questions1;
        $datas['questions2'] = $questions2;
        $datas['questions3'] = $questions3;
        $datas['questions4'] = $questions4;
        $datas['questions5'] = $questions5;
        $datas['questions6'] = $questions6;
        $datas['questions7'] = $questions7;
        $datas['questions'] = $questions;



        return view('Admin.Exam.detail', $datas);
    }
    public function save(Request $request)
    {
        $selectedQuestions = $request->input('selectedQuestions');
            // $author =Admin::find(session()->get('id'))->id;
            $authorId = session()->get('id');
            $author =Admin::find($authorId)->id;
            $quantity_coin = $request->input('quantity_coin');
            $level = $request->input('level');
            $title = $request->input('title');
            $status = $request->input('status');
            $exam = Exam::create([
                'author' => $author,
                'quantity_coin'=>$quantity_coin,
                'level' => $level,
                'title' => $title,
                'status' =>$status,
            ]);
            if (!$exam) {
                throw new Exception(UNEXPECTED_ERROR_MESSAGE);
            }
            $exam_id = $exam->id;

            $examPartModel = new ExamPart();
            $examPartModel = new ExamPart();
            $examToExamPartModel = new ExamToExamPart();
            $questionGroupModel = QuestionGroup::get();
            $examQuestionGroupModel = new ExamQuestionGroup();
            $examQuestionSingleModel = new ExamQuestionSingle();
            $questionModel = new Question();


            $questions = [];
            foreach ($selectedQuestions as $questionId) {
                $question = Question::find((int)$questionId);
                if ($question) {
                    $questions[] = $question;
                }
            }
            foreach ($questions as $question) {
                $data_question = [
                    'question_id' => $question->id,
                    'exam_id' => $exam_id,
                ];

                $examQuestionSingleModel->create($data_question);
            }

            $examPartIds = array_unique(array_column($questions, 'exam_part_id'));
            $allExamParts = $examPartModel::whereIn('id', $examPartIds)->get();
            foreach($allExamParts as $part){

                $data_part = [
                    'exam_id' => $exam_id,
                    'exam_part_id' => $part['id'],
                ];

                $examToExamPartModel->create($data_part);
            }
            $groupIds = array_unique(array_column($questions, 'question_group_id'));
            $groups = QuestionGroup::whereIn('id', $groupIds)->get();
            foreach ($groups as $group) {
                $data_group = [
                    'question_group_id' => $group->id,
                    'exam_id' => $exam_id,
                ];

                $examQuestionGroupModel->create($data_group);
            }


        return redirect()->to('dashboard/exam')->with('success', 'Transaction created successfully.');;



    }

    public function delete($id)
    {
        ExamQuestionSingle::where('exam_id', $id)->delete();
        ExamToExamPart::where('exam_id', $id)->delete();
        ExamQuestionGroup::where('exam_id', $id)->delete();
        ExamHistory::where('exam_id', $id)->delete();

        Exam::where('id', $id)->delete();

        return redirect()->to('dashboard/exam');
    }
    public function edit($id)
    {
        $exam = Exam::find($id);

        return view('Admin.Exam.edit', ['exam' => $exam]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity_coin' => 'required',
            'level' => 'required',
            'title' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'author' => Admin::find(session()->get('id'))->id,
            'quantity_coin' => $request->input('quantity_coin'),
            'level' => $request->input('level'),
            'title' => $request->input('title'),
            'status' => $request->input('status'),
        ];

        Exam::find($id)->update($data);

        return redirect()->to('dashboard/exam');
    }
    public function detailradom()
    {
        // part
        $past1 =ExamPart::where('part_number', 1)->get();
        $past2 =ExamPart::where('part_number', 2)->get();
        $past3 =ExamPart::where('part_number', 3)->get();
        $past4 =ExamPart::where('part_number', 4)->get();
        $past5 =ExamPart::where('part_number', 5)->get();
        $past6 =ExamPart::where('part_number', 6)->get();
        $past7 =ExamPart::where('part_number', 7)->get();

        $datas['part1'] = $past1;
        $datas['part2'] = $past2;
        $datas['part3'] = $past3;
        $datas['part4'] = $past4;
        $datas['part5'] = $past5;
        $datas['part6'] = $past6;
        $datas['part7'] = $past7 ;
        //question

        // Sử dụng $datas thay vì $data để truyền dữ liệu vào view
        $questions1=Question::where('exam_part_id', $past1[0]['id'])->inRandomOrder()->take(6)->get();
        //$question1 = Question::where('exam_part_id', $datas['part1'][0]['id'])->inRandomOrder()->take(6)->get();
        $questions2=Question::where('exam_part_id', $datas['part2'][0]['id'])->inRandomOrder()->take(25)->get();
        $questions3=Question::where('exam_part_id', $datas['part3'][0]['id'])->inRandomOrder()->take(39)->get();
        $questions4=Question::where('exam_part_id', $datas['part4'][0]['id'])->inRandomOrder()->take(30)->get();
        $questions5=Question::where('exam_part_id', $datas['part5'][0]['id'])->inRandomOrder()->take(30)->get();
        $questions6=Question::where('exam_part_id', $datas['part6'][0]['id'])->get();
        $questions7=Question::where('exam_part_id', $datas['part7'][0]['id'])->get();
        $questions=Question::get();
        $datas['questions1'] = $questions1;
        $datas['questions2'] = $questions2;
        $datas['questions3'] = $questions3;
        $datas['questions4'] = $questions4;
        $datas['questions5'] = $questions5;
        $datas['questions6'] = $questions6;
        $datas['questions7'] = $questions7;
        $datas['questions'] = $questions;



        return view('Admin.Exam.detailradom', $datas);
    }
    public function saver(Request $request)
    {
           // $author =Admin::find(session()->get('id'))->id;
           $authorId = session()->get('id');
           $author =Admin::find($authorId)->id;
        $level = $request->input('level');
        $title = $request->input('title');
        $status = $request->input('status');

        $exam = Exam::create([
            'author' => $author,
            'level' => $level,
            'title' => $title,
            'status' => $status,
        ]);

        // if (!$exam) {
        //     throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        // }

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
            $questionModel->where('exam_part_id', $parts[4]->id)->orderBy('id')->limit(30)->get(),
            $questionModel->where('exam_part_id', $parts[5]->id)->orderBy('id')->limit(16)->get(),
            $questionModel->where('exam_part_id', $parts[6]->id)->orderBy('id')->limit(54)->get(),
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
}
