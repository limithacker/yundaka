<?
require "connect.inc.php";

$tp=$_POST["tp"];
$str=$_POST["str"];

if ($tp==1)
{
  mysql_query("UPDATE work SET txt=CONCAT(txt,'{$str}') WHERE name='jishi'");	
}
else
{
 mysql_query("UPDATE work SET txt='{$str}' WHERE name='jilu'");
}

echo 1;

?>