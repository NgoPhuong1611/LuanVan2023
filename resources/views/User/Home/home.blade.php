@extends('User.layout')
@section('content')
    {{-- Nội dung của trang --}}
<input style="display:none;" id="baseUrl" value=""/>
<input id="baseUrl" value="" style="display: none;" />
<!--/End Headter-->

<!-- Search -->
<?php
use App\Models\Banner;

$banner = Banner::first();
?>
<div class="container">

    <div class="row">

        <br>
        <div class="span12">
            <div class="navbar  pull-right">
                <div id="size">
                    <form name="myform">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End search -->

<div class="container" id="resultsearch">
    <input style="display:none;" id="nameUser" value="" />
    <input style="display:none;" id="baseUrl" value="">
    <!--Carousel
  ==================================================-->
    <!-- slide 1 là để cứng. 2 slide còn lại dùng for each. load từ database lên -->
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">

            <div class="active item">
                <div class="container">
                    <div class="row">

                        <div class="span6">
                            <div class="carousel-caption">
                                <h1>Đào tạo chất lượng</h1>
                                <p class="lead">Chúng tôi cung cấp cho các bạn những kiến
                                    thức tốt nhất.</p>

                                <a class="btn btn-large btn-primary openModalFunction" href="{{ url('/User/Register') }}" id="modal1">Tham gia</a>


                                <a class="btn btn-large btn-primary openModalFunction" href="#" id="modal1">Xem ngay</a>

                            </div>
                        </div>

                        <div class="span6">
                        <img src="{{ asset('resources/file/images/slide/' . $banner->img_name) }}" alt="Image not found" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- <c:forEach items="${listslidebanner}" var="list"> -->
            <div class="item">
                <div class="container">
                    <div class="row">
                        <div class="span6">
                            <div class="carousel-caption">
                                <h1>Đào tạo chất lượng</h1>
                                <p class="lead">Chúng tôi cung cấp cho các bạn những kiến
                                    thức tốt nhất.</p>
                                <a class="btn btn-large btn-primary openModalFunction" id="modal2">Tham gia</a>
                                <a class="btn btn-large btn-primary doExam ">Tham gia</a>
                                <!-- <a class="btn btn-large btn-primary openModalFunction" id="modal2">Xem ngay</a>
									<a class="btn btn-large btn-primary  doExam">Xem ngay</a> -->
                            </div>
                        </div>
                        <div class="span6">
                            <img src="../resources/file/images/slide/slide1.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="icon-chevron-left"></i></a> <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="icon-chevron-right"></i></a>
        <!-- /.Carousel nav -->

    </div>
    <!-- /Carousel -->

    <!-- Feature
  ==============================================-->


    <div class="row feature-box">
        <div class="span12 cnt-title">
            <h1>Cung cấp các giao diện học và thi thân thiện.</h1>
            <span>--- Học thử, Làm bài tập, Thi thử ---</span>
        </div>

        <div class="span4">
            <img src="../resources/file/images/baiDocId=1.png">

            <h2>Học từ vựng, ngữ pháp</h2>
            <p>Các bài hướng dẫn đơn giản, dễ hiểu.</p>
            <a href="#" id="modal1" class="openModalFunction">Chi tiết &rarr;</a>

        </div>

        <div class="span4">
            <img src="../resources/file/images/baiDocId=21.png">
            <h2>Bài tập phần nghe, đọc</h2>
            <p>Sử dụng các dạng bài tập thường xuyên xuất hiện.</p>
            <a href="#" id="modal2" class="openModalFunction">Chi tiết &rarr;</a>
        </div>

        <div class="span4">
            <img src="../resources/file/images/baiDocId=21.png">
            <h2>Đề thi thử</h2>
            <p>Cập nhật, đổi mới liên tục, sát với đề thi thật nhất.</p>
            <a href="#" class="doExam" id="doExam">Chi tiết &rarr;</a>
        </div>
    </div>
    <!-- /.Feature -->

    <div class="hr-divider"></div>

    <!-- Row View -->

    <div class="row">
        <div class="span8">
            <img src="../resources/file/images/background3.png">
        </div>

        <div class="span4">
            <!--   <img class="hidden-phone" src="Template/Frontend/img/icon4.png" alt="img not found"> -->
            <h1 align="center">Tin cậy - uy tín</h1>
            <p align="justify">Mỗi năm, có hàng nghìn lượt học viên đã tham
                dự các khóa học tiếng Anh tại CFL và đạt kết quả như ý muốn. Chúng
                tôi tự hào là một trong những trung tâm ngoại ngữ được yêu thích,
                là địa chỉ tin cậy của những ai có nhu cầu nâng cao kiến thức về tiếng Anh của mình</p>

        </div>
    </div>


</div>


<!-- /.Row View -->




<!-- Start Modal -->

<div class="modal fade" id="openModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">DANH SÁCH LOẠT BÀI HƯỚNG DẪN</h4>
            </div>

            <div class="modal-body">

                <div class="media">
                    <a class="pull-left"><img src="" id="image1" class="media-object" /></a>
                    <div class="media-body">
                        <h3>
                            <a href="" id="name1" name="name1"></a>
                        </h3>
                    </div>
                </div>

                <div class="media">
                    <a class="pull-left"><img src="" id="image2" class="media-object" /></a>
                    <div class="media-body">
                        <h3>
                            <a href="" id="name2" name="name2"></a>
                        </h3>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
            </div>

        </div>
    </div>
</div>
<!-- End Modal -->

@endsection
