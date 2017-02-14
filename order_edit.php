<?php
include "header.php";
if(!isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])){
	header('Location: '.$base_url.'/');
}

//Validate order id if it belong to the logged in user...
if(isset($_GET['id']) && trim($_GET['id']) === ""){
	header('Location: ' . $base_url . '/dashboard');
}


if(isset($_GET['id'])){
	$qry_usr_chk = "SELECT id FROM `order` WHERE id = '" . $_GET['id'] . "' AND UserId = '" . $_SESSION['login_id'] . "'";
    $res_usr_chk = mysql_query($qry_usr_chk);
	$num_rows_usr_chk = mysql_num_rows($res_usr_chk);
	if($num_rows_usr_chk == 0){
		header('Location: ' . $base_url . '/dashboard');
	}
}

$messages_query = mysql_query("SELECT * FROM `messages` WHERE ToId = '" . $_SESSION['login_id'] . "' and FromId != '" . $_SESSION['login_id'] . "' and IsRead='0'");
$numrows_message = mysql_num_rows($messages_query);
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
$query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode, order.FedexCode as FedexCode,order.Returnlabel as Returnlabel, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount , order.AdjustedAmount as AdjustedAmount, product.ProductModel as ProductModel , product.ProductCode as ProductCode, productfamily.Name as ProductName, product.Description as Description, user.PaypalEmail as PaypalEmail, 
 CASE order.OrderStatus
	WHEN '14' THEN 'Blacklisted'
	WHEN '13' THEN 'Inspection'
	WHEN '12' THEN 'Inspection'
	WHEN '11' THEN 'Installment Payment'
    WHEN '10' THEN 'Activation Locked'
	WHEN '9' THEN 'Return Completed'
	WHEN '8' THEN 'Expired' 
    WHEN '7' THEN 'Cancelled' 
    WHEN '6' THEN 'Paid'
    WHEN '5' THEN 'Released Payment'
    WHEN '4' THEN 'Returned'
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
$rowsorderadjust_query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                    CASE order.OrderStatus
													WHEN '14' THEN 'Blacklisted'
													WHEN '13' THEN 'Inspection'
													WHEN '12' THEN 'Inspection'
													WHEN '11' THEN 'Installment Payment'
                                                   WHEN '10' THEN 'Activation Locked'
													WHEN '9' THEN 'Return Completed'
												   WHEN '8' THEN 'Expired' 
                                                    WHEN '7' THEN 'Cancelled' 
                                                    WHEN '6' THEN 'Paid'
                                                    WHEN '5' THEN 'Released Payment'
                                                    WHEN '4' THEN 'Returned'
                                                    WHEN '3' THEN 'Adjusted Price'
                                                    WHEN '2' THEN 'Received'
                                                    WHEN '1' THEN 'Pending'
                                                    ELSE 'Pending'
                                                    END as OrderStatus
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=3 ORDER BY order.OrderDate desc");
$numrow_adjust = mysql_num_rows($rowsorderadjust_query);


$rowsorderactivated_query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                    CASE order.OrderStatus
													WHEN '14' THEN 'Blacklisted'
													WHEN '13' THEN 'Inspection'
													WHEN '12' THEN 'Inspection'
													WHEN '11' THEN 'Installment Payment'
                                                   WHEN '10' THEN 'Activation Locked'
													WHEN '9' THEN 'Return Completed'
												   WHEN '8' THEN 'Expired' 
                                                    WHEN '7' THEN 'Cancelled' 
                                                    WHEN '6' THEN 'Paid'
                                                    WHEN '5' THEN 'Released Payment'
                                                    WHEN '4' THEN 'Returned'
                                                    WHEN '3' THEN 'Adjusted Price'
                                                    WHEN '2' THEN 'Received'
                                                    WHEN '1' THEN 'Pending'
                                                    ELSE 'Pending'
                                                    END as OrderStatus
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=10 ORDER BY order.OrderDate desc");
$numrow_activated = mysql_num_rows($rowsorderactivated_query);

$rowsorder_Countreview = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                    CASE order.OrderStatus
													WHEN '14' THEN 'Blacklisted'
													WHEN '13' THEN 'Inspection'
													WHEN '12' THEN 'Inspection'
													WHEN '11' THEN 'Installment Payment'
													WHEN '10' THEN 'Activation Lock'
													WHEN '9' THEN 'Return Completed'
                                                   WHEN '8' THEN 'Expired' 
                                                    WHEN '7' THEN 'Cancelled' 
                                                    WHEN '6' THEN 'Paid'
                                                    WHEN '5' THEN 'Released Payment'
                                                    WHEN '4' THEN 'Returned'
                                                    WHEN '3' THEN 'Adjusted Price'
                                                    WHEN '2' THEN 'Received'
                                                    WHEN '1' THEN 'Pending'
                                                    ELSE 'Pending'
                                                    END as OrderStatus
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=6 ORDER BY order.OrderDate desc");
                                                $numrowreview = mysql_num_rows($rowsorder_Countreview);
												
												$countnum2=0;
												while ($rowordertest2 = mysql_fetch_assoc($rowsorder_Countreview)) {

                                                                $testimonial_query2 = mysql_query('select OrderId from testimonial where OrderId="' . $rowordertest2['OrderId'] . '"');
																
                                                                $numrowstest2 = mysql_num_rows($testimonial_query2);
                                                                if ($numrowstest2 == '0') {
																	$countnum2++;			
																}
												}
?>
<style type="text/css">
     .section-header{
        display: block !important;
    }
    .nav-list > li {
        border-left: 1px solid #eee;
        padding: 20px 15px 15px;
    }
    .nav-sidebar-filter li {
        border-left: 0 none !important;
        margin-bottom: 4px;
    }
    .nav-sidebar-filter > li > a {
        font-size: 15px;
        padding: 5px 0;
    }
    .nav-sidebar-filter > li > a i {
        padding-right: 10px;
    }
    a {
        color: #4a454b;
    }
    .nav-sidebar-filter li.active a {
        color: #84BC41;
    }

    .nav-sidebar-filter > li > a:hover {
        color: #84BC41 !important;
        background-color: transparent !important;
    }
    table {
        font-size: 12px;
    }
    .table a {
        color: #84BC41;
    }
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="css/external.css"/>
<style>
    table td, th {
    text-align: left !important;
    }

</style>
<div class="container">
    <div class="row no-gutter">
        <div class="col-md-3 col-sm-3">
                <nav class="pad-20">
                    <ul class="nav nav-list nav-sidebar-filter">
                            <?php
                        if (!$_GET['tab']) {
                            ?>
                            <li class="active"><a href="https://www.stopoint.com/dashboard?tab=tab_overview"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li ><a href="https://www.stopoint.com/dashboard?tab=tab3"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li ><a href="https://www.stopoint.com/dashboard?tab=tab3"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li ><a href="https://www.stopoint.com/dashboard?tab=tab1"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="https://www.stopoint.com/dashboard?tab=tab2"><i class="fa fa-key"></i>Change Password</a></li>
                            <li><a href="https://www.stopoint.com/dashboard?tab=tab4" ><i class="fa fa-comments"></i>Messages<?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                            <li><a href="https://www.stopoint.com/dashboard?tab=tab7"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></li>
                            
                            <li><a href="https://www.stopoint.com/dashboard?tab=tab8"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></li>
                            <?php
                        }
                        ?>
                        <br/><br/>

                    </ul>
                </nav>
            </div>
        <div class="col-md-9 col-sm-9">
            <div class="pad-20 dashboard">
                <div class="row no-gutter">
                   
                        <div class="productcell-frame">
                            
                            <ul class="ordermenu">
                                <li>
                                    <a href="<?php echo $base_url; ?>/pdffile.php?id=<?=$roworder['TrackingCode']?>" target="_blank">Reprint Shipping Label</a>
                                </li>
                            </ul>
                            <div class="order-details clearfix">
                                <div class="fl orderbox">
                                    <img src="images/orderbox.jpg">
                                    </div>
                                    <div class="fl">
                                        <strong><?=$roworder['OrderId']?></strong>
                                        <em>Created on <?=date('m/d/Y h:i:s', strtotime($roworder['OrderDate']))?></em>
                                        <br> We are waiting to receive the box you created on <?=date('m/d/Y h:i:s', strtotime($roworder['OrderDate']))?>
                                            <br>
                                                <div class="">Shipment tracking number 
                                                    <strong>
                                                        <?=$roworder['TrackingCode']?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             
                            </div>
                        </div>
                        
                          <?php 
						  if($roworder['OrderStatus'] == 'Paid'){
							  ?>
                              <br /><br />
                              <p><strong>Payment Details:</strong></p>
                              
                              <?php
							  if($wetransactionquery['PaymentMethod']==1)
							  {
								  ?>
                              <p>Paypal Transaction No :<?php echo $wetransactionquery['TransactionId'] ?> </p>
                                 
                                  <?php
								  }
							  else{
							  ?>
                              <p>Check Number: <?php echo $wetransactionquery['ChequeNumber'] ?> </p>
                              
                              <?php
							  }
							  }
                                                                if($roworder['OrderStatus']=='Adjusted Price')
                                                                {
                                                            ?>
                                                        <span style="color:red;font-weight: bold">Action is required for your <?= $roworder['Description']; ?>. Please <a href="https://www.stopoint.com/dashboard?tab=tab7">"CLICK HERE"</a> to resolve </span>
                                                        <?php 
                                                                }
                                                            ?>
                        <div class="pad-20 dashboard">
                            <div class="row no-gutter">
                               
                                           <?php 
                                                        if(isset($_GET['order_delete'])){
	  
	  $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = ".$_GET['order_delete']) or die(mysql_error());
	  header('Location: '.$base_url.'/order_edit.php?err_msg=order_delete_success');
  }
                                                    ?>
                                                    <?php
if($_GET['err_msg']== "order_delete_success"){
?>
	<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Your Order has been cancelled successfully.
  	</div>
<?php
}
?>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <strong>YOUR ORDER DETAILS</strong>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-hover hidden-xs" >
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <strong class="text-uppercase">Order Number</strong>
                                                        </th>
                                                       
                                                        <th>
                                                            <strong class="text-uppercase">Fedex Tracking Id</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Return No</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Track Payment</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Order Date</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Product</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Original Amount</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Adjusted Amount</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Order Status</strong>
                                                        </th>
                                                        <th>
                                                            <strong class="text-uppercase">Condition </strong>
                                                        </th>
                                                        <?php 
                                                                if($roworder['OrderStatus']=='Pending')
                                                                {
                                                            ?>
                                                        <th>
                                                            <strong class="text-uppercase"> Item Actions </strong>
                                                        </th>
                                                        <?php 
                                                                }
                                                            ?>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                             
                                                    <tr>
                                                        <td><?=$roworder['OrderId']?></td>
                                                        <td><?=$roworder['FedexCode']?></td>
                                                        <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['Returnlabel']; ?> 
                                                        "target="['_blank']"><?php echo $roworder['Returnlabel']; ?></a></td>
                                                        <td><?=$wetransactionquery['TransactionId']?></td>
                                                        <td><?=date('m/d/Y h:i:s', strtotime($roworder['OrderDate']))?></td>
                                                        <td><?php echo htmlspecialchars($roworder['Description']);?></td>
                                                        <td>$ <?php echo $roworder['OrderAmount'];?></td>
                                                        <td><?php echo $roworder['AdjustedAmount'];?></td>
                                                        <td><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworder['OrderStatus']; ?>
                                                                                                                            </a></td>
                                                        <td><?=$roworder['OrderCondition']?></td>
                                                        <?php 
                                                                if($roworder['OrderStatus']=='Pending')
                                                                {
                                                            ?>
                                                        <td>
                                                            
                                                            <a href="<?php echo $base_url; ?>/order_edit.php?order_delete=<?=$roworder['OrderId']?>"><button style="margin-top: 0px;" class="btn btn-danger small-btn">Cancel</button></a>
                                                            
                                                        </td>
                                                        <?php 
                                                                }
                                                            ?>
                                                        </tr>
                                                        <tr class="active">
                                                            <th scope="row">&nbsp;</th>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            
                                                            <td>
                                                                <strong class="total-order">Total Order Value</strong>
                                                            </td>
                                                            <?php 
                                                                if($roworder['AdjustedAmount']!='')
                                                                {
                                                            ?>
                                                            <td class="bluetxt total-order">$<?php echo $roworder['AdjustedAmount'];?></td>
                                                            <?php 
                                                                }else{
                                                            ?>
                                                            <td class="bluetxt total-order">$<?php echo $roworder['OrderAmount'];?></td>
                                                            <?php 
                                                                }
                                                            ?>
                                                            
                                                           <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <?php 
                                                                if($roworder['OrderStatus']=='Pending')
                                                                {
                                                            ?>
                                                        <td>&nbsp;</td>
                                                        <?php 
                                                                }
                                                            ?>
                                                           
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                                <div class="col-sm-12 visible-xs no_pad" style="border-bottom: 3px solid #84BC41;">
                                                	<div class="full_tabil">
                                                		<div class="tbl_hed">
	                                                		<div class="tbl_hed_in2">
	                                                			Order <br /> Number
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Fedex <br /> Tracking Id
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Track <br /> Payment
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Order <br /> Date
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Product
	                                                		</div>
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		<div class="tbl_body_box2"><?=$roworder['OrderId']?></div>
	                                                		<div class="tbl_body_box2 tbl_body_box_break"><?=$roworder['FedexCode']?></div>
	                                                		<div class="tbl_body_box2"><?php
															if($wetransactionquery['TransactionId'] == ''){
																?>
                                                                &nbsp;
                                                                <?php
																
																}
															else{
																echo $wetransactionquery['TransactionId'];
																}
															?></div>
	                                                		<div class="tbl_body_box2"><?=date('m/d/Y h:i:s', strtotime($roworder['OrderDate']))?></div>
	                                                		<div class="tbl_body_box2"><?php echo htmlspecialchars($roworder['Description']);?></div>
	                                                	</div>
                                                	</div>
                                                	
                                                	<div class="full_tabil">
	                                                	<div class="tbl_hed">
	                                                		<div class="tbl_hed_in2">
	                                                			Original <br /> Amount
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Adjusted <br /> Amount
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Order <br /> Status
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Condition
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			&nbsp;
	                                                		</div>
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		<div class="tbl_body_box2">$ <?php echo $roworder['OrderAmount'];?></div>
	                                                		<div class="tbl_body_box2"> <?php 
                                                                if($roworder['AdjustedAmount']!='')
                                                                {
                                                            ?>
                                                            $<?php echo $roworder['AdjustedAmount'];?>
                                                            <?php 
                                                                }else{
                                                            ?>
                                                           &nbsp;
                                                            <?php 
                                                                }
                                                            ?></div>
	                                                		<div class="tbl_body_box2"><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworder['OrderStatus']; ?>
                                                                                                                            </a></div>
	                                                		<div class="tbl_body_box2"><?=$roworder['OrderCondition']?></div>
	                                                		<div class="tbl_body_box2">&nbsp;</div>
	                                                	</div>
	                                                </div>
                                                	<div class="tot_part"><p> Total Order Value <span> <?php 
                                                                if($roworder['AdjustedAmount']!='')
                                                                {
                                                            ?>
                                                            &nbsp;
                                                            <?php 
                                                                }else{
                                                            ?>
                                                           $<?php echo $roworder['OrderAmount'];?>
                                                            <?php 
                                                                }
                                                            ?></span></p></div>
                                                </div>
                                                
                                            </div>
                                           
                                                            </div>
                                                       
                                                    </div>
                                                </div>

 
           <?php

if(isset($_GET['send'])){
?>
<h1 class="form-heading">MESSAGES</h1>
<?php
//$msg_query = "SELECT messages.id as id,messages.Subject as Subject,messages.Comments as Comments,messages.ToId as ToId,messages.Date as Date, user.id as userid, user.image_url as Image FROM `messages` INNER JOIN user on messages.FromId = user.id INNER JOIN `order` on messages.OrderId = order.id WHERE messages.OrderId = ".$_GET['id']." AND parentid=0 ORDER BY id DESC";
//$remsg_query = mysql_query($msg_query);
//if(mysql_num_rows($remsg_query)<=0){
?>
<!--<div class="form-group">
<span style="font-size:14px; font-weight:bold">No Conversation against this order.</span>
</div>-->
<?php
//}else{
//while ($wemsg_query = mysql_fetch_assoc($remsg_query)){
?>
<!--<div class="form-group">
<span style="font-size:14px; font-weight:bold">Subject : </span>
<span style="font-size:14px"><span id="Subject"><?php //echo $wemsg_query['Subject']; ?></span></span>
</div>
<div class="form-group">
<span style="font-size:14px"><img src="<?php //echo $base_url; ?>/images/users/<?php //echo $wemsg_query['Image']; ?>" style="border-radius:50%; float:left;"  height="50" width="50" alt="User Image"/></span>
<span style="margin-left:15px;"> <?php //echo $wemsg_query['Date']; ?>
<br />
<span style="font-size:14px; font-weight:bold; margin-left:15px;">Comments : </span>
<span style="font-size:14px"> <?php //echo $wemsg_query['Comments']; ?></span></span>
</div>-->
<?php
/*if($wemsg_query['ToId'] >= 0){
$to_query = "SELECT messages.id as id,messages.Subject as Subject,messages.Comments as Comments,messages.ToId as ToId,messages.Date as Date, user.FirstName as fname, user.image_url as image FROM `messages` INNER JOIN user on messages.FromId = user.id INNER JOIN `order` on messages.OrderId = order.id WHERE messages.OrderId = ".$_GET['id']." AND parentid=".$wemsg_query['id']." ORDER BY id DESC";
$reto_query=mysql_query($to_query);
while($weto_query=mysql_fetch_assoc($reto_query)){
if($weto_query['Subject'] != ''){*/
?>
<!--<div class="form-group">
<span style="font-size:14px; font-weight:bold">Subject : </span>
<span style="font-size:14px"><span id="Subject"><?php //echo $weto_query['Subject']; ?></span></span>
</div>-->
<?php //}?>
<!--<div class="form-group">
<span style="font-size:14px"><img src="<?php //echo $base_url; ?>/images/<?php //echo "admin.png"; ?>" style="border-radius:50%; float:left;"  height="50" width="50" alt="Admin Image"/></span>
<span style="margin-left:15px;"> <?php //echo $weto_query['Date']; ?>
<br />
<span style="font-size:14px; font-weight:bold; margin-left:15px;">Comments : </span>
<span style="font-size:14px"> <?php //echo $weto_query['Comments']; ?></span></span>
</div>
--><?php
//}
//}
?>
<!--<hr style="  display: block;
  -webkit-margin-before: 0.5em;
  -webkit-margin-after: 0.5em;
  -webkit-margin-start: auto;
  -webkit-margin-end: auto;
  border-style: inset;
  border-width: 1px;" />-->
<?php
//}
//}
}
?>
<br />
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
		$mail->Password = EMAIL_CREDENTIAL;
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
		header('Location: '.$base_url.'/dashboard.php?tab=tab5&err_msg=email_send_success');
		}
 	else{
		header('Location: '.$base_url.'/dashboard.php?tab=tab3&err_msg=email_send_fail'); 
		}
}
}
?>
<div class="new" style="display: none;">
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
                                        </div>
                                    </div>
<div aria-hidden="true" aria-labelledby="itemglossary" role="dialog" tabindex="-1" id="itemglossary" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <i class="fa fa-close"></i>
                </button>
                <h4 id="myModalLabel" class="modal-title">
                    <strong>stopoint.com Item Status Definitions</strong>
                </h4>
                <p>
                    <strong>Learn more about what each item status means for items in your stopoint order</strong>
                </p>
            </div>
            <div class="modal-body clearfix">
                <div class="col-sm-5 no-gutter " id="glossary">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left col-sm-12">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-a">Pending</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-b">Received</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-c">Returned</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-d">Cancelled</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-e">Paid</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-f">Expired</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-g">Adjusted Orders</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-h">Released Payment</a>
                        </li>
						<li>
                            <a data-toggle="tab" href="#tab-i">Installment Payment</a>
                        </li>
						<li>
                            <a data-toggle="tab" href="#tab-j">Inspection</a>
                        </li>
						<li>
                            <a data-toggle="tab" href="#tab-k">Activation Lock</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-sm-7 ">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="tab-a" class="tab-pane active">
                            <header class="section-header">
                                <h2>Pending</h2>
                            </header>
                            <p>Your order has been placed, but your package has not arrived at our facilities yet so your item has not yet been checked into our system</p>
                        </div>
                        <div id="tab-b" class="tab-pane">
                            <header class="section-header">
                                <h2>Received</h2>
                            </header>
                            <p>Your item has been received and is waiting for inspection within the next two business days.</p>
                        </div>
                        <div id="tab-c" class="tab-pane">
                            <header class="section-header">
                                <h2>Returned</h2>
                            </header>
                            <p>You rejected our new offer so we have returned your device back to you. You were sent a return tracking number via email and your device should be received back by you within the next five (5) business days.</p>
                        </div>
                        <div id="tab-d" class="tab-pane">
                            <header class="section-header">
                                <h2>Cancelled</h2>
                            </header>
                            <p>You cancelled your trade-in for this device so the trade now has a $0 value.</p>
                        </div>
                        <div id="tab-e" class="tab-pane">
                            <header class="section-header">
                                <h2>Paid</h2>
                            </header>
                            <p>Payment has been processed for your device. If you chose PayPal as your payment method, the funds should now be in your account. If you chose check as your payment method, please allow up to ten (10) business days for your check to be delivered. 
                            </p>
                        </div>
                        <div id="tab-f" class="tab-pane">
                            <header class="section-header">
                                <h2>Expired</h2>
                            </header>
                            <p>Your device failed inspection so we sent you a revised offer five (5) days ago. Since we haven't heard back from you within five (5) days, your revised offer has now expired and we will proceed with processing your item for payment within the next three (3) business days at the revised offer.</p>
                        </div>
                        <div id="tab-g" class="tab-pane">
                            <header class="section-header">
                                <h2>Adjusted Orders</h2>
                            </header>
                            <p>Your device failed inspection so we sent you a revised offer </p>
                        </div>
                        <div id="tab-h" class="tab-pane">
                            <header class="section-header">
                                <h2>Released Payment</h2>
                            </header>
                            <p>Your device has successfully passed inspection and is pending payment. If you chose PayPal as your payment method, the funds should be released in 24 hrs.  If you chose check as your payment method, please allow up to 5 business days for your check to be delivered.</p>
                        </div>
						<div id="tab-i" class="tab-pane">
                            <header class="section-header">
                                <h2>Installment Payment</h2>
                            </header>
                            <p>Your device has an installment payment or it is under contract. We can't proceed with the inspection process until the device is paid in full or it is out of contract. Otherwise, the purchased device will be blacklisted in a few days by the carrier.  Steps to take is contact your carrier to paid the balance in full. If you believe it is a mistake please contact us or your carrier to update the phone status on the system. We do not base the decision on our own analogy. We use systems provided by the carrier to inspect the phone.</p>
                        </div>
						<div id="tab-j" class="tab-pane">
                            <header class="section-header">
                                <h2>Inspection</h2>
                            </header>
                            <p>We are inspecting your device. This process check your serial number for installment payment or if your device has an activation lock “Find my Phone” is on. If your order is on this department it usually takes 24 hrs. Not all devices go to this department.</p>
                        </div>
						<div id="tab-k" class="tab-pane">
                            <header class="section-header">
                                <h2>Activation Lock</h2>
                            </header>
                            <p>Apple device was running iOS7 or later, it is automatically locked by the "Find My iPhone" Activation Lock, which is a new security feature that locks your Apple device to your iCloud account so we are unable to properly inspect it. Since we cannot unlock your device, we are unable to inspect your device until you remove your iCloud account from the device.</p>
							<p>
								<h5>WHAT YOU NEED TO DO</h5>Don’t worry; you can easily unlock your device remotely by going to: http://www.icloud.com
							</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/><br/>
<?php
include "footer.php";
?>
