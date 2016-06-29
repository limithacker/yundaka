<?php //计算考勤
header("Content-type: text/html; charset=utf-8");
include "../common.inc.php";
function rad($d)  //弧度计算
{  
       return $d * 3.1415926535898 / 180.0;  
}  
function GetDistance($lat1, $lng1, $lat2, $lng2)  //球面两点距离
{  
    $EARTH_RADIUS = 6378.137;  
    $radLat1 = rad($lat1);  
    //echo $radLat1;  
   $radLat2 = rad($lat2);  
   $a = $radLat1 - $radLat2;  
   $b = rad($lng1) - rad($lng2);  
   $s = 2 * asin(sqrt(pow(sin($a/2),2) +  
    cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));  
   $s = $s *$EARTH_RADIUS;  
   $s = round($s * 10000) / 10000;  
   return $s;  
}  
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);

$date=$_GET['d'];//日期
$cmpid=$_GET['c'];//公司id

echo time();
echo "</br>";

$checkdelsql=mysql_query("delete from `ydk_check` where `date`='$date' and `cmpid` ='$cmpid';");//删除该公司当天计算数据，以防重复计算
//$checkdatedelsql=mysql_query("delete from `ydk_checkdate` where `date`='$date' and `cmpid` ='$cmpid';");

//$checkdatesql=mysql_query("insert `ydk_checkdate`(`date`,`cmpid`) values('$date',$cmpid);");
//$dateid=mysql_insert_id();
$sd=$date.' 00:00:00';
$ed=$date.' 23:59:59';

$rulesql=mysql_query("SELECT * FROM ydk_rule WHERE `cmpid` ='$cmpid' and `date` ='$date';");//取出rule
//$rulerow = mysql_fetch_array($rulesql);

$sql="select * from ydk_location where unix_timestamp(`time`) > unix_timestamp('$sd') and unix_timestamp(`time`) < unix_timestamp('$ed') and `cmpid`=$cmpid;";

//$locrow = mysql_fetch_array($locsql);
//var_dump($locrow);

while($rulerow = mysql_fetch_array($rulesql))//对该公司某天的每一条规则
{
	if($rulerow['rid']==""){
		exit("当天无任何考勤规则");
	}
	echo "载入考勤规则".$rulerow['rid']."成功...";
	$ruleId=$rulerow['rid'];
	$stime=$rulerow['sh'].':'.$rulerow['sm'].':00';//构造标准开始时间
	$sdate=$date.' '.$stime;//构造标准datetime
	$su=strtotime($sdate);
	$etime=$rulerow['eh'].':'.$rulerow['em'].':00';
	$edate=$date.' '.$etime;
	$eu=strtotime($edate);
	$ruleLoc=$rulerow['loc'];
	$ruleLat=$rulerow['lat'];
	$ruleR=$rulerow['r'];
	$ruleUid=$rulerow['userid'];
	echo "【Time:$su to $eu ,Lat:$ruleLat ，Log:$ruleLoc ,R:$ruleR 】";
	$usersql=mysql_query("SELECT * FROM ydk_user WHERE `uid` ='$ruleUid' and `cmpid` ='$cmpid';");//uid->username
	$userrow = mysql_fetch_array($usersql);
	$ruleUsername=$userrow['username'];
	echo "正在对用户 ".$ruleUsername." 进行计算...</br>";
	
	$locsql=mysql_query($sql);//取出打卡数据，限定时间范围、公司id
	if(mysql_num_rows($locsql)==0){//当天用户无任何考勤数据
		$status=4;
	
	}
	else{
		while($locrow = mysql_fetch_array($locsql))//与每一条地点信息的
		{
			if($locrow['username']==""){
				exit("当天无签到数据");
			}
			$username=$locrow['username'];
			if($username==strtolower($ruleUsername)||$username==strtoupper($ruleUsername)){//相同用户进行匹配，不区分大小写
				echo "---发现签到信息，正在计算...";
				$time=$locrow['time'];
				$u=strtotime($time);
				$loc=$locrow['log'];
				$lat=$locrow['lat'];
				echo "【Time:$u ,Lat:$lat ，Log:$loc 】";
				$distance=GetDistance($ruleLat,$ruleLoc,$lat,$loc);
				$distance=$distance*1000;//km-->m
				echo "与规则坐标距离为".$distance."米...</br>";
				if(($u>=$su)&&($u<=$eu)){
					if($distance<=$ruleR){
					$status=1;//时间地点均正确
					echo "---符合规则！</br>";
					break;//退出对location表的扫描，进行下一条规则匹配
					}
					else {
						$status=2;//时间正确地点不正确
					}
				}
				else if($distance<=$ruleR){
					$status=3;//时间不正确地点正确
				}
				else{
					$status=4;//时间地点均不正确
				}
			}//if	
		}//while
	}//if
	echo "---最终判定状态号".$status."</br>";
	//为每一条规则建立一个计算结果表
	$checksql=mysql_query("insert `ydk_check`(`cmpid`,`date`,`ruleid`,`userid`,`status`) values($cmpid,'$date',$ruleId,$ruleUid,$status);"); 
}
mysql_close($con);

?>

<script type="text/javascript">
window.onload=function(){
location.href = '<? echo getenv("HTTP_REFERER"); ?>';
}
</script>
