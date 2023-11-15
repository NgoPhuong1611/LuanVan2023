<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExamPartModel;
use App\Models\QuestionAnswerModel;
use App\Models\QuestionAudioModel;
use App\Models\QuestionGroupModel;
use App\Models\QuestionModel;
use CodeIgniter\API\ResponseTrait;
use Exception;

class QuestionGroup extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $questionGroupModel = new QuestionGroupModel();
        $questionGroups = $questionGroupModel->findAll();

        $datas['questionGroups'] = $questionGroups;
        return view('Admin/Question/Group/index', $datas);
    }

    public function detail()
    {
        $questionGroupModel = new QuestionGroupModel();
        $examPartModel      = new ExamPartModel();

        $questionGroupID = $this->request->getUri()->getSegment(4);

        $questionGroup = $questionGroupModel->where('id', $questionGroupID)->first();
        if ($questionGroupID && !$questionGroup) {
            return redirect()->to('/dashboard/question-group/');
        }
        $data['examPart'] = $examPartModel->findAll();

        if (!$questionGroup) {
            return view('Admin/Question/Group/detail', $data);
        }

        $questionModel       = new QuestionModel();
        $questionAnswerModel = new QuestionAnswerModel();
        $questionAudioModel  = new QuestionAudioModel();

        $questions = $questionModel->where('question_group_id', $questionGroupID)->findAll();

        foreach ($questions as $key => $question) {
            $questions[$key]['options'] = $questionAnswerModel->where('question_id', $question['id'])->findAll();;
        }

        $data['questions'] = $questions;

        if (isset($questions[0]['audio_id'])) {
            $audio = $questionAudioModel->where('id', $questions[0]['audio_id'])->first();
            $data['audio'] = $audio;
        }

        $data['questionGroup'] = $questionGroup;
        return view('Admin/Question/Group/detail', $data);
    }

    public function save()
    {
        $questionGroupIDPost = $this->request->getPost('question_group_id');
        $title               = $this->request->getPost('title');
        $partID              = $this->request->getPost('part_id');
        $paragraph           = $this->request->getPost('paragraph');
        $questionGroupAudio  = $this->request->getFile('question_group_audio');
        $questions           = $this->request->getPost('questions');
        $oldQuestions        = $this->request->getPost('old_questions');
        $rightOption         = $this->request->getPost('right_option');
        $oldOptions          = $this->request->getPost('old_options');
        $options             = $this->request->getPost('options');
        $type                = $this->request->getPost('type');
        $data = [
            'exam_part_id' =>  $partID,
            'title'        =>  $title,
            'paragraph'    =>  $paragraph,
        ];

        //Khởi tạo model
        $questionGroupModel = new QuestionGroupModel();

        if ($questionGroupModel->where('title', $title)->first() && !$questionGroupIDPost)
        {
            return redirect()->withInput()->with('error', 'Title nhóm câu hỏi đã tồn tại!')->to('dashboard/question-group/detail');
        }

        //Lưu dữ liệu
        if ($questionGroupIDPost) {
            $data['id'] = $questionGroupIDPost;
        }
        $isInsert = $questionGroupModel->save($data);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        $questionGroupID = $questionGroupModel->getInsertID();
        if ($questionGroupIDPost) {
            $questionGroupID = $questionGroupIDPost;
        }

        //Còn bug
        $audioID = $this->saveAudio($questionGroupAudio);

        $questionModel = new QuestionModel();
        $questionAnswerModel = new QuestionAnswerModel();
        //0 text, 1 image, 2 audio
        $optionType = 0;
        if ($questionGroupAudio) {
            $optionType = $audioID == 0 ? 1 : 2;
        }
        foreach ($questions as $key => $question) {
            if ($questionModel->where('question', $question)->first())
            {
                return redirect()->withInput()->with('error', 'Câu hỏi đã tồn tại!')->to('dashboard/question-group/detail');
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

            $isInsert = $questionModel->save($data);
            if (!$isInsert) {
                throw new Exception(UNEXPECTED_ERROR_MESSAGE);
            }

            $questionID = $questionModel->getInsertID();
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
                $isInsert = $questionAnswerModel->save($data);
                if (!$isInsert) {
                    throw new Exception(UNEXPECTED_ERROR_MESSAGE);
                }
            }
        }

        //Sau khi thêm thì chuyển hướng về trang index.
        return redirect()->to('dashboard/question-group');
    }

    private function saveAudio($file)
    {
        if (!$file) {
            return 0;
        }
        $file->move(AUDIO_PATH);
        $data = [
            'audio_name' => $file->getName()
        ];
        $questionAudioModel = new QuestionAudioModel();
        $isInsert = $questionAudioModel->insert($data);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return $questionAudioModel->getInsertID();
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $questionModel       = new QuestionModel();
        $questionAnswerModel = new QuestionAnswerModel();
        $questionAudioModel  = new QuestionAudioModel();

        $questions = $questionModel->where('question_group_id', $id)->findAll();
        foreach ($questions as $question) {
            $questionAnswerModel->where('question_id', $question['id'])->delete();
        }
        $questionAudioModel->where('id', $questions[0]['audio_id'])->delete();
        $questionModel->where('question_group_id', $id)->delete();
        $questionGroupModel = new QuestionGroupModel();
        $questionGroupModel->delete($id);

        return $this->respond([
            'success' => true,
            'message' => 'Thành công'
        ], 200);
    }
}
