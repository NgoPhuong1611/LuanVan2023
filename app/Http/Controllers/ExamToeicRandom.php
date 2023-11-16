<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ExamPart;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\QuestionAudio;
use App\Models\QuestionAnswer;
use App\Models\QuestionImage;
use Illuminate\Support\Facades\DB;

class ExamToeicRandom extends Controller
{
    public function index()
    {
        $ExamPartModel = new ExamPart();
        $exam_part = $ExamPartModel->get();

        $part1 = $ExamPartModel::where('part_number', 1)->inRandomOrder()->get();
        $part2 = $ExamPartModel::where('part_number', 2)->inRandomOrder()->get();
        $part3 = $ExamPartModel::where('part_number', 3)->inRandomOrder()->get();
        $part4 = $ExamPartModel::where('part_number', 4)->inRandomOrder()->get();
        $part5 = $ExamPartModel::where('part_number', 5)->inRandomOrder()->get();
        $part6 = $ExamPartModel::where('part_number', 6)->inRandomOrder()->get();
        $part7 = $ExamPartModel::where('part_number', 7)->inRandomOrder()->get();
        $data['part1'] = $part1;
        $data['part2'] = $part2;
        $data['part3'] = $part3;
        $data['part4'] = $part4;
        $data['part5'] = $part5;
        $data['part6'] = $part6;
        $data['part7'] = $part7;


        $QuestionGroupModel = new QuestionGroup();
        $group6 = $QuestionGroupModel::where('exam_part_id', $part6[0]['id'])->inRandomOrder()->take(4)->get();
        $group7 = $QuestionGroupModel::where('exam_part_id', $part7[0]['id'])->inRandomOrder()->take(15)->get();
        $data['group6'] = $group6;
        $data['group7'] = $group7;

        $QuestionModel = new Question();
        $question = $QuestionModel->get();
        $question1 = $QuestionModel::where('exam_part_id', $part1[0]['id'])->take(6)->get();
        //$question1 = $QuestionModel::where('exam_part_id', $part1[0]['id'])->orderBy('RAND()')->findget(6);
        $question2 = $QuestionModel::where('exam_part_id', $part2[0]['id'])->take(25)->get();
        $question3 = $QuestionModel::where('exam_part_id', $part3[0]['id'])->take(39)->get();
        $question4 = $QuestionModel::where('exam_part_id', $part4[0]['id'])->take(30)->get();
        $question5 = $QuestionModel::where('exam_part_id', $part5[0]['id'])->inRandomOrder()->take(30)->get();
        $question6 = $QuestionModel::where('exam_part_id', $part6[0]['id'])->get();
        $question7 = $QuestionModel::where('exam_part_id', $part7[0]['id'])->get();
        $data['question'] = $question;
        $data['question1'] = $question1;
        $data['question2'] = $question2;
        $data['question3'] = $question3;
        $data['question4'] = $question4;
        $data['question5'] = $question5;
        $data['question6'] = $question6;
        $data['question7'] = $question7;

        $QuestionAudioModel = new QuestionAudio();
        $audios = $QuestionAudioModel->get();
        $data['audios'] = $audios;


        $QuestionAnswerModel = new QuestionAnswer();
        $question_answer = $QuestionAnswerModel->get();
        $data['question_answer'] = $question_answer;

        $QuestionImageModel = new QuestionImage();
        $question_image = $QuestionImageModel->get();
        $data['question_image'] =  $question_image;


        return view('User.Exam.ExamToeicRandom', $data);
    }
}
