<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
use Org\Util\MyPage;
class UserController extends Controller {

	
	public function userList(){	
		if(!session('?adminId')){
			$this->error('请先登录!',__APP__.'/Admin/');
		}
		
// 		$User = D('User');
// 		$totalRow = $User->count();
// 		$pageSize = 3;                            //每页行数
// 		$totalPage = ceil($totalRow/$pageSize);	  //总页数
// 		//获取页码所对应的内容
// 		if (isset($_GET['page'])){   			  //page为当前页码
// 			$userData = $User
// 						->field('grade, student_id, name, email')
// 						->order('grade asc, student_id asc')
// 						->page($_GET['page'], $pageSize)
// 						->select();
// 			$this->assign('data', $userData);
// 			$this->assign('currentPage', $_GET['page']);
// 			$this->assign('totalPage', $totalPage);
// 		} 
	
		$table = 'User';
		$page = $_GET['page'];
		$pageSize = 3;
		$filed = array('grade', 'student_id', 'name', 'email');
		$orderDesc = array('grade', 'student_id');
		
		$pageObj = new MyPage($table, $page, $pageSize, $filed, $orderDesc);	
		$data = $pageObj->doPage();
		$this->assign('data', $data);
		$this->assign('currentPage', $_GET['page']);
		$this->assign('totalPage', $pageObj->getTotalPage());
		
		//token
		$this->assign('adminId',session('adminId'));
		$this->assign('editToken', session('token'));
		$this->display('userList');
			
	}
	
	/* 执行删除,并返回删除状态
	 * 0:无权限
	 * 1:删除成功
	 * 2:删除失败
	 * 3:非法操作(CSRF攻击)
	 */
	public function userDelete(){
// 		$myfile = fopen("E:/testfile.txt", "w");
// 		fwrite($myfile, session('token'));
// 		fclose($myfile);
		$status = 0;   
		if (session('adminId') != $_POST['admin_id']) {   //不是管理员操作,返回状态0
			$this->ajaxReturn($status);
			exit();                         
		} else {                                          //是管理员操作,			
			if($_POST['editTokenHidden']!=session('token')){        //token令牌 防止CSRF攻击
				$status = 3;							  //返回状态3	
				$this->ajaxReturn($status);
				exit();	
			} else {
				$User = D('User');
				if ($User->where('student_id='.$_POST['studentId'])->delete()){
					$status = 1;
				} else {
					$status = 2;		
				}			
				$this->ajaxReturn($status);
			}
		}
	}
	
	
	public function userEdit(){
				
		$User = D('User');
		
		if($User->where('student_id='.$_POST['student_id'])->find()&&$_POST['editId']!=$_POST['student_id']){
			//这里跳转到错误页面
			$this->error('学生学号重复!', 'javascript:history.go(-1)');	
		}
		
		if($_POST['editTokenHidden'] != session('token'))
			$this->error('非法操作!', 'javascript:history.go(-1)');
		$User->name = $_POST['name'];
		$User->email = $_POST['email'];
		$User->student_id = $_POST['student_id'];
		$User->grade = $_POST['grade'];
		if (($User->where('student_id='.$_POST['editId'])->save())<0){
			$this->error('出问题啦!', 'javascript:history.go(-1)');
		} else {
			header('location:/AppServer/Admin/User/userList/page/'.$_POST['currentPage']);
		}
			
	}
	
	public function insertUser(){
		$User = D('User');
		if($User->where('student_id='.$_POST['student_id'])->find()){
			//这里跳转到错误页面
			$this->error('学生学号重复!', 'javascript:history.go(-1)');
		} 
		if($_POST['editTokenHidden']!=session('token')){
			$this->error('非法操作!', 'javascript:history.go(-1)');
		}
		//注:因为有了token验证和js验证所以不需要判断提交空表单的情况
		$data['grade'] = $_POST['grade'];
		$data['student_id']	= $_POST['student_id'];
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		//默认密码为666666
		$data['pwd'] = md5('666666');
		if(!$User->add($data)){
			$this->error('未知错误!', 'javascript:history.go(-1)');
			exit();
		} else {				
			header('location:/AppServer/Admin/User/userList/page/1');	
		}
			
	}
	
	
	
	
}









