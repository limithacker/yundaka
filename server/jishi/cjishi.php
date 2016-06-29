<?php

require "connect.inc.php";


$res=mysql_query("SELECT txt FROM work WHERE name='jishi'");

while ($uis=mysql_fetch_assoc($res))
{
    $str=$uis["txt"];
}

include_once "cjishi.html";
?>