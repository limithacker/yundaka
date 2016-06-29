<?php
session_start();
include "common.inc.php";
if($_SESSION['type']=='1'){
	header("Location:http://s1.xuyanzhe.cn/yundaka/wxapp/admin-index.php?v=1");
}
elseif($_SESSION['type']=='2'){
	header("Location:http://s1.xuyanzhe.cn/yundaka/wxapp/user-index.php?v=1");
}


?>


<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-status-bar-style" content="blank" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" href="http://s1.xuyanzhe.cn/yundaka/wxapp/css/global.css" />
<link rel="stylesheet" href="http://s1.xuyanzhe.cn/yundaka/wxapp/css/css.css" />
<script type="text/javascript" src="http://s1.xuyanzhe.cn/yundaka/wxapp/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<title>云考勤</title>
</head>

<body>
<script>
$(function(){
	$("#loginbtn").click(function(){
		$.ajax({
		   type:"GET",
		   url:"http://s1.xuyanzhe.cn/yundaka/wxserver/login.php",
		   timeout : 5000,
		   dataType:"json",
		   data:{usn:$("#usn").val(),psw:$("#psw").val()},
		   success:function(data,textStatus){
					if (data==0)
					{alert ("密码错误或用户未经审核!");}		 
					else
					{ 
					  
					  if (data.rtn=="1")
					  {window.location.href="http://s1.xuyanzhe.cn/yundaka/wxapp/admin-index.php?v=1";}
					  else if (data.rtn=="2") 
					  {window.location.href="http://s1.xuyanzhe.cn/yundaka/wxapp/user-index.php?v=1";}
					  else
					  {alert ("返回值错误!请检查网络连接");}
					  
					}  
		   },
		   error:function(){}
			 
		});
		
		
	});
	

});



</script>
<div class="contact">

<div class="web_logo"></div>
<div class="web_logo_txt">云考勤</div>
<div class="web_logo_line"></div>

<form action="" method="post">
<div class="tsb">用户名</div>
<div class="txtboxb txtboxbg bga">
<input type="text" class="txt" id="usn"/>
</div>

<div class="tsb">密码</div>
<div class="txtboxb txtboxbg bgb">
<input type="text" class="txt" id="psw"/>
</div>



<div class="login_btn_box">

<input type="button" class="cbtn btnb" value="登录" id="loginbtn"/>

<a href="javascript:;" class="forget_psw"></a>

<a href="reg-choose.html?v=2101" class="reg_new">注册新用户</a>

</div>
</form>

</div>
</body>
</html>
