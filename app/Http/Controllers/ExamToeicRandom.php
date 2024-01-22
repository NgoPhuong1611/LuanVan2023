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
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Exception;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExamToeicRandom extends Controller
{
    public function index()
    {
        $examPartModel = ExamPart::get();
        $questionModel =  Question::get();
        $questionGroupModel = QuestionGroup::get();
        $questionAudioModel = QuestionAudio::get();
        $questionAnswerModel = QuestionAnswer::get();
        $questionImageModel = QuestionImage::get();
        $data = [];

        for ($i = 1; $i <= 7; $i++) {

            $part = $examPartModel->where('part_number', $i)->first();
            $data["part{$i}"] =$part;

            $questionGroupQuery = QuestionGroup::query(); // Create an instance of the QuestionGroup model query builder

            if ($i >= 6) {
                $data["group{$i}"] = $questionGroupQuery
                    ->where('exam_part_id', $part->id)
                    ->inRandomOrder()
                    ->take(($i == 6) ? 4 : 15)
                    ->get();
            }

            $questionQuery = Question::query(); // Create an instance of the Question model query builder

            $data["question{$i}"] = $questionQuery
                ->where('exam_part_id', $part->id)
                ->inRandomOrder()
                ->take(($i == 1) ? 6 : (($i == 2) ? 25 : (($i == 3) ? 39 : 30)))
                ->get();
        }

        $data['question'] = $questionModel;
        $data['audios'] = $questionAudioModel;
        $questionAnswerQuery = QuestionAnswer::query(); // Create an instance of the QuestionAnswer model query builder

        $data['question_answer'] = $questionAnswerQuery
            ->inRandomOrder()
            ->get();        $data['question_image'] = $questionImageModel;
        return view('User.Exam.ExamToeicRandom', $data);
    }
}
