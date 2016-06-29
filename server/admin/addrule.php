<?
session_start();
include "../common.inc.php";
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

$cmpid=$_SESSION['cmpid'];
$date=$_GET['date'];
$sh=$_GET['sh'];
$sm=$_GET['sm'];
$eh=$_GET['eh'];
$em=$_GET['em'];
$uid=$_GET['usid'];
$log=$_GET['plog'];
$lat=$_GET['plat'];
$r=$_GET['r'];
if($r<100){
	$r=100;
}
$rulename=$_GET['rulename'];

if(($lat=="")||($log=="")){
	echo "dataerror";
}


$sql="insert `ydk_rule`(`cmpid`,`date`,`rulename`,`userid`,`sh`,`sm`,`eh`,`em`,`loc`,`lat`,`r`) values($cmpid,'$date','$rulename',$uid,$sh,$sm,$eh,$em,'$log','$lat',$r);";
mysql_query($sql);//插入一条规则

$checkdatesql=mysql_query("SELECT * FROM ydk_checkdate where `date` ='$date' and `cmpid` ='$cmpid'");//查询该公司当天是否有规则
$rulerow = mysql_fetch_array($checkdatesql);
if($rulerow['id']==""){//未检出数据
	$checkdateaddsql=mysql_query("insert `ydk_checkdate`(`date`,`cmpid`) values('$date',$cmpid);");//标记该公司当天有规则
}


//header("Location:".$url."/admin/cmpcheck.php"); 

echo "1";

?>