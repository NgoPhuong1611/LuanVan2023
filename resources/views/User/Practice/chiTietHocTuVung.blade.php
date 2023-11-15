<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Hướng dẫn từ vựng chi tiết</title>


    <script src="${pageContext.request.contextPath}/resources/js/jquery-1.js"></script>
    <script src="${pageContext.request.contextPath}/resources/js/html5shiv.js"></script>

    <link rel="stylesheet" href="${pageContext.request.contextPath}/resources/css/bootstrap.css" />


    <style type="text/css">
        .showtext {
            text-align: auto;
            padding-top: 0.5em;
            padding-right: 1em;
            padding-bottom: 0.5em;
            padding-left: 1em;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#btnComment').click(function() {

                var test = $("#contentComment").val();
                var baitaptuvungId = $("#id_bai_tu_vung").val();
                var baseUrl = $('#baseUrl').val();
                $.ajax({
                    dataType: "json",
                    type: 'POST',
                    url: baseUrl + "/api/client/vocab/ajaxCmtVocab/" + test + "/" + baitaptuvungId,

                    success: function(result) {

                        var obj = JSON.parse(result);

                        var name = "<h4 style='color:red'>" + obj.nguoidung + "</h4> ";
                        var content = "<textarea disabled class='input-xxlarge showtext' rows='3' name='cmtvocabularycontent' >" + obj.cmtvocabularycontent + "</textarea>";

                        $('#listcomment').append(name);
                        $('#listcomment').append(content);

                    },
                    error: function(e) {
                        alert("error");
                        console.log("ERROR: ", e);
                    }
                });

            });

        });
    </script>


</head>

<body> -->

    <!--Header
==========================-->

    <?php include "../client/template/header.php" ?>
    <input id="baseUrl" value="" style="display: none;" />
    <!--/End Headter-->

    <!-- Page container -->

    <div class="container">
        <!--PAGE TITLE-->

        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h3>Bài hướng dẫn học từ vựng</h3>
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

                            <li><i class="icon-calendar"></i><a href="#">April, 2019</a></li>

                            <li>
                                <!-- count comment in StudyGrammarController --><i class="icon-comment"></i>
                                <a href="#">Comments </a>
                            </li>


                        </ul>
                    </div>

                    <img src="../resources/file/images/vocabulary.jpg" style="height: 330px; width: 870px">


                    <p>
                        <c:forEach items="${listCauHoi}" var="list">

                            <div class="row">
                                <div class="span3">
                                    <b><span style="color: blue"> 
									</span>
									</b> <br> <br> <img src="../resources/file/images/vocab/1.cr7.PNG" alt="image not found" style="height: 210px; width: 300px;" /> <br>

                                    <br>
                                </div>
                                <div class="span6">
                                    <br> <br>
                                    <p>
                                        <b>NAmE:</b> &nbsp; <span style="color: red">ronaldo</span>
                                    </p>

                                    <p>
                                        <b>Từ loại </b> danh tu
                                    </p>

                                    <p>
                                        <b>Ví dụ: </b> danh tu
                                    </p>

                                    <audio controls> <source
										src="../resources/file/audio/vocab/${list.audiomp3}"
										type="audio/wav"></audio>

                                    <br>

                                </div>



                            </div>
                            <br>

                        </c:forEach>

                    </p>


                </div>




            </div>

            <!--/End Blog Post-->

            <!-- Start Categories -->
            <div class="span3 ">
                <br> <br> <br> <br>

                <div class="side-bar ">

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

            <c:if test="${pageContext.request.userPrincipal.name == null}">
                <form>
                    <fieldset>
                        <h3>Bình luận</h3>

                        <textarea class="input-xxlarge" rows="3" placeholder="Viết bình luận đánh giá về bài đăng này..." name="comment" disabled style="text-align: justify;">
					 
					 Đăng nhập để bình luận bài viết
					</textarea>
                        <br>
                        <button type="button" class="btn btn-primary" disabled ">Đăng
							bình luận</button>
					</fieldset>

				</form>

			</c:if>




			<!-- <if test="${pageContext.request.userPrincipal.name !=n ull} "> -->
				<!--  	<input type="hidden " id="user_id " name="user_id " value="${currentUser.id} "/> -->
				<input type="hidden " id="id_bai_tu_vung " value="" />

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


			<!-- </if> -->





			<!-- Nội dung commnetn -->


			<h1 id="testajax "></h1>

			<div id="listcomment ">
				<!-- <forEach items="${listcomment} " var="list ">
					<h4 style="color: red " id="name_member "></h4>
					<textarea disabled class="input-xxlarge showtext " rows="3 "
						name="cmtvocabularycontent "></textarea>
				</forEach> -->
			</div>




			<!-- End Nội dung commnetn -->

		</div>

		<!-- End Comment -->


	</div>
	<!-- End Page Container -->



</body>
</html>