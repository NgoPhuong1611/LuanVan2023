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
                        <div class="col-lg-12">
                            <div class="page-header-title">
                                <div class="d-inline">

                                    <h4>Thêm tài khoản</h4>

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
                                                    <form action="<?= url('dashboard/user/updateteacher/'.$user['id']) ?>" method="post">
                                                        @csrf
                                                            <input type="hidden" name="id" value="">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="username">Tên tài khoản</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="<?= $user['username'] ?>" name="username" placeholder="Tên ..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="password">Password</label>
                                                                        <div class="input-group">
                                                                            <input type="password" value="<?= $user['password'] ?>"  name="password" class="form-control" placeholder="" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="email">Email</label>
                                                                            <div class="input-group">
                                                                                <input type="email" name="email"  value="<?= $user['email'] ?>"class="form-control" placeholder="" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="first_name">First_name</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="<?= $user['first_name'] ?>" name="first_name" placeholder="Tên ..." required >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="last_name">Last_name</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="last_name" value="<?= $user['last_name'] ?>" class="form-control" placeholder="" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">
                                                                            <select name="status" class="form-control" required>

                                                                                <option value="" disabled selected>
                                                                                    --Chọn trạng thái--
                                                                                </option>
                                                                                <?php  if($user['status'] == 1): ?>
                                                                                    <option value="1" checked selected >Hiển thị</option>
                                                                                    <option value="0">Ẩn</option>
                                                                                <?php endif ?>
                                                                                <?php  if($user['status'] == 0): ?>
                                                                                    <option value="1"  >Hiển thị</option>
                                                                                    <option value="0" checked selected>Ẩn</option>
                                                                                <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">

                                                                        <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                        <a href="<?= url('dashboard/user/detailteacher') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>

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
@endsection()
