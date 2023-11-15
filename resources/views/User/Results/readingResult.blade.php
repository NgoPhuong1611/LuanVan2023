<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<style>
    .fix-top {
        margin-top: -125px;
    }
</style>

<body>
<div class="container">
    <br><br><br><br><br><br><br>
<div id="main" class="web-font">
        <p class="fix-top">
            Đáp án bài thi Reading: <span style="color: red">Trả lời đúng
				50 / 50 </span>
        </p>


        <input class="hidden" id="id_bai_exam" value="${list.getBaithithu().getBaithithuid()}" />
        <input class="hidden" id="answerUser" name="question}" value="${list.getDapAnUser()}" />
        <input class="hidden" id="correctanswer" name="correctanswer" value="" />

        <!-- show part5 -->

        <p class="web-font">
            <b>Part 5: paragraph</b>
        </p>

        <div class="web-font">

            <p>
                <b>Question number:</b>
            </p>

            <p>
                <b>Question number:</b> <span style="color: red">
								Chưa chọn câu trả lời</span>
            </p>

            <pre class="paragraph">question</pre>


            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="C" /> C. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>





            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="A"/> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>

            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="D" /> D. <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>

            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
            <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>

            <input disabled type="radio" value="A" /> A. <br>
            <input disabled type="radio" value="B" /> B. <br>
            <input disabled type="radio" value="C" /> C. <br>
            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
            <br>

        </div>
        <br>

        <!-- show part 6 -->


        <p class="web-font">
            <b>Part 6: question</b>
        </p>

        <pre class="paragraph">paragraph</pre>



        <div class="web-font">

            <p>
                <b>Question number:</b>
            </p>

            <p>
                <b>Question number:</b> <span style="color: red">
								Chưa chọn câu trả lời</span>
            </p>

        </div>


        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>







        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>



        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <br>


        <!-- show part 7 -->


        <p class="web-font">
            <b>Part 7: Read the passage and choose the correct answer</b>
        </p>

        <pre class="paragraph">Ten</pre>



        <div class="web-font">

            <b>Question number</b> question
            </p>

            <span style="color: red"> Chưa chọn câu trả lời</span>
            <p>
                <b>Question number</b>listquestion
            </p>

        </div>


        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>



        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>

        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
        <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <input disabled type="radio" value="A" /> A. <br>
        <input disabled type="radio" value="B" /> B. <br>
        <input disabled type="radio" value="C" /> C. <br>
        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
        <br>

        <br>



        <hr>
        <p>Kết thúc bài Reading</p>

    </div>

</div>


</body>
</html>
<?= $this->endSection() ?>
