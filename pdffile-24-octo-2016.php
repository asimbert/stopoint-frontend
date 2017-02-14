<?php 

require("inc/config.php"); 

 $ProductId = $_REQUEST['id'];



  //STP45837733000

  //echo "select * from `order` where TrackingCode='".$_REQUEST['track']."'";

 

  $in2=mysql_query("select * from `order` ord

  

  INNER JOIN product as pd ON pd.ProductCode = ord.ProductId

   where TrackingCode='". $ProductId."'");

 echo "select * from `order` ord INNER JOIN product as pd ON pd.ProductCode = ord.ProductId where TrackingCode='". $ProductId."'"; 

  

	//$in2=mysql_query("select * from finalorder where tid='STP45837733000'");

	

        $row2=  mysql_fetch_array($in2);

		$add_days = 30;

	  $my_date = date('m/d/y',strtotime($row2['OrderDate']));

	  $bcode = $ProductId;

	  

	  $my_date = date('m/d/Y',strtotime($my_date.' +'.$add_days.' days'));

	

//============================================================+

// File name   : example_001.php

// Begin       : 2008-03-04

// Last Update : 2013-05-14

//

// Description : Example 001 for TCPDF class

//               Default Header and Footer

//

// Author: Nicola Asuni

//

// (c) Copyright:

//             sahib khan



//               sahibkust@gmail.com

//============================================================+



  //$er=0;

  

 

                //$inn=mysql_query("select * from `product` where id=".$ProductId );

                //$rownn=  mysql_fetch_array($inn);

             

                

// Include the main TCPDF library (search for installation path).

require_once('tcpdf.php');



// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information

$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor('Sahib');

$pdf->SetTitle('PDF');

$pdf->SetSubject('PDF Generate');

$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

 

// set default header data

// remove default header/footer

$pdf->setPrintHeader(false);

$pdf->setPrintFooter(true);



// set default monospaced font

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// set margins

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);



// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);



// set image scale factor

//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setImageScale(1.53);

// set some language-dependent strings (optional)

if (file_exists(dirname(__FILE__).'/lang/eng.php')) {

	require_once(dirname(__FILE__).'/lang/eng.php');

	$pdf->setLanguageArray($l);

}



// ---------------------------------------------------------



// set font



// add a page

$pdf->AddPage();

// set text shadow effect

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.0, 'depth_h'=>0.0, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$html = '<table width="100%">

<tr><td colspan="2" width="63%"><div><img src="https://www.stopoint.com/images/logo.png" width="120" hieght="80"/></div></td><td colspan="2"><div style="float:right"><img src="https://www.stopoint.com/image.php?filetype=JPEG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text='.$bcode.'&thickness=60&code=BCGcode128" /></div></td></tr></table><br>';



$html .='<table width="91%"  style="text-align:justify">

<tr><td width="70%">

<table width="100%" style="text-align:justify">

<tr><td colspan="6"><b>Packing slip</b></td></tr>

<tr><td colspan="6">Place this slip inside the box with your device.</td></tr>

<tr><td colspan="6">&nbsp;</td></tr>

<tr><td colspan="6">&nbsp;</td></tr>

<tr><td width="70%">ITEM</td><td width="20%">OFFER</td></tr><br>

<tr><td class="5">'.$row2['Description'].'</td><td  colspan="1">$'.$row2['OrderAmount'].'</td></tr>

<tr><td colspan="5">------------------------------------------------------------------------</td></tr>

<tr><td width="51%"></td><td  width="35%">Total Offer: $'.$row2['OrderAmount'].'</td></tr>

<tr><td colspan="6">&nbsp;</td></tr>

<tr><td colspan="6" width="97%"><b>You have until '.$my_date.' to ship your device.</b><br>

If you send your device after the expiration date we cannot honor your initial offer.<br>

We will not accept devices that have been reported lost or stolen. <br>
<p style="color:#FF0000; border: 2px solid; border-top-left-radius: 2em; border-top-right-radius: 2em; border-bottom-left-radius: 2em; border-bottom-right-radius: 2em;";>
<ul>&nbsp;<li>For watches and phones: do not include the original package. It has no impact on your payment.</li> 
<li>The usage of small size boxes or envelopes is highly encouraged.</li></ul></p> 
</td></tr></table></td><td width="40%" style="border-bottom:#f00 solid 0.5px; border-left:#f00 solid 0.5px; border-top:#f00 solid 0.5px;">

<div>

<p align="center"><img src="http://www.stopoint.com/images/w1.png"/></p>

<div style="padding:10px; text-algin:justify">

<b>"Find my iPhone" must be turned off</b>

This feature locks your device and will delay or reduce payment.<br>

<p align="left" ><b>How to deactivate:</b></p>

1:Tap the "settings" icon on your homescreen.<br>

2:Tap iCloud from the settings menu.<br>

3:If "Find My iPhone" is on,tap the slider to turn it off.  

</div>

</div>

</td></tr></table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

$html .= '<br><br><br><br><div><table width="100%"  style="text-align:justify">

<tr><td colspan="3"><strong>Shipping label & checklist</strong><br>

 Detach and stick the shipping label below to the outside of your box.<br><br><br><br>

BEFORE YOU SEND IT...</td>

  </tr><br>

<tr><td><div>

  <b>Unlock your device</b><br />

  Make sure you have turned off any password protection from your device so we can test it. Leaving it locked could delay payment.

  </div></td>

  <td><div >

  <b>Save your data</b><br>

Save your photos and files. If  your device has an SD card, donot  forget to remove it. We will erase  all the information from your  device..

</div></td>

   <td ><div>

     <b>Turn off device tracking</b><br />

       Leaving this on will lock your  device and delay or reduce your  payment.

   

   </div></td>

  </tr><br>

  <tr><td ><div>

  <b>Send just your device</b><br />

  Please do not send in any extra  items that you did not submit  online. We cannot pay you for  additional items.

</div></td>

<td><div>

  <b>Remove your SIM card </b><br />

 It is very important that you remove the SIM card before sending your device. This will deactivate it from any existing service accounts.

</div></td> 

<td ><div>

     <b>Deactivate your service</b><br />

       It is very important that you contact your carrier to terminate service on the device and pay any remaining balance on your bill 

   </div></td>

  </tr>

  <br>

  <tr><td colspan="3">For questions about shipping, find answers at: www.stopoint.com/help</td>

  </tr><br><br><br><br><br><br><br><br><br><br><br><br><br>

     <tr>

	 

<td colspan="6"><img src="shippinglabels/'.$row2['TrackingCode'].'.png") class="labelImage" width="650" height="380" /></td>

  </tr

></table></div>';

// set color for background

//$pdf->SetFillColor(255, 255, 255);



//$y = $pdf->getY();



//$pdf->writeHTMLCell(130, '', '', $y, $left_column, 0, 0, 1, true, 'J', true);

// Print text using writeHTMLCell()

//255, 31, 0

//$pdf->SetTextColor(0, 31, 0);

//$pdf->writeHTMLCell(60, '', '', '', $right_column, 0, 1, 1, true, 'J', true);



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true,'J');

// ---------------------------------------------------------



// Close and output PDF document

// This method has several options, check the source code documentation for more information.

ob_clean();

$pdf->Output('PDF_FILE.pdf', 'I');



//============================================================+

// END OF FILE

//============================================================+