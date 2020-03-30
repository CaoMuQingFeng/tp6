<?php 

namespace app\admin\controller;

use think\facade\Request;
use think\facade\FileSystem;
use app\admin\model\AdminUser as User;


class AdminUser
{
	// 依赖注入
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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
	public function disposeInputData()
	{
		$getData = Request::param();
		$data = [
			'code'	=> 0,
			'msg'	=> 'ok',
			'data'	=> $getData
		];
		return json($data);
	}
}

 ?>