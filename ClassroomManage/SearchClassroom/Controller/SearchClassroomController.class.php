<?php

namespace SearchClassroom\Controller;
use Think\Controller;
class SearchClassroomController extends Controller {
    // 访问模块的searchClassroom页面
    public function index(){
    	$this->display('searchClassroom');
    }

    // 执行查询
    public function search(){
    	$buildingName = $_POST['buildingName'];

    	//获取现在时间信息
    	$nowDate = date('Y-m-d',time());
    	$nowTime = date('H:i:s',time());
    	$nowWeekDay= date('l');

    	// 实例化对象
    	$Course = new \Common\Model\CourseModel();
    	$Classroom = new \Common\Model\ClassroomModel();

        // 构建关于 course 表子查询的语句
        $whereCourse['endTime'] = array('elt',$nowTime);
        $whereCourse['_logic'] = 'or';
        $mapCourse['_complex'] = $whereCourse;
        $subCourseQuery = $Course->field('course.classroomId')
            ->where($mapCourse)->buildSql();

        // 构建关于 classroom 表子查询的语句
        if ($buildingName != "所有") {
            $mapClassrooom['buildingName'] = array('eq' , $buildingName);
        }
        $classroomList  = $Classroom->field('buildingName,floor,roomNumber')
            ->where($mapClassrooom)
            ->where("classroom.classroomId IN ".$subCourseQuery)
            ->select();

        // 如果查询结果大于0则返回json格式的结果列表
        if (count($classroomList) > 0) {
        	echo  json_encode($classroomList);
        }
        else if (count($classroomList) == 0){
        	// 表示查无数据
        	echo 1;
        }
        else{
        	// 表示查询出错
        	echo 3;
        }
    }
}