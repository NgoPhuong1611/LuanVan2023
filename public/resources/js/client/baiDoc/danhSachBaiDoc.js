$(document).ready(function(){
	ajaxGet(1);		
	function ajaxGet(page){
		var doKho = $("#doKhoSearch").val();
		var part = $("#partSearch").val();
		$.ajax({
			type: "GET",		
			url: "http://localhost:8080/webtoeic/api/client/bai-doc/all" + "?page=" + page + "&doKho=" + doKho + "&part=" + part,
			success: function(result){
				if(result.totalElements > 0){
					$("#pTag").removeClass().addClass("hidden");
					$.each(result.content, function(i, baiDoc){
						var html = '<div class="span9">'
							+ '<div class="span3">' 
							+    '<img class="imageExam" src="/webtoeic/file/images/baiDocId='+baiDoc.id+'.png" style="width: 300px; height: 150px;"/>'
							+' </div>'
							+ '<div class="span1"></div>'
							+ '<div class="span5"> '
							+    '<h4 class="content-heading" id="namebaithithu">'+ baiDoc.tenBaiDoc + '</h4>'
							+    '<a class="btn btn-primary" href="/webtoeic/reading/part-'+baiDoc.part+'/'+baiDoc.id+'"> Chi tiết</button>'
							+  '</div>'
							+ '</div>'
					    $('.danhSach').append(html);
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
			   } else {
				   $("#pTag").removeClass("hidden");
			   }
			},
			error : function(e){
				alert("Error: ",e);
				console.log("Error" , e );
			}
		});
	};
	
    // event khi click vào phân trang bài đọc
	$(document).on('click', '.pageNumber', function (event){
//		event.preventDefault();
		var page = $(this).text();	
    	$('.danhSach div').remove();
    	$('.pagination li').remove();
    	ajaxGet(page);	
	});
	
	// event khi click duyệt bài đọc 
    $(document).on('click', '#btnDuyetBaiDoc', function (event) {
    	event.preventDefault();
    	$('.danhSach div').remove();
    	$('.pagination li').remove();
    	ajaxGet(1);       
    });
});