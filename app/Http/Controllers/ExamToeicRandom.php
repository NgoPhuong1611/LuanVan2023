<?php

namespace App\Http\Controllers;

use App\Models\ExamPart;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\QuestionAudio;
use App\Models\QuestionAnswer;
use App\Models\QuestionImage;
use Illuminate\Support\Facades\DB;

class ExamToeicRandomController extends Controller
{
    public function index()
    {
        $examPartModel = new ExamPart();
        $exam_parts = $examPartModel->get();

        $part1 = $examPartModel->where('part_number', 1)->inRandomOrder()->get();
        $part2 = $examPartModel->where('part_number', 2)->inRandomOrder()->get();
        $part3 = $examPartModel->where('part_number', 3)->inRandomOrder()->get();
        $part4 = $examPartModel->where('part_number', 4)->inRandomOrder()->get();
        $part5 = $examPartModel->where('part_number', 5)->inRandomOrder()->get();
        $part6 = $examPartModel->where('part_number', 6)->inRandomOrder()->get();
        $part7 = $examPartModel->where('part_number', 7)->inRandomOrder()->get();
        $data['part1'] = $part1;
        $data['part2'] = $part2;
        $data['part3'] = $part3;
        $data['part4'] = $part4;
        $data['part5'] = $part5;
        $data['part6'] = $part6;
        $data['part7'] = $part7;

        $questionGroupModel = new QuestionGroup();
        $group6 = $questionGroupModel->where('exam_part_id', $part6[0]['id'])->inRandomOrder()->take(4)->get();
        $group7 = $questionGroupModel->where('exam_part_id', $part7[0]['id'])->inRandomOrder()->take(15)->get();
        $data['group6'] = $group6;
        $data['group7'] = $group7;

        $questionModel = new Question();
        $question = $questionModel->get();
        $question1 = $questionModel->where('exam_part_id', $part1[0]['id'])->inRandomOrder()->take(6)->get();
        $question2 = $questionModel->where('exam_part_id', $part2[0]['id'])->inRandomOrder()->take(25)->get();
        $question3 = $questionModel->where('exam_part_id', $part3[0]['id'])->inRandomOrder()->take(39)->get();
        $question4 = $questionModel->where('exam_part_id', $part4[0]['id'])->inRandomOrder()->take(30)->get();
        $question5 = $questionModel->where('exam_part_id', $part5[0]['id'])->inRandomOrder()->take(30)->get();
        $question6 = $questionModel->where('exam_part_id', $part6[0]['id'])->get();
        $question7 = $questionModel->where('exam_part_id', $part7[0]['id'])->get();
        $data['question'] = $question;
        $data['question1'] = $question1;
        $data['question2'] = $question2;
        $data['question3'] = $question3;
        $data['question4'] = $question4;
        $data['question5'] = $question5;
        $data['question6'] = $question6;
        $data['question7'] = $question7;

        $questionAudioModel = new QuestionAudio();
        $audios = $questionAudioModel->get();
        $data['audios'] = $audios;

        $questionAnswerModel = new QuestionAnswer();
        $question_answer = $questionAnswerModel->get();
        $data['question_answer'] = $question_answer;

        $questionImageModel = new QuestionImage();
        $question_image = $questionImageModel->get();
        $data['question_image'] =  $question_image;

        return view('user.exam.examToeicRandom', $data);
    }
}
