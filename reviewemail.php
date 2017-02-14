<?php
	require("inc/config.php");
$vasexpired = "SELECT * FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId WHERE order.OrderStatus = 6";
$reexpired=mysql_query($vasexpired);
while($weexpired=mysql_fetch_array($reexpired)){

 
if(($weexpired['OrderStatus'] == 6)){
	
	
	//$rowsexpired = mysql_query("UPDATE `order` SET `OrderStatus` = 8 WHERE id=".$weexpired['id']) or die(mysql_error());
	
	$vasreviews = "SELECT * FROM `testimonial` WHERE OrderId =".$weexpired['id'];
$rereview=mysql_query($vasreviews);
 
$wereviews=mysql_fetch_assoc($rereview);

if($wereviews['Id'] == ""){

$vasuser = "SELECT * FROM `user` WHERE id =".$weexpired['UserId'];
$reuser=mysql_query($vasuser);

$weusers=mysql_fetch_assoc($reuser);

print_r($weusers['EmailAddress']);

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
			 
$subjectreview = "<p>&#9734; &#9734; &#9734; &#9734; &#9734; Your opinion matters to stopoint.com</p>";
$txtreview = $messagereview;

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
		$mailreview->AddAddress($weusers['EmailAddress']);
		$mailreview->IsHTML(true);
		$mailreview->Subject = $subjectreview;
		$mailreview->Body = $txtreview;
		$mailreview->XMailer = ' ';
		
		$sentreview = $mailreview->Send();
		
		if (!$sentreview){

	echo 'Message could not be sent to '.$weusers['EmailAddress'];

	

                   $er=0;

}

}
	}
	
}