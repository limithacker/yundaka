<?

require "connect.inc.php";

echo "开始安装";

mysql_query("CREATE TABLE `work` (
`name`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' ,
`txt`  varchar(20000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`name`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=COMPACT
;");

mysql_query("INSERT INTO `work` VALUES ('jilu', '')");
mysql_query("INSERT INTO `work` VALUES ('jishi', ' ')");

echo "安装完成";

?>