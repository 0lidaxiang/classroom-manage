<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>我的课表</title>
	<meta charset="utf-8" name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

</head>
<body >
	<link rel="stylesheet" href="/ClassroomManage/ClassroomManage/Common/js/
	jquery.mobile-1.3.2.css">
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery-2.1.4.min.js"></script>
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery.mobile-1.3.2.js"></script>
	<script>
		// var courseList = JSON.parse(sessionStorage.getItem("courseList"));
		// var roomName = JSON.parse(sessionStorage.getItem("roomName"));

		$(document).ready(function(){
			sessionStorage.clear();
  			loadMyCourse();
		});

		 function loadMyCourse(){
        	var userName = localStorage.getItem("userName",userName);

			var parms={
			    "userName":userName,
			};

			$.ajax({
			    type:"post",
			    url:"/classroomManage/classSchedule.php/searchMyCourse",
			    data:parms,
			    dataType:"json",

			    success:function(responseData){
			        var arrCourseNames = responseData[0]["courseNames"].split(',');
			        var arrCoursePlaces = responseData[0]["coursePlaces"].split(",");

			        if (arrCourseNames == 1) {
						alert("查无数据!");
					}
					else{
						$("#tableTitle").html(userName + "的课表");
						var period = 1;
						var k = 0;
						for (var i = 0; i < 6; i++) {
							// alert(arrCourseNames[i]);
							var tr = "<tr><td>" + (period) + "-"
								+ (period + 1) + "</td>";
							for (var j = 0;j < 7; j++) {
								if (arrCourseNames[k] == "") {
									tr = tr + "<td>" + "<br>" + "</td>";
								}
								else{
									tr = tr + "<td>"
				  						+ arrCourseNames[k] + "<br>"
										+ arrCoursePlaces[k] + "</td>";
								}
								k = k +1;
							}
							tr = tr + "</tr>";
							$("#listTable tr:last").after(tr);
							period = period + 2;
						}

						// window.location.href="/classroomManage/classSchedule.courseResult";
				    }
			    }
			});
        }

		function returnMain(){
        	sessionStorage.clear();
        	window.location.href="/classroomManage/index.php/main";
        }

        function toModifyMyCourse(){
        	sessionStorage.clear();
        	window.location.href="/classroomManage/classSchedule.php/modifyMyCourse";
        }

	</script>
	<style type="text/css">
		.headcss{
			height:10%;
			font-size:20px;
			text-align: center;
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

	<div data-role="page">
		<div class="headcss" data-role="header" data-position="fixed">
			<div style="margin-top: 18px;">我的课表</div>
			<a href="javascript:toModifyMyCourse()" data-role="button"
				style="margin-top: 2.5%;width: 27%;height: 55%;">
			<!-- style="margin-left: 70%;" -->
				<div style="font-size: 16px;">修改课表</div>
			</a>
		</div>

		<div data-role="content">

			<table id="listTable" border="1%" width="100%" height:100%;>
				<caption id="tableTitle" align="top"></caption>
				<tr style="max-width: 100%;min-width: 100%;">
				<th style="max-width: 25%;min-width: 25%;">节次</th>
				<th style="max-width: 25%;min-width: 25%;">星期一</th>
				<th style="max-width: 25%;min-width: 25%;">星期二</th>
				<th style="max-width: 25%;min-width: 25%;">星期三</th>
				<th style="max-width: 25%;min-width: 25%;">星期四</th>
				<th style="max-width: 25%;min-width: 25%;">星期五</th>
				<th style="max-width: 25%;min-width: 25%;">星期六</th>
				<th style="max-width: 25%;min-width: 25%;">星期日</th>
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