<?php
include "header.php";
session_start();

if(isset($_GET['ps'])){
	 $_SESSION['id'] = mysql_real_escape_string($_GET['id']);
	  $id = $_SESSION['id'];
 $_SESSION['family'] = mysql_real_escape_string($_GET['family']);
  $family = $_SESSION['family'];
	
	}
	
unset($_SESSION['computer']);
if(isset($_GET['id'])){
$_SESSION['id'] = $_GET['id'];
}
 $id = $_SESSION['id'];
 if(isset($_GET['family'])){
  $_SESSION["family"] = $_GET['family'];
 }
 $family = $_SESSION["family"]; 
 if(isset($_GET['generation'])){
 $_SESSION["generation"] = $_GET['generation'];
 }
 $generation = $_SESSION["generation"]; 
 if(isset($_GET['model'])){
  $_SESSION["model"] = $_GET['model']; 
 }
$model = $_SESSION["model"];
?>
<input type="hidden" id="model" value="<?php echo $model; ?>" />
<input type="hidden" id="coupon_code" value="<?php echo isset($_SESSION['coupon_code'])?$_SESSION['coupon_code']:""; ?>" />
<input type="hidden" id="coupon_code_index" value="<?php echo isset($_SESSION['coupon_code_index'])?$_SESSION['coupon_code_index']:""; ?>" />
<input type="hidden" id="coupon_code_condition" value="<?php echo isset($_SESSION['coupon_code_condition'])?$_SESSION['coupon_code_condition']:""; ?>" />


<div class=" step container-fluid">
<div class="container">
<ul class=" step-tab nav nav-justified  tabs">
<?php

 ?>
      <li class="<?php if($_GET['id'] == '' && $_GET['generation'] =='' && $_GET['model'] =='' && $_GET['family'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
     <li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT  FAMILY</a></li> 
     <!--<li class="<?php //if($_GET['id'] != '' && $_GET['ps']!=''){echo 'active';} elseif ($_GET['family'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab3" <?php //if(isset($_SESSION['family'])){?> data-toggle="tab" <?php //} ?>><div class="step-no">3</div>SELECT GENERATION</a></li>-->
      <li class="<?php if($_GET['family'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4" <?php if(isset($_SESSION['family'])){?> data-toggle="tab" <?php } ?>><div class="step-no">4</div>SELECT MODEL</a></li>
        
      <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>><div class="step-no">5</div>SELECT CONDITION</a></li>
    </ul>
</div><!-- end container --> 
</div><!-- end container-fluid --> 

<div class="container tab-content">
<!-- row --> 
<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['generation'] ==''  && $_GET['model'] =='' && $_GET['family'] ==''){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">
<div class="row text-center">
<h1 class="sub-heading">BRAND</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR BRAND TO CONTINUE</h2>
    
</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="port-1">
      <?php
	  $querybrand =  "SELECT DISTINCT productcategory.Name as `brandname` from product INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE product.CategoryId = 23";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	 
	  ?>
        <a href="<?php echo $site_url; ?>/sell/<?php echo $resultbrand['brandname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <img class="fix img-responsive" alt="iPod" src="<?php echo $site_url; ?>/productimages/ipod.png"/>
        <h2><?php echo $resultbrand['brandname']; ?></h2>
          
        </div></a>
       <?php } ?>

      </div>
     
    </div>
    </div>
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div> 
  </div>

<div class="row hr-line"></div>
<div class="nomobile">  
<?php
include 'stopoint-press.php';
?>
</div>  
<div class="navmobile" style="display:none">  
<?php
include 'stopoint-press-mobile.php';
?>
</div>   
<!--Tabs ENDS-->
</div>
<div class="tab-pane fade tab_bg <?php if($_GET['id'] != ''  &&  $_GET['ps']==''){ echo 'tab-pane fade tab_bg active in' ;} elseif($_GET['ps']!='' && $_GET['id'] != '' && $_GET['family'] !=''){echo 'tab-pane fade tab_bg' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab2">
<!--<div class="row text-center">
<h1 class="sub-heading">FAMILY</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR FAMILY TO CONTINUE</h2>
</div>-->

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your iPod for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your iPod <?php echo $resultproduct['Description'] ;?></h2>
</div>
<div class="row pad ">
</div>
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
    <!-- Tab panes -->
    <div class="tab-content">
         <div class="tab-pane fade in active nomobile">
     <?php
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 23";
		
		$resultfamiliess = mysql_query($queryfamilyy);
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <a href="<?php echo $base_url; ?>/sell/ipod/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4 col-centered"> 
       <?php if($resultfamilyy['familyimage'] != ""){
			?>
            <img class="fix img-responsive" style="height:179px;" alt="iPod image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/>
            <?php
			}
		else{ 
		?>
        <img class="fix img-responsive" alt="apple_ipod" src="<?php echo $base_url; ?>/images/ipod.png"/>
        <?php } ?>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php } ?>
      </div>
      
      <div class="tab-pane fade in active navmobile" style="display:none;">
      <ul class="nav nav-tabs nav-stacked">  
     <?php
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 23";
		
		$resultfamiliess = mysql_query($queryfamilyy);
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <li><a href="<?php echo $base_url; ?>/sell/ipod/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>">
       <?php if($resultfamilyy['familyimage'] != ""){
			?>
            
            <?php
			}
		else{ 
		?>
        <img class="fix img-responsive" alt="apple_ipod" src="<?php echo $base_url; ?>/images/ipod.png"/>
        <?php } ?>
        <h4><?php echo $resultfamilyy['familyname']; ?></h4><div style="clear:both;"></div>
          
        </a></li>
        <?php } ?>
        </ul>
      </div>
    </div>
    </div>
  <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
  </div>
  
<div class="row hr-line"></div>
<div class="nomobile">  
<?php
include 'stopoint-press.php';
?>
</div>  
<div class="navmobile" style="display:none">  
<?php
include 'stopoint-press-mobile.php';
?>
</div>   
</div>

<!--Step 3 ENDS-->


<!--Step 4 Starts-->
<div class="tab-pane fade tab_bg <?php if($_GET['family'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab4">

<!--<div class="row text-center">
<h1 class="sub-heading">Model </h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Generation <span style="color:#000;"><?php echo $generation ;?></span></h3>
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $family ;?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $family ;?> </h2>
</div>

<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
<div class="nomobile">
<?php
/*echo $_SESSION["carrier"];
echo $_SESSION["id"];
echo $_SESSION['phone'];*/

$querymemory1 =  "SELECT product.id as productid , product.Description as `productdescription` , product.image_url as `image_url` ,product.Generation as 'pgeneration', product.ProductModel as 'productmodel', productfamily.Name as `familyname` , product.StorageCapacity as 'storagecapacity' from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE productfamily.Name ='".$_SESSION['family']."'";
$resultmemories1 = mysql_query($querymemory1);
//if(isset($_SESSION['generation'])){
	while($resultmemory1 = mysql_fetch_array($resultmemories1)){
?>
     
     <a href="<?php echo $base_url; ?>/sell-<?php echo str_replace(" ","-",$resultmemory1['familyname']); ?>-<?php echo str_replace(" ","-",$resultmemory1['pgeneration']); ?>-<?php echo str_replace(" ","-",$resultmemory1['storagecapacity']); ?>/<?php echo $resultmemory1['productid']?>"><div class="col-lg-3 col-md-3 col-sm-3 portfolio-block col-centered">
      <?php
	 if($resultmemory1['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt="Apple iPod image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultmemory1['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     <img class="fix img-responsive" alt="apple_ipod" src="<?php echo $base_url; ?>/images/ipod.png"/>
       <?php } ?>
         <h2><?php echo $resultmemory1['productdescription'];?></h2>
        
     </div></a>
    
     
     
   <?php } //} ?>  
     </div> 
    </div>
    
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
<?php
/*echo $_SESSION["carrier"];
echo $_SESSION["id"];
echo $_SESSION['phone'];*/

$querymemory1 =  "SELECT product.id as productid , product.Description as `productdescription` , product.image_url as `image_url` ,product.Generation as 'pgeneration', product.ProductModel as 'productmodel', productfamily.Name as `familyname` , product.StorageCapacity as 'storagecapacity' from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE productfamily.Name ='".$_SESSION['family']."'";
$resultmemories1 = mysql_query($querymemory1);
//if(isset($_SESSION['generation'])){
	while($resultmemory1 = mysql_fetch_array($resultmemories1)){
?>
     
     <div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">
     <li><a href="<?php echo $base_url; ?>/sell-<?php echo str_replace(" ","-",$resultmemory1['familyname']); ?>-<?php echo str_replace(" ","-",$resultmemory1['pgeneration']); ?>-<?php echo str_replace(" ","-",$resultmemory1['storagecapacity']); ?>/<?php echo $resultmemory1['productid']?>">
      <?php
	 if($resultmemory1['image_url'] != ""){
		 ?>
     <div class="prod_img"><img class="cellimg" alt="Apple iPod image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultmemory1['image_url']; ?>"/></div>      
         <?php
	 }
	 else{
	 ?>
     <img class="fix img-responsive" alt="apple_ipod" src="<?php echo $base_url; ?>/images/ipod.png"/>
       <?php } ?>
         <h4><?php echo $resultmemory1['productdescription'];?></h4><div style="clear:both;"></div>
        
     </a></li>
     </ul>
     </div>
     
   <?php } //} ?>  
     
    </div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
</div>

<div class="row hr-line"></div>
<div class="nomobile">  
<?php
include 'stopoint-press.php';
?>
</div>  
<div class="navmobile" style="display:none">  
<?php
include 'stopoint-press-mobile.php';
?>
</div> 
</div>
<div class="tab-pane fade tab_bg <?php if($_GET['model'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab5">

<!--<div class="row text-center">
<h1 class="sub-heading">Model condition</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model condition</h2>
    <div class="underline1"></div>-->
    <?php
$queryproduct =  "SELECT product.id as productid , product.Description as `productdescription` , product.image_url as `image_url` , product.ProductModel as 'productmodel', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity' , product.GoodPrice as 'GoodPrice' , product.FlawessPrice as 'FlawlessPrice' ,product.brokenno as 'brokenno' , product.brokenyes as 'brokenyes' , product.AcceptablePrice as 'AcceptablePrice' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.id=".$_SESSION['model'];
		if(isset($_SESSION['model'])){
	$resultproducts = mysql_query($queryproduct);
	$resultproduct = mysql_fetch_array($resultproducts);
		}
?>
	<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $resultproduct['productdescription'];?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $resultproduct['productdescription'];?> </h2>
</div>
    <!--<h3 class="Sheading-styleh3">Your Selected model <span style="color:#000;"><?php echo $resultproduct['productdescription'] ;?></span></h3>
</div>--><!-- row --> 

<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

     <div class="nomobile">
     <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
      <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt=" iPod image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     <img class="fix" alt="apple_ipod" src="<?php echo $base_url; ?>/images/ipod.png"/>
       <?php } ?> 
        <h2><?php echo $resultproduct['productdescription'];?></h2>
     </div>
     </div>
     <div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">  
     
      <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <li><a href=""><div class="prod_img"><img class="cellimg" alt=" iPod image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/></div>      
         <?php
	 }
	 else{
	 ?>
     <li><a href=""><div class="prod_img"><img class="cellimg" alt="apple_ipod" src="<?php echo $base_url; ?>/images/ipod.png"/></div>
       <?php } ?> 
        <h4><?php echo $resultproduct['productdescription'];?></h4><div style="clear:both;"></div>
        </a></li>
     </ul>
     </div>
     <div class="col-lg-8 col-md-8 col-sm-8 mcollectdt">
       <h1>What shape is it in?</h1>
       
    	
    
    <div class="radio-group">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 topmargin">
    <input id="choice-c" type="radio" name="g" value="3"/>
        <label for='choice-c'>
            <span></span>
            Broken<span class="plabelp">Has functional or physical problems</span>                          
        </label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 topmargin">
        <input id="choice-a" type="radio" name="g" value="1" />
        <label for='choice-a'>
            <span></span>
            Good<span class="plabelp">Normal signs of use</span>                          
        </label>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 topmargin">
        <input id="choice-b" type="radio" name="g" value="2" style="margin-left: 30%;" checked />
        <label for='choice-b'>
            <span></span>
            Flawless <span class="plabelp">Looks like it's never been used</span>
        </label>
       </div>
    
</div> 

<div id="good3" class="desc" style="margin-top:15%; display:none;">
<p class="device-power">Does the device power on? </p>
   <input id="choice-yes" type="radio" name="gchoice" value="4" style="margin:0 0 0 5px; 0" /><p class="inline mobile-hidden">Yes</p>
   <input id="choice-no" type="radio" name="gchoice" value="5" style="margin:0 0 0 5px; 0" /><p class="inline mobile-hidden">No</p><div class="clearfix"></div>
   </div>
   
    <div id="good4" class="desc" style="display:none;">
   
       <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokenyesform">
   <h2 style="margin-top:0px;"> Your iPod is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>
   
   <br>
	<div>
		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_1" />
		<button type="button" id="coupon_code_btn_1" onclick="applyCouponCode('1','brokenyes')">Apply</button></p>
	</div>
	<div class="alert alert_1" style="display:none">
	</div>
	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_1">$<?php echo $resultproduct['brokenyes']; ?></span>
   <input type="hidden" name="condition" value="brokenyes" />
   <input type="hidden" id="old_price_1" value="<?php echo $resultproduct['brokenyes']; ?>" />
   <input type="hidden" name="price" id="price_1" value="<?php echo $resultproduct['brokenyes']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($resultproduct['brokenyes'] > 0)
  {
	  ?>
   <button type="submit" class="getp-btn">get paid</button>
   <?php } ?>
   </p></div>
   </form>
   
    <?php if($resultproduct['brokenyes'] == 0 || $resultproduct['brokenyes'] == 'NULL' )
  {
	  ?>
      
       <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url ?>/recycling">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      
      <?php
	  }
  ?>
      
    
   </div>
   
   <div id="good5" class="desc" style="display:none;">
      
      <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokennoform">
   <!--<h2 style="margin-top:0px;"> Your iPod is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>-->
   
   <br>
	<div>
		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_2" />
		<button type="button" id="coupon_code_btn_2" onclick="applyCouponCode('2','brokenno')">Apply</button></p>
	</div>
	<div class="alert alert_2" style="display:none">
	</div>
	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_2">$<?php echo $resultproduct['brokenno']; ?></span>
   <input type="hidden" name="condition" value="brokenno" />
   <input type="hidden" id="old_price_2" value="<?php echo $resultproduct['brokenno']; ?>" />
   <input type="hidden" name="price" id="price_2" value="<?php echo $resultproduct['brokenno']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($resultproduct['brokenno'] > 0)
  {
	  ?>
   <button type="submit" class="getp-btn">get paid</button>
   <?php } ?>
   </p></div>
   </form>
   
    <?php if($resultproduct['brokenno'] == 0 || $resultproduct['brokenno'] == 'NULL')
  {
	  ?>
      <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url ?>/recycling">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
   
     <?php } ?>
   </div> 
   <div id="good1" class="desc" style="display:none">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="goodform">
   <h2> Your iPod is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		
   <li>The item shows wear from consistent use, but it remains in good condition and works perfectly.</li>
        <li>It may be marked, have identifying markings on it, or show other signs of previous use.</li>
   </ul>
   
   <br>
	<div>
		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_3" />
		<button type="button" id="coupon_code_btn_3" onclick="applyCouponCode('3','good')">Apply</button></p>
	</div>
	<div class="alert alert_3" style="display:none">
	</div>
	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_3">$<?php echo $resultproduct['GoodPrice']; ?></span>
   <input type="hidden" name="condition" value="good" />
   <input type="hidden" id="old_price_3" value="<?php echo $resultproduct['GoodPrice']; ?>" />
   <input type="hidden" name="price" id="price_3" value="<?php echo $resultproduct['GoodPrice']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($resultproduct['GoodPrice'] > 0)
  {
	  ?>
   <button type="submit" class="getp-btn">get paid</button>
   <?php } ?>
   </p></div>
   </form>
   
    <?php if($resultproduct['GoodPrice'] == 0)
  {
	  ?>
      
      <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url; ?>/recycling" target="_blank">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      
      <?php
	  }
  ?>
   </div>
   
   <div id="good2" class="desc">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="flawlessform">
   <h2> Your iPod is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>An apparently untouched item in perfect condition.</li>
        <li> Original protective wrapping may be missing, but the original packaging is intact and pristine.</li>
        <li>There are absolutely no signs of wear on the item or its packaging. Instructions are included.</li>
        <li>Item is suitable for presenting as a gift.</li>
        
   </ul>
   
   <br>
	<div>
		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_4" />
		<button type="button" id="coupon_code_btn_4" onclick="applyCouponCode('4','Flawless')">Apply</button></p>
	</div>
	<div class="alert alert_4" style="display:none">
	</div>
	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_4">$<?php echo $resultproduct['FlawlessPrice']; ?></span>
   <input type="hidden" name="condition" value="Flawless" />
   <input type="hidden" id="old_price_4" value="<?php echo $resultproduct['FlawlessPrice']; ?>" />
   <input type="hidden" name="price" id="price_4" value="<?php echo $resultproduct['FlawlessPrice']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <!--<form action="checkout2.php" id="checkoutform2" name="checkoutform2" method="post">
   <input type="hidden" name="model" value="<?php //echo $_SESSION['model'] ?>" />
    <input type="hidden" name="carrier" value="<?php //echo $_SESSION['carrier'] ?>" />
     <input type="hidden" name="phone" value="<?php //echo $_SESSION['phone'] ?>" />-->
  <?php if($resultproduct['FlawlessPrice'] >0)
  {
	  ?>
  <button type="submit" class="getp-btn">get paid</button>
  <?php } ?>
  
  </div>
  
  </form>
  <?php if($resultproduct['FlawlessPrice'] == 0)
  {
	  ?>
      
      <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url; ?>/recycling" target="_blank">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      
      <?php
	  }
  ?>
  <!-- </form>-->
   </div>
    <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p> 
    </div>
     
     
    </div>
 	

</div>

<div class="row hr-line"></div>
<div class="nomobile">  
<?php
include 'stopoint-press.php';
?>
</div>  
<div class="navmobile" style="display:none">  
<?php
include 'stopoint-press-mobile.php';
?>
</div>

</div>
<!--Step 5 ENDS-->
<br /><br />
</div>

<?php
include "footer.php";
?>

<!--<script type="text/javascript" src="/js/coupon-code.js"></script> -->

<script>
function applyCouponCode(index,condition){
	var coupon_code = $("#coupon_code_"+index).val();
	var model = $("#model").val();
	
	$.ajax({
		type:"GET",
		url : "/apply-coupon-code.php",
		data : "coupon_code="+coupon_code + "&model="+model + "&condition="+condition + "&index="+index,
		async: false,
		success : function(response) {
			data = response;
			return response;
		},
		error: function() {
			alert('Error occured'+response);
		}
	});
	var price = $("#old_price_"+index).val();
	var arr = data.split(";");
	var status = arr[1];
	if(status == "INVALID"){
		$(".alert_"+index).removeClass("alert-success");
		$(".alert_"+index).addClass("alert-warning display-block");
		$(".alert_"+index).html(arr[2]);
		
		$("#price_text_"+index).html("$" + price);
		$("#price_"+index).val(price);
		
	}else{
		var discount_price = arr[3];
		var after_discount = Math.round(parseFloat(price)+parseFloat(discount_price));
		$(".alert_"+index).removeClass("alert-warning");
		$(".alert_"+index).addClass("alert-success display-block");
		$(".alert_"+index).html(arr[2]);
		
		$("#price_text_"+index).html(price + "+" + Math.round(discount_price) + "=" + after_discount);
		$("#price_"+index).val(after_discount);
	}
}

function removeCouponCode(coupon_code, index, condition){
	var coupon_code = $("#coupon_code_"+index).val();
	var model = $("#model").val();
	
	$.ajax({
		type:"GET",
		url : "/remove-coupon-code.php",
		data : "coupon_code="+coupon_code + "&model="+model + "&condition="+condition + "&index="+index,
		async: false,
		success : function(response) {
			data = response;
			return response;
		},
		error: function() {
			alert('Error occured');
		}
	});
	var price = $("#old_price_"+index).val();
	
	$(".alert_"+index).removeClass("alert-success");
	$(".alert_"+index).addClass("alert-warning display-block");
	$(".alert_"+index).html("Coupon Code removed successfully.");
	
	$("#price_text_"+index).html("$" + price);
	$("#price_"+index).val(price);
}
  $( function() {
	  if($( "#coupon_code" ).val() != ""){
		  var ind = $( "#coupon_code_index" ).val();
		  var cond = $( "#coupon_code_condition" ).val();
		 $("#coupon_code_"+ind).val($( "#coupon_code" ).val());
	     applyCouponCode(ind,cond) 
	  }
	  
  } );
</script>

<script>

$('.coupon_code').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
		var curr_object = $(this);
		var num = curr_object.attr('id');
		if(num != null && num != ""){
			num = num.replace("coupon_code_", "");
			var onclick_attr = $("#coupon_code_btn_" + num).attr('onclick');
			
			if(num != null && num != ""){
				var start_index = onclick_attr.indexOf(",'");
				var end_index = onclick_attr.indexOf("')");
				var cond = onclick_attr.substring(start_index+2, end_index);
				//console.log('You pressed a "enter" key in textbox:' + cond);  
				
				applyCouponCode(num,cond);
			}			
		}
		
        
		
		return false;
    }
});
</script>