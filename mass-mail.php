<?php
	require("inc/config.php");
$vasexpired = "SELECT distinct user.EmailAddress AS EmailAddress FROM `user`";

$reexpired=mysql_query($vasexpired);
while($weexpired=mysql_fetch_array($reexpired)){
$email = $weexpired['EmailAddress'];	
//$email = "asimbert1@gmail.com";

$qry = "SELECT user.id AS UserId, user.FirstName AS FirstName FROM `user` WHERE EmailAddress='" . $email . "'";

$res = mysql_query($qry);

if($rows = mysql_fetch_array($res)){
	$UserId = $rows['UserId'];
	$FirstName = $rows['FirstName'];
	echo "UserId-".$UserId . "<br>";
}

echo "Email-" . $email . "<br>";

$qry2 = "SELECT order.id AS id, order.OrderDate AS OrderDate, order.OrderAmount AS OrderAmount, order.TrackingCode AS TrackingCode, order.OrderStatus AS OrderStatus FROM `order` WHERE order.OrderStatus = 6 AND order.UserId=".$UserId;

$res2 = mysql_query($qry2);

if($rows2 = mysql_fetch_array($res2)){
	$order_id = $rows2['id'];
	echo "Order Id-".$order_id . "<br>";


/*$add_days = 30;
	  $my_date = date('m/d/y',strtotime($weexpired['OrderDate']));
	  
	  
	  $my_date = date('m/d/y',strtotime($my_date.' +'.$add_days.' days'));
$messagereview = file_get_contents('stopointsxgdlj123/review.html');
        $messagereview = str_replace('%name%', $rows['FirstName'], $messagereview);
		$messagereview = str_replace('%product%', $weexpired['ProductDescription'], $messagereview);
		$messagereview = str_replace('%amount%', $weexpired['OrderAmount'], $messagereview);
		$messagereview = str_replace('%expiration%',$my_date, $messagereview);
		$messagereview = str_replace('%trak%', $weexpired['TrackingCode'], $messagereview);
		$messagereview = str_replace('%user_id%', $rows['UserId'], $messagereview);
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
		
		if(!$mailreview->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mailreview->ErrorInfo;
			$er=0;
			
		}*/

}

}