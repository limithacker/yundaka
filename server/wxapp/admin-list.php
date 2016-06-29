<?php
session_start();
include "common.inc.php";
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
if($cmpid=="")
{
	exit("auth error");
}
$result2=mysql_query("SELECT * FROM ydk_location WHERE `cmpid` ='$cmpid' ORDER BY `time` DESC LIMIT 15;");
$json=array();




?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-status-bar-style" content="blank" />
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="css/global.css" />
<link rel="stylesheet" href="css/css.css" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<style>
p{ white-space:nowrap; }
</style>
<title>打卡详情</title>
</head>

<body>
<div class="title">
<div class="titleb">打卡详情</div>
</div>

<div class="contactb" style="margin-bottom:80px;">
<?php
while($row = mysql_fetch_array($result2))
  {
	  
	  $username=$row['username'];
	  $result0=mysql_query("SELECT * FROM ydk_user WHERE `username` ='$username';");
	  $ydkuser = mysql_fetch_array($result0);
	  if(($row['log']!='')&&($row['lat']!=''))
	  {
		  ?>
		  <div class='man_card'>
			<div class='crl'><? echo $ydkuser['name']; ?></div>
			<div class='crr'>
				<p>打卡时间：<? echo $row['time']; ?></p>
				<p class='pt'><? echo $row['position']; ?></p>
				<p><? echo $row['log']; ?>,<? echo $row['lat']; ?></p>
			</div>
			<div class='cb'></div>
		  </div>
	
		  
		  <?
	  }
	  
  }

?>

</div>


<div class="footbox">
<a href="admin-index.php" class="foota f1"></a>
<a href="admin-list.php" class="foota f2 hover"></a>
<a href="admin-addrule.php" class="foota f3"></a>
<a href="admin-info.php" class="foota f4"></a>
<a class="foota f5"  href="exit.php" ></a>

<div class="cb"></div>
</div>
</body>
<script>
function exit(){
		
		window.location.href="index.html";		
		
	};
</script>
</html>
<?
mysql_close($con);
?>