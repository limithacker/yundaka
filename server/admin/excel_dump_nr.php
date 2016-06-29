<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="pos.csv"');
header('Cache-Control: max-age=0');
 
include "../common.inc.php";
$sd=$_GET['sd'];
$ed=$_GET['ed'];
$cmpid=$_GET['cmpid'];
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

 
// 打开PHP文件句柄，php://output 表示直接输出到浏览器
$fp = fopen('php://output', 'a');


 
 
// 输出Excel列名信息
$head = array('日期时间', '员工', '详细位置', '所在街道','经度','纬度');
foreach ($head as $i => $v) {
    // CSV的Excel支持GBK编码，一定要转换，否则乱码
    $head[$i] = iconv('utf-8', 'gb2312', $v);
}
 
// 将数据通过fputcsv写到文件句柄
fputcsv($fp, $head);
//var_dump($head);
 

$pr = mysql_query("select * from `ydk_location` where `time` >= '$sd 00:00:00' and `time` <= '$ed 00:00:00' and `cmpid`=$cmpid;");
while ($row = mysql_fetch_array($pr)) {
	//转换用户名-->姓名
	$usn=$row['username'];
	$usnResult = mysql_query("SELECT * FROM `ydk_user` WHERE `username`='$usn';");
	$usnRow = mysql_fetch_array($usnResult);

	
	$prtrow=array();
	array_push($prtrow,$row['time'],$usnRow['name'],$row['position'],$row['street'],$row['lat'],$row['log']);
	//var_dump($prtrow);
	foreach ($prtrow as $i => $v) {
    	$prtrow[$i] = iconv('utf-8', 'gb2312', $v);
    }

	
    fputcsv($fp, $prtrow); 
}


?>