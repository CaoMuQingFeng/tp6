<?php 

namespace app\admin\controller;

use think\facade\Db;

class UserList
{
	public function getUserList()
	{
		
	$data = '{
  "code":"0"
  ,"msg": ""
  ,"count": "100"
  ,"data": [{
    "id": "001"
    ,"username": "用户-1"
    ,"avatar": "https://wx4.sinaimg.cn/mw1024/5db11ff4gy1fmx4keaw9pj20dw08caa4.jpg"
    ,"phone": 12345678901
    ,"email": "11111@qq.com"
    ,"sex": "男"
    ,"ip": "1111111"
    ,"jointime": 20171204
  }';
		return $data;


	}
	

}

 ?>