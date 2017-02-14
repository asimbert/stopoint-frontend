<?php
include "header.php";
require_once 'inc/Bcrypt.php';
//include "mail_function.php";
if (!isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])) {
    header('Location: ' . $base_url . '/login');
}


//Validate order id if it belong to the logged in user...
if(isset($_GET['orderno']) && trim($_GET['orderno']) === ""){
	header('Location: ' . $base_url . '/dashboard');
}


if(isset($_GET['orderno'])){
	$qry_usr_chk = "SELECT id FROM `order` WHERE id = '" . $_GET['orderno'] . "' AND UserId = '" . $_SESSION['login_id'] . "'";
    $res_usr_chk = mysql_query($qry_usr_chk);
	$num_rows_usr_chk = mysql_num_rows($res_usr_chk);
	if($num_rows_usr_chk == 0){
		header('Location: ' . $base_url . '/dashboard');
	}
}

	
//**********Handling customer response for installement activity (YES/NO)**********
if (isset($_GET['installment']) && isset($_GET['orderno'])) {
	$pqueryrelease = "SELECT * FROM `order` WHERE id = '" . $_GET['orderno'] . "'";
    $rpqueryrelease = mysql_query($pqueryrelease);
    $wpqueryrelease = mysql_fetch_assoc($rpqueryrelease);
	if($_GET['installment'] == "yes"){
		if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
    $queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 12 WHERE id = " . $_GET['orderno']) or die(mysql_error());	//Should move to IMEI check
	}
	}
	if($_GET['installment'] == "no"){
		if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 4 WHERE id = " . $_GET['orderno']) or die(mysql_error());	//return order
	}
	}
	
	header('Location: ' . $base_url . '/dashboard');
	
}
//**********************************

//**********Handling customer response for activated activity (YES/NO)**********
if (isset($_GET['activated']) && isset($_GET['orderno'])) {
	$pqueryrelease = "SELECT * FROM `order` WHERE id = '" . $_GET['orderno'] . "'";
    $rpqueryrelease = mysql_query($pqueryrelease);
    $wpqueryrelease = mysql_fetch_assoc($rpqueryrelease);
	if($_GET['activated'] == "yes"){
		if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
    $queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 13 WHERE id = " . $_GET['orderno']) or die(mysql_error());	//changed order status from 5(Release payment) to 13(Activation-Lock inspection)
	}
	}
	if($_GET['activated'] == "no"){
		if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 4 WHERE id = " . $_GET['orderno']) or die(mysql_error());
	}
	}
	
	header('Location: ' . $base_url . '/dashboard');
}
//**********************************

//**********Handling customer response for accept activity (YES/NO)**********
if (isset($_GET['accept']) && isset($_GET['orderno'])) {
	$pqueryrelease = "SELECT * FROM `order` WHERE id = '" . $_GET['orderno'] . "'";
    $rpqueryrelease = mysql_query($pqueryrelease);
    $wpqueryrelease = mysql_fetch_assoc($rpqueryrelease);
	if($_GET['accept'] == "yes"){
		 
	if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 15 WHERE id = " . $_GET['orderno']) or die(mysql_error());	//Release Payment(4) to Adjusted Price Inspection(15)
		}
    
	}
	if($_GET['accept'] == "no"){
	if($wpqueryrelease['OrderStatus'] == 6){
	}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 4 WHERE id = " . $_GET['orderno']) or die(mysql_error());
	}
	}
	
	header('Location: ' . $base_url . '/dashboard');
}
//**********************************

$queryall = "SELECT * from user WHERE id = '" . $_SESSION['login_id'] . "' AND UserType = 'User'";
$resultall = mysql_query($queryall);
$resultuser = mysql_fetch_array($resultall);
$sqlAllStates = "SELECT * FROM `state`";
$sqlAllStatesResult = mysql_query($sqlAllStates);
$row = mysql_fetch_assoc($sqlAllStatesResult);
if ($sqlAllStatesResult) {
    while ($row = mysql_fetch_object($sqlAllStatesResult)) {
        $objAllStates[] = $row;
    }
}
$messages_query = mysql_query("SELECT * FROM `messages` WHERE ToId = '" . $_SESSION['login_id'] . "' and FromId != '" . $_SESSION['login_id'] . "' and IsRead='0'");
$numrows_message = mysql_num_rows($messages_query);
if (isset($_POST['submit_testimonial'])) {
    $id = $_POST['orderidhidden'];
    $pquery = "SELECT * FROM `order` WHERE id = '" . $id . "'";
    $rpquery = mysql_query($pquery);
    $wpquery = mysql_fetch_assoc($rpquery);

    $uquery = "SELECT * FROM `user` WHERE id = '" . $wpquery['UserId'] . "'";
    $ruquery = mysql_query($uquery);
    $wuquery = mysql_fetch_assoc($ruquery);

    $contents = $_POST['contents'];
    $rating = $_POST['rating'];
    
	 $query = 'INSERT INTO testimonial SET UserId = ' . $_SESSION['login_id'] . ', OrderId = ' . $id . ', ProductId = "' . $wpquery['ProductId'] . '", UserName = "' . $wuquery['FirstName'] . ' ' . $wuquery['LastName'] . '", UserCity = "' . $wuquery['S_City'] . '", UserState = "' . $wuquery['S_State'] . '", Contents = "' . $contents . '", Rate = "' . $rating . '", ShowOnHomePage = 0';
    $result = mysql_query($query) or die(mysql_error());
    $id = mysql_insert_id();
    if ($result) {
        header('Location: ' . $base_url . '/dashboard.php?id=' . $id . '&err_msg=testimonial_success&msg=testimonials&tab=tab3');
    } else {
        header('Location: ' . $base_url . '/dashboard.php?id=' . $id . '&err_msg=testimonial_error&msg=testimonials&tab=tab3');
    }
}
mysql_query("SET SQL_BIG_SELECTS=1");
$rowsorderadjust_query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=3 ORDER BY order.OrderDate desc");
$numrow_adjust = mysql_num_rows($rowsorderadjust_query);

mysql_query("SET SQL_BIG_SELECTS=1");
$rowsorderactivated_query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=10 ORDER BY order.OrderDate desc");
$numrow_activated = mysql_num_rows($rowsorderactivated_query);

mysql_query("SET SQL_BIG_SELECTS=1");
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
                                                $numrowreview2 = mysql_num_rows($rowsorder_Countreview);
												$countnum2=0;
												while ($rowordertest2 = mysql_fetch_assoc($rowsorder_Countreview)) {

                                                                $testimonial_query2 = mysql_query('select OrderId from testimonial where OrderId="' . $rowordertest2['OrderId'] . '"');
																
                                                                $numrowstest2 = mysql_num_rows($testimonial_query2);
                                                                if ($numrowstest2 == '0') {
																	$countnum2++;			
																}
												}
mysql_query("SET SQL_BIG_SELECTS=1");
$rowsorderinstallment_query = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=11 ORDER BY order.OrderDate desc");
$numrow_installment = mysql_num_rows($rowsorderinstallment_query);												
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
	.trustpilot-widget{
		float:left;
	}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="css/external.css"/>
<!-- checkout --> 
<div class="container">
    <div class="row text-center">
        <h1 class="sub-heading head_txt2">Dashboard</h1>
    </div><!-- row --> 
    <?php
    if ($_GET['err_msg'] == "testimonial_success") {
        ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Thank you for taking the time to leave a review. Reviews help us evaluate our performance and ensure that weíre always providing the best level of service to our clients. They also allow prospective clients to get an idea of what itís like to work with our firm through the experiences of our clients. Thank you again for your time, and if you have any questions, please feel free to contact us!.
        </div>
        <?php
    }
    if ($_GET['err_msg'] == "testimonial_error") {
        ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> There is an error adding review, Please try again.
        </div>
        <?php
    }
    ?>

        <div class="row no-gutter">
            <div class="col-md-3 col-sm-3">
                <nav class="pad-20">
                    <ul class="nav nav-list nav-sidebar-filter nav_lnk">
                        <?php
                        if ($_GET['tab'] == "tab_overview") {
                            ?>
                         <li class="active"><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                             <li><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
                             
                             <li><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></a></li>
							 
							 <li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							 
                            <?php
                        }
                        if ($_GET['tab'] == "tab1") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li class="active"><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                             <li><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
                              <li><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></a></li>
							  
							  <li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							  
                            <?php
                        }
                        if ($_GET['tab'] == "tab2") {
                            ?>
                            <li><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li class="active"><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                             <li><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
                             <li><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
							 
							 <li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							 
                            <?php
                        }
                        if ($_GET['tab'] == "tab3") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li class="active"><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                             <li><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
                             <li><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></a></li>
							 
							 <li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							 
                            <?php
                        }
                        if (($_GET['tab'] == 'tab5') || ($_GET['tab'] == 'tab6') || ($_GET['tab'] == 'tab4')) {
                            ?>
                            <li><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3" data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1" data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>
                            <li class="active"><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                             <li><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
                             <li><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></a></li>
							 
							 <li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							 
                            <?php
                        }
                        if (!$_GET['tab']) {
                            ?>
                            <li class="active"><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li ><a href="#tab3" data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li ><a href="#tab1" data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>
                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                            <li><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></a></li>
                            <li><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock <?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></a></li>
							
							<li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							
                            <?php
                        }
						if ($_GET['tab'] == "tab7") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                            <li class="active"><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></li>
                            
                            <li class="active"><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock<?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></li>
							
							<li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							
                            <?php
                        }
						
						if ($_GET['tab'] == "tab8") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                            <li class="active"><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></li>
                            
                            <li class="active"><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock<?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></li>
							
							<li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
							
                            <?php
                        }
						
							if ($_GET['tab'] == "tab9") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                             <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>Reviews <?php if($countnum2>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum2?>)</span> <?php }else{ ?> (<?=$countnum2?>) <?php } ?></a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages <?php if($numrows_message>0){ ?> <span style="color: red;">(<?=$numrows_message?>)</span> <?php }else{ ?> (<?=$numrows_message?>) <?php } ?></a></li>
                            <li class="active"><a href="#tab7" data-toggle="tab"><i class="fa fa-key"></i>Required Action <?php if($numrow_adjust>0){ ?> <span style="color: red;">(<?=$numrow_adjust?>)</span> <?php }else{ ?> (<?=$numrow_adjust?>) <?php } ?></a></li>
                            
                            <li class="active"><a href="#tab8" data-toggle="tab"><i class="fa fa-key"></i>Activation Lock<?php if($numrow_activated>0){ ?> <span style="color: red;">(<?=$numrow_activated?>)</span> <?php }else{ ?> (<?=$numrow_activated?>) <?php } ?></a></li>
							
							<li><a href="#tab9" data-toggle="tab"><i class="fa fa-key"></i>Installment Payment <?php if($numrow_installment>0){ ?> <span style="color: red;">(<?=$numrow_installment?>)</span> <?php }else{ ?> (<?=$numrow_installment?>) <?php } ?></a></a></li>
                            <?php
                        }
                        ?>
                        <br/><br/>

                    </ul>
                </nav>
            </div>
            <div class="col-md-9 col-sm-9">
                <?php
                
                
                if ($_POST['submit']) {

                    $fname = $_POST['FirstName'];
                    $lname = $_POST['LastName'];
                    $emailaddress = $_POST['EmailAddress'];
                    $phoneno = $_POST['phoneno'];
                    $paypalemail = $_POST['PaypalEmail'];
                    $payment = $_POST['payment'];
                    $isnewsletter = $_POST['optradio'];

                    $saddress1 = $_POST['ShippingAddress1'];
                    $saddress2 = $_POST['ShippingAddress2'];
                    $scity = $_POST['city'];
                    $sstate = $_POST['state'];
                    $spostal = $_POST['ShippingPostal'];

			$newsletter;
                    if (isset($_POST['acceptNewsletter'])) {
                        $newsletter = 1;
                       // set_mailchimp_sub($newsletter,$emailaddress);
                    } else {
                        $newsletter = 0;
                       //set_mailchimp_unsub($newsletter,$emailaddress);
                    }

                    
                  /*  function set_mailchimp_sub($chk,$email)
					{ 
						// grab an API Key from http://admin.mailchimp.com/account/api/
					  	include_once( 'inc/MCAPI.class.php' );
						$api = new MCAPI('1a2e8827797f0ed884437648f8b2ecae-us11');
						
						$retval = $api->listSubscribe( "5c3f2522ee", $email, $merge_vars );
						
					} */
					
                    
                    
                    $destination_path = getcwd() . DIRECTORY_SEPARATOR;
                    $target_file = $destination_path . "/images/users/";
                    $target_file = $target_file . basename($_FILES['photo']['name']);
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    if ($_FILES["photo"]["name"] != '')
                     {
                        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
                         /*$updaterecord = mysql_query("UPDATE user SET `FirstName` = '$fname',`LastName` = '$lname' ,`Phone` = '$phoneno',`PaypalEmail` = '$paypalemail',`PaymentMethod` = '$payment',`IsNewsletter` = '$isnewsletter',`S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$baddress1' ,`B_AddressLine2` = '$baddress2' ,`B_City` = '$bcity' ,`B_State` = '$bstate' ,`B_PostalCode` = '$bpostal' ,`B_Country` = 'United States',`IsNewsletter` = $newsletter  ,`image_url` = '" . $_FILES["photo"]["name"] . "' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());*/
						$updaterecord = mysql_query("UPDATE user SET `FirstName` = '$fname',`LastName` = '$lname' ,`Phone` = '$phoneno',`PaypalEmail` = '$paypalemail',`PaymentMethod` = '$payment',`S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$baddress1' ,`B_AddressLine2` = '$baddress2' ,`B_City` = '$bcity' ,`B_State` = '$bstate' ,`B_PostalCode` = '$bpostal' ,`B_Country` = 'United States',`IsNewsletter` = $newsletter  ,`image_url` = '" . $_FILES["photo"]["name"] . "' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                       
                        if ($updaterecord) {
                            header('Location: ' . $base_url . '/dashboard.php?err_msg=updatesuccess&news='.$newsletter);
                        } else {
                            header('Location: ' . $base_url . '/dashboard.php?err_msg=updateerror');
                        }
                    } else {
                         /* $updaterecord = mysql_query("UPDATE user SET `FirstName` = '$fname',`LastName` = '$lname' ,`Phone` = '$phoneno',`PaypalEmail` = '$paypalemail',`PaymentMethod` = '$payment',`IsNewsletter` = '$isnewsletter',`S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$baddress1' ,`B_AddressLine2` = '$baddress2' ,`B_City` = '$bcity' ,`B_State` = '$bstate' ,`B_PostalCode` = '$bpostal' ,`B_Country` = 'United States',`IsNewsletter` = $newsletter WHERE id=" . $_SESSION['login_id']) or die(mysql_error());*/
                         
						 $updaterecord = mysql_query("UPDATE user SET `FirstName` = '$fname',`LastName` = '$lname' ,`Phone` = '$phoneno',`PaypalEmail` = '$paypalemail',`PaymentMethod` = '$payment',`S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$baddress1' ,`B_AddressLine2` = '$baddress2' ,`B_City` = '$bcity' ,`B_State` = '$bstate' ,`B_PostalCode` = '$bpostal' ,`B_Country` = 'United States',`IsNewsletter` = $newsletter WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                        if ($updaterecord) {
                            header('Location: ' . $base_url . '/dashboard.php?err_msg=updatesuccess&news='.$newsletter);
                        } else {
                            header('Location: ' . $base_url . '/dashboard.php?err_msg=updateerror');
                        }
                    }
                }
                
                if ($_POST['submit_address']) {

                    
                    $saddress1 = $_POST['ShippingAddress1'];
                    $saddress2 = $_POST['ShippingAddress2'];
                    $scity = $_POST['city'];
                    $sstate = $_POST['state'];
                    $spostal = $_POST['ShippingPostal'];

                    $updaterecord = mysql_query("UPDATE user SET `S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal'  WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                    if ($updaterecord) {
                        header('Location: ' . $base_url . '/dashboard.php?err_msg=updatesuccess');
                    } else {
                        header('Location: ' . $base_url . '/dashboard.php?err_msg=updateerror');
                    }
                }
                
                if ($_POST['submit_payment']) {
                    $payment = $_POST['payment'];
                    $PaypalEmail = $_POST['PaypalEmail'];
                    $updaterecord = mysql_query("UPDATE user SET `PaymentMethod` = '$payment',`PaypalEmail` = '$PaypalEmail' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                    if ($updaterecord) {
                        header('Location: ' . $base_url . '/dashboard.php?err_msg=updatesuccess');
                    } else {
                        header('Location: ' . $base_url . '/dashboard.php?err_msg=updateerror');
                    }
                }

                if ($_POST['changepassword']) {
                    $vasuser = "SELECT * FROM `user` WHERE id=" . $_SESSION['login_id'];
                    $reuser = mysql_query($vasuser);
                    $weuser = mysql_fetch_assoc($reuser);
					
					$newPassword = $_POST['NewPassword'];
					$hashedNewPassword = Bcrypt::hashPassword($newPassword);
	
                    //if ($_POST['NewPassword'] != $_POST['NewConfirmPassword']) {
                    if (!Bcrypt::checkPassword($_POST['NewConfirmPassword'], $hashedNewPassword)) {
                        ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> Your new entered password didn't match.
                        </div>
                        <?php
                        header('Location: ' . $base_url . '/dashboard?tab=tab2&status=error&type=password_mismatch');
                    //} else if (($_POST['NewPassword'] == $_POST['NewConfirmPassword']) && ($_POST['CurrentPassword'] == $weuser['Password'])) {
                    } else if (Bcrypt::checkPassword($_POST['NewConfirmPassword'], $hashedNewPassword) && Bcrypt::checkPassword($_POST['CurrentPassword'], $weuser['PasswordTmp'])) {

                        //$newpassword = $_POST['NewPassword'];

                        mysql_query("UPDATE user SET `PasswordTmp` = '" . $hashedNewPassword . "' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                        ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> User password has been updated!.
                        </div>
                        <?php
                        header('Location: ' . $base_url . '/dashboard?tab=tab2&status=success');
                    //} else if (($_POST['CurrentPassword'] != $weuser['Password'])) {
					} else if (!Bcrypt::checkPassword($_POST['CurrentPassword'], $weuser['PasswordTmp'])) {
                        ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> Your current password didn't match.
                        </div>
                        <?php
                        header('Location: ' . $base_url . '/dashboard?tab=tab2&status=error&type=current_password_wrong');
                    }
                }
                ?>

                <?php
                if ($_GET['err_msg'] == "order_delete_success") {
                    ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Your Order has been cancelled successfully.
                    </div>
                    <?php
                }
                if ($_GET['err_msg'] == "message_delete_success") {
                    ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Message has been deleted successfully.
                    </div>
                    <?php
                }
                if ($_GET['err_msg'] == "email_send_success") {
                    ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Message has been sent successfully.
                    </div>
                    <?php
                }
                if ($_GET['err_msg'] == "updatesuccess") {
                    ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> User record has been updated!.
                    </div>
                    <?php 
                }
                if ($_GET['err_msg'] == "updateerror") {
                    ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> Record not update successfully, Please try again.
                    </div>
                    <?php
                }
                if ($_GET['err_msg'] == "email_send_fail") {
                    ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Message not send, there is some error, Please try again.
                    </div>
                    <?php
                }
                ?>
                <div class="row tab-content" style="margin-bottom:60px;">
<?php
if ($_GET['tab'] == "tab1") {
    ?>
                        <div id="tab1" class="tab-pane active">  

                    <?php
                } else {
                    ?>
                            <div id="tab1" class="tab-pane">  
                    <?php
                }
                ?>
                            <form role="form" name="updateuser" action="" class="validate-form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="FirstName"><img src="<?php echo $base_url; ?>/images/f-icon2.png" alt="Icon"/>First Name *</label>
                                    <input type="text" class="form-control" name="FirstName" value="<?php echo $resultuser['FirstName'] ?>" id="FirstName" placeholder="First Name" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="LastName"><img src="<?php echo $base_url; ?>/images/f-icon2.png" alt="Icon"/>Last Name *</label>
                                    <input type="text" class="form-control" name="LastName" value="<?php echo $resultuser['LastName'] ?>" id="LastName" placeholder="Last Name" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="email"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Email Address *</label>
                                    <input type="email" class="form-control" name="EmailAddress" value="<?php echo $resultuser['EmailAddress'] ?>" id="email" placeholder="Email" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="phoneno"><img src="<?php echo $base_url; ?>/images/f-icon4.png" alt="Icon"/>Phone No *</label>
                                    <input type="text" class="form-control" name="phoneno" value="<?php echo $resultuser['Phone'] ?>" id="phoneno" placeholder="Phone No" required>
                                </div>
                                <div class="form-group">
                                    <label for="payment"><img src="<?php echo $base_url; ?>/images/f-icon5.png" alt="Icon"/>Payment</label>
                                    <select class="form-control myclass"  name="payment" id="payment">
                                        <option>Payment Method</option>
                                        <option value="1" <?php if ($resultuser['PaymentMethod'] == 1) { ?> selected="selected" <?php } ?>>Paypal</option>
                                        <option value="2" <?php if ($resultuser['PaymentMethod'] == 2) { ?> selected="selected" <?php } ?>>Check</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="paypalemail"><img src="<?php echo $base_url; ?>/images/f-icon1.png" alt="Icon"/>Paypal *</label>
                                    <input type="email" class="form-control" id="paypalemail" name="PaypalEmail" value="<?php echo $resultuser['PaypalEmail']; ?>" placeholder="Paypal Email">
                                </div> 

                                <h1 class="form-heading">SHIPPING ADDRESS</h1>

                                <div class="form-group">
                                    <label for="address"><img src="<?php echo $base_url; ?>/images/f-icon7.png" alt="Icon"/>Address 1 *</label>
                                    <input type="text" class="form-control" id="ShippingAddress1" name="ShippingAddress1" value="<?php echo $resultuser['S_AddressLine1']; ?>" placeholder="Address Line 1" required>
                                </div>
                                <div class="form-group">
                                    <label for="address"><img src="<?php echo $base_url; ?>/images/f-icon7.png" alt="Icon"/>Address 2</label>
                                    <input type="text" class="form-control" name="ShippingAddress2" value="<?php echo $resultuser['S_AddressLine2']; ?>" id="ShippingAddress2" placeholder="Address Line 2">
                                </div>
                                <div class="form-group">
                                    <label for="State"><img src="<?php echo $base_url; ?>/images/f-icon8.png" alt="Icon"/>State *</label>
                                    <select class="form-control myclass"  name="state" id="state" required>
                                        <option value="">Select State</option>
<?php
foreach ($objAllStates AS $StateDetails) {
    ?>
                                            <option 
    <?php
    if ($resultuser['S_State'] == $StateDetails->state_abbr) {
        $_SESSION['statename'] = $StateDetails->state_name;
        ?>
                                                    selected="selected" 
        <?php
    }
    ?>
                                                value="<?= $StateDetails->state_abbr ?>"><?= $StateDetails->state_name ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="City"><img src="<?php echo $base_url; ?>/images/f-icon8.png" alt="Icon"/>City *</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $resultuser['S_City']; ?>" placeholder="City" required>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode"><img src="<?php echo $base_url; ?>/images/f-icon9.png" alt="Icon"/>Zip Code *</label>
                                    <input type="text" class="form-control" id="usr" name="ShippingPostal" value="<?php echo $resultuser['S_PostalCode']; ?>" placeholder="Zip" required>
                                </div>

                                <h1 class="form-heading">NEWSLETTER</h1>
                                        <?php
                                        if ($resultuser['IsNewsletter'] == 0) {
                                            ?>
                                    <input type="checkbox" name="acceptNewsletter" value="news_agree"><p class="cb">I wish to subscribe to the Stopoint's newsletter.</p><br><br>
    <?php
} else {
    ?>
                                    <input type="checkbox" name="acceptNewsletter" value="news_agree" checked="checked"><p class="cb">I wish to subscribe to the Stopoint's newsletter.</p><br><br>
    <?php
}
?>
                                <input type="submit" name="submit" class="submit-btn">
                            </form></div><!--end tab 1-->
                                <?php
                                if ($_GET['tab'] == "tab2") {
                                    ?>
                            <div id="tab2" class="tab-pane active">  
                                    <?php
                                } else {
                                    ?>
                                <div id="tab2" class="tab-pane">  
                                    <?php
                                }
                                ?>
								<?php
								if($_GET['type']== "password_mismatch"){
								?>
								<div class="alert alert-danger">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Error!</strong> New password and Confirm password didn't match.
								</div>
								<?php
								}if($_GET['type']== "current_password_wrong"){
								?>
								<div class="alert alert-danger">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Error!</strong> Current password is wrong. Please provide correct current password.
								</div>
								<?php
								}if($_GET['status']== "success"){
								?>
								<div class="alert alert-success">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Password is changed successfully.
								</div>
								<?php
								}
								?>
                                <form role="form" name="confirmform" method="post" action="">
									
                                    <div class="form-group">
                                        <label class="pass" for="CurrentPassword"><img src="<?php echo $base_url; ?>/images/f-icon3.png" alt="Icon"/>Current Password *</label>
                                        <input type="password" name="CurrentPassword" class="form-control form-c" id="CurrentPassword" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="pass"  for="NewPassword"><img src="<?php echo $base_url; ?>/images/f-icon3.png" alt="Icon"/>New Password *</label>
                                        <input type="password" name="NewPassword" class="form-control form-c" id="NewPassword" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="pass"  for="NewConfirmPassword"><img src="<?php echo $base_url; ?>/images/f-icon3.png" alt="Icon"/>Confirm Password *</label>
                                        <input type="password" name="NewConfirmPassword" class="form-control form-c" id="NewConfirmPassword" required>
                                    </div>

                                    <input type="submit" name="changepassword" class="submit-btn" style="margin-top: 30px;" />
                                </form></div><!--end tab 2-->
                                
                                <?php
                                if ($_GET['tab'] == "tab7") {
                                    ?>
                            <div id="tab7" class="tab-pane active"> 
                           
                                    <?php
                                } else {
                                    ?>
                                <div id="tab7" class="tab-pane">  
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <span style="color:red;font-weight: bold">View the Action Required on your end to complete your device inspection and select the appropriate answer</span>
                                </div>
                                
                                    <?php
                                }
								 
                                ?>
                                
          
                                
                                
                             
                                
                              
                                
                                
<?php
//Handling accept params above. So, commenting out this code... Will be removed once we confirm this is not needed anymore...

/*if (isset($_GET['accept']) && isset($_GET['orderno'])) {
	$pqueryrelease = "SELECT * FROM `order` WHERE id = '" . $_GET['orderno'] . "'";
    $rpqueryrelease = mysql_query($pqueryrelease);
    $wpqueryrelease = mysql_fetch_assoc($rpqueryrelease);
	if($_GET['accept'] == "yes"){
		 
	if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 5 WHERE id = " . $_GET['orderno']) or die(mysql_error());	
		}
    
	}
	if($_GET['accept'] == "no"){
	if($wpqueryrelease['OrderStatus'] == 6){
	}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 4 WHERE id = " . $_GET['orderno']) or die(mysql_error());
	}
	}
}*/

$rowsorderadjust = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description,order.AdminComments as admincomments, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . "  ORDER BY order.OrderDate desc");

// loop over the rows, outputting them
while ($roworderadjust = mysql_fetch_assoc($rowsorderadjust)) {
    if($roworderadjust['OrderStatus']=='Adjusted Price')
    {
		
        ?>
        <table class="table table-striped">
                                                    <thead>
                                                        <tr class="main-label">
                                                            <th>Fedex#</th>
                                                            <th>Tracking No</th>
                                                            <th>Order Date</th>
                                                            <th>Product</th>
                                                            <th>Original Amount</th>
                                                            <th>Adjusted Amount</th>
                                                            <th>Order Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworderadjust['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworderadjust['FedexCode']; ?></a>
                                                                    <td><?php echo $roworderadjust['TrackingCode']; ?></td>
                                                                    <td><?php echo date('m/d/Y h:i:s', strtotime($roworderadjust['OrderDate'])); ?></td>
                                                                    <td><a href="#" style="color: #333333; text-decoration:none;" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars($roworderadjust['Description']); ?>"><?php echo htmlspecialchars($roworderadjust['Description']); ?></a></td>
                                                                    <td>$ <?php echo $roworderadjust['OrderAmount']; ?></td>
                                                                <?php
                                                                if ($roworderadjust['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        <td> <?php echo $roworderadjust['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <td>$ <?php echo $roworderadjust['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                }
                                                                ?> 
                                                                    <td><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworderadjust['OrderStatus']; ?>
                                                                                                                            </a></td>
                                                                    <td>

                                                                        <?php 
                                                                            if($roworderadjust['OrderStatus']=='Expired' || $roworderadjust['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                         ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworderadjust['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworderadjust['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworderadjust['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                
                                </tr>
                                   </tbody>
                                                </table>
                                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                    <p>PLEASE SELECT ONE OF THE FOLLOWING OPTIONS: </p> <br />
                                                    <!--<p>1. If you accept the adjusted Price we will release your payment &OpenCurlyDoubleQuote;<a href="dashboard?accept=yes&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; to accept the adjusted amount.</p><br />-->
													
													<p>1. If you accept the adjusted Price please &OpenCurlyDoubleQuote;<a href="dashboard?accept=yes&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; to accept the adjusted amount.</p><br />
													
<p>2. If you refuse the adjusted price, we will return the item to you free of charge &OpenCurlyDoubleQuote;<a href="dashboard?accept=no&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; to refuse the adjusted amount.</p>
                                </div> 
                                <br />
                                <h3>Admin Comment</h3>
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                    <span style="color:red;font-weight: bold"><?php echo $roworderadjust['admincomments']; ?></span>
                                </div>
        <?php
    }

}
?>


                                                 
                                
                                </div><!--end tab 7-->
                                
                                
                                
                                <?php
                                if ($_GET['tab'] == "tab8") {
                                    ?>
                            <div id="tab8" class="tab-pane active"> 
                           
                                    <?php
                                } else {
                                    ?>
                                <div id="tab8" class="tab-pane">  
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <span style="color:red;font-weight: bold">View the Activated Lock on your end to complete your device inspection and select the appropriate answer</span>
                                </div>
                                
                                    <?php
                                }
								 
                                ?>
                                
          
                                
                                
                             
                                
                              
                                
                                
<?php
//Handling activated params above. So, commenting out this code... Will be removed once we confirm this is not needed anymore...

/*if (isset($_GET['activated']) && isset($_GET['orderno'])) {
	$pqueryrelease = "SELECT * FROM `order` WHERE id = '" . $_GET['orderno'] . "'";
    $rpqueryrelease = mysql_query($pqueryrelease);
    $wpqueryrelease = mysql_fetch_assoc($rpqueryrelease);
	if($_GET['activated'] == "yes"){
		if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
    $queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 5 WHERE id = " . $_GET['orderno']) or die(mysql_error());
	}
	}
	if($_GET['activated'] == "no"){
		if($wpqueryrelease['OrderStatus'] == 6){
		
		}
	else{
	$queryaccept = mysql_query("UPDATE `order` SET `OrderStatus` = 4 WHERE id = " . $_GET['orderno']) or die(mysql_error());
	}
	}
}*/

$rowsorderadjust = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description,order.AdminComments as admincomments, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . "  ORDER BY order.OrderDate desc");

// loop over the rows, outputting them
while ($roworderadjust = mysql_fetch_assoc($rowsorderadjust)) {
    if($roworderadjust['OrderStatus']=='Activation Lock')
    {
		
        ?>
        <table class="table table-striped">
                                                    <thead>
                                                        <tr class="main-label">
                                                            <th>Fedex#</th>
                                                            <th>Tracking No</th>
                                                            <th>Order Date</th>
                                                            <th>Product</th>
                                                            <th>Original Amount</th>
                                                            <th>Adjusted Amount</th>
                                                            <th>Order Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworderadjust['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworderadjust['FedexCode']; ?></a>
                                                                    <td><?php echo $roworderadjust['TrackingCode']; ?></td>
                                                                    <td><?php echo date('m/d/Y h:i:s', strtotime($roworderadjust['OrderDate'])); ?></td>
                                                                    <td><a href="#" style="color: #333333; text-decoration:none;" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars($roworderadjust['Description']); ?>"><?php echo htmlspecialchars($roworderadjust['Description']); ?></a></td>
                                                                    <td>$ <?php echo $roworderadjust['OrderAmount']; ?></td>
                                                                <?php
                                                                if ($roworderadjust['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        <td> <?php echo $roworderadjust['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <td>$ <?php echo $roworderadjust['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                }
                                                                ?> 
                                                                    <td><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworderadjust['OrderStatus']; ?>
                                                                                                                            </a></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($roworderadjust['OrderStatus']=='Expired' || $roworderadjust['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                         ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworderadjust['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworderadjust['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworderadjust['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                
                                </tr>
                                   </tbody>
                                                </table>
                                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                <p>
                                                Unfortunately, Stopoint is unable to accept devices which are iCloud Activation Locked through iOS 7 or later. Luckily, if the device is yours and itís currently iCloud Activation Locked, we can show you how to remove it in under one minute. To do so, please follow the simple instructions below:
</p>
<p>Product Serial: <?php if($roworderadjust['ProductSerial'] == ""){ echo 'N/A';} else{ echo $roworderadjust['ProductSerial']; } ?> 

                                                </p>
                                                
                                                <p>
                                                If you have forgotten your Apple ID username or password, please <a href="https://idmsa.apple.com/IDMSWebAuth/login?appIdKey=abccc6a7290f30f860b1f1bf4fe81c948a6641fbdacf6238b83b7379065fe0ba" target="_blank">"CLICK HERE"</a> to learn how to retrieve them.</p>
                                                <p>
To check if your device is clear of Activation Lock, please <a href="https://www.icloud.com/activationlock/" target="_blank">"CLICK HERE"</a> <br />
Once your device is no longer iCloud locked, we are more than happy to purchase your device from you!
                                                </p><br />
                                                <p>SELECT ONE OF THE FOLLOWING OPTIONS: </p>
                                                    <p>1. If you removed iCloud lock for your device you sent to Stopoint , please &OpenCurlyDoubleQuote;<a href="dashboard?activated=yes&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; to complete.</p> <br />
<p>2. If you are unable to remove the iCloud lock, Stopoint does not accept iCloud lock. Please &OpenCurlyDoubleQuote;<a href="dashboard?activated=no&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; to return device back to you.</p><br />
                                </div> 
                                <br />
                                <h3>Admin Comment</h3>
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                    <span style="color:red;font-weight: bold"><?php echo $roworderadjust['admincomments']; ?></span>
                                </div>
        <?php
    }

}
?>


                                                 
                                
                                </div><!--end tab 8-->
								
<?php
                                if ($_GET['tab'] == "tab9") {
                                    ?>
                            <div id="tab9" class="tab-pane active"> 
                           
                                    <?php
                                } else {
                                    ?>
                                <div id="tab9" class="tab-pane">  
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <span style="color:red;font-weight: bold">View the Installment Payment on your end to complete your device inspection and select the appropriate answer</span>
                                </div>
                                
                                    <?php
                                }
								 
                                ?>
<?php								
$rowsorderadjust = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description,order.AdminComments as admincomments, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . "  ORDER BY order.OrderDate desc");

// loop over the rows, outputting them
while ($roworderadjust = mysql_fetch_assoc($rowsorderadjust)) {
    if($roworderadjust['OrderStatus']=='Installment Payment')
    {
		
        ?>
        <table class="table table-striped">
                                                    <thead>
                                                        <tr class="main-label">
                                                            <th>Fedex#</th>
                                                            <th>Tracking No</th>
                                                            <th>Order Date</th>
                                                            <th>Product</th>
                                                            <th>Original Amount</th>
                                                            <th>Adjusted Amount</th>
                                                            <th>Order Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworderadjust['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworderadjust['FedexCode']; ?></a>
                                                                    <td><?php echo $roworderadjust['TrackingCode']; ?></td>
                                                                    <td><?php echo date('m/d/Y h:i:s', strtotime($roworderadjust['OrderDate'])); ?></td>
                                                                    <td><a href="#" style="color: #333333; text-decoration:none;" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars($roworderadjust['Description']); ?>"><?php echo htmlspecialchars($roworderadjust['Description']); ?></a></td>
                                                                    <td>$ <?php echo $roworderadjust['OrderAmount']; ?></td>
                                                                <?php
                                                                if ($roworderadjust['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        <td> <?php echo $roworderadjust['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <td>$ <?php echo $roworderadjust['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                }
                                                                ?> 
                                                                    <td><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworderadjust['OrderStatus']; ?>
                                                                                                                            </a></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($roworderadjust['OrderStatus']=='Expired' || $roworderadjust['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                         ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworderadjust['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworderadjust['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworderadjust['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworderadjust['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                
                                </tr>
                                   </tbody>
                                                </table>
                                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                
                                                
                                                <p>This device can not be processed because all of the installment payments have not been paid in full. It will be returned back to you in 5 days if you don't select any options.</p>
												<p>Please choose the following:</p>
                                                <br />
                                                <p>SELECT ONE OF THE FOLLOWING OPTIONS: </p>
                                                    <p>1. If you paid your installment payment , please &OpenCurlyDoubleQuote;<a href="dashboard?installment=yes&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; .</p> <br />																										
													
<p>2. If you are unable to pay your installment payment. Please &OpenCurlyDoubleQuote;<a href="dashboard?installment=no&orderno=<?php echo $roworderadjust['OrderId']; ?>">CLICK HERE</a>&CloseCurlyDoubleQuote; .</p><br />
													
                                </div> 
                                <br />
                                <h3>Admin Comment</h3>
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                    <span style="color:red;font-weight: bold"><?php echo $roworderadjust['admincomments']; ?></span>
                                </div>
        <?php
    }

}
?>


                                                 
                                
                                </div><!--end tab 9-->																
								
<?php
if ($_GET['tab'] == "tab3") {
    ?>
                                <div id="tab3" class="tab-pane active">  
    <?php
} else {
    ?>
                                        <div id="tab3" class="tab-pane">  
    <?php
}
?>
                                            <?php 
                                                $rowsorder_Count = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode,order.Returnlabel as Returnlabel, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
												 
                                                $numrow = mysql_num_rows($rowsorder_Count);
												$countnum=0;
												while ($rowordertest1 = mysql_fetch_assoc($rowsorder_Count)) {

                                                                $testimonial_query1 = mysql_query('select OrderId from testimonial where OrderId="' . $rowordertest1['OrderId'] . '"');
																
                                                                $numrowstest1 = mysql_num_rows($testimonial_query1);
                                                                if ($numrowstest1 == '0') {
																	$countnum++;			
																}
												}
                                            ?>
                                        <ul id="tabList" role="tablist" class="nav nav-tabs">
                                            <li <?php if (!isset($_GET['msg'])) { ?> class="active" <?php } ?> role="presentation">
                                                <a data-toggle="tab" role="tab" aria-controls="pending" href="#pending">Pending Orders</a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a data-toggle="tab" role="tab" aria-controls="completed" href="#completed">Completed Orders</a>
                                            </li>
                                            <li <?php if (isset($_GET['msg']) == 'testimonials') { ?> class="active" <?php } ?> role="presentation" class="">
                                                <a data-toggle="tab" role="tab" aria-controls="completed" href="#Testimonials">Review <?php if($countnum>0){ ?> <span class="review-count" style="color: red;">(<?=$countnum?>)</span> <?php }else{ ?> (<?=$countnum?>) <?php } ?></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">

                                            <div id="pending" class="tab-pane <?php if (!isset($_GET['msg'])) { ?> active <?php } ?>" role="tabpanel">
                                                <table class="table table-striped hidden-xs">
                                                    <thead>
                                                        <tr class="main-label">
                                                            <th>Fedex#</th>
                                                            <th>Tracking No</th>
                                                            <th style="width: 80px">Return No</th>
                                                            <th>Order Date</th>
                                                            <th>Product</th>
                                                            <th>Original Amount</th>
                                                            <th>Adjusted Amount</th>
                                                            <th>Order Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
if (isset($_GET['order_delete'])) {

    $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = " . $_GET['order_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab3&err_msg=order_delete_success');
}

$rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode,order.Returnlabel as Returnlabel, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($roworder = mysql_fetch_assoc($rowsorder)) {
    if($roworder['OrderStatus']!='Paid' && $roworder['OrderStatus']!='Return Completed')
    {
        ?>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a>
                                                                    <td><?php echo $roworder['TrackingCode']; ?></td>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['Returnlabel']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['Returnlabel']; ?></a></td>
                                                                    <td><?php echo date('m/d/Y h:i:s', strtotime($roworder['OrderDate'])); ?></td>
                                                                    <td><a href="#" style="color: #333333; text-decoration:none;" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars($roworder['Description']); ?>"><?php echo htmlspecialchars($roworder['Description']); ?></a></td>
                                                                    <td>$ <?php echo $roworder['OrderAmount']; ?></td>
                                                                <?php
                                                                if ($roworder['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        <td> <?php echo $roworder['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <td>$ <?php echo $roworder['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                }
                                                                ?> 
                                                                    <td><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworder['OrderStatus']; ?>
                                                                                                                            </a></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($roworder['OrderStatus']=='Expired' || $roworder['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                        ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworder['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworder['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworder['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                </tr>
        <?php
    }
}
?>


                                                    </tbody>
                                                </table>
                                                <div class="dashboard">
                                                <div class="col-sm-12 visible-xs">
                                                	<?php
if (isset($_GET['order_delete'])) {

    $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = " . $_GET['order_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab3&err_msg=order_delete_success');
}

$rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($roworder = mysql_fetch_assoc($rowsorder)) {
    if($roworder['OrderStatus']!='Paid' && $roworder['OrderStatus']!='Return Completed')
    {
        ?>
        
        <div class="col-sm-12 visible-xs no_pad" style="border-bottom: 3px solid #84BC41;">
                                                	<div class="full_tabil">
                                                		<div class="tbl_hed">
	                                                		
	                                                		<div class="tbl_hed_in">
	                                                			Fedex <br /> Tracking Id
	                                                		</div>
	                                                		<div class="tbl_hed_in">
	                                                			Tracking <br /> No
	                                                		</div>
	                                                		<div class="tbl_hed_in">
	                                                			Order <br /> Date
	                                                		</div>
	                                                		<div class="tbl_hed_in">
	                                                			Product
	                                                		</div>
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		
	                                                		<div class="tbl_body_box tbl_body_box_break"><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a></div>
	                                                		<div class="tbl_body_box"><?php echo $roworder['TrackingCode']; ?></div>
	                                                		<div class="tbl_body_box"><?php echo date('m/d/Y h:i:s', strtotime($roworder['OrderDate'])); ?></div>
	                                                		<div class="tbl_body_box"><?php echo htmlspecialchars($roworder['Description']); ?></div>
	                                                	</div>
                                                	</div>
                                                	
                                                	<div class="full_tabil">
	                                                	<div class="tbl_hed">
	                                                		<div class="tbl_hed_in">
	                                                			Original <br /> Amount
	                                                		</div>
	                                                		<div class="tbl_hed_in">
	                                                			Adjusted <br /> Amount
	                                                		</div>
	                                                		<div class="tbl_hed_in">
	                                                			Order <br /> Status
	                                                		</div>
	                                                		<div class="tbl_hed_in">
	                                                			Actions
	                                                		</div>
	                                                		
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		<div class="tbl_body_box">$ <?php echo $roworder['OrderAmount']; ?></div>
	                                                		<div class="tbl_body_box"><?php
                                                                if ($roworder['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        &nbsp;
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        $ <?php echo $roworder['AdjustedAmount']; ?>
                                                                    <?php
                                                                }
                                                                ?> </div>
	                                                		<div class="tbl_body_box"><a href="#"  data-target="#itemglossary" data-toggle="modal">
          <?php echo $roworder['OrderStatus']; ?>
                </a></div>
	                                                		<div class="tbl_body_box"><?php 
                                                                            if($roworder['OrderStatus']=='Expired' || $roworder['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                        ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworder['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworder['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworder['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?></div>
	                                                		
	                                                	</div>
	                                                </div>
                                                	
                                                </div>
                                                
                                               <?php } 
                                               }
                                               ?>
                                                  </div>
                                                  </div>
                                            </div>

                                            <div id="completed" class="tab-pane" role="tabpanel">
                                                <table class="table table-striped hidden-xs">
                                                    <thead>
                                                        <tr class="main-label">
                                                            <th>Fedex#</th>
                                                            <th>Tracking No</th>
                                                            <th>Return No</th>
                                                            <th>Order Date</th>
                                                            <th>Product</th>
                                                            <th>Original Amount</th>
                                                            <th>Adjusted Amount</th>
                                                            <th>Order Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
if (isset($_GET['order_delete'])) {

    $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = " . $_GET['order_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab3&err_msg=order_delete_success');
}
$rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.Returnlabel as Returnlabel, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($roworder = mysql_fetch_assoc($rowsorder)) {
    if ($roworder['OrderStatus'] == 'Paid' || $roworder['OrderStatus'] == 'Return Completed') {
        ?>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a>
                                                                    <td><?php echo $roworder['TrackingCode']; ?></td>
                                                                     <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['Returnlabel']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['Returnlabel']; ?></a></td>
                                                                    <td><?php echo date('m/d/Y h:i:s', strtotime($roworder['OrderDate'])); ?></td>
                                                                    <td><a href="#" style="color: #333333; text-decoration:none;" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars($roworder['Description']); ?>"><?php echo htmlspecialchars($roworder['Description']); ?></a></td>
                                                                    <td>$ <?php echo $roworder['OrderAmount']; ?></td>
                                                                <?php
                                                                if ($roworder['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        <td> <?php echo $roworder['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <td>$ <?php echo $roworder['AdjustedAmount']; ?></td>
                                                                    <?php
                                                                }
                                                                ?> 
                                                                   <td><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworder['OrderStatus']; ?>
                                                                                                                            </a></td>

                                                              <td><a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send">View Order Details</a></td>
                                                                </tr>
        <?php
    }
}
?>


                                                    </tbody>
                                                </table>
                                                
                                                <div class="dashboard">
                                                <div class="col-sm-12 visible-xs">
                                                	
<?php
if (isset($_GET['order_delete'])) {

    $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = " . $_GET['order_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab3&err_msg=order_delete_success');
}
$rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode,order.Returnlabel as Returnlabel,order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($roworder = mysql_fetch_assoc($rowsorder)) {
    if ($roworder['OrderStatus'] == 'Paid' || $roworder['OrderStatus'] == 'Return Completed') {
        ?>                                                	
                                                	
                                                	
                                                	
                                                <div class="col-sm-12 visible-xs no_pad" style="border-bottom: 3px solid #84BC41;">
                                                	<div class="full_tabil">
                                                		<div class="tbl_hed">
	                                                		 
	                                                		<div class="tbl_hed_in2">
	                                                			Fedex <br /> Tracking Id
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Tracking <br /> No
	                                                		</div>
                                                            <div class="tbl_hed_in2">
	                                                			Return <br /> No
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Order <br /> Date
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Product
	                                                		</div>
	                                                	</div> 
	                                                	<div class="tbl_body">
	                                                		<div class="tbl_body_box2 tbl_body_box_break"><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a></div>
	                                                		<div class="tbl_body_box2"><?php echo $roworder['TrackingCode']; ?></div>
                                                            <div class="tbl_body_box2"><?php 
															if($roworder['Returnlabel'] == ''){
																?>
                                                                &nbsp;
                                                                <?php
																}
															else{
																?>
                                                            <a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['Returnlabel']; ?> 
                                                                           "target="['_blank']">
                                                                <?php
															echo $roworder['Returnlabel'];
															?>
                                                            </a>
                                                            <?php	
																}
															 ?></div>
	                                                		<div class="tbl_body_box2"><?php echo date('m/d/Y h:i:s', strtotime($roworder['OrderDate'])); ?></div>
	                                                		<div class="tbl_body_box2"><?php echo htmlspecialchars($roworder['Description']); ?></div>
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
	                                                			Actions
	                                                		</div>
	                                                		
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		<div class="tbl_body_box2">$ <?php echo $roworder['OrderAmount']; ?></div>
	                                                		<div class="tbl_body_box2"><?php
                                                                if ($roworder['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        &nbsp;
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        $ <?php echo $roworder['AdjustedAmount']; ?>
                                                                    <?php
                                                                }
                                                                ?> </div>
	                                                		<div class="tbl_body_box2"><a href="#"  data-target="#itemglossary" data-toggle="modal">
       <?php echo $roworder['OrderStatus']; ?></a>
                                                           </div>
	                                                		<div class="tbl_body_box2"><?php 
                                                                            if($roworder['OrderStatus']=='Expired' || $roworder['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                        ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworder['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworder['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworder['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?></div>
	                                                		
	                                                	</div>
	                                                </div>
                                                	
                                                </div>
                                                
<?php }

} ?>                                                
                                                
                                                
                                                  </div>
                                                  
                                                  </div>
                                            </div>

                                            <div id="Testimonials" class="tab-pane <?php if (isset($_GET['msg']) == 'testimonials') { ?> active <?php } ?>" role="tabpanel">
                                                <div class="row pad" style="margin-bottom:70px;">
                                                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" onmouseover="stopReview()">

                                                            <?php
                                                           
                                                           
                                                            $rowsordertest = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                            CASE order.OrderStatus
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
                                                           FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
                                                           // loop over the rows, outputting them
                                                            while ($rowordertest = mysql_fetch_assoc($rowsordertest)) {

                                                                $testimonial_query = mysql_query('select OrderId from testimonial where OrderId="' . $rowordertest['OrderId'] . '"');
									
                                                                $numrowstest = mysql_num_rows($testimonial_query);
                                                               
                                                                if ($numrowstest == '0') {
                                                                    if ($rowordertest['OrderStatus'] == 'Paid') {
                                                                        ?>	
<input type="hidden" id="review_done" value="1" />
																		<br>																		
                                                                    <!-- TrustBox widget -->

<div class="trustpilot-widget" data-locale="en-US" data-template-id="56278e9abfbbba0bdcd568bc" data-businessunit-id="566208860000ff0005865012" data-style-height="70px" data-style-width="100%">
  <a href="https://www.trustpilot.com/review/stopoint.com" target="_blank">Trustpilot</a>
</div>

<!-- End TrustBox widget -->
                                                                    <?php
																		
																	
							
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
<?php
if (($_GET['tab'] == 'tab5') || ($_GET['tab'] == 'tab6') || ($_GET['tab'] == 'tab4')) {
    ?>
                                        <div id="tab4" class="tab-pane active">  
    <?php
} else {
    ?>
                                            <div id="tab4" class="tab-pane">  
                                                            <?php
                                                        }
                                                        ?>
                                            <ul class=" mail-box tabs">
                                                        <?php
                                                        if ($_GET['tab'] == 'tab5') {
                                                            ?>
                                                    <li class="active"><a href="#tab5" data-toggle="tab"><img src="<?php echo $base_url; ?>/images/inbox.png" alt="Icon"/> Inbox</a></li>
                                                    <li><a href="#tab6" data-toggle="tab"><img src="<?php echo $base_url; ?>/images/send.png" alt="Icon"/>Send Items</a></li>
    <?php
} elseif ($_GET['tab'] == 'tab6') {
    ?>
                                                    <li><a href="#tab5" data-toggle="tab"><img src="<?php echo $base_url; ?>/images/inbox.png" alt="Icon"/> Inbox</a></li>
                                                    <li class="active"><a href="#tab6" data-toggle="tab"><img src="<?php echo $base_url; ?>/images/send.png" alt="Icon"/>Send Items</a></li>
                                        <?php
                                    } else {
                                        ?>
                                                    <li class="active"><a href="#tab5" data-toggle="tab"><img src="<?php echo $base_url; ?>/images/inbox.png" alt="Icon"/> Inbox</a></li>
                                                    <li><a href="#tab6" data-toggle="tab"><img src="<?php echo $base_url; ?>/images/send.png" alt="Icon"/>Sent Items</a></li>
                                                <?php
                                            }
                                            ?>
                                            </ul>
                                            <div class="row tab-content">
                                                <?php
                                                if ($_GET['tab'] == 'tab6') {
                                                    ?>
                                                    <div id="tab5" class="tab-pane">
                                                    <?php
                                                } else {
                                                    ?>
                                                        <div id="tab5" class="tab-pane active">  
                                                    <?php
                                                }
                                                ?>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr class="main-label">
                                                                    <th>Subject</th>
                                                                    <th>Date</th>
                                                                    <th>Tracking No</th>
                                                                    <th>Is Read</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                <?php
                                                if (isset($_GET['inbox_delete'])) {

                                                    $query = mysql_query("DELETE FROM `messages` WHERE id = " . $_GET['inbox_delete']) or die(mysql_error());
                                                    header('Location: ' . $base_url . '/dashboard?tab=tab5&err_msg=message_delete_success');
                                                }

                                                $vasmessage = "SELECT * from messages WHERE ToId = " . $_SESSION['login_id'] . " and FromId != " . $_SESSION['login_id'] . " ORDER BY id DESC";
                                                $remessage = mysql_query($vasmessage);
                                                //$wemessage=mysql_fetch_assoc($remessage);
                                                ?>

<?php
while ($wemessage1 = mysql_fetch_array($remessage)) {
    $track_query = mysql_query('select * from `order` where id="'.$wemessage1['OrderId'].'"');
    $row_fetch = mysql_fetch_array($track_query);
    ?>
                                                                    <tr>
                                                                        <td>
    <?php
    if ($wemessage1['Subject'] != "") {
        echo $wemessage1['Subject'];
    } else {
        $subject = "SELECT * FROM `messages` WHERE id = " . $wemessage1['parentid'];
        $resubject = mysql_query($subject);
        $wesubject = mysql_fetch_assoc($resubject);
        echo "RE: " . $wesubject['Subject'];
    }
    ?></td>
                                                                        <td><?php echo date('m/d/Y', strtotime($wemessage1['Date'])); ?></td>
                                                                        <td><?php echo $row_fetch['TrackingCode']; ?></td>
                                                                        <td>
                                                                          <?php 
                                                                            if($wemessage1['IsRead']=='1')
                                                                            {
                                                                                echo 'Read';
                                                                            }else{
                                                                                echo 'Unread';
                                                                            }
                                                                          ?>  
                                                                        </td>
                                                                        <td><a href="<?php echo $base_url; ?>/messages_edit.php?id=<?= $wemessage1['id'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a><a href="<?php echo $base_url; ?>/dashboard.php?inbox_delete=<?= $wemessage1['id'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon5.png" title="Delete"  alt="Icon"/></a></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>


                                                            </tbody>
                                                        </table>

                                                    </div><!-- tqb 5 end -->
                                                                        <?php
                                                                        if ($_GET['tab'] == 'tab6') {
                                                                            ?>
                                                        <div id="tab6" class="tab-pane active">  
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                            <div id="tab6" class="tab-pane">  
                                                                            <?php
                                                                        }
                                                                        ?>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr class="main-label">
                                                                        <th>Subject</th>
                                                                        <th>Date</th>
                                                                        <th>Tracking No</th>
                                                                        <th>Is Read</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
<?php
if (isset($_GET['sent_delete'])) {

    $query = mysql_query("DELETE FROM `messages` WHERE id = " . $_GET['sent_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab6&err_msg=message_delete_success');
}

$vasmessagesent = "SELECT messages.id as id,messages.Subject as Subject,messages.OrderId as OrderId,messages.Comments as Comments,messages.Date as Date, user.id as userid FROM `messages` INNER JOIN user on messages.FromId = user.id INNER JOIN `order` on messages.OrderId = order.id WHERE messages.FromId = " . $_SESSION['login_id'] . " ORDER BY id DESC";
$remessagesent = mysql_query($vasmessagesent);
//$wemessage=mysql_fetch_assoc($remessage);
?>

                                                            <?php
                                                            while ($wemessagesent = mysql_fetch_array($remessagesent)) {
                                                                $track_query = mysql_query('select * from `order` where id="'.$wemessagesent['OrderId'].'"');
                                                                $row_fetch = mysql_fetch_array($track_query);
                                                                ?>
                                                                        <tr>
                                                                            <td>
    <?php
    if ($wemessagesent['Subject'] != "") {
        echo $wemessagesent['Subject'];
    } else {
        echo "No Subject";
    }
    ?></td>
                                                                            <td><?php echo date('m/d/Y', strtotime($wemessagesent['Date'])); ?></td>
                                                                            <td><?php echo $row_fetch['TrackingCode']; ?></td>
                                                                            <td>
                                                                          <?php 
                                                                            if($wemessage1['IsRead']=='1')
                                                                            {
                                                                                echo 'Read';
                                                                            }else{
                                                                                echo 'Unread';
                                                                            }
                                                                          ?>  
                                                                        </td>
                                                                            <td><a href="<?php echo $base_url; ?>/messages_edit.php?sent=sent&id=<?= $wemessagesent['id'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a><a href="<?php echo $base_url; ?>/dashboard.php?sent_delete=<?= $wemessagesent['id'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon5.png" title="Delete"  alt="Icon"/></a></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>  
                                                </div> 
                                                <?php 
                                                    $queryall_Sett = "SELECT * from setting_msg WHERE id = '1'";
                                                    $resultall_sett = mysql_query($queryall_Sett);
                                                    $resultuser_Set = mysql_fetch_array($resultall_sett);
                                                    
                                                    $queryall_sum = mysql_query("SELECT OrderAmount,AdjustedAmount FROM `order` where UserId='" . $_SESSION['login_id'] . "' and OrderStatus='6'");
                                                    while ($num = mysql_fetch_assoc ($queryall_sum)) {
                                                        if($num['AdjustedAmount']!='')
                                                        {
                                                            $qty += $num['AdjustedAmount'];   
                                                        }else{
                                                            $qty += $num['OrderAmount'];
                                                        }
                                                    }
                                                    
                                                    if($qty=='')
                                                    {
                                                        $total = '0';
                                                    }else{
                                                        $total = $qty;
                                                    }
                                                ?>
                                                <?php
                                                if (!$_GET['tab'] || $_GET['tab']=='tab_overview') {
    ?>
                                    
                                         <div id="tab_overview" class="tab-pane active">
    <?php
}else{ 
?>
                                              <div id="tab_overview" class="tab-pane">
                                                 <?php 
}
                                                 ?>
                                               
                                                    <div class="row no-gutter">
                                                        <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                                                        <?php 
                                                            if($numrow_adjust>0){
                                                        ?>
                                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                             <p> <span style="color:red;font-weight: bold"> ACTION IS REQUIRED FOR YOUR ORDER. PLEASE <a data-toggle="tab" href="#tab7" aria-expanded="true">CLICK HERE</a> TO RESOLVE.</span></p>
            </div>            
                                

 <div id="tab_overview" class="tab-pane">
                                                 <?php 
}
 ?>
 
 
 <?php 
                                                            if($numrow_activated>0){
                                                        ?>
                                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                             <p> <span style="color:red;font-weight: bold"> ACTION IS REQUIRED FOR YOUR ORDER. PLEASE <a data-toggle="tab" href="#tab8" aria-expanded="true">CLICK HERE</a> TO RESOLVE.</span></p>
            </div>            
                                

 <div id="tab_overview" class="tab-pane">
                                                 <?php 
}

															if($numrow_installment>0){
                                                        ?>
                                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                             <p> <span style="color:red;font-weight: bold"> ACTION IS REQUIRED FOR YOUR ORDER. PLEASE <a data-toggle="tab" href="#tab9" aria-expanded="true">CLICK HERE</a> TO RESOLVE.</span></p>
            </div>            
                                

 <div id="tab_overview" class="tab-pane">
                                                 <?php 
}
 ?>
                                               
                                                    <div class="row no-gutter">
                                                        <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                                                        <?php 
                                                        if($numrows_message>0){
                                                        ?>
                                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                             <p> <span style="color:red;font-weight: bold"> YOU HAVE A NEW MESSAGE. PLEASE <a data-toggle="tab" href="#tab4" aria-expanded="true">CLICK HERE</a> TO ANSWER.</span></p>
</div>
 <div id="tab_overview" class="tab-pane">
                                                 <?php 
}
 ?>
                                               
                                                    <div class="row no-gutter">
                                                        <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                                                        <?php 
                                                        if($countnum2>0){
                                                        ?>
                                                        <div class="alert alert-danger alert-dismissible fade in" role="alert" id="review-alert">
                                                             <p> <span style="color:red;font-weight: bold"> PLEASE CLICK ON "REVIEWS" TAB ON THE LEFT TO LEAVE A REVIEW FOR YOUR PREVIOUS ORDER(S). THANK YOU.</span></p>

</div>

</div>
                                                        <?php 
                                                            }
                                                        ?>
                                                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                           <?php
                                                           if($resultuser_Set['text_content']!='')
                                                           {
                                                           ?>
                                                            <h6><span style="color:red;font-weight: bold">PLEASE NOTE: </span><br><?=$resultuser_Set['text_content']?></h6>
                                                            <?php
                                                            
                                                           }?>
                                                        </div>
                                                        

                                                        <div class="col-md-6 col-sm-6">
                                                            <h1><?php echo $resultuser['FirstName'] ?>&nbsp;<?php echo $resultuser['LastName'] ?></h1>
                                                            <a class="bluelink" data-toggle="tab" href="#tab1">
                                                                <i class="fa fa-pencil"></i> Edit Profile
                                                            </a>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <h1>Paid to Date</h1>
                                                            <div class="paid">$<?=$total?></div>
                                                        </div>
                                                    </div>
                                                    <br/><br/>
                                                    <hr class="clearfix">
                                                    <br/><br/>

                                                    <div class="dashboard">
                                                        <div class="row no-gutter">
                                                            <div class="col-md-4 col-sm-4">
                                                                <h3>Shipping Address</h3>
                                                                <p><?php echo $resultuser['S_AddressLine1']; ?>
<?php echo $resultuser['S_AddressLine2']; ?>&nbsp;
                                                                    <br><?php echo $resultuser['S_City']; ?>&nbsp;<?= $_SESSION['statename'] ?>
                                                                    <br><?php echo $resultuser['S_PostalCode']; ?>&nbsp;US
                                                                    <br>
                                                                    <br>
                                                                    <a data-target="#shipping_modal_window" data-toggle="modal" href="#">
                                                                        <i class="fa fa-plus"></i>Edit a shipping address
                                                                    </a>
                                                                    <!-- Modal Add payment Info -->
                                                                </p>
                                                                <div aria-hidden="true" aria-labelledby="shipping_modal_window" role="dialog" tabindex="-1" id="shipping_modal_window" class="modal fade">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                                                                                    <i class="fa fa-close"></i>
                                                                                </button>
                                                                                <h4 id="myModalLabel" class="modal-title">Edit Address</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="payment-login">
                                                                                    <div class="payment-area">
                                                                                        <div class="row">
                                                                                            <form class="validate-form" method="post" action="">
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="address"><img src="<?php echo $base_url; ?>/images/f-icon7.png" alt="Icon"/>Address 1 *</label>
                                                                                                    <input type="text" class="form-control" id="ShippingAddress1" name="ShippingAddress1" value="<?php echo $resultuser['S_AddressLine1']; ?>" placeholder="Address Line 1" required>
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="address"><img src="<?php echo $base_url; ?>/images/f-icon7.png" alt="Icon"/>Address 2</label>
                                                                                                    <input type="text" class="form-control" name="ShippingAddress2" value="<?php echo $resultuser['S_AddressLine2']; ?>" id="ShippingAddress2" placeholder="Address Line 2">
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="State"><img src="<?php echo $base_url; ?>/images/f-icon8.png" alt="Icon"/>State *</label>
                                                                                                    <select class="form-control myclass"  name="state" id="state" required>
                                                                                                        <option value="">Select State</option>
                                                                                                    <?php
                                                                                                    foreach ($objAllStates AS $StateDetails) {
                                                                                                        ?>
                                                                                                            <option 
                                                                                                            <?php
                                                                                                            if ($resultuser['S_State'] == $StateDetails->state_abbr) {
                                                                                                                $_SESSION['statename'] = $StateDetails->state_name;
                                                                                                                ?>
                                                                                                                    selected="selected" 
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                                value="<?= $StateDetails->state_abbr ?>"><?= $StateDetails->state_name ?>
                                                                                                            </option>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="City"><img src="<?php echo $base_url; ?>/images/f-icon8.png" alt="Icon"/>City *</label>
                                                                                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $resultuser['S_City']; ?>" placeholder="City" required>
                                                                                                </div>
                                                                                                <div class="form-group col-md-12">
                                                                                                    <label for="zipcode"><img src="<?php echo $base_url; ?>/images/f-icon9.png" alt="Icon"/>Zip Code *</label>
                                                                                                    <input type="text" class="form-control" id="usr" name="ShippingPostal" value="<?php echo $resultuser['S_PostalCode']; ?>" placeholder="Zip" required>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                <input type="submit" name="submit_address" class="submit-btn" value="Update Address">
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <p></p>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <h3>Payment Method</h3>
                                                                <p><?php if ($resultuser['PaymentMethod'] == 1) { ?>PayPal<?php } else if ($resultuser['PaymentMethod'] == 2) { ?>Check<?php } ?>
                                                                    <br>
                                                                    <a data-target="#paymentedit" data-toggle="modal" href="#">
                                                                        <i class="fa fa-plus"></i>Edit a payment method
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            <div aria-hidden="true" aria-labelledby="paymentedit" role="dialog" tabindex="-1" id="paymentedit" class="modal fade" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                                                                                <i class="fa fa-close"></i>
                                                                            </button>
                                                                            <h4 id="myModalLabel" class="modal-title">Payment Information</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <header class="section-header"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
                                                                                <h2 class="payment-sub-header">Choose How You Want To Be Paid</h2>
                                                                                <p>We'll send your payment within 2 business days after your item has been inspected and send you an email to confirm payment has been sent</p>
                                                                            </header>
                                                                            <form class="validate-form" method="post" action="">
                                                                            <div class="form-group">
                                                                                    <label for="payment"><img src="<?php echo $base_url; ?>/images/f-icon5.png" alt="Icon"/>Payment</label>
                                                                                    <select class="form-control myclass"  name="payment" id="paymentpop">
                                                                                        <option>Payment Method</option>
                                                                                        <option value="1" <?php if ($resultuser['PaymentMethod'] == 1) { ?> selected="selected" <?php } ?>>Paypal</option>
                                                                                        <option value="2" <?php if ($resultuser['PaymentMethod'] == 2) { ?> selected="selected" <?php } ?>>Check</option>

                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group paypalemail" <?php if($resultuser['PaymentMethod']!='1'){ ?> style="display: none;" <?php } ?>>
                                                                                    <label for="paypalemail"><img alt="Icon" src="https://www.stopoint.com/images/f-icon1.png">Paypal *</label>
                                                                                    <input type="email" placeholder="Paypal Email" value="<?=$resultuser['PaypalEmail']?>" name="PaypalEmail" id="paypalemail" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                                <input type="submit" name="submit_payment" class="submit-btn" value="Update Payment">
                                                                                                </div>
                                                                            </form>
                                                                            <br/><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <h3>Payment Address</h3>
                                                                <?php 
                                                                    if($resultuser['PaymentMethod'] == 2)
                                                                    {
                                                                ?>
                                                                <p><?php echo $resultuser['S_AddressLine1']; ?>
<?php echo $resultuser['S_AddressLine2']; ?>&nbsp;
                                                                    <br><?php echo $resultuser['S_City']; ?>&nbsp;<?= $_SESSION['statename'] ?>
                                                                    <br><?php echo $resultuser['S_PostalCode']; ?>&nbsp;US
                                                                    
                                                                   
                                                                    <!-- Modal Add payment Info -->
                                                                </p>
                                                                
                                                                <?php 
                                                                    }else{
                                                                ?>
                                                                <p><?php echo $resultuser['PaypalEmail'] ?></p>
                                                                <?php 
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/><br/>
                                                    <hr class="clearfix">
                                                    <br/><br/>
                                                    <div class="dashboard">
                                                        <div class="row no-gutter">
                                                        <div class="col-md-12 col-sm-12 hidden-xs">
                                                            <h3>Recent Pending Orders</h3>
                                                            <table class="table table-striped">
                                                                                                    <thead>
                                                                                                        <tr class="main-label">
                                                                                                            <th>Fedex#</th>
                                                                                                            <th>Tracking No</th>
 <th>Return No</th>                                                                                                           <th>Order Date</th>
                                                                                                            <th>Product</th>
                                                                                                            <th>Original Amount</th>
                                                                                                            <th>Adjusted Amount</th>
                                                                                                            <th>Order Status</th>
                                                                                                            <th>Actions</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                <?php 


                                                $rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode,order.Returnlabel as Returnlabel, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                 END as OrderStatus
                                                FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc limit 0,3");
                                                // loop over the rows, outputting them
                                                while ($roworder = mysql_fetch_assoc($rowsorder)) {
                                                    if ($roworder['OrderStatus'] != 'Paid' && $roworder['OrderStatus'] != 'Return Completed') {
                                                        ?>
                                                                                                                <tr>
 <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
 "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a></td>
 
   <td><?php echo $roworder['TrackingCode']; ?></td>
 <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['Returnlabel']; ?> 
 "target="['_blank']"><?php echo $roworder['Returnlabel']; ?></a></td>                                                                                                                   <td><?php echo date('m/d/Y h:i:s', strtotime($roworder['OrderDate'])); ?></td>
                                                                                                                    <td><a href="#" style="color: #333333; text-decoration:none;" data-toggle="tooltip" data-placement="right" title="<?php echo htmlspecialchars($roworder['Description']); ?>"><?php echo htmlspecialchars($roworder['Description']); ?></a></td>
                                                                                                                    <td>$ <?php echo $roworder['OrderAmount']; ?></td>
                                                                                                                <?php
                                                                                                                if ($roworder['AdjustedAmount'] == '') {
                                                                                                                    ?>
                                                                                                                        <td> <?php echo $roworder['AdjustedAmount']; ?></td>
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    ?>
                                                                                                                        <td>$ <?php echo $roworder['AdjustedAmount']; ?></td>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?> 
                                                                                                                    <td>
                                                                                                                        <a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <?php echo $roworder['OrderStatus']; ?>
                                                                                                                            </a>
                                                                                                                        </td>
                                                                                                                    <td>
                                                                                                                        <?php 
                                                                                                                            if($roworder['OrderStatus']=='Expired' || $roworder['OrderStatus']=='Cancelled')
                                                                                                                            {
                                                                                                                        ?>
                                                                                                                        <?php 
                                                                                                                            }else{
                                                                                                                        ?>
                                                                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send">View Order Details</a>
                                                                                                                        <?php 
                                                                                                                            }
                                                                                                                        ?>
                                                                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworder['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                                                                    <?php
                                                                                                                    if ($roworder['OrderStatus'] == "Pending") {
                                                                                                                        ?>
                                                                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworder['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                                                                        <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                    </td>
                                                                                                                </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>


                                                                                                    </tbody>
                                                                                                </table>
                                                            <a data-toggle="tab" href="#tab3" aria-expanded="false">View Full Order History</a>
                                                        </div>
                                                        
                                                        <div class="visible-xs">
                                                        	<h3>Recent Pending Orders</h3>
                                                        	
                                                        	<?php


                                                $rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode,order.Returnlabel as Returnlabel, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
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
                                                 END as OrderStatus
                                                FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc limit 0,3");
                                                // loop over the rows, outputting them
                                                while ($roworder = mysql_fetch_assoc($rowsorder)) {
                                                	if ($roworder['OrderStatus'] != 'Paid' && $roworder['OrderStatus'] != 'Return Completed') {
                                                	?>	
                                              <div class="col-sm-12 visible-xs no_pad" style="border-bottom: 3px solid #84BC41;">
                                                	<div class="full_tabil">
                                                		<div class="tbl_hed">
	                                                		
	                                                		<div class="tbl_hed_in2">
	                                                			Fedex <br /> Tracking Id
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Tracking <br /> No
	                                                		</div>
                                                            <div class="tbl_hed_in2">
	                                                			Return <br /> No
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Order <br /> Date
	                                                		</div>
	                                                		<div class="tbl_hed_in2">
	                                                			Product
	                                                		</div>
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		
	                                                		<div class="tbl_body_box2 tbl_body_box_break"><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a></div>
	                                                		<div class="tbl_body_box2"><?php echo $roworder['TrackingCode']; ?></div>
                                                            <div class="tbl_body_box2 tbl_body_box_break"><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['Returnlabel']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['Returnlabel']; ?></a></div>
	                                                		<div class="tbl_body_box2"><?php echo date('m/d/Y h:i:s', strtotime($roworder['OrderDate'])); ?></div>
	                                                		<div class="tbl_body_box2"><?php echo htmlspecialchars($roworder['Description']); ?></div>
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
	                                                			Actions
	                                                		</div>
	                                                		
	                                                	</div>
	                                                	<div class="tbl_body">
	                                                		<div class="tbl_body_box2">$ <?php echo $roworder['OrderAmount']; ?></div>
	                                                		<div class="tbl_body_box2"><?php
                                                                if ($roworder['AdjustedAmount'] == '') {
                                                                    ?>
                                                                        &nbsp;
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        $ <?php echo $roworder['AdjustedAmount']; ?>
                                                                    <?php
                                                                }
                                                                ?> </div>
	                                                		<div class="tbl_body_box2"><a href="#"  data-target="#itemglossary" data-toggle="modal">
                                                                                                                        <a href="#"><?php echo $roworder['OrderStatus']; ?></a>
                                                                                                                            </a></div>
	                                                		<div class="tbl_body_box2"><?php 
                                                                            if($roworder['OrderStatus']=='Expired' || $roworder['OrderStatus']=='Cancelled')
                                                                            {
                                                                        ?>
                                                                        <?php 
                                                                            }else{
                                                                        ?>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send">View Order Details</a>
                                                                        <?php 
                                                                            }
                                                                        ?>
                                                                        
                                                        <!--                <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon2.png" title="View"  alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&send"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon3.png" title="Order Messages" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/order_edit.php?id=<?= $roworder['OrderId'] ?>&testimonials"><img height="16" width="16" class="t-icon" src="<?php echo $base_url; ?>/images/testimonial.jpg" title="Add Review" alt="Icon"/></a>
                                                                        <a href="<?php echo $base_url; ?>/pdffile.php?id=<?= $roworder['TrackingCode'] ?>" target="_blank"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon4.png" title="Packing List" alt="Icon"/></a>-->
                                                                    <?php
                                                                    if ($roworder['OrderStatus'] == "Pending") {
                                                                        ?>
                                                            <!--                <a href="<?php echo $base_url; ?>/dashboard.php?order_delete=<?= $roworder['OrderId'] ?>"><img class="t-icon" src="<?php echo $base_url; ?>/images/t-icon1.png" title="Cancel Order" alt="Icon"/></a>-->
                                                                        <?php
                                                                    }
                                                                    ?></div>
	                                                		
	                                                	</div>
	                                                </div>
                                                	
                                                </div>
                                                        	  
                                                        	<?php 
                                                        	}
} ?>
                                                        	
                                                   </div>     	
                                                        	
                                                        	
                                                        	 <a class="visible-xs mrg_btm" data-toggle="tab" href="#tab3" aria-expanded="false">View Full Order History</a>
                                                      
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>




                                    </div>

                                </div>
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
                            <a data-toggle="tab" href="#tab-i">Return Completed</a>
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
                        <div id="tab-i" class="tab-pane">

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
                            <p>We are inspecting your device. This process check your serial number for installment payment or if your device has an activation lock ‚ÄúFind my Phone‚Äù is on. If your order is on this department it usually takes 24 hrs. Not all devices go to this department.</p>
                        </div>
						<div id="tab-k" class="tab-pane">
                            <header class="section-header">
                                <h2>Activation Lock</h2>
                            </header>
                            <p>Apple device was running iOS7 or later, it is automatically locked by the "Find My iPhone" Activation Lock, which is a new security feature that locks your Apple device to your iCloud account so we are unable to properly inspect it. Since we cannot unlock your device, we are unable to inspect your device until you remove your iCloud account from the device.</p>
							<p>
								<h5>WHAT YOU NEED TO DO</h5>Don‚Äôt worry; you can easily unlock your device remotely by going to: http://www.icloud.com
							</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
if ($_GET['err_msg'] == "updatesuccess") 
{  
	$email=mysql_fetch_array(mysql_query("select * from user WHERE id=" . $_SESSION['login_id']));
        $emailaddress=$email['EmailAddress'];
        if($_GET['news']==1)
        { 
        	$newsletter=1;
        	set_sub($newsletter,$emailaddress); 
        }
        else if($_GET['news']==0)
        { 	
        	$newsletter=0;  
        	set_unsub($newsletter,$emailaddress);
        }
 


}
function set_sub($chk,$email)
{ 
	// grab an API Key from http://admin.mailchimp.com/account/api/
	include_once( 'inc/MCAPI.class.php' ); 
	$api = new MCAPI('1a2e8827797f0ed884437648f8b2ecae-us11');
	$retval = $api->listSubscribe( "5c3f2522ee", $email, $merge_vars ); 
	/*if ($api->errorCode)
	{
		echo "Unable to load listSubscribe()!\n";
		echo "\tCode=".$api->errorCode."\n";
		echo "\tMsg=".$api->errorMessage."\n";
	} 
	else 
	{
   		echo "Subscribed - look for the confirmation email!\n";
	}  */
}
function set_unsub($chk,$email)
{
	// grab an API Key from http://admin.mailchimp.com/account/api/
	include_once( 'inc/MCAPI.class.php' );
	$api = new MCAPI('1a2e8827797f0ed884437648f8b2ecae-us11');
	$retval = $api->listUnsubscribe("5c3f2522ee",$email);
	/*if ($api->errorCode)
	{
		echo "Unable to load listUnsubscribe()!\n";
		echo "\tCode=".$api->errorCode."\n";
		echo "\tMsg=".$api->errorMessage."\n";
	} 
	else 
	{
		echo "Returned: ".$retval."\n";
	}*/
}
 
?>
                <script>
                $('#paymentpop').on('change', function() {
                    if(this.value=='1')
                    {
                        $(".paypalemail").css("display", "block");
                    }else{
                        $(".paypalemail").css("display", "none");
                    }
                  });
				  
function stopReview(){
	if($("#review_done") && $("#review_done").val() == 1){
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
				$("#review_done").val(0);
				$("#review-alert").hide();
				$('.review-count').css("color","black");
				$('.review-count').html("(0)");
            }
        };
        xmlhttp.open("GET", "review-done.php", true);
        xmlhttp.send();
	}
}				  
                </script>
<!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.sync.bootstrap.min.js" async></script>
<!-- End Trustbox script -->
                