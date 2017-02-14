<?php
include "header.php";
if(!isset($_SESSION['login_username'])){
	header('Location: '.$base_url.'/checkout/true');
}

 session_start();
	$model = $_SESSION['model'];

$_SESSION['checkout'] = "checked";
$carrier = $_SESSION['carrier'];
$phone = $_SESSION['phoneno']; 

if(isset($_POST['price'])){
$price = $_POST['price'];$coupon_code = $_POST['coupon_code'];
$_SESSION['coupon_code'] = $coupon_code;$_SESSION['price'] = $price;
$_SESSION['condition'] = $_POST['condition'];

}

if(!isset($_SESSION['model']) ){
	
	header('Location: '.$base_url.'/');
	}

 $queryuser =  "SELECT * from user WHERE id = ".$_SESSION['login_id'];
	$resultuser = mysql_query($queryuser);
	$result = mysql_fetch_array($resultuser);
	
$sqlAllStates = "SELECT * FROM `state`";
$sqlAllStatesResult = mysql_query($sqlAllStates);
$row = mysql_fetch_assoc($sqlAllStatesResult);
if ($sqlAllStatesResult) {
	while ($row = mysql_fetch_object($sqlAllStatesResult)) {
		$objAllStates[] = $row;
	}
}
?>
<!-- slider -->
<div class="container">
    <div class="row">
    	<h1 class="sub-heading" style="  color: #44b749;">Checkout</h1>
        
        
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="panel-title">Step 2:Payment and Shipping Details</div><!-- End .accordion-title -->
									<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
								</div><!-- End .accordion-header -->
								
								
								  <div class="panel-body">
								 <div class="input-group">
           <?php if($result['PaymentMethod'] == 1){ ?>                        
    <a class="btn-custom-2" data-toggle="collapse" id="paypalcollapse" href="#paypal" style="width:80%; margin-bottom:10px;margin-left:10px;text-align:left;"><span class="badge">1</span>Paypal: No need to wait for the mail</a>            
                      <?php }
					  else if($result['PaymentMethod'] == 2){
					   ?>
                                <br /><br /><br />                   
                                
    <a class="btn-custom-2" data-toggle="collapse" id="checkcollapse" href="#check" style="width:80%; margin-bottom:10px;margin-left:10px;text-align:left;"><span class="badge">2</span>Check: Get paid via bank check</a>
<?php } 
else{
	?>
    <a class="btn-custom-2" data-toggle="collapse" id="paypalcollapse" href="#paypal" style="width:80%; margin-bottom:10px;margin-left:10px;text-align:left;"><span class="badge">1</span>Paypal: No need to wait for the mail</a>
    
     <br /><br /><br />   
    
    <a class="btn-custom-2" data-toggle="collapse" id="checkcollapse" href="#check" style="width:80%; margin-bottom:10px;margin-left:10px;text-align:left;"><span class="badge">2</span>Check: Get paid via bank check</a>
    <?
	}
?>
								   		
                                  </div>
                                   <br />
                                        <div id="paypal" class="collapse">
                                        <h1 class="sub-heading">Paypal</h1>
                                        <form action="<?php echo $base_url; ?>/confirmpayment" id="checkout-form" class="validate-form" name="pay-form" method="post">																				<input type="hidden" name="coupon_code" value="<?php echo $_SESSION['coupon_code']; ?>" />										
                                        <input type="hidden" name="pay" value="pay" id="pay">
										<div class="form-group">
											<label>Paypal Email<font color="#FF0000">*</font></label>
											<input type="text" required class="form-control input-lg" placeholder="Enter Paypal Email Address" value="<?php if(isset($_SESSION['pemail'])){ echo $_SESSION['pemail']; } else{ echo $result['PaypalEmail']; } ?>" name="pemail">
                                            </div>
                                            <h1 class="form-heading">SHIPPING ADDRESS</h1>
                                            
                                            <div class="form-group">
                                                                        <label class="control-label" for="inputSuccess1">Please Enter Name<font color="#FF0000">*</font></label>
                                                                        <input type="text" class="form-control" id="payto" name="payto" placeholder="Enter Name" value="<?php if($result['FirstName'] != "Guest"){ echo $result['FirstName']." ". $result['LastName']; } ?>" required>
                                                                        
                                                                    </div>
                                              <div class="form-group">
                                        <label>Address 1<font color="#FF0000">*</font></label>
                                        <input type="text" value="<?php if(isset($_SESSION['address1'])){ echo $_SESSION['address1'];} else{ echo $result['S_AddressLine1']; }?>" class="form-control" data-placeholder="street address" required placeholder="street address" name="add" id="add">
                                        <input type="hidden" name="price" value="<?php echo $_SESSION['price']; ?>" />
                                       </div>

                                        
                                       
                                      <div class="form-group">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control" data-placeholder="street address" name="add2" id="add2" value="<?php if(isset($_SESSION['address2'])){ echo $_SESSION['address2'];} else{ echo $result['S_AddressLine2']; }?>" placeholder="street address 2">
                                       </div>
                                       
                                    
                                      <div class="form-group">
                                    
                                       <label>City<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" required name="city" id="city" data-placeholder="City" placeholder="City" value="<?php if(isset($_SESSION['city'])){ echo $_SESSION['city'];} else{ echo $result['S_City']; }?>">
                                                                            </div>
                                        
                                                                            
                                   
                                   <div class="form-group">
                                   <label>State<font color="#FF0000">*</font></label>
                                <div class="normal-selectbox clearfix">
                                <select class="form-control myclass" name="state" id="state" required>
                                 <option value="">Select State</option>
                                 <?php
                                 foreach ($objAllStates AS $StateDetails) {
                                 ?>
                                 <option 
                                 <?php
                                 if($result['S_State'] == $StateDetails->state_abbr){
                                 ?>
                                 selected="selected" 
                                 <?php
                                 }
                                 ?>
                                 value="<?=$StateDetails->state_abbr?>"><?=$StateDetails->state_name?>
                                 </option>
                                 <?php
                                 }
                                 ?>
                              </select>
                                        </div></div>
                                            
                                          
                                      <div class="form-group">
                                      <label>Zip<font color="#FF0000">*</font></label>
                                       
                                        <input type="text" required class="form-control" name="in2" id="in2" data-placeholder="Zip" placeholder="Zip" value="<?php if(isset($_SESSION['zip'])){ echo $_SESSION['zip']; } else{ echo $result['S_PostalCode']; }?>">
                                                                            </div>                                   
                                                    
                                         <div class="row field-row">
                                    <div class="col-xs-12 col-sm-6">
                                        
                                        <label>Phone<font color="#FF0000">*</font>:</label>
                                        <input class="form-control" type="text" required id="mono2" name="mono2" value="<?php if(isset($_SESSION['phoneno'])){ echo $_SESSION['phoneno'];} else{echo $result['Phone'];}?>">
                                            </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <label>&nbsp;Country :</label>
                                        <input class="form-control" required type="text" name="con2" readonly="readonly" id="con2" value="United States">
                                        <font style="color: black">&nbsp;We currently only support trades within the United States.</font>
                                    </div>

                                </div>
                                        
                                          <div class="row field-row">
                                
                                <input type="submit" value="CONTINUE" class="submit-btn" name="paybtn" id="paybtn">
                                </div></form>
                                        </div>
                                       <br />
                                       
                                    <div id="check" class="collapse">
                                    <h1 class="sub-heading">Check</h1>
                                    <form action="<?php echo $base_url; ?>/confirmpayment" id="checkout-form2" class="validate-form" name="checkout-form2" method="post">																		<input type="hidden" name="coupon_code" value="<?php echo $_SESSION['coupon_code']; ?>" />									
                                     <div class="form-group">
                                                                        <label class="control-label" for="inputSuccess1">Please Enter Name<font color="#FF0000">*</font></label>
                                                                        <input type="text" class="form-control" id="payto" name="payto" placeholder="Enter Name" value="<?php if($result['FirstName'] != "Guest"){ echo $result['FirstName']." ". $result['LastName']; } ?>" required>
                                                                        <input type="hidden" name="price" value="<?php echo $_SESSION['price']; ?>" />
                                                                    </div>
                                   
                                    
                                    <div class="form-group">
                                        <label>Address 1<font color="#FF0000">*</font></label>
                                        <input type="text" required value="<?php if(isset($_SESSION['address1'])){ echo $_SESSION['address1'];} else{ echo $result['S_AddressLine1']; }?>" class="form-control" data-placeholder="street address" placeholder="street address" name="add" id="add">
                                       </div>

                                        
                                       
                                      <div class="form-group">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control" data-placeholder="street address" name="add2" id="add2" value="<?php if(isset($_SESSION['address2'])){ echo $_SESSION['address2'];} else{ echo $result['S_AddressLine2']; }?>" placeholder="street address 2">
                                       </div>
                                       
                                    
                                      <div class="form-group">
                                    
                                       <label>City<font color="#FF0000">*</font></label>
                                        <input type="text" required class="form-control" name="city" id="city" data-placeholder="City" placeholder="City" value="<?php if(isset($_SESSION['city'])){ echo $_SESSION['city'];} else{ echo $result['S_City']; }?>">
                                                                            </div>
                                        
                                                                            
                                   
                                   <div class="form-group">
                                   <label>State<font color="#FF0000">*</font></label>
                                <div class="normal-selectbox clearfix">
                                <select class="form-control myclass" name="state" id="state" required>
                                 <option value="">Select State</option>
                                 <?php
                                 foreach ($objAllStates AS $StateDetails) {
                                 ?>
                                 <option 
                                 <?php
                                 if($result['S_State'] == $StateDetails->state_abbr){
                                 ?>
                                 selected="selected" 
                                 <?php
                                 }
                                 ?>
                                 value="<?=$StateDetails->state_abbr?>"><?=$StateDetails->state_name?>
                                 </option>
                                 <?php
                                 }
                                 ?>
                              </select>
                                        </div></div>
                                            
                                          
                                      <div class="form-group">
                                      <label>Zip<font color="#FF0000">*</font></label>
                                       
                                        <input type="text" required class="form-control" name="in2" id="in2" data-placeholder="Zip" placeholder="Zip" value="<?php if(isset($_SESSION['zip'])){ echo $_SESSION['zip']; } else{ echo $result['S_PostalCode']; }?>">
                                                                            </div>                                   
                                                    
                                         <div class="row field-row">
                                    <div class="col-xs-12 col-sm-6">
                                        
                                        <label>Phone<font color="#FF0000">*</font>:</label>
                                        <input class="form-control" required type="text" id="mono2" name="mono2" value="<?php if(isset($_SESSION['phoneno'])){ echo $_SESSION['phoneno'];} else{echo $result['Phone'];}?>">
                                            </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <label>&nbsp;Country :</label>
                                        <input class="form-control" type="text" name="con2" id="con2" readonly="readonly" value="United States">
                                        <font style="color: black">&nbsp;We currently only support trades within the United States.</font>
                                    </div>

                                </div>
                                 
                                
                                <input type="submit" class="submit-btn" value="CONTINUE" name="check">
                                </form>
                                </div>
                              		

                                   
                                            
                                              <div class="lg-margin"></div><!-- space -->
								   	
								   </div><!-- End.row -->
								</div><!-- End .panel-collapse -->
							  
							  
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
     <img class="fix img-responsive" alt="<?php echo $resultproduct['image_url']; ?>" style="height:179px;" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>" alt="<?=$resultproduct['Description']?>"/>      
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
												<a href="#"><img src="<?php echo $base_url; ?>/images/gen.png" alt="Tablets"></a>
												<?php }
												else if($resultproduct['CategoryId'] ==4){
												?>
												<a href="#"><img src="<?php echo $base_url; ?>/images/apple_tv.png" alt="Apple TV"></a>
												<?php }
												
												else if($resultproduct['CategoryId'] ==5){
												?>
												<a href="#"><img src="<?php echo $base_url; ?>/images/apple_watch.png" alt="Apple Watch"></a>
												<?php } }?>
												 
											</figure> 
											<header class="item-name">
                                            <?php echo $resultproduct['Description']; ?>
                                            </header>
											
										</td>
										
										<td class="item-price-col"><span class="item-price-special">$<?php echo $_SESSION['price']; ?></span></td>
										<td>
											<div class="custom-quantity-input">
                                                <span>1</span>
												<a href="#" onclick="return false;" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>
												<a href="#" onclick="return false;" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>
											</div>
										</td>
										<td class="item-total-col"><span class="item-price-special">
                                        $<?php echo $_SESSION['price']; ?>                                      
                                        </span>
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