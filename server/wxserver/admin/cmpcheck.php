<?
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/global.css" />
<link rel="stylesheet" href="css/css.css" />
<link rel="stylesheet" href="css/manhuaDate.css" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/manhuaDate.1.0.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BubV96ANNHQqYZ1HU7eSA0jf"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.css" />



<title>规则添加--云考勤管理中心</title>
</head>

<body>
<div class="cmpbdiv">
<div class="cmpdiv">

<div class="cldiv">
<div class="cls">
<img src="" alt="" class="logo"/>
<div class="cmptitle">企业考勤自动检测系统</div>
<div class="cb"></div>
</div>

<div class="clx">
日期：<input type="text" class="cl" id="date" readonly/>
时间：<input type="text" class="cd" id="sh" />时<input type="text" class="cd" id="sm" />分~<input type="text" class="cd" id="eh" />时<input type="text" class="cd" id="em" />分&nbsp;&nbsp;规则名称：<input type="text" class="cd2" id="rulename" />
员工姓名：

<?php
include "../common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

$cmpid=$_SESSION['cmpid'];

$result=mysql_query("SELECT * FROM ydk_user where `cmpid`='$cmpid' and `type`=2 order by uid desc");

?>

<select id="usid">
<option>==请选择==</option>
<?php
while($row = mysql_fetch_array($result))
  {
	  ?>
      <option value="<? echo $row['uid'];  ?>"><? echo $row['name']; ?></option>
      <?
  }
mysql_close($con);
?>
</select>

<input type="hidden" id="plog" value=""/>
<input type="hidden" id="plat" value=""/>
<input type="hidden" id="r" value=""/>
</div>

</div><!--cldiv end-->

<div class="crdiv">
<a href="javascript:;" class="lu" id="reset">重置信息</a>
<a href="javascript:;" class="lan" id="addrule">添加规则</a>
</div>
</div>
</div>


<div class="mapdiv" id="map"></div>

</body>


<script type="text/javascript" src="js/cmpcheck.js"></script>
</html>
