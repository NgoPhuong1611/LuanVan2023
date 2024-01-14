@extends('User/layout')
@section('content')
<input style="display:none;" id="baseUrl" value="" />

<script>
    function validatePassword() {
        var newPassword = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
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
        <form method="POST" action="<?= url('User/resetPassword') ?>">
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
            <input name="email" hidden value="{{ $email }}">
            <div>
                <label for="password">Mật khẩu mới:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu mới</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="required" />
            </div>
            <div>
                <button type="submit">Cập nhật mật khẩu</button>
            </div>
        </form>
    </div>
	<script src="<?= url("resources/js/client/profileClient.js") ?>"></script>
</body>

@endsection