@extends('User.layout')

@section('content')
<input style="display:none;" id="baseUrl" value="" />
</head>

<body>
    <div class="container">
        <h3 class="page-header"></h3>
        <br>
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a>Quên mật khẩu</a></li>
            <li><a href="<?= url('User/Register') ?>">Đăng Ký</a></li>
            <li><a href="<?= url('Teacher/Register') ?>">Đăng Ký (Người dạy)</a></li>
        </ul>
        <div class="tab-content">
        <form class="formDoiMatKhau" action="<?= url('User/confirmToken') ?>" method="post">
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
                
                </div>

                <div class="container">
                    <label for=""><b>Nhập Ma Xac Nhan</b></label>
                    <input name="email" hidden value="{{ $to_email }}">
                    <input name="token_user" hidden value="{{ $token_random }}">
                    <input style="width: 500px;" type="text" placeholder="Enter confirmation code....." name="token" required>
                    <br>
                    <button type="submit">Send</button>
                </div>
        </form>
        </div>
    </div>
</body>

<script src="{{asset('resources/js/client/profileClient.js')}}"></script>
@endsection
