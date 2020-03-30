<?php
namespace app\admin\model;

use think\Model;

class AdminUser extends Model
{
	protected $schema = [
	    'id'          		=> 'int',
	    'avatar'			=> 'string',
	    'username'    		=> 'string',
	    'password'      	=> 'string',
	    'password_salt' 	=> 'string',
	    'phone'				=> 'int',	
	    'email'				=> 'string',
	    'last_login_ip'		=> 'string',
	    'last_login_time'	=> 'int',		
	    'create_time' 		=> 'datetime',
	    'update_time' 		=> 'datetime',
	    ];
}