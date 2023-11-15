
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
                                    <h4>Cập nhật bài viết</h4>
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

                                            <!-- <div class="alert alert-danger">
                                                <div class="col-10">
                                                    Error
                                                </div>
                                                <div class="col-1 text-right">
                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                </div>
                                            </div> -->

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
                                                        <form action="<?= base_url('dashboard/posts/update/'.$posts['id']) ?>" method="post">
                                                            <input type="hidden" name="id" value="">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">
                                                                            <select name="status" class="form-control" required>

                                                                                <option value="" disabled selected>
                                                                                    --Chọn trạng thái--
                                                                                </option>
                                                                                <?php  if($posts['status'] == 1): ?>
                                                                                    <option value="1" checked selected >Hiển thị</option>
                                                                                    <option value="0">Ẩn</option>
                                                                                <?php endif ?>
                                                                                <?php  if($posts['status'] == 0): ?>
                                                                                    <option value="1"  >Hiển thị</option>
                                                                                    <option value="0" checked selected>Ẩn</option>
                                                                                <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="partnumber">Danh mục bài viết</label>
                                                                        <div style="height: 1px;" class="input-group">
                                                                            <select name="category" class="form-control js-example-basic-single">
                                                                                <option value="" disabled selected>
                                                                                    --Chọn danh mục--
                                                                                </option>
                                                                                <?php if (isset($category) || !empty($category)) : ?>
                                                                                        <?php foreach ($category as $item) : ?>
                                                                                            <?php  if($posts['category_id'] == $item['id']): ?>
                                                                                                <option value="<?= $item['id'] ?>" checked selected > <?= $item['name'] ?> </option>
                                                                                            <?php else: ?>
                                                                                                <option value="<?= $item['id'] ?>"> <?= $item['name'] ?></option>
                                                                                             <?php endif ?>
                                                                                        <?php endforeach ?>
                                                                                <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="title">Tiêu đề</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="<?= $posts['title'] ?>" name="title" placeholder="Tiêu đề ..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="username">Slug</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="inputWarning1" value="<?= $posts['slug'] ?>" name="slug" placeholder="Slug ..." required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <label for="description">Mô tả</label>

                                                                        <textarea class="form-control" id="editor"   name="description" required><?= $posts['description'] ?></textarea>
                                                                    </div>
                                                                    <div class="col-md-12 mb-3">
                                                                        <label for="content">Nội dung bài viêt</label>
                                                                        <textarea class="form-control"   id="editor3" name="content" required><?= $posts['content'] ?></textarea>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- end of row -->
                                                            <div class="row">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                    <a href="<?= base_url('dashboard/posts') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
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

<script>

    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor3');



    var cleave = new Cleave('.cleave1', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    var cleave2 = new Cleave('.cleave2', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>

<?= $this->endSection() ?>
