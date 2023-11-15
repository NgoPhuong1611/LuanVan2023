<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input id="baseUrl" value="" style="display: none;" />
<!--/End Headter-->

<!-- Page container -->

<div class="container">
    <!--PAGE TITLE-->

    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h3>Bài hướng dẫn học ngữ pháp</h3>
            </div>
        </div>
    </div>

    <!-- /. PAGE TITLE-->



    <div class="row">

        <!--/Start Blog Post-->

        <div class="span9">
            <div class="blog-post">
                <h2 style="text-align: center; color: blue">Chủ đề: </h2>
                <!-- -->
                <div class="postmetadata">
                    <ul>
                        <li><i class="icon-user"></i> <a href="#">SoICT-HUST</a></li>
                        <li><i class="icon-calendar"></i><a href="#">May, 2019</a></li>
                        <li><i class="icon-comment"></i> <a href="#"> $Comments </a></li>
                    </ul>
                </div>
                <img src="<?= base_url() ?>resources/file/images/vocabulary.jpg" style="height: 330px; width: 870px">
                <div class="row" style="text-align: justify;">
                    <div class="span3"></div>

                    <div class="span9">........sấdasd</div>

                </div>
            </div>
        </div>

        <!--/End Blog Post-->

        <!-- Start Categories -->
        <div class="span3 ">
            <br> <br> <br> <br>

            <div class="side-bar ">

                <h3>Danh mục</h3>
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
    <!-- End Categories -->



    <!-- Start Comment -->

    <div class="row">

        <!-- <c:if test="${pageContext.request.userPrincipal.name == null}"> -->
            <form>
                <fieldset>
                    <h3>Bình luận</h3>

                    <textarea class="input-xxlarge" rows="3" placeholder="Viết bình luận đánh giá về bài đăng này..." name="comment" disabled style="text-align: justify;">

					 Đăng nhập để bình luận bài viết
					</textarea>
                    <br>
                    <button type="button" class="btn btn-primary" disabled >Đăng
							bình luận</button>
					</fieldset>

				</form>

			<!-- </c:if> -->




			<!-- <c:if test="${pageContext.request.userPrincipal.name !=n ull} "> -->
				<!--  	<input type="hidden " id="user_id " name="user_id " value="${currentUser.id} "/> -->
				<input type="hidden " id="id_bai_grammar " value=" " />

				<div class="blog-spot ">
					<div>
						<h3>Bình luận</h3>
						<textarea id="contentComment " class="input-xxlarge " rows="3 "
							name="contentComment "
							placeholder="Viết bình luận đánh giá về bài đăng này... "></textarea>

					</div>
					<div>
						<button id="btnComment " type="button " class="btn btn-primary ">Đăng
							bình luận</button>
					</div>
				</div>

<!--
			</c:if> -->





			<!-- Nội dung commnetn -->


			<h1 id="testajax "></h1>

			<div id="listcomment ">
				<c:forEach items="${listcomment} " var="list ">

					<h4 style="color: red " id="name_member "></h4>
					<textarea disabled class="input-xxlarge showtext " rows="3 "
						name="cmtvocabularycontent "></textarea>
				</c:forEach>
			</div>




			<!-- End Nội dung commnetn -->

		</div>

		<!-- End Comment -->


	</div>
	<!-- End Page Container -->



</body>
</html>
<?= $this->endSection() ?>
