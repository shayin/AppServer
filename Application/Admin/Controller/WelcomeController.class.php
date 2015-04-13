<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Net\IpLocation;
class WelcomeController extends Controller {
	public function welcome(){
		//本次登录ip定位
		$ip = get_client_ip();
		$ipObj = new IpLocation('UTFWry.dat');
		$area = $ipObj->getlocation($ip);
		$this->assign('ip',$area['ip']);
		$this->assign('location',$area['country'].$area['area']);
		
		//上次登录ip定位
		$Loginrecord = D('Loginrecord');
		$result = $Loginrecord->where('admin_id='.session('adminId'))->limit(1,1)->order('time desc')->select();
		$this->assign('queryIp',$result[0]['ip']);
		$this->assign('queryLocation',$result[0]['location']);
		
		$this->display();
	}
}