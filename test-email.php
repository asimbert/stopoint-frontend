<?php
require("inc/config.php");
$email = "binoyk@bluecodix.com";
$emailid = "binoyk@bluecodix.com";
$name = "Binoy K";
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
$mail->SMTPDebug = 1;
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