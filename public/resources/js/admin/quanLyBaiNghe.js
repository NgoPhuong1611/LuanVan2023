$(document).ready(function() {

	var changeImage = false;
	var changeExcel = false;
	var changeAudio = false;
	
	ajaxGet(1);
	function ajaxGet(page) {
		var doKho = $("#doKhoSearch").val();
		var part = $("#partSearch").val();
		$.ajax({
			type : "GET",
			url : "http://localhost:8080/webtoeic/api/admin/bai-nghe/all" + "?page=" + page + "&doKho=" + doKho + "&part=" + part,
			success : function(result) {
				$.each(result.content, function(i, baiNghe) {
					// console.log(baiNghe);
					var baiNgheRow = '<tr style="text-align: center;">' + '<td width="5%">' + baiNghe.id + '</td>' + '<td>' + baiNghe.tenBaiNghe + '</td>';
					if (baiNghe.part === 1) {
						baiNgheRow += '<td>PART1 PHOTOGRAPHS</td>';
					} else if (baiNghe.part === 2) {
						baiNgheRow += '<td>PART2 QUESTION RESPONSE</td>';
					} else {
						baiNghe.part === 3 ? (baiNgheRow += '<td>PART3 SHORT CONVERSATIONS</td>') : (baiNgheRow += '<td>PART4 SHORT TALKS</td>');
					}
					if (baiNghe.doKho === 1) {
						baiNgheRow += '<td>Dễ</td>';
					} else {
						baiNghe.doKho === 2 ? (baiNgheRow += '<td>Trung bình</td>') : (baiNgheRow += '<td>Khó</td>');
					}

					baiNgheRow += '<td>' + '<input type="hidden" value=' + baiNghe.id + '>'
					            + '  <button class="btn btn-warning btnCapNhatBaiNghe">Cập nhật</button>'
					             + '   <button class="btn btn-danger btnXoaBaiNghe">Xóa</button></td>'
					'</tr>';
					$('.baiNgheTable tbody').append(baiNgheRow);
				});

				if (result.totalPages > 1) {
					for (var numberPage = 1; numberPage <= result.totalPages; numberPage++) {
						var li = '<li class="page-item "><a class="pageNumber">' + numberPage + '</a></li>';
						$('.pagination').append(li);
					}
					// active page pagination
					$(".pageNumber").each(function(index) {
						if ($(this).text() == page) {
							$(this).parent().removeClass().addClass("page-item active");
						}
					});
				}
			},
			error : function(e) {
				alert("Error: ", e);
				console.log("Error", e);
			}
		});
	}
	;

	// event khi click duyệt bài nghe
	$(document).on('click', '#btnDuyetBaiNghe', function(event) {
		event.preventDefault();
		$('.baiNgheTable tbody tr').remove();
		$('.pagination li').remove();
		ajaxGet(1);
	});

	// click event button Thêm mới bài nghe
	$('.btnThemBaiNghe').on("click", function(event) {
		event.preventDefault();
		$('#baiNgheModal').modal();
		$('.baiNgheForm #id').prop("disabled", true);
		$('#formBaiNghe').removeClass().addClass("addForm");
		$('#formBaiNghe #btnSubmit').removeClass().addClass("btn btn-primary btnSaveForm");
	});
	
	// click event button cập nhật bài nghe
	$(document).on('click', '.btnCapNhatBaiNghe', function(event) {
		event.preventDefault();
		var baiNgheId = $(this).parent().find('input').val();
		$('#formBaiNghe').removeClass().addClass("updateForm");
		$('#formBaiNghe #btnSubmit').removeClass().addClass("btn btn-primary btnUpdateForm");
		var href = "http://localhost:8080/webtoeic/api/admin/bai-nghe/"+baiNgheId;
		$.get(href, function(baiNghe) {
            console.log(baiNghe);
            $('#id').val(baiNghe.id);
            $('#tenBaiNghe').val(baiNghe.tenBaiNghe);
            $('#doKho').val(baiNghe.doKho);
            $('#phanThi').val(baiNghe.part);
            $('#script').val(baiNghe.script);
            
//            $('#photoBaiNghe').val("http://localhost:8080/webtoeic/file/images/baiNgheId="+ baiNghe.id+".png");
            $("img").attr("src", "http://localhost:8080/webtoeic/file/images/baiNgheId="+ baiNghe.id+".png");
            $("#previewImage").removeClass("hidden");
            $("#previewAudio").attr("src", "http://localhost:8080/webtoeic/file/audio/baiNgheId="+ baiNghe.id+".mp3");
            $("#previewAudio").removeClass("hidden");
            $("#linkExcel").attr("href", "http://localhost:8080/webtoeic/file/excel/baiNgheId="+ baiNghe.id+".xlsx");
            $("#linkExcel").removeClass("hidden");           
		});	
		$('#baiNgheModal').modal();
	});
	
	// event khi hide modal
	$('#baiNgheModal').on('hidden.bs.modal', function() {
		$('#formBaiNghe').removeClass().addClass("baiNgheForm");
		$('#formBaiNghe #btnSubmit').removeClass().addClass("btn btn-primary");
		resetForm();
	});
	
	// delete request
	$(document).on("click", ".btnXoaBaiNghe", function() {
		var baiNgheId = $(this).parent().find('input').val();
		var workingObject = $(this);
		var confirmation = confirm("Bạn chắc chắn xóa bài nghe này ?");
		if (confirmation) {
			$.ajax({
				type : "DELETE",
				url : "http://localhost:8080/webtoeic/api/admin/bai-nghe/delete/" + baiNgheId,
				success : function(resultMsg) {
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
	function resetData() {
		$('.baiNgheTable tbody tr').remove();
		var page = $('li.active').children().text();
		$('.pagination li').remove();
		ajaxGet(page);
	}
	;

	// reset table after delete
	function resetDataForDelete() {
		var count = $('.baiNgheTable tbody').children().length;
		// console.log("số cột " + count);
		$('.baiNgheTable tbody tr').remove();
		var page = $('li.active').children().text();
		$('.pagination li').remove();
		console.log(page);
		if (count == 1) {
			ajaxGet(page - 1);
		} else {
			ajaxGet(page);
		}

	}

	// event khi click vào phân trang bài nghe
	$(document).on('click', '.pageNumber', function(event) {
		// event.preventDefault();
		var page = $(this).text();
		$('.baiNgheTable tbody tr').remove();
		$('.pagination li').remove();
		ajaxGet(page);
	});

	// validate form trước khi submit
	$("#formBaiNghe").validate({
		errorElement : "p",
		errorClass : "error-message",
		rules : {
			tenBaiNghe : {
				required : true,
				maxlength : 100
			},
			photoBaiNghe : {
				required : true
			},
			audioBaiNghe : {
				required : true
			},
			fileCauHoi : {
				required : true
			},
//			script : { // nếu là part 3 hoặc 4 thì ko đc để trống
//				required : {
//					depends : function() {
//						return $("#phanThi").val() === '3' || $("#phanThi").val() === '4';
//					}
//				}
//			}
		},
		messages : {
			tenBaiNghe : {
				required : "Bạn không được để trống phần này",
				maxlength : "Tiêu đề dài nhất là 100 chữ cái"
			},
			photoBaiNghe : {
				required : "Bạn không được để trống phần này"
			},
			audio : {
				required : "Bạn không được để trống phần này"
			},
			fileExcelCauHoi : {
				required : "Bạn không được để trống phần này"
			},
			script : {
				required : "Bạn không được để trống phần này"
			}
		},
		submitHandler : function(form) {
			var form = $('#formBaiNghe')[0];
			var formData = new FormData(form);
			saveFunction(formData);
		}
	});
	

	$(document).on('click', '.btnSaveForm', function(event) {
		event.preventDefault();
		if ($("#formBaiNghe").valid()) {
			$("#formBaiNghe").submit();
		}
	});
	
//	// click event button xác nhận update form
//	$(document).on('click', '.btnUpdateForm', function(event) {
//		event.preventDefault();	
//		var formData = new FormData();
//		if(changeAudio = true){
//			formData.append("audio", $("#audioBaiNghe").files[0]);
//		}
//		if(changeImage = true){
//			formData.append("photoBaiNghe", $("#photoBaiNghe").files[0]);
//		}
//		if(changeExcel = true){
//			formData.append("fileCauHoi", $("#fileCauHoi").files[0]);
//		}
//		formData.append("id", $("#id").val());
//		formData.append("phanThi", $("#phanThi").val());
//		formData.append("doKho", $("#doKho").val());
//	});

	// validate các trường file input và preview file ảnh/ audio
	$("#audioBaiNghe").change(function() {
		var fileExtension = [ 'mp3' ];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Chỉ cho phép định dạng audio mp3 ");
			$("#audioBaiNghe").wrap('<form>').closest('form').get(0).reset();
			$("#audioBaiNghe").unwrap();
			$("#previewAudio").removeClass().addClass("hidden");
		} else {
			var files = event.target.files;
			$("#previewAudio").attr("src", URL.createObjectURL(files[0]));
			$("#previewAudio").removeClass("hidden");
		}
		changeAudio = true;
	});

	$("#photoBaiNghe").change(function() {
		var fileExtension = [ 'jpg', 'png' ];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Chỉ cho phép ảnh định dang JPEG, PNG");
			$("#photoBaiNghe").wrap('<form>').closest('form').get(0).reset();
			$("#photoBaiNghe").unwrap();
			$("#previewImage").removeClass().addClass("hidden");
		} else {
			var files = event.target.files;
			$("#previewImage").attr("src", URL.createObjectURL(files[0]));
			$("#previewImage").removeClass("hidden");
			// $("#previewImage").load();
		}
		changeImage = true;
	});

	$("#fileCauHoi").change(function() {
		var fileExtension = [ 'xlsx' ];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("Chỉ cho phép file Excel định dang xlsx");
			$("#fileCauHoi").wrap('<form>').closest('form').get(0).reset();
			$("#fileCauHoi").unwrap();

		}
		changeExcel = true;
	});

	// reset form
	function resetForm() {
		$("#id").val("");
		$("#tenBaiNghe").val("");
		$("#script").val("");
		$("#fileCauHoi").wrap('<form>').closest('form').get(0).reset();
		$("#fileCauHoi").unwrap();
		$("#photoBaiNghe").wrap('<form>').closest('form').get(0).reset();
		$("#photoBaiNghe").unwrap();
		$("#previewImage").addClass("hidden");
		$("#audioBaiNghe").wrap('<form>').closest('form').get(0).reset();
		$("#audioBaiNghe").unwrap();
		$("#previewAudio").addClass("hidden");
		$("#linkExcel").addClass("hidden");
		$("#linkExcel").attr("href", "");
		changeImage = false;
		changeExcel = false;
		changeAudio = false;
	}

	function saveFunction(formData) {
		// do post
		$.ajax({
			async : false,
			type : "POST",
			contentType : "application/json",
			url : "http://localhost:8080/webtoeic/api/admin/bai-nghe/save",
			enctype : 'multipart/form-data',
			data : formData,
			// prevent jQuery from automatically transforming the data into a
			// query string
			processData : false,
			contentType : false,
			cache : false,
			timeout : 1000000,

			success : function(response) {
				$("#baiNgheModal").modal('hide');
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
			url : "http://localhost:8080/webtoeic/api/admin/bai-nghe/update/" + id,
			enctype : 'multipart/form-data',
			data : formData,
			// prevent jQuery from automatically transforming the data into a
			// query string
			processData : false,
			contentType : false,
			cache : false,
			timeout : 1000000,

			success : function(response) {
				$("#baiNgheModal").modal('hide');
				alert("Cập nhật thành công");


			},
			error : function(e) {
				alert("Error!")
				console.log("ERROR: ", e);
			}
		});
	}
});

