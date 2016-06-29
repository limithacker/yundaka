<?php
session_start();
include "common.inc.php";
header("Access-Control-Allow-Origin: *");

//适应微信
$auth=$_SESSION['auth'];

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
<title>员工账户</title>
</head>

<body>
<div class="title">
<div class="titleb">员工账户</div>
</div>


<div id="fth"> </div>



<div class="footbox">
<a href="admin-index.php" class="foota f1"></a>
<a href="admin-list.php" class="foota f2"></a>
<a href="admin-addrule.php" class="foota f3 hover"></a>
<a href="admin-info.php" class="foota f4"></a>
<a class="foota f5"  href="exit.php" ></a>

<div class="cb"></div>
</div>
</body>
<script>
$(function(){
	setInterval(function(){
          $("#fth").load("http://s1.xuyanzhe.cn/yundaka/admin-addrule.php?auth=<? echo $auth; ?>"); 
        },1000);
});

</script>
<script>
function exit(){
		window.location.href="index.html";		
		
	};
</script>
</html>
