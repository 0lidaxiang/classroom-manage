<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>NJCIT教室管理系统</title>
	<meta charset="utf-8" name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			sessionStorage.clear();
		});

		$(document).bind("mobileinit", function() {
            //disable ajax nav
            $.mobile.ajaxEnabled=false;
        });
        function returnMain(){
        	sessionStorage.clear();
        	window.location.href="/classroomManage/index.php/main";
        }
        // 这个页面用不到
        // function returnToLast(){
        // 	sessionStorage.clear();
        // 	// window.location.href="/classroomManage/index.php/main";
        // 	history.back(-1);
        // }

        function searchClassroom(){
				var buildingName = $("#buildingName").val().trim();
				var weekDay = $("#weekDay").val().trim();
				var startTime = $("#startTime").val().trim();
				var endTime = $("#endTime").val().trim();

				sessionStorage.clear();

				var parms={
			        "buildingName":buildingName,
			        "weekDay":weekDay,
			        "startTime":startTime,
			        "endTime":endTime,
			    };

			    $.ajax({
			        type:"post",
			        url:"/classroomManage/generalQuery.php/searchClassroom/",
			        data:parms,
			        dataType:"json",

			        success:function(responseData){
			            //fortest: alert(responseData);
			            //alert(responseData);
			            var data = responseData;
			            if (data == 1) {
							alert("查无数据!");
						}
						else if (data == 3) {
							alert("查询出错!");
						}
						else{
							alert("查询到 "+data.length + " 个结果!");
							// var test = data[0]['roomNumber'];
							// alert("test :"+test);
							sessionStorage.setItem("classroomList",JSON.stringify(data));
							window.location.href="/classroomManage/generalQuery.php/generalQueryResult";
			            }
			        }
			    });
		}

		function searchCourse(){
			var courseBuildingName = $("#courseBuildingName").val();
			var courseWeekDay = $("#courseWeekDay").val();
			var roomName = $("#roomName").val();

			if (roomName == "") {
				alert("教室名称不能为空！");
				return;
			}
			else{
				// alert(roomName);
				sessionStorage.clear();

				var parms={
			        "courseBuildingName":courseBuildingName,
			        "courseWeekDay":courseWeekDay,
			        "roomName":roomName,
			    };

			    $.ajax({
			        type:"post",
			        url:"/classroomManage/generalQuery.php/searchCourse/",
			        data:parms,
			        dataType:"json",

			        success:function(responseData){
			            //fortest: alert(responseData);
			            // alert(responseData);
			            var data = responseData;
			            if (data == 1) {
							alert("查无数据!");
						}
						else{
							alert("查询到 "+data.length + " 个结果!");
							sessionStorage.setItem("roomName",roomName);
							sessionStorage.setItem("courseList",JSON.stringify(data));
							window.location.href="/classroomManage/generalQuery.php/courseResult";
			            }
			        }
			    });
			}
		}
	</script>

	<link rel="stylesheet" href="/ClassroomManage/ClassroomManage/Common/js/
	jquery.mobile-1.3.2.css">

	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery.mobile-1.3.2.js"></script>

	<style type="text/css">
		.headcss{
			height:10%;
			font-size:20px;
			text-align: center;
		}
		.contentStyle
		{
			padding: 10px;position: relative;
			height: 430px;
		}

		/*.forTitleLabel{
			font-weight:bold;
			font-size: 18px;
		}*/

		.searchbtn{
			width: 45%;
			height: 9%;
			margin-top: 8%;
			margin-left: 26%;
		}
		.foot
		{
			bottom: 0;
			height: 10%;
		}
		.loginoutlink
		{
			width: 100%;
			margin-top: 0px;
			height: 100%;
		}
		.loginoutbtn
		{
			color: #fff;
			margin-top: 9px;
			font-size: 20px;
		}
	</style>

</head>
<body>
<!-- 搜索空教室的页面 -->
	<div data-role="page"  id="pageSearchClassroom" class="pagecss" >

		<div class="headcss" data-role="header" data-position="fixed" data-tap-toggle="false">
			<div style="margin-top: 18px;">综合查询</div>
		</div>
		<!-- 导航栏 -->
		<div data-role="navbar">
	       <ul>
		        <li><a href="#" data-icon="search" class="ui-btn-active ui-
		        	state-persist" data-ajax='false'>搜教室</a></li>
		        <li><a href="#pageSearchCourse" data-icon="search"
		        	data-ajax='false'>搜教室课表</a></li>
	       </ul>
    	</div>

		<!-- <label class="forTitleLabel"></label> -->
		<h4>查询空教室：</h4>
		<div data-role="content" class="contentStyle">
			<fieldset data-role="fieldcontain">
				<label for="buildingName">选择楼宇：</label>
    			<select name="buildingName" id="buildingName">
			      	<option value="1号教学楼"> 1号教学楼 </option>
		         	<option value="2号教学楼"> 2号教学楼 </option>
		         	<option value="3号教学楼"> 3号教学楼 </option>
		         	<option value="1号实训楼"> 1号实训楼 </option>
		         	<option value="2号实训楼"> 2号实训楼 </option>
         			<option value="资讯科技楼">资讯科技楼</option>
         			<option value="国交中心">  国交中心  </option>
    			</select>
    		</fieldset>

			<fieldset data-role="fieldcontain">
				<label for="weekDay">选择星期：</label>
    			<select name="weekDay" id="weekDay">
    				<option value="all" selected>不限</option>
			      	<option value="Monday">星期一</option>
		         	<option value="Tuesday">星期二</option>
		         	<option value="Wednesday">星期三</option>
		         	<option value="Thursday">星期四</option>
		         	<option value="Friday">星期五</option>
         			<option value="Saturday">星期六</option>
         			<option value="Sunday">星期日</option>
    			</select>
    		</fieldset>

    		<fieldset data-role="fieldcontain">
				<label for="startTime">从：</label>
    			<select name="startTime" id="startTime">
			      	<option value="08:00:00" selected>第一节课</option>
		         	<option value="08:55:00">第二节课</option>
		         	<option value="10:10:00">第三节课</option>
         			<option value="11:05:00">第四节课</option>
         			<option value="13:30:00">第五节课</option>
         			<option value="14:25:00">第六节课</option>
         			<option value="15:20:00">第七节课</option>
         			<option value="16:25:00">第八节课</option>
         			<option value="18:00:00">第九节课</option>
         			<option value="18:55:00">第十节课</option>
         			<option value="19:50:00">第十一节课</option>
    			</select>
    		</fieldset>

    		<fieldset data-role="fieldcontain">
				<label for="endTime">到：</label>
    			<select name="endTime" id="endTime">
			      	<option value="08:45:00">第一节课</option>
		         	<option value="09:40:00">第二节课</option>
		         	<option value="10:55:00">第三节课</option>
         			<option value="11:50:00">第四节课</option>
         			<option value="14:15:00">第五节课</option>
         			<option value="15:10:00">第六节课</option>
         			<option value="16:15:00">第七节课</option>
         			<option value="17:10:00" selected>第八节课</option>
         			<option value="18:45:00">第九节课</option>
         			<option value="19:40:00">第十节课</option>
         			<option value="20:35:00">第十一节课</option>
    			</select>
    		</fieldset>
			<a href="javascript:searchClassroom()" class="searchbtn" data-role="button" data-icon="search">
				<div class="">搜索教室</div>
			</a>
  		</div>

		<div class="foot" data-role="footer"
		data-position="fixed"  ><!-- data-fullscreen="true" -->
			<a href="javascript:returnMain()" class="loginoutlink" data-transition="flow"
				data-role="button" data-inline="true" data-corners="false">
				<div class="loginoutbtn">返回主菜单</div>
			</a>
		</div>
	</div>

<!-- 搜索课程信息的页面 -->
	<div data-role="page" id="pageSearchCourse" class="pagecss" >
		<div class="headcss" data-role="header" data-position="fixed" data-tap-toggle="false">
			<div style="margin-top: 18px;">综合查询</div>
		</div>
		<div data-role="navbar">
	        <ul>
		        <li><a href="#pageSearchClassroom" data-icon="search" data-ajax='false'>搜教室</a></li>
		        <li><a href="#" data-icon="search" class="ui-btn-active ui-state-persist" data-ajax='false'>搜教室课表</a></li>
	        </ul>
    	</div>

		<!-- <label class="forTitleLabel">查询课程信息：</label> -->
		<h4>查询教室课表：</h4>
		<div data-role="content" class="contentStyle">
			<fieldset data-role="fieldcontain">
				<label for="courseBuildingName">选择楼宇：</label>
    			<select name="courseBuildingName" id="courseBuildingName">
			      	<option value="1号教学楼"> 1号教学楼 </option>
		         	<option value="2号教学楼"> 2号教学楼 </option>
		         	<option value="3号教学楼"> 3号教学楼 </option>
		         	<option value="1号实训楼"> 1号实训楼 </option>
		         	<option value="2号实训楼"> 2号实训楼 </option>
         			<option value="资讯科技楼">资讯科技楼</option>
         			<option value="国交中心">  国交中心  </option>
    			</select>
    		</fieldset>

			<fieldset data-role="fieldcontain">
				<label for="courseWeekDay">选择星期：</label>
    			<select name="courseWeekDay" id="courseWeekDay">
			      	<option value="Monday">星期一</option>
		         	<option value="Tuesday">星期二</option>
		         	<option value="Wednesday">星期三</option>
		         	<option value="Thursday">星期四</option>
		         	<option value="Friday">星期五</option>
         			<option value="Saturday">星期六</option>
         			<option value="Sunday">星期日</option>
    			</select>
    		</fieldset>

    		<fieldset data-role="fieldcontain">
    			<label for="roomName">教室名称：</label>
    			<input type="text" name="roomName" id="roomName">
    		</fieldset>
			<a href="javascript:searchCourse()" class="searchbtn" data-role="button" data-icon="search">
				<div>搜索课表</div>
			</a>
  		</div>

		<div class="foot" data-role="footer"
		data-position="fixed"  ><!-- data-fullscreen="true" -->
			<a href="javascript:returnMain()" class="loginoutlink" data-transition="flow"
				data-role="button" data-inline="true" data-corners="false">
				<div class="loginoutbtn">返回主菜单</div>
			</a>
		</div>
	</div>
</body>
</html>