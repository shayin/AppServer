<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>移动通信实验教学平台</title>
<link href="/AppServer/Public/css/homeMain.css" rel="stylesheet" type="text/css" />
<script src="/AppServer/Public/js/setHomeSetFav.js" type="text/javascript" charset="gb2312" ></script>
<script src="/AppServer/Public/js/myfocus-2.0.1.min.js"  type="text/javascript" ></script>
<script src="/AppServer/Public/js/mf-pattern/mF_fancy.js" type="text/javascript" ></script>
<link href="/AppServer/Public/css/homeLogin.css" rel="stylesheet" type="text/css" />
<link href="/AppServer/Public/js/mf-pattern/mF_fancy.css" rel="stylesheet" type="text/css" />
<script src="/AppServer/Public/js/jquery-1.11.2.min.js"></script>
<script language='javascript' src='/AppServer/Public/js/jQuery.md5.js'></script>
<script language='javascript' src='/AppServer/Public/js/jquery.cookie.js'></script>
<script language='javascript' src="/AppServer/Public/js/jquery.validate.min.js"></script>
<script language='javascript' src="/AppServer/Public/js/jquery.validate.messages_cn.js"></script>


    <script type="text/javascript">
    $(function(){
        myFocus.set({
            id:'picBox'});

        $('#verifyCode').click(function(){
            $(this).attr('src',  '/AppServer/Home/Index/verify?reflesh=' + Math.random());
        });

        $('#login').click(function(){

            var user = $('#username').val();
            var pwd = $.md5($('#pwd').val());
            var verifyCode = $('#verify').val();
            var json = '{"user":"' + user + '","pwd":"' + pwd + '","verifyCode":"' + verifyCode + '"}';
//            var test = '{"data":[{"id":"35"},{"id":"34"}],"editToken":"db85e1dcaeac9d387159f8fdc7dbc377","admin_id":"2011051309","currentPage":"1"}'
            var data = jQuery.parseJSON(json);

            if(user!=''&&pwd!=''&&verifyCode!=''){
                $.ajax({
                    url:'/AppServer/Home/Index/login',
                    cache:false,
                    type:"POST",
                    data: data,
                    success:function(stat){
                        if(stat==-1){
                        	$('#tip').text('验证码错误!');
                        	$('#verifyCode').trigger('click');	
                        } else if(stat==0){
                        	$('#tip').text('账号或密码错误!');		
                        } else if(stat==1){
                        	var view = $('.sidebar').children().eq(1);
                        	view.remove();
                        	view.text('欢迎您,<?php echo ($student_id); ?>');
                        	
                        } else{
                        	$('#tip').text('未知错误!');	
                        }
                    }
                });
            }
        })

        //表单验证
        $('#lgForm').validate({
            rules:{
                username:"required",
                pwd :"required",
                verify:"required"
            },
            errorPlacement: function (error, element) {
                $("#tip").text('请填写完整');
                return false;
            }
        });


    })

</script>

</head>

<body class="body_class">

<div class="top">
	<div class="top_content">
    	<ul>
        	<li>联系我们</li>
            <li><a href="#" onclick="AddFavorite(window.location, document.title)">加入收藏</a></li>
            <li><a href="#" onclick="SetHome(window.location)">设为首页</a></li>
        </ul>
    </div>
</div>

<div class="wrap">
	<div class="logo">
    	<div class="logo_left">
        	<img src="/AppServer/Public/images/logo.png" alt="暨南大学" />
        </div>
        <div class="logo_right">
        	<img src="/AppServer/Public/images/tel.jpg" alt="联系电话"/>联系方式:<span class="tel"> 188-2517-2171</span>
        </div>
    </div>
    <div class="nav">
    	<div class="nav_left"></div>

        <div class="nav_mid">
        	<div class="nav_mid_left">
            	<ul>
            		<li><a href="#">首页</a></li>
                    <li><a href="#">课程简介</a></li>
                    <li><a href="#">教学队伍</a></li>
                    <li><a href="#">教学大纲</a></li>
                    <li><a href="#">教学内容</a></li>
                    <li><a href="#">作业习题</a></li>
                    <li><a href="#">课余讨论</a></li>
                    <li><a href="#">课程公告</a></li>
            	</ul>
            </div>
            <div class="nav_mid_right">
            	<form action="" method="post">
                	<input type="text" class="search_text"/>
                </form>
            </div>
        </div>

        <div class="nav_right"></div>
    </div>

    <div class="ad" id="picBox">
    	<div class="loading"><img  src="/AppServer/Public/images/loading.gif" alt="图片加载中"/></div>
    	<div class="pic">
     		<ul>
        		<li><img src="/AppServer/Public/images/ad2.jpg"/></li>
            	<li><img src="/AppServer/Public/images/ad3.jpg"/></li>
            	<li><img src="/AppServer/Public/images/ad4.jpg"/></li>
        	</ul>
        </div>
    </div>

    <div class="main">
    	<div class="news">
        	<div class="title">
            	<h2 class="title_left">课程公告</h2>	<span class="title_right"><a href="news.html" class="title_right">More&gt;&gt;</a></span>
            </div>
            <div class="news_list">
                <ul>
                  <?php if(is_array($newData)): $i = 0; $__LIST__ = $newData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?><li><span><?php echo ($new["time"]); ?></span><a href="news.html"><?php echo ($new["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>

        <div class="course">
        	<div class="title">
            	<h2 class="title_left">课程简介</h2><span class="title_right"><a href="news.html">More&gt;&gt;</a></span>
            </div>
            <div class="course_pic">
           		<img id="test" src="<?php echo ($introduction["course_picture"]); ?>"/><h2><a href="news.html"><?php echo ($introduction["course_title"]); ?></a></h2><p><?php echo ($introduction["course_introduction"]); ?></p>
            </div>
           <!-- <div class="course_type"></div>-->
        </div>

        <div class="sidebar">
        	<div class="title">
            	<h2 class="title_left">用户登录</h2>
            </div>
			<div class="login_external" id="iframe_size">
                <div class="login_inner">
                    <form id="lgForm" action="javascript:void(0)" method="post">
                        <p><div id="tip" style="color:red;margin:0 0 0 30px"></div></p>
                        <p><span class="login_sign">学&nbsp;&nbsp;&nbsp;号</span><input type="text"  name="username" id="username" /></p>
                        <p><span class="login_sign">密&nbsp;&nbsp;&nbsp;码</span><input type="password" name="pwd" id="pwd"/></p>
                        <p>
                            <span class="login_sign">验证码</span><input type="text" name="verify" id="verify" />&nbsp<img src="/AppServer/Home/Index/verify" id="verifyCode" alt="点击刷新"  />
                        </p>
                        <p>
                            <input class="white" type="submit" name="login" value="登录" id="login"/>
                            <input class="black" type="reset" name="reset" value="重置" id="reset"/>
                        </p>
                    </form>
				</div>
            </div>
        </div>
    </div>

</div>
</body>
</html>