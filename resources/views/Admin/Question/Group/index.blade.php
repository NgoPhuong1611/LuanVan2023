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
                                                <th>Tiêu đề</th>
                                                <th style="width: 10%;">Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($questionGroups) || !empty($questionGroups)) : ?>
                                                <?php foreach ($questionGroups as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['title'] ?></td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="<?= base_url('dashboard/question-group/detail') . '/' . $item['id'] ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                </a>
                                                                <a onclick="delete_question_group(<?= $item['id'] ?>)" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
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

        fetch('<?= base_url('dashboard/question-group/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                msgbox_success(result.message)
                location.reload()
            })
            .catch(error => msgbox_error(error));
    }
</script>

<?= $this->endSection() ?>