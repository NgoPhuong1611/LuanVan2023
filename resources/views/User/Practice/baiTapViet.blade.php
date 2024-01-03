<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài test Toeic</title>
    <script src="{{ asset('resources/js/jquery-1.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="{{ asset('resources/js/client/baiTestListening.js') }}"></script>
    <script src="{{ asset('resources/js/client/baiTestReading.js') }}"></script>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<style>
    .paragraph {
        white-space: pre-wrap;
        word-break: break-word;
        text-align: justify;
        background: #f3f7fa;
        color: #222;
        font-size: 14px;
        font-style: 'Roboto';
    }

    #main {
        padding-top: 120px;
        overflow: hidden;
    }

    @media (min-width : 767px) {
        #navigation {
            margin-top: 50px;
            position: fixed;
        }
    }

    .fix-scrolling {
        max-height: 600px;
        overflow-y: scroll;

    }



    #time {
        font-size: 25px;
        margin-left: 100px;
        color: green
    }

    #backhome {
        margin-left: 25px;
        text-decoration: none;
    }

    #btnSubmit {
        margin-bottom: 15px;
        margin-left: 15px;
    }

    #btnResult {
        margin-bottom: 15px;
        margin-left: 25px;
    }

    #btndoAgain {
        display: none;
        margin-bottom: 15px;
        margin-left: 40px;
    }

    .web-font {
        font-size: 15px;
        font-family: 'Arial';
    }

    .audio-container {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
    }

    .audio-player {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }

    a {
        color: white;
    }

    a:link .numberCircle {
        background-color: #337ab7;
    }

    .numberCircle {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 15px;
        line-height: 25px;
        text-align: center;
        border: 2px solid #2e6da4;
        margin: 5px 5px 5px 15px;
    }

    .numberCircle.active {
        background-color: rgb(167, 162, 162);
        ;
        /* Màu nền tô đậm khi câu hỏi được chọn */
    }

    .correct-answer {
        color: blue;
        font-weight: bold;
    }

    .wrong-answer {
        color: red;
        font-weight: bold;
    }

    .not-answer {
        color: green;
        font-weight: bold;
    }
    .explain{
        font-weight: bold;
    }
    #listeing-result {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 20px;
        font-size: 16px;
        color: #333;
    }
</style>

<style>
    #bsw_popup {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: fixed;
        opacity: 0;
        visibility: hidden;
        transition: .5s;
        transform: scale(1.2)
    }

    #bsw_popup:target {
        transform: scale(1);
        background: rgba(0, 0, 0, .2);
        opacity: 1;
        visibility: visible;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: 0;
        z-index: 999999999999;
        transition: .5s
    }

    .bsw_popup_ {
        background: #fff;
        border-radius: 4px;
        z-index: 999;
        width: 600px;
        max-width: 100%;
        position: fixed;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0;
        padding: 20px;
        box-sizing: border-box;
        box-shadow: 0 0 100px rgba(0, 0, 0, .1)
    }

    .bsw_popup_ h2 {
        margin: 0 0 .75em;
        padding: 0;
        text-align: center;
        font-weight: 700;
        font-family: Roboto, sans-serif;
        color: #4267b2
    }

    .bsw_popup_ h3 {
        margin: 0 0 5px;
        padding: 0;
        font: 500 15px Roboto;
        text-transform: uppercase
    }

    .bsw_popup_ p {
        margin: 0 0 20px;
        padding: 0;
        font: 400 15px Roboto;
        color: #555;
        line-height: 1.5
    }

    .bsw_popup_ p a {
        font-weight: 700;
        color: #555
    }

    .bsw_popup_ p a:hover {
        text-decoration: underline
    }

    #reading-result {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 20px;
        font-size: 16px;
        color: #333;
    }

</style>

<body>
    <div id='bsw_popup'>
        <div class='bsw_popup_'>
            <h2>kết quả bài thi toeic </h2>
            <p><b>LISTEING 0/100 => Your score 0/495</b></p>
            <p><b>READING 0/100 => Your score 0/495</b></p>
            <h3>TOTAL SCORE: </h3>
            <a class="close" href="{{ url('') }}" title="Close"><i aria-hidden="true" class="fa fa-check"></i> Thoát bài thi</a>        </div>
    </div>
    <!--Header
==========================-->
    <div class="testReading" id="testReading">
        <div class="navbar navbar-default navbar-fixed-top">
            <br>
            <div style="display: block;">
                <p>
                <a href="{{ url('/') }}" id="backhome" style="display: inline;">
                                        Home</a> <span>Bài test Random</span>
                </p>
            </div>

            <!--
<div>
		<c:forEach begin="1" end="50" varStatus="loop">
			<div class="numberCircle" id="answer${loop.index}">${loop.index}</div>
		</c:forEach>
</div>

-->


        </div>


        <!--/End Header-->

        <div id="content" class="container-fluid fill">
            <form action="{{ url('save') }}" method="post" id="submitForm" name="submitForm">
                @csrf
                <div class="row">
                    <div id="navigation" class="col-md-4 ">

                        <div class="fix-scrolling">
                            <br>

                            <hr width="60%">
                            <?php $count = 0; ?>


                            <?php foreach ($question as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>


                            <br> <br>
                            <!-- 	<input type="button" id="btndoAgain" class="btn btn-warning" value="Làm lại"> -->

                            <input type="button" class="btn btn-primary" id="#bsw_popup" value="Chấm điểm" onclick="result()" /><br><br>
                            <div id="reading-result"></div>
                            <hr width="60%">

                        </div>

                    </div>
                    <div class="col-md-4">
                        <!-- Placeholder - keep empty -->
                    </div>
                    
                    <!--Nội dung bài test -->
                    <div id="main" class="col-md-8 web-font">

                        <div class="part">
                            <!--- nếu là part number 13(part writing:Write a sentence based on a picture)--->
                            <?php if ($part[0]['part_number'] == 13) { ?>
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                        <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                                    </div>
                                </div>

                                {{-- load hình ảnh của câu hỏi --}}
                                <div class="question_image">
                                    <?php foreach ($question_image as $image) : ?>
                                        <?php if ($image['question_id'] == $value['id']) { ?>
                                            <img width="500px" height="300px" src="{{ asset('uploads/images/' . $image['image_name']) }}" alt="Mô tả ảnh">                                <?php } ?>
                                    <?php endforeach ?>
                                </div>
                        {{-- form nhập text trả lời --}}
                                <?php foreach ($question as $value) : ?>
                                    <p><b>Question:</b> <?= $value['question'] ?></p>
                                    <textarea class="form-control" id="editor" name="answer<?= $value['id'] ?>" placeholder="Your answer..." required></textarea>
                                    <button type="submit">Lưu</button>
                                    <?php endforeach ?>


                                {{-- nếu là part 14 (Phần WRITING: Respond to a written request) --}}
                                <?php } elseif ($part[0]['part_number'] == 14) { ?><!--- part 14,15--->
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                            <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                                        </div>
                                    </div>
                            {{-- form nhập text trả lời --}}
                                    <?php foreach ($question as $value) : ?>
                                        <p><b>Question:</b> <?= $value['question'] ?></p>
                                        <textarea class="form-control" id="editor" name="answer<?= $value['id'] ?>" placeholder="Your answer..." required></textarea>
                                    <?php endforeach ?> 

                                    {{-- load trường hợp part 15 Phần WRITING:Write an opinion essay --}}
                                    <?php } elseif ($part[0]['part_number'] == 15) { ?><!--- part 14,15--->
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                                <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                                            </div>
                                        </div>
                                {{-- form nhập text trả lời --}}
                                        <?php foreach ($question as $value) : ?>
                                            <p><b>Question:</b> <?= $value['question'] ?></p>
                                            <textarea class="form-control" id="editor" name="answer<?= $value['id'] ?>" placeholder="Your answer..." required></textarea>
                                        <?php endforeach ?> 
                            <?php } ?>

                            <hr>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!--Footer
==========================-->

    <!--/.Footer-->
    <script>
        function highlightNumberCircle(questionId) {
            // Xóa tất cả các đối tượng có class "active"
            let numberCircles = document.getElementsByClassName("numberCircle");
            for (let i = 0; i < numberCircles.length; i++) {
                numberCircles[i].classList.remove("active");
            }

            // Thêm class "active" vào đối tượng có id tương ứng với câu hỏi được chọn
            let selectedNumberCircle = document.getElementById("answer" + questionId);
            if (selectedNumberCircle) {
                selectedNumberCircle.classList.add("active");
            }
        }

        function markColor(id) {
            //tách lấy id của câu hỏi
            var fields = id.split('.');
            var answerId = fields[1];
            document.getElementById("answer" + answerId).style.backgroundColor = "rgb(167,162,162)";

        }

        function result() {

            var numberListeing = 0;
            var numberReading = 0;

            var scoreListeing = 0;
            var scoreReading = 0;
            var scoreTotal = 0;
            //part1
            <?php foreach ($question as $value) : ?>
                var answers = document.getElementsByName("<?= $value['id'] ?>");
                var a = <?= $value['right_option'] ?>;
                var answerSelected = false; // Thêm biến này để kiểm tra xem đã có answer nào được chọn hay chưa
                for (var i = 0; i < answers.length; i++) {
                    if (answers[i].checked && answers[i].value == a) {
                        answers[i].parentElement.classList.add("correct-answer");
                        numberReading++;
                        answerSelected = true; // Đánh dấu đã có answer được chọn
                    } else if (answers[i].checked && answers[i].value != a) {
                        answers[i].parentElement.classList.add("wrong-answer");
                        answerSelected = true; // Đánh dấu đã có answer được chọn
                    }
                    if (answerSelected) { // Nếu đã có answer được chọn, disabled các answers còn lại
                        let explain = document.getElementById("explain<?= $value['id'] ?>");
                        explain.innerHTML = '<div class="panel panel-primary"><div class="panel-body">' + '<?= $value['explain'] ?>' + '</div></div>';
                        for (var j = 0; j < answers.length; j++) {
                            answers[j].disabled = true;
                        }

                    }
                }
            <?php endforeach ?>
            var readingResultDiv = document.getElementById("reading-result");
            readingResultDiv.innerHTML = "<p>Số câu ĐÚNG: " + numberReading + "</p>";

            // var ls = [5, 5, 5, 5, 5, 5, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 110, 115, 120, 125, 130, 135, 140, 145, 150, 160, 165, 170, 175, 180, 185, 190, 195, 200, 210, 215, 220, 230, 240, 245, 250, 255, 260, 270, 275, 280, 290, 295, 300, 310, 315, 320, 325, 330, 340, 345, 350, 360, 365, 370, 380, 385, 390, 400, 405, 410, 420, 425, 430, 440, 445, 450, 460, 465, 470, 475, 480, 485, 490, 495, 495, 495, 495, 495, 495, 495, 495, 495, 495, 495];
            // for (var i = 1; i <= 100; i++) {
            //     if (numberListeing == i) {
            //         scoreListeing = ls[i]
            //     }
            // }
            // for (var i = 1; i <= 100; i++) {
            //     if (numberReading == i) {
            //         scoreReading = ls[i]
            //     }
            // }
            // var Rs = [5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 60, 65, 70, 80, 85, 90, 95, 100, 110, 115, 120, 125, 130, 140, 145, 150, 160, 165, 170, 175, 180, 190, 195, 200, 210, 215, 220, 225, 230, 235, 240, 250, 255, 260, 265, 270, 280, 285, 290, 300, 305, 310, 320, 325, 330, 335, 340, 350, 355, 360, 365, 370, 380, 385, 390, 395, 400, 405, 410, 415, 420, 425, 430, 435, 445, 450, 455, 465, 470, 480, 485, 490, 495, 495, 495, 495];
            // for (var i = 1; i <= 100; i++) {

            //}
            // var scoreTotal = scoreListeing + scoreReading;
            // $("b:contains('LISTEING 0/100 => Your score 0/495')").text("LISTEING " + numberListeing + "/100 => Your score " + scoreListeing + "/495");
            // $("b:contains('READING 0/100 => Your score 0/495')").text("READING " + numberReading + "/100 => Your score " + scoreReading + "/495");
            // $("h3:contains('TOTAL SCORE: ')").text("TOTAL SCORE:  " + scoreTotal);
            // $("h2:contains('kết quả bài thi toeic ')").text("kết quả bài thi toeic:  " + scoreTotal);

        }
    </script>
</body>

</html>
