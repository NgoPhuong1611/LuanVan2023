<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Exam;
use App\Models\ExamPart;
use App\Models\ExamQuestionGroup;
use App\Models\ExamQuestionSingle;
use App\Models\ExamToExamPart;
use App\Models\QuestionAnswer;
use App\Models\QuestionAudio;
use App\Models\QuestionGroup;
use App\Models\QuestionImage;
use App\Models\Question;
use App\Models\WrongAnswerQuestion;
use App\Models\ExamHistory;
use App\Models\User;


class FullTestController extends Controller
{
    public function index(Request $request, $exam_id)
    {
        $user_id =User::find(session()->get('id'))->id;

        $data1 = [
            'user_id' => $user_id,
            'exam_id' => $exam_id,
            ];
        $examHistory = ExamHistory::create($data1);
        $exam_history_id = $examHistory->id;


         $Exam = Exam::find($exam_id);


         $ExamGroup = ExamQuestionGroup::where('exam_id', $exam_id)->get();
         $ExamSingle = ExamQuestionSingle::where('exam_id', $exam_id)->get();
         $ExamPart = ExamToExamPart::where('exam_id', $exam_id)->get();

         //lay part
         $exam_part = ExamPart::get();

         $part1 = ExamPart::where('id', $ExamPart[0]['exam_part_id'])->get();
         $part2 = ExamPart::where('id', $ExamPart[1]['exam_part_id'])->get();
         $part3 = ExamPart::where('id', $ExamPart[2]['exam_part_id'])->get();
         $part4 = ExamPart::where('id', $ExamPart[3]['exam_part_id'])->get();
         $part5 = ExamPart::where('id', $ExamPart[4]['exam_part_id'])->get();
         $part6 = ExamPart::where('id', $ExamPart[5]['exam_part_id'])->get();
         $part7 = ExamPart::where('id', $ExamPart[6]['exam_part_id'])->get();
         $data['part1'] = $part1;
         $data['part2'] = $part2;
         $data['part3'] = $part3;
         $data['part4'] = $part4;
         $data['part5'] = $part5;
         $data['part6'] = $part6;
         $data['part7'] = $part7;

         //lay group 6,7
         $group = QuestionGroup::where('exam_part_id', $part6[0]['id'])->get();
         $group6 = [];
         foreach ($ExamGroup as $a) {
             foreach ($group as $b) {
                 if ($b['id'] == $a['question_group_id']) {
                     array_push($group6, $b);
                 }
             }
         }
         $group = QuestionGroup::where('exam_part_id', $part7[0]['id'])->get();
         $group7 = [];
         foreach ($ExamGroup as $a) {
             foreach ($group as $b) {
                 if ($b['id'] == $a['question_group_id']) {
                     array_push($group7, $b);
                 }
             }
         }
         $data['group6'] = $group6;
         $data['group7'] = $group7;

         //lay question
         $question = Question::get();
         $question1 = [];
         $question2 = [];
         $question3 = [];
         $question4 = [];
         $question5 = [];
         $question6 =Question::where('exam_part_id', $part6[0]['id'])->get();
         $question7 = Question::where('exam_part_id', $part7[0]['id'])->get();

         foreach ($ExamSingle as $a) {
             foreach ($question as $b) {
                 if ($b['exam_part_id'] == $part1[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question1, $b);
                 } else if ($b['exam_part_id'] == $part2[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question2, $b);
                 } else if ($b['exam_part_id'] == $part3[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question3, $b);
                 } else if ($b['exam_part_id'] == $part4[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question4, $b);
                 } else if ($b['exam_part_id'] == $part5[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question5, $b);
                 }
             }
         }
         $data['question1'] = $question1;
         $data['question'] = $question;
         $data['question2'] = $question2;
         $data['question3'] = $question3;
         $data['question4'] = $question4;
         $data['question5'] = $question5;
         $data['question6'] = $question6;
         $data['question7'] = $question7;

         //lay audios
         $audios= QuestionAudio::get();
         $data['audios'] = $audios;


         $question_answer =QuestionAnswer::get();
         $data['question_answer'] = $question_answer;

         $question_image = QuestionImage::get();
         $data['question_image'] =  $question_image;
         return view('User.Exam.Exam', $data,['exam_history_id' => $exam_history_id]);
    }

    public function testListen()
    {
        return view('User.Exam.fullTestListen');
    }

    public function testRead()
    {
        return view('User.Exam.fullTestReading');
    }


    public function insertWrongAnswer(Request $request)
    {
        // Lấy user_id từ session
        $user_id =User::find(session()->get('id'))->id;


        if (!$user_id) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $question_id = $request->input('question_id');
        $selected_answer = $request->input('selected_answer');
        $exam_history_id = $request->input('exam_history_id');


        $data = [
            'user_id' => $user_id,
            'question_id' => $question_id,
            'selected_answer' => $selected_answer,
            'exam_history_id'=>$exam_history_id,
        ];

        try {
            // Sử dụng Eloquent để tạo WrongAnswerQuestion
            WrongAnswerQuestion::create($data);

            return response()->json(['success' => 'Wrong answer recorded successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error recording wrong answer.'], 500);
        }
    }
    public function score(Request $request){
        $exam_history_id = $request->input('exam_history_id');
        $score = $request->input('score');

        $examHistory = ExamHistory::find($exam_history_id);
            $examHistory->score = $score;
            $examHistory->save(); // Lưu điểm thi mới vào cột score
    }
}
