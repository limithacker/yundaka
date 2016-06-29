<?php
session_start();
require_once "wxsdk/jssdk.php";
$jssdk = new JSSDK("wx71f13d131736c0e9", "c36b7fb3c84ff8a379bf7693e04c2dc8");
$signPackage = $jssdk->GetSignPackage();
$auth=$_SESSION['auth'];
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
<link rel="stylesheet" href="css/global.css" />
<link rel="stylesheet" href="css/css.css" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/user-index.js?v=23"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script>
function submm(){
	$.ajax({
		   type:"GET",
		   url:"/check.php",
		   dataType:"text",
		   data:{
			     auth:"<? echo $auth; ?>",
			     log:$("#jd").val(),
		         lat:$("#wd").val(),
				 pos:$("#addr").val(),
				 str:$("#street").val()
				 },
		   success:function(data){
			   
					if (data==1)
					{alert ("打卡成功!");}		 
					else
					{
						alert ("打卡失败 请检查网络");
					}  
		   },
		   error:function(){alert("eeer");}
			 
		});
};
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
	  'openLocation',
      'getLocation'
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
		  
  });
</script>

<title>云考勤</title>
</head>

<body>
<div class="title">
<div class="titleb">
<a id="lkbx" class="lockbox"  href="exit.php" ></a>
云考勤</div>
</div>


<div class="contactc">
<div class="zyi">为了获得更精确的位置，建议您打开GPS定位选项</div>

<form action="" method="post">

<div class="dkts mt55">当前时间：</div>
<div class="dktbox">
<input type="text" class="dktxt" id="time" readonly/>
</div>

<div class="dkts">当前经度：</div>
<div class="dktbox">
<input type="text" class="dktxt" id="jd" readonly/>
</div>

<div class="dkts">当前纬度：</div>
<div class="dktbox">
<input type="text" class="dktxt" id="wd" readonly/>
</div>

<div class="dkts">所在位置：</div>
<div class="dktbox">
<input type="text" class="dktxt" id="addr" readonly/>
</div>

<div class="dkts">街道：</div>
<div class="dktbox">
<input type="text" class="dktxt" id="street" readonly/>
</div>


<div class="sbbtnbox">
<div class="zjbox"><input type="button" class="dkbtn sea" id="sub" value="在此打卡" onClick="submm();"/></div>
<div class="zjbox"><input type="button" class="dkbtn seb" id="flush" value="刷新位置"  onClick="flushpos();"/></div>
<div class="cb"></div>
</div>

</form>

</div>
<div class="cb mb30"></div>

</body>
</html>
