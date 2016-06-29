<?php
session_start();
if($_SESSION['cmpid']!=""){
	header("Location:http://s1.xuyanzhe.cn/yundaka/admin/index.php"); 
}
include "../common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);
if($_GET['u']!=""){//有传递信息，执行登陆
	$username=$_GET['u'];
	$password=$_GET['p'];
	
	$result = mysql_query("SELECT * FROM ydk_user WHERE username='$username';");
	$row = mysql_fetch_array($result);
	if(($row['password']==$password)&&($row['lock']==0))//密码正确且未被锁定
	{
		if($row['type']==1){
			$_SESSION['uid']=$row['uid'];
			$_SESSION['username']=$row['username'];
			$_SESSION['cmpid']=$row['cmpid'];
			$_SESSION['name']=$row['name'];
			header("Location:".$url."/admin/index.php");  //跳转到规则管理页面
		}
		else {
			exit("当前后台只允许管理员账户登陆");
		}
	}
	else {
	exit("请检查密码或账户是否被锁定");
	}
}
else {	//输出登陆界面
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>云考勤管理后台登陆</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/supersized.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body oncontextmenu="return false">

        <div class="page-container">
            <h1>管理员登陆</h1>
            <form action="login.php" method="get">
				<div>
					<input type="text" name="u" class="username" placeholder="用户名" autocomplete="off"/>
				</div>
                <div>
					<input type="password" name="p" class="password" placeholder="密码" oncontextmenu="return false" onpaste="return false" />
                </div>
                <button id="submit" type="submit">登陆</button>
                
            </form>

        </div>
		<div class="alert" style="display:none">
			<h2>消息</h2>
			<div class="alert_con">
				<p id="ts"></p>
				<p style="line-height:70px"><a class="btn">确定</a></p>
			</div>
		</div>

        <!-- Javascript -->
		<script src="http://apps.bdimg.com/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="js/supersized.3.2.7.min.js"></script>
        <script src="js/supersized-init.js"></script>
		
    </body>

</html>




<?php
}
mysql_close($con);
?>

