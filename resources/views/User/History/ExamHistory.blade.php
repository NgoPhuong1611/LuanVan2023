<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Bài test Toeic</title>
    <script src="{{ asset('resources/js/jquery-1.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
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
    .explain {
        font-weight: bold;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var audioPlayers = document.querySelectorAll('.audio-player1');
        playAudio(0, audioPlayers);
    });

    function playAudio(index, audioPlayers) {
        if (index < audioPlayers.length) {
            audioPlayers[index].play();
            audioPlayers[index].addEventListener('ended', function() {
                playAudio(index + 1, audioPlayers);
            });
        }
    }
</script>

<body>
    <div id='bsw_popup'>
        <div class='bsw_popup_'>
            <h2>Kết quả bài thi toeic </h2>
            <p><b>LISTEING 0/100 - Your score 0/495</b></p>
            <p><b>READING 0/100 - Your score 0/495</b></p>
            <h3>Tổng điểm: </h3>
            <a class='close' href="#" title='Close'><i aria-hidden='true' class='fa fa-check'>Đóng</a>
        </div>
    </div>
    <!--Header
==========================-->
    <div class="testReading" id="testReading">
        <div class="navbar navbar-default navbar-fixed-top">
            <br>
            <div style="display: block;">
                <p>
                    <a href="<?= url('') ?>" id="backhome">
                        Home
                    </a>
                    <span>Bài Thi</span>
                </p>
            </div>
        </div>


        <div id="content" class="container-fluid fill">
            <form action="" method="post" id="submitForm" name="submitForm">
                <div class="row">
                    <div id="navigation" class="col-md-4 ">

                        <div class="fix-scrolling">
                            <br>

                            <hr width="60%">
                            <?php $count = 0; ?>

                            <?php if (isset($question1)) { ?>

                            <?php foreach ($question1 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>
                            <?php if (isset($question2)) { ?>
                            <?php foreach ($question2 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>
                            <?php if (isset($question3)) { ?>
                            <?php foreach ($question3 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>
                            <?php if (isset($question4)) { ?>

                            <?php foreach ($question4 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>
                            <?php if (isset($question5)) { ?>
                            <?php foreach ($question5 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>
                            <?php if (isset($question6)) { ?>
                            <?php foreach ($question6 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>
                            <?php if (isset($question7)) { ?>
                            <?php foreach ($question7 as $value) : ?>
                                <?php $count++; ?>
                                <a href="#<?= $count ?>">
                                    <div class="numberCircle" id="answer<?= $value['id'] ?>">
                                        <?= $count ?>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <?php } ?>


                            <br> <br>
                            <!-- 	<input type="button" id="btndoAgain" class="btn btn-warning" value="Làm lại"> -->


                            <hr width="60%">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Placeholder - keep empty -->
                    </div>

                    <!--Nội dung bài test -->
                    <div id="main" class="col-md-8 web-font">

                        <div class="part">
                            <?php $index = 0; ?>
                            <!--- part 1--->
                            <?php if (isset($part1)) { ?>
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <h2><b style="font-weight: bold;">Part <?= $part1[0]['part_number'] ?></b></h2>
                                    <p><b>Direction:</b> <?= $part1[0]['direction'] ?></p>
                                </div>
                                <div class="audio-container">
                                    <audio class="audio-player1" id="audio-player<?= $index ?>">
                                    <source src="{{ asset('uploads/audios/part1.mp3') }}" type="audio/mpeg">
                                        <source src="<?= asset('uploads/audios/part1.mp3')?>" type="audio/wav">
                                    </audio>
                                </div>
                            </div>
                            <?php $count = 0; ?>
                            <?php foreach ($question1 as $value) : ?>
                                <?php $count++; ?>
                                <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> Mark your answer on your answer sheet.
                                    <?php foreach ($audios as $au) { ?>
                                        <?php if ($value['audio_id'] == $au['id']) {  ?>
                                <div class="audio-container">
                                    <audio class="audio-player1" id="audio-player<?= $index ?>">
                                        <source src="<?= asset('uploads/audios/' . $au['audio_name'])?>" type="audio/wav">
                                    </audio>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- start img  -->
                        <div class="question_image">
                            <?php foreach ($question_image as $image) : ?>
                                <?php if ($image['question_id'] == $value['id']) { ?>
                                    <img width="500px" height="300px" src="<?= asset('uploads/images/' .  $image['image_name']) ?>" alt="Mô tả ảnh">
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                        <!-- end img  -->
                        <!-- start answer  -->
                        <div class="question_answer">
                            <?php $i = 1; ?>
                            <?php foreach ($question_answer as $answer) : ?>
                                <?php if (($answer['question_id']) == ($value['id'])) { ?>
                                    <label class="radio-inline">
                                        <br><input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $value['id'] ?>" onclick="markColor(this.id)" ?><?= $answer['text']; ?><br><br>
                                        <?php $i++; ?>

                                    </label>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                        <div class="explain" id="explain<?= $value['id'] ?>"></div>
                        <!-- end answer  -->

                    <?php endforeach ?>
                    <?php } ?>
                    <!--- part 2--->
                    <?php if (isset($part2)) { ?>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h2><b style="font-weight: bold;">Part <?= $part2[0]['part_number'] ?></b></h2>
                            <p><b>Direction:</b> <?= $part2[0]['direction'] ?></p>
                        </div>
                        <div class="audio-container">
                            <audio class="audio-player1" id="audio-player<?= $index ?>">
                                <source src="<?= asset('uploads/audios/part2.mp3')?>"ass type="audio/wav">
                            </audio>
                        </div>
                    </div>
                    <?php $count = 6; ?>
                    <?php foreach ($question2 as $value) : ?>

                        <?php $count++; ?>
                        <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> Mark your answer on your answer sheet.
                        <p><?php $i = 1; ?>
                            <?php foreach ($audios as $au) { ?>
                                <?php if ($value['audio_id'] == $au['id']) {  ?>
                        <div class="audio-container">
                            <audio class="audio-player1" id="audio-player<?= $index ?>">
                                <source src="<?= asset('uploads/audios/' . $au['audio_name']) ?>" type="audio/wav">
                            </audio>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php foreach ($question_answer as $answer) : ?>
                    <?php if (($answer['question_id']) == ($value['id'])) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $value['id'] ?>" onclick="markColor(this.id)" /> <?= $answer['text']; ?> <br>
                            <?php $i++; ?>
                        </label>
                    <?php } ?>
                <?php endforeach ?>
                <div class="explain" id="explain<?= $value['id'] ?>"></div>

            <?php endforeach ?>
            <?php }?>
            <!--- part 3--->
            <?php if (isset($part3)) { ?>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h2><b style="font-weight: bold;">Part <?= $part3[0]['part_number'] ?></b></h2>
                    <p><b>Direction:</b> <?= $part3[0]['direction'] ?></p>
                </div>
                <div class="audio-container">
                    <audio class="audio-player1" id="audio-player<?= $index ?>">
                        <source src="<?= asset('uploads/audios/part3.mp3')?>"a type="audio/wav">
                    </audio>
                </div>
            </div>
            <?php $count = 31; ?>
            <?php foreach ($question3 as $value) : ?>

                <?php $count++; ?>
                <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> <?= $value['question'] ?>:</b>
                <p><?php $i = 1; ?>
                    <?php foreach ($audios as $au) { ?>
                        <?php if ($value['audio_id'] == $au['id']) {  ?>
                <div class="audio-container">
                    <audio class="audio-player1" id="audio-player<?= $index ?>">
                        <source src="<?= asset('uploads/audios/' . $au['audio_name']) ?>" type="audio/wav">
                    </audio>
                </div>
            <?php } ?>
        <?php } ?>
        <?php foreach ($question_answer as $answer) : ?>
            <?php if (($answer['question_id']) == ($value['id'])) { ?>
                <input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $value['id'] ?>" onclick="markColor(this.id)" /> <?= $answer['text']; ?> <br>
                <?php $i++; ?>
            <?php } ?>
        <?php endforeach ?>
        <div class="explain" id="explain<?= $value['id'] ?>"></div>
    <?php endforeach ?>
    <?php } ?>
    <!--- part 4--->
    <?php if (isset($part4)) { ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h2><b style="font-weight: bold;">Part <?= $part4[0]['part_number'] ?></b></h2>
            <p><b>Direction:</b> <?= $part4[0]['direction'] ?></p>
        </div>
        <div class="audio-container">
            <audio class="audio-player1" id="audio-player<?= $index ?>">
                <source src="<?= asset('uploads/audios/part4.mp3')?>" type="audio/wav">
            </audio>
        </div>
    </div>
    <?php $count = 70; ?>
    <?php foreach ($question4 as $value) : ?>

        <?php $count++; ?>
        <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> <?= $value['question'] ?></b>
        <p><?php $i = 1; ?>
            <?php foreach ($audios as $au) { ?>
                <?php if ($value['audio_id'] == $au['id']) {  ?>
        <div class="audio-container">
            <audio class="audio-player1" id="audio-player<?= $index ?>">
                <source src="<?= asset('uploads/audios/' .  $au['audio_name']) ?>" type="audio/wav">
            </audio>
        </div>
    <?php } ?>
<?php } ?>
<?php foreach ($question_answer as $answer) : ?>
    <?php if (($answer['question_id']) == ($value['id'])) { ?>
        <input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $value['id'] ?>" onclick="markColor(this.id)" /> <?= $answer['text']; ?> <br>
        <?php $i++; ?>
    <?php } ?>
<?php endforeach ?>
<div class="explain" id="explain<?= $value['id'] ?>"></div>
<?php endforeach ?>
<?php }?>
<!--- part 5--->
<?php if (isset($part5)) { ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <h2><b style="font-weight: bold;">Part <?= $part5[0]['part_number'] ?></b></h2>
        <p><b>Direction:</b> <?= $part5[0]['direction'] ?></p>
    </div>
</div>
<?php $count = 100; ?>
<?php foreach ($question5 as $value) : ?>

    <?php $count++; ?>
    <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> <?= $value['question'] ?></b>
    <p><?php $i = 1; ?>
        <?php foreach ($question_answer as $answer) : ?>
            <?php if (($answer['question_id']) == ($value['id'])) { ?>
                <input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $value['id'] ?>" onclick="markColor(this.id)" /> <?= $answer['text']; ?> <br>
                <?php $i++; ?>
            <?php } ?>
        <?php endforeach ?>
    <div class="explain" id="explain<?= $value['id'] ?>"></div>
<?php endforeach ?>
<?php } ?>
<!--- part 6--->
<?php if (isset($part6)) { ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <h2><b style="font-weight: bold;">Part <?= $part6[0]['part_number'] ?></b></h2>
        <p><b>Direction:</b> <?= $part6[0]['direction'] ?></p>
    </div>
</div>

<?php $count = 130; ?>
<?php foreach ($group6 as  $group) : ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <p><b>Direction: </b><?= $group['title'] ?></p>
            <?php
            $text = $group['paragraph'];
            // Thay thế các số 1,2,3,4 bằng số thứ tự câu hỏi
            $text = str_replace("----1---", "----[" . $count + 1. . "]---", $text);
            $text = str_replace("----2---", "----[" . $count + 2. . "]---", $text);
            $text = str_replace("----3---", "----[" . $count + 3. . "]---", $text);
            $text = str_replace("----4---", "----[" . $count + 4. . "]---", $text); ?>

            <p><?= $text ?></p>
        </div>
    </div>
    <?php foreach ($question6 as $value) : ?>

        <?php if (($value['question_group_id']) == ($group['id'])) { ?>
            <?php $count++; ?>
            <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> <?= $value['question'] ?></p>

            <p><?php $i = 1; ?>
                <?php foreach ($question_answer as $answer) : ?>
                    <?php if (($answer['question_id']) == ($value['id'])) { ?>
                        <input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $count ?>" onclick="markColor(this.id)" /> <?= $answer['text']; ?> <br>
                        <?php $i++; ?>
                    <?php } ?>
                <?php endforeach ?>
            <div class="explain" id="explain<?= $value['id'] ?>"></div>
        <?php } ?>
    <?php endforeach ?>
<?php endforeach ?>
<?php } ?>

<!--- part 7--->
<?php if (isset($part7)) { ?>
<div class="panel panel-primary">
    <div class="panel-body">
        <h2><b style="font-weight: bold;">Part <?= $part7[0]['part_number'] ?></b></h2>
        <p><b>Direction:</b> <?= $part6[0]['direction'] ?></p>
    </div>
</div>
<?php $count = 146; ?>
<?php foreach ($group7 as  $group) : ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <p><b>Direction: </b><?= $group['title'] ?></p>
            <?php
            $text = $group['paragraph'];
            // Thay thế các số 1,2,3,4 bằng số thứ tự câu hỏi
            $text = str_replace("----1---", "----[" . $count + 1. . "]---", $text);
            $text = str_replace("----2---", "----[" . $count + 2. . "]---", $text);
            $text = str_replace("----3---", "----[" . $count + 3. . "]---", $text);
            $text = str_replace("----4---", "----[" . $count + 4. . "]---", $text); ?>

            <p><?= $text ?></p>
        </div>
    </div>
    <?php foreach ($question7 as $value) : ?>

        <?php if (($value['question_group_id']) == ($group['id'])) { ?>
            <?php $count++; ?>
            <p id="<?= $count ?>"><b>Question <?= $count ?>:</b> <?= $value['question'] ?></p>
            <p><?php $i = 1; ?>
                <?php foreach ($question_answer as $answer) : ?>
                    <?php if (($answer['question_id']) == ($value['id'])) { ?>
                        <input type="radio" name="<?= $value['id'] ?>" value="<?= $i ?>" id="question.<?= $count ?>" onclick="markColor(this.id)" /> <?= $answer['text']; ?> <br>
                        <?php $i++; ?>
                    <?php } ?>
                <?php endforeach ?>
            <div class="explain" id="explain<?= $value['id'] ?>"></div>
        <?php } ?>
    <?php endforeach ?>
<?php endforeach ?>
<?php } ?>
<hr>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <form id="my-form" action="<?= url('Exam/InsertWrongAnswer') ?>" method="post">
        <input type="hidden" id="question_id" name="question_id">
        <input type="hidden" id="selected_answer" name="selected_answer">
        <button type="submit">Submit</button>
    </form>
    <!--Footer
==========================-->

    <!--/.Footer-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        <?php foreach ($question as $value) : ?>
                var answers = document.getElementsByName("<?= $value['id'] ?>");
                var b = <?= $value['right_option'] ?>;
                <?php foreach ($wrongAnswerQuestions as $wrongAnswerQuestion) : ?>
                    <?php if ($wrongAnswerQuestion['question_id'] == $value['id']) : ?>
                        a = <?= $wrongAnswerQuestion['selected_answer']?>;
                        for (var i = 0; i < answers.length; i++) {
                            if ( answers[i].value == a) {
                                answers[i].checked=true;
                                if(a==b){
                                    answers[i].parentElement.classList.add("correct-answer");
                                }else{
                                    answers[i].parentElement.classList.add("wrong-answer");
                                }
                            }
                            else{
                                answers[i].disabled = true;
                            }
                        }
                        console.log(a);
                    <?php endif; ?>
                <?php endforeach; ?>
                let explain<?= $value['id'] ?> = document.getElementById("explain<?= $value['id'] ?>");
                explain<?= $value['id'] ?>.innerHTML = '<div class="panel panel-primary"><div class="panel-body">' + '<?= $value['explain'] ?>' + '</div></div>';
         <?php endforeach ?>
    </script>
