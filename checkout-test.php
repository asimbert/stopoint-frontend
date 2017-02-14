<?php
include "header.php";
require_once 'inc/Bcrypt.php';

include_once("signtwitter/config.php");
/*if(isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])){
	header('Location: '.$base_url.'/index');
}*/

if (isset($_POST['checkout_submit'])) {

	$firstname = "Guest";
	$lastname = "User";
	$email = $_POST['email'];
	$emailid = base64_encode($email);
	$password = generatePassword(10);
	$hashedPassword = Bcrypt::hashPassword($password);
	
	$query =  "SELECT * from user WHERE EmailAddress = '".$email."'";
	$resultSet = mysql_query($query);
	//print_r($resultSet); 
	
	if(mysql_num_rows($resultSet) > 0){
		header('Location: '.$base_url.'/checkout/err_msg/true');
	}else{
		
		$name = $firstname;
		$subject = 'Activate Your account';
		$message_body = '<p>Thank you for registering with Stopoint. Your basic account has now been created, you can now read, comment and share opinions about Stopoint by logging in with your user details.';
		$to = $email;
		$email_from = "support@stopoint.com";
		$subject = $subject;
				
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="viewport" content="width=device-width" /></head><html><body>';
		$message .= '<h4>Dear, '.$name.',</h4>';
		$message .= $message_body;
		$message .= '<br /><br />Email : '.$email;
		$message .= '<br />Password : '.$password;
		$message .= '<br /><br />Please note that to be able to manage orders, you will need to verify your details by clicking this link.';
		$message .= '<br /><a href="https://www.stopoint.com/login.php?err_msg=activate_success&status=0&id='.$emailid.'" target="_blank">Click Here to Activate</a>';
		$message .= '<br /><br />We hope to hear your feedback on how we can further improve your user experience.';
		$message .= '<br /><br />Thank you for joining us.';
		$message .= '<br />Sincerely,';
		$message .= '<br />Stopoint</p>';
		$message .= '</body></html>';
		
		require_once 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 1;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; 
		$mail->Username = "stopoint@stopoint.com";  
		$mail->Password = EMAIL_CREDENTIAL;
		$mail->From = $email_from;
		$mail->FromName = "STOPOINT ";
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		//$mail->XMailer = ' ';
		$sent = $mail->Send();
		
		
		if(!$sent){
			
			header('Location: '.$base_url.'/register.php?err_msg=reg_error');	
		}else{
			
			$query = 'INSERT INTO user SET FirstName = "'.$firstname.'", LastName = "'.$lastname.'", EmailAddress  = "'.$email.'",	PasswordTmp  = "'.$hashedPassword.'", UserType  = "User", VerificationCode = "'.$emailid.'"';
			$result = mysql_query($query) or die(mysql_error());
			$id = mysql_insert_id();
			$_SESSION['login_username'] = $firstname.' '.$lastname;
			$_SESSION['login_email'] = $email;
			$_SESSION['login_id'] = $id;
			
			//header('Location: '.$base_url.'/login.php?err_msg=reg_success');
			header('Location: '.$base_url.'/checkout2');
		}
	}
}
?>
<!-- checkout --> 
<div class="container">
<div class="row text-center">
<h1 class="sub-heading">Express Checkout</h1>
</div><!-- row --> 
<?php
if($_GET['err_msg']== "already_error"){
?>
	<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> The Email you entered already exist, Please Register with another Email.
  	</div>
<?php
}
?>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<form role="form" method="post" class="validate-form" action="" onsubmit="return validateEmail(email,confirmemail)">
 
  <div class="form-group">
    <label for="email"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Email Address *</label>
    <input type="email" class="form-control email" id="email" name="email" placeholder="Email" required>
  </div>
  
  <div class="form-group">
    <label for="confirmemail"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Confirm Email *</label>
    <input type="email" class="form-control" id="confirmemail" name="confirmemail" placeholder="Confirm Email"  required>
  </div>
  
  <div class="form-group">
  	<button type="submit" name="checkout_submit" class="submit-btn">LOGIN</button>
  </div>
</form>

</div>
</div><!-- row --> 
<div class="social-log row pad col-lg-10 col-lg-offset-1">
<p class="col-lg-4 col-md-4">Create and account quickly and securely using your preferred social network account.</p>
<a><img onclick="FBLogincheck();" src="<?php echo $base_url; ?>/images/log-fb.png" alt="SignIn With Facebook"/></a>
<a href="<?php echo $base_url; ?>/signtwitter/process.php"><img src="<?php echo $base_url; ?>/images/log-tw.png" alt="SignIn With Twitter"/></a>
<!--<a href="microsoft_login_oauth/login.php"><img src="images/log-ms.png"/></a>-->
</div><!-- row --> 

<div class="row pad" style="margin-bottom:60px;">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<div class="col-lg-6 col-md-6">
<h1 class="sub-heading">New Customer</h1>
<p class="nc">By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
<a href="<?php echo $base_url?>/create-account/true" style="color:#454645;"><button type="button" class="submit-btn">CREATE AN ACCOUNT</button></a>
</div>


<div class="col-lg-6 col-md-6">
<h1 class="sub-heading">Registered Customers</h1>
<p class="nc">If you have an account with us, please log in.</p>
<form role="form" method="post" action="<?php echo $base_url; ?>/login_process">
  <div class="form-group">
    <label for="email"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Email Address *</label>
    <?php
    //if($_GET['checkout']=='true' && isset($_SESSION['model'])){
	?>
    <input type="hidden" name="check" id="checkout" value="true" />
    <?php	
		//}
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

</div><!-- end container --> 
<!-- end checkout -->

<!-- Forget Password PopUp -->
<div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="forgetPasswordLabel">Lost your password ?</h2>
        <h4 class="modal-title">Enter your email address. Password will be sent to your email address.</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="<?php echo $base_url; ?>/forget_process.php">
          <div class="form-group">
            <label for="Email" style="width:140px;">Email Address: *</label>
            <input type="email" class="form-control" id="email" name="email" style="padding-left:145px;" required>
          </div>
          <div class="form-group">
        	<button type="submit" name="forget_submit" class="submit-btn">Send</button>
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



<!-- END Forget Password PopUp -->

<?php
include "footer.php";
?>