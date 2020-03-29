<?php 

namespace app\test\controller;

use think\facade\View;


class Index{
	public function index(){
		return View::fetch('./index');
	}
	
}


 ?>