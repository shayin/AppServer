<?php
namespace Org\Util;


/*
 * 分页类  返回-1失败 返回二维数组成功
 */

class MyPage {

	public $table;
	public $page;
	public $totalRow;
	public $pageSize;
	public $totalPage;
	public $filed;
	public $orderDesc;
	
	
	public function __construct($table, $page, $pageSize, $filed, $orderDesc){
		$this->table = $table;
		$this->page = $page;
		$this->pageSize = $pageSize;
		$this->filed = $filed;
		$this->orderDesc = $orderDesc;		
	}
	
	public function doPage(){
		$pageModel = D($this->table);
		$this->setTotalRow($pageModel->count());
		$this->setTotalPage($this->getTotalRow(), $this->pageSize);
		if(!isset($this->page)||!$pageModel){
			return -1;	
		}
		foreach ($this->field as $key=>$value){
			if($key == 0)
				$fieldSql = $value;
			else 
				$fieldSql = $fieldSql.','.$value;			
		}	
		foreach ($this->orderDesc as $key=>$value){
			if($key == 0)
				$orderSql = $value.' DESC';
			else 
				$orderSql = $orderSql.','.$value.' DESC';
		}	
		$data = $pageModel
				->field($fieldSql)
				->order($orderSql)
				->page($this->page, $this->pageSize)
				->select();		
		return $data;
	}
	
	public function setTotalRow($totalRow){
		$this->totalRow = $totalRow;
	}
	
	public function getTotalRow(){
		return $this->totalRow;
	}
	
	public function setTotalPage($totalRow, $pageSize){
		$this->totalPage = ceil($totalRow/$pageSize);
	}
	
	public function getTotalPage(){
		return $this->totalPage;
	}

	
}