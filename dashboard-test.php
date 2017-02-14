<?php
include "header.php";
if (!isset($_SESSION['login_username']) || isset($_SESSION['FULLNAME']) || isset($_SESSION['token'])) {
    header('Location: ' . $base_url . '/login');
}
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
?>
<style type="text/css">
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
<!-- checkout --> 
<div class="container">
    <div class="row text-center">
        <h1 class="sub-heading">Dashboard</h1>
    </div><!-- row --> 
    <?php
    if ($_GET['err_msg'] == "testimonial_success") {
        ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Thank you for taking the time to leave a review. Reviews help us evaluate our performance and ensure that we’re always providing the best level of service to our clients. They also allow prospective clients to get an idea of what it’s like to work with our firm through the experiences of our clients. Thank you again for your time, and if you have any questions, please feel free to contact us!.
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
    <div class="container">
        <div class="row no-gutter">
            <div class="col-md-3 col-sm-3">
                <nav class="pad-20">
                    <ul class="nav nav-list nav-sidebar-filter">
                        <?php
                        if ($_GET['tab'] == "tab_overview") {
                            ?>
                         <li class="active"><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages</a></li>
                            <?php
                        }
                        if ($_GET['tab'] == "tab1") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li class="active"><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages</a></li>
                            <?php
                        }
                        if ($_GET['tab'] == "tab2") {
                            ?>
                            <li><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li class="active"><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages</a></li>
                            <?php
                        }
                        if ($_GET['tab'] == "tab3") {
                            ?>
                            <li ><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li class="active"><a href="#tab3"  data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li><a href="#tab1"  data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>

                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages</a></li>
                            <?php
                        }
                        if (($_GET['tab'] == 'tab5') || ($_GET['tab'] == 'tab6') || ($_GET['tab'] == 'tab4')) {
                            ?>
                            <li><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li><a href="#tab3" data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li><a href="#tab1" data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>
                            <li class="active"><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages</a></li>
                            <?php
                        }
                        if (!$_GET['tab']) {
                            ?>
                            <li class="active"><a href="#tab_overview" data-toggle="tab"><i class="fa fa-dashboard"></i>Overview</a></li>
                            <li ><a href="#tab3" data-toggle="tab"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                            <li ><a href="#tab1" data-toggle="tab"><i class="fa fa-user"></i>My Account</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-key"></i>Change Password</a></li>
                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-comments"></i>Messages</a></li>
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


                    if (isset($_POST['acceptNewsletter'])) {
                        $newsletter = 1;
                    } else {
                        $newsletter = 0;
                    }

                    $destination_path = getcwd() . DIRECTORY_SEPARATOR;
                    $target_file = $destination_path . "/images/users/";
                    $target_file = $target_file . basename($_FILES['photo']['name']);
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    if ($_FILES["photo"]["name"] != '') {
                        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
                        $updaterecord = mysql_query("UPDATE user SET `FirstName` = '$fname',`LastName` = '$lname' ,`Phone` = '$phoneno',`PaypalEmail` = '$paypalemail',`PaymentMethod` = '$payment',`IsNewsletter` = '$isnewsletter',`S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$baddress1' ,`B_AddressLine2` = '$baddress2' ,`B_City` = '$bcity' ,`B_State` = '$bstate' ,`B_PostalCode` = '$bpostal' ,`B_Country` = 'United States',`IsNewsletter` = $newsletter  ,`image_url` = '" . $_FILES["photo"]["name"] . "' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                        if ($updaterecord) {
                            header('Location: ' . $base_url . '/dashboard-test?err_msg=updatesuccess');
                        } else {
                            header('Location: ' . $base_url . '/dashboard-test?err_msg=updateerror');
                        }
                    } else {
                        $updaterecord = mysql_query("UPDATE user SET `FirstName` = '$fname',`LastName` = '$lname' ,`Phone` = '$phoneno',`PaypalEmail` = '$paypalemail',`PaymentMethod` = '$payment',`IsNewsletter` = '$isnewsletter',`S_AddressLine1` = '$saddress1' ,`S_AddressLine2` = '$saddress2' ,`S_City` = '$scity' ,`S_State` = '$sstate' ,`S_PostalCode` = '$spostal' ,`S_Country` = 'United States' ,`B_AddressLine1` = '$baddress1' ,`B_AddressLine2` = '$baddress2' ,`B_City` = '$bcity' ,`B_State` = '$bstate' ,`B_PostalCode` = '$bpostal' ,`B_Country` = 'United States',`IsNewsletter` = $newsletter WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                        if ($updaterecord) {
                            header('Location: ' . $base_url . '/dashboard-test?err_msg=updatesuccess');
                        } else {
                            header('Location: ' . $base_url . '/dashboard-test?err_msg=updateerror');
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
                        header('Location: ' . $base_url . '/dashboard-test?err_msg=updatesuccess');
                    } else {
                        header('Location: ' . $base_url . '/dashboard-test?err_msg=updateerror');
                    }
                }
                
                if ($_POST['submit_payment']) {
                    $payment = $_POST['payment'];
                    $PaypalEmail = $_POST['PaypalEmail'];
                    $updaterecord = mysql_query("UPDATE user SET `PaymentMethod` = '$payment',`PaypalEmail` = '$PaypalEmail' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                    if ($updaterecord) {
                        header('Location: ' . $base_url . '/dashboard-test?err_msg=updatesuccess');
                    } else {
                        header('Location: ' . $base_url . '/dashboard-test?err_msg=updateerror');
                    }
                }

                if ($_POST['changepassword']) {
                    $vasuser = "SELECT * FROM `user` WHERE id=" . $_SESSION['login_id'];
                    $reuser = mysql_query($vasuser);
                    $weuser = mysql_fetch_assoc($reuser);

                    if ($_POST['NewPassword'] != $_POST['NewConfirmPassword']) {
                        ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> Your new entered password didn't match.
                        </div>
                        <?php
                        header('Location: ' . $base_url . '/dashboard-test?tab=tab2');
                    } else if (($_POST['NewPassword'] == $_POST['NewConfirmPassword']) && ($_POST['CurrentPassword'] == $weuser['Password'])) {

                        $newpassword = $_POST['NewPassword'];

                        mysql_query("UPDATE user SET `Password` = '" . $newpassword . "' WHERE id=" . $_SESSION['login_id']) or die(mysql_error());
                        ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> User password has been updated!.
                        </div>
                        <?php
                        header('Location: ' . $base_url . '/dashboard-test?tab=tab2');
                    } else if (($_POST['CurrentPassword'] != $weuser['Password'])) {
                        ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> Your current password didn't match.
                        </div>
                        <?php
                        header('Location: ' . $base_url . '/dashboard-test?tab=tab2');
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
                                                $rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                    CASE order.OrderStatus
                                                   WHEN '8' THEN 'Expired' 
                                                    WHEN '7' THEN 'Cancelled' 
                                                    WHEN '6' THEN 'Paid'
                                                    WHEN '5' THEN 'Release Payment'
                                                    WHEN '4' THEN 'Returned'
                                                    WHEN '3' THEN 'Adjusted Price'
                                                    WHEN '2' THEN 'Received'
                                                    WHEN '1' THEN 'Pending'
                                                    ELSE 'Pending'
                                                    END as OrderStatus
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " and order.OrderStatus=6 ORDER BY order.OrderDate desc");
                                                $numrow = mysql_num_rows($rowsorder);
                                            ?>
                                        <ul id="tabList" role="tablist" class="nav nav-tabs">
                                            <li <?php if (!isset($_GET['msg'])) { ?> class="active" <?php } ?> role="presentation">
                                                <a data-toggle="tab" role="tab" aria-controls="pending" href="#pending">Pending Orders</a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a data-toggle="tab" role="tab" aria-controls="completed" href="#completed">Completed Orders</a>
                                            </li>
                                            <li <?php if (isset($_GET['msg']) == 'testimonials') { ?> class="active" <?php } ?> role="presentation" class="">
                                                <a data-toggle="tab" role="tab" aria-controls="completed" href="#Testimonials">Review (<?=$numrow?>)</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">

                                            <div id="pending" class="tab-pane <?php if (!isset($_GET['msg'])) { ?> active <?php } ?>" role="tabpanel">
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
<?php
if (isset($_GET['order_delete'])) {

    $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = " . $_GET['order_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab3&err_msg=order_delete_success');
}

$rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                    CASE order.OrderStatus
                                                   WHEN '8' THEN 'Expired' 
                                                    WHEN '7' THEN 'Cancelled' 
                                                    WHEN '6' THEN 'Paid'
                                                    WHEN '5' THEN 'Release Payment'
                                                    WHEN '4' THEN 'Returned'
                                                    WHEN '3' THEN 'Adjusted Price'
                                                    WHEN '2' THEN 'Received'
                                                    WHEN '1' THEN 'Pending'
                                                    ELSE 'Pending'
                                                    END as OrderStatus
                                                   FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($roworder = mysql_fetch_assoc($rowsorder)) {
    if($roworder['OrderStatus']!='Paid')
    {
        ?>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a>
                                                                    <td><?php echo $roworder['TrackingCode']; ?></td>
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
                                                                    <td><?php echo $roworder['OrderStatus']; ?></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($roworder['OrderStatus']=='Expired')
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
                                            </div>

                                            <div id="completed" class="tab-pane" role="tabpanel">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
if (isset($_GET['order_delete'])) {

    $query = mysql_query("UPDATE `order` SET `OrderStatus` = 7 WHERE id = " . $_GET['order_delete']) or die(mysql_error());
    header('Location: ' . $base_url . '/dashboard?tab=tab3&err_msg=order_delete_success');
}
$rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
 CASE order.OrderStatus
 WHEN '8' THEN 'Expired' 
WHEN '7' THEN 'Cancelled' 
WHEN '6' THEN 'Paid'
WHEN '5' THEN 'Release Payment'
WHEN '4' THEN 'Returned'
WHEN '3' THEN 'Adjusted Price'
WHEN '2' THEN 'Received'
WHEN '1' THEN 'Pending'
 ELSE 'Pending'
 END as OrderStatus
FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
// loop over the rows, outputting them
while ($roworder = mysql_fetch_assoc($rowsorder)) {
    if ($roworder['OrderStatus'] == 'Paid') {
        ?>
                                                                <tr>
                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a>
                                                                    <td><?php echo $roworder['TrackingCode']; ?></td>
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
                                                                    <td><?php echo $roworder['OrderStatus']; ?></td>

                                                                </tr>
        <?php
    }
}
?>


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div id="Testimonials" class="tab-pane <?php if (isset($_GET['msg']) == 'testimonials') { ?> active <?php } ?>" role="tabpanel">
                                                <div class="row pad" style="margin-bottom:70px;">
                                                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

                                                            <?php
                                                            $rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                            CASE order.OrderStatus
                                                            WHEN '8' THEN 'Expired' 
                                                            WHEN '7' THEN 'Cancelled' 
                                                            WHEN '6' THEN 'Paid'
                                                            WHEN '5' THEN 'Release Payment'
                                                            WHEN '4' THEN 'Returned'
                                                            WHEN '3' THEN 'Adjusted Price'
                                                            WHEN '2' THEN 'Received'
                                                            WHEN '1' THEN 'Pending'
                                                            ELSE 'Pending'
                                                            END as OrderStatus
                                                           FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc");
                                                           // loop over the rows, outputting them
                                                            while ($roworder = mysql_fetch_assoc($rowsorder)) {

                                                                $testimonial_query = mysql_query('select OrderId from testimonial where OrderId="' . $roworder['OrderId'] . '"');
                                                                $numrows = mysql_num_rows($testimonial_query);
                                                                if ($numrows == '0') {
                                                                    if ($roworder['OrderStatus'] == 'Paid') {
                                                                        ?>
                                                                    <form role="form" method="post" action="" class="validate-form" onsubmit="return validateRating(rating)">
                                                                        <h1 class="form-heading"><?php echo htmlspecialchars($roworder['Description']); ?></h1>
                                                                        <div class="form-group">
                                                                            <label for="OrderNumber">Content :</label>
                                                                            <textarea name="contents" id="contents" class="form-control" placeholder="Your feedback is very important to as it helps us identify areas we need to improve. Please leave a review so we can continue to better serve you." required="required"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="orderidhidden" value="<?= $roworder['OrderId'] ?>"/>
                                                                            <input id="kartik" class="form-control rating" data-stars="5" data-step="0.1" data-size="sm" name="rating" required="required">
                                                                        </div>
                                                                        <br /> 
                                                                        <input id="submit" class="submit-btn" name="submit_testimonial" type="submit" value="Add Review">

                                                                    </form>
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
                                                                    <th>Order Number</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                <?php
                                                if (isset($_GET['inbox_delete'])) {

                                                    $query = mysql_query("DELETE FROM `messages` WHERE id = " . $_GET['inbox_delete']) or die(mysql_error());
                                                    header('Location: ' . $base_url . '/dashboard?tab=tab5&err_msg=message_delete_success');
                                                }

                                                $vasmessage = "SELECT * from messages WHERE ToId = " . $_SESSION['login_id'] . " ORDER BY id DESC";
                                                $remessage = mysql_query($vasmessage);
                                                //$wemessage=mysql_fetch_assoc($remessage);
                                                ?>

<?php
while ($wemessage1 = mysql_fetch_array($remessage)) {
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
                                                                        <td>Order no: <?php echo $wemessage1['OrderId']; ?></td>
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
                                                                        <th>Order Number</th>
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
                                                                            <td>Order no: <?php echo $wemessagesent['OrderId']; ?></td>
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
                                                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                           <?php
                                                           if($resultuser_Set['text_content']!='')
                                                           {
                                                           ?>
                                                            <h6><span style="color:red;font-weight: bold">PLEASE NOTE: </span><br><?=$resultuser_Set['text_content']?></h6>
                                                            <?php
                                                            
                                                           }?>
                                                        </div>
                                                        <div class="clearfix"></div>


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
                                                                                                <input type="submit" name="submit_address" class="submit-btn" value="Edit Address">
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
                                                                            <header class="section-header">
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
                                                        <div class="col-md-12 col-sm-12">
                                                            <h3>Recent Pending Orders</h3>
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
                                                <?php


                                                $rowsorder = mysql_query("SELECT order.id as OrderId, order.TrackingCode as TrackingCode,order.FedexCode as FedexCode, order.OrderDate as OrderDate, order.OrderAmount as OrderAmount, order.AdjustedAmount as AdjustedAmount, order.FedexCode as FedexCode, product.ProductModel as ProductModel, product.ProductCode as ProductCode, product.Description as Description, productfamily.Name as ProductName,
                                                    CASE order.OrderStatus
                                                    WHEN '8' THEN 'Expired' 
                                                    WHEN '7' THEN 'Cancelled' 
                                                    WHEN '6' THEN 'Paid'
                                                    WHEN '5' THEN 'Release Payment'
                                                    WHEN '4' THEN 'Returned'
                                                    WHEN '3' THEN 'Adjusted Price'
                                                    WHEN '2' THEN 'Received'
                                                    WHEN '1' THEN 'Pending'
                                                 END as OrderStatus
                                                FROM `order` INNER JOIN `product` ON product.ProductCode=order.ProductId INNER JOIN `productfamily` ON product.FamilyId=productfamily.Id INNER JOIN `user` ON user.id=order.UserId INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE order.UserId=" . $_SESSION['login_id'] . " ORDER BY order.OrderDate desc limit 0,3");
                                                // loop over the rows, outputting them
                                                while ($roworder = mysql_fetch_assoc($rowsorder)) {
                                                    if ($roworder['OrderStatus'] != 'Paid') {
                                                        ?>
                                                                                                                <tr>
                                                                                                                    <td><a href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?php echo $roworder['FedexCode']; ?> 
                                                                                                                           "target="['_blank']"><?php echo $roworder['FedexCode']; ?></a>
                                                                                                                    <td><?php echo $roworder['TrackingCode']; ?></td>
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
                                                                                                                    <td><?php echo $roworder['OrderStatus']; ?></td>
                                                                                                                    <td>
                                                                                                                        <?php 
                                                                                                                            if($roworder['OrderStatus']=='Expired')
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

<?php
include "footer.php";
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
                </script>