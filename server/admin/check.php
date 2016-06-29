<?php
include "../common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);
$month=$_GET['month'];
$nextmonth=$month+1;
$cmpid=$_GET['cmpid'];
$sql_list=mysql_query("SELECT * FROM ydk_location WHERE `cmpid` ='$cmpid';");
while($row = mysql_fetch_array($result2))
  {
	  
	  $username=$row['username'];
	  $result0=mysql_query("SELECT * FROM ydk_user WHERE `username` ='$username';");
	  $ydkuser = mysql_fetch_array($result0);
	  
	  $rtn['name']=$ydkuser['name'];//用户名转姓名
	  $rtn['time']=$row['time'];
	  $rtn['position']=$row['position'];
	  $rtn['loc']=$row['log'];
	  $rtn['lat']=$row['lat'];
	  array_push($json,$rtn);
	  
  }


$sql="select * from ydk_location where `cmpid` ='$cmpid' AND timestamp between UNIX_TIMESTAMP('2011-$month-01 00:00:00') and UNIX_TIMESTAMP('2011-$nextmonth-01 00:00:00');";





?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BubV96ANNHQqYZ1HU7eSA0jf"></script>
	<title><? echo $month; ?>打卡绩效考评页</title>
</head>
<body>
	<div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(116.400244,39.92556);
	map.centerAndZoom(point, 12);
	var marker = new BMap.Marker(point);  // 创建标注
	map.addOverlay(marker);              // 将标注添加到地图中

	var label = new BMap.Label("姓名-时间",{offset:new BMap.Size(20,-10)});
	marker.setLabel(label);
</script>
