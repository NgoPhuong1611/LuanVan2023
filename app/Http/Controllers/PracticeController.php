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
        }elseif ($part[0]['part_number'] == 11) {
            $question = $questionModel->where('exam_part_id', $partId)->inRandomOrder()->take(30)->get();
        }elseif ($part[0]['part_number'] == 12) {
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
        $userId = auth()->user()->id; // Lấy ID của người dùng hiện tại
        $questionId = $request->input('question_id'); // ID của câu hỏi
        // $examPart = $request->input('exam_part_id');
        $detail = $request->input('answer'); // Giả sử tên trường là 'answer'

        if (!empty($userId) && !empty($questionId) && !empty($detail)) {
            $fileUser = new FileUser();
            $fileUser->user_id = $userId;
            // $fileUser->user_id=auth()->user()->id;
            $fileUser->question_id = $questionId;
            // $fileUser->exam_part_id = $examPart;
            $fileUser->detail = $detail;
            $fileUser->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được lưu thành công.');
        } else {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu.');
        }
        
    }
     
    //ghi âm test
//     public function recordSpeaking(Request $request)
// {
//     $user=User::find(session()->get('id'));
//     // Lưu file ghi âm vào thư mục upload/audio_user
//     // $userId = auth()->user()->id;
//     $questionId = $request->input('question_id');

//     if ($request->hasFile('audio')) {
//         $audio = $request->file('audio');
//         $fileName = $questionId . '_' . $user . '.' . $audio->getClientOriginalExtension();
//         $audio->move(public_path('upload/audio_user'), $fileName);

//         // Lưu thông tin file vào database
//         FileUser::create([
//             'user_id' => $user,
//             'question_id' => $questionId,
//             'detail' => $fileName
//         ]);

//         return response()->json(['success' => true, 'message' => 'File ghi âm đã được lưu.']);
//     }

//     return response()->json(['success' => false, 'message' => 'Không có file ghi âm được gửi đến server.']);
// }
public function storeAudio(Request $request)
    {
        try {
            if ($request->hasFile('audio')) {
                $audioFile = $request->file('audio');
                $audioPath = $audioFile->store('audio', 'public'); // Lưu file âm thanh vào thư mục 'storage/app/public/audio'
    
                $audio = new FileUser();
                $audio->audio_data = $audioPath; // Lưu đường dẫn của file âm thanh vào cột 'audio_data'
                $audio->save();
    
                return redirect('/');
            } else {
                return back()->with('error', 'No audio file uploaded');
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
       
    }
}
