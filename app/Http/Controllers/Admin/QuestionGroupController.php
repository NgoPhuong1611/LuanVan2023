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

public function detail(Request $request)
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

    return view('Admin.Question.Group.detail', $data);
}

public function save()
{
    $questionGroupIDPost = $this->request->input('question_group_id');
    $title = $this->request->input('title');
    $partID = $this->request->input('part_id');
    $paragraph = $this->request->input('paragraph');
    $questionGroupAudio = $this->request->file('question_group_audio');
    $questions = $this->request->input('questions');
    $oldQuestions = $this->request->input('old_questions');
    $rightOption = $this->request->input('right_option');
    $oldOptions = $this->request->input('old_options');
    $options = $this->request->input('options');
    $type = $this->request->input('type');

    $data = [
        'exam_part_id' =>  $partID,
        'title'        =>  $title,
        'paragraph'    =>  $paragraph,
    ];

    $questionGroupModel = new QuestionGroup();

    if ($questionGroupModel->where('title', $title)->first() && !$questionGroupIDPost) {
        return redirect()->route('dashboard.question-group.detail')->withInput()->with('error', 'Title nhóm câu hỏi đã tồn tại!');
    }

    if ($questionGroupIDPost) {
        $data['id'] = $questionGroupIDPost;
    }

    $isInsert = $questionGroupModel->updateOrCreate(['id' => $data['id']], $data);

    if (!$isInsert) {
        throw new Exception(UNEXPECTED_ERROR_MESSAGE);
    }

    $questionGroupID = $questionGroupModel->id;

    $audioID = $this->saveAudio($questionGroupAudio);

    $questionModel = new Question();
    $questionAnswerModel = new QuestionAnswer();

    $optionType = 0;

    if ($questionGroupAudio) {
        $optionType = $audioID == 0 ? 1 : 2;
    }

    foreach ($questions as $key => $question) {
        if ($questionModel->where('question', $question)->first()) {
            return redirect()->route('dashboard.question-group.detail')->withInput()->with('error', 'Câu hỏi đã tồn tại!');
        }

        $data = [
            'exam_part_id'      => $partID,
            'question_group_id' => $questionGroupID,
            'audio_id'          => $audioID != 0 ? $audioID : null,
            'right_option'      => $rightOption[$key],
            'question'          => $question,
            'explain'           => 'No explain',
            'type'              => $type
        ];

        if (isset($oldQuestions[$key])) {
            $data['id'] = $oldQuestions[$key];
        }

        $isInsert = $questionModel->updateOrCreate(['id' => $data['id']], $data);

        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        $questionID = $questionModel->id;

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

            $isInsert = $questionAnswerModel->updateOrCreate(['id' => $data['id']], $data);

            if (!$isInsert) {
                throw new Exception(UNEXPECTED_ERROR_MESSAGE);
            }
        }
    }

    return redirect()->route('dashboard.question-group.index');
}

private function saveAudio($file)
{
    if (!$file) {
        return 0;
    }

    $path = $file->storeAs(AUDIO_PATH, $file->getClientOriginalName());

    $data = [
        'audio_name' => $file->getClientOriginalName()
    ];

    $questionAudioModel = new QuestionAudio();
    $isInsert = $questionAudioModel->updateOrCreate(['audio_name' => $data['audio_name']], $data);

    if (!$isInsert) {
        throw new Exception(UNEXPECTED_ERROR_MESSAGE);
    }

    return $questionAudioModel->id;
}

public function delete()
{
    $id = $this->request->input('id');
    $questionModel = new Question();
    $questionAnswerModel = new QuestionAnswer();
    $questionAudioModel = new QuestionAudio();

    $questions = $questionModel->where('question_group_id', $id)->get();

    foreach ($questions as $question) {
        $questionAnswerModel->where('question_id', $question->id)->delete();
    }

    $questionAudioModel->where('id', $questions[0]->audio_id)->delete();
    $questionModel->where('question_group_id', $id)->delete();

    $questionGroupModel = new QuestionGroup();
    $questionGroupModel->destroy($id);

    return $this->respond([
        'success' => true,
        'message' => 'Thành công'
    ], 200);
}
}

