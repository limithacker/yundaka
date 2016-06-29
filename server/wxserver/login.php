<?php
session_start();
include "common.inc.php";
header("Access-Control-Allow-Origin: *");
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);
if(!(isset($_GET['usn'])&&isset($_GET['psw'])  ))
{
	exit("Data Error,Fvck U");
}
$username=$_GET['usn'];
$password=$_GET['psw'];

$result = mysql_query("SELECT * FROM ydk_user WHERE username='$username';");
$row = mysql_fetch_array($result);
if(($row['password']==$password)&&($row['lock']==0))//密码正确且未被锁定
{
	//删除原有记录，防止冲突
	$sql="delete from `ykd_auth` where `username`='$username';";
	mysql_query($sql,$con);
	//准备数据，写入auth
	$time=time();
	$auth=md5($username.time());
	$time=date('Y-m-d H:i:s',$time);
	$cmpid=$row['cmpid'];
	$sql="insert `ydk_auth`(`username`,`auth`,`time`,`cmpid`) 
	values('$username','$auth','$time',$cmpid);";
	if (mysql_query($sql,$con))
	{
		//echo "insert auth ok";
		//插入成功，准备返回数据
		$rtn->rtn=$row['type'];
		$rtn->auth=$auth;
		//微信迁移，写入auth到session
		$_SESSION['auth']=$auth;
		$_SESSION['type']=$row['type'];
		echo json_encode($rtn);
	}
	else
	{
		echo "insert auth err";
	}
}
else
{
	echo "0";
}

mysql_close($con);
?>
		