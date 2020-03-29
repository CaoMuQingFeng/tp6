<?php 

namespace app\admin\controller;

use think\facade\Db;

class UserList
{
	public function getUserList()
	{
    $db_data = Db::table('ntp_admin_user')->select();
		
  	$data = [
      'code'  => 0,
      'msg'   => '',
      'data'  => $db_data
  ];
		return json($data);


	}
	

}

 ?>