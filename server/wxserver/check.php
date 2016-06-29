<?php
include "common.inc.php";
header("Access-Control-Allow-Origin: *");
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

if(!(isset($_GET['log'])&&isset($_GET['lat'])&&
   isset($_GET['pos'])&&isset($_GET['str'])&&
   isset($_GET['auth'])))
{
	exit("Data Error,Fvck U");
}

$auth=$_GET['auth'];
$log=$_GET['log'];
$lat=$_GET['lat'];
$pos=$_GET['pos'];
$str=$_GET['str'];

$result = mysql_query("SELECT * FROM ydk_auth WHERE `auth`='$auth';");
$row = mysql_fetch_array($result);
$username=$row['username'];
if($username=="")
{
	exit("auth error");
}
$cmpid=$row['cmpid'];
$time=date('Y-m-d H:i:s',time());

$sql="insert `ydk_location`(`username`,`time`,`log`,`lat`,`position`,`street`,`cmpid`) 
	values('$username','$time','$log','$lat','$pos','$str','$cmpid');";
if (mysql_query($sql,$con))
	{	  //echo "insert user ok</br>";
	echo "1";//返回1确认成功
	 }
else
  {	  echo "insert user err " . mysql_error();
 	  }
mysql_close($con);
?>

