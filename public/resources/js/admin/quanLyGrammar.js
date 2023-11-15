
 

$(document).ready(function() {
	var simplemde;
	
	//default. load all object baiGrammar
	window.onload = function () {
		loadAllGrammar();
		
		// creat markdown
		 simplemde =new SimpleMDE({
		    element: document.getElementById("markdown-editor"),
		    spellChecker: false,
		});
		
	};
	
	
	
	
	function loadAllGrammar(){
		$.ajax({
			dataType : 'json',
			type:'GET',
			url:"http://localhost:8080/webtoeic/api/admin/grammar/loadGrammar",
			
			success: function(data){
				
				//convert array to json type
				var jsonArray = new Array();
				var fields,id,anhbaigrammar,tenbaigrammar;
				for(var i = 0; i <data.length; i++ ){
					var jsonObject = new Object();
						fields = data[i].split(',');
						
						id = fields[0].split(':');
						jsonObject.baigrammarid = id[1];
						
						anhbaigrammar = fields[1].split(':');
						jsonObject.anhbaigrammar = anhbaigrammar[1];
						
						tenbaigrammar = fields[2].split(':');
						jsonObject.tenbaigrammar = tenbaigrammar[1];
						
					
					jsonArray.push(jsonObject);
				}
				 
				var jsonArr = JSON.parse(JSON.stringify(jsonArray));
				
				var trHTML ="";
				for(var i = 0; i <jsonArr.length ;i++) {
		        	
		            trHTML += '<tr><td class= "center">' + jsonArr[i].baigrammarid + '</td>'
		            +'<td class= "center">' + jsonArr[i].tenbaigrammar+ '</td>'
		            
		            +'<td class= "center">' + jsonArr[i].anhbaigrammar + '</td>'
		     
		            +'<td class = "center"> <a id="edit.'+ jsonArr[i].baigrammarid+' "'
		            
		            +'class="yellow editBaiGrammar"><button class="btn btn-warning">Cập nhật</button></a> '
		     
		            +' <a id="delete.'+jsonArr[i].baigrammarid+' "'
		            
		            +'class="red deleteBaiGrammar" ><button class="btn btn-danger">Xóa</button></a> </td>'

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
	
	
	//add new baigrammar

	$('#btnAddNewGrammar').click(function() {
		// formData: nameBaiThiThu,file_Excel, file_Image, file_imageQuestion, file_Listening
		var formData = new FormData();
		
		var file_image = $('#file_Image_Grammar')[0].files[0];
		var name = $('#nameGrammar').val();
		var contentMarkdown =  simplemde.value(); //get from textarea markdown
		var contentHTML = simplemde.options.previewRender(contentMarkdown);
		
		
		formData.append("file_image",file_image);
		formData.append("name",name);
		formData.append("contentMarkdown",contentMarkdown);
		formData.append("contentHtml",contentHTML);
		
		$.ajax({
				data: formData,
				type:'POST',
				url:"http://localhost:8080/webtoeic/api/admin/grammar/save",
				enctype : 'multipart/form-data',
			    contentType : false,
			    cache : false,
			    processData : false,
			    success: function(data){
			    	
			   $('#grammarModal').modal('hide');
			   loadAllGrammar();
				$('#info-success').text("Thêm mới bài grammar thành công");
				
								},
		
			 error : function(e) {
			 alert("error");
			 $('#grammarModal').modal('hide');
			 console.log("ERROR: ", e);
		  }
		
				});	
	});
	
// delete baiGrammar	
	$(document).on('click','.deleteBaiGrammar',function(){
		var deleteId = $(this).attr('id');
		var fields = deleteId.split('.');
		var idBaiGrammar = fields[1];
		
		if(confirm("Bạn muốn xóa bài grammar này?"))
			{
				$.ajax({
					type:'POST',
					url:"http://localhost:8080/webtoeic/api/admin/grammar/delete/"+idBaiGrammar,
					success: function(data){
						loadAllGrammar();
						$('#info-success').text("Xóa bài grammar thành công");
										},
					 error : function(e) {
					 alert("error");
					 console.log("ERROR: ", e);
				  }
				
						});
			}
			
		});	
	
	//edit baiGrammar	
	$(document).on('click','.editBaiGrammar',function(event){
		var editId = $(this).attr('id');
		var fields = editId.split('.');
		var idBaiGrammar = fields[1];
	
		$.ajax({
			type:'GET',
			url:"http://localhost:8080/webtoeic/api/admin/grammar/infoGrammar/"+idBaiGrammar,
			success: function(data){
			
				var jsonObject = new Object();
				fields = data.split('|');
				
				id = fields[0].split('==');
				jsonObject.tenbaigrammar = id[1];
				
				anhbaigrammar = fields[1].split('==');
				jsonObject.anhbaigrammar = anhbaigrammar[1];
				
				contentgrammar = fields[2].split('==');
				jsonObject.contentgrammar = contentgrammar[1];
			
				//set data for modal
				
				var modal = $('#grammarModal');
				$('#grammarModal #idGrammarModal').val(idBaiGrammar);
				modal.find('.modal-body #nameGrammar').val(jsonObject.tenbaigrammar);
                modal.find('.modal-header #titleModal').text("Cập nhật bài ngữ pháp");
           
                simplemde.value(jsonObject.contentgrammar);
                
                
                //simplemde = null;
                $('#btnUpdate').show();
              	$('#btnAddNewGrammar').hide();
                $('#grammarModal').modal('show');
				
				
								},
		
			 error : function(e) {
			 alert("error");
			 console.log("ERROR: ", e);
		  }
		
				});
		
		
		
		
		$('#btnUpdate').click(function() {
		
			var formData = new FormData();
			
			
			var name = $('#nameGrammar').val();
			var contentMarkdown =  simplemde.value(); //get from textarea markdown
			var contentHTML = simplemde.options.previewRender(contentMarkdown);
			
			
			var file_image; 
			
			if($('#file_Image_Grammar').get(0).files.length != 0){
				file_image = $('#file_Image_Grammar')[0].files[0];
				formData.append("file_image",file_image);
			}
			else{
				formData.append("file_image"," ");
			}
				
				
			
			formData.append("idGrammar",idBaiGrammar);
			formData.append("name",name);
			formData.append("contentMarkdown",contentMarkdown);
			formData.append("contentHtml",contentHTML);
			
			
			$.ajax({
				data: formData,
				type:'POST',
				url:"http://localhost:8080/webtoeic/api/admin/grammar/update",
				enctype : 'multipart/form-data',
			    contentType : false,
			    cache : false,
			    processData : false,
			    
				success: function(data){
	                $('#grammarModal').modal('hide');
	                $('#info-success').text("Cập nhật bài grammar thành công");
	                loadAllGrammar();
					
									},
			
				 error : function(e) {
				 alert("error");
				 console.log("ERROR: ", e);
			  }
			
					});
		
		});
		
		
				
		});
	
	
	
});
