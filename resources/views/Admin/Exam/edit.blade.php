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
                                    <h4>Danh sách đề thi</h4>
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
                                                <th >Tiêu đề thi</th>
                                                <th style="width: 30px;">Ngày Cập nhật</th>
                                                <th style="width: 30px;">Trạng Thái</th>
                                                <th style="width: 70px;">Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($exam) || !empty($exam)) : ?>
                                                <?php foreach ($exam as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['title'] ?> </td>
                                                        <td>
                                                            <?= $item['updated_at'] ?>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox-fade fade-in-primary d-flex justify-content-center">
                                                                <label>
                                                                    <input type="checkbox" id="checkbox2" name="status" value=""<?= $item['status'] == 1 ? 'checked' : '' ?>>
                                                                    <span class="cr">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>

                                                            <div style="width: 90px;" class="btn-group btn-group-sm">
                                                                <a  href ="<?= url('dashboard/exam/edit/'.$item['id']) ?>"  style="margin: 4px;" class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                </a>
                                                                <a href ="<?= url('dashboard/exam/delete/'.$item['id']) ?>"   style="margin: 4px;" onclick="if(confirm('Bạn có chắc chắn xóa chi tiết liên hệ này không?') === false) event.preventDefault()" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-delete"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
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
@section('js')
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

        fetch('<?= base_url('dashboard/category/delete') ?>', requestOptions)
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

