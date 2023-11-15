$(document).ready(function(){
	
	var soCauDung = [];
	var soCau = 0;
	ajaxGetForCauHoi(1);		
	function ajaxGetForCauHoi(page){
		var baiNgheId = $("#baiTapNgheId").val();
		$.ajax({
			type: "GET",		
			url: "/webtoeic/api/client/bai-nghe/baiNgheId="+ baiNgheId + "?page=" + page,
			success: function(result){
				soCau = result.totalElements;
				$.each(result.content, function(i, cauHoi){
					var divCauHoi = '<div class="postmetadata" style="padding-left: 30%;text-align: left;" >'
						+ '<ul><li style="font-weight: bold"><i class="icon-user"></i>Câu '+ cauHoi.soThuTu + ': ' + cauHoi.cauHoi +'</li></ul></div>'
                        +'<div class="form-group">'
                        +'  <div class="span8" style="float: none;display: inline-block;text-align: left;margin: 0 auto; width: 50%;padding-left: 20%">'
                        +'     <label class="radio-inline radioLabel">'
                        +'       <input type="radio" name="'+ cauHoi.soThuTu +'" id="dapAn_1" value="A">'+cauHoi.dapAn_1 +'</label><br>'
                        +'     <label class="radio-inline radioLabel">'
                        +'        <input type="radio" name="'+ cauHoi.soThuTu +'" id="dapAn_2" value="B">'+cauHoi.dapAn_2 +'</label><br>'
                        +'      <label class="radio-inline radioLabel">'
                        +'       <input type="radio" name="'+ cauHoi.soThuTu +'" id="dapAn_3" value="C">'+cauHoi.dapAn_3 +'</label><br>'
                        +'     <label class="radio-inline radioLabel">'
                        +'        <input type="radio" name="'+ cauHoi.soThuTu +'" id="dapAn_4" value="D">'+cauHoi.dapAn_4+'</label><br>'
                        +'        <input type="radio" name="'+ cauHoi.soThuTu +'" id="dapAnDung" value="'+cauHoi.dapAnDung+'" class="hidden">'
                        +'   </div>'
                        +'</div>'

                    +'<hr align="center">';
						
					$('#cauHoi').append(divCauHoi);
				});	
				
				if(result.totalPages > 1 ){
					for(var numberPage = 1; numberPage <= result.totalPages; numberPage++) {
						var li = '<li class="page-item "><a class="pageNumber-cauHoi">'+numberPage+'</a></li>';
					    $('.ul-pagination').append(li);
					};				
					
					// active page pagination
			    	$(".pageNumber-cauHoi").each(function(index){	
			    		if($(this).text() == page){
			    			$(this).parent().removeClass().addClass("page-item active");
			    		}
			    	});
				};
			},
			error : function(e){
				alert("Error: ",e);
				console.log("Error" , e );
			}
		});
	};

    
    // event khi click vào phân trang bài nghe
	$(document).on('click', '.pageNumber-cauHoi', function (event){
		event.preventDefault();
		var page = $(this).text();	
    	$('#cauHoi').empty();
    	$('.ul-pagination li').remove();
    	ajaxGetForCauHoi(page);	
	});
	
    // event khi click vào phân trang giải thích bài nghe
	$(document).on('click', '.pageNumber-giaiThich', function (event){
		event.preventDefault();
		var page = $(this).text();	
    	$('#cauHoi').empty();
    	$('.ul-pagination li').remove();
    	ajaxGetForGiaiThich(page);	
	});
	
//    // event khi click vào button Nop bài
//	$(document).on('click', '#btnNopBai', function (event){
//		alert("Số câu trả lời đúng của bạn là: " + nameCheck.length);
//	});
	
	var checkExam = function(nameRadio, dapAnChon){
        var dapAnDung = $('input:radio[name='+nameRadio+'][id="dapAnDung"]').val();
        if (dapAnDung === dapAnChon) {
        	if( soCauDung.indexOf(nameRadio) == -1  ){
        		soCauDung.push(nameRadio);
             }         
        } else {
        	soCauDung = $.grep(soCauDung, function(value) {
                return value != nameRadio;
            });
        }
	}
	
	$(document).on('click', '.radioLabel', function (event){
		var nameRadio = $(this).find('input:radio').attr("name");
		var dapAnChon = $(this).find('input:radio').val();
		console.log(nameRadio);
        checkExam(nameRadio, dapAnChon);
	});
	
	// click event button Thêm mới bài nghe
	$('#btnNopBai').on("click", function(event) {
		event.preventDefault();
		var confirmation = confirm("Bạn chắc chắn nộp bài ?");
		if(confirmation){
	      $("#ketQuaText").html("Số câu đúng của bạn là: "+ soCauDung.length+'/'+soCau);
		  $('#nopBaiModal').modal();
		}
	});
	
	$('#btnLamLai').on("click", function(event) {
		location.reload();
	});

	$('#btnXemGiaiThich').on("click", function(event) {
		event.preventDefault();
		$('#btnNopBai').addClass("hidden");
		$('#btnBaiThiKhac').removeClass("hidden");
		$('#script-detail').removeClass("hidden");
		$('#cauHoi').empty();
		$('.ul-pagination li').remove();
		ajaxGetForGiaiThich(1);
		$('#nopBaiModal').modal('hide');
	});
	
	function ajaxGetForGiaiThich(page){
		var baiNgheId = $("#baiTapNgheId").val();
		$.ajax({
			type: "GET",		
			url: "/webtoeic/api/client/bai-nghe/baiNgheId="+ baiNgheId + "?page=" + page,
			success: function(result){
//				soCau = result.totalElements;
				$.each(result.content, function(i, cauHoi){
					var stt = cauHoi.soThuTu;
					var divGiaiThich = '';
					if(cauHoi.script != null && cauHoi.script != ''){
						divGiaiThich = '<div id="script-detail"><div class="form-group">'
						            +  '  <label style="font-weight: bold" >Script từ câu '+ cauHoi.soThuTu + ' đến câu '+ (parseInt(cauHoi.soThuTu )+ 2)+ '</label>'
						            +    '<textarea style="width: 65%; height: 200px; margin-left: 30px; border: 0px; cursor: default; background-color: white;" disabled> '
						            +   cauHoi.script + '</textarea></div><hr align="center"></div>';
					}
						
					divGiaiThich += '<div class="postmetadata"><ul><li style="font-weight: bold"><i class="icon-user"></i>Câu '+ stt ;
					if(soCauDung.indexOf(stt) > -1){
                    	console.log(soCauDung.indexOf(stt) > -1)
                    	divGiaiThich += " - <span>ĐÚNG</span><br>";
                    } else {
                    	divGiaiThich += " - <span>SAI</span><br>";
                    }
	                        
					divGiaiThich += '</li></ul></div>'
                        +'<div class="form-group">'
                        + '   <textarea style="width: 500px; height: 150px; margin-left: 50px; border: 0px; cursor: default; background-color: white;" disabled> ' 
                        +   cauHoi.giaiThich + '</textarea>'
                        +'</div>'
                        +'<hr align="center">';
						
					$('#cauHoi').append(divGiaiThich);
				});	
				
				if(result.totalPages > 1 ){
					for(var numberPage = 1; numberPage <= result.totalPages; numberPage++) {
						var li = '<li class="page-item "><a class="pageNumber-giaiThich">'+numberPage+'</a></li>';
					    $('.ul-pagination').append(li);
					};				
					
					// active page pagination
			    	$(".pageNumber-giaiThich").each(function(index){	
			    		if($(this).text() == page){
			    			$(this).parent().removeClass().addClass("page-item active");
			    		}
			    	});
				};
			},
			error : function(e){
				alert("Error: ",e);
				console.log("Error" , e );
			}
		});
	};
});