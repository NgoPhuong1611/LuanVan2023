@extends('User/layout')
@section('content')
<input style="display:none;" id="baseUrl" value="" />

<script>
    function validatePassword() {
        // var oldPassword = document.getElementById("old_password").value;
        var newPassword = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        // if(md5((string) newPassword)==oldPassword){
        //     document.getElementById("password-error").style.display = "block";
        // }else
         if (newPassword != confirmPassword) {
            document.getElementById("password-error").style.display = "block";
            return false;
        } else {
            document.getElementById("password-error").style.display = "none";
            return true;
        }

    }
</script>

<body>
    <div class="container">
        <h3 class="page-header">Thông tin cá nhân</h3>
        <ul class="nav nav-tabs" id="tabs">
            <li><a href="Infor">Cập nhật thông tin</a></li>
            <li class="active"><a href="">Đổi mật khẩu</a></li>
        </ul>
        <div class="tab-pane" id="changePass">

        </div>

        <form class="formDoiMatKhau" action="<?= url('User/changePassword') ?>" method="post" onsubmit="return validatePassword()">
        @csrf
            <div class="col-12">
                @if (!empty($errors))
                @if (is_string($errors))
                    <!-- Nếu $errors là chuỗi, hiển thị thông báo lỗi -->
                    <div class="alert alert-danger mb-1">
                        {{ $errors }}
                    </div>
                @else
                    <!-- Nếu $errors là một đối tượng MessageBag, kiểm tra và hiển thị từng thông báo lỗi -->
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-1">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            @else
                <!-- Nếu không có lỗi, ẩn thông báo -->
                <p></p>
            @endif
            <input type="hidden" id="iduser" name="iduser" value="<?= $user[0]['id'] ?>">
            <input type="hidden" id="name" name="name" value="<?= $user[0]['username'] ?>">

            <div class="form-group alert alert-danger" id="password-error" style="display:none">Mật khẩu mới và nhập mật khẩu mới không khớp
            </div>
            {{-- <div class="form-group">
                <label for="old_password">Mật khẩu cũ</label>
                <input type="password" value="<?= $user[0]['password'] ?>"
                    class="form-control" name="old_password" id="old_password" required="required" />
            </div> --}}
            <div class="form-group">
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" class="form-control" name="new_password" id="new_password" required="required" />
            </div>
            <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu mới</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="required" />
            </div>
            <input class="btn btn-primary" type="submit" value="Xác nhận" />
        </form>
    </div>
	<script src="<?= url("resources/js/client/profileClient.js") ?>"></script>
</body>

@endsection