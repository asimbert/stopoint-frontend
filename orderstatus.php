<?php
include "header.php";
if (isset($_POST['traceorder_submit']) || isset($_SESSION['stpnumber'])) {	
	if (isset($_POST['traceorder_submit'])){
		$email = $_POST['orderemailaddress'];
		$stpnumber = $_POST['stpnumber'];
		$_SESSION['email'] = $email;
		$_SESSION['stpnumber'] = $stpnumber;
	}
	else{
		$email = $_SESSION['email'];
		$stpnumber = $_SESSION['stpnumber'];
	}
$query = "SELECT order.id as OrderId, order.TrackingCode as TrackingCode, order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount , order.AdjustedAmount as AdjustedAmount , product.ProductModel as ProductModel , product.ProductCode as ProductCode, product.Description as ProductDescription, product.OrderNumber as OrderNumber, productfamily.image_url as ProductImage, user.FirstName as FirstName, user.LastName as LastName, user.EmailAddress as EmailAddress, user.S_AddressLine1 as S_AddressLine1, user.S_AddressLine2 as S_AddressLine2 , user.S_City as S_City, user.S_State as S_State, user.S_Country as S_Country,user.S_PostalCode as S_PostalCode, user.PaypalEmail as PaypalEmail, user.Phone as Phone,
 CASE user.PaymentMethod
  WHEN '2' THEN 'Check'
  WHEN '1' THEN 'Paypal'
 ELSE 'Nothing'
 END as PaymentMethod,
 CASE order.OrderStatus
  WHEN '7' THEN 'Cancelled' 
  WHEN '6' THEN 'Paid'
  WHEN '5' THEN 'Release Payment'
  WHEN '3' THEN 'Adjusted Price'
  WHEN '2' THEN 'Received'
  WHEN '1' THEN 'Pending'
 ELSE 'Pending'
 END as OrderStatus,
 CASE order.Condition
  WHEN '3' THEN 'Flawless'
  WHEN '2' THEN 'Good'
  WHEN '1' THEN 'Fair'
 ELSE 'Good'
 END as OrderCondition
FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productfamily` ON productfamily.Id=product.FamilyId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.TrackingCode= '".$stpnumber."' AND user.EmailAddress= '".$email."'";
$rowsorder = mysql_query($query);
$roworder = mysql_fetch_assoc($rowsorder);
}
if(mysql_num_rows($rowsorder) <= 0){
?>
<div class="container">
    <div class="row text-center">
    	<h1 class="sub-heading" style="  color: #44b749;">Order Status</h1>
    </div><!-- row --> 
    <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> Whoops! The information you entered doesn't match any accounts. Please check the email address and STP number and try again. The STP number can be found in emails received from Stopoint. It looks like STP1234567890.
  	</div>
</div>
<br />
<br />
<br />
<br />
<?php
}
else{
?>
<!-- slider -->
<div class="container">
	<div class="col-lg-12">
    <h1 class="sub-heading" style="text-align:center">Order Status</h1>
    	<div class="col-lg-3"></div>
        <div class="col-lg-6">
    	<table class="table table-striped" style="width: 100%">
        <tbody>
        	<tr>
            	<td style="text-align:left; font-weight:bold">Order No :</td>
            	<td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['OrderId']?></td>
            </tr>
        	<tr>
            	<td style="text-align:left; font-weight:bold">Tracking No :</td>
            	<td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['TrackingCode']?></td>
            </tr>
            <tr>
            	<td style="text-align:left; font-weight:bold">Fedex Tracking ID:</td>
            	<td style="text-align:left">&nbsp;&nbsp;&nbsp;<a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode'];?> 
" target="_blank"><?=$roworder['FedexCode']?></a></td>
            </tr>
            <?php
				  if($roworder['OrderStatus'] == 'Paid')
				  {
					  $query = "SELECT * FROM `ordertrasactions` WHERE OrderId = ".$roworder['OrderId'];
					  $rowsordertran = mysql_query($query);
					  $rowordertran = mysql_fetch_assoc($rowsordertran);
			?>
            <tr>
            	<td style="text-align:left; font-weight:bold">Track Payment:</td>
            	<td style="text-align:left">&nbsp;&nbsp;&nbsp;<a href="fedex.com" target="_blank"><?=$rowordertran['TransactionId']?></a></td>
            </tr>
            <?php
				  }
			?>
            <tr>
                <td style="text-align:left; font-weight:bold">Date :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=date('m/d/Y h:i:s', strtotime($roworder['OrderDate']))?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Name :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['FirstName'].' '.$roworder['LastName']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Email :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['EmailAddress']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Shipping Address :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['S_AddressLine1'].' '.$roworder['S_AddressLine2']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Shipping City :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['S_City']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Shipping State :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['S_State']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Postal Code :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['S_PostalCode']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Shipping Country :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['S_Country']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Phone :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['Phone']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Adjust Amount :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['AdjustedAmount']?></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Payment Method :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['PaymentMethod']?></td>
            </tr>
            <?php
			if($roworder['PaymentMethod'] == "Paypal"){
			?>
            <tr>
                <td style="text-align:left; font-weight:bold">Paypal Email :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['PaypalEmail']?></td>
            </tr>
            <?php
			}else{
			?>
            <tr>
                <td style="text-align:left; font-weight:bold">Account Title :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<?=$roworder['FirstName'].' '.$roworder['LastName']?></td>
            </tr>
            <?php
			}
			?>
             <tr>
                <td style="text-align:left; font-weight:bold">Packing Slip :</td>
                <td style="text-align:left">&nbsp;&nbsp;&nbsp;<a href="pdffile.php?id=<?=$roworder['TrackingCode']?>" target="_blank">Packing Slip</a></td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Processing Status :</td>
                <td style="text-align:left; color:red">&nbsp;&nbsp;&nbsp;<?=$roworder['OrderStatus']?></td>
            </tr>
    	</tbody>
        </table>
        <table style="width: 100%">
              <tbody>
              <tr>
                  <th style="background-color: #7c807e;color: white"><center>Image</center></th>
                  <th style="background-color: #7c807e;color: white"><center>Description</center></th>
                  <th style="background-color: #7c807e;color: white"><center>Amount</center></th>
              </tr>
              <tr>
              	  <td>&nbsp;</td>
              </tr>
              <tr align="center">
                  <td>
                  <img src="<?=$base_url?>/productimages/<?=$roworder['ProductImage']?>" width="70" height="70" alt="<?=$roworder['ProductDescription']?>" />
                  </td>
              	  <td><?=$roworder['ProductDescription']?></td>
                  <td>
                  $
				  <?php
				  if($roworder['AdjustedAmount'] == '')
				  {
					  echo $roworder['OrderAmount'];
				  }
				  else
				  {
					  echo $roworder['AdjustedAmount'];
				  }
				  ?>
                  </td>
              </tr>           
              </tbody>
          </table>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div><!-- end container --> 
<!-- end slider -->
<br />
<br />
<br />
<br />
<?php
}
include "footer.php";
?>