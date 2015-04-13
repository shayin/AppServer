<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 

    <title>AppServer服务器登录</title>

    <!-- Bootstrap core CSS -->
    <link href="/AppServer/Public/css/bootstrap.min.css" rel="stylesheet">
	<link href="/AppServer/Public/css/index.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    

    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  	<div class="container">
    	<form class="form-signin" role="form" id="login-form" onSubmit="return false">
        	<h2 class="form-signin-heading">服务器登录</h2>
            <div id="admin_id_error"><input id="admin_id" type="text" class="form-control login-input" placeholder="帐号" ></div>
            <div id="pwd_error"><input id="pwd" type="password" class="form-control login-input" placeholder="密码" ></div>
            <div class="sign" id="sign"></div>
            <label class="checkbox login-label">
            	<input id="checkBox" type="checkbox" value="remember-me">记住帐号
            </label>
          <button class="btn btn-lg btn-primary btn-block" id="btnLogin" type="button">登录</button>
        </form>    
            
    </div>

  
  
  
  
  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/AppServer/Public/js/jquery-1.11.2.min.js"></script>
    <script src="/AppServer/Public/js/bootstrap.min.js"></script>
    <script src="/AppServer/Public/js/index.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>