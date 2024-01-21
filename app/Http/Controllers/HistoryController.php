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
use App\Models\User;
use App\Models\ExamHistory;
use Illuminate\Support\Facades\DB;


class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(session()->get('id'));
        if ($user) {
            $user_id = $user->id;
            $history = ExamHistory::select('exam_history.id','exam_history.exam_id','exam.title','exam_history.time_date','exam_history.score')
            ->join('exam', 'exam_history.exam_id', '=', 'exam.id')
            ->where('user_id', $user_id)
            ->get();
        } else {
            return redirect()->to('');
        }

        return view('User.History.index',  ['history' => $history]);
    }
    public function deleteHistory($id){
        ExamHistory::destroy($id);

        return redirect()->to('User/ExamHistory');
    }
    public function indexExamHistory(Request $request, $id){

        $ExamModel = new Exam();
        $exam_id = ExamHistory::find($id)->exam_id;

         $ExamQuestionGroup = new ExamQuestionGroup();
         $ExamGroup = $ExamQuestionGroup::where('exam_id', $exam_id)->get();

         $ExamQuestionSingle = new ExamQuestionSingle();
         $ExamSingle = $ExamQuestionSingle::where('exam_id', $exam_id)->get();

         $ExamToExamPartModel = new ExamToExamPart();
         $ExamPart = $ExamToExamPartModel::where('exam_id', $exam_id)->get();

         //lay part
         $exam_part = ExamPart::get();
         $question = Question::get();
         $question1 = [];
         $question2 = [];
         $question3 = [];
         $question4 = [];
         $question5 = [];
         if (isset($ExamPart[0])) {
            $part1 = ExamPart::where('id', $ExamPart[0]['exam_part_id'])->get();
            $data['part1'] = $part1;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part1[0]['id'] && $b['id'] == $a['question_id']) {

                        array_push($question1, $b);
                    }
                }
            }
            $data['question1'] = $question1;
        }
        if (isset($ExamPart[1])) {
            $part2 = ExamPart::where('id', $ExamPart[1]['exam_part_id'])->get();
            $data['part2'] = $part2;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part2[0]['id'] && $b['id'] == $a['question_id']) {

                        array_push($question2, $b);
                    }
                }
            }
            $data['question2'] = $question2;
        }
        if (isset($ExamPart[2])) {
            $part3 = ExamPart::where('id', $ExamPart[2]['exam_part_id'])->get();
            $data['part3'] = $part3;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part3[0]['id'] && $b['id'] == $a['question_id']) {

                        array_push($question3, $b);
                    }
                }
            }
            $data['question3'] = $question3;
        }
        if (isset($ExamPart[3])) {
            $part4 = ExamPart::where('id', $ExamPart[3]['exam_part_id'])->get();
            $data['part4'] = $part4;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part4[0]['id'] && $b['id'] == $a['question_id']) {

                        array_push($question4, $b);
                    }
                }
            }
            $data['question4'] = $question4;
        }
        if (isset($ExamPart[4])) {
            $part5 = ExamPart::where('id', $ExamPart[4]['exam_part_id'])->get();
            $data['part5'] = $part5;
            foreach ($ExamSingle as $a) {
                foreach ($question as $b) {

                    if ($b['exam_part_id'] == $part5[0]['id'] && $b['id'] == $a['question_id']) {

                        array_push($question5, $b);
                    }
                }
            }
            $data['question5'] = $question5;
        }
        if (isset($ExamPart[5])) {
            $part6 = ExamPart::where('id', $ExamPart[5]['exam_part_id'])->get();
            $data['part6'] = $part6;
            $group = QuestionGroup::where('exam_part_id', $part6[0]['id'])->get();
            $group6 = [];
            foreach ($ExamGroup as $a) {
                foreach ($group as $b) {
                    if ($b['id'] == $a['question_group_id']) {
                        array_push($group6, $b);
                    }
                }
            }
            $data['group6'] = $group6;
            $question6 =Question::where('exam_part_id', $part6[0]['id'])->get();
            $data['question6'] = $question6;

        }
        if (isset($ExamPart[6])) {
            $part7 = ExamPart::where('id', $ExamPart[6]['exam_part_id'])->get();
            $data['part7'] = $part7;
            $group = QuestionGroup::where('exam_part_id', $part7[0]['id'])->get();
            $group7 = [];
            foreach ($ExamGroup as $a) {
                foreach ($group as $b) {
                    if ($b['id'] == $a['question_group_id']) {
                        array_push($group7, $b);
                    }
                }
            }
            $data['group7'] = $group7;
            $question7 = Question::where('exam_part_id', $part7[0]['id'])->get();
            $data['question7'] = $question7;

        }
        
        $data['question'] = $question;
         //lay audios
         $audios= QuestionAudio::get();
         $data['audios'] = $audios;


         $question_answer =QuestionAnswer::get();
         $data['question_answer'] = $question_answer;

         $question_image = QuestionImage::get();
         $data['question_image'] =  $question_image;

         $wrongAnswerQuestions = WrongAnswerQuestion::where('exam_history_id',$id)->get();
         $data['wrongAnswerQuestions'] = $wrongAnswerQuestions;

        return view('User.History.ExamHistory',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
