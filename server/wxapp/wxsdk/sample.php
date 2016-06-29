<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx71f13d131736c0e9", "c36b7fb3c84ff8a379bf7693e04c2dc8");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>

  wx.config({
    debug: true,
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
	

		wx.getLocation({
		  success: function (res) {
			alert(JSON.stringify(res));
			var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
			var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
			var speed = res.speed; // 速度，以米/每秒计
			var accuracy = res.accuracy; // 位置精度
			
			
		  },
		  cancel: function (res) {
			alert('用户拒绝授权获取地理位置');
		  }
		});
		
		wx.getLocation({
			type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
			success: function (res) {
				
			}
		});
  
  
  });
</script>
</html>
