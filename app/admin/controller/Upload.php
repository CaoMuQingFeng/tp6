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
		// 获取到上传文件
		$file = Request::file('file');

		// 将获取到的文件（图片）写入磁盘
		$info = FileSystem::putFile('topic',$file);

		// 获取文件名
		$fileName = substr($info,-36);

		if(!$file){
			$data = [
			'code'	=> 1,
			'msg'	=> '上传失败',
			'data'	=> [
				'src'	=> '上传失败'
				]
			];
			return $data;
		}else{

		
			$data = [
				'code'	=> 0,
				'msg'	=> '上传成功',
				'data'	=> [
					'src'	=> $fileName,
					'info'	=> $info
					]
				];
			return json($data);
		}
	}
}

 ?>