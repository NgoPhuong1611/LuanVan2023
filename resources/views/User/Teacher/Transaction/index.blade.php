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
                            <li><form action="{{url("Teacher/showTran/{$redirect}/{$so_tien}")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="so_tien" value=10000>
                                <input type="hidden" name="redirect" value=100>
                                <button type="submit" class="btn btn-default check_out"> 150 xu = 10.000vnd</button>
                            </form></li>
                            <li><form action="{{url("Teacher/showTran")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="so_tien" value=50000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="500"> 550 xu= 50.000vnd</button>
                            </form></li>
                            <li><form action="{{url("Teacher/showTran")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="so_tien" value=100000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="1100">1100 xu = 100.000vnd</button>
                            </form></li>
                            <li><form action="{{url("Teacher/showTran")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="so_tien" value=200000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="2300">2200 xu = 200.000vnd</button>
                            </form></li>
                            <li><form action="{{url("Teacher/showTran")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="so_tien" value=500000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="6000">5300 xu = 500.000vnd</button>
                            </form></li>
                            <li><form action="{{url("Teacher/showTran")}}"method="POST" >
                                @csrf
                                <input type="hidden" name="so_tien" value=1000000>
                                <button type="submit" class="btn btn-default check_out" name="redirect" value="13000">10600 xu = 1.000.000vnd</button>
                            </form></li>
                        </ul>

                    </div>
                </div>
            </div>
            {{-- <script>
    //              <script>
    //             function redirectToTransactionForm() {
    //                 var exchangeRate = document.getElementById("redirect").value;
    //                 window.location.href = '/showTran' + exchangeRate;
    //             }
    // </script>
            </script> --}}
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="{{ asset('resources/js/client/baiDoc/danhSachBaiDoc.js') }}"></script></body>

</html>
@endsection
