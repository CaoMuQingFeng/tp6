<?php 

namespace app\admin\controller;

class AdminMenu
{
	public function index()
	{
		$data = 
		[
			"code"	=>	0,
			"msg"	=>	"0",
			"data"	=>	
			[
				[
					"name"	=>	"console",
					"title"=>	"控制台",
					"icon"	=>	"layui-icon-console",
					"jump"	=>	'',
					"spread"=>	true,
					"list"	=>	
					[
						[
							"name"	=>	"user",
							"title"=>	"用户中心",
							"icon"	=>	"layui-icon-username",
							"jump"	=>	''
						],
						[
							"name"	=>	"bill",
							"title"=>	"我的账单",
							"icon"	=>	"layui-icon-rmb",
							"jump"	=>	''
						],
						[
							"name"	=>	"server",
							"title"=>	"我的服务",
							"icon"	=>	"layui-icon-app",
							"jump"	=>	''
						]
					]
				],
				[
					"name"	=>	"user_control",
					"title"=>	"用户管理",
					"icon"	=>	"layui-icon-user",
					"jump"	=>	'',
					"list"	=>	
					[
						[
							"name"	=>	"user_list",
							"title"=>	"用户列表",
							"icon"	=>	"layui-icon-group",
							"jump"	=>	''
						],
						[
							"name"	=>	"user_admin_list",
							"title"=>	"管理员列表",
							"icon"	=>	"layui-icon-friends",
							"jump"	=>	''
						],
						[
							"name"	=>	"user_set",
							"title"=>	"用户设置",
							"icon"	=>	"layui-icon-set-fill",
							"jump"	=>	''
						]
					]

				]

			]
		];
		return json($data);
	}
}

 ?>
