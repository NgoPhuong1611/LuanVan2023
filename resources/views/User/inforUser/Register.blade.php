@extends('User.layout')

@section('content')
<input type="hidden" id="baseUrl" value="">

<div class="container">
    <h3 class="page-header">Đăng ký</h3>

    <ul class="nav nav-tabs" id="tabs">
        <li><a href="<?= url('User/Login') ?>">Đăng Nhập</a></li>
        <li class="active"><a>Đăng Ký</a></li>
        <li><a href="<?= url('Teacher/Register') ?>">Đăng Ký (Người dạy)</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="information">
            <i style="color: red">{{ session()->get('error') }}</i>

            <form class="form-profile" action="{{ url('User/save') }}" method="POST">
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
                <input type="hidden" name="id" value="">
                <div>
                    <label for="first_name"><b>FirstName:</b></label>
                    <input type="text" style="width: 500px;" name="first_name" pattern="[a-zA-ZÀ-ỹ\s]+" placeholder="FirstName...." required />
                </div>

                <div>
                    <label for="last_name"><b>Lastname:</b></label>
                    <input type="text" style="width: 500px;" name="last_name" pattern="[a-zA-ZÀ-ỹ\s]+" placeholder="LastName...." required />
                </div>
                <div>
                    <label for="username"><b>UserName:</b></label>
                    <input type="text" style="width: 500px;" name="username" placeholder="UserName...." required />
                </div>
                <div>
                    <label for="password"><b>Password:</b></label>
                    <input type="password" style="width: 500px;" name="password" placeholder="Password...." required />
                </div>
                <div>
                    <label for="email"><b>Email:</b></label>
                    <input type="email" style="width: 500px;" name="email" placeholder="Email...." required />
                </div>

                <button type="submit" class="registerbtn">Register</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('resources/js/client/profileClient.js') }}"></script>
@endsection
