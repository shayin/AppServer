<?php
namespace Common\Util;
class MyClass {
	
	public $a;
	
	public function __construct($p){
		$this->a = $p;
	}
	


	public function showA(){
		return $this->a;
	
	}
	
}