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

class FullTestController extends Controller
{
    public function index(Request $request, $exam_id)
    {

         //Tao cac model
         //$exam_id = $this->request->getUri()->getSegment(3);
         $ExamModel = new Exam();
         $Exam = $ExamModel->find($exam_id);

         $ExamQuestionGroup = new ExamQuestionGroup();
         $ExamGroup = $ExamQuestionGroup::where('exam_id', $exam_id)->get();

         $ExamQuestionSingle = new ExamQuestionSingle();
         $ExamSingle = $ExamQuestionSingle::where('exam_id', $exam_id)->get();

         $ExamToExamPartModel = new ExamToExamPart();
         $ExamPart = $ExamToExamPartModel::where('exam_id', $exam_id)->get();

         //lay part
         $ExamPartModel = new ExamPart();
         $exam_part = $ExamPartModel->get();

         $part1 = $ExamPartModel::where('id', $ExamPart[0]['exam_part_id'])->get();
         $part2 = $ExamPartModel::where('id', $ExamPart[1]['exam_part_id'])->get();
         $part3 = $ExamPartModel::where('id', $ExamPart[2]['exam_part_id'])->get();
         $part4 = $ExamPartModel::where('id', $ExamPart[3]['exam_part_id'])->get();
         $part5 = $ExamPartModel::where('id', $ExamPart[4]['exam_part_id'])->get();
         $part6 = $ExamPartModel::where('id', $ExamPart[5]['exam_part_id'])->get();
         $part7 = $ExamPartModel::where('id', $ExamPart[6]['exam_part_id'])->get();
         $data['part1'] = $part1;
         $data['part2'] = $part2;
         $data['part3'] = $part3;
         $data['part4'] = $part4;
         $data['part5'] = $part5;
         $data['part6'] = $part6;
         $data['part7'] = $part7;

         //lay group 6,7
         $QuestionGroupModel = new QuestionGroup();
         $group = $QuestionGroupModel::where('exam_part_id', $part6[0]['id'])->get();
         $group6 = [];
         foreach ($ExamGroup as $a) {
             foreach ($group as $b) {
                 if ($b['id'] == $a['question_group_id']) {
                     array_push($group6, $b);
                 }
             }
         }
         $group = $QuestionGroupModel::where('exam_part_id', $part7[0]['id'])->get();
         $group7 = [];
         foreach ($ExamGroup as $a) {
             foreach ($group as $b) {
                 if ($b['id'] == $a['question_group_id']) {
                     array_push($group7, $b);
                 }
             }
         }
         $data['group6'] = $group6;
         $data['group7'] = $group7;

         //lay question
         $QuestionModel = new Question();
         $question = $QuestionModel->get();
         $question1 = [];
         $question2 = [];
         $question3 = [];
         $question4 = [];
         $question5 = [];
         $question6 = $QuestionModel::where('exam_part_id', $part6[0]['id'])->get();
         $question7 = $QuestionModel::where('exam_part_id', $part7[0]['id'])->get();

         foreach ($ExamSingle as $a) {
             foreach ($question as $b) {
                 if ($b['exam_part_id'] == $part1[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question1, $b);
                 } else if ($b['exam_part_id'] == $part2[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question2, $b);
                 } else if ($b['exam_part_id'] == $part3[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question3, $b);
                 } else if ($b['exam_part_id'] == $part4[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question4, $b);
                 } else if ($b['exam_part_id'] == $part5[0]['id'] && $b['id'] == $a['question_id']) {

                     array_push($question5, $b);
                 }
             }
         }
         $data['question1'] = $question1;
         $data['question'] = $question;
         $data['question2'] = $question2;
         $data['question3'] = $question3;
         $data['question4'] = $question4;
         $data['question5'] = $question5;
         $data['question6'] = $question6;
         $data['question7'] = $question7;

         //lay audios
         $QuestionAudioModel = new QuestionAudio();
         $audios= $QuestionAudioModel->get();
         $data['audios'] = $audios;


         $QuestionAnswerModel = new QuestionAnswer();
         $question_answer = $QuestionAnswerModel->get();
         $data['question_answer'] = $question_answer;

         $QuestionImageModel = new QuestionImage();
         $question_image = $QuestionImageModel->get();
         $data['question_image'] =  $question_image;
         return view('User.Exam.Exam', $data);
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
        //goi id user
        $user_id = session()->get('id');

        if ( ! $user_id)
        {
            return;
        }
        $question_id = $_POST['question_id'];
        $selected_answer = $_POST['selected_answer'];
        $data = [
            'user_id' => $user_id,
            'question_id' => $question_id,
            'selected_answer' => $selected_answer,
        ];
        $wrongAnswerQuestionModel = new WrongAnswerQuestion();
        $wrongAnswerQuestionModel->insert($data);
    }
}
