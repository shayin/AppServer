<?php

/*
 * 公共控制器类
 */

namespace Common\Util;
use Think\Controller;
use Think\Verify;


class PublicController extends Controller {
	

	//验证码处理
	public function verify(){
		$Verify = new Verify();
		$Verify->length = 3;
		$Verify->useNoise = false;
		$Verify->useCurve = false;
// 		$Verify->imageW = 50;
		$Verify->imageH = 25;
		$Verify->fontSize = 12;
		$Verify->entry();
	}
	
	
}