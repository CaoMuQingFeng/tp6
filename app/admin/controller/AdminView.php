<?php 

namespace app\admin\controller;

use app\BaseController;
use think\facade\View;

class AdminView
{
	// 管理员登陆
	public function adminLogin()
	{
		return View::fetch('index/login');
	}

	// 后台管理主页
	public function indexView()
	{
		return View::fetch('index/index');
	}

	// 添加管理员
	public function userAdd()
	{
		return View::fetch('index/adminlist');
	}
}



 ?>