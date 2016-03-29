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
	<script type="text/javascript">
		$(document).ready(function(){
			sessionStorage.clear();
  			loadMySchedule();
		});

		function loadMySchedule(){

			var userName = localStorage.getItem("userName");

			var parms={
			    "userName":userName,
			    // 'mySchedule':mySchedule,
			};

			$.ajax({
			    type:"post",
			    url:"/classroomManage/mySchedule.php/searchMySchedule",
			    data:parms,
			    dataType:"json",

			    success:function(responseData){
			    	// alert("123"+responseData[0]['mySchedule']);

			    	if (responseData == 1) {
			    		alert("读取失败！");
			    	}
			    	else if (responseData == 3) {
			    		alert("读取异常！");
			    	}
			    	else{
						// alert("读取成功！");
						$("#schedule").val(responseData[0]['mySchedule']);
						// document.getElementById("erea").rows=20;
			    	}
			  	}
			 });
		}

		function modifyMySchedule(){
			var userName = localStorage.getItem("userName");
			var mySchedule = $("#schedule").val().trim();

			var parms={
			    "userName":userName,
			    'mySchedule':mySchedule,
			};

			$.ajax({
			    type:"post",
			    url:"/classroomManage/mySchedule.php/modify",
			    data:parms,

			    success:function(responseData){
			    	// alert("sss "+responseData);

			    	if(responseData == 0){
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

		function returnMain(){
        	sessionStorage.clear();
        	window.location.href="/classroomManage/index.php/main";
        }

	</script>

	<style type="text/css">
		.headcss
		{
			height:10%;
			font-size:20px;
			text-align: center;
		}
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
			color: #fff;
			margin-top: 9px;
			font-size: 20px;
		}
	</style>

	<div data-role="page">
		<div class="headcss" data-role="header" data-position="fixed">
			<div style="margin-top: 18px;">我的行程</div>
		</div>

		<div id="content" data-role="content">
			<textarea id="schedule" name="schedule" value="" rows="10" cols="5" autofocus>

			</textarea>
			<input type="button" onclick="modifyMySchedule()" value="保存计划"/>
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