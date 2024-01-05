<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bài test Toeic</title>
    <script src="{{ asset('resources/js/jquery-1.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="{{ asset('resources/js/client/baiTestListening.js') }}"></script>
    <script src="{{ asset('resources/js/client/baiTestReading.js') }}"></script>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <link href="D:\LuanVan2023\resources\css\app.css" rel="stylesheet" type="text/css">
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

    .explain {
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

    <!--Header
==========================-->
    <div class="testReading" id="testReading">
        <div class="navbar navbar-default navbar-fixed-top">
            <br>
            <div style="display: block;">
                <p>
                    <a href="{{ url('/') }}" id="backhome" style="display: inline;">
                        Home</a> <span>Bài test speaking</span>
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
            {{-- <form action="record-speaking" method="post" id="submitForm" name="submitForm"> --}}
            <form action="{{ url('Practice/record') }}" method="POST" id="submitForm" name="submitForm">
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
                            <input type="submit" class="btn btn-primary" id="submitBtn" value="nộp bài"
                                onclick="result()" /><br><br>
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
                            <!--- nếu là part number 8--->
                            <?php if ($part[0]['part_number'] == 8) { ?>
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <input type="hidden" name="examPart" value=8>
                                    <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                    <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                                </div>
                            </div>

                            {{-- load hình ảnh của câu hỏi --}}
                            <div class="question_image">
                                <?php foreach ($question_image as $image) : ?>
                                <?php if ($image['question_id'] == $value['id']) { ?>
                                <img width="500px" height="300px"
                                    src="{{ asset('uploads/images/' . $image['image_name']) }}" alt="Mô tả ảnh">
                                <?php } ?>
                                <?php endforeach ?>
                            </div>
                            {{-- form nhập text trả lời --}}
                            <?php foreach ($question as $value) : ?>
                            <input type="hidden" name="question_id" value="<?= $value['id'] ?>">
                            <p><b>Question:</b> <?= $value['question'] ?></p>
                            <section class="main-controls">
                                <canvas class="visualizer" height="60px"
                                    style="width: 50%; border-radius: 10px"></canvas>
                                <div id="buttons">
                                    <button class="record">Record</button>
                                    <button class="stop" disabled="">Stop</button>
                                </div>
                            </section>

                            <section class="sound-clips">


                            </section>

                            <?php endforeach ?>



                            {{-- nếu là part 9 --}}
                            <?php } elseif ($part[0]['part_number'] == 9) { ?>
                            <div class="panel-body">
                                <input type="hidden" name="examPart" value=9>
                                <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                            </div>
                        </div>
                        {{-- form nhập text trả lời --}}
                        <?php foreach ($question as $value) : ?>
                        <input type="hidden" name="question_id" value="<?= $value['id'] ?>">
                        <p><b>Question:</b> <?= $value['question'] ?></p>
                        {{-- <button onclick="startRecording({{ $question->id }})">Bắt đầu ghi âm</button> --}}
                        {{-- <button onclick="startRecording()">Bắt đầu ghi âm</button>
                            <button onclick="stopRecording()">Kết thúc ghi âm</button> --}}
                        <section class="main-controls">
                            <canvas class="visualizer" height="60px" style="width: 50%; border-radius: 10px"></canvas>
                            <div id="buttons">
                                <button class="record">Record</button>
                                <button class="stop" disabled="">Stop</button>
                            </div>

                        </section>

                        <section class="sound-clips">


                        </section>

                        <?php endforeach ?>


                        {{-- load trường hợp part 10 --}}
                        <?php } elseif ($part[0]['part_number'] == 10) { ?>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <input type="hidden" name="examPart" value=10>
                                <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                            </div>
                        </div>
                        {{-- form nhập text trả lời --}}
                        <?php foreach ($question as $value) : ?>
                        <input type="hidden" name="question_id" value="<?= $value['id'] ?>">
                        <p><b>Question:</b> <?= $value['question'] ?></p>
                        {{-- <button onclick="startRecording({{ $question->id }})">Bắt đầu ghi âm</button> --}}
                        {{-- <button onclick="startRecording()">Bắt đầu ghi âm</button>
                                <button onclick="stopRecording()">Kết thúc ghi âm</button> --}}
                        <section class="main-controls">
                            <canvas class="visualizer" height="60px" style="width: 50%; border-radius: 10px"></canvas>
                            <div id="buttons">
                                <button class="record">Record</button>
                                <button class="stop" disabled="">Stop</button>
                            </div>
                        </section>

                        <section class="sound-clips">


                        </section>

                        <?php endforeach ?>

                        {{-- load trường hợp part 11 --}}
                        <?php } elseif ($part[0]['part_number'] == 11) { ?>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <input type="hidden" name="examPart" value=11>
                                <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                            </div>
                        </div>
                        {{-- form nhập text trả lời --}}
                        <?php foreach ($question as $value) : ?>
                        <input type="hidden" name="question_id" value="<?= $value['id'] ?>">
                        <p><b>Question:</b> <?= $value['question'] ?></p>
                        {{-- <button onclick="startRecording({{ $question->id }})">Bắt đầu ghi âm</button> --}}
                        {{-- <button onclick="startRecording()">Bắt đầu ghi âm</button>
                                    <button onclick="stopRecording()">Kết thúc ghi âm</button> --}}
                        <section class="main-controls">
                            <canvas class="visualizer" height="60px"
                                style="width: 50%; border-radius: 10px"></canvas>
                            <div id="buttons">
                                <button class="record">Record</button>
                                <button class="stop" disabled="">Stop</button>
                            </div>
                        </section>

                        <section class="sound-clips">


                        </section>

                        <?php endforeach ?>

                        {{-- load trường hợp part 12 --}}
                        <?php } elseif ($part[0]['part_number'] == 12) { ?>
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <input type="hidden" name="examPart" value=12>
                                <h2><b style="font-weight: bold;">Part <?= $part[0]['part_number'] ?></b></h2>
                                <p><b>Direction:</b> <?= $part[0]['direction'] ?></p>
                            </div>
                        </div>
                        {{-- form nhập text trả lời --}}
                        <?php foreach ($question as $value) : ?>
                        <input type="hidden" name="question_id" value="<?= $value['id'] ?>">
                        <p><b>Question:</b> <?= $value['question'] ?></p>
                        {{-- <button onclick="startRecording({{ $question->id }})">Bắt đầu ghi âm</button> --}}
                        {{-- <button onclick="startRecording()">Bắt đầu ghi âm</button>
                                        <button onclick="stopRecording()">Kết thúc ghi âm</button> --}}
                        <section class="main-controls">
                            <canvas class="visualizer" height="60px"
                                style="width: 50%; border-radius: 10px"></canvas>
                            <div id="buttons">
                                <button class="record">Record</button>
                                <button class="stop" disabled="">Stop</button>
                            </div>
                        </section>

                        <section class="sound-clips">

                        </section>

                        <?php endforeach ?>

                        <?php } ?>

                        <hr>
                    </div>
                </div>
        </div>
        </form>
    </div>

    </div>
    {{-- @if (auth()->check()) --}}
    {{-- <script src="node_modules\lamejs\lame.min.js"></script> --}}
    {{-- // test chức năng ghi âm speaking --}}
    <script>
        // test chức năng ghi âm speaking


        const record = document.querySelector('.record');
        const stop = document.querySelector('.stop');
        const soundClips = document.querySelector('.sound-clips');
        const canvas = document.querySelector('.visualizer');
        const mainSection = document.querySelector('.main-controls');

        stop.disabled = true;

        let audioCtx;
        const canvasCtx = canvas.getContext("2d");
        let chunks = [];

        if (navigator.mediaDevices.getUserMedia) {
            const constraints = {
                audio: true
            };

            let onSuccess = function(stream) {
                const mediaRecorder = new MediaRecorder(stream);

                visualize(stream);

                record.onclick = function() {
                    mediaRecorder.start();
                    console.log(mediaRecorder.state);
                    console.log("recorder started");
                    record.style.background = "red";

                    stop.disabled = false;
                    record.disabled = true;
                }

                stop.onclick = function() {
                    mediaRecorder.stop();
                    console.log(mediaRecorder.state);
                    console.log("recorder stopped");
                    record.style.background = "";
                    record.style.color = "";
                    stop.disabled = true;
                    record.disabled = false;
                }

                mediaRecorder.ondataavailable = function(e) {
                    chunks.push(e.data);
                    console.log(chunks.length);
                }

                mediaRecorder.onstop = function(e) {
                    const clipName = prompt('Enter a name for your sound clip?', 'My unnamed clip');

                    const clipContainer = document.createElement('article');
                    const clipLabel = document.createElement('p');
                    const audio = document.createElement('audio');
                    const deleteButton = document.createElement('button');
                    const audioInput = document.createElement('input');

                    clipContainer.classList.add('clip');
                    audio.setAttribute('controls', '');
                    deleteButton.textContent = 'Delete';
                    deleteButton.className = 'delete';

                    if (clipName === null) {
                        clipLabel.textContent = 'My unnamed clip';
                    } else {
                        clipLabel.textContent = clipName;
                    }

                    clipContainer.appendChild(audio);
                    clipContainer.appendChild(clipLabel);
                    clipContainer.appendChild(deleteButton);
                    soundClips.appendChild(clipContainer);

                    audio.controls = true;

                    const blob = new Blob(chunks, {
                        'type': 'audio/mp3'
                    });
                    chunks = [];
                    const audioURL = window.URL.createObjectURL(blob);
                    audio.src = audioURL;

                    audioInput.type = 'hidden';
                    audioInput.name = 'audio';
                    audioInput.value = audioURL;

                    deleteButton.onclick = function(e) {
                        e.target.closest(".clip").remove();
                    }
                }

            }
            let onError = function(err) {
                console.log('The following error occured: ' + err);
            }

            navigator.mediaDevices.getUserMedia(constraints).then(onSuccess, onError);

        } else {
            console.log('getUserMedia not supported on your browser!');
        }


        function visualize(stream) {
            // Visualizer code...
            if (!audioCtx) {
                audioCtx = new AudioContext();
            }

            const source = audioCtx.createMediaStreamSource(stream);

            const analyser = audioCtx.createAnalyser();
            analyser.fftSize = 2048;
            const bufferLength = analyser.frequencyBinCount;
            const dataArray = new Uint8Array(bufferLength);

            source.connect(analyser);
            //analyser.connect(audioCtx.destination);

            draw()

            function draw() {
                const WIDTH = canvas.width
                const HEIGHT = canvas.height;

                requestAnimationFrame(draw);

                analyser.getByteTimeDomainData(dataArray);

                canvasCtx.fillStyle = 'rgb(200, 200, 200)';
                canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);

                canvasCtx.lineWidth = 2;
                canvasCtx.strokeStyle = 'rgb(0, 0, 0)';

                canvasCtx.beginPath();

                let sliceWidth = WIDTH * 1.0 / bufferLength;
                let x = 0;


                for (let i = 0; i < bufferLength; i++) {

                    let v = dataArray[i] / 128.0;
                    let y = v * HEIGHT / 2;

                    if (i === 0) {
                        canvasCtx.moveTo(x, y);
                    } else {
                        canvasCtx.lineTo(x, y);
                    }

                    x += sliceWidth;
                }

                canvasCtx.lineTo(canvas.width, canvas.height / 2);
                canvasCtx.stroke();

            }
        }

        window.onresize = function() {
            canvas.width = mainSection.offsetWidth;
        }

        window.onresize();
        // set up basic variables for app


        //
    </script>
    {{-- @endif --}}
    <!--Footer
==========================-->

    <!--/.Footer-->

</body>

</html>
