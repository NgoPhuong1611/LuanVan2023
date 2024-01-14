<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\ExamPart;
use App\Models\QuestionAnswer;
use App\Models\QuestionAudio;
use App\Models\QuestionGroup;
use App\Models\Question;
use Exception;

class QuestionGroupController extends Controller
{
    public function index()
{
    $questionGroupModel = new QuestionGroup();
    $questionGroups = $questionGroupModel->get();

    $datas['questionGroups'] = $questionGroups;
    return view('Admin.Question.Group.index', $datas);
}

public function edit(Request $request)
{
    $questionGroupID = $request->segment(4);

    $questionGroup = QuestionGroup::find($questionGroupID);

    if (!$questionGroup) {
        return redirect()->route('dashboard.question-group.index');
    }

    $data['examPart'] = ExamPart::all();

    $questions = Question::where('question_group_id', $questionGroupID)->get();

    $data['questions'] = $questions->map(function ($question) {
        $question['options'] = QuestionAnswer::where('question_id', $question['id'])->get();
        return $question;
    });

    if (isset($questions[0]['audio_id'])) {
        $data['audio'] = QuestionAudio::find($questions[0]['audio_id']);
    }

    $data['questionGroup'] = $questionGroup;

    return view('Admin.Question.Group.Edit', $data);
    }
    public function detail()
    {
            $examPartModel      = ExamPart::get();

            $data['examPart'] = $examPartModel;

            return view('Admin/Question/Group/detail', $data);
    }

    public function update(Request $request, $questionGroupID)
    {
        $title        = $request->input('title');
        $partID       = $request->input('part_id');
        $paragraph    = $request->input('paragraph');
        $questions    = $request->input('questions');
        $oldQuestions = $request->input('old_questions');
        $rightOption  = $request->input('right_option');
        $oldOptions   = $request->input('old_options');
        $options      = $request->input('options');
        $type         = $request->input('type');

        $data = [
            'exam_part_id' => $partID,
            'title'        => $title,
            'paragraph'    => $paragraph,
        ];

        $questionGroupModel = QuestionGroup::find($questionGroupID);
        $questionGroupModel->update($data);
//////////////////////////////////////////////////////////////
        $questionAnswerModel = new QuestionAnswer();

        $questionModel = new Question();
        $questionAnswerModel = new QuestionAnswer();
        //0 text, 1 image, 2 audio
        $optionType = 0;

        foreach ($questions as $key => $question) {
            $data = [
                'exam_part_id'      => $partID,
                'question_group_id' => $questionGroupID,
                'audio_id'          => null,
                'right_option'      => $rightOption[$key],
                'question'          => $question,
                'explain'           => 'No explain',
                'type'              => $type,
            ];
            if (isset($oldQuestions[$key])) {
                $data['id'] = $oldQuestions[$key];
            }
            $isInsert = Question::find($oldQuestions[$key])->update($data);
            $questionID =  $data['id'];
            if (isset($oldQuestions[$key])) {
                $questionID = $oldQuestions[$key];
            }

            foreach ($options[$key] as $subKey => $option) {
                $data = [
                    'question_id' => $questionID,
                    'type' => $optionType,
                    'text' => $option
                ];
                if (isset($oldOptions[$key][$subKey])) {
                    $data['id'] = $oldOptions[$key][$subKey];
                }
                $isInsert = QuestionAnswer::find($data['id'])->update($data);

            }
        }

        //Sau khi thêm thì chuyển hướng về trang index.

        //return redirect()->route('dashboard.question-group.index');
    }
public function save(Request $request)
{
    $title = $request->input('title');
    $partID = $request->input('part_id');
    $paragraph =$request->input('paragraph');
    $questions = $request->input('questions');
    $rightOption = $request->input('right_option');
    $options = $request->input('options');
    $type = $request->input('type');

    $data = [
        'exam_part_id' =>  $partID,
        'title'        =>  $title,
        'paragraph'    =>  $paragraph,
    ];
    $questionGroupModel = QuestionGroup::create($data);
    $questionGroupID = $questionGroupModel->id;
    // luu cau hoi
    $questionModel = new Question();
    $questionAnswerModel = new QuestionAnswer();
    foreach ($questions as $key => $question) {
        $data = [
            'exam_part_id'      => $partID,
            'question_group_id' => $questionGroupID,
            'audio_id'          =>  null,
            'right_option'      => $rightOption[$key],
            'question'          => $question,
            'explain'           => 'No explain',
            'type'              => $type
        ];
        $isInsert = $questionModel->create($data);
        $questionID =  $isInsert->id;
        foreach ($options[$key] as $subKey => $option) {
            $data = [
                'question_id' => $questionID,
                'type' => 2,
                'text' => $option
            ];
            $isInsert = $questionAnswerModel->create($data);
        }
    }
    return redirect()->route('dashboard.question-group.index');
}


public function delete($id)
{
    $questionGroup = QuestionGroup::find($id);

    if (!$questionGroup) {
        return redirect()->back()->with('error', 'Question Group not found');
    }

    $questions = Question::where('question_group_id', $id)->get();

    foreach ($questions as $question) {
        QuestionAnswer::where('question_id', $question->id)->delete();
        $question->delete();
    }
    $questionGroup->delete();
    return redirect()->route('dashboard.question-group.index')->with('success', 'Question Group deleted successfully');
}
}

