@extends('User.Teacher.layout')

@section('content')
<style>
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

    .imageGrammar {
        float: left;
        height: 150px;
        width: 250px;
        margin-bottom: 25px;
    }

    .card a {
        color: black;
    }

    .card a:active {
        background-color: blue;
        color: white;
    }

    .article-content {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

<script>
  
</script>
<input type="hidden" id="baseUrl" value="{{ url('/') }}" />
<div class="container">
    <!--PAGE TITLE-->
    <div class="row">
        <div class="span9" style="text-align: center">
            <div class="page-header">
                <h4 style="font-weight: bold;">LỊCH SỬ GIAO DỊCH</h4>
            </div>
        </div>

    </div>
    <!-- /. PAGE TITLE-->
    <div id="resultsearchGrammar">
        <div class="row">
            <div class="span9">
                <div class="row">
                <div class="card">
                                <div class="card-block">
                                <table id="simpletable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Loại Giao Dịch</th>
                                            <th>Số Xu Giao Dịch</th>
                                            <th>Thời gian Giao Dịch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{$transaction->title}}</td>
                                                    <td>{{$transaction->quantity_coin}}</td>
                                                    <td>{{$transaction->time_date}}</td>                                 
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection
