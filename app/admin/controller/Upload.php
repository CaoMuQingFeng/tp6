<?php 

namespace app\admin\controller;

use think\facade\Request;
use think\facade\FileSystem;
use app\admin\controller\UploadToKsust;

/**
 * 上传控制器
 */
class Upload
{
	// 接受头像图片并写入磁盘，返回图片名
	public function getUserAvatar()
	{
		// 获取到上传文件
		$file = Request::file('file');

		// 将获取到的文件（图片）写入磁盘
		$info = FileSystem::disk('avatar')->putFile('avatar',$file,'md5');


		// 获取文件名
		// $fileName = substr($info,-36);
		$fileName = str_replace('\\', '/', $info);

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

	// 接收与头像匹配的用户信息并处理，传递
	public function disposeUserAvatar($avatarData)
	{
		$ksust = new UploadToKsust();
		$imgUrl = 'http://tp6.com/public/uploads/'.$avatarData['fileName'];
		$info = [
			'createDirUrl'		=> 'https://kstore.ksust.com/api/v1/file/create',
			'createDirTimeout'	=> 5,
			'createDirData' 	=> [
				'access_token'	=> '1003-df62803a14644db895bdde7515d36633',
				'fileId'		=> '3096',
				'name'			=> $avatarData['id']
			],
			'uploadImgTimeout'	=> 6,
			'uploadImgData'		=> [
				'access_token'	=> '1003-df62803a14644db895bdde7515d36633',
				'file'			=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQt7HWgrL1pGIbdzgXkTIDcLkoFE6-DTxvSd-gRvRp60_MpJKLa&usqp=CAU'
			]

		];
		$ksust->curlUpload($info);
	}
}

 ?>