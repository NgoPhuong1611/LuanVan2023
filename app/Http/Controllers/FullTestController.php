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
use App\Models\Transaction;


class FullTestController extends Controller
{
    public function purchaseExam($id)
{
    $user = User::find(session()->get('id'));
    $exam = Exam::find($id);

    // Kiểm tra xem người dùng đã mua đề thi hay chưa
    $hasPurchased = Transaction::where('user_id', $user->id)
        ->where('title', $exam->title)
        ->exists();

    if ($hasPurchased) {
        // Nếu đã mua, có thể thực hiện hành động khác hoặc thông báo đã mua
        return redirect()->back()->with('error', 'You have already purchased this exam.');
    }

    // Kiểm tra số xu của người dùng
    if ($user->quantity_coin >= $exam->quantity_coin) {
        // Gọi hàm mua đề
        $this->processPurchase($user, $exam);
        return redirect()->back()->with('success', 'Purchase successful.');
    } else {
        return redirect()->back()->with('error', 'Not enough coins to purchase the exam.');
    }
}

private function processPurchase(User $user, Exam $exam)
{
    // Trừ số lượng coin của người dùng
    $user->quantity_coin -= $exam->quantity_coin;
    $user->save();

    // Tạo một bản ghi trong bảng transaction
    Transaction::create([
        'user_id' => $user->id,
        'admin_id' => null,
        'title' => $exam->title,
        'type' => 1,
        'quantity' => $exam->quantity_coin,
        'time_date' => now(),
    ]);
}
    public function index(Request $request, $exam_id)
    {
        $user = User::find(session()->get('id'));

        if (!$user) {
            return view('User.inforUser.Login');
        }

        $user_id = $user->id;

        $examHistory = ExamHistory::create([
            'user_id' => $user_id,
            'exam_id' => $exam_id,
        ]);

        $exam_history_id = $examHistory->id;

        $exam = Exam::find($exam_id);

        $examGroups = ExamQuestionGroup::where('exam_id', $exam_id)->get();
        $examSingles = ExamQuestionSingle::where('exam_id', $exam_id)->get();
        $examParts = ExamToExamPart::where('exam_id', $exam_id)->get();
        $partIds = $examParts->pluck('exam_part_id')->toArray();
        $parts = ExamPart::whereIn('id', $partIds)->get();

        $questionIds = $examSingles->pluck('question_id')->toArray();
        $question = Question::whereIn('id', $questionIds)->get();

        $data = [
            'question' => $question,
            'audios' => QuestionAudio::get(),
            'question_answer' => QuestionAnswer::get(),
            'question_image' => QuestionImage::get(),
        ];

        foreach ($parts as $part) {
            $data["part{$part->part_number}"] = $part;

            $partQuestions = $data['question']->where('exam_part_id', $part->id);
            $partExamSingles = $examSingles->whereIn('question_id', $partQuestions->pluck('id')->toArray());

            $data["question{$part->part_number}"] = $partQuestions->toArray();
            $data["audio{$part->part_number}"] = $data['audios']->whereIn('id', $partQuestions->pluck('audio_id')->toArray())->toArray();

            if ($part->part_number == 6) {
                $groupQuestions = QuestionGroup::where('exam_part_id', $part->id)->get();
                $groupExamQuestions = $examGroups->whereIn('question_group_id', $groupQuestions->pluck('id')->toArray());

                $data["group{$part->part_number}"] = $groupQuestions->toArray();
                $data["examGroup{$part->part_number}"] = $groupExamQuestions->toArray();
            }

            if ($part->part_number == 7) {
                $groupQuestions = QuestionGroup::where('exam_part_id', $part->id)->get();
                $groupExamQuestions = $examGroups->whereIn('question_group_id', $groupQuestions->pluck('id')->toArray());

                $data["group{$part->part_number}"] = $groupQuestions->toArray();
                $data["examGroup{$part->part_number}"] = $groupExamQuestions->toArray();
            }
        }

        return view('User.Exam.Exam', $data, ['exam_history_id' => $exam_history_id]);
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

            //return response()->json(['success' => 'Wrong answer recorded successfully.']);
            echo dung;
        } catch (\Exception $e) {
            //return response()->json(['error' => 'Error recording wrong answer.'], 500);
            echo sai;
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
