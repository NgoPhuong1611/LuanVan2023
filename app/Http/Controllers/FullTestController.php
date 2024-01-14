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
        $user = User::find(session()->get('id'));

        if ($user) {
            $user_id = $user->id;
        } else {
            return view('User.inforUser.Login');
        }

        $data1 = [
            'user_id' => $user_id,
            'exam_id' => $exam_id,
            ];
        $examHistory = ExamHistory::create($data1);
        $exam_history_id = $examHistory->id;


         $Exam = Exam::find($exam_id);
         $ExamGroup = ExamQuestionGroup::where('exam_id',$exam_id )->get();
         $ExamSingle = ExamQuestionSingle::where('exam_id', $exam_id)->get();
         $ExamPart = ExamToExamPart::where('exam_id', $exam_id)->get();
         $part = ExamPart::get();


         //lay part
         $part1 = new ExamPart();
         $part2 = new ExamPart();
         $part3 = new ExamPart();
         $part4 = new ExamPart();
         $part5 = new ExamPart();
         $part6 = new ExamPart();
         $part7 = new ExamPart();
        foreach ($part as $part) {
                foreach ($ExamPart as $items) {
                    if($part['part_number'] == 1 &&$part['id']== $items['exam_part_id'])  $part1=$part;
                    else if($part['part_number'] == 2&&$part['id']== $items['exam_part_id'])  $part2=$part;
                    else if($part['part_number'] == 3&&$part['id']== $items['exam_part_id'])  $part3=$part;
                    else if($part['part_number'] == 4&&$part['id']== $items['exam_part_id'])  $part4=$part;
                    else if($part['part_number'] == 5&&$part['id']== $items['exam_part_id'])  $part5=$part;
                    else if($part['part_number'] == 6&&$part['id']== $items['exam_part_id'])  $part6=$part;
                    else if($part['part_number'] == 7&&$part['id']== $items['exam_part_id'])  $part7=$part;

            }
        }
         $question = Question::get();
         $question1 = [];
         $question2 = [];
         $question3 = [];
         $question4 = [];
         $question5 = [];
         $question6 = [];
         $question7 = [];
         if (isset($part1)) {
            $data['part1'] = $part1;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part1['id'] && $b['id'] == $a['question_id']) {

                        array_push($question1, $b);
                    }
                }
            }
            $data['question1'] = $question1;
        }
        if (isset($part2)) {
            $data['part2'] = $part2;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part2['id'] && $b['id'] == $a['question_id']) {

                        array_push($question2, $b);
                    }
                }
            }
            $data['question2'] = $question2;
        }
        if (isset($part3)) {
            $data['part3'] = $part3;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part3['id'] && $b['id'] == $a['question_id']) {

                        array_push($question3, $b);
                    }
                }
            }
            $data['question3'] = $question3;
        }
        if (isset($part4)) {
            $data['part4'] = $part4;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part4['id'] && $b['id'] == $a['question_id']) {

                        array_push($question4, $b);
                    }
                }
            }
            $data['question4'] = $question4;
        }
        if (isset($part5)) {
            $data['part5'] = $part5;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part5['id'] && $b['id'] == $a['question_id']) {

                        array_push($question5, $b);
                    }
                }
            }
            $data['question5'] = $question5;
        }
        if (isset($part6)) {
            $data['part6'] = $part6;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part6['id'] && $b['id'] == $a['question_id']) {

                        array_push($question6, $b);
                    }
                }
            }
            $data['question6'] = $question6;

            $group = QuestionGroup::where('exam_part_id', $part6['id'])->get();
            $group6 = [];
            foreach ($ExamGroup as $a) {
                foreach ($group as $b) {
                    if ($b['id'] == $a['question_group_id']) {
                        array_push($group6, $b);
                    }
                }
            }
            $data['group6'] = $group6;

        }
        if (isset($part7)) {
            $data['part7'] = $part7;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part7['id'] && $b['id'] == $a['question_id']) {

                        array_push($question7, $b);
                    }
                }
            }
            $data['question7'] = $question7;

            $group = QuestionGroup::where('exam_part_id', $part7['id'])->get();
            $group7 = [];
            foreach ($ExamGroup as $a) {
                foreach ($group as $b) {
                    if ($b['id'] == $a['question_group_id']) {
                        array_push($group7, $b);
                    }
                }
            }
            $data['group7'] = $group7;

        }



        $data['question'] = $question;
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
    public function testSpeaking()
    {
        return view('User.Exam.fullTestSpeaking');
    }
    public function testWriting()
    {
        return view('User.Exam.fullTestWriting');
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
