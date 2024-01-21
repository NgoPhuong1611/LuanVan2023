<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamHistory;

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
use Illuminate\Support\Facades\DB;
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
    public function speaking(Request $request)
    {
        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;

        $questionModel = new Question();
        if ($part[0]['part_number'] == 8) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(1)->get();
        } elseif ($part[0]['part_number'] == 9) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(1)->get();
        } elseif ($part[0]['part_number'] == 10) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(1)->get();
        } elseif ($part[0]['part_number'] == 11) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(1)->get();
        } elseif ($part[0]['part_number'] == 12) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(1)->get();
        }
        $data['question'] = $question;

        // $questionAnswerModel = new QuestionAnswer();
        // $questionAnswer = $questionAnswerModel->get();
        // $data['question_answer'] = $questionAnswer;

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
    public function writing(Request $request)
    {
        // Kiểm tra xem người dùng có bài kiểm tra nào đang diễn ra không
        $current_exam_id = $request->session()->get('current_exam_id');
        // Nếu không có bài kiểm tra đang diễn ra, tạo một bài mới
        if (!$current_exam_id) {
            $user_id = User::find(session()->get('id'))->id;
            $exam = Exam::create([
                'author' => 1,
                'level' => 0,
                'title' => $user_id.'_'.'WRITING'.time(),
                'status' => 1,
            ]);
            // Lưu exam_id vào session
            $request->session()->put('current_exam_id', $exam->id);
        }
        // Tiếp tục với logic hiện tại để lấy câu hỏi và dữ liệu khác
        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;
        $partId = $request->segment(3);
        $examPart = new ExamPart();
        $part = $examPart->where('id', $partId)->get();
        $data['part'] = $part;

        $questionModel = new Question();
        if ($part[0]['part_number'] == 13) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(5)->get();
        } elseif ($part[0]['part_number'] == 14) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(5)->get();
        } elseif ($part[0]['part_number'] == 15) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(5)->get();
        }
        $data['question'] = $question;

        $questionImageModel = new QuestionImage();
        $questionImage = $questionImageModel->get();
        $data['question_image'] = $questionImage;

        return view('User.Practice.baiTapViet', $data);
    }

    public function save(Request $request)
    {
        try {
            // Bước 1: Lấy các dữ liệu từ request
            $user_id = User::find(session()->get('id'))->id;
            $questionId = $request->input('question_id');
            $examPart = $request->input('examPart');
            $details = $request->input('answers');

            // Bước 2: Lấy exam_id từ session
            $exam_id = $request->session()->get('current_exam_id');

            // Bước 3: Kiểm tra exam_id
            if (!$exam_id) {
                // Nếu không có exam_id, có thể xảy ra lỗi, bạn có thể thêm xử lý xử lý ở đây nếu cần
                // return response()->json(['error' => 'No active exam found.'], 400);
            }

            // Bước 4: Sử dụng transaction để đảm bảo toàn vẹn dữ liệu
            DB::beginTransaction();

            // Bước 5: Lưu câu trả lời vào bảng FileUser
            foreach ($details as $questionId => $answer) {
                // Thực hiện lưu câu trả lời vào database cho từng câu hỏi
                $data = [
                    'user_id' => $user_id,
                    'question_id' => $questionId,
                    'part_number' => $examPart,
                    'exam_id' => $exam_id,
                    'type' => 1,
                    'detail' => $answer,
                ];
                FileUser::create($data);
            }


            // Bước 6: Cập nhật hoặc tạo mới lịch sử thi
            ExamHistory::updateOrCreate(
                ['user_id' => $user_id, 'exam_id' => $exam_id],
                ['user_id' => $user_id, 'exam_id' => $exam_id]
            );

            // Bước 7: Lấy lịch sử thi để hiển thị
            $history = ExamHistory::select('exam_history.id', 'exam_history.exam_id', 'exam.title', 'exam_history.time_date', 'exam_history.score')
                ->join('exam', 'exam_history.exam_id', '=', 'exam.id')
                ->where('user_id', $user_id)
                ->get();

            // Bước 8: Xoá exam_id khỏi session sau khi nộp bài
            $request->session()->forget('current_exam_id');

            // Bước 9: Commit transaction
            DB::commit();

            // Bước 10: Trả về view
            return view('User.History.index', ['history' => $history]);
        } catch (\Exception $e) {
            // Bước 11: Rollback transaction nếu có lỗi
            DB::rollback();

            // Bước 12: Xử lý lỗi (hiển thị hoặc log)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function uploadAudio(Request $request)
    {

        $user_id = User::find(session()->get('id'))->id;
        $questionId = $request->input('question_id');
        $examPart = $request->input('examPart');
        $audioFileUser = $request->file('audio');

        $fileName = $user_id . '_' . $questionId . '_' . date('Ymd_His') . '_' . $audioFileUser->getClientOriginalName() . '.mp3';
        $audioFileUser->move(public_path('uploads/audios/audio_user'), $fileName);

        // Lưu thông tin vào table file_user
        $exam = Exam::create([
            'author' => 1,
            'level' => 0,
            'title' =>  $user_id.'_'.'SPEAKING'.time(),
            'status' => 1,
        ]);
        $exam_id = $exam->id;
        $user_id = User::find(session()->get('id'))->id;
        $data1 = [
            'user_id' => $user_id,
            'exam_id' => $exam_id,
        ];
        $examHistory = ExamHistory::create($data1);
        $data = [
            'user_id' => $user_id,
            'question_id' => $questionId,
            'part_number' => $examPart,
            'exam_id' => $exam_id,
            'type' => 0,
            'detail' => $fileName,
        ];

        FileUser::create($data);

        // Chuyển hướng người dùng sau khi xử lý thành công
        // return view('User.History.index');
        $history = ExamHistory::select('exam_history.id', 'exam_history.exam_id', 'exam.title', 'exam_history.time_date', 'exam_history.score')
        ->join('exam', 'exam_history.exam_id', '=', 'exam.id')
        ->where('user_id', $user_id)
        ->get();

        // Bước 8: Xoá exam_id khỏi session sau khi nộp bài
        // Bước 10: Trả về view
        return view('User.History.index', ['history' => $history]);
        }
    }
