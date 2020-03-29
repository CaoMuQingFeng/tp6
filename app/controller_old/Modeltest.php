<?php 

namespace app\controller;

use app\model\User as UserModel;

class Modeltest{


	////////
	//模型篇 //
	////////


	public function index(){
		
		$data = UserModel::select();

		return json($data);


	}

	public function insert(){
		$user =new UserModel();
		$data = [
			'id'		=>	'1',
			'username'	=>	'zhangsan',
			'name'		=>	'好人',
			'beizhu'	=>	'alksdfj'
		];
		$msg = $user->save($data);
		var_dump($msg);
	}
}


 ?>