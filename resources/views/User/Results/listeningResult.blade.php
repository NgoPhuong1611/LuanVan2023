<?php include "../Include/header.php" ?>
<style>
    .fix-top {
        margin-top: -125px;
    }
</style>

<body>


    <div id="main" class="web-font">
        <p class="fix-top">
            Đáp án bài thi Listening : <span id="socaudung" style="color: red">Trả
				lời đúng 50 / 50 </span>
        </p>

        <c:forEach items="${listQuestion}" var="list">
            <input class="hidden" id="id_bai_exam" value="" />
            <input class="hidden" id="correctanswer" name="correctanswer${list.number}" value="" />
            <input class="hidden" id="answerUser" name="question${list.number}" value="" />

            <!-- 	<p>Đáp án user: </p><br> -->
            <!-- show part1 -->
            <c:if test="${list.number == 1 }">
                <p>
                    <b>Part 1: </b>
                </p>
            </c:if>
            <c:if test="${not empty list.image}">
                <div class="container">
                    <c:if test="${list.getDapAnUser() != ''}">
                        <p>
                            <b>Question </b>
                        </p>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == ''}">
                        <p>
                            <b>Question </b> <span style="color: red">
								Chưa chọn câu trả lời</span>
                        </p>
                    </c:if>


                    <img src="../resources/file/images/exam/1.num2.jpg" alt="image not found" style="height: 300px; width: 400px; float: left; margin-right: 10px" />
                    <audio controls> <source
						src="#"
						type="audio/wav"></audio>
                    <br>
                    <c:if test="${list.getDapAnUser() == ''}">
                        <c:if test="${list.correctanswer== 'A' }">
                            <input disabled type="radio" value="A" /> A. ;<img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.correctanswer== 'B' }">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B.<img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.correctanswer== 'C' }">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.correctanswer== 'D' }">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                        </c:if>


                    </c:if>


                    <c:if test="${list.correctanswer== 'A' }">
                        <c:if test="${list.getDapAnUser() == 'A'}">
                            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'B'}">
                            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'C'}">
                            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'D'}">
                            <input disabled type="radio" value="A" /> A.<img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                        </c:if>

                    </c:if>

                    <c:if test="${list.correctanswer== 'B' }">
                        <c:if test="${list.getDapAnUser() == 'A'}">
                            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'B'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'C'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'D'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                        </c:if>
                    </c:if>

                    <c:if test="${list.correctanswer== 'C' }">
                        <c:if test="${list.getDapAnUser() == 'A'}">
                            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'B'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'C'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'D'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                        </c:if>

                    </c:if>

                    <c:if test="${list.correctanswer== 'D' }">
                        <c:if test="${list.getDapAnUser() == 'A'}">
                            <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'B'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'C'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                            <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                        </c:if>
                        <c:if test="${list.getDapAnUser() == 'D'}">
                            <input disabled type="radio" value="A" /> A. <br>
                            <input disabled type="radio" value="B" /> B. <br>
                            <input disabled type="radio" value="C" /> C. <br>
                            <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                            <br>
                        </c:if>

                    </c:if>



                </div>
                <br>
            </c:if>
            <!-- show part 2 -->

            <c:if test="${list.number == 4 }">
                <p>
                    <b>Part 2: ${list.paragraph}</b>
                </p>
            </c:if>

            <c:if test="${list.number >=4  && list.number <15}">

                <c:if test="${list.getDapAnUser() != ''}">
                    <p>
                        <b>Question </b>
                    </p>
                </c:if>
                <c:if test="${list.getDapAnUser() == ''}">
                    <span style="color: red"> Chưa chọn câu trả lời</span>
                    <p>
                        <b>Question </b>
                    </p>

                </c:if>
                <audio controls> <source
					src="#"
					type="audio/wav"></audio>
                <br>
                <c:if test="${list.getDapAnUser() == ''}">
                    <c:if test="${list.correctanswer== 'A' }">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'B' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'C' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>

                </c:if>


                <c:if test="${list.correctanswer== 'A' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>
                </c:if>

                <c:if test="${list.correctanswer== 'B' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>
                </c:if>

                <c:if test="${list.correctanswer== 'C' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>

                </c:if>
                <br>
            </c:if>

            <!-- show part 3 -->

            <c:if test="${list.number == 15 }">
                <br>
                <p>
                    <b>Part 3: </b>
                </p>
            </c:if>
            <c:if test="${list.number >= 15 && list.number <=35}">

                <c:if test="${list.getDapAnUser() != ''}">
                    <p>
                        <b>Question </b>
                    </p>
                </c:if>
                <c:if test="${list.getDapAnUser() == ''}">
                    <span style="color: red"> Chưa chọn câu trả lời</span>
                    <p>
                        <b>Question </b>
                    </p>
                </c:if>
                <audio controls> <source
					src="../resources/file/audio/exam/${list.audiomp3}.mp3"
					type="audio/wav"></audio>
                <br>
                <c:if test="${list.getDapAnUser() == ''}">
                    <c:if test="${list.correctanswer== 'A' }">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'B' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'C' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'D' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>


                </c:if>


                <c:if test="${list.correctanswer== 'A' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>

                </c:if>

                <c:if test="${list.correctanswer== 'B' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>
                </c:if>

                <c:if test="${list.correctanswer== 'C' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>

                </c:if>

                <c:if test="${list.correctanswer== 'D' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>

                </c:if>
                <br>
            </c:if>

            <!-- show part 4 -->
            <c:if test="${list.number == 36 }">
                <br>
                <p>
                    <b>Part 4:</b>
                </p>
            </c:if>
            <c:if test="${list.number >= 36 && list.number <51 }">
                <c:if test="${list.getDapAnUser() != ''}">
                    <p>
                        <b>Question</b>
                    </p>
                </c:if>
                <c:if test="${list.getDapAnUser() == ''}">
                    <span style="color: red"> Chưa chọn câu trả lời</span>
                    <p>
                        <b>Question </b>
                    </p>

                </c:if>
                <audio controls> <source
					src="../resources/file/audio/exam/${list.audiomp3}.mp3"
					type="audio/wav"></audio>

                <br>
                <c:if test="${list.getDapAnUser() == ''}">
                    <c:if test="${list.correctanswer== 'A' }">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'B' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'C' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.correctanswer== 'D' }">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>


                </c:if>


                <c:if test="${list.correctanswer== 'A' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>

                </c:if>

                <c:if test="${list.correctanswer== 'B' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>
                </c:if>

                <c:if test="${list.correctanswer== 'C' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                    </c:if>

                </c:if>

                <c:if test="${list.correctanswer== 'D' }">
                    <c:if test="${list.getDapAnUser() == 'A'}">
                        <input disabled type="radio" value="A" /> A. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'B'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'C'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <img alt="img not found" src="../resources/file/images/incorrect.png">
                        <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>
                    <c:if test="${list.getDapAnUser() == 'D'}">
                        <input disabled type="radio" value="A" /> A. <br>
                        <input disabled type="radio" value="B" /> B. <br>
                        <input disabled type="radio" value="C" /> C. <br>
                        <input disabled type="radio" value="D" /> D. <img alt="img not found" src="../resources/file/images/correct.png">
                        <br>
                    </c:if>

                </c:if>
                <br>
            </c:if>


        </c:forEach>



        <hr>
        <p>Kết thúc bài Listening</p>

    </div>

</body>

</html>