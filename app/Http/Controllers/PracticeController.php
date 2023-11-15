<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamPart;
use App\Models\QuestionAnswer;
use App\Models\QuestionAudio;
use App\Models\QuestionGroup;
use App\Models\QuestionImage;
use App\Models\Question;

class PracticeController extends Controller
{
    public function practiceGrammar()
    {
        return view('User.Practice.practicegrammar');
    }

    public function practiceVocabulary()
    {
        return view('User.Practice.practiceVocabulary');
    }

    public function practiceListen()
    {
        $examPart = new ExamPart();
        $part1 = $examPart->where('part_number', 1)->inRandomOrder()->get();
        $part2 = $examPart->where('part_number', 2)->inRandomOrder()->get();
        $part3 = $examPart->where('part_number', 3)->inRandomOrder()->get();
        $part4 = $examPart->where('part_number', 4)->inRandomOrder()->get();
        $data['part1'] = $part1;
        $data['part2'] = $part2;
        $data['part3'] = $part3;
        $data['part4'] = $part4;

        return view('User.Practice.practiceListen', $data);
    }

    public function practiceRead()
    {
        $examPart = new ExamPart();
        $part5 = $examPart->where('part_number', 5)->inRandomOrder()->get();
        $part6 = $examPart->where('part_number', 6)->inRandomOrder()->get();
        $part7 = $examPart->where('part_number', 7)->inRandomOrder()->get();
        $data['part5'] = $part5;
        $data['part6'] = $part6;
        $data['part7'] = $part7;

        return view('User.Practice.practiceRead', $data);
    }

    public function listen(Request $request)
    {
        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;

        $questionModel = new Question();
        if ($part[0]['part_number'] == 1) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(6)->get();
        } elseif ($part[0]['part_number'] == 2) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(25)->get();
        } elseif ($part[0]['part_number'] == 3) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(39)->get();
        } elseif ($part[0]['part_number'] == 4) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(30)->get();
        }
        $data['question'] = $question;

        $questionAnswerModel = new QuestionAnswer();
        $questionAnswer = $questionAnswerModel->get();
        $data['question_answer'] = $questionAnswer;

        $questionAudioModel = new QuestionAudio();
        $questionAudio = $questionAudioModel->get();
        $audios = [];
        foreach ($question as $a) {
            foreach ($questionAudio as $b) {
                if ($a->audio_id == $b->id) {
                    $audios[] = $b;
                }
            }
        }
        $data['audios'] = $audios;

        $questionImageModel = new QuestionImage();
        $questionImage = $questionImageModel->get();
        $data['question_image'] = $questionImage;

        return view('User.Practice.baiTapNghe', $data);
    }

    public function read(Request $request)
    {
        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;

        $questionGroupModel = new QuestionGroup();
        if ($part[0]['part_number'] == 6) {
            $groups = $questionGroupModel->where('exam_part_id', $partId)->inRandomOrder()->take(4)->get();
        } elseif ($part[0]['part_number'] == 7) {
            $groups = $questionGroupModel->where('exam_part_id', $partId)->inRandomOrder()->take(15)->get();
        } else {
            $groups = [];
        }
        $data['groups'] = $groups;

        $questionModel = new Question();
        if ($part[0]['part_number'] == 5) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(30)->get();
        } elseif ($part[0]['part_number'] == 6) {
            $question = $questionModel->where('exam_part_id', $partId)->get();
        } elseif ($part[0]['part_number'] == 7) {
            $question = $questionModel->where('exam_part_id', $partId)->get();
        }
        $data['question'] = $question;

        $questionAnswerModel = new QuestionAnswer();
        $questionAnswer = $questionAnswerModel->get();
        $data['question_answer'] = $questionAnswer;

        return view('User.Practice.baiTapDoc', $data);
    }
}
