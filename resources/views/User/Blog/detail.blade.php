@extends('User/layout')

@section('content')
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

    .imageGrammar {
        float: left;
        height: 150px;
        width: 250px;
        margin-bottom: 25px;
    }
    .article-content {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

<input style="display:none;" id="baseUrl" value="" />
<div class="container">
    <!--PAGE TITLE-->
    <div class="row">
        <div class="span9" style="text-align: center">
            <div class="page-header">
                <h4 style="font-weight: bold;">TIN TỨC</h4>
            </div>
        </div>
        <div class="span3">

        </div>
    </div>
    <!-- /. PAGE TITLE-->
    <div id="resultsearchGrammar">
        <div class="row">
            <div class="span9">
                <div class="blog-single gray-bg">
                    <div class="container" style="width: 90%;">
                        <div class="row align-items-start">
                            <div class="col-lg-8 m-15px-tb">
                                <article class="article">
                                    <div class="article-title">
                                        @if($category)
                                            <h4><a>{{ $category['name'] ?? '' }}</a></h4>
                                        @endif
                                        <div class="media">
                                            <div class="media-body">
                                                @if($admin && $post)
                                                    <span>{{ $admin['username'] ?? '' }}/{{ $post['updated_at'] ?? '' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p>
                                            <b>
                                                <h2><?= $post['description'] ?? '' ?> </h2>
                                            <b>
                                        <p>
                                    </div>
                                    <div class="article-content text-justify">
                                        @if($post)
                                            <p><b><?= $post['content'] ?? '' ?></b></p>
                                        @endif
                                    </div>
                                </article>
                            </div>
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
