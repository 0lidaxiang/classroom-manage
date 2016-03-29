<?php
namespace GeneralQuery\Controller;
use Think\Controller;
class GeneralQueryController extends Controller {
	// 访问下面定义的模块主页
    public function index(){
    	 $this->display("generalQuery");
    }

    // 搜索教室
    public function searchClassroom(){
    	$buildingName = $_POST['buildingName'];
    	$weekDay = $_POST['weekDay'];
    	$startTime = $_POST['startTime'];
    	$endTime = $_POST['endTime'];

    	// 实例化对象
    	$Course = new \Common\Model\CourseModel();
    	$Classroom = new \Common\Model\ClassroomModel();

		if (strcmp($weekDay,"all") != 0) {
			// 构建关于 course 表子查询的语句
	    	$whereCourse['startTime'] = array('egt',$endTime);
	    	$whereCourse['endTime'] = array('elt',$startTime);
	    	$whereCourse['_logic'] = 'or';
	    	$mapCourse['_complex'] = $whereCourse;
			$con = "weekDay = '".$weekDay."'";
			$subCourseQuery = $Course->field('course.classroomId')
				->where($con)
				->where($mapCourse)->buildSql();

			// 构建关于 classroom 表子查询的语句
			$mapClassrooom['buildingName'] = array('eq' , $buildingName);
	    	$classroomList	= $Classroom->field('buildingName,floor,roomNumber')
	    		->where($mapClassrooom)
	    		->where("classroom.classroomId IN ".$subCourseQuery)
	    		->select();
		}
		else{
	    	// 构建关于 course 表子查询的语句
	    	$whereCourse['startTime'] = array('egt',$endTime);
	    	$whereCourse['endTime'] = array('elt',$startTime);
	    	$whereCourse['_logic'] = 'OR';
	    	// $mapCourse['_complex'] = $whereCourse;
			$subCourseQuery = $Course->field('course.classroomId')
				->where($mapCourse)->buildSql();

			// 构建关于 classroom 表子查询的语句
			$mapClassrooom['buildingName'] = array('eq' , $buildingName);
	    	$classroomList	= $Classroom->field('buildingName,floor,roomNumber')
	    		->where($mapClassrooom)
	    		->where("classroom.classroomId IN ".$subCourseQuery)
	    		->select();


		}
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

	//搜索课程
	public function searchCourse(){
		$buildingName = $_POST['courseBuildingName'];
    	$weekDay = $_POST['courseWeekDay'];
    	$roomNumber = $_POST['roomName'];

    	// 实例化对象
    	$Course = new \Common\Model\CourseModel();
    	$Classroom = new \Common\Model\ClassroomModel();

		// 构建关于 classroom 表子查询的语句
		$mapClassrooom['buildingName'] = array('eq' , $buildingName);
		$mapClassrooom['roomNumber'] = array('eq' , $roomNumber);
	    $subCourseQuery	= $Classroom->field('classroomId')
	    	->where($mapClassrooom)
	    	->buildSql();

	    // 构建关于 course 表子查询的语句
	    $con = "weekDay = '".$weekDay."'";
	    $courseList	= $Course->field('courseName,startTime,endTime')
	    	->where($con." AND classroomId IN ".$subCourseQuery)
	    	->select();


	    if (count($courseList) > 0) {
	     	echo  json_encode($courseList);
	    }
	    else if (count($courseList) == 0){
	     	// 表示查无数据
	     	echo 1;
	    }
	    else{
	     	// 表示查询出错
	     	echo 3;
	    }
	}
}