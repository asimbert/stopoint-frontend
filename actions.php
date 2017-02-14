<?php
//include 'library.php';

require 'signfacebook/functions.php';

session_start();
/*
CREATE TABLE `demo`.`fblogin` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fb_id` INT( 20 ) NOT NULL ,
`name` VARCHAR( 300 ) NOT NULL ,
`email` VARCHAR( 300 ) NOT NULL ,
`image` VARCHAR( 600 ) NOT NULL,
`postdate` DATETIME NOT NULL
) ENGINE = InnoDB;
*/
$action = $_REQUEST["action"];
if(isset($_REQUEST["nocheckout"])){
$nocheckout = $_REQUEST["nocheckout"];
}
switch($action){ 
	case "fblogin":
	include 'facebook.php';
	$appid 		= "913710248641693";
	$appsecret  = "3f8f12f67b28496576fdb6b9c90786d8";
	$facebook   = new Facebook(array(
  		'appId' => $appid,
  		'secret' => $appsecret,
  		'cookie' => TRUE,
	));
	$fbuser = $facebook->getUser();
		if ($fbuser) {
		try {
		    $user_profile = $facebook->api('/'.$fbuser);
			
		}
		catch (Exception $e) {
			echo $e->getMessage();
			exit();
		}
		 $user_fbid	= $fbuser;
		 $user_email = $user_profile["email"];
		 $user_fnmae = $user_profile["first_name"];
		 $user_lname = $user_profile["last_name"];
		
		$_SESSION['fullname'] = $user_profile['first_name']." ".$user_profile["last_name"];
		$_SESSION['login_username'] = $user_profile['first_name']." ".$user_profile["last_name"];
		$_SESSION['login_email'] = $user_email;
		$image = $user_fbid; 
		 $_SESSION['FBID'] = $user_fbid;
		//$user_image = "https://graph.facebook.com/".$user_fbid."/picture?type=large";
		//$_SESSION['fbimg'] = $user_image;
		//$check_select = mysql_num_rows(mysql_query("SELECT * FROM `site_users` WHERE email = '$user_email'"));
		//if(!isset($check_select)){
			//mysql_query("INSERT INTO `fb_users` (fb_id, name, email, image) VALUES ('$user_fbid', '$user_fnmae', '$user_email', '$user_image')");
			//mysql_query("INSERT INTO `site_users` (first_name, last_name) VALUES ('$user_fnmae', '$user_lname')");
			//echo "INSERT INTO `fb_users` (fb_id, name, email, image) VALUES ('$user_fbid', '$user_fnmae', '$user_email', '$user_image')";
			//exit;
		//}
		$checkuser = checkuser($user_fbid,$user_fnmae,$user_lname,$user_email, $image);
		
		
  $fbase_url = "https://www.stopoint.com";
  
	if(isset($nocheckout) == 'false'){
	header('Location: '.$fbase_url.'/');		
		}
	else{
	header('Location: '.$fbase_url.'/checkout2');	
		}
	
		
  
	  
	}
	break;
	
	
}
?>