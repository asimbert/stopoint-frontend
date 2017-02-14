<?php	
	require_once 'inc/MCAPI.class.php';
	$api = new MCAPI('1a2e8827797f0ed884437648f8b2ecae-us11');	
	$merge_vars = array('FNAME'=>$_POST["fname"], 'LNAME'=>$_POST["lname"]);
	
	// Submit subscriber data to MailChimp
	// For parameters doc, refer to: http://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
	$retval = $api->listSubscribe( '331aca7828', $_POST["email"], $merge_vars, 'html', false, true );
	
	if ($api->errorCode){
		print_r($api->errorCode);
		echo "<h4>Please try again.</h4>";
	} else {
		echo "<h4>Thank you, you have been added to our mailing list.</h4>";
	}
?>
