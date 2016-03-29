<?php
namespace MySchedule\Controller;
use Think\Controller;
class MyScheduleController extends Controller {
    // 访问模块的mySchedule页面
    public function index(){
        $this->display("mySchedule");
    }

    // 查找我的计划
    public function searchMySchedule(){
        // 实例化
    	$User = new \Common\Model\UserModel();
    	$mapUser['userName'] = array('eq',$_POST['userName']);

    	try {
            // 执行sql查询
    		$schedule = $User->field('mySchedule')->where($mapUser)->select();

    		if (count($schedule) > 0) {
                // 以json格式返回查询的结果
    			echo json_encode($schedule);
    		}
    		else{
    			echo 1;
    		}
    	}
    	catch (Exception $e) {
			echo 3;
    	}
    }

    // 修改我的计划
    public function modify(){
    	$User = new \Common\Model\UserModel();
    	$mapUser['userName'] = array('eq',$_POST['userName']);
    	$data['mySchedule'] = $_POST['mySchedule'];

    	try {
    		$resultNum = $User->where($mapUser)->data($data)->save();
    		// echo $User->getLastSql();
    		if ($resultNum >= 0) {
    			echo 0;
    		}
    		else{
    			echo 1;
    		}
    	}
    	catch (Exception $e) {
			echo 3;
    	}
    }
}