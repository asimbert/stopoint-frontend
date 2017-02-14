<?php
require("inc/config.php");

if (isset($_POST['forget_submit'])) {
	
	$email = $_POST['email'];
	$query = "SELECT * FROM user WHERE EmailAddress = '".mysql_real_escape_string($email)."'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	if(mysql_num_rows($result) > 0){
		$name = $row['FirstName'].' '.$row['LastName'];
		$subject = 'Your password on STOPOINT';
		$message_body = 'Your password for STOPOINT. You can now login using following password with email address.';
		$to = $email;
		$email_from = "support@stopoint.com";
		$subject = $subject;
		
		$id = base64_encode($row['EmailAddress']);
		$unq_str = substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,51 ) ,1 ) .substr( md5( time() ), 1);
		
		$qry = "UPDATE user SET SecretKey='".$unq_str."' WHERE id=".$row['id'];
		mysql_query($qry);
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="viewport" content="width=device-width" /></head><body>';
		$message .= '<h4>Dear, '.$name.'!</h4>';
		//$message .= '<p>'.$message_body.'</p>';
		//$message .= '<p>Email : '.$email.'</p>';
		//$message .= '<p>Password : '.$row['Password'].'</p>';
		$message .= '<br />Please click on the below link to reset your password: ';
		$message .= '<br /><a href="https://www.stopoint.com/reset-password.php?err_msg=reset_password&status=0&key='.$unq_str.'&id='.$id.'" target="_blank">Click Here to Reset</a>';
		$message .= '<p>Thanks,</p>';
		$message .= '<p>From: STOPOINT</p>';
		$message .= '</body></html>';

              
		
		require_once 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();
                $mail->IsHTML(true);
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
		//$mail->XMailer = ' ';
		$sent = $mail->Send();
	 
		//$sent = mail($to, $subject, $message, $headers);
		
		if($sent){
			header('Location: '.$base_url.'/login-test.php?err_msg=forget_success');
		}
	 
		else{
			header('Location: '.$base_url.'/login?err_msg=forget_error'); 
		}
	}
	else{
			header('Location: '.$base_url.'/login?err_msg=email_notexist_error'); 
	}
}
?>