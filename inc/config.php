<?php

#error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(0);
$base_url = 'https://www.stopoint.com';
$_SESSION['baseurl'] = $base_url;
//ini_set("display_errors",1);
$hostname = 'localhost';
$database = 'stopoint_db';
$username = 'stopoint_user';
$password = 'l[[k5kz#)Txn';
$db = mysql_connect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database,$db);

define("EMAIL_CREDENTIAL", "Svxgdlj1234!!#");

ob_start();
session_start();
?>
