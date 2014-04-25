<?php

if(!defined('ROOT_DIR')) {
	define('ROOT_DIR1', '../');
	require_once(ROOT_DIR1 . 'config/config.php');
}
else 
	require_once(ROOT_DIR . 'config/config.php');

$mysql_hostname = $conf['settings']['database']['hostspec'];;
$mysql_user = $conf['settings']['database']['user'];
$mysql_password = $conf['settings']['database']['password'];
$mysql_database = $conf['settings']['database']['name'];
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>