<?php
include "common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
$db_selected = mysql_select_db($database,$con);
$uid=$_GET['uid'];
if($_GET['do']=='unlock')
{
	mysql_query("update `ydk_user` set `lock`=0 where `uid`=$uid;");
}
else
{
	mysql_query("update `ydk_user` set `lock`=1 where `uid`=$uid;");
}

mysql_close($con);

header("Location:userlist.php");  
?>