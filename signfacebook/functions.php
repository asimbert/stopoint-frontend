<?php
require 'dbconfig.php';
session_start();
function checkuser($fuid,$ffname,$lname,$femail,$image){
    $check = mysql_query("select * from user where fuid='$fuid'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO user (fuid,FirstName,LastName,EmailAddress,image_url,UserType) VALUES ('$fuid','$ffname','$lname','$femail','$image','User')";
	mysql_query($query);	
	$_SESSION['login_id'] = mysql_insert_id();
	
	} else {   // If Returned user . update the user record		
	$queryuser = "SELECT * from user where fuid='$fuid'";
	$userid = mysql_query($queryuser);
	$rowid = mysql_fetch_array($userid);
	
	$query = "UPDATE user SET FirstName='$ffname',LastName='$lname', EmailAddress='$femail',UserType='User' where fuid='$fuid'";
	mysql_query($query);
	$_SESSION['login_id'] = $rowid['id'];
	
	}
	
}
?>
