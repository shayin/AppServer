// JavaScript Document

$(function(){ 

	/*
	 *主页面初始化 
	 */
	/*调整设宽高*/
	var width = $(window).width();
	var height = $(window).height();
	$(".left_content").height(height-50);
	
	/*关闭AJAX相应的缓存*/
	$.ajaxSetup({
		cache: false 
	});
	
	
	/*注销登录*/
	$('#btnLogout').click(function(){
		$.post("destroySession", function(){					
			location.href="/AppServer/Admin/";
		});	
	});
	

	
	/*User模块*/
	$('#userOperation').click(function(){	
		location.href = '/AppServer/Admin/User/userList/page/1';
	});
	
	/*系统管理模块*/
	/*简介*/
	$('#editIntroduction').click(function(){
		location.href = '/AppServer/Admin/System/Introduction';		
	});
	/*公告*/
	$('#editNotice').click(function(){
		location.href = '/AppServer/Admin/System/Notice/page/1';		
	});
		
	
	
	
	
});




