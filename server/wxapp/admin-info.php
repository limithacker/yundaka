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
$result2=mysql_query("SELECT * FROM ydk_user WHERE `cmpid` ='$cmpid';");
//$row2 = mysql_fetch_array($result2);
//var_dump($row2);
$number=mysql_num_rows($result2);//公司注册人员数
//echo $number;
$result3=mysql_query("SELECT * FROM ydk_company WHERE `cid` ='$cmpid';");
$row3 = mysql_fetch_array($result3);
$cmpname=$row3['cmpname'];//公司名
$avail=$row3['avail'];//到期时间

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
<title>公司信息</title>
</head>

<body>
<div class="title">
<div class="titleb">公司信息</div>
</div>

<div class="contact">

<img src="images/cplg.png" class="company_logo"/>

<div id="info">
<div class="company_name mt30"><? echo $cmpname; ?></div>
<div class="company_info mt25">
<p>公司ID：<? echo $cmpid; ?></p>
<p>外勤人员数：<? echo $number; ?></p>
<p>帐号有效期：<? echo $avail; ?></p>
</div>
</div>

</div>

<div class="footbox">
<a href="admin-index.php" class="foota f1"></a>
<a href="admin-list.php" class="foota f2"></a>
<a href="admin-addrule.php" class="foota f3"></a>
<a href="admin-info.php" class="foota f4 hover"></a>
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
