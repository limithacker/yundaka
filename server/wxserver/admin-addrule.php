<?php
include "common.inc.php";
header("Access-Control-Allow-Origin: *");
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
$db_selected = mysql_select_db($database,$con);
//auth->cmpid
$auth=$_GET['auth'];
$result = mysql_query("SELECT * FROM ydk_auth WHERE `auth`='$auth';");
$row = mysql_fetch_array($result);
$cmpid=$row['cmpid'];
if($cmpid=="")
{
	exit("auth error");
}

$result=mysql_query("SELECT * FROM ydk_user where `cmpid`='$cmpid' and `type`=2 order by uid desc");
?>
<table class="ut">
<tr>
<th>员工编号</th>
<th>员工姓名</th>
<th>启用</th>
</tr>
<?
while($row = mysql_fetch_array($result))
  {
	  ?>
    <tr>
    <td><? echo $row['uid']; ?></td>
    <td><? echo $row['name']; ?></td>
    <td><? 
				if($row['lock']==1)	
				{ ?>
                   <form action="http://s1.xuyanzhe.cn/yundaka/admin-lock.php" method="get">
                    <input name="uid" type="hidden" value="<? echo $row['uid']; ?>" />
                    <input name="do" type="hidden" value="unlock" />
                    <input name="auth" type="hidden" value="<? echo $auth; ?>" />
                    <input type="submit" class="tooff" value="" />
                   </form>
                <? }
				else
				{?>
                   <form action="http://s1.xuyanzhe.cn/yundaka/admin-lock.php" method="get">
                    <input name="uid" type="hidden" value="<? echo $row['uid']; ?>" />
                    <input name="do" type="hidden" value="lock" />
                    <input name="auth" type="hidden" value="<? echo $auth; ?>" />
                    <input type="submit" class="toon" value="" />
                   </form>
                <? }
				
			 ?>
    </td>
    </tr>
	 <?php 
  }
  ?>
  </table>
  <?
mysql_close($con);
?>
