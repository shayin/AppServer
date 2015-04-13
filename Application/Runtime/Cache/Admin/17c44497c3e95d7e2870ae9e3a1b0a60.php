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
    <link href="/AppServer/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/AppServer/Public/css/main.css" rel="stylesheet">

    <script src="/AppServer/Public/js/jquery-1.11.2.min.js"></script>
    <script src="/AppServer/Public/js/bootstrap.min.js"></script>
    <script src="/AppServer/Public/js/bootstrapValidator.min.js"></script>
	<script src="/AppServer/Public/js/main.js"></script>
    
    
    
    
    <!-- Custom styles for this template -->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
  <script type="text/javascript">
    	
		$(function(){   
			var totalPage = Number($('#totalPage').attr('value'));	
			var currentPage =  Number($('#currentPage').attr('value'));

			$('#pagePrevious').after('<li id="pageIgnoreLeft" style="display:none"><a href="javascript:void(0)">...</a></li>');
			$('#pageNext').before('<li id="pageIgnoreRight"><a href="javascript:void(0)">...</a></li>');	
			
			
			if(totalPage>5){		
				if(currentPage>3&&currentPage<totalPage-2){
					$('#pageIgnoreLeft').css('display','inline');
					$('#pageIgnoreRight').css('display','inline');
					for(i=currentPage-2;i<=totalPage&&i>0&&i<=currentPage+2;i++){			
						$('#pageIgnoreRight').before('<li id="page' + i +'" ><a href="/AppServer/Admin/System/Notice/page/' + i +'" >' + i +'</a></li>');	
					}
				} else if(currentPage<=3){
					$('#pageIgnoreLeft').css('display','none');
					for(i=1;i<=5&&i<=totalPage;i++){			
						$('#pageIgnoreRight').before('<li id="page' + i +'" ><a href="/AppServer/Admin/System/Notice/page/' + i +'" >' + i +'</a></li>');	
					}
					if(i==totalPage){
						$('#pageIgnoreRight').css('display','inline');		
					}				
				} else if(currentPage>=5){
					$('#pageIgnoreLeft').css('display','inline');
					$('#pageIgnoreRight').css('display','none');	
					for(i=totalPage-4;i<=totalPage;i++){			
						$('#pageIgnoreRight').before('<li id="page' + i +'" ><a href="/AppServer/Admin/System/Notice/page/' + i +'" >' + i +'</a></li>');	
					}						
				}
			} else {
				$('#pageIgnoreLeft').css('display','none');
				$('#pageIgnoreRight').css('display','none');
				for(i=1;i<=totalPage;i++){
					$('#pageIgnoreRight').before('<li id="page' + i +'" ><a href="/AppServer/Admin/System/Notice/page/' + i +'" >' + i +'</a></li>')						
				}	
			}
			
			$('#page' + currentPage).addClass('active');
			if(currentPage==1&&totalPage==1){
				$('#pageNext').addClass('disabled');
				$('#pagePrevious').addClass('disabled');
				$('#pagePrevious a').attr('href', 'javascript:void(0)');
			} else if(currentPage==1&&totalPage!=1){
				$('#pageNext').removeClass('disabled');
				$('#pagePrevious').addClass('disabled');
				$('#pagePrevious a').attr('href', 'javascript:void(0)');				
			} else if(currentPage==totalPage){
				$('#pagePrevious').removeClass('disabled');
				$('#pageNext').addClass('disabled');
				$('#pageNext a').attr('href', 'javascript:void(0)');
			} 
			
			$('#btnGoto').click(function(){
				var checkNum = /^[0-9]*[1-9][0-9]*$/;
				if(!checkNum.test(Number($('#goto').val())) || Number($('#goto').val()) > totalPage){
					$('#pageModal').modal();
					$('#goto').val('');
					return false;
				}
				location.href = '/AppServer/Admin/System/Notice/page/' + $('#goto').val();	
			});	
			
			//为表格每一行的按钮添加监听事件
			$('.list').each(function(){				
				var btnObj = $(this).children().eq(5);
				var btnEdit = btnObj.children('#btnEdit');	
				var btnDelete = btnObj.children('#btnDelete');
		
				//编辑按钮
				btnEdit.click(function(){
					var id =  btnEdit.parent().parent().children('td').eq(0).children('#id').val(); 
					var title = btnEdit.parent().parent().children('td').eq(1).text();
					var content = btnEdit.parent().parent().children('td').eq(2).text();
					var publisher = btnEdit.parent().parent().children('td').eq(3).text();
					/*var time = btnDelete.parent().parent().children('td').eq(4).text();*/
					$('#userOpera #exampleModalLabel').text('修改公告');
					$('#editForm').attr('action','/AppServer/Admin/System/noticeEdit');
					$('#userOpera #title').attr('value', title);
					$('#userOpera #content').text(content);
					$('#userOpera #id').attr('value', id);
					$('#userOpera #publisher').html('<option>' + publisher + '</option><option>' + '<?php echo ($adminId); ?>' + '</option>');
					
					
					
					$('#userOpera').modal();	
					$('#editForm').bootstrapValidator({
						message: 'This value is not valid',
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							title: {
								validators: {
									notEmpty: {
										message: '标题不能为空'

									}
								}
							},							
							content: {
								validators: {
									notEmpty: {
										message: '内容不能为空'
									}
								}
							},
						}
                  });					
				});
				
				//删除按钮
				btnDelete.click(function(){
					var id =  btnEdit.parent().parent().children('td').eq(0).children('#id').val(); 
					var title = btnEdit.parent().parent().children('td').eq(1).text();
					var content = btnEdit.parent().parent().children('td').eq(2).text();
					var publisher = btnEdit.parent().parent().children('td').eq(3).text();
					
					$('#userEditor .modal-body').text('确定要删除?');
					$('#userEditor').modal();
					$('#btnConfirm').unbind().click(function(){ 
					//发出删除请求 
					$.ajaxSetup({
						cache:false,	
					});    
					$.post('/AppServer/Admin/System/noticeDelete', {editToken:$('#editToken').val(), id:id, admin_id:'<?php echo ($adminId); ?>', currentPage:Number($('#currentPage').attr('value'))}, 
						function(status){
							if(status==0){
							/*	$('#pageModal modal-body').text('没有权限,请联系管理员!');
								$('#pageModal').modal();	*/						
							} else if(status==2){
								/*$('#pageModal modal-body').text('删除失败!');
								$('#pageModal').modal();	*/
							} else if(status==3){
								/*$('#pageModal modal-body').text('非法操作!');
								$('#pageModal').modal();	*/	
							} else if(status==1){
								/*$('#pageModal modal-body').text('删除成功!');
								$('#pageModal').modal();*/
								location.href = '/AppServer/Admin/System/Notice/page/' + Number($('#currentPage').attr('value'));		
							} else {
								/*$('#pageModal modal-body').text('未知错误!');
								$('#pageModal').modal();	*/	
							}
							
						})   //function 结束
					})   //post结束
				});      //btn结束
				
			});	   //each结束
			
			//新增名单
			$('#insertNotice').click(function(){
				$('#userOpera #exampleModalLabel').text('新增名单');
				
				$('#editForm').attr('action','/AppServer/Admin/System/insertNotice');
				$('#userOpera #title').attr('value', '');
				$('#userOpera #content').attr('value', '');
				$('#userOpera #publisher').html('<option>' + '<?php echo ($adminId); ?>' + '</option>');
				$('#userOpera').modal();
				$('#editForm').bootstrapValidator({
						message: 'This value is not valid',
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							title: {
								validators: {
									notEmpty: {
										message: '标题不能为空'

									}
								}
							},							
							content: {
								validators: {
									notEmpty: {
										message: '内容不能为空'
									}
								}
							},
						}
                  });		
			});	
			
			//批量选取checkbox
			$('#allSelect').click(function(){
				var allChecked = $(this).attr('checked');  
				if(!$(this).attr('checked')){
					$(this).attr('checked', true)
				} else {
					$(this).removeAttr('checked');
				}
				$('.select').each(function(key,val){
					var isChecked = val.checked; 
					if(!isChecked ){
						val.checked = true;
						isChecked = true;
					} else {
					     val.checked = false;
						 isChecked = false;
					}
				})
				
			});	
			
			//单独选取checkbox
			$('.select').click(function(){
				if(!$(this).attr('checked')){
					$(this).attr('checked', true);
				} else {
					$(this).removeAttr('checked');
				}
			});			

					
			//批量删除按钮
			$('#massDelete').click(function(){
				$('#userEditor .modal-body').text('确定要删除?');
				$('#userEditor').modal();
				
				$('#btnConfirm').unbind().click(function(){ 
					//封装数据
					var jsonObj;
					var json = '{"data":[';
					var len = $('.select').length;
					var flag = false;       //标志有无数据
					
					$('.select').each(function(key, val){
						var id = $(this).parent().parent().children('td').eq(0).children('#id').val();
						if (val.checked){
							json = json + '{"id":"' + id + '"},';
							flag = true; 
						}									 	
					});
					json = json.substring(0, json.length-1); 
					json = json + '],"editToken":"' + $('#editToken').val() + '","admin_id":"' + '<?php echo ($adminId); ?>' + '","currentPage":"' + Number($('#currentPage').attr('value')) + '"}';
					jsonObj = jQuery.parseJSON(json);
					if(!flag)
					   return false;
                    $.ajax({
                        url:'/AppServer/Admin/System/massDelete',
                        type:'POST',
                        data:json,
                        success:function(stat){

                            switch (stat[1]){
                                case 0:
                                    alert('没有权限!');
                                    break;
                                case 1:
                                    loxcation.href = '/AppServer/Admin/System/Notice/page/'+ stat[0];
                                    break;
                                case 2:
                                    alert('删除失败!');
                                    break;
                                case 3:
                                    alert('非法操作!');
                                    break;
                                default:
                                    alert('未知错误!');
                                    break;
                            }
                        }

                    });
                })
			  });

		});	
						   				
  </script>
  
  
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
                <!--=====================================User开始============================================-->
                
                
                <!--    <div class="alert alert-warning hide" role="alert" id="myAlert">
                        <button type="button" class="close" onclick="$('#myAlert').hide();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong></strong>
                    </div>-->
                
                    <div class="col-sm-12 col-md-12 clo-xs-12">                 
                
                
                          <h2 class="page-header sub-header">编辑公告</h2> 
                          <div class="noticeOperation">
                          	  <a href="javascript:void(0)" id="insertNotice"><i class="glyphicon glyphicon-plus"></i>新增公告</a>
                              <a href="javascript:void(0)" id="massDelete"><i class="glyphicon glyphicon-trash"></i>批量删除</a>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr class="active">
                                  <th><input type="checkbox" id="allSelect"></th>
                                  <th>标题</th>
                                  <th>内容</th>
                                  <th>发布人</th>
                                  <th>发布时间</th>
                                  <th>操作</th>
                                </tr>                  
                              </thead>
                              <tbody id="list">
                              	  <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr class="list">
                                            <td id="checkBox"><input type="checkbox" class="select"><input type="hidden" id="id" value="<?php echo ($val["id"]); ?>"></td>
                                            <td id="title"><?php echo ($val["title"]); ?></td>
                                            <td id="content"><?php echo ($val["content"]); ?></td>	
                                            <td id="publisher"><?php echo ($val["publisher"]); ?></td>
                                            <td id="time"><?php echo ($val["time"]); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-default" id="btnEdit">编辑</button>&nbsp;<button type="button" class="btn btn-default" id="btnDelete">删除</button>
                                            </td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
                              </tbody>
                            </table>
                           </div>   
                        
                        <nav style="text-align:center"> 
                          <ul class="pagination" id="page">
                            <li id="pagePrevious" ><a href="/AppServer/Admin/System/Notice/page/<?php echo ($currentPage-1); ?>" aria-label="Previous"><span aria-hidden="true">&laquo; 前一页</span></a></li> 
                                <!--入页码标签--> 
                            	
                            <li id="pageNext"><a href="/AppServer/Admin/System/Notice/page/<?php echo ($currentPage+1); ?>" aria-label="Next"><span aria-hidden="true">后一页 &raquo;</span></a></li>    
                          </ul>
                          
                           <div class="form-inline">
                           	   <input type="hidden" id="totalPage" value="<?php echo ($totalPage); ?>">
                               <input type="hidden" id="currentPage" value="<?php echo ($currentPage); ?>">
                               <div class="form-group">
                                   <label class="sr-only" for="exampleInputAmount">Go</label>
                                   <div class="input-group">
                                       <div class="input-group-addon" id="pageLocation">
                                       		当前:<?php echo ($currentPage); ?>/<?php echo ($totalPage); ?>
                                       </div>
                                       <input type="text" class="form-control" id="goto" placeholder="Go">
                                   </div>
                                       <button id="btnGoto" class="btn btn-primary">前往</button>
                               </div>
                           </div>                    
                        </nav>            
                    </div>   
                    
                    
                     
                      
                      
                        
                
                <!--=====================================User结束============================================-->           	 
            </div> <!--右边结束-->
                  
                    
		 </div><!--row结束-->
         
     </div><!--container-fluid结束-->         
    
    <!-- ==========隐藏域============  -->
    <input type="hidden" id="hidden" value="<?php echo ($editToken); ?>">
    
    
    
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
      
  
 <!--==========================================================页面错误模态框==============================================-->
        <div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">系统提示</h4>
              </div>
              <div class="modal-body">
                不存在此页!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" >确定</button>
              </div>
            </div>
          </div>
        </div>  
        <!--==========================================================页面错误模态框==============================================-->  
        
    
        <!--==========================================================用户操作确认模态框==============================================-->
        <div class="modal fade" id="userEditor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">系统提示</h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnClose">关闭</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnConfirm">确定</button>
              </div>
            </div>
          </div>
        </div>  
        <!--==========================================================用户操作确认模态框==============================================-->  
       
        
        <!--==========================================================Edit模态框==============================================-->
        <div class="modal fade" id="userOpera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="exampleModalLabel">修改信息</h3>
              </div>
              <div class="modal-body">
                <form action="/AppServer/Home/User/userEdit" id="editForm" method="post">
                  <div class="form-group">
                    <label>标题:</label>
                    <input type="text" class="form-control" name="title" id="title">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">内容:</label>
                    <textarea class="form-control" name="content" id="content"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">发布人:</label>
                    <select class="form-control" name="publisher" id="publisher"></select>
                    <input type="hidden" class="form-control" name="adminId" id="adminId" value="<?php echo ($adminId); ?>">
                    <input type="hidden" id="currentPage" name="currentPage" value="<?php echo ($currentPage); ?>">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" class="form-control" name="editToken" id="editToken" value="<?php echo ($editToken); ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">确定</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--==========================================================Edit模态框==============================================-->  
  
  
  
  
      
  
    <!-- Bootstrap core JavaScript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

  </body>
</html>