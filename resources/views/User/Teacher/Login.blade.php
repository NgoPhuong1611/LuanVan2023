@extends('User.layout')

@section('content')
<input style="display:none;" id="baseUrl" value="" />
</head>

<body>
    <div class="container">
        <h3 class="page-header"></h3>
        <br>
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a>Đăng Nhập</a></li>
            <li><a href="<?= url('User/Register') ?>">Đăng Ký</a></li>
        </ul>
        <div class="tab-content">
        <form class="form-login" action="<?= url('User/userlogin') ?>" method="post">
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
                    <label for="username"><b>Username</b></label>
                    <input style="width: 500px;" type="text" placeholder="Enter Username" name="username" required>
                    <label for="passsword"><b>Password</b></label>
                    <input style="width: 500px;" type="password" placeholder="Enter Password" name="password" required>
                    <br>
                    <button type="submit">Login</button>
                </div>
        </form>
        </div>
    </div>
</body>

<script src="{{asset('resources/js/client/profileClient.js')}}"></script>
@endsection
