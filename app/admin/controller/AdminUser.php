<?php 

namespace app\admin\controller;

use think\facade\Request;
use think\facade\FileSystem;


class AdminUser
{
	public function getInputData()
	{
		$getData = Request::param();
		$data = [
			'code'	=> 0,
			'msg'	=> 'ok',
			'data'	=> ''
		];
		return json($data);
	}
	public function getUserAvatar()
	{
		$file = Request::file('avatar');
		FileSystem::putFile('topic',$file);
		$data = [
			'code'	=> 0,
			'msg'	=> 'ok',
			'data'	=> ''
		];
		return json($data);
	}
}

 ?>