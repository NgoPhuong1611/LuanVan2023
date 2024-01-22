@extends('User.layout')

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
    function Search() {
        var baseUrl = document.getElementById('baseUrl').value;
        var xhttp;
        var search = document.getElementById('searchGrammar').value;

        //remove special letters
        var convertSearch = search.replace(/[^a-zA-Z0-9 ]/g, "");

        var url;
        if (search.trim() !== '') {
            url = baseUrl + "/searchGrammar/" + convertSearch;
        } else {
            url = baseUrl + "/searchGrammar/all";
        }

        if (window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4) {
                var data = xhttp.responseText;
                document.getElementById("resultsearchGrammar").innerHTML = data;
            }
        };

        xhttp.open("POST", url, true);
        xhttp.send();
    }
</script>

<input type="hidden" id="baseUrl" value="{{ url('/') }}" />

<div class="container">
    <!--PAGE TITLE-->
    <div class="row">
        <div class="span9" style="text-align: center">
            <div class="page-header">
                <h4 style="font-weight: bold;">LỊCH SỬ BÀI THI</h4>
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

                                            <th>Id</th>
                                            <th>Tên bài thi</th>
                                            <th>Thời gian làm bài</th>
                                            <th>Điểm</th>
                                            <th style="width: 70px;">Quản lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($history) || !empty($history)) : ?>
                                            <?php foreach ($history as $item) : ?>
                                                <tr>
                                                    <td><?= $item['id'] ?></td>
                                                    <td><?= $item['title'] ?></td>
                                                    <td><?= $item['time_date'] ?></td>
                                                    <td><?= $item['score'] ?></td>


                                                    <td>
                                                        <div class="btn-group">

                                                            <a href="<?= url('User/indexExamHistory/' . $item['id']) ?>" class="btn btn-small btn-primary">
                                                            xem
                                                            </a>
            
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else:?>
                                            <tr>
                                                <td colspan="5">Không có dữ liệu</td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                </div>
            </div>


            <div class="span3">
                <div class="side-bar">

                    <h3>DANH MỤC</h3>
                    <ul class="nav nav-list">
                        <li><a href="#">LUYỆN BÀI NGHE</a></li>
                        <li><a href="#">LUYỆN BÀI ĐỌC</a></li>
                        <li><a href="#">THI THỬ</a></li>
                        <li><a href="#r">HỌC NGỮ PHÁP</a></li>
                        <li><a href="#">HỌC TỪ VỰNG</a></li>
                    </ul>

                </div>
            </div>

        </div>
        <!--Pagination-->
        <!-- <div class="paging">

            <a href="">Back</a>
            <a class="current">1</a>
            <a href="">2</a>
            <a class="current">3</a>
            <a href="">4</a>
            <a href="" class="pageNext">Next</a>

        </div> -->


    </div>

    <!--/.End Pagination-->
</div>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection
