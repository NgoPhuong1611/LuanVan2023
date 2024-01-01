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
                <h4 style="font-weight: bold;">TIN TỨC</h4>
            </div>
        </div>
        <div class="span3">
            <div class="navbar  pull-right">
                <div>
                    <input type="text" class="form-control" id="searchGrammar" placeholder="Tìm kiếm tin tức ..." style="width: 300px; margin-top:6px;margin-right:-40px;" name="search" onkeyup="Search()">
                </div>
            </div>
        </div>
    </div>
    <!-- /. PAGE TITLE-->
    <div id="resultsearchGrammar">
        <div class="row">
            <div class="span9">
                <div class="row">
                    <?php foreach ($posts as $item) { ?>
                        <div class="span3">
                            <div class="card ">
                            <a href="{{ url('blog/detail', $item->id) }}">
                                    <div class="card-body" style="height: 200px;">
                                            <div class="col-4">
                                                <p><b><h4 class="card-title"><?= $item['title']  ?></h4></b></p>
                                            </div>
                                            <div class="article-content text-justify">
                                                <p class="card-text"><?= $item['description']  ?></p>
                                            </div>
                                            <div class="col-4">
                                                <div class="card-footer text-muted"><i class="fa fa-clock-o"></i> <?= date('d/m/Y', strtotime($item['created_at'])) ?></div>
                                            </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
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
