<?php

require "connect.inc.php";

$res=mysql_query("SELECT txt FROM work WHERE name='jilu'");

while ($uis=mysql_fetch_assoc($res))
{
    $str=$uis["txt"];
}



include_once "jilu.html";
?>