<?php
session_start();
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

//header("Location:http://s1.xuyanzhe.cn/yundaka/admin-addrule.php?auth=".$_GET['auth']);  
?>
<html>
<script type="text/javascript">
window.onload=function(){
location.href = 'javascript:history.go(-1)';
}
</script>

</html>