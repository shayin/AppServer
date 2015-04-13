<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\MyPage;
class SystemController extends Controller {
	public function introduction(){
		$this->display();	
	}
	
	public function notice(){		
		if(!session('?adminId')){
			$this->error('请先登录!',__APP__.'/Admin/');
		}
		
		//分页参数设置
		$table = 'Notice';
		$page = $_GET['page'];
		$pageSize = 3;	
		$orderDesc = array('time');
		$filed = array('title', 'content', 'publisher', 'time');
		
		$pageObj = new MyPage($table, $page, $pageSize, $filed, $orderDesc);
		$data = $pageObj->doPage();
		
		//格式化时间输出
		foreach ($data as $key=>$value){
			$data[$key]['time'] = date('Y-m-d H:i:s',$value['time']);
		}
		
		$this->assign('data', $data);
		$this->assign('currentPage', $_GET['page']);
		$this->assign('totalPage', $pageObj->getTotalPage());
				
		//token
		$this->assign('adminId',session('adminId'));
		$this->assign('editToken', session('token'));
		
		$this->display();		

	}
	
	public function noticeEdit(){
		if(!session('?adminId')){
			$this->error('请先登录!',__APP__.'/Admin/');
		}
		
		$Notice = D('Notice');
		if(!isset($_POST['adminId'])||$_POST['adminId']!=session('adminId')){
			$this->error('出错了!',__APP__.'/Admin/System/Notice/page/'.$_POST['currentPage']);
		} 

		if($_POST['editToken'] != session('token')){
			$this->error('非法操作!', 'javascript:history.go(-1)')	;
		}
		
		$Notice->title = $_POST['title'];
		$Notice->content = $_POST['content'];
		$Notice->publisher = $_POST['publisher'];
		$Notice->time = time();
		if (($Notice->where('id='.$_POST['id'])->save())<0){
			$this->error('出问题啦!', 'javascript:history.go(-1)');
		} else {
			header('location:/AppServer/Admin/System/Notice/page/'.$_POST['currentPage']);
		}		
	}
	
	public function noticeDelete(){
		$status = 0;
		if (session('adminId') != $_POST['admin_id']){
			$this->ajaxReturn($status);
			exit();			
		} 
		if ($_POST['editToken']!=session('token')){
			$status = 3;							  //返回状态3
			$this->ajaxReturn($status);
			exit();			
		}
		$Notice = D('Notice');
		if ($Notice->where('id='.$_POST['id'])->delete()){
			$status = 1;	
		} else {
			$status = 2;
		}
		$this->ajaxReturn($status);
	}
	
	
	public function insertNotice(){
		if($_POST['editToken']!=session('token')){
			$this->error('非法操作!', 'javascript:history.go(-1)')	;
		}
		
		$Notice = D('Notice');
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$data['publisher'] = $_POST['publisher'];
		$data['time'] = time();
		if (!$Notice->add($data))
			$this->error('未知错误!', 'javascript:history.go(-1)');
		else 
			header('location:/AppServer/Admin/System/Notice/page/1');				
	}
	
	
	public  function massDelete	(){
		header('Content-type:application/json');
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$stat = array($data->currentPage);
	
		if($data->editToken!=session('token')){
			$stat[] = 3;
			$this->ajaxReturn($stat);
			exit();
		}
		
		if($data->admin_id!=session('adminId')){
			$stat[] = 0;
			$this->ajaxReturn($stat);
			exit();
		}

		foreach ($data->data as $key=>$value){
			$primary .= "{$data->data[$key]->id},";
		}
		$where = substr($primary, 0, strlen($primary)-1);

		
		$Notice = D('Notice');
		if (!$Notice->delete($primary)){
			$stat[] = 2;
			$this->ajaxReturn($stat);
			exit();
		} else {
			$stat[] = 1;
			$this->ajaxReturn($stat);
			exit();
		}
		
	}		
	
	
	
	
	
	
	
}