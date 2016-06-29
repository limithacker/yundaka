<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="check.csv"');
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
$head = array('日期', '规则', '用户名', '签到状态');
foreach ($head as $i => $v) {
    // CSV的Excel支持GBK编码，一定要转换，否则乱码
    $head[$i] = iconv('utf-8', 'gb2312', $v);
}
 
// 将数据通过fputcsv写到文件句柄
fputcsv($fp, $head);
//var_dump($head);
 
 
 
 
 
//echo $cmpid;
$pr = mysql_query("select * from `ydk_check` where `date` >= '$sd' and `date` <= '$ed' and `cmpid`=$cmpid ;");
//$rows = mysql_fetch_array($pr);
//var_dump($rows);
//echo mysql_errno() . ": " . mysql_error(). "\n";
while ($row = mysql_fetch_array($pr)) {
 //var_dump($row);

	
	//转换userid-->username
	$userid=$row['userid'];
	$useridsql=mysql_query("select * from ydk_user where `uid`='$userid';");
	$useridfetch = mysql_fetch_array($useridsql);
	$usn=$useridfetch['name'];
	
	
	//转换ruleid-->rulename
	$rid=$row['ruleid'];
	$ridsql=mysql_query("select * from ydk_rule where `rid`='$rid';");
	$ridfetch = mysql_fetch_array($ridsql);
	$rulename=$ridfetch['rulename'];
	

	//转换打卡
	if($row['status']==1){
		$st="打卡成功";
	}
	else if($row['status']==2){
		$st="时间正确，位置错误";
	}
	else if($row['status']==3){
		$st="时间错误，位置正确";
	}
	else if($row['status']==4){
		$st="打卡失败";
	}

	
	$prtrow=array();
	array_push($prtrow,$row['date'],$rulename,$usn,$st);
	//var_dump($prtrow);
	foreach ($prtrow as $i => $v) {
    	$prtrow[$i] = iconv('utf-8', 'gb2312', $v);
    }

	
    fputcsv($fp, $prtrow); 
}


?>