<?php
include "header.php";
if(!isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])){
	header('Location: '.$base_url.'/');
}
if(isset($_POST['submit_testimonial'])){
	$id = $_GET['id'];
	$pquery = "SELECT * FROM `order` WHERE id = '".$id."'";
	$rpquery = mysql_query($pquery);
	$wpquery = mysql_fetch_assoc($rpquery);
	
	$uquery = "SELECT * FROM `user` WHERE id = '".$wpquery['UserId']."'";
	$ruquery = mysql_query($uquery);
	$wuquery = mysql_fetch_assoc($ruquery);
	
	$contents = $_POST['contents'];
	$rating = $_POST['rating'];
	$query = 'INSERT INTO testimonial SET UserId = '.$_SESSION['login_id'].', OrderId = '.$id.', ProductId = "'.$wpquery['ProductId'].'", UserName = "'.$wuquery['FirstName'].' '.$wuquery['LastName'].'", UserCity = "'.$wuquery['S_City'].'", UserState = "'.$wuquery['S_State'].'", Contents = "'.$contents.'", Rate = "'.$rating.'", ShowOnHomePage = 0';
	$result = mysql_query($query) or die(mysql_error());
	$id = mysql_insert_id();
	if($result){
		header('Location: '.$base_url.'/order_edit.php?id='.$id.'&err_msg=testimonial_success&testimonials');
	}
	else{
		header('Location: '.$base_url.'/order_edit.php?id='.$id.'&err_msg=testimonial_error&testimonials');
	}
}
else{
$id = $_GET['id'];
$query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode, order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount , order.AdjustedAmount as AdjustedAmount, product.ProductModel as ProductModel , product.ProductCode as ProductCode, productfamily.Name as ProductName, product.Description as Description, user.PaypalEmail as PaypalEmail, 
 CASE order.OrderStatus
  WHEN '7' THEN 'Cancelled' 
  WHEN '6' THEN 'Paid'
  WHEN '5' THEN 'Release Payment'
  WHEN '4' THEN 'Returned'
  WHEN '3' THEN 'Adjusted Price'
  WHEN '2' THEN 'Recieved'
  WHEN '1' THEN 'Pending'
 ELSE 'Pending'
 END as OrderStatus,
 CASE order.Condition
  WHEN '3' THEN 'Flawless'
  WHEN '2' THEN 'Good'
  WHEN '1' THEN 'Fair'
 ELSE 'Good'
 END as OrderCondition,
 CASE user.PaymentMethod
  WHEN '2' THEN 'Check'
  WHEN '1' THEN 'Paypal'
 END as PaymentMethod
FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.id=".$id);
$roworder = mysql_fetch_assoc($query);
if($roworder['OrderStatus'] == 'Paid'){
	$transactionquery = "SELECT * FROM `ordertrasactions` WHERE OrderId = ".$roworder['OrderId'];
	$retransactionquery = mysql_query($transactionquery);
	$wetransactionquery = mysql_fetch_assoc($retransactionquery);
}
}
if(isset($_GET['testimonials'])){
?>
<div class="container">
<div class="row text-center">
<h1 class="sub-heading">REVIEWS</h1>
</div>  
<div class="row pad" style="margin-bottom:70px;">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<?php
if($_GET['err_msg']== "testimonial_success"){
?>
<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success!</strong> Thank you for taking the time to leave a review. Reviews help us evaluate our performance and ensure that we’re always providing the best level of service to our clients. They also allow prospective clients to get an idea of what it’s like to work with our firm through the experiences of our clients. Thank you again for your time, and if you have any questions, please feel free to contact us!.
</div>
<?php
}
if($_GET['err_msg']== "testimonial_error"){
?>
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error!</strong> There is an error adding review, Please try again.
</div>
<?php
}
?>
<form role="form" method="post" action="" class="validate-form" onsubmit="return validateRating(rating)">
<h1 class="form-heading">Add Review</h1>
<div class="form-group">
<label for="OrderNumber">Content :</label>
<textarea name="contents" id="contents" class="form-control" placeholder="Testimonial" required="required"></textarea>
</div>
<div class="form-group">
<input id="kartik" class="form-control rating" data-stars="5" data-step="0.1" data-size="sm" name="rating" required="required">
</div>
<br /> 
<input id="submit" class="submit-btn" name="submit_testimonial" type="submit" value="Send">
<a class="submit-btn" style="text-decoration:none; color: #454645;" href="<?php echo $base_url ?>/my-account/tab3">Back</a>
</form>
</div>
</div>
</div>
<?php
}else{
?>
<div class="container">
<div class="row text-center">
<h1 class="sub-heading">ORDER DETAILS</h1>
</div><!-- row -->
<div class="row pad" style="margin-bottom:70px;">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<form role="form">
<h1 class="form-heading">YOUR ORDER DETAILS</h1>
<div class="form-group">
<label for="OrderNumber">Order Number :</label>
<input type="text" class="form-control" name="OrderNumber" id="OrderNumber" value="<?=$roworder['OrderId']?>" placeholder="Order Number" readonly="readonly">
</div>
<div class="form-group">
<label for="TrackingNumber">Tracking Number :</label>
<input type="text" class="form-control" name="TrackingNumber" id="TrackingNumber" value="<?=$roworder['TrackingCode']?>" placeholder="Tracking Number" readonly="readonly">
</div>
<div class="form-group">
  <label for="TrackingNumber">Fedex Tracking Id:</label>
  <input type="text" class="form-control" name="FedexCode" id="FedexCode" value="<?=$roworder['FedexCode']?>" placeholder="Fedex Tracking Id" readonly="readonly">
</div>
<div class="form-group">
  <label for="TransactionId">Track Payment :</label>
  <input type="text" class="form-control" name="TransactionId" id="TransactionId" value="<?=$wetransactionquery['TransactionId']?>" placeholder="Transaction Id" readonly="readonly">
</div>
<?php
if($roworder['OrderStatus'] == 'Paid'){
if($roworder['PaymentMethod'] == 'Check'){
?>
<div class="form-group">
<label for="AccountNumber">Account Number:</label>
<input type="text" class="form-control" name="AccountNumber" id="AccountNumber" value="<?=$wetransactionquery['AccountNumber']?>" placeholder="Account Number" readonly="readonly">
</div>
<div class="form-group">
<label for="ChequeNumber">Cheque Number:</label>
<input type="text" class="form-control" name="ChequeNumber" id="ChequeNumber" value="<?=$wetransactionquery['ChequeNumber']?>" placeholder="Cheque Number" readonly="readonly" />
</div>
<?php }else{?>
<div class="form-group">
<label for="PaypalEmail">Paypal Email:</label>
<input type="text" class="form-control" name="PaypalEmail" id="PaypalEmail" value="<?=$roworder['PaypalEmail']?>" placeholder="Paypal Email" readonly="readonly" />
</div>
<?php }}?>
<div class="form-group">
<label for="OrderDate">Order Date :</label>
<input type="text" class="form-control" name="OrderDate" id="OrderDate" value="<?=date('m/d/Y h:i:s', strtotime($roworder['OrderDate']))?>" placeholder="Order Date" readonly="readonly">
</div>
<div class="form-group">
<label for="Product">Product :</label>
<input type="text" class="form-control" name="Product" id="Product" value="<?php echo htmlspecialchars($roworder['Description']);?>" placeholder="Product" readonly="readonly">
</div>
<div class="form-group">
<label for="Amount">Original Amount :</label>
<input type="text" class="form-control" name="Amount" id="Amount" value="$ <?php echo $roworder['OrderAmount'];?>" placeholder="Amount" readonly="readonly">
</div>
<div class="form-group">
<label for="Amount">Adjusted Amount :</label>
<?php
if($roworder['AdjustedAmount'] == ''){
?>
<input type="text" class="form-control" name="adjustedAmount" id="adjustedAmount" value="<?php echo $roworder['AdjustedAmount'];?>" placeholder="Adjusted Amount" readonly="readonly">
<?php }else{?>
<input type="text" class="form-control" name="adjustedAmount" id="adjustedAmount" value="$ <?php echo $roworder['AdjustedAmount'];?>" placeholder="Adjusted Amount" readonly="readonly">
<?php }?>
</div>
<div class="form-group">
<label for="Status">Order Status :</label>
<input type="text" class="form-control" name="Status" id="Status" value="<?=$roworder['OrderStatus']?>" placeholder="Status" readonly="readonly">
</div>
<div class="form-group">
<label for="Condition">Condition :</label>
<input type="text" class="form-control" name="Condition" id="Condition" value="<?=$roworder['OrderCondition']?>" placeholder="Condition" readonly="readonly">
</div>
<?php
if(isset($_GET['send'])){
?>
<h1 class="form-heading">MESSAGES</h1>
<?php
$msg_query = "SELECT messages.id as id,messages.Subject as Subject,messages.Comments as Comments,messages.ToId as ToId,messages.Date as Date, user.id as userid, user.image_url as Image FROM `messages` INNER JOIN user on messages.FromId = user.id INNER JOIN `order` on messages.OrderId = order.id WHERE messages.OrderId = ".$_GET['id']." AND parentid=0 ORDER BY id DESC";
$remsg_query = mysql_query($msg_query);
if(mysql_num_rows($remsg_query)<=0){
?>
<div class="form-group">
<span style="font-size:14px; font-weight:bold">No Conversation against this order.</span>
</div>
<?php
}else{
while ($wemsg_query = mysql_fetch_assoc($remsg_query)){
?>
<div class="form-group">
<span style="font-size:14px; font-weight:bold">Subject : </span>
<span style="font-size:14px"><span id="Subject"><?php echo $wemsg_query['Subject']; ?></span></span>
</div>
<div class="form-group">
<span style="font-size:14px"><img src="<?php echo $base_url; ?>/images/users/<?php echo $wemsg_query['Image']; ?>" style="border-radius:50%; float:left;"  height="50" width="50" alt="User Image"/></span>
<span style="margin-left:15px;"> <?php echo $wemsg_query['Date']; ?>
<br />
<span style="font-size:14px; font-weight:bold; margin-left:15px;">Comments : </span>
<span style="font-size:14px"> <?php echo $wemsg_query['Comments']; ?></span></span>
</div>
<?php
if($wemsg_query['ToId'] >= 0){
$to_query = "SELECT messages.id as id,messages.Subject as Subject,messages.Comments as Comments,messages.ToId as ToId,messages.Date as Date, user.FirstName as fname, user.image_url as image FROM `messages` INNER JOIN user on messages.FromId = user.id INNER JOIN `order` on messages.OrderId = order.id WHERE messages.OrderId = ".$_GET['id']." AND parentid=".$wemsg_query['id']." ORDER BY id DESC";
$reto_query=mysql_query($to_query);
while($weto_query=mysql_fetch_assoc($reto_query)){
if($weto_query['Subject'] != ''){
?>
<div class="form-group">
<span style="font-size:14px; font-weight:bold">Subject : </span>
<span style="font-size:14px"><span id="Subject"><?php echo $weto_query['Subject']; ?></span></span>
</div>
<?php }?>
<div class="form-group">
<span style="font-size:14px"><img src="<?php echo $base_url; ?>/images/<?php echo "admin.png"; ?>" style="border-radius:50%; float:left;"  height="50" width="50" alt="Admin Image"/></span>
<span style="margin-left:15px;"> <?php echo $weto_query['Date']; ?>
<br />
<span style="font-size:14px; font-weight:bold; margin-left:15px;">Comments : </span>
<span style="font-size:14px"> <?php echo $weto_query['Comments']; ?></span></span>
</div>
<?php
}
}
?>
<hr style="  display: block;
  -webkit-margin-before: 0.5em;
  -webkit-margin-after: 0.5em;
  -webkit-margin-start: auto;
  -webkit-margin-end: auto;
  border-style: inset;
  border-width: 1px;" />
<?php
}
}
}
?>
<br />
</form>
<a href="<?php echo $base_url ?>/my-account/tab3" class="submit-btn" style="text-decoration:none; color: #454645;">Back</a>
<?php
if(isset($_GET['send'])){
?>
<button id="button1" class="submit-btn">Compose</button>
<?php
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
	$message = '<html><body>';
	$message .= '<h4>Dear, '.$name.'!</h4>';
	$message .= '<p>'.$message_body.'</p><br>';
	$message .= '<p>Thanks</p>';
	$message .= '<p>From:'.$weuser['FirstName'].' '.$weuser['LastName'].'</p>';
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
		$mail->Password = "Favoritecake1";
		$mail->From = $email_from;
		$mail->FromName = "STOPOINT INC ";
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		//$mail->XMailer = ' ';
		$sent = $mail->Send();
	
 	//$sent = mail($to, $subject, $message, $headers);
	if($sent){
		mysql_query('INSERT INTO messages SET FromId = "'.$_SESSION['login_id'].'", ToId  = 0,	OrderId  = "'.$roworder['OrderId'].'", parentid  = 0, Subject  = "'.$subject.'", Comments  = "'.$message_body.'"') or die(mysql_error());
		header('Location: '.$base_url.'/dashboard.php?tab=tab3&err_msg=email_send_success');
		}
 	else{
		header('Location: '.$base_url.'/dashboard.php?tab=tab3&err_msg=email_send_fail'); 
		}
}
}
?>
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
<?php
}
?>
<!-- end checkout -->
</div>
<?php
include "footer.php";
?>