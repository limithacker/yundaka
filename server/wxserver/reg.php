<?php
include "/common.inc.php";
header("Access-Control-Allow-Origin: *");
$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Lets Fvck this database!' . mysql_error());
  }
//else {echo "login database ok<\br>";}
$db_selected = mysql_select_db($database,$con);
if(!(isset($_GET['type'])&&isset($_GET['usn'])&&
   isset($_GET['psw'])&&isset($_GET['tel'])&&
   isset($_GET['type'])&&isset($_GET['name'])&&
   isset($_GET['cmpid'])))
{
	exit("Data Error,Fvck U");
}
$username=$_GET['usn'];
$password=$_GET['psw'];
$cmpid=$_GET['cmpid'];
$name=$_GET['name'];
$tel=$_GET['tel'];
if($_GET['type']=='1') //企业账户注册
{
	$sql="insert `ydk_company`(`cmpname`,`uid`,`avail`) values('$cmpid',0,'2017-05-05 21:02:21');"; //cmpid：企业名
	if (mysql_query($sql,$con))
	  {	  
	  	$cmpid=mysql_insert_id();//cmpid：id
	  	//echo "insert comp ok,id is".$cmpid."</br>";
		
		$sql="insert `ydk_user`(`username`,`password`,`cmpid`,`name`,`lock`,`type`,`tel`) 
				values('$username','$password',$cmpid,'$name',1,1,'$tel');";
			if (mysql_query($sql,$con))
			  {	  //echo "insert user ok</br>";
			  		echo "1";//返回1确认成功
			  
			  	  }
			else
			  {	  echo "insert user err " . mysql_error();	  }
		
	  }
	else
	  {	  echo "insert comp err" . mysql_error();	  }
	
	
	

}
else if($_GET['type']=='2')//个人用户注册
{
	$sql="insert `ydk_user`(`username`,`password`,`cmpid`,`name`,`lock`,`type`,`tel`) 
				values('$username','$password',$cmpid,'$name',1,2,'$tel');";
	if (mysql_query($sql,$con))
			  {	  //echo "insert user ok</br>";
			  		echo "1";//返回1确认成功
			  
			  	  }
			else
			  {	  echo "insert user err " . mysql_error();	  }
}
	

mysql_close($con);
?>