<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("inc/config.php");
require_once 'inc/Bcrypt.php';

$query =  "SELECT * from user WHERE UserType = 'User' AND id >= 1301 AND id <= 1500";

$resultSet = mysql_query($query) or die(mysql_error());

while($weresultSet = mysql_fetch_assoc($resultSet)){
	//echo "ooooo";
	$id = $weresultSet['id'];
	$password = $weresultSet['Password'];
	$hashedPassword = Bcrypt::hashPassword($password);
	
	echo $id.":".$password.":".$hashedPassword.":".Bcrypt::checkPassword($password, $hashedPassword)."\n";
	
	echo mysql_query("UPDATE user SET `PasswordTmp` = '" . $hashedPassword . "' WHERE id='" . $id . "'") or die(mysql_error());
	echo "\n\n";
}
?>