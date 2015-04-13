<?php
namespace Home\Controller;
use Think\Controller;
use Org\Net\IpLocation;
use Common\Util\PublicController;
use Think\Verify;

class IndexController extends PublicController {
    public function index(){
    	$this->newList();                   //获取课程公告数据
    	$this->introduction();              //获取课程介绍
		$this->display();
    }
    
    //获取课程公告数据
    private function newList(){
    	$Notice = D('Notice');
    	$newData = $Notice->limit(6)->select();
    	foreach ($newData as $key=>$value){
    		$newData[$key]['time'] = date('Y/m/d', $newData[$key]['time']);
    	}
    	$this->assign('newData', $newData);
    }
    
    //获取课程介绍
    private function introduction(){
    	$Introduction = D('Introduction');	
    	$introduction = $Introduction->where('status=1')->find();
		$this->assign('introduction', $introduction);
    }
    
    //登录
    public function login(){
    	
// 		$f = fopen('E:/test.txt', 'w');
// 		fwrite($f, mPost('pwd').mPost('user'));

    	$User = D('User');
    	$where['student_id'] = mPost('user');
    	$where['pwd'] =  mPost('pwd');
    	$verifyCode = mPost('verifyCode');
		$result = $User->where($where)->find();
		
		//验证码
		$verify = new Verify();
		if (!$verify->check($verifyCode, '')){
			$this->ajaxReturn(-1);
			exit();	
		}
		
		//验证登录
		if(!$result){
			$this->ajaxReturn(0);
		} else {
			$this->ajaxReturn(1);
			session('student_id',$where['student_id']);
		}
    	
    }
    
   
    
}


