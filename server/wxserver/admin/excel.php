<?
session_start();
if($_SESSION['cmpid']==""){
	header("Location:".$url."/admin/login.php"); 
}
include "../common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

$cmpid=$_SESSION['cmpid'];
?>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>云考勤管理中心</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
  <h1>云考勤管理中心<small>
  <? 
		
		$cidsql=mysql_query("select * from ydk_company where `cid`='$cmpid';");
		$cidfetch = mysql_fetch_array($cidsql);
		$cname=$cidfetch['cmpname'];
		echo $cname;
															
	?>
  </small></h1>
</div>
</div>
</div>
<div class="row">
   <div class="col-md-12">
   <h2>考勤结果导出<small>根据规则计算后的考勤数据通过此导出</small></h2>
   <form action="excel_dump.php" method="get">
      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">起始时间</span>
          <input type="text" class="form-control" placeholder="<? echo date("Y-m-d"); ?>" aria-describedby="sizing-addon2" name="sd">
        </div>
        <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">结束时间</span>
          <input type="text" class="form-control" placeholder="<? echo date("Y-m-d"); ?>" aria-describedby="sizing-addon2" name="ed">
        </div>
       <input type="hidden" class="form-control" name="cmpid" value="<? echo $cmpid;  ?>">
      <input class="btn btn-default" type="submit" value="导出">
    </form>
    </br>
    <h2>签到日志导出<small>未设定规则时，员工签到日志通过此导出</small></h2>
   <form action="excel_dump_nr.php" method="get">
      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">起始时间</span>
          <input type="text" class="form-control" placeholder="<? echo date("Y-m-d"); ?>" aria-describedby="sizing-addon2" name="sd">
        </div>
        <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">结束时间</span>
          <input type="text" class="form-control" placeholder="<? echo date("Y-m-d"); ?>" aria-describedby="sizing-addon2" name="ed">
        </div>
       <input type="hidden" class="form-control" name="cmpid" value="<? echo $cmpid;  ?>">
      <input class="btn btn-default" type="submit" value="导出">
    </form>
   	
   
   
   
   
   </div>

<?
mysql_close($con);
?>