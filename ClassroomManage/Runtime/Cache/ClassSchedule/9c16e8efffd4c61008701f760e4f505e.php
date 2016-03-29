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
		$(document).ready(function(){
			sessionStorage.clear();
  			loadMyCourse();
		});

		var arrCourseNames;
		var arrCoursePlaces;


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
			        arrCourseNames = responseData[0]["courseNames"].split(',');
			        arrCoursePlaces = responseData[0]["coursePlaces"].split(",");
			        var arrIndex = 0;



			        if (arrCourseNames == 1) {
						alert("查无数据!");
					}
					else{
						$("#tableTitle").html(userName + "的课表");
						// 控制节次的生成显示
						var period = 1;

						for (var i = 0; i < 6; i++) {
							// alert(arrCourseNames[i]);
							// 控制节次的生成显示
							var tr = "<tr><td>" + (period) + "-" + (period + 1)
								+ "</td>";

							for (var j = 0;j < 7; j++) {
								var index = (i+1) + "" + (j+1);
								// 若有课，则显示课程名称和教室
								tr = tr + "<td><input type='text' id='name"+ index
									+ "' name='name" + index + "' style='width:100%;' value='"
				  						+ arrCourseNames[arrIndex] + "'><br><input type='text' id='place"+ index + "' name='place" + index + "' style='width:100%;' value='"
										+ arrCoursePlaces[arrIndex] + "'></td>";
								arrIndex = arrIndex + 1;
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

        function my(){
        	// 构建两个数组，以存储所有课程的信息
        	var arrName = new Array(42);
        	var arrPlace = new Array(42);
        	var x=0;
        	for (var i = 0;i < 6; i++) {
	        	for(var j = 0;j < 7; j++){
	        		var index = (i+1) + "" + (j+1);
	        		arrName[x] = $("#name"+ index).val();
	        		arrPlace[x] = $("#place"+ index).val();
	        		x = x + 1;
	        	}
        	}

			// 将两个数组转换成字符串，ajax请求更新DB的data
        	var userName = localStorage.getItem("userName",userName);
        	var strName = arrName.join();
        	var strPlace = arrPlace.join();

        	var parms={
        		"userName":userName,
			    "strName":strName,
			    "strPlace":strPlace,
			};

			$.ajax({
			    type:"post",
			    url:"/classroomManage/classSchedule.php/modifySchedule",
			    data:parms,

			    success:function(responseData){
// alert(responseData);
			    	if (responseData == 0) {
						alert("保存成功！");
			    	}
			    	else if (responseData == 1) {
			    		alert("保存失败！");
			    	}
			    	else if (responseData == 3) {
			    		alert("保存异常！");
			    	}
				}
			});
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
			<div style="margin-top: 18px;">修改课表</div>
		</div>
		<form action="/classroomManage/classSchedule.php/modify" method="POST" >
		<div data-role="content">

			<table id="listTable" border="1%" width="100%">
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
			<!-- <div style="margin-top: 2%;"> -->
			<!-- <input id="ss" name="ss" value="1234" /> -->
				<input type="button" onclick="my()" value="保存课表"/>
				<!-- <input type="submit" value="保存课表"/> -->
			<!-- </div> -->
		</div>
		</form>

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