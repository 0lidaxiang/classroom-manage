<?php
namespace Common\Model;
use Think\Model;
/**
*User 的模型类
*/
class UserModel extends Model
{
	// 这个地方的connection只能用这个名称而且必须定义这个变量，否则不识别报错
	protected $connection = 'DB_CONFIG';

	// 定义了user表的字段，程序会在访问数据库之前这里先过滤
	protected $fields = array(
		'id','userName','password','courseNames','coursePlaces','mySchedule',
		'_pk' => 'id','_autoinc' => true);
}