<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'appserver',
	'DB_USER' => 'root',
	'DB_PWD'  => '',
	'DB_PORT' => '3306',
	'DB_PREFIX' => 'as_',
		
	//trace模式	
	'SHOW_PAGE_TRACE' =>true,

	//URL模式--重写模式
	'URL_MODEL' => '2',
	'URL_HTML_SUFFIX'=>'',
		
	//成功,错误跳转对应模板文件
	'TMPL_ACTION_ERROR' => 'Public:error',
	'TMPL_ACTION_SUCCESS' => '',
// 	'TMPL_EXCEPTION_FILE'   =>  '',

		
	//路由定义
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(    
			
	),
		

	//模板定界符
// 	'TMPL_L_DELIM'    =>    '<{',
// 	'TMPL_R_DELIM'    =>    '>}'

		
	
		
		
);