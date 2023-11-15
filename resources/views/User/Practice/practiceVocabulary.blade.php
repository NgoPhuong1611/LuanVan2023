
<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<style>
    .imageVocab {
        float: left;
        height: 150px;
        width: 250px;
        margin-bottom: 25px;
    }
</style>



<!-- // <body> -->

<!--Header
==========================-->


<input id="baseUrl" value="${pageContext.request.contextPath}" style="display: none;" />
<!--/End Headter-->

<!-- Page container -->
<div class="container">
    <!--PAGE TITLE-->
    <div class="row">
        <div class="span9" style="text-align: center">
            <div class="page-header">
                <h4 style="font-weight: bold;">DANH SÁCH BÀI HƯỚNG DẪN VOCABULARY</h4>
            </div>
        </div>
        <div class="span3">
            <div class="navbar  pull-right">
                <div>
                    <input type="text" class="form-control" id="searchVocab" placeholder="Tìm kiếm bài vocabulary..." style="width: 300px; margin-top: 6px; margin-right: -40px;" name="search" onkeyup="SearchVocab()">
                </div>
            </div>
        </div>

    </div>

    <!-- /. PAGE TITLE-->
    <div id="resultsearch">
        <div class="row">
            <div class="span9">
                <c:if test="${fn:length(listData) == 0 }">
                    <h3>Không tìm thấy dữ liệu</h3>
                </c:if>

                <c:forEach items="${listData}" var="list">
                    <div class="span9">

                        <div class="span3">
                            <img class="imageVocab" src="<?= base_url() ?>resources/file/images/vocab/2.avoid.jpg" />
                        </div>
                        <div class="span1"></div>

                        <div class="span5">
                            <div class="content-heading">
                                <h4> tên bài </h4>
                            </div>
                            <div>
                                <a href="#" class="btn btn-primary">Chi tiết</a>
                            </div>

                        </div>
                    </div>

                </c:forEach>
            </div>

            <div class="span3">
                <div class="side-bar">

                    <h3>DANH MỤC</h3>
                    <ul class="nav nav-list">
                        <li><a href="/webtoeic/listening">LUYỆN BÀI NGHE</a></li>
                        <li><a href="/webtoeic/reading">LUYỆN BÀI ĐỌC</a></li>
                        <li><a href="/webtoeic/listExam">THI THỬ</a></li>
                        <li><a href="/webtoeic/listGrammar">HỌC NGỮ PHÁP</a></li>
                        <li><a href="/webtoeic/listVocab">HỌC TỪ VỰNG</a></li>
                    </ul>
                </div>
            </div>

        </div>


        <!--Pagination-->
        <c:if test="${not empty listData}">

            <div class="paging">
                <c:if test="${currentPage != 1}">
                    <a href="#">Back</a>
                </c:if>
                <c:if test="${currentPage == 1}">
                    <a class="current">1</a>
                </c:if>

                <c:if test="${currentPage != 1}">
                    <a href="#">1</a>
                </c:if>

                <!-- <c:forEach var="pag" items="${pageList}" varStatus="loop">
                                    <c:if test="${currentPage == pag}">
                                        <a class="current">${pag}</a>
                                    </c:if>
                                    <c:if test="${currentPage != pag}">
                                        <a href="/webtoeic/listVocab?page=${pag}">${pag}</a>
                                    </c:if>
                                </c:forEach> -->

                <c:if test="${currentPage != totalPage}">
                    <a href="#">Next</a>
                </c:if>
            </div>
        </c:if>



        <!--/.End Pagination-->

    </div>

    <!-- End Page container -->
</div>
<!--Footer
==========================-->
<br><br><br><br><br><br><br><br>
</body>

</html>
<?= $this->endSection() ?>
