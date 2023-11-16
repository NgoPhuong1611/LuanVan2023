@extends('User.layout')
@section('content')
    <!-- Your content here -->

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
</style>
<script type="text/javascript">
	function Search() {

		var baseUrl = document.getElementById('baseUrl').value;
		var xhttp;
		var search = document.getElementById('searchGrammar').value;

		//remove special letters
		var convertSearch = search.replace(/[^a-zA-Z0-9 ]/g, "");

		var url;
		if (!search == ' ') {
			url = baseUrl + "/searchGrammar/" + convertSearch;
		} else url = baseUrl + "/searchGrammar/all";


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
		}

		xhttp.open("POST", url, true);
		xhttp.send();

	}
</script>




<input style="display:none;" id="baseUrl" value="" />

<div class="container">
	<!--PAGE TITLE-->
	<div class="row">
		<div class="span9" style="text-align: center">
			<div class="page-header">
				<h4 style="font-weight: bold;">DANH SÁCH BÀI THI </h4>
			</div>
		</div>
		<div class="span3">
			<div class="navbar  pull-right">
				<div>
					<input type="text" class="form-control" id="searchGrammar" placeholder="Tìm kiếm bài thi ..." style="width: 300px; margin-top:6px;margin-right:-40px;" name="search" onkeyup="Search()">
				</div>
			</div>
		</div>
	</div>
	<!-- /. PAGE TITLE-->
	<div id="resultsearchGrammar">
		<div class="row">
			<div class="span9">
				<?php foreach ($exam as $value) { ?>
					<div class="span1.0">
						<div class="thumbnail well">
							<img width="100" height="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGYjojzDhbNMTBJAmtBMbFi_81QnabIKDSbQ&usqp=CAU" alt="Card image cap">
							<div class="caption">
								<h4>ĐỀ: <?= $value['title'] ?></h4>
								<p><?= $value['updated_at'] ?></p>
                                <a href="{{ url('Exam/ExamToeic/' . $value['id']) }}" class="btn btn-primary">Exam now</a>							</div>
						</div>
					</div>
				<?php } ?>
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
