<?php
return array(
	//'配置项'=>'配置值'
	'SESSION_AUTO_START' => true, //是否开启session

	// 数据库配置
	'DB_CONFIG' =>   array(
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'classroomManage_db', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => '1234', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => '', // 数据库表前缀
		'DB_CHARSET'=> 'utf8', // 字符集
	),
);