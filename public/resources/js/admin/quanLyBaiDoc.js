$(document).ready(function(){
	var changeImage = false;
	var changeExcel = false;
	
	
	ajaxGet(1);		
	function ajaxGet(page){
		var doKho = $("#doKhoSearch").val();
		var part = $("#partSearch").val();
		$.ajax({
			type: "GET",		
			url: "http://localhost:8080/webtoeic/api/admin/bai-doc/all" + "?page=" + page + "&doKho=" + doKho + "&part=" + part,
			success: function(result){
				$.each(result.content, function(i, baiDoc){
//					console.log(baiDoc);
					var baiDocRow = '<tr style="text-align: center;">' +
					                  '<td width="5%">' + baiDoc.id + '</td>' +
					                  '<td>' + baiDoc.tenBaiDoc + '</td>';
					if(baiDoc.part === 5) {
						baiDocRow += '<td>PART5_COMPLETE_SENTENCE</td>';
					} else {
						baiDoc.part === 6 ? (baiDocRow += '<td>PART6_COMPLETE_THE_PARAGRAPH</td>') : (baiDocRow += '<td>PART7_READING_COMPREHENSION</td>');
					}
					if(baiDoc.doKho === 1) {
						baiDocRow += '<td>Dễ</td>';
					} else {
						baiDoc.doKho === 2 ? (baiDocRow += '<td>Trung bình</td>') : (baiDocRow += '<td>Khó</td>') ;
					}
					                 
					baiDocRow += '<td>'+'<input type="hidden" value=' + baiDoc.id + '>'
					                    + '  <button class="btn btn-primary btnCapNhatBaiDoc" >Cập nhật</button>' 
					                    + '   <button class="btn btn-danger btnXoaBaiDoc">Xóa</button></td>'
				                      '</tr>';
					$('.baiDocTable tbody').append(baiDocRow);
				});		
				
				if(result.totalPages > 1 ){
					for(var numberPage = 1; numberPage <= result.totalPages; numberPage++) {
						var li = '<li class="page-item "><a class="pageNumber">'+numberPage+'</a></li>';
					    $('.pagination').append(li);
					};				
					
					// active page pagination
			    	$(".pageNumber").each(function(index){	
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
	
	// event khi click duyệt bài đọc 
    $(document).on('click', '#btnDuyetBaiDoc', function (event) {
    	event.preventDefault();
    	$('.baiDocTable tbody tr').remove();
    	$('.pagination li').remove();
    	ajaxGet(1);       
    });
	
	// click event button Thêm mới bài đọc
	$('.btnThemBaiDoc').on("click", function(event) {
		event.preventDefault();
		$('#baiDocModal').modal();
		$('.baiDocForm #id').prop("disabled", true);
		$('#formBaiDoc').removeClass().addClass("addForm");
		$('#formBaiDoc #btnSubmit').removeClass().addClass("btn btn-primary btnSaveForm");
	});
	
	// click event button cập nhật bài đọc
	$(document).on('click', '.btnCapNhatBaiDoc', function(event) {
		event.preventDefault();
		var baiDocId = $(this).parent().find('input').val();
		$('#formBaiDoc').removeClass().addClass("updateForm");
		$('#formBaiDoc #btnSubmit').removeClass().addClass("btn btn-primary btnUpdateForm");
		var href = "http://localhost:8080/webtoeic/api/admin/bai-doc/"+baiDocId;
		$.get(href, function(baiDoc) {
            console.log(baiDoc);
            $('#id').val(baiDoc.id);
            $('#tenBaiDoc').val(baiDoc.tenBaiDoc);
            $('#doKho').val(baiDoc.doKho);
            $('#phanThi').val(baiDoc.part);
            $('#script').val(baiDoc.script);
            $("img").attr("src", "http://localhost:8080/webtoeic/file/images/baiDocId="+ baiDoc.id+".png");
            $("#previewImage").removeClass("hidden");
            $("#linkExcel").attr("href", "http://localhost:8080/webtoeic/file/excel/baiDocId="+ baiDoc.id+".xlsx");
            $("#linkExcel").removeClass("hidden");           
		});	
		$('#baiDocModal').modal();
	});
	
	// event khi hide modal
	$('#baiDocModal').on('hidden.bs.modal', function () {
		$('#formBaiDoc').removeClass().addClass("baiDocForm");
		$('#formBaiDoc #btnSubmit').removeClass().addClass("btn btn-primary");
		resetForm();
	});
	
 
	// delete request
    $(document).on("click",".btnXoaBaiDoc", function() {		
		var baiDocId = $(this).parent().find('input').val();
		var workingObject = $(this);		
		var confirmation = confirm("Bạn chắc chắn xóa bài đọc này ?");
		if(confirmation){
		  $.ajax({
			  type : "DELETE",
			  url : "http://localhost:8080/webtoeic/api/admin/bai-doc/delete/" + baiDocId,
			  success: function(resultMsg){
				 resetDataForDelete();
				 alert("Xóa thành công");
			  },
			  error : function(e) {
				 alert("Không thể xóa danh mục này ! Hãy kiểm tra lại");
				 console.log("ERROR: ", e);
			  }
		  });
		}
     });
    
    // reset table after post, put
    function resetData(){
    	$('.baiDocTable tbody tr').remove();
    	var page = $('li.active').children().text();
    	$('.pagination li').remove();
    	ajaxGet(page);
    };
    
    // reset table after delete
    function resetDataForDelete(){
       	var count = $('.baiDocTable tbody').children().length;
//    	console.log("số cột " + count);
    	$('.baiDocTable tbody tr').remove();
    	var page = $('li.active').children().text();
    	$('.pagination li').remove();
    	console.log(page);
    	if(count == 1){    	
    		ajaxGet(page -1 );
    	} else {
    		ajaxGet(page);
    	}

    };
    
    // event khi click vào phân trang bài đọc
	$(document).on('click', '.pageNumber', function (event){
//		event.preventDefault();
		var page = $(this).text();	
    	$('.baiDocTable tbody tr').remove();
    	$('.pagination li').remove();
    	ajaxGet(page);	
	});
	
	//validate form trước khi submit
    $("#formBaiDoc").validate({
    	errorElement: "p",
        errorClass: "error-message",
        rules: {
        	tenBaiDoc: {
                required: true,
                maxlength: 100
            },
            photoBaiDoc : {
				required : true
			},
            fileCauHoi: {
            	required: true
            },
            script: { 
            	required:{
            		depends: function() {
                       return $("#phanThi").val() === '5' || $("#phanThi").val() === '6' || $("#phanThi").val() === '7' ; 
                     }
                }
            }
        },
        messages: {
        	tenBaiDoc: {
        		required: "Bạn không được để trống phần này",
                maxlength: "Tiêu đề dài nhất là 100 chữ cái"
            },
            photoBaiDoc : {
				required : "Bạn không được để trống phần này"
			},
            fileExcelCauHoi: {
            	required: "Bạn không được để trống phần này"
            }, 
            script: {
            	required: "Bạn không được để trống phần này"
            }
        },
        submitHandler: function (form) {
        	var form = $('#formBaiDoc')[0];
			var formData = new FormData(form);
			saveFunction(formData);         }
    });
    
    $(document).on('click', '.btnSaveForm', function (event) {
    	event.preventDefault();
        if ($("#formBaiDoc").valid()) {
            $("#formBaiDoc").submit();
        }
    });
	
	
	// validate các trường file input và preview file ảnh
	$("#photoBaiDoc").change(function() {
		var fileExtension = [ 'jpg', 'png' ];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Chỉ cho phép ảnh định dang JPEG, PNG");
			$("#photoBaiDoc").wrap('<form>').closest('form').get(0).reset();
			$("#photoBaiDoc").unwrap();
			$("#previewImage").removeClass().addClass("hidden");
		} else {
			var files = event.target.files;
			$("#previewImage").attr("src", URL.createObjectURL(files[0]));
			$("#previewImage").removeClass("hidden");
			// $("#previewImage").load();
		}
		changeImage = true;
	});

    
    $("#fileCauHoi").change(function () {
        var fileExtension = ['xlsx'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Chỉ cho phép file Excel định dang xlsx");
            $("#fileCauHoi").wrap('<form>').closest('form').get(0).reset();
            $("#fileCauHoi").unwrap();

        } 
    });
    
	// reset form
    function resetForm(){
		$("#id").val("");
		$("#tenBaiDoc").val("");
		$("#script").val("");
		$("#fileCauHoi").wrap('<form>').closest('form').get(0).reset();
		$("#fileCauHoi").unwrap();
		$("#photoBaiDoc").wrap('<form>').closest('form').get(0).reset();
		$("#photoBaiDoc").unwrap();
		$("#previewImage").addClass("hidden");
		$("#linkExcel").addClass("hidden");
		$("#linkExcel").attr("href", "");
		changeImage = false;
		changeExcel = false;
    };
    
	
     function saveFunction(formData){    	 
    	 // do post
    	 $.ajax({
     		    async:false,
    			type : "POST",
    			contentType : "application/json",
    			url : "http://localhost:8080/webtoeic/api/admin/bai-doc/save",
    			enctype: 'multipart/form-data',
    			data : formData,    			
    		    // prevent jQuery from automatically transforming the data into a
    		    // query string
    	        processData: false,
    	        contentType: false,
    	        cache: false,
    	        timeout: 1000000,
    	        
    			success : function(response) {
    				$("#baiDocModal").modal('hide');
    				alert("Thêm thành công");
    				window.location.reload();
    		    	
    			},
    			error : function(e) {
    				alert("Error!")
    				console.log("ERROR: ", e);
    			}
    		}); 
        }
     
 	function updateFunction(formData, id) {
		// do post
		$.ajax({
			async : false,
			type : "POST",
			contentType : "application/json",
			url : "http://localhost:8080/webtoeic/api/admin/bai-doc/update/" + id,
			enctype : 'multipart/form-data',
			data : formData,
			// prevent jQuery from automatically transforming the data into a
			// query string
			processData : false,
			contentType : false,
			cache : false,
			timeout : 1000000,

			success : function(response) {
				$("#baiDocModal").modal('hide');
				alert("Cập nhật thành công");


			},
			error : function(e) {
				alert("Error!")
				console.log("ERROR: ", e);
			}
		});
	}

});