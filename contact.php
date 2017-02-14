<?php
include "header.php";

if (isset($_POST['contact_submit'])) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$emailid = base64_encode($email);
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	$name = $firstname.' '.$lastname;
	$subject = $subject;
	$message_body = $message;
	$to = "stopoint@stopoint.com";
	$email_from = $email;
	$subject = $subject;
			
	$message = '<html><body>';
	$message .= '<h4>Dear, Sir!</h4>';
	$message .= '<p>'.$message_body.'</p>';
	$message .= '<p>Thanks.</p>';
	$message .= '<p>Sincerely,</p>';
	$message .= '<p>'.$name.'</p>';
	$message .= '</body></html>';
	
	require_once 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; 
		$mail->Username = "stopoint@stopoint.com";  
		$mail->Password = EMAIL_CREDENTIAL;
		$mail->Sender='admin@yourdomain.com';
		$mail->SetFrom($email_from,$name,TRUE);
		$mail->From = $email_from;
		$mail->FromName = $name;
		$mail->AddReplyTo($email_from, 'Reply to '.$name);
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		//$mail->XMailer = ' ';
		$sent = $mail->Send();
		 

	//$sent = mail($to, $subject, $message, $headers);
		
	if($sent){
			
		//$query = 'INSERT INTO user SET FirstName = "'.$firstname.'", EmailAddress  = "'.$email.'",	Password  = "'.$password.'", UserType  = "User"';
		//$result = mysql_query($query) or die(mysql_error());
		header('Location: '.$base_url.'/contact.php?err_msg=contact_success');
	}else{
		header('Location: '.$base_url.'/contact.php?err_msg=contact_error');
	}
}
?>
<!-- checkout --> 
<div class="container">
<div class="row text-center">
<h1 class="sub-heading">Contact Us</h1>
</div><!-- row --> 
<?php
if($_GET['err_msg']== "contact_success"){
?>
	<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Your message has been sent successfully. ... We'll get back to you very soon. ... We have received your enquiry and will respond to you within 24 hours. ... If you still don't receive an email, then write to support@stopoint.com explaining the problem. ... We'll get back to you as soon as possible, usually within a few hours.
  	</div>
<?php
}elseif($_GET['err_msg']== "contact_error"){
?>
	<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> Failed to send your message. Please try again later or contact the administrator by another method. You can try calling us at 1(888)246-4919 or Chat with an expert online. Rest assured that we are working to resolve the problem as soon as possible. We apologize for the inconvenience.
  	</div>
<?php
}
?>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<form role="form" method="post" action="">
    <div class="form-group">
      <label for="firstname"><img src="<?php echo $base_url; ?>/images/f-icon2.png" alt="Icom"/>First Name *</label>
      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
    </div>
    
    <div class="form-group">
      <label for="lastname"><img src="<?php echo $base_url; ?>/images/f-icon2.png" alt="Icon"/>Last Name </label>
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
    </div>
    
    <div class="form-group">
      <label for="email"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Email Address *</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>
    
    <div class="form-group">
      <label for="subject"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Subject *</label>
      <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
    </div>
    
    <div class="form-group">
      <label for="message"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Message *</label>
      <textarea name="message" id="message" class="form-control" placeholder="Message" required="required"></textarea>
    </div>

    <div class="form-group">
  	  <button type="submit" name="contact_submit" class="submit-btn">SEND</button>
    </div>
</form>

<h2 style="font-size:15px;"><li>For customer support, please contact us at <a href="mailto:support&#64;stopoint&#46;com" title="Stopoint Email">support@stopoint.com</a></li></h2>

<h2 style="font-size:15px;"><li>
For media and analyst inquiries, please contact us at <a href="mailto:pr&#64;stopoint&#46;com" title="Stopoint Email">pr@stopoint.com</a></li>
</h2>

<h2 style="font-size:15px;">Stopoint HQ<br/>
1175 NE 125th ST STE 211<br/>
Miami, Florida 33161</h2>

 <div><span style="float:left">For general office and administrative business:</span>&nbsp; <span style="float:left"><a href="tel:+1-888-246-4919" class="phoneanchor" style="margin-top:0px">1 (888) 246-4919</a></span></div> <br/><br/><br/>
</div>

</div> 


</div><!-- end container --> 
<!-- end checkout -->

<?php
include "footer.php";
?>