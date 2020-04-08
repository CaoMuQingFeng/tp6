<?php 

namespace app\admin\controller;

use think\facade\Request;
use app\admin\controller\UploadToKsust;
use think\facade\FileSystem;
use app\admin\model\AdminUser as User;
use app\admin\controller\Upload;


class AdminUser
{
	// 依赖注入
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    // 测试
    public function testFun()
    {
    	$test = new UploadToKsust();
//    	]);
        $data = [
            'ksustDir' => '213',
            'file'     => '123'
        ];
        return $test->uploadFile($data);

    }
	// 返回admin_user表中的所有数据
	public function putAllData()
	{
		// 获取data
		$data = $this->user->select();
		$dataValue = $data;

		// 返回规则
		$data = [
			'code'	=> 0,
			'msg'	=> '',
			'data'	=> $dataValue
		];

		// 返回数据
		return json($data);

	}
	public function saveInputData()
	{
		$disposeData = new Upload();
		$getData = Request::param();
		$writeData = $this->user->create($getData);
		$userData = $this->user->where('username',$getData['username'])->find();
		$avatarData['id'] = $userData['id'];
		$avatarData['fileName'] = $userData['avatar'];
		$disposeData->disposeUserAvatar($avatarData);
		
		$data = [
			'code'	=> 0,
			'msg'	=> 'ok',
			'data'	=> ''
		];
		return json($data);
	}
}   

 ?>