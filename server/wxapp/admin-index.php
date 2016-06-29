<?php
session_start();

include "common.inc.php";
error_reporting(E_ALL); ini_set("display_errors", 1);
header("Access-Control-Allow-Origin: *");
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
$db_selected = mysql_select_db($database,$con);
//if(!(isset($_GET['auth'])))
//{
//	exit("Data Error,Fvck U");
//}
//$auth=$_GET['auth'];
//适应微信
$auth=$_SESSION['auth'];
//echo $auth;
$result = mysql_query("SELECT * FROM ydk_auth WHERE `auth`='$auth';");
$row = mysql_fetch_array($result);
$cmpid=$row['cmpid'];
//echo $cmpid;
if($cmpid=="")
{
	exit("auth error");
}

if(isset($_GET['u'])){
	$u=$_GET['u'];
	$result2=mysql_query("SELECT * FROM ydk_location WHERE `cmpid` ='$cmpid' AND `username`='$u' ORDER BY `time` DESC LIMIT 15;");
}
else{
	$result2=mysql_query("SELECT * FROM ydk_location WHERE `cmpid` ='$cmpid' ORDER BY `time` DESC LIMIT 15;");
}
//$json=array();
//var_dump($json);

//echo json_encode($json);


mysql_close($con);
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-status-bar-style" content="blank" />
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="css/global.css" />
<link rel="stylesheet" href="css/css.css?v=3" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=BubV96ANNHQqYZ1HU7eSA0jf&v=1.0"></script>
<script>
function exit(){
		window.location.href="index.html";		
		
	};
$(function(){
	var map = new BMap.Map("mapdiv",{vectorMapLevel:99});  
     
	var marker=new Array();
	var wh=document.documentElement.clientHeight; 
       var divh=wh-178;
      $("#mapdiv").css({"height":divh+"px"});
	
	<?php
	$i=1;
	while($row = mysql_fetch_array($result2))
	  {
		if(($row['log']!='')&&($row['lat']!=''))
		{
			  if($i==1){
				  ?>
				  var points = new BMap.Point(<? echo $row['log']; ?>,<? echo $row['lat']; ?>);
					  map.centerAndZoom(points,13);
					map.addControl(new BMap.ZoomControl());
				  <?
			  }
			echo 'marker['.$i.'] = new BMap.Marker(new BMap.Point('.$row['log'].','.$row['lat'].'));';
			echo "map.addOverlay(marker[$i]);";
			$i++;
			
			
		}
	  
	  }
	?>
	
		   

});
</script>
		

<title>云考勤</title>
</head>

<body>
<div class="title">
<div class="titleb">云考勤</div>
</div>


<div id="mapdiv"></div>


<div class="names">
<div class="nameseb">
<select  onchange="self.location.href=options[selectedIndex].value">
    <option value="http://s1.xuyanzhe.cn/yundaka/wxapp/admin-index.php">最近15条</option>
	<?
				$con = mysql_connect($server,$username,$password);
				if (!$con)
				  {
				  die('Lets Fvck this database!' . mysql_error());
				  }
				$db_selected = mysql_select_db($database,$con);
            $result3=mysql_query("SELECT * FROM ydk_user WHERE `cmpid` ='$cmpid';");
			while($row3 = mysql_fetch_array($result3)){
				if($row3['type']==2){
					if($row3['username']==$u){
						?>
						  <option value="http://s1.xuyanzhe.cn/yundaka/wxapp/admin-index.php?u=<? echo $row3['username']; ?>" selected><? echo $row3['username']; ?></option>
						<?
					}
					else{
						?>
						  <option value="http://s1.xuyanzhe.cn/yundaka/wxapp/admin-index.php?u=<? echo $row3['username']; ?>"><? echo $row3['username']; ?></option>
						<?
					}
				}//type=2 if
			}
	?>
</select>
考勤位置</div>
</div>
<div class="footbox">
<a href="admin-index.php" class="foota f1 hover"></a>
<a href="admin-list.php" class="foota f2"></a>
<a href="admin-addrule.php" class="foota f3"></a>
<a href="admin-info.php" class="foota f4"></a>
<a class="foota f5"  href="exit.php" ></a>

<div class="cb"></div>
</div>
</body>
<!--<script type="text/javascript" src="../js/map.js"></script>-->

</html>
