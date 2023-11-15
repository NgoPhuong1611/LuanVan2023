<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExamPartModel;
use Exception;

class PartExam extends BaseController
{
    public function index()
    {
        $examPartModel = new ExamPartModel;
        $examParts = $examPartModel->paginate(10);

        $datas['examParts'] = $examParts;
        return view('Admin/Exam/Part/index', $datas);
    }
    public function detail()
    {
        return view('Admin/Exam/Part/detail');
    }
    public function save()
    {
        $title = $this->request->getPost('title');
        // $slug = $this->request->getPost('status');
        $direction = $this->request->getPost('paragraph');
        $part_number = $this->request->getPost('part_number');
        $datas = [
            'part_number' => $part_number,
            'title'        =>  $title,
            // 'slug'       =>  $slug,
            'direction'    =>  $direction,
        ];
        //Khởi tạo model
        $examPartModel = new ExamPartModel;
        // //Thêm dữ liệu
        $isInsert = $examPartModel->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/exam-part');
    }
    public function delete()
    {
        $id = $this->request->getUri()->getSegment(4);

        $examPartModel = new ExamPartModel();
        $examPartModel->delete($id);
        return redirect()->to('dashboard/exam-part');
    }
    public function edit()
    {
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        $id = $this->request->getUri()->getSegment(4);

        $examPartModel = new ExamPartModel();
        $examPart = $examPartModel->where('id',$id)->first();
        $data['examPart'] = $examPart;
        return view('Admin/Exam/Part/edit', $data);
    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        $examPartModel = new ExamPartModel();
        
        $title = $this->request->getPost('title');

        $direction = $this->request->getPost('paragraph');
        $part_number = $this->request->getPost('part_number');
        $datas = [
            'part_number' => $part_number,
            'title'        =>  $title,

            'direction'    =>  $direction,
        ];
        $examPartModel->update($id, $datas);
        return redirect()->to('dashboard/exam-part');
    }
}
