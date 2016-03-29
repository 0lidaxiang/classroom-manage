<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>修改课表</title>
	<meta charset="utf-8" name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			sessionStorage.clear();
			loadMyCourse();
		});

		$(document).bind("mobileinit", function() {
            //disable ajax nav
            $.mobile.ajaxEnabled=false;
        });
        function returnMain(){
        	sessionStorage.clear();
        	window.location.href="/classroomManage/index.php/main";
        }
        function loadMyCourse(){
        	var userName = localStorage.getItem("userName",userName);
        	sessionStorage.clear();

			var parms={
			    "userName":userName,
			};

			$.ajax({
			    type:"post",
			    url:"/classroomManage/classSchedule.php/searchMyCourse",
			    data:parms,
			    // dataType:"json",

			    success:function(responseData){
			        //fortest: alert(responseData);
			        alert(responseData);
			        sessionStorage.setItem("responseData",responseData);
			  //       var courseList = responseData;
			  //       if (courseList == 1) {
					// 	alert("查无数据!");
					// }
					// else{
					// 	alert("查询到 "+ courseList.length + " 个结果!");
					// 	// sessionStorage.setItem("roomName",roomName);
					// 	// sessionStorage.setItem("courseList",JSON.stringify(data));

					// 	$("#tableTitle").html(userName + "的课表");
			  // 			for (var i = 0;i <= courseList.length - 1; i++) {
			  // 				var tr = "<tr><td >" + (i+1) + "</td><td>"
			  // 						+ courseList[i]['courseName'] + "</td><td>"
					// 				+ courseList[i]['startTime'] + "</td><td>"
					// 				+ courseList[i]['endTime'] + "</td></tr>";
					// 		$("#listTable tr:last").after(tr);
					// 	}
					// 	// window.location.href="/classroomManage/classSchedule.courseResult";
				 //    }
			    }
			});
        }
    </script>
	<link rel="stylesheet" href="/ClassroomManage/ClassroomManage/Common/js/
	jquery.mobile-1.3.2.css">
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery-2.1.4.min.js"></script>
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery.mobile-1.3.2.js"></script>

	<style type="text/css">
		.foot
		{
			bottom: 0;
			height: 11%;
		}
		.loginoutlink
		{
			width: 100%;
			margin-top: 0px;
			height: 100%;
		}
		.loginoutbtn
		{
			color: #db3b3b;
			font-size: 18px;
		}
	</style>

</head>
<body>
	<div data-role="page">
		<div class="headcss" data-role="header" data-position="fixed">
			<h1 class="fontSize28css" >我的课表</h1>
		</div>

		<div data-role="content" class="contentStyle">
			<table id="listTable">
				<caption id="tableTitle" align="top"></caption>
				<tr style="max-width: 100%;min-width: 100%;">
				<th style="max-width: 25%;min-width: 25%;">序号</th>
				<th style="max-width: 25%;min-width: 25%;">课程名称</th>
				<th style="max-width: 25%;min-width: 25%;">上课时间</th>
				<th style="max-width: 25%;min-width: 25%;">下课时间</th>
				</tr>
			</table>


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