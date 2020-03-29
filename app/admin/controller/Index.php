<?php 

namespace app\admin\controller;

use think\facade\View;

class Index{
	public function index(){
		return View::fetch('index');
	}

	public function product(){
		return View::fetch('product');
	}
	
	public function updatepwd(){
		return View::fetch('updatePwd');
	}
}



 ?>