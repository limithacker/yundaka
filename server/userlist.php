<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>系统用户列表-云考勤</title>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="jquery.tableui.js"></script>
<link href='jquery.tableui.css'  rel="stylesheet" type="text/css"/>
<script type="text/javascript">
	$(function(){
		$(".table_solid").tableUI();
	});
</script>
</head>
<body>
	  <table class="table_solid" border="0" cellspacing="0">
      <tr><th>用户ID</th><th>姓名</th><th>登陆名</th><th>公司id</th><th>联系方式</th><th>用户类型</th><th>操作</th></tr>
<?php
include "common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
$db_selected = mysql_select_db($database,$con);
$result=mysql_query("SELECT * FROM ydk_user order by uid desc limit 50");

while($row = mysql_fetch_array($result))
  {
	  ?>

		
		<tr>
        	<td><? echo $row['uid']; ?></td>
            <td><? echo $row['name']; ?></td>
            <td><? echo $row['username']; ?></td>
            <td><? echo $row['cmpid']; ?></td>
            <td><? echo $row['tel']; ?></td>
            <td><? 
				if($row['type']==1)	echo "企业";
				else echo "员工";
			 ?></td>
             <td><? 
				if($row['lock']==1)	
				{ ?>
                    <a href="lock.php?do=unlock&uid=<? echo $row['uid']; ?>">启用</a>
                <? }
				else
				{?>
                    <a href="lock.php?do=lock&uid=<? echo $row['uid']; ?>">锁定</a>
                <? }
				
			 ?></td>
        </tr>
	 <?php 
  }
  
mysql_close($con);
?>
	</table>
</body>
</html>