<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns:th="http://www.thymeleaf.org">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>

	<link href="/resources/css/bootstrap.css" rel="stylesheet">
    <link href="/resources/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/resources/css/style.css" rel="stylesheet"> 
    
     
    <script src="/resources/js/jquery-1.js"></script>
    <script src="/resources/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
    
    function openModal(){
    	$('#myModal').modal();
    }
    
    </script>

</head>
<body>

<!--HEADER ROW-->
  <div id="header-row">
    <div class="container">
      <div class="row">
              <!--LOGO-->
              <div class="span3"><a class="brand" href="#"><img src="#" /></a></div>
              <!-- /LOGO -->

            <!-- MAIN NAVIGATION -->  
              <div class="span9">
                <div class="navbar  pull-right">
                  <div class="navbar-inner">
                    <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
                    <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                        
                        
                      
                         	<li><a href="">Đăng nhập</a></li>
	                        <li><a href="">Đăng ký</a></li>
                       
                       
                       
                 
                        <c:if test="${pageContext.request.userPrincipal.name != null}">
                        
	                         <li><a>Xin chào: </a></li>
	                         <li></li>
	                         <li><a href="#">Thoát</a></li>
                        
                        </c:if>         
                                
                                  
                            
                                  
                      </ul>            
                                   
                 
                    
                  </div>

                  </div>
                </div>
              </div>
            <!-- MAIN NAVIGATION -->  
      </div>
    </div>
  </div>
  <!-- /HEADER ROW -->
  
</body>
</html>