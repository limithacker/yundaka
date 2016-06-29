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
$result = mysql_query("SELECT * FROM ydk_auth WHERE `auth`='$auth';");
$row = mysql_fetch_array($result);
$cmpid=$row['cmpid'];
if($cmpid=="")
{
	exit("auth error");
}
$result2=mysql_query("SELECT * FROM ydk_location WHERE `cmpid` ='$cmpid';");
$json=array();
while($row = mysql_fetch_array($result2))
  {
  $rtn['loc']=$row['log'];
  $rtn['lat']=$row['lat'];
  array_push($json,$rtn);
  
  }
//var_dump($json);

echo json_encode($json);


mysql_close($con);
?>