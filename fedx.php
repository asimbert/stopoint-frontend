<?
$path_to_wsdl = "./ShipService_v17.wsdl";
 
define('SHIP_LABEL', 'shipgroundlabel.pdf');  
define('SHIP_CODLABEL', 'CODgroundreturnlabel.pdf'); 
ini_set("soap.wsdl_cache_enabled", "0");
 
 
$client = new SoapClient($path_to_wsdl, array('trace' => 1)); 
if($var == 'key') Return '2Ffgrm3PHdcxRSJw'; 
	if($var == 'password') Return 'QVNttINP9VDmKeRRucCbMYGUu'; 
	if($var == 'shipaccount') Return '633631263'; 
 
$request['WebAuthenticationDetail'] = array(
	'ParentCredential' => array(
		'Key' => '2Ffgrm3PHdcxRSJw', 
		'Password' => 'QVNttINP9VDmKeRRucCbMYGUu'
	),
	'UserCredential' => array(
		'Key' => '2Ffgrm3PHdcxRSJw', 
		'Password' => 'QVNttINP9VDmKeRRucCbMYGUu'
	)
);
 
$request['ClientDetail'] = array(
	'AccountNumber' => '633631263', 
	'MeterNumber' => '107820028'
);
$request['TransactionDetail'] = array('CustomerTransactionId' => 'ProcessShip_Basic');
$request['Version'] = array(
	'ServiceId' => 'ship', 
	'Major' => '17', 
	'Intermediate' => '0', 
	'Minor' => '0'
);
$request['RequestedShipment'] = array(
	'ShipTimestamp' => '2016-04-26T15:46:24-06:00',
	'DropoffType' => 'REGULAR_PICKUP', // valid values REGULAR_PICKUP, REQUEST_COURIER, DROP_BOX, BUSINESS_SERVICE_CENTER and 
	'ServiceType' => 'FEDEX_GROUND', // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
	'PackagingType' => 'YOUR_PACKAGING', // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
	'Shipper' => array(
		'Contact' => array(
			'PersonName' => 'Person Name',
			'CompanyName' => 'Company Name',
			'PhoneNumber' => '400-2345-3489'
		),
		'Address' => array(
			'StreetLines' => array('Sender Address'),
			'City' => 'City Name',
			'StateOrProvinceCode' => 'State Code', // for Example TX
			'PostalCode' => 'Postal Code',
			'CountryCode' => 'Country Code' // For example US
		)
	),
	'Recipient' => array(
		'Contact' => array(
			'PersonName' => 'Liana',
			'CompanyName' => 'Erida',
			'PhoneNumber' => '1234567890'
		),
		'Address' => array(
			'StreetLines' => array('Recipient Address'),
			'City' => 'City Name',
			'StateOrProvinceCode' => 'State Code', // For Example HR
			'PostalCode' => 'Postal Code',
			'CountryCode' => 'Country Name',
			'Residential' => true
		)
	),
	'ShippingChargesPayment' => array(
		'PaymentType' => 'SENDER',
        'Payor' => array(
			'ResponsibleParty' => array(
				'AccountNumber' => '510057585',
				'Contact' => null,
				'Address' => array(
					'CountryCode' => 'US'
				)
			)
		)
	),
	'LabelSpecification' => array(
		'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
		'ImageType' => 'PDF',  // valid values DPL, EPL2, PDF, ZPLII and PNG
		'LabelStockType' => 'PAPER_7X4.75'
	), 
	
	'PackageCount' => 1,
	'PackageDetail' => 'INDIVIDUAL_PACKAGES',                                        
	'RequestedPackageLineItems' => array(
		'0' => array(
		'SequenceNumber'=>1,
		'GroupPackageCount'=>1,
		'Weight' => array(
			'Value' => 50.0,
			'Units' => 'LB'
		),
		'Dimensions' => array(
			'Length' => 108,
			'Width' => 5,
			'Height' => 5,
			'Units' => 'IN'
		),
		'CustomerReferences' => array(
			'0' => array(
				'CustomerReferenceType' => 'CUSTOMER_REFERENCE', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, 
 
				'Value' => 'GR4567892'
			), 
			'1' => array(
				'CustomerReferenceType' => 'INVOICE_NUMBER', 
				'Value' => 'INV4567892'
			),
			'2' => array(
				'CustomerReferenceType' => 'P_O_NUMBER', 
				'Value' => 'PO4567892'
			)
		),
		'SpecialServicesRequested' => array(
		'SpecialServiceTypes' => array('COD'),
		'CodDetail' => array(
			'CodCollectionAmount' => array(
				'Currency' => 'USD', 
				'Amount' => 150
			),
			'CollectionType' => 'ANY' // ANY, GUARANTEED_FUNDS
		)
	)
	)
	)
);
 
 
 
$response = $client->processShipment($request); 
 
 
$fp = fopen(SHIP_CODLABEL, 'wb');   
fwrite($fp, $response->CompletedShipmentDetail->CompletedPackageDetails->CodReturnDetail->Label->Parts->Image); //Create COD Return 
 
//PNG or PDF file
fclose($fp);
echo '<a href="./'.SHIP_CODLABEL.'">'.SHIP_CODLABEL.'</a> was generated.'.Newline;
 
$fp = fopen(SHIP_LABEL, 'wb');   
fwrite($fp, ($response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image));
fclose($fp);
echo '<a href="./'.SHIP_LABEL.'">'.SHIP_LABEL.'</a> was generated.'; 
 
$imagick = new Imagick();
$imagick->readImage('http://example.com/CODgroundreturnlabel.pdf');
$imagick->writeImages('converted.jpg', false); 
 
echo '<img src="http://example.com/converted-1.jpg">';
?>
?>