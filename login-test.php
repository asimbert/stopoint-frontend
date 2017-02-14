<?php
include "header.php";
include_once("signtwitter/config.php");
//include_once("signtwitter/inc/twitteroauth.php");
//require_once 'google_login_oauth/src/Google_Client.php';
//require_once 'google_login_oauth/src/contrib/Google_Oauth2Service.php';
			if(isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])){
			header('Location: '.$base_url.'/');
			}
			if($_GET['err_msg']=="activate_success"){
			if($_GET['status']=="0"){
			$email=base64_decode($_GET['id']);
			$query = "UPDATE user SET Status='1', VerificationCode = '' WHERE EmailAddress='".$email."'";		
			$result = mysql_query($query) or die(mysql_error());
			$user_id = mysql_insert_id();
			}
			}
			?>
			 
			<div class="container">
				<div class="row text-center">
					<h1 class="sub-heading">Log In</h1>
				</div>
				<?php
                if($_GET['err_msg']== "login_error"){
                ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Username or password is incorrect, or Account Suspended.
                    
                </div>
               
            <?php
				
                }if($_GET['err_msg']== "forget_success"){
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Your password has been successfully sent to your Primary Email address.
                </div>
				<?php
                }if($_GET['err_msg']== "forget_error"){
                ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> There was an error, Please try again.
                </div>
				<?php
                }if($_GET['err_msg']== "activate_success"){
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Your account has been activated, now you can logged in to access your account.
                </div>
				<?php
                }if($_GET['err_msg']== "reg_success"){
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> You have been successfully registered on our site. A confirmation link has been sent to your email. Please confirm your email to continue. Thank you.
                </div>
            <?php
            }if($_GET['err_msg']== "reset_password_success"){
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> You have been successfully reset your password.
                </div>
            <?php
            }if($_GET['err_msg']== "email_notexist_error"){
            ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Email entered does not exist. Please enter valid Email Address.
                </div>
            <?php
            }if($_GET['err_msg']== "verification_resend"){
            ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> A confirmation link has just been resent to your email address. Thank you.
                </div>
            <?php
            }if($_GET['err_msg']== "login_resend"){
            ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Your account is not yet verified. A confirmation link has been sent to your email address. Please confirm your email to continue.
                </div>
            <?php
            }
if(isset($_SESSION['relogin_email']) || $_GET['err_msg']== "login_resend"){
	
	if(isset($_SESSION['relogin_email']))
	{
		$emailid = base64_encode($_SESSION['relogin_email']);
		$useremail = $_SESSION['relogin_email'];
	}
	elseif($_GET['err_msg'] == "login_resend")
	{
		$emailid = $_GET['reid'];
		$useremail = base64_decode($_GET['reid']);
	}

	$useremail;
	$query = "SELECT * FROM user WHERE EmailAddress = '".$useremail."'";
	$reuser = mysql_query($query);
	$weuser = mysql_fetch_assoc($reuser);
	
	if($weuser['Status'] == 0 && $weuser['VerificationCode'] != ''){
?>
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

<p>If you did not receive the verification email, <a href="<?php echo $base_url; ?>/register.php?reverid=<?=$emailid?>">CLICK HERE</a> to receive one. Remember to check your SPAM FOLDER</p>
</div>
<?php }}?>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<form role="form" method="post" class="validate-form" action="<?php echo $base_url; ?>/login_process2.php">
<div class="form-group">
<label for="email"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Email Address *</label>
<?php
    if($_GET['checkout']=='true' && isset($_SESSION['model'])){
	?>
    <input type="hidden" name="check" id="checkout" value="true" />
    <?php	
		}
		?>
<input type="email" class="form-control" id="emailaddress" name="emailaddress" required="required">
</div>
<div class="form-group">
<label for="password"><img src="<?php echo $base_url; ?>/images/f-icon3.png" alt="Icon"/>Password *</label>
<input type="password" class="form-control" id="password" name="password" required="required">
</div>

<div class="form-group">
<a href="#forgetPassword" data-toggle="modal"><p class="f-password">Forgot your password?</p></a>
<a href="#resendactivation" data-toggle="modal"><p class="f-password">Resend Activation Email&nbsp&nbsp&nbsp&nbsp&nbsp</p></a>
<button type="submit" name="login_submit" class="submit-btn">LOGIN</button>
</div>
</form>
</div>
</div>

<div class="social-log row pad col-lg-10 col-lg-offset-1">
<p class="col-lg-4 col-md-4">Create an account quickly and securely by using your preferred social media account.</p>
<a><img onclick="FBLogin();" src="<?php echo $base_url; ?>/images/log-fb.png" alt="SignIn With Facebook"/></a>
<a href="<?php echo $base_url; ?>/signtwitter/process.php"><img src="<?php echo $base_url; ?>/images/log-tw.png" alt="SignIn With Twitter"/></a>

</div>
<div class="row pad" style="margin-bottom:60px;">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<div class="col-lg-12">
<h1 class="sub-heading">New Customer</h1>
<p class="nc">By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
<a href="<?php echo $base_url; ?>/create-account" style="color:#454645;"><button type="button" class="submit-btn">CREATE AN ACCOUNT</button></a>
</div>
</div>
</div>
</div>
<div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h2 class="modal-title" id="forgetPasswordLabel">Forgot your password?</h2>
<h4 class="modal-title">Enter your email address. Password will be sent to your Primary Email address.</h4>
</div>
<div class="modal-body">
<form role="form" method="post" action="forget_process2.php">
<div class="form-group">
<label for="Email" style="width:140px;">Email Address: *</label>
<input type="email" class="form-control" id="email" name="email" style="padding-left:145px;" required>
</div>
<div class="form-group">
<button type="submit" name="forget_submit" class="submit-btn" value="1">Send</button>
<button type="button" class="submit-btn" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="resendactivation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h2 class="modal-title" id="forgetPasswordLabel">Resend Activation Email: </h2>
<h4 class="modal-title">Please enter your email address so we can send you a new account activation link.</h4>
</div>
<div class="modal-body">
<form role="form" method="post" action="register.php">
<div class="form-group">
<label for="Email" style="width:140px;">Email Address: *</label>
<input type="email" class="form-control" id="emailactivation" name="emailactivation" style="padding-left:145px;" required>
</div>
<div class="form-group">
<button type="submit" name="forget_submit" class="submit-btn" value="1">Send</button>
<button type="button" class="submit-btn" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
include "footer.php";
if($_GET['err_msg']== "reg_success"){  
//For mailchimp
include_once( 'inc/MCAPI.class.php' );  
$api = new MCAPI('1a2e8827797f0ed884437648f8b2ecae-us11');

$retval = $api->listSubscribe( "5c3f2522ee", $_SESSION['relogin_email'], $merge_vars ); 

/*if ($api->errorCode)
{
	echo "Unable to load listSubscribe()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
} 
else 
{
	echo "Subscribed - look for the confirmation email!\n";
}*/
//end for mailchimp               
            
}

?>