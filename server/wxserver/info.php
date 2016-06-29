<?php
include "common.inc.php";
header("Access-Control-Allow-Origin: *");
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
$db_selected = mysql_select_db($database,$con);
if(!(isset($_GET['auth'])))
{
	exit("Data Error,Fvck U");
}
$auth=$_GET['auth'];
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

$rtn->cname=$cmpname;
$rtn->cid=$cmpid;
$rtn->avail=$avail;
$rtn->num=$number;

echo json_encode($rtn);
mysql_close($con);
?>