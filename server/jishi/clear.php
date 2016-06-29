<?php
require "connect.inc.php";

 mysql_query("UPDATE work SET txt='' WHERE name='jishi'");

header("Location:index.php");
?>