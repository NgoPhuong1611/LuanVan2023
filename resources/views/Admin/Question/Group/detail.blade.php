<?= $this->section('css') ?>

<link rel="stylesheet" href="<?= base_url() ?>\templates\libraries\bower_components\select2\css\select2.min.css">

<script>
	var index = 0
</script>

<?= $this->endSection() ?>
<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<!-- Main-body start -->
		<div class="main-body">
			<div class="page-wrapper">
				<!-- Page-header start -->
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-12">
							<div class="page-header-title">
								<div class="d-inline">
									<h4>Thêm nhóm câu hỏi</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Page-header end -->

				<!-- Page-body start -->
				<div class="page-body">

					<!--profile cover end-->
					<div class="row">
						<div class="col-lg-12">
							<!-- tab content start -->
							<div class="tab-content">
								<!-- tab panel personal start -->
								<div class="tab-pane active" id="personal" role="tabpanel">
									<!-- personal card start -->
									<div class="card">
										<div class="card-header">

											<?php if (session()->getFlashdata('error')) : ?>
												<div class="alert alert-danger">
													<div class="row">
														<div class="col-10">
															<p><?= session()->getFlashdata('error') ?></p>
														</div>
														<div class="col-1">
															<span aria-hidden="true" id="remove-alert">&times;</span>
														</div>
													</div>
												</div>
											<?php endif ?>

											<!-- <div class="alert alert-danger mb-1">
												<div class="row">
													<div class="col-11">
														Error
													</div>
													<div class="col-1 text-right">
														<span aria-hidden="true" id="remove-alert">&times;</span>
													</div>
												</div>
											</div> -->
										</div>
										<div class="card-block">
											<div class="edit-info">
												<div class="row">
													<div class="col-lg-12">
														<form action="<?= base_url('dashboard/question-group/save') ?>" method="post">
															<input type="hidden" name="question_group_id" value="<?= isset($questionGroup) && !empty($questionGroup) ? $questionGroup['id'] : '' ?>">
															<div class="general-info">
																<div class="row">
																	<div class="col-md-12">
																		<label for="title">Tiêu đề</label>
																		<div class="input-group">
																			<input type="text" class="form-control field" value="<?= isset($questionGroup) && !empty($questionGroup) ? $questionGroup['title'] : set_value('title') ?>" name="title" placeholder="Tiêu đề ..." required autofocus>
																		</div>
																	</div>
																	<div class="col-md-12 mb-4">
																		<label for="partnumber">Part</label>
																		<div style="height: 1px;" class="input-group">
																			<select name="part_id" class="form-control js-example-basic-single">
																				<?php if (isset($examPart) || !empty($examPart)) : ?>
																					<?php foreach ($examPart as $item) : ?>
																						<option value="<?= $item['id'] ?>" <?= isset($questionGroup) && !empty($questionGroup) && $questionGroup['exam_part_id'] == $item['id'] ? 'selected' : '' ?>>Part <?= $item['part_number'] ?></option>
																					<?php endforeach ?>
																				<?php endif ?>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<label for="type">Loại câu hỏi</label>
																		<div class="input-group">
																			<select name="type" class="form-control" required>
																				<option value="" disabled selected>
																					--Chọn loại câu hỏi--
																				</option>
																				<option value="1" <?= isset($question) && !empty($question) && $question['type'] == 1 ? 'selected' : '' ?>>Câu hỏi nghe</option>
																				<option value="2" <?= isset($question) && !empty($question) && $question['type'] == 2 ? 'selected' : '' ?>>Câu hỏi đọc</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12 mb-3">
																		<label for="paragraph">Đoạn văn</label>
																		<textarea class="form-control field" id="editor1" name="paragraph" required><?= isset($questionGroup) && !empty($questionGroup) ? $questionGroup['paragraph'] : set_value('paragraph') ?></textarea>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-12 mb-3" id="question1">
																	<label for="upload_audio">Upload tệp âm thanh cho nhóm câu hỏi</label>
																	<input type="file" name="question_group_audio" id="filer_input_audio" onchange="return fileValidation()" accept=".mp3, .aac, .wav, .flac, .wma, .ogg, .aiff ,.alac" multiple="multiple">
																	<?php if (isset($audio)) : ?>
																		<ul id="product-image" class="jFiler-items-list jFiler-items-default">
																			<li class="jFiler-item" data-jfiler-index="0" id="img-<?= $audio['id'] ?>">
																				<div class="jFiler-item-container">
																					<div class="jFiler-item-inner">
																						<div class="jFiler-item-icon pull-left"><i class="icon-jfi-file-o jfi-file-type-image jfi-file-ext-png"></i></div>
																						<div class="jFiler-item-info pull-left">
																							<div class="jFiler-item-title" title="<?= $audio['audio_name'] ?>"><a href="<?= base_url('uploads/audios/' . $audio['audio_name']) ?>" target="_blank" rel="noopener noreferrer"><?= $audio['audio_name'] ?></a></div>
																							<div class="jFiler-item-others"><span><?= @get_file_size(AUDIO_PATH . '/' . $audio['audio_name'], 2) ?? 0 ?> MB</span><span class="jFiler-item-status"></span></div>
																							<div class="jFiler-item-assets">
																								<ul class="list-inline">
																									<li><a onclick="delete_audio(<?= $audio['id'] ?>)" class="icon-jfi-trash jFiler-item-trash-action"></a></li>
																								</ul>
																							</div>
																						</div>
																					</div>
																				</div>
																			</li>
																		</ul>
																	<?php endif ?>
																</div>
															</div>
															<?php if (!isset($questions) && empty($questions)) : ?>
																<div class="border border-secondary rounded mb-3 repeater">
																	<div class="m-3">
																		<div class="row" style="padding-top: 5px;">
																			<div class="col-md-12">
																				<label for="question">Câu hỏi</label>
																				<div class="input-group">
																					<textarea type="text" class="form-control field" value="" name="questions[]" placeholder="Câu hỏi ..." rows="3" autofocus><?= set_value('questions')[0] ?></textarea>
																				</div>
																			</div>
																			<div class="col-md-12">
																				<label for="username">Đáp án đúng</label>
																				<div class="input-group">
																					<select name="right_option[]" class="form-control" id="validationCustom04" required>
																						<option selected disabled value="">
																							--Chọn đáp án đúng--
																						</option>
																						<option value="1">A</option>
																						<option value="2">B</option>
																						<option value="3">C</option>
																						<option value="4">D</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="form-list">
																			<label for="questions">Câu trả lời</label>
																			<div class="form-row" style="padding-top: 5px;" id="someId1">
																				<div class="input-group">
																					<input style="height: 41px;" type="text" name="options[0][]" value="<?= set_value('options')[0][0] ?>" class="form-control field" placeholder="Answer..." required>
																					<button type="button" class="btn btn-success" onclick="addFormElements(this)">Thêm</button>
																					<button type="button" class="btn btn-danger" onclick="removeFormElements(this)">Xóa</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div id="newque"></div>
																<div class="row">
																	<div class="mb-3">
																		<button id="QueAdder" type="button" class="btn btn-primary waves-effect waves-light m-r-20">Thêm câu hỏi</button>
																	</div>
																</div>
															<?php else : ?>
																<div class="border border-secondary rounded mb-3 repeater">
																	<div class="m-3">
																		<div class="row" style="padding-top: 5px;">
																			<div class="col-md-12">
																				<label for="question">Câu hỏi</label>
																				<div class="input-group">
																					<input type="hidden" name="old_questions[]" value="<?= $questions[0]['id'] ?>">
																					<textarea type="text" class="form-control" name="questions[]" placeholder="Câu hỏi ..." rows="3" autofocus><?= $questions[0]['question'] ?></textarea>
																				</div>
																			</div>
																			<div class="col-md-12">
																				<label for="username">Đáp án đúng</label>
																				<div class="input-group">
																					<select name="right_option[]" class="form-control" id="validationCustom04" required>
																						<option selected disabled value="">
																							--Chọn đáp án đúng--
																						</option>
																						<option value="1" <?= $questions[0]['right_option'] == 1 ? 'selected' : '' ?>>A</option>
																						<option value="2" <?= $questions[0]['right_option'] == 2 ? 'selected' : '' ?>>B</option>
																						<option value="3" <?= $questions[0]['right_option'] == 3 ? 'selected' : '' ?>>C</option>
																						<option value="4" <?= $questions[0]['right_option'] == 4 ? 'selected' : '' ?>>D</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="form-list">
																			<label for="questions">Câu trả lời</label>
																			<div class="form-row" style="padding-top: 5px;" id="someId1">
																				<?php foreach ($questions[0]['options'] as $option) : ?>
																					<div class="input-group">
																						<input type="hidden" name="old_options[0][]" value="<?= $option['id'] ?>">
																						<input style="height: 41px;" type="text" name="options[0][]" value="<?= $option['text'] ?>" class="form-control" placeholder="Answer..." required>
																						<button type="button" class="btn btn-success" onclick="addFormElements(this)">Thêm</button>
																						<button type="button" class="btn btn-danger" onclick="removeFormElements(this)">Xóa</button>
																					</div>
																				<?php endforeach ?>
																			</div>
																		</div>
																	</div>
																</div>
																<div id="newque">
																	<?php $i = 1 ?>
																	<?php foreach (array_slice($questions, 1) as $question) : ?>
																		<div id="row">
																			<div class="border border-secondary rounded mb-3 repeater">
																				<div class="m-3">
																					<div class="row" style="padding-top: 5px;">
																						<div class="col-md-12">
																							<label for="question">Câu hỏi</label>
																							<input type="hidden" name="old_questions[]" value="<?= $question['id'] ?>">
																							<div class="row">
																								<div class="form-group col-md-11">
																									<textarea style="height: 40px;" type="text" class="form-control" value="" name="questions[]" placeholder="Câu hỏi ..." rows="1" autofocus><?= $question['question'] ?></textarea>
																								</div>
																								<div class="col-md-1 form-group">
																									<button class="btn btn-danger" id="DeleteRow" type="button">
																										<i class="bi bi-trash"></i> Xóa</button>
																								</div>
																							</div>
																						</div>

																						<div class="col-md-12">
																							<label for="username">Đáp án đúng</label>
																							<div class="input-group">
																								<select name="right_option[]" class="form-control" id="validationCustom04" required>
																									<option selected disabled value="">
																										--Chọn đáp án đúng--
																									</option>
																									<option value="1" <?= $question['right_option'] == 1 ? 'selected' : '' ?>>A</option>
																									<option value="2" <?= $question['right_option'] == 2 ? 'selected' : '' ?>>B</option>
																									<option value="3" <?= $question['right_option'] == 3 ? 'selected' : '' ?>>C</option>
																									<option value="4" <?= $question['right_option'] == 4 ? 'selected' : '' ?>>D</option>
																								</select>
																							</div>
																						</div>
																					</div>
																					<div class="form-list">
																						<label for="questions">Câu trả lời</label>
																						<div class="form-row" style="padding-top: 5px;" id="someId1">
																							<?php foreach ($question['options'] as $option) : ?>
																								<input type="hidden" name="old_options[<?= $i ?>][]" value="<?= $option['id'] ?>">
																								<div class="input-group">
																									<input style="height: 41px;" type="text" name="options[<?= $i ?>][]" value="<?= $option['text'] ?>" class="form-control" placeholder="Answer..." required>
																									<button type="button" class="btn btn-success" onclick="addFormElements(this)">Thêm</button>
																									<button type="button" class="btn btn-danger" onclick="removeFormElements(this)">Xóa</button>
																								</div>
																							<?php endforeach ?>
																							<?php $i += 1 ?>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	<?php endforeach ?>
																</div>
																<div class="row">
																	<div class="mb-3">
																		<button id="QueAdder" type="button" class="btn btn-primary waves-effect waves-light m-r-20">Thêm câu hỏi</button>
																	</div>
																</div>
															<?php endif ?>
													</div>
													<!-- end of row -->
													<div class="row">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
															<a href="<?= base_url('dashboard/question-group') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
														</div>
													</div>
												</div>
												<!-- end of edit info -->
												</form>
											</div>
											<!-- end of col-lg-12 -->
										</div>
										<!-- end of row -->
									</div>
								</div>
								<!-- end of card-block -->
							</div>
							<!-- personal card end-->
						</div>
					</div>
					<!-- tab content end -->
				</div>
			</div>
		</div>
		<!-- Page-body end -->
	</div>
</div>
<!-- Main body end -->
</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\select2\js\select2.full.min.js"></script>

<script>
	CKEDITOR.replace('editor1');
</script>

<script>
	function matchStart(params, data) {
		// If there are no search terms, return all of the data

		// if ($.trim(params.term) === '') {
		//     return data;
		// }
		// // Skip if there is no 'children' property
		// if (typeof data.children === '') {
		//     return null;
		// }
		// // `data.children` contains the actual options that we are matching against
		// var filteredChildren = [];
		// $.each(data.children, function(idx, child) {
		//     if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
		//         filteredChildren.push(child);
		//     }
		// });
		// // If we matched any of the timezone group's children, then set the matched children on the group
		// // and return the group object
		// if (filteredChildren.length) {
		//     var modifiedData = $.extend({}, data, true);
		//     modifiedData.children = filteredChildren;
		//     // You can return modified objects from here
		//     // This includes matching the `children` how you want in nested data sets
		//     return modifiedData;
		// }
		// // Return `null` if the term should not be displayed
		// return null;
	}
	$(".js-example-basic-single").select2({
		// matcher: matchStart

	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#QueAdder").click(function() {
			index = index + 1
			newQueAdd =
				$('#newque').
			append(`<div id="row">
						<div class="border border-secondary rounded mb-3 repeater">
							<div class="m-3">
								<div class="row" style="padding-top: 5px;">
									<div class="col-md-12">
										<label for="question">Câu hỏi</label>
										<div class="row">
											<div class="form-group col-md-11">
												<textarea style="height: 40px;" type="text" class="form-control field" value="" name="questions[]" placeholder="Câu hỏi ..." rows="1" autofocus></textarea>
											</div>
											<div class="col-md-1 form-group">
												<button class="btn btn-danger " id="DeleteRow" type="button">
												<i class="bi bi-trash"></i> Xóa</button>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<label for="username">Đáp án đúng</label>
										<div class="input-group">
											<select name="right_option[]" class="form-control" id="validationCustom04" required>
												<option selected disabled value="">
													--Chọn đáp án đúng--
												</option>
												<option value="1">A</option>
												<option value="2">B</option>
												<option value="3">C</option>
												<option value="4">D</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-list">
									<label for="questions">Câu trả lời</label>
									<div class="form-row" style="padding-top: 5px;" id="someId1">
										<div class="input-group">
											<input style="height: 41px;" type="text" name="options[${index}][]" class="form-control field" placeholder="Answer..." required>
											<button type="button" class="btn btn-success" onclick="addFormElements(this)">Thêm</button>
											<button type="button" class="btn btn-danger" onclick="removeFormElements(this)">Xóa</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>`);
		});

		$("body").on("click", "#DeleteRow", function() {
			const is_confirm = confirm(`Bạn muốn xóa câu hỏi ?`);
			if (!is_confirm) {
				return
			}
			$(this).parents("#row").remove();
		});
	});
</script>

<!-- js add answers -->
<script>
	function addFormElements(current) {
		$(current).parents('.form-list').append($(current).parents('.form-row').clone())
	}

	function removeFormElements(current) {
		const is_confirm = confirm(`Bạn muốn xóa câu trả lời ?`);
		if (!is_confirm) {
			return
		}

		if ($('.form-row').length === 1) {
			alert('Không thể xóa câu trả lời cuối cùng');
			return;
		}
		$(current).parents('.form-row').remove();
	}

	function testInput(event) {
		var value = String.fromCharCode(event.which);
		var pattern = new RegExp(/[a-zåäö ]/i);
		return pattern.test(value);
	}

	$('.field').bind('keypress', testInput);
</script>

<?= $this->endSection() ?>