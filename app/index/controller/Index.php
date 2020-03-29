<?php 

namespace app\index\controller;

use think\facade\View;

class Index{
	public function index(){
		return View::fetch('index');
	}
	public function ui_elements(){
		return View::fetch('ui_elements');
	}
}



 ?>