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
use App\Models\QuestionImage;
use App\Models\Question;
use PhpOffice\PhpSpreadsheet\IOFactory;

class QuestionController extends Controller
{
    public function index()
    {        $questions = Question::get();
        $data['questions'] = $questions;


        return view('Admin/Question/index', $data);
    }
    public function delete($id)
    {
        $question = Question::find($id);

        if (!$question) {
            abort(404);
        }

        $questionAnswers = QuestionAnswer::where('question_id', $id)->get();

        foreach ($questionAnswers as $questionAnswer) {
            $questionAnswer->delete();
        }

        $questionImages = QuestionImage::where('question_id', $id)->get();

        foreach ($questionImages as $questionImage) {
            $questionImage->delete();
        }
        $question->delete();
        $questionAudio = QuestionAudio::find($question->audio_id);
        if ($questionAudio) {
            $questionAudio->delete();
        }
        // foreach ($questionAudios as $questionAudio) {
        //     $questionAudio->delete();
        // }



        return redirect()->to('dashboard/question');
    }
    public function edit(Request $request, $id)
    {
        $questionID = $id;
        $data['examPart'] = ExamPart::all();

        $question = Question::where('id', $questionID)->first();
        $data['question'] = $question;

        $questionAnswer = QuestionAnswer::where('question_id', $questionID)->get();
        $data['questionAnswer'] = $questionAnswer;

        $data['image'] = QuestionImage::where('question_id', $question->id)->first();
        $data['audio'] = QuestionAudio::where('id', $question->audio_id)->first();

        return view('Admin/Question/edit', $data);
    }
    public function update(Request $request, $id)
    {
        $Question = Question::find($id);
        // Lấy dữ liệu mới từ form sửa đổi
        $partID        = $request->input('part_id');
        $question      = $request->input('question');
        $type          = $request->input('type');
        $rightOption   = $request->input('right_option');
        $options       = $request->input('options');

        // // Cập nhật câu hỏi
        $data = [
            'type'         => $type,
            'exam_part_id' => $partID,
            'right_option' => $rightOption,
            'question'     => $question,
        ];

        $Question->update($data);
         // Cập nhật các câu trả lời
         $QuestionAnswer=QuestionAnswer::where('question_id',$id)->get();
         foreach($QuestionAnswer as $items){
            $items->delete();
         }
         foreach ($options as $value) {
            $answerData = [
                'question_id' => $id,
                'type' => $type,
                'text' => $value,
            ];

            $questionAnswer = QuestionAnswer::create($answerData);
        }
        //Cập nhật image(Nếu có)

        $questionImage = $request->file('question_image');
        if ($questionImage) {
            $fileName = $questionImage->getClientOriginalName();
            $filePath = $questionImage->move('uploads/images', $fileName);
            $fullPath = public_path('uploads/images/' . $fileName);

            // Kiểm tra nếu câu hỏi đã có hình ảnh thì xóa hình ảnh cũ
            if ($Question->id) {
                $image = QuestionImage::where('question_id', $Question->id)->first();
                if ($image) {
                    unlink(public_path('uploads/images/' . $image->image_name));
                    $image->delete();
                }
            }

            // Tạo mới hình ảnh và liên kết với câu hỏi
            $imageData = [
                'question_id' => $Question->id,
                'image_name'  => $fileName,
            ];
            $newImage = QuestionImage::create($imageData);
        }

        $Question->save();


       // Cập nhật audio (nếu có)
        $questionAudio = $request->file('question_audio');
        if ($questionAudio) {
            $fileName = $questionAudio->getClientOriginalName();
            $filePath = $questionAudio->move('uploads/audios', $fileName);
            $fullPath = public_path('uploads/audios/' . $fileName);

            // Kiểm tra nếu câu hỏi đã có audio thì xóa audio cũ
            if ($Question->audio_id) {
                $audio = QuestionAudio::find($Question->audio_id);
                if ($audio) {
                    unlink(public_path('uploads/audios/' . $audio->audio_name));
                }
            }

            // Tạo mới audio và liên kết với câu hỏi
            $audioData = ['audio_name' => $fileName];
            $newAudio = QuestionAudio::create($audioData);
            $Question->audio_id = $newAudio->id;
        }

        $Question->save();

         return redirect()->to('dashboard/question');
    }
    public function detail()
    {

        $data['examPart'] = ExamPart::all();
        $data['questionAnswer'] = QuestionAnswer::all();
        $data['image'] = QuestionImage::all();
        $data['audio'] = QuestionAudio::all();
        return view('Admin/Question/detail',$data);
    }

    public function save(Request $request)
    {
        //Lưu audio
        $questionAudio = $request->file('question_audio');
        $audioData = [];
        $questionAudios = new questionAudio();
        $questionAudios_id=0;
        if ($questionAudio) {
            $fileName = $questionAudio->getClientOriginalName();
            $filePath = $questionAudio->move('uploads/audios', $fileName);
            $fullPath = public_path('uploads/audios/' . $fileName);

            $audioData = [
                'audio_name' => $fileName,
            ];
            $newAudio = $questionAudios::create($audioData);
            $questionAudios_id = $newAudio->id;
        }


        // Lưu câu hỏi
        $partID        = $request->input('part_id');
        $question      = $request->input('question');
        $type          = $request->input('type');
        $rightOption   = $request->input('right_option');
        $options       = $request->input('options');
        $data = [
            'type'         => $type,
            'exam_part_id' => $partID,
            'question_group_id'=> null,
            'audio_id'=>  ($questionAudios_id==0 )?null: $questionAudios_id ,
            'right_option' => $rightOption,
            'question'     => $question,
            'explain'      => 'No explain',
            'status'    =>1,
        ];
        $question = Question::create($data);
        // if (2 < count($options))
		// {
		// 	return redirect()->to('dashboard/question/detail');
		// }
        //Luu dap an
        foreach ($options as $value) {
            $answerData = [
                'question_id' => $question->id,
                'type' => $type,
                'text' => $value,
            ];

            $questionAnswer = QuestionAnswer::create($answerData);
        }

        // Lưu hình ảnh
        $QuestionImage = $request->file('question_image');
        $imageData = [];
        $QuestionImages = new QuestionImage();
        if ($QuestionImage) {
            $fileName = $QuestionImage->getClientOriginalName();
            $filePath = $QuestionImage->move('uploads/images', $fileName);
            $fullPath = public_path('uploads/images/' . $fileName);

            $imageData = [
                'question_id'=> $question->id,
                'image_name' => $fileName,
            ];
            $QuestionImages::create($imageData);
        }
        return redirect()->to('dashboard/question');
	}
}
