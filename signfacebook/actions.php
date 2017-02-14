<?php
include 'library.php';
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
		    $user_profile = $facebook->api('/me');
		}
		catch (Exception $e) {
			echo $e->getMessage();
			exit();
		}
		$user_fbid	= $fbuser;
		echo $user_email = $user_profile["email"];
		echo $user_fnmae = $user_profile["first_name"];
		echo $user_lname = $user_profile["last_name"];
		exit;
		$_SESSION['fullname'] = $user_profile['first_name']." ".$user_profile["last_name"];
		$_SESSION['login_username'] = $user_fnmae;
		$_SESSION['emailaddress'] = $user_email;
		$user_image = "https://graph.facebook.com/".$user_fbid."/picture?type=large";
		$_SESSION['fbimg'] = $user_image;
		$check_select = mysql_num_rows(mysql_query("SELECT * FROM `site_users` WHERE email = '$user_email'"));
		if(!isset($check_select)){
			mysql_query("INSERT INTO `fb_users` (fb_id, name, email, image) VALUES ('$user_fbid', '$user_fnmae', '$user_email', '$user_image')");
			mysql_query("INSERT INTO `site_users` (first_name, last_name) VALUES ('$user_fnmae', '$user_lname')");
			//echo "INSERT INTO `fb_users` (fb_id, name, email, image) VALUES ('$user_fbid', '$user_fnmae', '$user_email', '$user_image')";
			//exit;
		}
		header('Location: index.php');
	}
	break;
	
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asif18 tutorial about facebook login for mywebsite using php sdk</title>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	appId      : '913710248641693', // replace your app id here
	channelUrl : '//unidevphp.com/nigeria_says', 
	status     : true, 
	cookie     : true, 
	xfbml      : true  
	});
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));

function FBLogout(){
	FB.logout(function(response) {
		window.location.href = "index.php";
	});
}
</script>
<style>
body{
	font-family:Arial;
	color:#333;
	font-size:14px;
}
.mytable{
	margin:0 auto;
	width:600px;
	border:2px dashed #17A3F7;
}
a{
	color:#0C92BE;
	cursor:pointer;
}
</style>
</head>

<body>
<h1>Asif18 tutorial for facebook ling using php, javascript sdk dymaically</h1>
<h3>here is the user details, for more details </h3>
<table class="mytable">
<tr>
	<td colspan="2" align="left"><h2>Hi <?php echo $user_fnmae.$user_email; ?>,</h2><a onClick="FBLogout();">Logout</a></td>
</tr>
<tr>
	<td><b>Fb id:<?php echo $user_fbid; ?></b></td>
    <td valign="top" rowspan="2"><img src="<?php echo $user_image; ?>" height="100"/></td>
</tr>
<tr>
	<td><b>Email:<?php echo $user_email; ?></b></td>
</tr>
</table>
</body>
</html>