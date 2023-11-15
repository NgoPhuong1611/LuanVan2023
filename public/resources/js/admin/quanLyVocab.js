$(document).ready(function() {
	
	
	//add new baithithu

	$('#addNewVocab').click(function() {
		// formData: nameBaiThiThu,file_Excel, file_Image, file_imageQuestion, file_Listening
		var formData = new FormData();
		
		var file_excel = $('#file_Excel')[0].files[0];
		var file_image = $('#file_imageVocab')[0].files[0];
		var name = $('#vocab_name').val();
		
		//var file_image_question = $('#file_image_question')
		var countFileImage = document.getElementById('file_imageQuestion').files.length;
		var countFileMp3 = document.getElementById('file_listen').files.length;

//////////////////////////////////////		
		for (var x = 0; x < countFileImage; x++) {
			formData.append("file_image_question", document.getElementById('file_imageQuestion').files[x]);
		}
		
		for (var x = 0; x < countFileMp3; x++) {
			formData.append("file_listening", document.getElementById('file_listen').files[x]);
		}

		formData.append("file_excel",file_excel);
		formData.append("file_image",file_image);
		formData.append("name",name);
		
		$.ajax({
				data: formData,
		        
				type:'POST',
				url:"http://localhost:8080/webtoeic/api/admin/vocab/save",
				enctype : 'multipart/form-data',
			    contentType : false,
			    cache : false,
			    processData : false,
			    success: function(data){
			   $('#vocabModal').modal('hide');
			   loadAllVocab();
				
				$('#info-success').text("Thêm mới bài từ vựng thành công");
				
								},
		
			 error : function(e) {
			 alert("error");
			 $('#vocabModal').modal('hide');
			 console.log("ERROR: ", e);
		  }
		
				});
		
		
	});
	
	$('#updateVocab').click(function() {
		var formData = new FormData();
		var vocabId = $('#idVocab').val();
		
		var file_excel = $('#file_Excel')[0].files[0];
		var file_image = $('#file_imageVocab')[0].files[0];
		var name = $('#vocab_name').val();
		var countFileImage = document.getElementById('file_imageQuestion').files.length;
		var countFileMp3 = document.getElementById('file_listen').files.length;


		for (var x = 0; x < countFileImage; x++) {
			formData.append("file_image_question", document.getElementById('file_imageQuestion').files[x]);
		}
		
		for (var x = 0; x < countFileMp3; x++) {
			formData.append("file_listening", document.getElementById('file_listen').files[x]);
		}

		formData.append("file_excel",file_excel);
		formData.append("file_image",file_image);
		formData.append("name",name);
		formData.append("vocabId",vocabId);
		
		
		
		$.ajax({
		data: formData,
		type:'POST',
		url:"http://localhost:8080/webtoeic/api/admin/vocab/update",
		enctype : 'multipart/form-data',
	    contentType : false,
	    cache : false,
	    processData : false,
	    
		success: function(data){
            $('#vocabModal').modal('hide');
            $('#info-success').text("Cập nhật bài từ vựng thành công");
            loadAllVocab();
			
							},
	
		 error : function(e) {
			 $('#vocabModal').modal('hide');
			 alert("error");
			 console.log("ERROR: ", e);
	  }
	
			});
		
		
	});
	
	
	//edit baithithu
	
	var editId,idBaiThiThu,fields;
	$(document).on('click','.editBaiVocab',function(e){
		 e.stopPropagation(); 
		 e.stopImmediatePropagation();
		 editId = $(this).attr('id');
		 fields = editId.split('.');
		 idBaiVocab = fields[1];
			
		  $('#updateVocab').show();
		  $('#addNewVocab').hide();
          $('#vocabModal').modal('show');
          
          var modal = $('#vocabModal');
          modal.find('.modal-header #titleModal').text("Cập nhật bài từ vựng");	
		
          $('#vocabModal #idVocab').val(idBaiVocab);
         
          $.ajax({
  			type:'GET',
  			url:"http://localhost:8080/webtoeic/api/admin/vocab/infoVocab/"+idBaiVocab,
  			success: function(data){
  				 $('#vocabModal #vocab_name').val(data);  			
  								},
  		
  			 error : function(e) {
  			 alert("error");
  			 console.log("ERROR: ", e);
  		  }
  		
  				});
  		
          
          

	
	});
		
	
	// delete baithithu
	$(document).on('click','.deleteBaiVocab',function(){
		var deleteId = $(this).attr('id');
		var fields = deleteId.split('.');
		var idBaiVocab = fields[1];
		
		if(confirm("Bạn muốn xóa bài từ vựng này?"))
			{
				$.ajax({
					type:'POST',
					url:"http://localhost:8080/webtoeic/api/admin/vocab/delete/"+idBaiVocab,
					
					success: function(data){
						loadAllVocab();
						$('#info-success').text("Xóa bài thi thử thành công");
						
										},
				
					 error : function(e) {
					 alert("error");
					 console.log("ERROR: ", e);
				  }
				
						});
			}
			
		
		});
	
	
	function loadAllVocab(){

		$.ajax({
			dataType : 'json',
			type:'GET',
			url:"http://localhost:8080/webtoeic/api/admin/vocab/loadVocab",
			
			success: function(data){
				
				//convert array to json type
				var jsonArray = new Array();
				var fields,id,anhbaituvung,tenbaituvung;
				for(var i = 0; i <data.length; i++ ){
					var jsonObject = new Object();
						fields = data[i].split(',');
						
						id = fields[0].split(':');
						jsonObject.baituvungid = id[1];
						
						anhbaituvung = fields[1].split(':');
						jsonObject.anhbaituvung = anhbaituvung[1];
						
						tenbaituvung = fields[2].split(':');
						jsonObject.tenbaituvung = tenbaituvung[1];
						
					
					jsonArray.push(jsonObject);
				}
				 
				var jsonArr = JSON.parse(JSON.stringify(jsonArray));
				
				var trHTML ="";
				for(var i = 0; i <jsonArr.length ;i++) {
		        	
		            trHTML += '<tr><td class= "center">' + jsonArr[i].baituvungid + '</td>'
		            +'<td class= "center">' + jsonArr[i].tenbaituvung+ '</td>'
		            
		            +'<td class= "center">' + jsonArr[i].anhbaituvung + '</td>'
		     
		            +'<td class = "center"> <a id="edit.'+ jsonArr[i].baituvungid+' "'
		            
		            +'class="yellow editBaiVocab"><button class="btn btn-warning">Cập nhật</button></a> '
		     
		            +' <a id="delete.'+jsonArr[i].baituvungid+' "'
		            
		            +'class="red deleteBaiVocab" ><button class="btn btn-danger">Xóa</button></a> </td>'

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
	

	
	//default. load all object baiVocab
	window.onload = function () {
		loadAllVocab();
		
	};

	
	
	
	
});
