@extends('User.layout')

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
        <!--PAGE TITLE-->
        <div class="span9" style="text-align: center">
            <div class="page-header">
                <h4 style="font-weight: bold;">BẢNG GIÁ CHUYỂN ĐỔI XU</h4>
            </div>  
        </div>

        <!-- /. PAGE TITLE-->
                <div class="span3">
                    <div class="side-bar">
                        <h3>DANH MỤC</h3>
                        <ul class="nav nav-list">
                            <li><form action="{{url("/momo_payment")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="total_momo" value=10000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="100">10.000vnd = 100 xu</button>
                            </form></li>
                            <li><form action="{{url("/momo_payment")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="total_momo" value=50000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="500">50.000vnd = 500 xu</button>
                            </form></li>
                            <li><form action="{{url("/momo_payment")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="total_momo" value=100000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="1100">100.000vnd = 1100 xu</button>
                            </form></li>
                            <li><form action="{{url("/momo_payment")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="total_momo" value=200000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="2300">200.000vnd = 2300 xu</button>
                            </form></li>
                            <li><form action="{{url("/momo_payment")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="total_momo" value=500000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="6000">500.000vnd = 6000 xu</button>
                            </form></li>
                            <li><form action="{{url("/momo_payment")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="total_momo" value=1000000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="13000">1.000.000vnd = 13000 xu</button>
                            </form></li>
                        </ul>

                    </div>
                </div>
            </div>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="{{ asset('resources/js/client/baiDoc/danhSachBaiDoc.js') }}"></script></body>

</html>
@endsection
