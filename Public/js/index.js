// JavaScript Document
document.write("<script language='javascript' src='/AppServer/Public/js/jQuery.md5.js'></script>");
document.write("<script language='javascript' src='/AppServer/Public/js/jquery.cookie.js'></script>");

/*==================index.html=================================*/

$(function(){
	
	if($.cookie("admin_id")){
		$("#checkBox").attr("checked",true);
		$("#admin_id").val($.cookie("admin_id"));
	}

	$("#btnLogin").bind("click", function(){
		$("#btnLogin").html("正在登陆...");
		//学号密码为空时的提示
		if($("#admin_id").val()==""){
			$("#admin_id_error").addClass("has-error");
			$("#btnLogin").html("重新登陆");
			return false;
		}
		else {
			$("#admin_id_error").removeClass("has-error");
		}
		if($("#pwd").val()==""){
			$("#pwd_error").addClass("has-error");
			$("#btnLogin").html("重新登陆");
			return false;
		}
		else
			$("#pwd_error").removeClass("has-error");	
			
			
		//要传递的json数据		
		var data='{"admin_id":"' + $("#admin_id").val() + '","pwd":"' + $.md5($("#pwd").val()) + '"}';
		/*var data={"admin_id": $("#admin_id").val(),"pwd":$.md5($("#pwd").val())};*/
		//AJAX的URL
		var url ='/AppServer/Admin/Index/login';
		$.ajax({
			
			url:url,
			/*timeout:100,*/
			data: data,
			type:"POST",
			contentType: "application/json; charset=UTF-8",
			dataType: "text",
			cache:false,
			
			success:function(data){
				var code=data;
				if (code==-1){
					$("#sign").html("帐号或者密码错误!");
					$("#btnLogin").html("重新登陆");
					return false;
				}
				else if(code==1){
					if ($("#checkBox").is(":checked")){
						$.cookie("admin_id",$("#admin_id").val(),{path:"/",expires:7});
					} else
						$.cookie("admin_id",null,{path:"/"});
					location.href = "/AppServer/Admin/Main/main";
				}
				else {
					$("#sign").html("未知错误!");
					$("#btnLogin").html("重新登陆");
					return false;
				}
			},
			
			error:function(){
				$("#sign").html("无法连接服务器!");
				$("#btnLogin").html("重新登陆");
			}
		});	
	});
	
	
});











