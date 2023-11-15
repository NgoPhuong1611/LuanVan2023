
<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<style type="text/css">
.hidden {
	display: none;
}

.error-message {
	color: red;
}

.anchor {
	display: block;
	height: 115px; /*same height as header*/
	margin-top: -115px; /*same height as header*/
	visibility: hidden;
}

.imageGrammar {
	float: left;
	height: 150px;
	width: 250px;
	margin-bottom: 25px;
}
</style>
<script type="text/javascript">
	function Search(){

		var baseUrl = document.getElementById('baseUrl').value;
		var xhttp;
		var search = document.getElementById('searchGrammar').value;

		//remove special letters
		var convertSearch = search.replace(/[^a-zA-Z0-9 ]/g, "");

		var url;
		if(!search == ' ')
		{	url= baseUrl+"/searchGrammar/"+convertSearch;
		}
		else url = baseUrl+"/searchGrammar/all";


			if(window.XMLHttpRequest){
				xhttp = new XMLHttpRequest();
			}
			else{
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xhttp.onreadystatechange = function(){
				if(xhttp.readyState == 4){
					var data = xhttp.responseText;
					document.getElementById("resultsearchGrammar").innerHTML = data;
				}
			}

			xhttp.open("POST",url,true);
			xhttp.send();

		}
</script>




	<input style="display:none;" id="baseUrl" value=""/>

	<div class="container">
		<!--PAGE TITLE-->
		<div class="row">
		<div class="span9" style="text-align: center">
			<div class="page-header">
				<h4 style="font-weight: bold;">DANH SÁCH BÀI THI ĐỌC</h4>
			</div>
		</div>
		<div class="span3">
			<div class="navbar  pull-right">
					<div>
							<input type="text" class="form-control" id="searchGrammar"
								placeholder="Tìm kiếm bài thi đọc..."
								style="width: 300px; margin-top:6px;margin-right:-40px;"
								name="search"
								onkeyup="Search()">
					</div>
				</div>
		</div>
		</div>
		<!-- /. PAGE TITLE-->
	<div id="resultsearchGrammar">
		<div class="row">

			<div class="span9">

					<h3>Không tìm thấy dữ liệu</h3>



					<div class="span9">
						<div class="span3">
							<img class="imageGrammar"
								src="<?=base_url()?>resources/file/images/grammar/27.thi_htht_anhngumshoa.jpg" />

						</div>
						<div class="span1"></div>

						<div class="span5">
							<div class="content-heading">
								<h4>Tên bài</h4>
							</div>
							<div>
                            <a href="<?=base_url('Exam/ExamRead')?>"
									class="btn btn-primary">Làm Bài</a>
							</div>

						</div>
					</div>


				<br>
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

        </div>



	<!--Pagination-->


		<div class="paging">

				<a href="">Back</a>


				<a class="current">1</a>



				<a href="">2</a>




					<a class="current">3</a>


					<a href="">4</a>



				<a href=""
					class="pageNext">Next</a>

		</div>


</div>

	<!--/.End Pagination-->
</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <?= $this->endSection() ?>
