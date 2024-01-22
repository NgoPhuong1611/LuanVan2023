@extends('User.Teacher.layout')

@section('content')
    <!-- Your content here -->

<input id="baseUrl" value="${pageContext.request.contextPath}" style="display: none;" />
<style type="text/css">
    .hidden {
        display: none;
    }

    .error-message {
        color: red;
    }

    .anchor {
        display: block;
        height: 115px;
        /*same height as header*/
        margin-top: -115px;
        /*same height as header*/
        visibility: hidden;
    }
</style>
</head>
        <body>
            <div class="container">
                <h3 class="page-header"></h3>
                <br>
                <ul class="nav nav-tabs" id="tabs">
                    <li class="active"><a>Nhập thông tin của bạn</a></li>
                </ul>
                <div class="tab-content">
            <form action="{{ url("Teacher/createRequest") }}" method="POST">
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
                    {{-- <label hidden for="amount">Số tiền giao dịch (VND): </label> --}}
                    <input name="redirect" hidden value="{{ $redirect }}">
                    <input name="so_tien" hidden value="{{ $so_tien }}" >
            
                    <label for="account_number">Số tài khoản ngân hàng: </label>
                    <input type="text" name="account_number" value="{{ old('account_number') }}" required>
            
                    <label for="account_name">Tên chủ tài khoản: </label>
                    <input type="text" name="account_name" value="{{ old('account_name') }}" required>
            
                    <label for="bank_name">Ngân hàng: </label>
                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                </div>
            </form>
        </body>
            </div>

        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="{{ asset('resources/js/client/baiDoc/danhSachBaiDoc.js') }}"></script></body>
</html>
@endsection
