<?php

include_once 'header.php';



if(!isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])){

	header('Location: '.$base_url.'/');

}

$id = $_GET['id'];
mysql_query("UPDATE messages SET `IsRead` = '1' WHERE id=" . $id) or die(mysql_error());

//$msg_query = "SELECT messages.id as id,messages.Subject as Subject,messages.Comments as Comments,messages.ToId as ToId,messages.Date as Date, messages.parentid as parentid, messages.OrderId as OrderId, user.id as userid, user.FirstName as FirstName, user.LastName as LastName, user.EmailAddress as Email, user.image_url as Image FROM `messages` INNER JOIN user on messages.FromId = user.id INNER JOIN `order` on messages.OrderId = order.id WHERE messages.id = ".$id;
$msg_query = "SELECT * from messages WHERE id = ".$id;
$remsg_query = mysql_query($msg_query);

$weremsg_query = mysql_fetch_assoc($remsg_query);



$user = "SELECT * FROM `user` WHERE id = ".$_SESSION['login_id'];

$reuser = mysql_query($user);

$weuser = mysql_fetch_assoc($reuser);



$subject = "SELECT * FROM `messages` WHERE id = ".$weremsg_query['parentid'];

$resubject = mysql_query($subject);

$wesubject=mysql_fetch_assoc($resubject);

//echo "RE: ".$wesubject['Subject']; 
$track_query = mysql_query('select * from `order` where id="'.$weremsg_query['OrderId'].'"');
    $row_fetch = mysql_fetch_array($track_query);
?>



<?php

if (isset($_POST['submit_reply'])) {

	if($_POST){

    $name = $wesubject['FirstName'].' '.$weuser['LastName'];

    $email = $wesubject['Email'];

	$subject = $_POST['r_subject'];

    $message_body = $_POST['r_message'];

	$to = $email;

	$email_from = $weuser['EmailAddress'];

	$subject = $subject;

	$headers = "From: STOPOINT <".$email_from.">\r\n";

	$headers .= "MIME-Version: 1.0\r\n";

	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	

	$message = '<html><body>';

	$message .= '<h4>Dear, '.$name.'!</h4>';

	$message .= '<p>'.$message_body.'</p><br>';

	$message .= '<p>Thanks</p>';

	$message .= '<p>From:'.$weuser['FirstName'].' '.$weuser['LastName'].'</p>';

	$message .= '</body></html>';

 

 	$sent = mail($to, $subject, $message, $headers);

	//if($sent){

		//echo 'INSERT INTO messages SET FromId = "'.$_SESSION['login_id'].'", ToId  = "'.$weremsg_query['userid'].'",	OrderId  = "'.$weremsg_query['OrderId'].'",	Subject  = "'.$subject.'", Comments  = "'.$message_body;exit;

		mysql_query('INSERT INTO messages SET FromId = "'.$_SESSION['login_id'].'", ToId  = "'.$_SESSION['login_id'].'",OrderId  = "'.$weremsg_query['OrderId'].'",parentid  = "'.$id.'",Subject  = "'.$subject.'", Comments  = "'.$message_body.'"') or die(mysql_error());

		header('Location: '.$base_url.'/dashboard.php?tab=tab5&err_msg=email_send_success');

		//}

 

// 	else{
//
//		header('Location: '.$base_url.'/dashboard.php?tab=tab5&err_msg=email_send_fail'); 
//
//		}

}

}





if (isset($_POST['submit_newmsg'])) {

	if($_POST){

    $name = "Admin";

    $email = "support@stopoint.com";

	$subject = $_POST['new_subject'];

    $message_body = $_POST['new_message'];

	$to = $email;

	$email_from = $weuser['EmailAddress'];

	$subject = $subject;

	$headers = "From: STOPOINT <".$email_from.">\r\n";

	$headers .= "MIME-Version: 1.0\r\n";

	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	

	$message = '<html><body>';

	$message .= '<h4>Dear, '.$name.'!</h4>';

	$message .= '<p>'.$message_body.'</p><br>';

	$message .= '<p>Thanks</p>';

	$message .= '<p>From:'.$weuser['FirstName'].' '.$weuser['LastName'].'</p>';

	$message .= '</body></html>';

 

 	$sent = mail($to, $subject, $message, $headers);

	if($sent){

		mysql_query('INSERT INTO messages SET FromId = "'.$_SESSION['login_id'].'", ToId  = 0,	OrderId  = "'.$weremsg_query['OrderId'].'",	parentid  = 0,	Subject  = "'.$subject.'", Comments  = "'.$message_body.'"') or die(mysql_error());

		header('Location: '.$base_url.'/dashboard.php?tab=tab5&err_msg=email_send_success');

		}

 

 	else{

		header('Location: '.$base_url.'/dashboard.php?tab=tab5&err_msg=email_send_fail'); 

		}

}

}

?>



<!-- checkout --> 

<div class="container">

<div class="row text-center">

<h1 class="sub-heading">Message</h1>

</div><!-- row -->

<div class="row pad" style="margin-bottom:70px;">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

<form role="form">

<div class="form-group">

  <label for="OrderId">Tracking No :</label>

  <input type="text" class="form-control" name="OrderId" id="OrderId" value="<?=$row_fetch['TrackingCode']?>" placeholder="Tracking Number" readonly="readonly">

</div>

<div class="form-group">

  <label for="From_Msg">From :</label>

  <input type="text" class="form-control" name="From_Msg" id="From_Msg" value="<?=$weuser['FirstName'].' '.$weuser['LastName']?>" placeholder="From" readonly="readonly">

</div>

<div class="form-group">

  <label for="Date">Date :</label>

  <input type="text" class="form-control" name="Date" id="Date" value="<?=date('m/d/Y h:i:s', strtotime($weremsg_query['Date']))?>" placeholder="Order Date" readonly="readonly">

</div>

<div class="form-group">

  <label for="Subject">Subject :</label>

  <input type="text" class="form-control" name="Subject" id="Subject" value="<?php 

  if(!isset($_GET['sent'])){

  echo "RE: ".$wesubject['Subject'];

  }else{

	  echo $weremsg_query['Subject'];

  }

  ?>" placeholder="Subject" readonly="readonly">

</div>

<div class="form-group">

  <label for="Message">Message :</label>

  <textarea name="message" id="message" class="form-control" placeholder="Message" readonly="readonly"><?=$weremsg_query['Comments']?></textarea>

</div>

<br />

</form>

<?php

if(!isset($_GET['sent'])){

?>

<button id="button" class="submit-btn">Reply</button>

<button id="button1" class="submit-btn">Compose</button>

<a href="<?php echo $base_url ?>/dashboard.php?tab=tab5" class="submit-btn" style="text-decoration:none; color: #454645;">Back</a>

<?php

}

if(isset($_GET['sent'])){

?>

<a href="<?php echo $base_url ?>/my-account/tab6" class="submit-btn" style="text-decoration:none; color: #454645;">Back</a>

<?php

}

?>

<div class="reply" style="display:none;">

<h1 class="sub-heading">Reply</h1>

<form role="form" method="post" action="">

<div class="form-group">

<label for="r_email">Email :*</label>

<input type="hidden" name="r_subject" id="r_subject" value="<?="RE: ".$wesubject['Subject']?>"/>

<input type="email" name="r_email" id="r_email" class="form-control" value="<?=$weuser['EmailAddress']?>" placeholder="Email" readonly="readonly" />

</div> 

<div class="form-group">

<label for="r_Message">Message :*</label>

<textarea name="r_message" id="r_message" class="form-control" placeholder="Message" required="required"></textarea>

</div> 

<br /> 

<input id="submit" class="submit-btn" name="submit_reply" type="submit" value="Send">

</form>

</div>



<div class="new" style="display:none;">

<h1 class="sub-heading">New Message</h1>

<form role="form" method="post" action="">

<div class="form-group">

<label for="new_Subject">Subject :*</label>

<input type="text" name="new_subject" id="new_subject" class="form-control" placeholder="No Subject" required="required"/>

</div> 

<div class="form-group">

<label for="new_Message">Message :*</label>

<textarea name="new_message" id="new_message" class="form-control" placeholder="Message" required="required"></textarea>

</div> 

<br /> 

<input id="submit" class="submit-btn" name="submit_newmsg" type="submit" value="Send">

</form>

</div>



</div>

</div><!-- end container --> 

<!-- end checkout -->
</div>


<?php

include "footer.php";

?>