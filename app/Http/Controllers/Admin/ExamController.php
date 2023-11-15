<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Database\Migrations\ExamToExamPart;
use App\Models\AdminModel;
use App\Models\ExamModel;
use App\Models\ExamPartModel;
use App\Models\ExamQuestionGroup;
use App\Models\ExamQuestionSingle;
use App\Models\ExamToExamPartModel;
use App\Models\QuestionGroupModel;
use App\Models\QuestionModel;
use Exception;

class Exam extends BaseController
{
    public function index()
    {
        $AdminModel = new AdminModel();
        $admin = $AdminModel->findAll();
        $examModel = new ExamModel();
        $exam = $examModel->findAll();
        $datas['exam'] = $exam;
        $datas['admin'] = $admin;
        return view('Admin/Exam/index', $datas);
    }
    public function detail()
    {
        // $ExamPartModel = new ExamPartModel();
        // $part = $ExamPartModel->findAll();
        // $part1 = $ExamPartModel->where('part_number', 1)->findAll();
        // $part2 = $ExamPartModel->where('part_number', 2)->findAll();
        // $part3 = $ExamPartModel->where('part_number', 3)->findAll();
        // $part4 = $ExamPartModel->where('part_number', 4)->findAll();
        // $part5 = $ExamPartModel->where('part_number', 5)->findAll();
        // $part6 = $ExamPartModel->where('part_number', 6)->findAll();
        // $part7 = $ExamPartModel->where('part_number', 7)->findAll();
        // $datas['part1'] = $part1;
        // $datas['part2'] = $part2;
        // $datas['part3'] = $part3;
        // $datas['part4'] = $part4;
        // $datas['part5'] = $part5;
        // $datas['part6'] = $part6;
        // $datas['part7'] = $part7;
        return view('Admin/Exam/detail');
    }
    public function save()
    {
        $author = session()->get('id');
        $level = $this->request->getPost('level');
        $title = $this->request->getPost('title');
        $status = $this->request->getPost('status');
        $datas = [
            'id' => NULL,
            'author' => $author,
            'level' => $level,
            'title' => $title,
            'status' => $status,
        ];
        $examModel = new ExamModel();
        $isInsert = $examModel->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        //them exam_to_exam_part
        $exam_id = $examModel->getInsertID();
        $ExamPartModel = new ExamPartModel();
        $part = $ExamPartModel->findAll();
        $part1 = $ExamPartModel->where('part_number', 1)->orderBy('RAND()')->findAll();
        $part2 = $ExamPartModel->where('part_number', 2)->orderBy('RAND()')->findAll();
        $part3 = $ExamPartModel->where('part_number', 3)->orderBy('RAND()')->findAll();
        $part4 = $ExamPartModel->where('part_number', 4)->orderBy('RAND()')->findAll();
        $part5 = $ExamPartModel->where('part_number', 5)->orderBy('RAND()')->findAll();
        $part6 = $ExamPartModel->where('part_number', 6)->orderBy('RAND()')->findAll();
        $part7 = $ExamPartModel->where('part_number', 7)->orderBy('RAND()')->findAll();
        // $exam_part_id1 = $this->request->getPost('part1');
        // $exam_part_id2 = $this->request->getPost('part2');
        // $exam_part_id3 = $this->request->getPost('part3');
        // $exam_part_id4 = $this->request->getPost('part4');
        // $exam_part_id5 = $this->request->getPost('part5');
        // $exam_part_id6 = $this->request->getPost('part6');
        // $exam_part_id7 = $this->request->getPost('part7');
        $data_part1 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part1[0]['id'],
        ];
        $data_part2 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part2[0]['id'],
        ];
        $data_part3 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part3[0]['id'],
        ];
        $data_part4 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part4[0]['id'],
        ];
        $data_part5 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part5[0]['id'],
        ];
        $data_part6 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part6[0]['id'],
        ];
        $data_part7 = [
            'exam_id ' => $exam_id,
            'exam_part_id' => $part7[0]['id'],
        ];
        $ExamToExamPartModel = new ExamToExamPartModel();
        $isInsert1 = $ExamToExamPartModel->insert($data_part1);
        $isInsert1 = $ExamToExamPartModel->insert($data_part2);
        $isInsert1 = $ExamToExamPartModel->insert($data_part3);
        $isInsert1 = $ExamToExamPartModel->insert($data_part4);
        $isInsert1 = $ExamToExamPartModel->insert($data_part5);
        $isInsert1 = $ExamToExamPartModel->insert($data_part6);
        $isInsert1 = $ExamToExamPartModel->insert($data_part7);

        //them exam_question_group
        $QuestionGroupModel = new QuestionGroupModel();
        $group6 = $QuestionGroupModel->where('exam_part_id', $part6[0]['id'])->orderBy('RAND()')->findAll(4);
        $group7 = $QuestionGroupModel->where('exam_part_id', $part7[0]['id'])->orderBy('RAND()')->findAll(15);
        $ExamQuestionGroup = new ExamQuestionGroup();
        foreach ($group6 as $value) {
            $data_group6 = [
                'question_group_id' => $value['id'],
                'exam_id' => $exam_id,
            ];
            $ExamQuestionGroup->insert($data_group6);
        }
        foreach ($group7 as $value) {
            $data_group7 = [
                'question_group_id' => $value['id'],
                'exam_id' => $exam_id,

            ];
            $ExamQuestionGroup->insert($data_group7);
        }
        //them ExamQuestionSingle
        $ExamQuestionSingle = new ExamQuestionSingle();
        $QuestionModel = new QuestionModel();
        $question1 = $QuestionModel->where('exam_part_id', $part1[0]['id'])->findAll(6);
        $question2 = $QuestionModel->where('exam_part_id', $part2[0]['id'])->findAll(25);
        $question3 = $QuestionModel->where('exam_part_id', $part3[0]['id'])->findAll(39);
        $question4 = $QuestionModel->where('exam_part_id', $part4[0]['id'])->findAll(30);
        $question5 = $QuestionModel->where('exam_part_id', $part5[0]['id'])->orderBy('RAND()')->findAll(30);
        foreach ($question1 as $value) {
            $data_question = [
                'question_id ' => $value['id'],
                'exam_id' => $exam_id,

            ];
            $ExamQuestionSingle->insert($data_question);
        }
        foreach ($question2 as $value) {
            $data_question = [
                'question_id ' => $value['id'],
                'exam_id' => $exam_id,

            ];
            $ExamQuestionSingle->insert($data_question);
        }
        foreach ($question3 as $value) {
            $data_question = [
                'question_id ' => $value['id'],
                'exam_id' => $exam_id,

            ];
            $ExamQuestionSingle->insert($data_question);
        }
        foreach ($question4 as $value) {
            $data_question = [
                'question_id ' => $value['id'],
                'exam_id' => $exam_id,

            ];
            $ExamQuestionSingle->insert($data_question);
        }
        foreach ($question5 as $value) {
            $data_question = [
                'question_id ' => $value['id'],
                'exam_id' => $exam_id,

            ];
            $ExamQuestionSingle->insert($data_question);
        }


        return redirect()->to('dashboard/exam');
    }
    public function delete()
    {
        $exam_id = $this->request->getUri()->getSegment(4);

        $ExamQuestionSingle = new ExamQuestionSingle();
        $ExamQuestionSingle->where('exam_id', $exam_id)->delete();
        $ExamToExamPartModel = new ExamToExamPartModel();
        $ExamToExamPartModel->where('exam_id', $exam_id)->delete();
        $ExamQuestionGroup = new ExamQuestionGroup();
        $ExamQuestionGroup->where('exam_id', $exam_id)->delete();
        $ExamModel = new ExamModel();
        $ExamModel->delete($exam_id);

        return redirect()->to('dashboard/exam');
    }
    public function edit()
    {
    }
    public function update()
    {
        return view('User/Exam/fullTestListen');
    }
}
