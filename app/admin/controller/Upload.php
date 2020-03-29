<?php 

namespace app\admin\controller;

use think\facade\Request;
use think\facade\FileSystem;

/**
 * 上传控制器
 */
class Upload
{
	
	public function getUserAvatar()
	{
		$file = Request::file('avatar');
		$data = [
			'code'	=> 0,
			'msg'	=> 'ok',
			'data'	=> '123'
		];
		return json($data);
	}
}

 ?>