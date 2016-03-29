<?php
namespace Common\Model;
use Think\Model;
/**
*Time 的模型类
*/
class TimeModel extends Model
{
	// 这个地方的connection只能用这个名称而且必须定义这个变量，否则不识别报错
	protected $connection = 'DB_CONFIG';
}