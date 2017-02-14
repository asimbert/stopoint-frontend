<?php
	require("inc/config.php");
$vasexpired = "SELECT order.id AS id, order.UserId AS UserId, order.OrderDate AS OrderDate, order.OrderAmount AS OrderAmount, order.TrackingCode AS TrackingCode, product.Description AS ProductDescription, user.FirstName AS FirstName, user.EmailAddress AS EmailAddress, order.OrderStatus AS OrderStatus FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN user ON order.UserId = user.id WHERE order.OrderStatus = 6";

//$vasexpired = "SELECT * FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId WHERE order.OrderStatus = 6";


$reexpired=mysql_query($vasexpired);
while($weexpired=mysql_fetch_array($reexpired)){

$email = $weexpired['EmailAddress'];	
/*$vasreviews = "SELECT * FROM `testimonial` WHERE OrderId =".$weexpired['id'];
$rereview=mysql_query($vasreviews);
 
$wereviews=mysql_fetch_assoc($rereview);

if($wereviews['Contents'] === ""){



}*/

$tp_review = "SELECT * FROM `tp_review_email_reminder` WHERE order_id =".$weexpired['id'] . " AND user_id=" . $weexpired['UserId'] . " AND count < 4 AND status = 1";
$tp_review_res=mysql_query($tp_review);

while($tp_review_row=mysql_fetch_assoc($tp_review_res)){

$count = $tp_review_row['count'];
$tp_id = $tp_review_row['id'];

$count++;

$qry = "UPDATE tp_review_email_reminder SET count = ". $count;

if($count >= 4){
	$qry .= ", status = 0";
}

$qry .= " WHERE id=" . $tp_id;

mysql_query($qry);


$add_days = 30;
	  $my_date = date('m/d/y',strtotime($weexpired['OrderDate']));
	  
	  
	  $my_date = date('m/d/y',strtotime($my_date.' +'.$add_days.' days'));
$messagereview = file_get_contents('review.html');
        $messagereview = str_replace('%name%', $weexpired['FirstName'], $messagereview);
		$messagereview = str_replace('%product%', $weexpired['ProductDescription'], $messagereview);
		$messagereview = str_replace('%amount%', $weexpired['OrderAmount'], $messagereview);
		$messagereview = str_replace('%expiration%',$my_date, $messagereview);
		$messagereview = str_replace('%trak%', $weexpired['TrackingCode'], $messagereview);
			$helpreview = 'https://www.stopoint.com/help';
				$messagereview = str_replace('%help%', $helpreview, $messagereview);
			 
$subjectreview = "Your opinion matters to stopoint.com";
$txtreview = $messagereview;

echo $email . "<br>";

require_once 'PHPMailer-master/PHPMailerAutoload.php';
		$mailreview = new PHPMailer();
		$mailreview->IsSMTP();
		$mailreview->SMTPAuth = true;
		$mailreview->SMTPDebug = 0;
		$mailreview->SMTPSecure = 'ssl';
		$mailreview->Host = "smtp.gmail.com";
		$mailreview->Port = 465; 
		$mailreview->Username = "stopoint@stopoint.com";  
		$mailreview->Password = EMAIL_CREDENTIAL;
		$mailreview->From = "info@stopoint.com";
		$mailreview->FromName = "STOPOINT ";
		$mailreview->AddAddress($email);
		$mailreview->IsHTML(true);
		$mailreview->Subject = $subjectreview;
		$mailreview->Body = $txtreview;
		$mailreview->XMailer = ' ';
		
		$sentreview = $mailreview->Send();
		
		if (!$sentreview){

	echo 'Message could not be sent to '.$email;

	

                   $er=0;

}

}
	
}