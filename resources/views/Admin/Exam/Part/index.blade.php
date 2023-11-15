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
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Danh sách phần đề thi</h4>
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
                                                <th>Phần đề thi</th>
                                                <!-- <th style="width: 30px;">Trạng thái</th> -->
                                                <th style="width: 70px;">Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (isset($examParts) || !empty($examParts)) : ?>
                                                <?php foreach ($examParts as $item) : ?>
                                                    <tr>
                                                        <!-- <td><?= $item['part_number'] ?></td> -->
                                                        <td><?= $item['title'] ?></td>
                                                        <!-- <td><?= $item['direction'] ?></td> -->
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="<?= base_url('dashboard/exam-part/edit/'.$item['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                </a>
                                                                <a href ="<?= base_url('dashboard/exam-part/delete/'.$item['id']) ?>" onclick="if(confirm('Bạn có chắc chắn xóa chi tiết liên hệ này không?') === false) event.preventDefault()" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-delete"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">Hiện không có nhóm câu hỏi nào. <a href="<?= base_url('dashboard/question-group/detail') ?>">Bấm vào đây để thêm mới.</a></td>
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


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function delete_account(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa phần đề thi "${name}" ?`);
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

<?= $this->endSection() ?>