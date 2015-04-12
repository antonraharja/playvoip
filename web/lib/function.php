<?
$server = @mysql_connect($conf_db['host'],$conf_db['user'],$conf_db['pass']) or die("Fail to connect to DB server");
@mysql_select_db($conf_db['name']) or die("Fail to select DB");
include "lib/astconfconn.php";
include "lib/logger.php";
include "lib/usermgmnt.php";
?>