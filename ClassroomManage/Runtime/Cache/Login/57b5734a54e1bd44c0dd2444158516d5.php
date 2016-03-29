<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>NJCIT教室管理系统</title>
	<meta charset="utf-8" name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="/ClassroomManage/ClassroomManage/Common/js/jquery.mobile-1.3.2.css">
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery.mobile-1.3.2.js"></script>

	<script type="text/javascript">
		// 页面载入时，清空sessionStorage，设置高度
		$(document).ready(function(){
			sessionStorage.clear();
			// 利用可视窗口的高度设定content div的高度，方便了设定四个模块的高度
			$("#contentDiv").height($(window).height());
		});

		// 禁止在jquerymobile中ajax的自动实现
		$(document).bind("mobileinit", function() {
            //disable ajax nav
            $.mobile.ajaxEnabled=false
        });

		// 跳转到查找空教室页面
        function searchClassroom(){
        	window.location.href="/classroomManage/searchClassroom.php/index";
        }

        // 跳转到综合查询页面
        function searchBy(){
        	window.location.href="/classroomManage/generalQuery.php/index";
        }

        // 跳转到我的课表页面
        function myCourse(){
        	window.location.href="/classroomManage/classSchedule.php/index";
        }

        // 跳转到我行程页面
        function myPlan(){
        	window.location.href="/classroomManage/mySchedule.php/index";
        }

        // 退出登录
        function loginout(){
        	// 整个程序只有这里会清除掉用户名和密码
        	localStorage.clear();
        	window.location.href="/classroomManage/index.php/index";
        }
	</script>

	<style type="text/css">
		.headcss{
			height:10%;
			font-size:18px;
			text-align: center;
		}
		.buttonMain
		{
			padding-top: 35px;
			width: 100%;
			height: 100%;
		}
		.fontStyle
		{
			font-size: 30px;
		}
		.foot
		{
			bottom: 0;
			height: 10%;
		}
		.loginoutlink
		{
			width: 100%;
			height: 100%;
		}
		.loginoutbtn
		{
			color: #fff;
			margin-top: 9px;
			font-size: 21px;
		}
	</style>
</head>
<body>
	<!-- jquery-mobile样式页面 -->
	<div class="pagecss" data-role="page" >
		<!-- 页面顶部 -->
		<div class="headcss" data-role="header" data-position="fixed">
			<div style="margin-top: 18px;">NJCIT教室管理系统</div>
		</div>

		<!-- 页面内容 -->
		<div id="contentDiv" data-role="content" >
			<!-- class="contentStyle" 可以实现效果，到时候只要调整css中的一个值就可以了。-->
			<div class="ui-grid-a" style="width: 100%;height: 70%;">
				<div class="ui-block-a" style="width: 50%;height: 50%;">
					<a href="javascript:searchClassroom()" data-transition="flow"
			   			data-role="button" class="buttonMain" data-inline="true"
			   			data-corners="false"><span class="fontStyle">查空<br>教室</span></a>
	    	 	</div>
	     		<div class="ui-block-b"style="width: 50%;height: 50%;">
	       			<a href="javascript:searchBy()" data-role="button" class="buttonMain" data-inline="true" data-corners="false"><span class="fontStyle">综合<br>查询</span></a>
	     		</div>
	     		<div class="ui-block-a" style="width: 50%;height: 50%;">
	     			<a href="javascript:myCourse()" data-role="button" class="buttonMain" data-inline="true" data-corners="false"><span class="fontStyle">我的<br>课表</span></a>
	    	 	</div>
	     		<div class="ui-block-b" style="width: 50%;height: 50%;">
	       			<a href="javascript:myPlan()" data-role="button" class="buttonMain" data-inline="true" data-corners="false"><span class="fontStyle">我的<br>行程</span></a>
	     		</div>
	     	</div>
  		</div>

  		<!-- 页面底部 -->
		<div class="foot" data-role="footer"
		data-position="fixed" >
			<a href="javascript:loginout()" class="loginoutlink" data-transition="flow"
				data-role="button" data-inline="true" data-corners="false">
				<div class="loginoutbtn">退出</div>
			</a>
		</div>
	</div>
</body>
</html>