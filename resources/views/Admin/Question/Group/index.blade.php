@extends('Admin.layout')

@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Danh sách nhóm câu hỏi</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-block">

                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                            <th style="width: 5%;">Id</th>

                                                <th style="width: 10%;">Phần</th>
                                                <th >Tiêu đề</th>
                                                <th style="width: 10%;">Số câu</th>
                                                <th style="width: 10%;">Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($questionGroups) || !empty($questionGroups)) : ?>
                                                <?php foreach ($questionGroups as $item) : ?>
                                                    <tr>
                                                    <td style="width: 5%;"><?= $item['id'] ?></td>

                                                        <td style="width: 10%;"><?= $item['exam_part_id'] ?></td>
                                                        <td><?= $item['title'] ?></td>
                                                        <td><?= tinhSoCauHoi($item['id']) ?> </td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="<?= url('dashboard/question-group/edit' . '/' . $item['id'] )?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                </a>
                                                                <a href="<?= url('dashboard/question-group/delete' . '/' . $item['id'] )?>"  class="tabledit-delete-button btn btn-danger waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-delete"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">Hiện không có nhóm câu hỏi nào. <a href="<?= url('dashboard/question-group/detail') ?>">Bấm vào đây để thêm mới.</a></td>
                                                </tr>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>


<?php
use App\Models\QuestionGroup;
use App\Models\ExamPart;
use App\Models\Question;

function tinhSoCauHoi($id)
{

    $a = 0;

    $Question = Question::where('question_group_id', $id)->get();
    $a = $Question->count();
    return $a ;
}
?>
@endsection

@section('js')
<script>
    function delete_question_group(id) {
        const is_confirm = confirm(`Bạn muốn câu hỏi này?`);
        if (!is_confirm) {
            return
        }

        const data = new FormData();
        data.append('id', id);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?=
            url('dashboard/question-group/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                msgbox_success(result.message)
                location.reload()
            })
            .catch(error => msgbox_error(error));
    }
</script>
@endsection



