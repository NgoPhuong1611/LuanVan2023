
@extends('Admin.layout')
@section('content')
<link rel="stylesheet" href="<?=  asset('templates\libraries\bower_components\select2\css\select2.min.css') ?>">
<script type="text/javascript" src="<?= asset('ckeditor\ckeditor.js')?>"></script>
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
                                    <h4>Thêm câu hỏi </h4>
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
                                                        <form action="<?= url('dashboard/question/save') ?>" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                            <input type="hidden" name="id" value="<?= isset($question) && !empty($question) ? $question['id'] : '' ?>">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <label for="question">Câu hỏi</label>
                                                                            <textarea type="text"  id="editor5"  name="question" placeholder="Câu hỏi ..." > </textarea>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="type">Loại câu hỏi</label>
                                                                        <div class="input-group">
                                                                            <select name="type" class="form-control" required>
                                                                                <option value="" disabled selected>
                                                                                    --Chọn loại câu hỏi--
                                                                                </option>
                                                                                <option value="1" <?= isset($question) && !empty($question) && $question['type'] == 1 ? 'selected' : '' ?>>Câu hỏi nghe</option>
                                                                                <option value="2" <?= isset($question) && !empty($question) && $question['type'] == 2 ? 'selected' : '' ?>>Câu hỏi đọc</option>
                                                                                <option value="3" <?= isset($question) && !empty($question) && $question['type'] == 1 ? 'selected' : '' ?>>Câu hỏi nói</option>
                                                                                <option value="4" <?= isset($question) && !empty($question) && $question['type'] == 2 ? 'selected' : '' ?>>Câu hỏi viết</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="partnumber">Part</label>
                                                                        <div style="height: 1px;" class="input-group">
                                                                            <select name="part_id" class="form-control js-example-basic-single">
                                                                                <?php if (isset($examPart) || !empty($examPart)) : ?>
                                                                                    <?php foreach ($examPart as $item) : ?>
                                                                                        <option value="<?= $item['id'] ?>" <?= isset($question) && !empty($question) && $question['exam_part_id'] == $item['id'] ? 'selected' : '' ?>>Part <?= $item['part_number'] ?>+ <?= $item['title'] ?></option>
                                                                                    <?php endforeach ?>
                                                                                <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" id="aa">
                                                                    <div class="col-md-12" >
                                                                        <label for="username">Đáp án đúng</label>
                                                                        <div class="input-group">
                                                                            <select name="right_option" id="right_option" class="form-control" id="validationCustom04" required>
                                                                                <option selected disabled value="">
                                                                                    --Chọn đáp án đúng--
                                                                                </option>
                                                                                <option value="1" >A</option>
                                                                                <option value="2" >B</option>
                                                                                <option value="3" >C</option>
                                                                                <option value="4" >D</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                        <div class="col-md-12" >
                                                                            <label for="result">Câu trả lời</label>
                                                                            <div class="input-group">
                                                                                <input style="height: 40px;" class="form-control field" name="options[]"  id="options[]" placeholder="Vd: Some thing big..." >
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div id="newinput"></div>
                                                            <div class="row" id="bb">
                                                                <div class="mb-3" id ="cc">
                                                                    <button id="rowAdder" type="button" class="btn btn-primary waves-effect waves-light m-r-20">Thêm câu trả lời</button>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12 mb-3" id="question">
                                                                    <label for="upload_image">Upload tệp hình ảnh</label>
                                                                    <input type="file" name="question_image" id="filer_input_image" onchange="return fileValidation()" accept=".jpg, .png, .jpeg, .gif, .psd" multiple="multiple">

                                                                </div>
                                                                <div class="col-md-12 mb-3" id="question1" >
                                                                    <label for="upload_audio">Upload tệp âm thanh</label>
                                                                    <input type="file" name="question_audio" id="filer_input_audio" onchange="return fileValidation()" accept=".mp3, .aac, .wav, .flac, .wma, .ogg, .aiff ,.alac" multiple="multiple">

                                                                </div>
                                                            </div>
                                                            <!-- end of row -->
                                                            <div class="row">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                    <a href="<?= url('dashboard/question') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- end of edit info -->
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
@endsection
@section('js')
<script>
    CKEDITOR.replace('editor5');

    </script>
<!-- Select 2 js -->
<script type="text/javascript" src="<?= asset('templates\libraries\bower_components\select2\js\select2.full.min.js') ?>"></script>
<!-- ajax hidden upload file -->
<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="type"]').on('change', function() {
            var eins = $(this).val();
            if (eins == "2") {
                $('#filer_input_image').removeAttr('disabled');
                $('#filer_input_audio').removeAttr('disabled');
                $('#question').removeAttr('hidden', '');
                $('#aa').removeAttr('hidden', '');
                $('#question1').removeAttr('hidden', '');
            } else if (eins == "1"){
                $('#filer_input_image').removeAttr('disabled');
                $('#filer_input_audio').removeAttr('disabled');
                $('#question').removeAttr('hidden', '');
                $('#aa').removeAttr('hidden', '');
                $('#question1').removeAttr('hidden', '');
            }
            else {
                $('#right_option').removeAttr('required');

                $('#filer_input_image').removeAttr('disabled');
                $('#filer_input_audio').removeAttr('disabled');
                $('#question').removeAttr('hidden', '');
                $('#aa').attr('hidden', '');
                $('#question1').removeAttr('hidden', '');
            }


        });
    });
</script>

<script>
    function matchStart(params, data) {}
    $(".js-example-basic-single").select2({

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var counter = 3;
        $("#rowAdder").click(function() {

            if (counter > 6) {
                alert("Tối đa 5 câu trả lời được chấp nhận!");
                return false;
            }
            counter++;
            newRowAdd =
                '<div class="row" id="row" >' +
                '<div class="col-md-12">' +
                '<label for="result">Câu trả lời tiếp theo</label>' +
                '<div class="input-group">' +
                '<input class="form-control field" name="options[]" placeholder="Vd: A.Yes..." required>' +
                '<button class="btn btn-danger" id="DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> Xóa</button> </div> </div> ' +
                '</div>';

            $('#newinput').append(newRowAdd);

        });

        $("body").on("click", "#DeleteRow", function() {
            const is_confirm = confirm(`Bạn muốn xóa câu trả lời ?`);
            if (!is_confirm) {
                return
            }
            counter--;
            $(this).parents("#row").remove();
        })
    });

    function testInput(event) {
        var value = String.fromCharCode(event.which);
        var pattern = new RegExp(/[a-zåäö ]/i);
        return pattern.test(value);
    }

    $('.field').bind('keypress', testInput);
</script>
@endsection
