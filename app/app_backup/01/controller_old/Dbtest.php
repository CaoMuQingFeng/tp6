<?php 
namespace app\controller;

use think\facade\Db;

/**
 * 数据库连接，增删改查
 */
class Dbtest
{
	
	public function index()
	{
		# code...
		return "数据库的查询";
	}


	///////////
	//数据库的查询 //
	///////////

	/**
	 * 单数据查询
	 */

	// 链式查询
	public function finduser()
	{
		# code...
		$dbuser = Db::table('user')->where('id',66)->find();
		return json($dbuser);
	}

	// 最近一条SQL查询的原生语句
	public function getlastsqluser(){
		return Db::getlastsql();

	}

	// 查询一条数据，在没有数据是抛出一个错误
	public function findfail(){
		$dbuser = Db::table('user')->where('id',666)->findOrFail();
		return json($dbuser);
	}

	// 查询一条数据，在没有数据时返回一个新数组
	public function findempty(){
		$dbuser = Db::table('user')->where('id',7890)->findOrEmpty();
		return json($dbuser);
	}

	/**
	 * 数据集查询
	 */
	
	// 获取多列数据
	public function selectuser(){
		$dbuser = Db::table('user')->where('stutas',0)->select();
		return json($dbuser);
	}

	// 在所要查询的数据集中查不到任何数据会抛出一个错误
	public function selectfail(){
		$dbuser = Db::table('user')->where('stutas',1)->selectOrFail();
		return json($dbuser);
	}

	// 在 select() 方法后使用 toArray() 方法能够将数据集对象转化为数组
	public function selecttoarray(){
		$dbuserarray = Db::table('user')->where('stutas',0)->select()->toArray();
		var_dump ($dbuserarray);
	}

	// 当在数据库配置文件中使用了前缀，那么我们可以使用 name() 方法忽略前缀
	public function dbusername(){
		$dbuser = Db::name('user')-select();
		return json($dbuser);
	}

	/**
	 * 其他查询
	 */
	
	// 通过 value() 方法可以查询指定字段的值（单个），没有数据返回null
	public function dbuservalue(){
		$dbname = Db::table('user')->where('id',70)->value('name');
		return $dbname;
	}

	// 通过 colunm() 方法可以查询指定列的值（多个),没有数据返回空数组，可以指定id作为索引
	public function dbusercolumn(){
		$dbcolumn = Db::table('user')->column('name','username');
		return json($dbcolumn); 
	}

	// 为了避免内存处理太多数据出错，可以使用 chunk() 方法分批处理
	// 
	// 1.直接处理
	public function dbusernochunk(){
		$dbuser = Db::table('user')->select();
		return json($dbuser);
	}
	// 2.分批处理
	public function dbuserchunk(){
		$users = Db::table('user')->select();
		$dbuser = Db::table('user')->chunk(200,function($users){
			foreach ($users as $user){
				dump($user);
			}
			echo "ok";
		});
		return $dbuser;
	}

	// 游标查询，可以大幅度减少海量数据的内存开销，它利用了PHP生成器的特点，每次查询只读取一行，再读取时，自动定位到下一行继续读取
	public function dbusercursor(){
		$dbuser = Db::table('user')->cursor();
		foreach($dbuser as $dbusers){
			dump($dbusers);
		}
	}

	// 解决当一个实例对象第二次查询后，会保留第一次查询的值
	// 1.使用 removeOption() 方法，可以清理掉上一次查询保留的值
	public function dbuserremoveoption($idnum = 2220){
		$dbconnect = Db::table('user');
		$dbselect = $dbconnect->removeOption('where')->where('id',$idnum)->select();
		// $dbremoveoption = $dbconnect->removeOption('where')->select();
		return json($dbselect);

	}
	// // 2.使用 new 实例化对象(不可行)
	// public function dbnew($idnum = 2220){
	// 	$dbconnect =new Db::table('user')->where('id',$idnum)->select();;
	// 	// $dbselect = new $dbconnect->where('id',$idnum)->select();
	// 	return json($dbconnect);
	// }
	

	///////////
	//数据库的新增 //
	///////////
	
	/**
	 * 单数据的新增
	 */

	// 使用 insert() 方法可以向数据表中添加一条数据，更多字段采用默认
	public function dbaddinsert(){
		$data = [
			'name'	=>	'辉夜',
			'username'	=>	'huiye',
			'password'	=>	'huiye12334',
			'beizhu'	=>	'huiye666',
			'stutas'		=>	'1'
		];
		$dbconnect = Db::table('user');
		$dbuseradd = $dbconnect->insert($data);
		// $dbselect = $dbconnect->where('username',huiye)->select();
		return json($dbuseradd);

	}

	// 如果强行添加一个不存在的字段，会抛出一个异常Exception:
	// 如果强行新增抛弃不存在的字段数据，则使用 strick(false) 方法，忽略异常
	public function dbaddinsertnoexception(){
		$data = [
			'name'		=>	'小马',
			'username'	=>	'xiaoma',
			'password'	=>	'123xiaoma',
			'beizhu'	=>	'',
			'bucunzai'	=>	'123'
		];
		$dbconnect = Db::table('user');
		$teststrict= $dbconnect->strict(false)->insert($data);
		return var_dump($teststrict);
	}

	// 如果我们使用的是MySQL，则可以使用replace写入
	// insert和replace的区别是，前者表示表中存在主键相同则报错，后者则修改
	// 使用 insertGetId() 可以在新增成功后返回当前数据id
	public function dbaddreplace(){
		$data = [
			'name'		=>	'小李',
			'username'	=>	'xiaoma',
			'password'	=>	'123xiaoma',
			'beizhu'	=>	'',
			'bucunzai'	=>	'123'
		];
		$dbconnect = Db::table('user');
		$dbaddtest = $dbconnect->strict(false)->replace()->insert();
		$newdataid = $dbconnect->insertGetId($data);
		return json($newdataid);
	}
	// save() 方法是一个通用方法，可以自行判断是新增还是修改(更新)数据
	// save()方法判断是否为新增或修改的依据为，是否存在主键，不存在即新增
	public function dbaddsave(){
	$data = [
			'name'		=>	'小李',
			'username'	=>	'xiaoli',
			'password'	=>	'123xiaoma',
			'beizhu'	=>	'',
			'bucunzai'	=>	'123'
		];
	$dbconnect = Db::table('user');
	$dbaddtest = $dbconnect->strict(false)->save($data);
	$dbuserselect = $dbconnect->removeOption('where')->where('name','小李')->select();
	return json($dbuserselect);	
	}



	/////////////
	//数据库的修改删除 //
	/////////////
	

	/**
	 * 数据修改
	 */
	
	// 使用 update()方法来修改数据，修改成功返回影响行数，没有修改返回 0；
	public function dbupdate(){
		$data = [
			'username'		=>	'李白'
		];
		$dbc = Db::table('user');
		$dbupdatedata = $dbc->where('id',12200)->update($data);
		return $dbupdatedata;

	}

	// 如果修改数据包含了主键信息，比如 id，那么可以省略掉 where 条件；
		public function dbupdateandid(){
		// $data = [
		// 	'id'		=>  7800,
		// 	'name'		=>	'王龙'
		// ];
		// $dbc = Db::table('user');
		// $dbupdatedata = $dbc->update($data);
		// return json($dbupdatedata);
		return '这样写会报错，原因可能是未定义where(),不知道如何修复';
	}
	// 如果想让一些字段修改时执行 SQL 函数操作，可以使用 exp()方法实现；
	// 
	// 如果要自增/自减某个字段，可以使用 inc/dec 方法，并支持自定义步长；
	// 
	// 一个更加简单粗暴灵活的方式，使用::raw()方法实现 3，4 点的内容；
	// 
	// 使用 save()方法进行修改数据，这里必须指定主键才能实现修改功能；
	

	/**
	 * 数据删除
	 */
	
	// 这里就集合到一起了，基本都是使用delete()方法
	public function dbdelete(){
		// 1. 极简删除可以根据主键直接删除，删除成功返回影响行数，否则 0；Db::name('user')->delete(51);
		// 
		// 2. 根据主键，还可以删除多条记录；Db::name('user')->delete([48,49,50]);
		// 
		// 3. 正常情况下，通过 where()方法来删除；Db::name('user')->where('id', 47)->delete();
		// 
		// 4. 通过 true 参数删除数据表所有数据，我还没测试，大家自行测试下；Db::name('user')->delete(true);
		$dbc = Db::table('user');
		$dbdelete = $dbc->where('id',12300)->delete();
		return var_dump($dbdelete);
	}


	/////////
	//数据查询 //
	/////////
	

	/**
	 * 比较查询
	 */
	
	// 1. 查询表达式支持大部分常用的 SQL 语句，语法格式如下：where('字段名','查询表达式','查询条件');
	// 
	// 2. 在查询数据进行筛选时，我们采用 where()方法，比如 id=80；Db::name('user')->where('id', 80)->find();Db::name('user')->where('id','=',80)->find();
	// 
	public function dbuserfind(){
	$dbc = Db::table('user');
	$dbuserdata = $dbc->removeOption('where')->where('id','<>',2112)->find();

	// 用find()方法只能返回一条数据，“=”则是该条数据，“<或>”则返回比该数据大的最近一条数据，“<>”返回该条数据
	// 用select()可以返回数据集，"<或>或<>"可以返回比该数据大的，小的，大或小的数据集

	return json($dbuserdata);
	}

	/**
	 * 模糊查询
	 */
	
	// 使用 like 表达式进行模糊查询，在要模糊查询的关键词前或后加%
	// Db::name('user')->where('email','like','xiao%')->select();
	
	public function dblike(){
		$dbc = Db::table('user');
		$dbdata = $dbc->where('name','like',['%小%','%大'],'or')->select();
		return json($dbdata);
	}
	
}
 