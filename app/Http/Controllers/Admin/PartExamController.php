<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\ExamPart;


class PartExamController extends Controller
{
    public function index()
    {
        $examPartModel = new ExamPart;
        $examParts = $examPartModel->get();

        $datas['examParts'] = $examParts;
        return view('Admin/Exam/Part/index', $datas);
    }
    public function detail()
    {
        return view('Admin/Exam/Part/detail');
    }
    public function save(Request $request)
    {
        $title = $request->input('title');
        $direction = $request->input('direction');
        $part_number = $request->input('part_number');

        $data = [
            'part_number' => $part_number,
            'title' => $title,
            'direction' => $direction,
        ];
        $examPart = ExamPart::create($data);
        return redirect()->to('dashboard/exam-part');
    }
    public function delete($id)
    {
        $examPart = ExamPart::find($id);

        if (!$examPart) {
            // Handle case where the record is not found
            // You might want to return a response or redirect with an error message
        }

        $examPart->delete();
        return redirect()->to('dashboard/exam-part');
    }
    public function edit($id)
    {
        $examPart = ExamPart::find($id);

        if (!$examPart) {
            // Handle case where the record is not found
            // You might want to return a response or redirect with an error message
        }

        $data = ['examPart' => $examPart];
        return view('Admin/Exam/Part/edit', $data);
    }
    public function update(Request $request, $id)
    {
        $examPart = ExamPart::find($id);

        $title =  $request->input('title');

        $direction =  $request->input('direction');
        $part_number =  $request->input('part_number');
        $datas = [
            'part_number' => $part_number,
            'title'        =>  $title,

            'direction'    =>  $direction,
        ];
        $examPart->update($datas);
        return redirect()->to('dashboard/exam-part');
    }
}
