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
                                    <h4>Danh sách câu hỏi</h4>

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
                                            <th style="width: 10%;">Phần</th>
                                            <th style="width: 40%;">Câu hỏi</th>
                                            <th style="width: 25%;">Ngày tạo</th>
                                            <th style="width: 10%;">Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($questions) && !empty($questions)) :  ?>
                                                <?php foreach ($questions as $question) : ?>
                                                    <tr>
                                                    <td style="width: 10%;"><?= $question['exam_part_id'] ?></td>
                                                    <td style="width: 40%;"><?= $question['question'] ?></td>
                                                    <td style="width: 25%;"><?= $question['created_at'] ?></td>
                                                    <td style="width: 10%;">
                                                            <div class="btn-group btn-group-sm">
                                                                <a style="margin: 4px;" href="<?= url('dashboard/question/detail') . '/' . $question['id'] ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                </a>
                                                                <a style="margin: 4px;" onclick="delete_question(<?= $question['id'] ?>)" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-delete"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3">Không có câu hỏi nào</td>
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


@endsection

@yield('js')
<script>
    function delete_account(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa tài khoản "${name}" ?`);
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

        fetch('<?= url('dashboard/admin/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`menu-${id}`).remove()
                    return
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>


