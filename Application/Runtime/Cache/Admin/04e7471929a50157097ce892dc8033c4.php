<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <meta name="viewport" content="width=device-width,inital-scale=1.0,maximum-scale=1.0;">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">

 

    <title>AppServer服务器</title>

    <!-- Bootstrap core CSS -->
    <link href="../../Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Public/css/main.css" rel="stylesheet">

    <script src="../../Public/js/jquery-1.11.2.min.js"></script>
    <script src="../../Public/js/bootstrap.min.js"></script>
    <script src="../../Public/js/bootstrapValidator.min.js"></script>
	<script src="../../Public/js/main.js"></script>
	<!--<script src="../../Public/js/user.js"></script>-->
    <!-- Custom styles for this template -->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
   <div class="top"> <!-- 导航开始-->
		  	 <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo U('/Admin/Main/main');?>">AppServer服务器管理系统</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="welcome">欢迎您，<?php echo ($adminId); ?><span class="caret"></span></span></a>
                  <ul class="dropdown-menu" role="menu">
                        <li><a href="#">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="#myModal" data-toggle="modal" data-target="#myModal">注销登录</a></li>
                        
                  </ul>
                </li>
              </ul>
<!--              <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="查找">
              </form>-->
            </div>
          </div>
     </nav>
   </div> <!-- 导航结束-->
    
    <div class="container-fluid"><!--container-fluid开始-->
    	<div class="row row_height"><!--row开始-->
    		<div class="col-md-2 col-sm-2 col-xs-3  left_content"> <!--左边开始-->
     			<ul id="main-nav" class="nav nav-tabs navbar-fixed-left nav-stacked nav-static-left" >
                           
                            <li>
                        		<a href="#">
                            		<i class="glyphicon glyphicon-th-list"></i>
                            		数据查看        
                        		</a>
                   		 	</li>
                            <li>
                        		<a href="#">
                            		<i class="glyphicon glyphicon-eye-open"></i>
                            		日志查看        
                        		</a>
                   		 	</li>                            
                             <li>
                            	<a href="#studentSetting" class="nav-header collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-user"></i>学生管理<span class="pull-right glyphicon glyphicon-chevron-down"></span>
                                </a>
                                <ul id="studentSetting" class="nav nav-list collapse secondmenu" style="height: 0px;">
                                   <!-- <div class="second"><li><a href="#"><i class="glyphicon glyphicon-edit"></i>更改密码</a></li></div>-->
                                    <div class="second"><li><a id="userOperation" href="javascript:void(0)"><i class="glyphicon glyphicon-asterisk"></i>更改名单</a></li></div>
                                </ul>
                            </li> 
                            <li>
                            	<a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-cog"></i>系统管理<span class="pull-right glyphicon glyphicon-chevron-down"></span>
                                </a>
                                <ul id="systemSetting" class="nav nav-list collapse secondmenu" style="height: 0px;">
                                    <div class="second"><li><a id="editIntroduction" href="javascript:void(0)"><i class="glyphicon glyphicon-edit"></i>编辑简介</a></li></div>
                                    <div class="second"><li><a id="editNotice" href="javascript:void(0)"><i class="glyphicon glyphicon-asterisk"></i>编辑公告</a></li></div>
                                </ul>
                            </li>                     
                </ul>

            </div> <!--左边结束-->
                
            <div class="col-md-10 col-sm-10 col-xs-9 right_content"><!--右边开始-->
           		<!--=====================================欢迎页开始============================================-->
				<div class="col-sm-12 col-md-12 clo-xs-12">              
                              <h2 class="page-header">管理员  <?php echo ($adminId); ?></h2>
                    
                              <div class="row placeholders">
                                <div class="col-xs-12  col-sm-3 col-md-5 placeholder">
                                  <h4>当前登录IP : <?php echo ($ip); ?></h4>          
                                </div>
                                <div class="col-xs-12 col-md-5  col-sm-3  placeholder">
                                  <h4>当前登录IP所处位置 : <?php echo ($location); ?></h4>
                                </div>                                                              
                              </div> 
                              
                              <div class="row placeholders">
                                <div class="col-xs-12 col-md-5  col-sm-3 placeholder">
                                  <h4>上次登录IP : <?php echo ($queryIp); ?></h4>
                                </div>
                                <div class="col-xs-12 col-md-5  col-sm-3  placeholder">
                                  <h4>上次登录IP所处位置 : <?php echo ($queryLocation); ?></h4>
                                </div>     
                              </div>
                 </div>   	
				 <!--=====================================欢迎页结束============================================-->		 
            </div> <!--右边结束-->
                  
                    
		 </div><!--row结束-->
         
     </div><!--container-fluid结束-->         
    
    <!-- ==========隐藏域============  -->
    <input type="hidden" id="hidden" value="<?php echo ($token); ?>">
    
    
    
    <!--==========================================================模态框==============================================-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">系统提示</h4>
          </div>
          <div class="modal-body">
            您确定要注销登录?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" >关闭</button>
            <button type="button" class="btn btn-primary" id="btnLogout" >确定</button>
          </div>
        </div>
      </div>
    </div>  
      
  
  
  
  
  
  
      
  
    <!-- Bootstrap core JavaScript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

  </body>
</html>