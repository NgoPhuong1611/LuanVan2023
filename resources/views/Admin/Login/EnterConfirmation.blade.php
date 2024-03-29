<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin, Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('templates/libraries/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/libraries/bower_components/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('templates/libraries/assets/pages/notification/notification.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/libraries/bower_components/animate.css/css/animate.css') }}">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/libraries/assets/css/style.css') }}">
</head>

<body class="fix-menu">
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material" method="POST" action="<?= url('confirmTokenAd') ?>">
                       @csrf
                        <div class="text-center">
                            <img src="{{ asset('templates/libraries/assets/images/logo.png') }}" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">XÁC NHẬN</h3>

                                    </div>  
                                  
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
                                </div>  
                                <div class="form-group form-primary">
                                    <input name="email" hidden value="{{ $to_email }}">
                                    <input name="token_admin" hidden value="{{ $token_random }}">
                                    <input type="text" name="token" value="" class="form-control" placeholder="Enter confirmation code....." required>
                                    <span class="form-bar"></span>
                                </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">GỬI</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('templates/libraries/bower_components/jquery/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('templates/libraries/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- notification js -->
    <script type="text/javascript" src="{{ asset('templates/libraries/assets/js/bootstrap-growl.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/js/app.js') }}"></script>
</body>

</html>
