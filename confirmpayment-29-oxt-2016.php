<?php

include "header.php";

require_once('fedex-common.php5');

$path_to_wsdl = "ShipService_v15.wsdl";

if(!isset($_SESSION['login_username'])){

	header('Location: '.$base_url.'/');

}

 session_start();

$model = $_SESSION['model'];

$carrier = $_SESSION['carrier'];

$phone = $_SESSION['phoneno'];

if(isset($_POST['price'])){



	$price = $_POST['price'];

	$_SESSION['price'] = $price;

	$coupon_code = $_POST['coupon_code'];
	$_SESSION['coupon_code'] = $coupon_code;

	$pemail = $_POST['pemail'];

	$_SESSION['pemail'] = $pemail;

	$name = $_POST['payto'];

	$_SESSION['name'] = $name;

	$address1 = $_POST['add'];

	$_SESSION['address1'] = $address1;

	$address2 = $_POST['add2'];

	$_SESSION['address2'] = $address2;

	$city = $_POST['city'];

	$_SESSION['city'] = $city;

	$state = $_POST['state'];

	$_SESSION['state'] = $state;

	$zip = $_POST['in2'];

	$_SESSION['zip'] = $zip;

	$phone = $_POST['mono2'];

	$_SESSION['phone'] = $phone;

	$country = $_POST['con2'];

	$_SESSION['country'] = $country;

	$_SESSION['payto'] = $_POST['payto'];

	

	

if(isset($_SESSION['pemail'])){

	mysql_query("UPDATE user SET `FirstName` = '$_SESSION[name]',`LastName` = '',`Phone` = '$_SESSION[phone]',`PaypalEmail` = '$_SESSION[pemail]',`PaymentMethod` =1,`S_AddressLine1` = '$_SESSION[address1]' ,`S_AddressLine2` = '$_SESSION[address2]' ,`S_City` = '$_SESSION[city]' ,`S_State` = '$_SESSION[state]' ,`S_PostalCode` = '$_SESSION[zip]' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$_SESSION[address1]' ,`B_AddressLine2` = '$_SESSION[address2]' ,`B_City` = '$_SESSION[city]' ,`B_State` = '$_SESSION[state]' ,`B_PostalCode` = '$_SESSION[zip]' ,`B_Country` = '$_SESSION[country]' WHERE id=".$_SESSION['login_id']) or die(mysql_error());

	}

	else{

		mysql_query("UPDATE user SET `FirstName` = '$_SESSION[name]',`LastName` = '',`Phone` = '$_SESSION[phone]',`PaypalEmail` = '$_SESSION[pemail]',`PaymentMethod` =2,`S_AddressLine1` = '$_SESSION[address1]' ,`S_AddressLine2` = '$_SESSION[address2]' ,`S_City` = '$_SESSION[city]' ,`S_State` = '$_SESSION[state]' ,`S_PostalCode` = '$_SESSION[zip]' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$_SESSION[address1]' ,`B_AddressLine2` = '$_SESSION[address2]' ,`B_City` = '$_SESSION[city]' ,`B_State` = '$_SESSION[state]' ,`B_PostalCode` = '$_SESSION[zip]' ,`B_Country` = '$_SESSION[country]' WHERE id=".$_SESSION['login_id']) or die(mysql_error());

		}

}





 $queryuser =  "SELECT * from user WHERE id = ".$_SESSION['login_id'];

	$resultuser = mysql_query($queryuser);

	$result = mysql_fetch_array($resultuser);

	

	$trackingcode = "STP".mt_rand();



	$trackingcode = str_replace('-', '', $trackingcode);



	

	

	

	$vasproduct = "SELECT product.ProductCode as ProductCode,product.GoodPrice as GoodPrice,product.Description as Description,product.ProductModel as ProductModel,productbrand.Name as brandname,productcategory.Name as categoryname, productfamily.Name as familyname, product.image_url as image_url FROM `product` INNER JOIN productbrand on product.BrandId = productbrand.id INNER JOIN productfamily on product.FamilyId = productfamily.id INNER JOIN productcategory on product.CategoryId = productcategory.id WHERE product.id = ".$_SESSION['model'];

$reproduct=mysql_query($vasproduct);

$weproduct=mysql_fetch_assoc($reproduct);



$_SESSION['product'] = $weproduct['Description'];



////////////Functions///////////////







function addShipper(){

	

	$shipper = array(

		'Contact' => array(

			'PersonName' => $_SESSION['payto'], //doesn't process at all if at least this one isn't a text value

'PhoneNumber' => $_SESSION['phone']), 

		'Address' => array(

			'StreetLines' => array($_SESSION['address1'], $_SESSION['address2'] ),

			'City' => $_SESSION['city'],

			'StateOrProvinceCode' => $_SESSION['state'],

			'PostalCode' => $_SESSION['zip'],

			'CountryCode' => 'US')

	);

	

	return $shipper;

}

function addRecipient(){

	$recipient = array(

		'Contact' => array(

			'PersonName' => 'Stopoint Inc',

			'CompanyName' => 'Stopoint Inc',

			'PhoneNumber' => '1-888-246-4919'),

		'Address' => array(

			'StreetLines' => array('12795 NE 10th Avenue #14'),

			'City' => 'Miami ',

			'StateOrProvinceCode' => 'FL',

			'PostalCode' => '33161',

			'CountryCode' => 'US')

	);

	return $recipient;

}

function addShippingChargesPayment(){

    $shippingChargesPayment = array(

        'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY

        'Payor' => array(

            'ResponsibleParty' => array(

                'AccountNumber' => getProperty('billaccount'),

                'CountryCode' => 'US'

            )

        )

    );

    return $shippingChargesPayment;

}

function addLabelSpecification(){

	$labelSpecification = array(

		'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY

		'ImageType' => 'PNG',  // valid values DPL, EPL2, PDF, ZPLII and PNG

		'LabelStockType' => 'PAPER_4X6');

	return $labelSpecification;

}

function addSpecialServices(){

	$specialServices =  array(

	'SpecialServiceTypes' => 'RETURN_SHIPMENT', 

	'ReturnShipmentDetail' => array(

		'ReturnType' => 'FEDEX_TAG',

      	'Rma' => array(

      		'Number' => '0123456789', 

      		'Reason' => 'reason'

      	)));

	return $specialServices;

}

function addPackageLineItem1(){

	$packageLineItem = array(

		'SequenceNumber'=>1,

		'GroupPackageCount'=>1,

		'Weight' => array(

			'Value' => 1.0,

			'Units' => 'LB')

	);

	return $packageLineItem;

}









//////////////////////////////////



if($_POST['complete']){



 define('SHIP_LABEL', 'shippinglabels/'.$trackingcode.'.png');  // PNG label file. Change to file-extension .pdf for creating a PDF label (e.g. shiplabel.pdf)

			

	

			////////////////////////////////////////////// Shipping label /////////////////////////

			

			

			

			ini_set("soap.wsdl_cache_enabled", "0");



			$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

			

			

			$request['WebAuthenticationDetail'] = array(

				'UserCredential' => array(

					'Key' => getProperty('key'),

					'Password' => getProperty('password')

				)

			);

			$request['ClientDetail'] = array(

				'AccountNumber' => getProperty('shipaccount'),

				'MeterNumber' => getProperty('meter')

			);

			$request['TransactionDetail'] = array('CustomerTransactionId' => '*** Express Domestic Shipping Request v15 using PHP ***');

			$request['Version'] = array(

				'ServiceId' => 'ship',

				'Major' => '15',

				'Intermediate' => '0',

				'Minor' => '0'

			);

			

			

			

			

			$request['RequestedShipment'] = array(

				'ShipTimestamp' => date('c'),

				'DropoffType' => 'REGULAR_PICKUP', // valid values REGULAR_PICKUP, REQUEST_COURIER, DROP_BOX, BUSINESS_SERVICE_CENTER and STATION

				'ServiceType' => 'FEDEX_GROUND', // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...

				'PackagingType' => 'YOUR_PACKAGING', // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...

				'TotalWeight' => array('Value' => 1.0, 'Units' => 'LB'), // valid values LB and KG

				'Shipper' => addShipper(),   ////////////////////**** FUNCTION CALL *****//////////////////////////

				'Recipient' => addRecipient(),

				'ShippingChargesPayment' => addShippingChargesPayment(),

				//'SpecialServicesRequested' => addSpecialServices(),

				'LabelSpecification' => addLabelSpecification(),

				'RateRequestTypes' => array('ACCOUNT'), // valid values ACCOUNT and LIST

				'PackageCount' => 1,

				'RequestedPackageLineItems' => array(

					'0' => addPackageLineItem1()

				)

			);

			

			

			try

			{

				if(setEndpoint('changeEndpoint'))

				{

					$newLocation = $client->__setLocation(setEndpoint('endpoint'));

				}

			

				$response = $client->processShipment($request);  // FedEx web service invocation

			//echo($response->TrackingIds);

			

			

			//$array = get_object_vars($response);

			

			//echo $array['TrackingNumber'];





require_once('USPSAddressVerify.php');

// Initiate and set the username provided from usps

$verify = new USPSAddressVerify('810YGTSO2254');



$add = $_SESSION['address1']." ".$_SESSION['address2'];

$city = $_SESSION['city'];

$state = $_SESSION['state'];

$zip = $_SESSION['zip'];

$name = $_SESSION['payto'];





//$add = "62 Chapel Hill Dr";

//$city = "Fairfield";

//$state = "OH";

//$zip = "45014";

//$name = "Yaw Tandoh";





// During test mode this seems not to always work as expected

//$verify->setTestMode(true);



// Create new address object and assign the properties

// apartently the order you assign them is important so make sure

// to set them as the example below







$address = new USPSAddress;

$address->setFirmName($name);

$address->setApt('100');

$address->setAddress($add);

$address->setCity($city);

$address->setState($state);

$address->setZip5($zip);

$address->setZip4('');



// Add the address object to the address verify class

$verify->addAddress($address);



// Perform the request and return result

$verify->verify();

$verify->getArrayResponse();



$verify->isError();



// See if it was successful



if($verify->isSuccess()) {

   			



if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR')

{

///////////////Save Order /////////////////////////





if($_SESSION['condition']=='good'){

		$condition = 2;

		}

else if($_SESSION['condition']=='Flawless'){

		$condition = 3;

		}

else if($_SESSION['condition']=='brokenyes'){

		$condition = 4;

		}

else if($_SESSION['condition']=='brokenno'){

		$condition = 5;

		}

else{

		$condition=1;

		}

		

$TrackingNumber = $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber;

		

 	$queryproduct1 =  "SELECT * from product WHERE product.id=".$model;

	$resultproducts1 = mysql_query($queryproduct1);

	$resultproduct1 = mysql_fetch_array($resultproducts1);		

 $query = "INSERT INTO `order` SET `ProductId` = ".$resultproduct1['ProductCode'].", `UserId` = ".$_SESSION['login_id'].", `TrackingCode`  = '".$trackingcode."', `FedexCode`  = '".$TrackingNumber."', `OrderStatus`=1,`OrderAmount` = ".$_SESSION['price'].",`Condition` = ".$condition;

	

			$resultorder = mysql_query($query) or die(mysql_error());

$orderidadded = mysql_insert_id();

$orderdate = date('Y-m-d H:i:s');

$queryhistory = "INSERT INTO `orderstatushistory` SET `orderid` = ".$orderidadded.", `dateordered`='".$orderdate."'";

mysql_query("DELETE from Coupon WHERE CouponCode = '".$_SESSION['coupon_code']."' AND CoupType='onetime'");

			$orderhistory = mysql_query($queryhistory) or die(mysql_error());



$add_days = 30;

$now = date('Y-m-d H:i:s');

	  $my_date = date('m/d/y',strtotime($now));

	  

	  

	  $_SESSION['dateexpire'] = date('Y-m-d',strtotime($my_date.' +'.$add_days.' days'));



///////////////////////////////////////////////////					

					

					

					//printSuccess($client, $response);

			

					// Create PNG or PDF label 

					// Set LabelSpecification.ImageType to 'PDF' or 'PNG for generating a PDF or a PNG label

					$fp = fopen(SHIP_LABEL, 'w');

					fwrite($fp, $response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image); //Create PNG or PDF file

						

function RotateJpg($filename = '',$angle = 0,$savename = false)

    {

        // Your original file

		header('Content-type: image/png');

        $original   =   @imagecreatefrompng($filename);

        

		//print_r($original);

		$srcsize = @getimagesize($filename);

		$dest_x = 467; 

		$dest_y = (467 / $srcsize[0]) * $srcsize[1]; 

		//echo $dest_x." ".$dest_y;

		$dst_img = @imagecreatetruecolor($dest_x, $dest_y);

		@imagecopyresampled($dst_img, $original, 0, 0, 0, 0,$dest_x, $dest_y, $srcsize[0], $srcsize[1]); 

		@imagedestroy($original);

		// Rotate

        $rotated    =   @imagerotate($dst_img, $angle, 0);

		//print_r($rotated);

		@imagedestroy($dst_img);

		

        // If you have no destination, save to browser

        if($savename == false) {

                header('Content-Type: image/png');

                @imagepng($rotated);

            }

        else

            // Save to a directory with a new filename

			

        @imagepng($rotated,$savename);

			

			//print_r( imagepng($rotated,$savename));

        // Standard destroy command

        imagedestroy($rotated);

    }



// Base image



if(isset($_POST['newsletter'])){

	$newsletter = 1;

	mysql_query("UPDATE user SET `IsNewsletter` = '$newsletter' WHERE id=".$result['id']) or die(mysql_error());

				}



$filename   = "shippinglabels/".$trackingcode.".png";



// Destination, including document root (you may have a defined root to use)

$saveto     =   "shippinglabels/".$trackingcode.".png";



// Apply function

RotateJpg($filename,90,$saveto);





					//define image path



					fclose($fp);

					//echo getProperty('billaccount');

					//echo '<h3>This is your printable shipping label.</h3> <strong>For your convenience a copy has been sent to the email address provided.</strong><br /><img src="http://stopoint.com/'.SHIP_LABEL.'" />';

				$link = 'https://www.stopoint.com/pdffile.php?id='.$trackingcode;

				$message = str_replace('%link%', $link, $message);

				

				}

			

			else{

				{

					

					$Errormessage = $response->Notifications;

					//print_r($Errormessage);

					//exit;

					//if($Errormessage == 'Shipper Postal-State Mismatch' || $Errormessage == 'Invalid Shipper Postal Code Format' || $Errormessage == 'Shipper Postal Code not found'){

						//echo "error";

						

						?>

                        

                        <div class="alert alert-danger">

    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <strong>Error!</strong> Zip code for the State or address mismatch please go back and enter correct details.

   </div>

                        <?php

						

						//}

					

					//echo "results:". $_SESSION['senderName']." ".$_SESSION['senderPhone']." ".$_SESSION['senderStreet']." ".$_SESSION['senderLine2']." ".$_SESSION['senderCity']." ".$_SESSION['senderState']." ".$_SESSION['senderZip'];

					//printError($client, $response);

					

				}

				}	

				

}

				else{

				{

					

					$Errormessage = $response->Notifications;

					//print_r($Errormessage);

					//exit;

					//if($Errormessage == 'Shipper Postal-State Mismatch' || $Errormessage == 'Invalid Shipper Postal Code Format' || $Errormessage == 'Shipper Postal Code not found'){

						//echo "error";

						

						?>

                        

                        <div class="alert alert-danger">

    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <strong>Error!</strong> Zip code for the State or address mismatch please go back and enter correct details.

   </div>

                        <?php

						

						//}

					

					//echo "results:". $_SESSION['senderName']." ".$_SESSION['senderPhone']." ".$_SESSION['senderStreet']." ".$_SESSION['senderLine2']." ".$_SESSION['senderCity']." ".$_SESSION['senderState']." ".$_SESSION['senderZip'];

					//printError($client, $response);

					

				}

				}

				writeToLog($client);    // Write to log file

			

			} catch (SoapFault $exception) {

//echo "results:". $_SESSION['senderName']." ".$_SESSION['senderPhone']." ".$_SESSION['senderStreet']." ".$_SESSION['senderLine2']." ".$_SESSION['senderCity']." ".$_SESSION['senderState']." ".$_SESSION['senderZip'];

				//printFault($exception, $client);

			}

			

			

			

			

			///////////////////////////////////////////////////////////////////////////////////////

			

			

			if($Errormessage == ""){

			 $message = file_get_contents('basic.html');

             $message = str_replace('%name%', $result['FirstName'], $message);

		     $message = str_replace('%product%', $_SESSION['product'], $message);

		     $message = str_replace('%amount%', $_SESSION['price'], $message);

		     $message = str_replace('%expiration%', $_SESSION['dateexpire'], $message);

		     $message = str_replace('%trak%', $trackingcode, $message);

			 $message = str_replace('%trackingid%', $TrackingNumber, $message);

			 $link = 'https://www.stopoint.com/pdffile.php?id='.$trackingcode;

				$message = str_replace('%link%', $link, $message);

			 

$subject = "Stopoint Order ".$trackingcode;

$txt = $message;

$email_from = "support@stopoint.com";

require_once 'PHPMailer-master/PHPMailerAutoload.php';

		$mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = true;

		$mail->SMTPDebug = 0;

		$mail->SMTPSecure = 'ssl';

		$mail->Host = "smtp.gmail.com";

		$mail->Port = 465; 

		$mail->Username = "stopoint@stopoint.com";  

		$mail->Password = "Funnyboy123";

		$mail->From = $email_from;

		$mail->FromName = "STOPOINT ";

		$mail->AddAddress($_SESSION['login_email']);

		$mail->IsHTML(true);

		$mail->Subject = $subject;

		$mail->Body = $txt;

		$mail->XMailer = ' ';

		$sent = $mail->Send();

		

if (!$sent){

	echo 'Message could not be sent to '.$_SESSION['ouser'];

	

                   $er=0;

}



			header('Location: '.$base_url.'/thankyou.php?order=success&track='.$trackingcode);

			}

	}

?>

<style type="text/css">

.input-group {

    position: relative;

    display: table;

    border-collapse: separate;

}

.btn-custom-2 {

    color: #fff !important;

    background-color: #444645;

    text-transform: uppercase;

	    border-radius: 3px;

    padding: 10px 18px;



}

.pull-right{

	margin-top:-20px;

	}

.invalid input:required:invalid {

	border-color:red;

}

.invalid input:required:valid {

	border-color:green;

}



</style>

<!-- slider -->



<style type="text/css">

.input-group {

    position: relative;

    display: table;

    border-collapse: separate;

}

.btn-custom-2 {

    color: #fff !important;

    background-color: #444645;

    text-transform: uppercase;

	    border-radius: 3px;

    padding: 10px 18px;



}

.pull-right{

	margin-top:-20px;

	}

</style>

<div class="container">

    <div class="row">

    	<h1 class="sub-heading" style="color: #44b749;">Checkout</h1>

        

        

							<div class="panel panel-default">

								<div class="panel-heading">

									<div class="panel-title">Payment Details: PLEASE CONFIRM THE FOLLOWING INFORMATION IS CORRECT</div><!-- End .accordion-title -->

									<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>

								</div><!-- End .accordion-header -->

								

								

								  <div class="panel-body">

								 

                                   <br />

                                        <div id="paypal">

                                        <form action="" id="checkout-form" class="validate-form" name="pay-form" method="post">

                                        <input type="hidden" name="pay" value="pay" id="pay" />

										<?php

                                        if(isset($_SESSION['pemail'])){

											?>

                                            <div class="form-group">

											<label>Paypal Email<font color="#FF0000">*</font></label>

											<input type="text" required class="form-control input-lg" placeholder="Enter Paypal Email Address" value="<?php echo $_SESSION['pemail']; ?>" name="pemail" />

                                            </div>

                                            <?php

											}

											else{

										?>

                                        <div class="form-group">

											<label>Full Name<font color="#FF0000">*</font></label>

											<input type="text" required class="form-control input-lg" placeholder="Enter Your Name" value="<?php echo $_SESSION['payto'] ?>" name="pemail">

                                            </div> 

                                            <?php } ?>

                                        

                                          <div class="row field-row">

                                		  </div>

                                        </div>

                                       <br />

                              		



                                   

                                            

                                              <div class="lg-margin"></div><!-- space -->

                              

                                        

                                        <!-- End .input-group -->

										

								   	<!-- End .col-md-6 -->

								   	

								   </div><!-- End.row -->

								   

                                   

								   <!--<a href="#" class="btn btn-custom-2">CONTINUE</a>-->

								  <!-- End .panel-body -->

								</div><!-- End .panel-collapse -->

							  

							  

                              

                              

                              <div class="panel panel-default">

								<div class="panel-heading">

									<div class="panel-title">Shipping Details: USE THE PREPAID SERVICE LABEL WE'LL PROVIDE TO SHIP FROM:</div><!-- End .accordion-title -->

									<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>

								</div><!-- End .accordion-header -->

								

								

								  <div class="panel-body">

								   <div class="row">

								   	

								   <div class="col-md-14">

								   			   		

								 

                                        

                                    <div id="check">

                                  

                                     <div class="form-group">

                                    <p style="background-color: white;border: 1px #BBBBBB solid;border-radius: 5px;width: 78%;height: 140px;padding-top: 8px">

                    &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['payto']; ?><br>

                    &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['address1']; ?><br>

                    &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['address2']; ?><br>

                    &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['city'].",".$_SESSION['state']; ?><br>

                    &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['zip']; ?>,United States <br>

                    &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['phoneno']; ?><br>

                    

                    <br /><br />

                    <?php

					require_once('USPSAddressVerify.php');

// Initiate and set the username provided from usps

$verify = new USPSAddressVerify('810YGTSO2254');



$add = $_SESSION['address1']." ".$_SESSION['address2'];

$city = $_SESSION['city'];

$state = $_SESSION['state'];

$zip = $_SESSION['zip'];

$name = $_SESSION['payto'];



//$add = "62 Chapel Hill Dr";

//$city = "Fairfield";

//$state = "OH";

//$zip = "45014";

//$name = "Yaw Tandoh";





// During test mode this seems not to always work as expected

//$verify->setTestMode(true);



// Create new address object and assign the properties

// apartently the order you assign them is important so make sure

// to set them as the example below







$address = new USPSAddress;

$address->setFirmName($name);

$address->setApt('100');

$address->setAddress($add);

$address->setCity($city);

$address->setState($state);

$address->setZip5($zip);

$address->setZip4('');



// Add the address object to the address verify class

$verify->addAddress($address);



// Perform the request and return result

$verify->verify();



$verify->getArrayResponse();



$verify->isError();

print_r($verify->getErrorMessage());

// See if it was successful



if($verify->isSuccess()) {

?>

<div id="invalid" style="font-size: 12px;font-weight: bold;color: #a73316;padding: 10px 0 0 22px;">This address is verified by the USPS.<br></div>

<?php	

}

else{?>

<div id="invalid" style="font-size: 12px;font-weight: bold;color: #a73316;padding: 10px 0 0 22px;">This address is not recognized by the USPS. Are you sure you want to use it?<br>Do the city, state, or ZIP code conflict? <br>Are there other major typos?<br></div>

     <?php } ?>

                                    </p>

                                                                    </div>

                                   <p>

                                    <div class="form-group">

                                 

                                 <font size="4"><b>Terms of service</b></font><br>

        <p style="background-color: white;padding-top: 8px;padding-bottom: 8px">

            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="term" value="term" id="termscheckbox" required>&nbsp;&nbsp;By checking this box, you agree to our 

            terms of service and confirm that the item(s) you are selling have not been reported lost or 

            stolen. 

            <br/>

 &nbsp;&nbsp;&nbsp;<input type="checkbox" name="newsletter" value="newsletter" id="termscheckbox">&nbsp;&nbsp;I wish to subscribe to the Stopoint's newsletter.

        </p>

        

                                 </div>

                              </p>



                                   

                                            <p>

                                           <div class="lg-margin"></div><!-- space -->

                                              <input type="submit" value="COMPLETE" class="submit-btn" name="complete">

                                              <a href="<?php echo $base_url; ?>/checkout2" style="color:#000;"><input type="button" value="BACK" class="submit-btn" name="back"></a>

                                              </p>

                                              </div><!-- space -->

                                              </form>

                                </div>

                                        

                                        <!-- End .input-group -->

										

								   	</div><!-- End .col-md-6 -->

								   	

								   </div>

                                   </div>

                              <?php

$queryproduct =  "SELECT * from product WHERE product.id=".$model;

		

	$resultproducts = mysql_query($queryproduct);

	$resultproduct = mysql_fetch_array($resultproducts);

?>



          <div class="panel panel-default">

								<div class="panel-heading">

									<div class="panel-title">Order Details<span></span></div><!-- End .accordion-title -->

									<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>

								</div><!-- End .accordion-header -->

								

								

								  <div class="panel-body">

							  

								<div class="table-responsive">

									<table class="table checkout-table">

									<thead>

										<tr>

											<th class="table-title">Product Name</th>

											

											<th class="table-title">Unit Price</th>

											<th class="table-title">Quantity</th>

											<th class="table-title">SubTotal</th>

										</tr>

									</thead>

									

									<tbody>

                                       



 

										<tr>

										<td class="item-name-col">

											<figure>

                                              <?php

	 if($resultproduct['image_url'] != ""){

		 ?>

     <img class="fix img-responsive" style="height:179px;" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>" alt="<?=$resultproduct['Description']?>"/>      

         <?php

	 }

	 else{

	 ?>

												<?php if($resultproduct['CategoryId'] ==2){

												?>

                                                <a href="#"><img src="<?php echo $base_url; ?>/images/macbook-pro.jpg" alt="MacBook Pro"></a>

                                                <?php

                                            }

											else if($resultproduct['CategoryId'] ==1 && $resultproduct['BrandId'] ==1){

												?>

												<a href="#"><img src="<?php echo $base_url; ?>/images/iphone.png" alt="IPhone"></a>

												<?php } 

												

												else if($resultproduct['CategoryId'] ==1 && $resultproduct['BrandId'] ==2){

												?>

												<a href="#"><img src="<?php echo $base_url; ?>/images/samsung.png" alt="Samsung"></a>

												<?php } 

												

												else if($resultproduct['CategoryId'] ==3){

												?>

												<a href="#"><img src="<?php echo $base_url; ?>/images/tablet.jpg" alt="Tablets"></a>

												<?php }

												else if($resultproduct['CategoryId'] ==4){

												?>

												<a href="#"><img src="<?php echo $base_url; ?>/images/apple_tv.png" alt="Apple TV"></a>

												<?php }

												

												else if($resultproduct['CategoryId'] ==5){

												?>

												<a href="#"><img src="<?php echo $base_url; ?>/images/apple_watch.png" alt="Apple Watch"></a>

												<?php } } ?>

												 

												 

											</figure>

											<header class="item-name">

                                            <?php echo $resultproduct['Description']; ?>

                                            </header>

											

										</td>

										

										<td class="item-price-col"><span class="item-price-special">$<?php echo $_SESSION['price']; ?></span></td>

										<td>

											<div class="custom-quantity-input">

												1

												<a href="#" onclick="return false;" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>

												<a href="#" onclick="return false;" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>

											</div>

										</td>

										<td class="item-total-col"><span class="item-price-special">

                                        $<?php echo $_SESSION['price']; ?>                                       

                                        </span>

										<a href="delcart?id=16" class="close-button"></a>

										</td>

									</tr>

								

																		

									</tbody>

									 <tfoot>

										<tr>

											<td class="checkout-total-title" colspan="3"><strong>TOTAL:</strong></td>

											<td class="checkout-total-price cart-total"><strong>$ <?php echo $_SESSION['price']; ?></strong></td>

										</tr>

									</tfoot>

								  </table>

								

								</div><!-- End .table-reponsive -->

								  <div class="lg-margin"></div><!-- space -->

								  <div class="text-right">

								  	<!--<input type="submit" class="btn btn-custom-2" value="CONFIRM ORDER">-->

								  </div>

								  </div><!-- End .panel-body -->

								<!-- End .panel-collapse -->

							  

						  	</div>

    </div><!-- row --> 

    

</div><!-- end container --> 

<!-- end slider -->

<br>

<?php

include "footer.php";

?>

