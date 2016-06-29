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

$rid=$_GET['rid'];
$sql=mysql_query("delete from `ydk_rule` where `rid`=$rid;");
$r=$_SERVER['HTTP_REFERER'];
header("Location:$r"); 
mysql_close($con);
?>