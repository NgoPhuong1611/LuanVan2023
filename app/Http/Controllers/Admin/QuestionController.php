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
    {
        $questions = Question::all();
        $data['questions'] = $questions;

        return view('Admin/Question/index', $data);
    }
    public function detail($questionID = null)
    {
        $examPart = new ExamPart();
        $data['examPart'] = $examPart->get(); // Assuming get() method is similar to findAll() in CodeIgniter

        if (!$questionID) {
            return view('Admin.Question.detail', $data);
        }

        $questionModel = new Question();
        $question = $questionModel->find($questionID);

        if (!$question) {
            return redirect()->route('dashboard.question.index');
        }

        $questionAnswerModel = new QuestionAnswer();
        $questionAnswer = $questionAnswerModel->where('question_id', $questionID)->get();

        $questionImageModel = new QuestionImage();
        $questionAudioModel = new QuestionAudion();

        $data['image'] = $questionImageModel->where('question_id', $question->id)->first();
        $data['audio'] = $questionAudioModel->find($question->audio_id);

        $data['question'] = $question;
        $data['questionAnswer'] = $questionAnswer;

        return view('Admin.Question.detail', $data);
    }


    public function save(Request $request)
    {
        $oldQuestionID = $request->input('id');
        $partID = $request->input('part_id');
        $question = $request->input('question');
        $type = $request->input('type');
        $rightOption = $request->input('right_option');
        $oldOptionsID = $request->input('old_options_id');
        $options = $request->input('options');
        $oldAudioID = $request->input('old_audio_id');
        $oldImageID = $request->input('old_image_id');

        $data = [
            'exam_part_id' => $partID,
            'type' => $type,
            'right_option' => $rightOption,
            'question' => $question,
            'explain' => 'Không có giải thích',
        ];

        if (count($options) > 2) {
            return redirect()->route('dashboard.question.detail');
        }

        $uploader = new Upload();

        $questionAudio = $request->file('question_audio');
        if ($questionAudio && $questionAudio->isValid()) {
            $audioName = $uploader->audio($questionAudio);
            if ($audioName) {
                $questionAudioModel = new QuestionAudio();
                $audioData = [
                    'audio_name' => $audioName
                ];

                if ($oldAudioID) {
                    $audioName = $questionAudioModel->select('audio_name')->where('id', $oldAudioID)->first();
                    unlink(AUDIO_PATH . '/' . $audioName['audio_name']);
                    $audioData['id'] = $oldAudioID;
                }

                $questionAudioModel->fill($audioData)->save();

                if ($questionAudioModel->id != 0) {
                    $data['audio_id'] = $questionAudioModel->id;
                }
            }
        }

        if ($oldOptionsID) {
            $data['id'] = $oldQuestionID;
        }

        $questionModel = new Question();
        if ($questionModel->where('question', $question)->first() && !$oldQuestionID) {
            return redirect()->route('dashboard.question.detail')->withInput()->with('error', 'Câu hỏi đã tồn tại!');
        }

        $questionModel->fill($data)->save();

        if ($oldOptionsID) {
            $questionAnswerModel = new QuestionAnswer();
            $questionAnswerModel->updateBatch($oldOptionsID, $options);

            $questionImage = $request->file('question_image');
            if ($questionImage && $questionImage->isValid()) {
                $uploader->validation_image($questionImage->getClientOriginalName());
                $imageName = $uploader->singleImages($questionImage);

                $imgData = [
                    'image_name' => $imageName
                ];

                $questionImageModel = new QuestionImage();
                if ($oldImageID) {
                    $imgData['id'] = $oldImageID;
                    $imgName = $questionImageModel->select('image_name')->where('id', $oldImageID)->first();
                    @unlink(IMAGE_PATH . '/' . $imgName['image_name']);
                }

                $questionImageModel->fill($imgData)->save();
            }

            return redirect()->route('dashboard.question');
        }

        $questionID = $questionModel->id;

        $questionImage = $request->file('question_image');
        if ($questionImage && $questionImage->isValid()) {
            $uploader->validation_image($questionImage->getClientOriginalName());
            $imageName = $uploader->singleImages($questionImage);

            $imgData = [
                'question_id' => $questionID,
                'image_name' => $imageName
            ];

            $questionImageModel = new QuestionImage();
            $questionImageModel->fill($imgData)->save();
        }

        $questionAnswerModel = new QuestionAnswer();
        $questionAnswerModel->insertBatch($questionID, $options);

        return redirect()->route('dashboard.question');
    }

    // public function uploadExcel()
    // {
    //     return view('Admin/Question/Upload/upload_excel');
    // }

    // public function uploadExcelSave()
    // {
    //     $allFiles = $this->request->getFiles();
    //     $fileExcel = $allFiles['file_excel'][0];
	// 	$audioFile = $allFiles['question_audios'];
	// 	$imageFile = $allFiles['question_images'];


    //     if (0 != $fileExcel->getError()) return redirectWithMessage('dashboard/question/upload-excel', 'Không thể tải lên tệp, thử lại sau!');
    //     if (!$fileExcel->isValid() || $fileExcel->hasMoved()) {
    //         return false;
    //     }

    //     $newName = $fileExcel->getRandomName();
    //     $fileName = $newName;
    //     $fileExcel->move(UPLOAD_PATH, $newName);

    //     $reader = IOFactory::createReader("Xlsx");
	// 	$spreadSheet = $reader->load(UPLOAD_PATH . '/' . $fileName);

    //     if (!$spreadSheet) return redirectWithMessage('dashboard/question/upload-excel', 'Có lỗi xảy ra, thử lại sau!');

	// 	if ($spreadSheet->getSheetCount() != 8)
	// 	{
	// 		unlink(UPLOAD_PATH . '/' . $fileName);
	// 		return redirectWithMessage('dashboard/question/upload-excel', 'File exel không đúng định dạng');
	// 	}
	// 	$arrayCheck = ['image', 'audio', 'paragraph', 'question', 'option1', 'option2', 'option3', 'option4', 'correctanswer'];

    //     for ($i = 0; $i < 8; $i++) {
	// 		$validateSheet = $spreadSheet->getSheet($i)->rangeToArray('A1:I1');
	// 		if (!empty(array_diff($validateSheet[0], $arrayCheck)))
	// 		{
	// 			unlink(UPLOAD_PATH . '/' . $fileName);
	// 			return redirectWithMessage('dashboard/question/upload-excel', 'File exel không đúng định dạng');
	// 		}
	// 	}

    //     $part1 = $this->myFilter($spreadSheet->getSheet(0)->rangeToArray('A2:I500'));
    //     $this->saveQuestionPart1($part1);

    //     $part2 = $this->myFilter($spreadSheet->getSheet(1)->rangeToArray('A2:I500'));
    //     $this->saveQuestionPart2($part2);

	// 	$part3 = array_chunk($this->myFilter($spreadSheet->getSheet(2)->rangeToArray('A2:I500')), 3);
    //     $this->saveQuestionPartN($part3, 3);

    //     $part4 = array_chunk($this->myFilter($spreadSheet->getSheet(3)->rangeToArray('A2:I500')), 3);
    //     $this->saveQuestionPartN($part4, 4);

    //     $part5 = $this->myFilter($spreadSheet->getSheet(4)->rangeToArray('A2:I500'));
    //     $this->saveQuestionPart5($part5);

    //     $part6 = array_chunk($this->myFilter($spreadSheet->getSheet(5)->rangeToArray('A2:I500')), 3);
    //     $this->saveQuestionPartN($part6, 6, 2);

    //     $part7_1 = array_chunk($this->myFilter($spreadSheet->getSheet(6)->rangeToArray('A2:I500')), 5);
    //     $this->saveQuestionPartN($part7_1, 7, 2, 5);

    //     $part7_2 = array_chunk($this->myFilter($spreadSheet->getSheet(7)->rangeToArray('A2:I500')), 3);
	// 	$this->saveQuestionPartN($part7_2, 7, 2);

    //     unlink(UPLOAD_PATH . '/' . $fileName);
    //     return redirect()->to('dashboard/question');
    // }

    private function myFilter($dataSet)
    {
        return collect($dataSet)->filter(function ($value) {
            return $value[4] !== null;
        })->all();
    }
    private function saveQuestionPart1($dataSet)
{
    $questionGroupModel = new QuestionGroup();
    $questionAudioModel = new QuestionAudio();
    $questionModel = new Question();
    $questionImageModel = new QuestionImage();
    $questionAnswerModel = new QuestionAnswer();

    $dataGroup = [
        'exam_part_id' => 1,
        'title' => 'Question Part 1',
        'paragraph' => $dataSet[0][2],
    ];

    $questionGroup = $questionGroupModel->create($dataGroup);

    foreach ($dataSet as $item) {
        $audio = $questionAudioModel->create(['audio_name' => $item[1]]);
        $audioID = $audio->id;

        if (!in_array($item[8], QUESTION)) {
            $item[8] = 'A';
        }

        $dataQuestion = [
            'exam_part_id' => 1,
            'type' => 1,
            'question_group_id' => $questionGroup->id,
            'audio_id' => $audioID,
            'right_option' => QUESTION[$item[8]],
            'question' => $item[3],
            'explain' => 'No explain',
        ];

        $question = $questionModel->create($dataQuestion);

        $dataImage = [
            'question_id' => $question->id,
            'image_name' => $item[0],
        ];

        $questionImageModel->create($dataImage);

        $dataAnswers = [
            [
                'question_id' => $question->id,
                'type' => 1,
                'text' => $item[4],
            ],
            [
                'question_id' => $question->id,
                'type' => 1,
                'text' => $item[5],
            ],
            [
                'question_id' => $question->id,
                'type' => 1,
                'text' => $item[6],
            ],
            [
                'question_id' => $question->id,
                'type' => 1,
                'text' => $item[7],
            ],
        ];

        $questionAnswerModel->insert($dataAnswers);
    }
}

private function saveQuestionPart2($dataSet)
{
    $questionGroupModel = new QuestionGroup();
    $questionAudioModel = new QuestionAudio();
    $questionModel = new Question();
    $questionAnswerModel = new QuestionAnswer();

    $dataGroup = [
        'exam_part_id' => 2,
        'title' => 'Question Part 2',
        'paragraph' => $dataSet[0][2],
    ];

    $questionGroup = $questionGroupModel->create($dataGroup);

    foreach ($dataSet as $item) {
        $audio = $questionAudioModel->create(['audio_name' => $item[1]]);
        $audioID = $audio->id;

        if (!in_array($item[8], QUESTION)) {
            $item[8] = 'A';
        }

        $dataQuestion = [
            'exam_part_id' => 2,
            'type' => 1,
            'question_group_id' => $questionGroup->id,
            'audio_id' => $audioID,
            'right_option' => QUESTION[$item[8]],
            'question' => $item[3],
            'explain' => 'No explain',
        ];

        $questionID = $questionModel->create($dataQuestion)->id;

        $dataImage = [
            'question_id' => $questionID,
            'image_name' => $item[0],
        ];

        $questionImageModel = new QuestionImage();
        $questionImageModel->create($dataImage);

        $dataAnswers = [
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[4],
            ],
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[5],
            ],
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[6],
            ],
        ];

        $questionAnswerModel->insert($dataAnswers);
    }
}

private function saveQuestionPart5($dataSet)
{
    $questionModel = new Question();
    $questionAnswerModel = new QuestionAnswer();

    foreach ($dataSet as $item) {
        if (!in_array($item[8], QUESTION)) {
            $item[8] = 'A';
        }

        $dataQuestion = [
            'exam_part_id' => 5,
            'type' => 2,
            'right_option' => QUESTION[$item[8]],
            'question' => $item[3],
            'explain' => 'No explain',
        ];

        $questionID = $questionModel->create($dataQuestion)->id;

        $dataAnswers = [
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[4],
            ],
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[5],
            ],
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[6],
            ],
            [
                'question_id' => $questionID,
                'type' => 1,
                'text' => $item[7],
            ],
        ];

        $questionAnswerModel->insert($dataAnswers);
    }
}

private function saveQuestionPartN($dataSet, $part, $type = 1, $question_per_paragraph = 3)
{
    $questionAudioModel = new QuestionAudio();
    $questionModel = new Question();
    $questionAnswerModel = new QuestionAnswer();
    $questionGroupModel = new QuestionGroup();

    $i = 0;

    foreach ($dataSet as $key => $item) {
        $dataGroup = [
            'exam_part_id' => $part,
            'title' => 'Question Part ' . $part . ' - Num ' . $key,
            'paragraph' => $item[$i][2] ?? '',
        ];

        $questionGroupID = $questionGroupModel->create($dataGroup)->id;
        $audioID = 0;

        if (isset($item[$i][1]) && $item[$i][0] != null) {
            $audioID = $questionAudioModel->create(['audio_name' => $item[$i][1]])->id;
        }

        foreach ($item as $subItem) {
            if (!in_array($subItem[8], QUESTION)) {
                $subItem[8] = 'A';
            }

            $dataQuestion = [
                'exam_part_id' => $part,
                'type' => $type,
                'question_group_id' => $questionGroupID,
                'audio_id' => $audioID != 0 ? $audioID : null,
                'right_option' => QUESTION[$subItem[8] ?? 'A'],
                'question' => $subItem[3],
                'explain' => 'No explain',
            ];

            $questionID = $questionModel->create($dataQuestion)->id;

            $dataAnswers = [
                [
                    'question_id' => $questionID,
                    'type' => 1,
                    'text' => $subItem[4],
                ],
                [
                    'question_id' => $questionID,
                    'type' => 1,
                    'text' => $subItem[5],
                ],
                [
                    'question_id' => $questionID,
                    'type' => 1,
                    'text' => $subItem[6],
                ],
                [
                    'question_id' => $questionID,
                    'type' => 1,
                    'text' => $subItem[7],
                ],
            ];

            $questionAnswerModel->insert($dataAnswers);
        }

        $i += 1;

        if ($question_per_paragraph == $i) {
            $i = 0;
        }
    }
}
}
