<?php
namespace Common\Model;
use Think\Model;
/**
*Course 的模型类
*/
class CourseModel extends Model
{
	// 这个地方的connection只能用这个名称而且必须定义这个变量，否则不识别报错
	protected $connection = 'DB_CONFIG';
}