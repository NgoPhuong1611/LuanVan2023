
$(document).ready(function() {
	//starts the carousel
	$('#myCarousel').carousel();
	
	var baseUrl=$('#baseUrl').val();

	$(document).on("click", ".openModalFunction", function(event) {
        event.preventDefault();    //prevent default action of <a>
        if ($(this).attr("id") == 'modal1')
        {
        	 $('#openModal').on('show', function () {
        		 
        	
        	        var image1Src = baseUrl+"/resources/file/images/tip-listening.png";
					var image2Src = baseUrl+"/resources/file/images/tip-reading.png";
					var href1 = baseUrl+"/listVocab";
					var href2 = baseUrl+"/listGrammar";
				
					 $('#name1').text("Bài hướng dẫn từ vựng");
					 $('#name2').text("Bài hướng dẫn ngữ pháp");
					 
					
					 
	         	    $('a #image1').attr("src",image1Src);
	         	    $('a #image2').attr("src",image2Src);
	         	    
	         	   document.getElementById("name1").setAttribute("href",href1);
	         	  document.getElementById("name2").setAttribute("href",href2);
	         	
	         	

        	    });
     	    
        	    $('#openModal').modal({show:true})


        	    $('#openModal').on('hidden.bs.modal', function(e)
        	    	    { 
        	    	        $(this).removeData();
        	    	    }) ;
        	 
        }
        else if ($(this).attr("id") == 'modal2')
        {

        	 $('#openModal').on('show', function () {
             	
     	        var image1Src = baseUrl+"/resources/file/images/exercise-listen.png";
					var image2Src = baseUrl+"/resources/file/images/exercise-read.png";
					var href1 = baseUrl+"/listening";
					var href2 = baseUrl+"/reading";
				
					 $('#name1').text("Bài tập phần nghe");
					 $('#name2').text("Bài tập phần đọc");
					 
					
					 
	         	    $('a #image1').attr("src",image1Src);
	         	    $('a #image2').attr("src",image2Src);
	         	    
	         	   document.getElementById("name1").setAttribute("href",href1);
	         	  document.getElementById("name2").setAttribute("href",href2);
	         	
	         	

     	    });
  	    
     	    $('#openModal').modal({show:true})


     	    $('#openModal').on('hidden.bs.modal', function(e)
     	    	    { 
     	    	        $(this).removeData();
     	    	    }) ;

            
        }
        
	 });

	$(document).on("click", ".doExam", function(event) {

		var name = $('#nameUser').val();
		if(name === ''){
		if(confirm("Bạn phải đăng nhập để thực hiện chức năng này")){
			var url = baseUrl+"/login";
			window.location.href = url;
		}
			}
		else{
				var url = baseUrl+"/listExam";
				window.location.href = url;
			}

	});
     
});
