<?php
session_start();
if(!isset($_SESSION['userdata']))
{
    $content = '<a href="login.php"><img src="./images/microsoft_login.png" alt="Login with Microsoft"/></a>';
}
else
{
    $content = $_SESSION['userdata'];
	print_r($content);
}

$title = "Microsoft Live login OAuth PHP"; 
$heading = "Welcome to Microsoft Live login OAuth PHP example.";
include('html.inc');
?>