<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Net\IpLocation;
class IndexController extends Controller {
    public function index(){
		$this->display();
    }
    
    public function login(){
    	//读取json数据并解析
    	$json = file_get_contents('php://input');
    	$data = json_decode($json);
    	
 		//根据客户端提交的数据进行数据库查询
    	$User = D('Admin');
    	$where['admin_id'] =$data->admin_id;
    	$where['pwd'] = $data->pwd;
		$result = $User->where($where)->find();
		$len = count($result);
		if ($len == 0) {
			$code = -1; //查询不到
		} else{
			$code = 1;  //查询到
			setTokenSession();
			session('adminId',$data->admin_id);
			//IP定位
			$ip = get_client_ip();
			$ipObj = new IpLocation('UTFWry.dat');
			$area = $ipObj->getlocation($ip);
			$Loginrecord = D('Loginrecord');
			$record = array(
					'ip' => $area['ip'],
					'location' => $area['country'].$area['area'],
					'time' => time(),
					'admin_id'=> $data->admin_id, 
			);
			$Loginrecord->add($record);
		}
		//返回ajax登录状态
		$this->ajaxReturn($code);
    }
    
}


