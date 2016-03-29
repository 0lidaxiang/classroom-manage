<?php
namespace ClassSchedule\Controller;
use Think\Controller;
class ClassScheduleController extends Controller {
    // 访问下面定义的模块主页
    public function index(){
        $this->display("myCourse");
    }

    // 查找自己的课表
    public function searchMyCourse(){
        $userName = $_POST['userName'];

    	// 实例化对象
    	$User = new \Common\Model\UserModel();

		// 构建关于 user 表的查询语句
		$mapUser['userName'] = array('eq' , $userName);

	    $scheduleList = $User->field('courseNames,coursePlaces')
	    	->where($mapUser)
	    	->select();

		// echo $User->getLastSql();
	    if (count($scheduleList) > 0) {
	     	echo  json_encode($scheduleList);
	    }
	    else if (count($scheduleList) == 0){
	     	// 表示查无数据
	     	echo 1;
	    }
	    else{
	     	// 表示查询出错
	     	echo 3;
	    }
    }

    // 修改数据库中的课表信息
    public function modifySchedule(){
    	$User = new \Common\Model\UserModel();

    	// 构建关于 user 表的查询语句
    	$userName = $_POST['userName'];

		$data['courseNames'] = $_POST['strName'];
		$data['coursePlaces'] = $_POST['strPlace'];

    	try{
    		$resultNum = $User->where("userName = '".$userName."'")->data($data)->save();
    		if ($resultNum >= 0) {
                // 查询结果大于或等于0说明执行查询操作成功
    			echo 0;
    		}
    		else{
    			echo 1;
    		}

    	}
    	catch(Exception $e){
    		echo 3;
    	}
    }
}