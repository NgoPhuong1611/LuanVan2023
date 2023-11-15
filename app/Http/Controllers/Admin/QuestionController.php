<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Database\Migrations\QuestionAudio;
use App\Libraries\Upload;
use App\Models\ExamPartModel;
use App\Models\QuestionAnswerModel;
use App\Models\QuestionAudioModel;
use App\Models\QuestionGroupModel;
use App\Models\QuestionImageModel;
use App\Models\QuestionModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Question extends BaseController
{
    public function index()
    {
        $questionModel = new QuestionModel();
        $questions = $questionModel->findAll();
        $data['questions'] = $questions;

        return view('Admin/Question/index', $data);
    }
    public function detail()
    {
        $questionID = $this->request->getUri()->getSegment(4);
        $examPartModel = new ExamPartModel();
        $data['examPart'] = $examPartModel->findAll();
        if (!$questionID) return view('Admin/Question/detail', $data);

        $questionModel = new QuestionModel();
        $question = $questionModel->where('id', $questionID)->first();
        if ($questionID && !$question) {
            return redirect()->to('/dashboard/question/');
        }
       
        $questionAnswerModel = new QuestionAnswerModel();
        $questionAnswer = $questionAnswerModel->where('question_id', $questionID)->findAll();
        $questionImageModel = new QuestionImageModel();
        $questionAudioModel = new QuestionAudioModel();
        $data['image'] =  $questionImageModel->where('question_id', $question['id'])->first();
        $data['audio'] =  $questionAudioModel->where('id', $question['audio_id'])->first();
        
        $data['question'] = $question;
        $data['questionAnswer'] = $questionAnswer;

        return view('Admin/Question/detail', $data);
    }

    public function save()
    {
        $oldQuestionID = $this->request->getPost('id');
        $partID        = $this->request->getPost('part_id');
        $question      = $this->request->getPost('question');
        $type          = $this->request->getPost('type');
        $rightOption   = $this->request->getPost('right_option');
        $oldOptionsID  = $this->request->getPost('old_options_id');
        $options       = $this->request->getPost('options');
        $oldAudioID    = $this->request->getPost('old_audio_id');
        $oldImageID    = $this->request->getPost('old_image_id');
        $data = [
            'exam_part_id' => $partID,
            'type'         => $type,
            'right_option' => $rightOption,
            'question'     => $question,
            'explain'      => 'No explain',
        ];

		if (2 < count($options))
		{
			return redirect()->to('dashboard/question/detail');
		}

        $uploader = new Upload();

        $questionAudio = $this->request->getFile('question_audio');
        if (isset($questionAudio) && 0 == $questionAudio->getError())
        {
            $audioName = $uploader->audio($questionAudio);
            if ($audioName)
            {
                $questionAudioModel = new QuestionAudioModel();
                $audioData = [
                    'audio_name' => $audioName
                ];
                if ($oldAudioID) {
                    $audioName = $questionAudioModel->select('audio_name')->where('id', $oldAudioID)->first();
                    unlink(AUDIO_PATH . '/' . $audioName['audio_name']);
                    $audioData['id'] = $oldAudioID;
                }
                $questionAudioModel->save($audioData);
                if ($questionAudioModel->getInsertID() != 0) {
                    $data['audio_id '] = $questionAudioModel->getInsertID();
                }
            }
        }

        if ($oldOptionsID) {
            $data['id'] = $oldQuestionID;
        }

        $questionModel = new QuestionModel();
		if ($questionModel->where('question', $question)->first() && !$oldQuestionID)
		{
			return redirect()->withInput()->with('error', 'Câu hỏi đã tồn tại!')->to('dashboard/question/detail');
		}
        $questionModel->save($data);
        unset($data);

        $questionImage = $this->request->getFile('question_image');

        if ($oldOptionsID) {
            foreach ($oldOptionsID as $key => $oldID) {
                $data[] = [
                    'id' => $oldID,
                    'text' => $options[$key]
                ];
            }
            $questionAnswerModel = new QuestionAnswerModel();
            $questionAnswerModel->updateBatch($data, 'id');


            if (isset($questionImage) && 0 == $questionImage->getError())
            {
                if ($uploader->validation_image($questionImage->getName()))
                {
                    $imageName = $uploader->singleImages($questionImage);

                    $imgData = [
                        'image_name' => $imageName
                    ];

                    $questionImageModel = new QuestionImageModel();
                    if ($oldImageID)
                    {
                        $imgData['id'] = $oldImageID;
                        $imgName = $questionImageModel->select('image_name')->where('id', $oldImageID)->first();
                        @unlink(IMAGE_PATH . '/' . $imgName['image_name']);
                    }
                    $questionImageModel->save($imgData);
                }
            }
            return redirect()->to('dashboard/question');
        }

        $questionID = $questionModel->getInsertID();

        if (isset($questionImage) && 0 == $questionImage->getError())
        {
            if ($uploader->validation_image($questionImage->getName()))
            {
                $imageName = $uploader->singleImages($questionImage);

                $imgData = [
                    'question_id' => $questionID,
                    'image_name' => $imageName
                ];

                $questionImageModel = new QuestionImageModel();
                $questionImageModel->save($imgData);
            }
        }

        foreach ($options as $option) {
            $data[] = [
                'question_id ' => $questionID,
                'text'         => $option
            ];
        }
        $questionAnswerModel = new QuestionAnswerModel();
        $questionAnswerModel->insertBatch($data);

        return redirect()->to('dashboard/question');
    }

    public function uploadExcel()
    {
        return view('Admin/Question/Upload/upload_excel');
    }

    public function uploadExcelSave()
    {
        $allFiles = $this->request->getFiles();
        $fileExcel = $allFiles['file_excel'][0];
		$audioFile = $allFiles['question_audios'];
		$imageFile = $allFiles['question_images'];


        if (0 != $fileExcel->getError()) return redirectWithMessage('dashboard/question/upload-excel', 'Không thể tải lên tệp, thử lại sau!');
        if (!$fileExcel->isValid() || $fileExcel->hasMoved()) {
            return false;
        }

        $newName = $fileExcel->getRandomName();
        $fileName = $newName;
        $fileExcel->move(UPLOAD_PATH, $newName);

        $reader = IOFactory::createReader("Xlsx");
		$spreadSheet = $reader->load(UPLOAD_PATH . '/' . $fileName);

        if (!$spreadSheet) return redirectWithMessage('dashboard/question/upload-excel', 'Có lỗi xảy ra, thử lại sau!');

		if ($spreadSheet->getSheetCount() != 8)
		{
			unlink(UPLOAD_PATH . '/' . $fileName);
			return redirectWithMessage('dashboard/question/upload-excel', 'File exel không đúng định dạng');
		}
		$arrayCheck = ['image', 'audio', 'paragraph', 'question', 'option1', 'option2', 'option3', 'option4', 'correctanswer'];
		
        for ($i = 0; $i < 8; $i++) {
			$validateSheet = $spreadSheet->getSheet($i)->rangeToArray('A1:I1');
			if (!empty(array_diff($validateSheet[0], $arrayCheck)))
			{
				unlink(UPLOAD_PATH . '/' . $fileName);
				return redirectWithMessage('dashboard/question/upload-excel', 'File exel không đúng định dạng');
			}
		}

        $part1 = $this->myFilter($spreadSheet->getSheet(0)->rangeToArray('A2:I500'));
        $this->saveQuestionPart1($part1);

        $part2 = $this->myFilter($spreadSheet->getSheet(1)->rangeToArray('A2:I500'));
        $this->saveQuestionPart2($part2);

		$part3 = array_chunk($this->myFilter($spreadSheet->getSheet(2)->rangeToArray('A2:I500')), 3);
        $this->saveQuestionPartN($part3, 3);

        $part4 = array_chunk($this->myFilter($spreadSheet->getSheet(3)->rangeToArray('A2:I500')), 3);
        $this->saveQuestionPartN($part4, 4);

        $part5 = $this->myFilter($spreadSheet->getSheet(4)->rangeToArray('A2:I500'));
        $this->saveQuestionPart5($part5);

        $part6 = array_chunk($this->myFilter($spreadSheet->getSheet(5)->rangeToArray('A2:I500')), 3);
        $this->saveQuestionPartN($part6, 6, 2);

        $part7_1 = array_chunk($this->myFilter($spreadSheet->getSheet(6)->rangeToArray('A2:I500')), 5);
        $this->saveQuestionPartN($part7_1, 7, 2, 5);

        $part7_2 = array_chunk($this->myFilter($spreadSheet->getSheet(7)->rangeToArray('A2:I500')), 3);
		$this->saveQuestionPartN($part7_2, 7, 2);
        
        unlink(UPLOAD_PATH . '/' . $fileName);
        return redirect()->to('dashboard/question');
    }

    private function myFilter($dataSet)
    {
        return array_filter($dataSet,
            function($value) {
                return $value[4] !== null;
            });
    }

    private function saveQuestionPart1($dataSet)
	{
		$data = [
			'exam_part_id' =>  1,
			'title'        =>  'Question Part 1',
			'paragraph'    =>  $dataSet[0][2],
		];
		$questionGroupModel = new QuestionGroupModel();
		$questionGroupID = $questionGroupModel->insert($data, true);

		$questionAudioModel  = new QuestionAudioModel();
		$questionModel 	 	 = new QuestionModel();
		$questionImageModel  = new QuestionImageModel();
		$questionAnswerModel = new QuestionAnswerModel();

		foreach ($dataSet as $item) {
			$audioID = $questionAudioModel->insert(['audio_name' => $item[1]], true);
            if (!in_array($item[8], QUESTION))
            {
                $item[8] = 'A';
            }
			$data = [
				'exam_part_id'      => 1,
				'type'		        => 1,
				'question_group_id' => $questionGroupID,
				'audio_id'          => $audioID != 0 ? $audioID : null,
				'right_option'      => QUESTION[$item[8]],
				'question'          => $item[3],
				'explain'           => 'No explain',
			];

			$questionID = $questionModel->insert($data, true);

			$data = [
				'question_id' => $questionID,
				'image_name' => $item[0]
			];
			$questionImageModel->insert($data);
			unset($data);

			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[4]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[5]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[6]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[7]
			];

			$questionAnswerModel->insertBatch($data);
		}
	}

	private function saveQuestionPart2($dataSet)
	{
		$data = [
			'exam_part_id' =>  2,
			'title'        =>  'Question Part 2',
			'paragraph'    =>  $dataSet[0][2],
		];
		$questionGroupModel = new QuestionGroupModel();
		$questionGroupID = $questionGroupModel->insert($data, true);

		$questionAudioModel  = new QuestionAudioModel();
		$questionModel 	 	 = new QuestionModel();
		$questionAnswerModel = new QuestionAnswerModel();

		foreach ($dataSet as $item) {
			$audioID = $questionAudioModel->insert(['audio_name' => $item[1]], true);
            if (!in_array($item[8], QUESTION))
            {
                $item[8] = 'A';
            }
			$data = [
				'exam_part_id'      => 2,
				'type'				=> 1,
				'question_group_id' => $questionGroupID,
				'audio_id'          => $audioID != 0 ? $audioID : null,
				'right_option'      => QUESTION[$item[8]],
				'question'          => $item[3],
				'explain'           => 'No explain',
			];

			$questionID = $questionModel->insert($data, true);
			unset($data);

			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[4]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[5]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[6]
			];

			$questionAnswerModel->insertBatch($data);
		}
	}

	private function saveQuestionPart5($dataSet)
	{
		$questionModel 	 	 = new QuestionModel();
		$questionAnswerModel = new QuestionAnswerModel();
		foreach ($dataSet as $item) {
            if (!in_array($item[8], QUESTION))
            {
                $item[8] = 'A';
            }
			$data = [
				'exam_part_id'      => 5,
				'type'				=> 2,
				'right_option'      => QUESTION[$item[8]],
				'question'          => $item[3],
				'explain'           => 'No explain',
			];

			$questionID = $questionModel->insert($data, true);
			unset($data);

			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[4]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[5]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[6]
			];
			$data[] = [
				'question_id' => $questionID,
				'type' 		  => 1,
				'text' 		  => $item[7]
			];

			$questionAnswerModel->insertBatch($data);
		}
	}

	private function saveQuestionPartN($dataSet, $part, $type = 1, $question_per_paragraph = 3)
	{
		$questionAudioModel  = new QuestionAudioModel();
		$questionModel 	 	 = new QuestionModel();
		$questionAnswerModel = new QuestionAnswerModel();
		$questionGroupModel  = new QuestionGroupModel();
		$i = 0;
		foreach ($dataSet as $key => $item) {
			$data = [
				'exam_part_id' =>  $part,
				'title'        =>  'Question Part ' . $part . ' - Num ' . $key,
				'paragraph'    =>  $item[$i][2] ?? '',
			];
			$questionGroupID = $questionGroupModel->insert($data, true);
			$audioID = 0;
			if (isset($item[$i][1]) AND $item[$i][0] != null  )
				$audioID = $questionAudioModel->insert(['audio_name' => $item[$i][1]], true);

			foreach ($item as $subItem) {
                if (!in_array($subItem[8], QUESTION))
                {
                    $item[8] = 'A';
                }
				$data = [
					'exam_part_id'      => $part,
					'type'				=> $type,
					'question_group_id' => $questionGroupID,
					'audio_id'          => $audioID != 0 ? $audioID : null,
					'right_option'      => QUESTION[$subItem[8] ?? 'A'],
					'question'          => $subItem[3],
					'explain'           => 'No explain',
				];

				$questionID = $questionModel->insert($data, true);
				unset($data);

				$data[] = [
					'question_id' => $questionID,
					'type' 		  => 1,
					'text' 		  => $subItem[4]
				];
				$data[] = [
					'question_id' => $questionID,
					'type' 		  => 1,
					'text' 		  => $subItem[5]
				];
				$data[] = [
					'question_id' => $questionID,
					'type' 		  => 1,
					'text' 		  => $subItem[6]
				];
				$data[] = [
					'question_id' => $questionID,
					'type' 		  => 1,
					'text' 		  => $subItem[7]
				];

				$questionAnswerModel->insertBatch($data);
			}
			$i += 1;
			if ($question_per_paragraph == $i) {
				$i = 0;
			}
		}
	}

}
