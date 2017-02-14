<?php 
session_start();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
$fbase_url = "http://stopoint.com";
header('Location: '.$fbase_url.'/index.php');        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
