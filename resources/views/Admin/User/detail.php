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
                                    <h4>Thêm người dùng</h4>
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
                                                        <form action="<?= base_url('dashboard/admin/save') ?>" method="post">
                                                            <input type="hidden" name="id" value="">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="username">Tên tài khoản</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="" name="username" placeholder="Tên tài khoản ..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="email">Email</label>

                                                                        <div class="input-group">
                                                                            <input type="email" class="form-control" value="" name="email" placeholder="Email ..." required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="username">Họ</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="" name="firstname" placeholder="Họ ..." required >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="password">Mật khẩu</label>
                                                                        <div class="input-group">
                                                                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu ..." required>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="username">Tên</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="" name="lastname" placeholder="Tên ..." required >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">
                                                                            <select name="status" class="form-control" required>
                                                                                <option value="" disabled selected>
                                                                                    --Chọn trạng thái--
                                                                                </option>
                                                                                <option value="1">Bình thường</option>
                                                                                <option value="0">Cấm</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-md-6">
                                                                        <label for="level">Cấp bậc</label>
                                                                        <div class="input-group">
                                                                            <select name="level" class="form-control">
                                                                                <option value="0">
                                                                                    Admin
                                                                                </option>
                                                                                <option value="1">
                                                                                    Moderator
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                                <!-- <div class="row">
                                                                    
                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">

                                                                            <select name="status" class="form-control">
                                                                                <option value="1" selected>Bình thường</option>
                                                                                <option value="0">Bị cấm</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                </div> -->
                                                                <!-- end of row -->
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">
                                                                        <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                        <a href="<?= base_url('dashboard/user/detail') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
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