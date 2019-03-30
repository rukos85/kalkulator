<?php
header('Content-Type: text/html; charset= utf-8');
$dblocation = "localhost";
$dbname = "calculator";
$dbuser = "root";
$dbpasswd = "";
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
if (!$dbcnx) {
echo( mysql_error() );
exit();
}
mysql_query("SET NAMES utf8",$dbcnx);
if (!@mysql_select_db($dbname, $dbcnx)) {
echo( mysql_error() );
exit();
}
?>