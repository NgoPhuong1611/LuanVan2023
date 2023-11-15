$(document).ready(function() {
	
	
	//add new baithithu

	$('#btnAddNewExam').click(function() {
		// formData: nameBaiThiThu,file_Excel, file_Image, file_imageQuestion, file_Listening
		var formData = new FormData();
		
		var file_excel = $('#file_Excel')[0].files[0];
		var file_image = $('#file_Image')[0].files[0];
		var name = $('#nameBaiThiThu').val();
		
		//var file_image_question = $('#file_image_question')
		var countFileImage = document.getElementById('file_image_question').files.length;
		var countFileMp3 = document.getElementById('file_listening').files.length;

		
		for (var x = 0; x < countFileImage; x++) {
			formData.append("file_image_question", document.getElementById('file_image_question').files[x]);
		}
		
		for (var x = 0; x < countFileMp3; x++) {
			formData.append("file_listening", document.getElementById('file_listening').files[x]);
		}

		formData.append("file_excel",file_excel);
		formData.append("file_image",file_image);
		formData.append("name",name);
		
		$.ajax({
				data: formData,
		        
				type:'POST',
				url:"http://localhost:8080/webtoeic/api/admin/exam/save",
				enctype : 'multipart/form-data',
			    contentType : false,
			    cache : false,
			    processData : false,
			    success: function(data){
			   $('#examModal').modal('hide');
			    loadAllBaiThiThu();
				
				$('#info-success').text("Thêm mới bài thi thử thành công");
				
								},
		
			 error : function(e) {
			 alert("error");
			 $('#examModal').modal('hide');
			 console.log("ERROR: ", e);
		  }
		
				});
		
		
	});
	
	$('#btnUpdateExam').click(function() {
		var examId = $('#idExam').val();
		
		// formData: nameBaiThiThu,file_Excel, file_Image, file_imageQuestion, file_Listening
		var formData = new FormData();
		
		var file_excel = $('#file_Excel')[0].files[0];
		var file_image = $('#file_Image')[0].files[0];
		var name = $('#nameBaiThiThu').val();
		
		//var file_image_question = $('#file_image_question')
		var countFileImage = document.getElementById('file_image_question').files.length;
		var countFileMp3 = document.getElementById('file_listening').files.length;

		
		for (var x = 0; x < countFileImage; x++) {
			formData.append("file_image_question", document.getElementById('file_image_question').files[x]);
		}
		
		for (var x = 0; x < countFileMp3; x++) {
			formData.append("file_listening", document.getElementById('file_listening').files[x]);
		}

		formData.append("file_excel",file_excel);
		formData.append("file_image",file_image);
		formData.append("name",name);
		formData.append("idExam",examId);
		
		
		
		$.ajax({
		data: formData,
		type:'POST',
		url:"http://localhost:8080/webtoeic/api/admin/exam/update",
		enctype : 'multipart/form-data',
	    contentType : false,
	    cache : false,
	    processData : false,
	    
		success: function(data){
            $('#examModal').modal('hide');
            $('#info-success').text("Cập nhật bài thi thử thành công");
            loadAllBaiThiThu();
			
							},
	
		 error : function(e) {
		 alert("error");
		 console.log("ERROR: ", e);
	  }
	
			});
		
		
	});
	
	
	//edit baithithu
	
	var editId,idBaiThiThu,fields;
	$(document).on('click','.editBaiThiThu',function(e){
		 e.stopPropagation(); 
		 e.stopImmediatePropagation();
		 editId = $(this).attr('id');
		 fields = editId.split('.');
		 idBaiThiThu = fields[1];
			
		  $('#btnUpdateExam').show();
		  $('#btnAddNewExam').hide();
          $('#examModal').modal('show');
          
          var modal = $('#examModal');
          modal.find('.modal-header #titleModal').text("Cập nhật bài thi thử");	
		
          $('#examModal #idExam').val(idBaiThiThu);
         
          $.ajax({
  			type:'GET',
  			url:"http://localhost:8080/webtoeic/api/admin/exam/infoExam/"+idBaiThiThu,
  			success: function(data){
  				 $('#examModal #nameBaiThiThu').val(data);  			
  								},
  		
  			 error : function(e) {
  			 alert("error");
  			 console.log("ERROR: ", e);
  		  }
  		
  				});
  		
          
          

	
	});
		
	
	// delete baithithu
	$(document).on('click','.deleteBaiThiThu',function(){
		var deleteId = $(this).attr('id');
		var fields = deleteId.split('.');
		var idBaiThiThu = fields[1];
		
		if(confirm("Bạn muốn xóa bài thi thử này?"))
			{
				
				
				$.ajax({
					type:'POST',
					url:"http://localhost:8080/webtoeic/api/admin/exam/delete/"+idBaiThiThu,
					
					success: function(data){
						loadAllBaiThiThu();
						$('#info-success').text("Xóa bài thi thử thành công");
						
										},
				
					 error : function(e) {
					 alert("error");
					 console.log("ERROR: ", e);
				  }
				
						});
			}
			
		
		});
	
	
	function loadAllBaiThiThu(){

		$.ajax({
			dataType : 'json',
			type:'GET',
			url:"http://localhost:8080/webtoeic/api/admin/exam/loadExam",
			
			success: function(data){
				
				//convert array to json type
				var jsonArray = new Array();
				var fields,id,anhbaithithu,tenbaithithu;
				for(var i = 0; i <data.length; i++ ){
					var jsonObject = new Object();
						fields = data[i].split(',');
						
						id = fields[0].split(':');
						jsonObject.baithithuid = id[1];
						
						anhbaithithu = fields[1].split(':');
						jsonObject.anhbaithithu = anhbaithithu[1];
						
						tenbaithithu = fields[2].split(':');
						jsonObject.tenbaithithu = tenbaithithu[1];
						
					
					jsonArray.push(jsonObject);
				}
				 
				var jsonArr = JSON.parse(JSON.stringify(jsonArray));
				
				var trHTML ="";
				for(var i = 0; i <jsonArr.length ;i++) {
		        	
		            trHTML += '<tr><td class= "center">' + jsonArr[i].baithithuid + '</td>'
		            +'<td class= "center">' + jsonArr[i].tenbaithithu+ '</td>'
		            
		            +'<td class= "center">' + jsonArr[i].anhbaithithu + '</td>'
		     
		            +'<td class = "center"> <a id="edit.'+ jsonArr[i].baithithuid+' "'
		            
		            +'class="yellow editBaiThiThu"><button class="btn btn-warning">Cập nhật</button></a> '
		     
		            +' <a id="delete.'+jsonArr[i].baithithuid+' "'
		            
		            +'class="red deleteBaiThiThu" ><button class="delete btn btn-danger">Xóa</button></a> </td>'

		            +'</tr>';
		       }
		        
		        //$('#tableExam').append(trHTML);
				$('tbody').html(trHTML);
							
				}, error : function(e) {
					 alert("error");
					 console.log("ERROR: ", e);
				  }
			});
		
	}
	

	
	//default. load all object baithithu
	window.onload = function () {
		loadAllBaiThiThu();
		
	};

	
	
	
	
});
