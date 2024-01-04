<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamPart;
use App\Models\QuestionAnswer;
use App\Models\QuestionAudio;
use App\Models\QuestionGroup;
use App\Models\QuestionImage;
use App\Models\Question;
use App\Models\Message;
use App\Models\FileUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

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
    public function practiceWriting()
    {
        $examPart = new ExamPart();
        $part13 = $examPart->where('part_number', 13)->inRandomOrder()->get();
        $part14 = $examPart->where('part_number', 14)->inRandomOrder()->get();
        $part15 = $examPart->where('part_number', 15)->inRandomOrder()->get();

        $data['part13'] = $part13;
        $data['part14'] = $part14;
        $data['part15'] = $part15;

        return view('User.Practice.practiceWriting', $data);
    }
    public function practiceSpeaking()
    {
        $examPart = new ExamPart();
        $part8 = $examPart->where('part_number', 8)->inRandomOrder()->get();
        $part9 = $examPart->where('part_number', 9)->inRandomOrder()->get();
        $part10 = $examPart->where('part_number', 10)->inRandomOrder()->get();
        $part11 = $examPart->where('part_number', 11)->inRandomOrder()->get();
        $part12 = $examPart->where('part_number', 12)->inRandomOrder()->get();
        $data['part8'] = $part8;
        $data['part9'] = $part9;
        $data['part10'] = $part10;
        $data['part11'] = $part11;
        $data['part12'] = $part12;
        return view('User.Practice.practiceSpeaking', $data);
    }
    public function writing(Request $request)
    {

        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;

        $questionModel = new Question();
        if ($part[0]['part_number'] == 13) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(6)->get();
        } elseif ($part[0]['part_number'] == 14) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(25)->get();
        } elseif ($part[0]['part_number'] == 15) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(39)->get();
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

        return view('User.Practice.baiTapViet', $data);
    }
    public function speaking(Request $request)
    {
        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;

        $questionModel = new Question();
        if ($part[0]['part_number'] == 8) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(6)->get();
        } elseif ($part[0]['part_number'] == 9) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(25)->get();
        } elseif ($part[0]['part_number'] == 10) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(30)->get();
        } elseif ($part[0]['part_number'] == 11) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(30)->get();
        } elseif ($part[0]['part_number'] == 12) {
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

        return view('User.Practice.baiTapNoi2', $data);
    }

    //lưu bài làm của người học
    public function save(Request $request)
    {
        $user_id = User::find(session()->get('id'))->id; // Lấy ID của người dùng hiện tại
        $questionId = $request->input('question_id'); // ID của câu hỏi
        $examPart = $request->input('examPart');
        $detail = $request->input('answer'); // Giả sử tên trường là 'answer'

        $data = [
            'user_id' => $user_id,
            'question_id' => $questionId,
            'part_number' => $examPart,
            'type' => 1,
            'detail' => $detail,
        ];
        FileUser::create($data);
        return view('User.History.index');
    }


    public function uploadAudio(Request $request)
    {

        $user_id = User::find(session()->get('id'))->id;
        $questionId = $request->input('question_id');
        $examPart = $request->input('examPart');
        $audioString = $request->input('audio');

        $audioBinary  = base64_decode($audioString);
        $fileName = $user_id . '_'.$questionId.'_' . date('Ymd_His') . '.mp3';
        $path = public_path('uploads/audios/audio_user') . '/' . $fileName;
        file_put_contents($path, $audioBinary );

        // Lưu thông tin vào table file_user
        $data = [
            'user_id' => $user_id,
            'question_id' => $questionId,
            'part_number' => $examPart,
            'type' => 0,
            'detail' => $fileName,
        ];

        FileUser::create($data);

        // Chuyển hướng người dùng sau khi xử lý thành công
        return view('User.History.index');
    }

}
