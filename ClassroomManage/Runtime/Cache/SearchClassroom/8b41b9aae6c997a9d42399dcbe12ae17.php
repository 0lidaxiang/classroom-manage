<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>查空教室</title>
	<meta charset="utf-8" name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
		$(document).bind("mobileinit", function() {
            //disable ajax nav
            $.mobile.ajaxEnabled=false
        });
	</script>

	<link rel="stylesheet" href="/ClassroomManage/ClassroomManage/Common/js/
	jquery.mobile-1.3.2.css">

	<script src="/ClassroomManage/ClassroomManage/Common/js/jquery.mobile-1.3.2.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			sessionStorage.clear();
		});
		function returnMain(){
        	sessionStorage.clear();
        	window.location.href="/classroomManage/index.php/main";
        }

		function search(buildingName){
			if (buildingName == "1TeachBuilding") {buildingName = "1号教学楼";};
			if (buildingName == "2TeachBuilding") {buildingName = "2号教学楼";};
			if (buildingName == "3TeachBuilding") {buildingName = "3号教学楼";};
			if (buildingName == "technologyBuilding") {buildingName = "资讯科技楼";};
			if (buildingName == "1trainBuilding") {buildingName = "1号实训楼";};
			if (buildingName == "2trainBuilding") {buildingName = "2号实训楼";};
			if (buildingName == "center") {buildingName = "国际交流中心";};
			if (buildingName == "all") {buildingName = "所有";};

			sessionStorage.clear();
			sessionStorage.setItem("buildingName",buildingName);
			var parms={
		        "buildingName":buildingName,
		    };

		    $.ajax({
		        type:"post",
		        url:"/classroomManage/searchClassroom.php/search/",
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
						var test = data[0]['roomNumber'];
						// alert("test :"+test);
						sessionStorage.setItem("classroomList",JSON.stringify(data));
						window.location.href="/classroomManage/searchClassroom.php/classroomResult";
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
		.btnMainlink
		{
			margin-top: 0px;
			margin-left:30% ;
			height: 100%;
			background-color: #000;
			width: 99%;
		}
		.btnMain
		{
			width: 90%;
			height: 100%;
			color: #db3b3b;
			margin-top: 28px;
			text-align: center;
			font-size: 18px;
		}

		.btnOther
		{
			width: 100%;
			height: 100%;
			color: #db3b3b;
			margin-top: 28px;
			font-size: 18px;
		}

		.btnOtherlink
		{
			margin-top: 0px;
			height: 100%;
			background-color: #000;
			width: 199%;
		}
	</style>
</head>
<body>
	<div data-role="page">
		<div class="headcss" data-role="header" data-position="fixed" data-tap-toggle="false">
			<div style="margin-top: 18px;">查询空教室</div>
		</div>
		<span>请选择一栋楼：</span>
		<div data-role="content" class="contentStyle" >
			<div class="ui-grid-b" style="width: 98%;height: 370px;">
			    <div class="ui-block-a" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('1TeachBuilding')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">1号<br>教学楼</div>
					</a>
			    </div>

			    <div class="ui-block-b" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('2TeachBuilding')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">2号<br>教学楼</div>
					</a>
			    </div>

			    <div class="ui-block-c" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('3TeachBuilding')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">3号<br>教学楼</div>
					</a>
			    </div>

			    <div class="ui-block-a" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('technologyBuilding')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">资讯<br>科技楼</div>
					</a>
			    </div>

			    <div class="ui-block-b" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('1trainBuilding')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">1号<br>实训楼</div>
					</a>
				</div>

				<div class="ui-block-c" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('2trainBuilding')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">2号<br>实训楼</div>
					</a>
			    </div>

			    <div class="ui-block-a" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('center')" class="btnMainlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnMain">国际交<br>流中心</div>
					</a>
			    </div>

			    <div class="ui-block-b" style="border: 0px solid black;height: 33%;">
			    	<a href="javascript:search('all')" class="btnOtherlink" data-transition="flow" data-role="button" data-inline="true" data-corners="false">
						<div class="btnOther">查询当前<br>所有空教室</div>
					</a>
				</div>
   			</div>
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