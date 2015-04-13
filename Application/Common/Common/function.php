<?php

	/*
	 *   获取token码
	 */
	function getToken(){
		$str = '#%@'.time().session('admin_id');
		$token = md5($str);
		return $token;	
	}
	
	/*
	 * 	设置session token
	 */
	function setTokenSession(){
		if(!session('?token')){
			session('token', getToken());	
		}
	}
	
	
	/*
	 *   处理GET POST参数
	 */
	function mGet($name){
		$val = isset($_GET[$name])?$_GET[$name]:'';
		return $val;
	}
	
	function mPost($name){
		$val = isset($_POST[$name])?$_POST[$name]:'';
		return $val;
	}
	
	

	
	
	
	
	
