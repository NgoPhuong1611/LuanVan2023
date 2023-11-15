function markColorReading(id) {
    //tách lấy id của câu hỏi
    var fields = id.split('.');
    var answerId = fields[1];
    document.getElementById("answer" + answerId).style.backgroundColor = "rgb(167,162,162)";
}

function correctAnswerReading() {
    var correctArr = [];
    for (var i = 51; i < 101; i++) {
        var nameRadio = "correctanswer" + i;
        var x = document.getElementById("submitForm").elements.namedItem(nameRadio).value;
        correctArr.push(x);
    }

    return correctArr;
}

function answerUserReading() {

    //var form = document.getElementById("submitForm");
    // array index start = 0
    var answerArr = [];

    for (var i = 51; i < 101; i++) {
        var nameRadio = "question" + i;
        var result = document.getElementById("submitForm").elements.namedItem(nameRadio);

        if (result == null) answerArr.push("");
        else {

            var x = document.getElementById("submitForm").elements.namedItem(nameRadio).value;
            answerArr.push(x);
        }

    }

    return answerArr;
}



var timecheckReading;

function startTimerReading(duration, display) {

    var timer = duration,
        minutes, seconds;

    timecheckReading = setInterval(function() {

        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("timeReading").textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            clearInterval(timecheckReading);
            alert("Đã hết thời gian làm bài test");
            clickSubmitReading();
        }
    }, 1000);



}

function startReadingClock() {
    //change time here
    //var fortyFiveMinutes = 0.2 * 30;
    var fortyFiveMinutes = 60 * 45;
    // display = document.querySelectorAll('#timeReading');
    // var check = document.getElementById("timeReading").value();
    //console.log("check:"+check);
    startTimerReading(fortyFiveMinutes, '45:00');
};







// ket qua test( Listening + Reading)
function clickSubmitReading() {

    alert("Đã hoàn thành bài test")

    var examId = document.getElementById('id_bai_exam').value;

    var correctListening = document.getElementById("soCauDungListening").value;

    var answerArr = answerUserReading();

    var correctArr = correctAnswerReading();

    var correctReading = 0;

    for (var i = 0; i < 50; i++) {
        if (answerArr[i] == correctArr[i] && answerArr[i] != ' ') correctReading++;

    }

    //	console.log("read="+correctReading);
    //	console.log("listen="+correctListening);
    //	console.log("id="+examId);

    var url = "http://localhost:8080/webtoeic/saveResultUser/" + examId + "/" + correctListening + "/" + correctReading;

    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    } else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4) {

            var data = xhttp.responseText;
            document.getElementById("main").innerHTML = data;
        }
    }


    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhttp.send();

    clearInterval(timecheckReading);
    document.getElementById("btnSubmitReading").style.display = 'none';
    document.getElementById("btnResultReading").style.display = 'none';
    document.getElementById("noteReading").style.display = 'none';



}


//cham diem bai test
function clickResutlReading() {
    //stop countdown
    clearInterval(timecheckReading);

    document.getElementById("btnResultReading").style.display = 'none';

    document.getElementById("noteReading").style.display = 'block';

    document.getElementById("btnSubmitReading").style.margin = "0px 0px 0px 100px";

    var answerArr = answerUserReading();

    var correctArr = correctAnswerReading();

    var countCorrect = 0;

    for (var i = 0; i < 50; i++) {
        if (answerArr[i] == correctArr[i] && answerArr[i] != ' ') countCorrect++;

    }

    var jsonAnswerUser = JSON.stringify(answerArr);


    var examId = document.getElementById('id_bai_exam').value;
    //var examId = $("#id_bai_exam").val();

    var url = "http://localhost:8080/webtoeic/showResultReading/" + examId + "/" + countCorrect;
    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    } else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhttp.open("POST", url, true);

    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4) {

            var data = xhttp.responseText;
            document.getElementById("main").innerHTML = data;
        }
    }


    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhttp.send(jsonAnswerUser);


}






//
//$(document).ready(function(){
//
//	
//	
//	$('#btndoAgain').click(function(){ 
//		location.reload();
//	});
//	
//	$('#btnResultReading').click(function(){
//		
//		//clear clock,stop countdown
//	    clearInterval(timecheck);
//		//tranfer information
//	    
//	    //remove btn XemdapAn, show btn lamlai
//	    $('#btnResultReading').hide();
//	    $('#btndoAgain').show();
//		
//		var answerArr = answerUser();
//		var jsonAnswerUser = JSON.stringify(answerArr);
//		
//		var examId = $("#id_bai_exam").val();
//		
//		var url="http://localhost:8080/webtoeic/showResultReading/"+examId;
//		if(window.XMLHttpRequest){
//			xhttp = new XMLHttpRequest();
//		}
//		else{
//			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
//		}
//		
//		xhttp.open("POST",url,true);
//		
//			xhttp.onreadystatechange = function(){
//			if(xhttp.readyState == 4){
//				
//				var data = xhttp.responseText;
//				document.getElementById("main").innerHTML = data;
//			}
//		}
//		
//		
//		xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
//
//		xhttp.send(jsonAnswerUser);
//	});
//	
//	
//});