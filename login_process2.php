<?php

require("inc/config.php");
require_once 'inc/Bcrypt.php';

if (isset($_POST['login_submit'])) {
	$email = $_POST['emailaddress'];

	$id = base64_encode($email);

	$password = $_POST['password'];
	//$hashedPassword = Bcrypt::hashPassword($password);
	
	
	$checkout = $_POST['check'];

	$query =  "SELECT * from user WHERE EmailAddress = '".$email."' AND UserType = 'User'";

	$resultSet = mysql_query($query);

	$weresultSet = mysql_fetch_assoc($resultSet);

	if(mysql_num_rows($resultSet) > 0 && Bcrypt::checkPassword($password, $weresultSet['PasswordTmp'])){

		if($weresultSet['Status'] == 1 && $weresultSet['VerificationCode'] == ''){

			$_SESSION['login_username'] = $weresultSet['FirstName'].' '.$weresultSet['LastName'];

			$_SESSION['login_email'] = $weresultSet['EmailAddress'];

			$_SESSION['login_id'] = $weresultSet['id'];

			if($checkout == "true"){

				header('Location: '.$base_url.'/checkout2');	

			}

			else{

				header('Location: '.$base_url.'/dashboard-test2.php');

			}

		}

		else{
			

$query =  "SELECT * from user WHERE EmailAddress = '".base64_decode($id)."'";
	$resultSet = mysql_query($query);
	$weresultSet = mysql_fetch_assoc($resultSet);
	
	$firstname = $weresultSet['FirstName'];
	$lastname = $weresultSet['LastName'];
	$email = base64_decode($id);
	//$password = $weresultSet['Password'];
	$checkout = $_POST['checkout'];
	
	$name = $firstname.' '.$lastname;
	$subject = 'Stopoint ';
	$message_body = '<p>Thank you for registering with Stopoint. You can activatre your account. ';
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
	$message .= '<br /><a href="https://www.stopoint.com/login-test.php?err_msg=activate_success&status=0&id='.$id.'" target="_blank">Click Here to Activate</a>';
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
				header('Location: '.$base_url.'/login-test.php?err_msg=login_resend&reid='.$id);

		}
		}

	}

	

	else{

			if($weresultSet['EmailAddress'] == $email && $weresultSet['Status'] == 0){

				if($checkout == "true"){

					header('Location: '.$base_url.'/login-test.php?checkout=true&err_msg=login_resend&reid='.$id);	

				}

				else{

					header('Location: '.$base_url.'/login-test.php?err_msg=login_resend&reid='.$id);

				}

			}else{

				if($checkout == "true"){

					header('Location: '.$base_url.'/login-test.php?checkout=true&err_msg=login_error');	

				}

				else{

					header('Location: '.$base_url.'/login-test.php?err_msg=login_error');

				}

			}

	}

}

?>