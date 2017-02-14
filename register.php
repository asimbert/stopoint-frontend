<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include "header.php";
require_once 'inc/Bcrypt.php';

if(isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])){
	header('Location: '.$base_url.'/');
}
if (isset($_GET['reverid']) || isset($_POST['emailactivation'])) {
	$_POST['emailactivation'] = base64_encode($_POST['emailactivation']);
	if($_POST['emailactivation']){
		$_GET['reverid'] = $_POST['emailactivation'];
		$query =  "SELECT * from user WHERE EmailAddress = '".base64_decode($_GET['reverid'])."'";
		}
	else{
	$query =  "SELECT * from user WHERE EmailAddress = '".base64_decode($_GET['reverid'])."'";
	}
	$resultSet = mysql_query($query);
	$weresultSet = mysql_fetch_assoc($resultSet);
	
	$firstname = $weresultSet['FirstName'];
	$lastname = $weresultSet['LastName'];
	$email = base64_decode($_GET['reverid']);
	//$password = $weresultSet['Password'];
	$checkout = $_POST['checkout'];
	
	$name = $firstname.' '.$lastname;
	$subject = 'Stopoint ';
	$message_body = '<p>Thank you for registering with Stopoint. Your basic account has now been created. You can now read, comment, and share your experience about Stopoint by logging in with your user details. ';
	$to = $email;
	$email_from = "info@stopoint.com";
	$subject = $subject;
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="viewport" content="width=device-width" /></head><body>';
	$message .= '<h4>Hello, '.$name.',</h4>';
	$message .= $message_body;
	$message .= '<br /><br />Email : '.$email;
	//$message .= '<br />Password : '.$password;
	$message .= '<br /><br />Please note that to be able to manage orders, you will need to verify your email by clicking this link: ';
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
		$mail->IsHTML(true);
		$mail->CharSet = "text/html; charset=UTF-8;";
		$mail->SMTPDebug = 0;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; 
		$mail->Username = "stopoint@stopoint.com";  
		$mail->Password = EMAIL_CREDENTIAL;
		$mail->From = $email_from;
		$mail->FromName = "STOPOINT ";
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$sent = $mail->Send();
	
		
	if($sent){
		if($checkout){
			$_SESSION['fullname'] = $firstname." ".$lastname;
			$_SESSION['login_username'] = $firstname." ".$lastname;
			$_SESSION['login_email'] = $email;
			$_SESSION['login_id'] = $id;
			header('Location: '.$base_url.'/checkout2');	
		}
		else{
			$_SESSION['relogin_email'] = $email;
			header('Location: '.$base_url.'/login.php?err_msg=verification_resend');
		}
	}
}
 

if (isset($_POST['submit'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$emailid = base64_encode($email);
	
	$password = $_POST['password'];
	$hashedPassword = Bcrypt::hashPassword($password);
	
	$checkout = $_POST['checkout'];
		
	$query =  "SELECT * from user WHERE EmailAddress = '".$email."'";
	$resultSet = mysql_query($query);
	
	if(mysql_num_rows($resultSet) > 0){
		header('Location: '.$base_url.'/create-account/already_error');
               
	}else{
		$name = $firstname.' '.$lastname;
		$subject = 'Your account has been created on Stopoint';
		$message_body = '<p>Thank you for registering with Stopoint. Your basic account has now been created. You can now read, comment, and share your experience about Stopoint by logging in with your user details.';
		$to = $email;
		$email_from = "info@stopoint.com";
		$subject = $subject;		
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="viewport" content="width=device-width" /></head><body>';
		$message .= '<h4>Hello, '.$name.'!</h4>';
		$message .= $message_body;
		$message .= '<br /><br />Email : '.$email;
		//$message .= '<br />Password : '.$password;
		$message .= '<br /><br />Please note that to be able to manage orders, you will need to verify your email by clicking this link:';
		$message .= '<br /><a href="https://www.stopoint.com/login?err_msg=activate_success&status=0&id='.$emailid.'" target="_blank">Click Here to Activate</a>';
		$message .= '<br /><br />We hope to hear your feedback on how we can further improve your user experience.';
		$message .= '<br /><br />Thank you for joining us.';
		$message .= '<br />Sincerely,';
		$message .= '<br />STOPOINT</p>';
		$message .= '</body></html>';
		
		require_once 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->CharSet = "text/html; charset=UTF-8;";
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; 
		$mail->Username = "stopoint@stopoint.com";  
		$mail->Password = EMAIL_CREDENTIAL;
		$mail->From = $email_from;
		$mail->FromName = "STOPOINT ";
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body = $message;
		
		$sent = $mail->Send();
		
		
		if($sent){
			if(isset($_POST['acceptNewsletter'])){
				$newsletter = 1;
				
				require_once 'mailchimp/inc/MCAPI.class.php';
				$api = new MCAPI('8a31420b835f5eea4737c4cd3bacdaa0-us11');	
				$merge_vars = array('FNAME'=>$firstname, 'LNAME'=>$lastname);
				$retval = $api->listSubscribe( '0b4a57f447', $email, $merge_vars, 'html', false, true );
				
			}
			else{
				$newsletter = 0;
			}
			$newsletter = 1;
			$query = 'INSERT INTO user SET FirstName = "'.$firstname.'", LastName  = "'.$lastname.'",	EmailAddress  = "'.$email.'",	PasswordTmp  = "'.$hashedPassword.'", UserType  = "User", VerificationCode  = "'.$emailid.'", IsNewsletter = '.$newsletter;
			$result = mysql_query($query) or die(mysql_error());
			$id = mysql_insert_id();
			
			if($checkout){
				$_SESSION['fullname'] = $firstname." ".$lastname;
				$_SESSION['login_username'] = $firstname." ".$lastname;
				$_SESSION['login_email'] = $email;
				$_SESSION['login_id'] = $id;
				header('Location: '.$base_url.'/checkout2');	
			}
			else{
				$_SESSION['relogin_email'] = $email;
				header('Location: '.$base_url.'/login.php?err_msg=reg_success');
			}
		}else{
			header('Location: '.$base_url.'/create-account/reg_error');
		}
	}
}
?>
<!-- checkout --> 
<div class="container">
<div class="row text-center">
<h1 class="sub-heading">Register Account</h1>
</div><!-- row --> 
<?php
if($_GET['err_msg']== "reg_error"){
?>
	<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> please check the data you entered
  	</div>
<?php
}if($_GET['err_msg']== "already_error"){
?>
	<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> The entered e-mail address is already in use.
  	</div>
<?php
}
?>
<div class="row pad" style="margin-bottom:70px;">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<!--<p class="nc" style="color:red;">The entered e-mail address is already in use.--> <!--<a href="login">login page</a>.--><!--</p>-->
<form role="form" id="registrationForm" method="post" action="" class="form-horizontal validate-form">
<h1 class="form-heading">YOUR PERSONAL DETAILS</h1>
<div class="form-group">
  <label for="firstname"><img src="<?php echo $base_url; ?>/images/f-icon2.png"/>First Name *</label>
  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
</div>
<div class="form-group">
  <label for="lastname"><img src="<?php echo $base_url; ?>/images/f-icon2.png"/>Last Name</label>
  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
</div>
  <div class="form-group">
    <label for="email"><img src="<?php echo $base_url; ?>/images/f-icon1.png"/>Email Address *</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
  </div>
  <?php
  if($_REQUEST['checkout'] == 'true')
  {
	  
	  ?>
      <input type="hidden" name="checkout" value="true" />
	  <?php
	  
	  }
	  ?>
  <h1 class="form-heading">YOUR PASSWORD</h1>
 <div class="form-group">
    <label for="password"><img src="<?php echo $base_url; ?>/images/f-icon3.png"/>Password *</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
  </div>
   <div class="form-group">
    <label for="confirmpassword"><img src="<?php echo $base_url; ?>/images/f-icon3.png"/>Confirm Password *</label>
    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" onfocus="validatePass(document.getElementById('password'), this);" oninput="validatePass(document.getElementById('password'), this);" required>
  </div>
  

 <h1 class="form-heading">NEWSLETTER</h1>
<input type="checkbox" name="acceptNewsletter" value="news_agree" checked="checked"><p class="cb">I wish to subscribe to the Stopoint's newsletter.</p><br><br>
<input type="checkbox" name="acceptTerms" value="privacy_agree" required><p class="cb">I have read and agree to the <a href="privacypolicy" target="_blank">Privacy Policy</a>.</p><br><br>
  <button type="submit" class="submit-btn" name="submit">CREATE MY ACCOUNT</button>
</form>
</div>
</div><!-- end container --> 
<!-- end checkout -->
</div>
<?php
include "footer.php";
?>