<?php
include "header.php";
session_start();
unset($_SESSION['computer']);
if(isset($_GET['id'])){
$_SESSION['id'] = $_GET['id'];
}
 $id = $_SESSION['id'];
 
 //echo $id;
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
<!-- steps --> 

<div class=" step container-fluid">
<div class="container">
<ul class=" step-tab nav nav-justified  tabs">
<?php

 ?>
      <li class="<?php if($_GET['id'] == '' && $_GET['generation'] =='' && $_GET['model'] =='' && $_GET['family'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
     <li class="<?php if($_GET['id'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT  FAMILY</a></li> 
     <li class="<?php if($_GET['family'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab3" <?php if(isset($_SESSION['family'])){?> data-toggle="tab" <?php } ?>><div class="step-no">3</div>SELECT GENERATION</a></li>
      <li class="<?php if($_GET['generation'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4" <?php if(isset($_SESSION['generation'])){?> data-toggle="tab" <?php } ?>><div class="step-no">4</div>SELECT MODEL</a></li>
        
      <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>><div class="step-no">5</div>SELECT CONDITION</a></li>
    </ul>
</div><!-- end container --> 
</div><!-- end container-fluid --> 

<div class="container tab-content">
<!-- row --> 
<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['generation'] ==''  && $_GET['model'] =='' && $_GET['family'] ==''){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">
<!--<div class="row text-center">
<h1 class="sub-heading">BRAND</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR BRAND TO CONTINUE</h2>
    
</div>-->

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your Gadgets for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your Gadgets.</h2>
</div>
<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="port-1">
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 24 ";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        <a href="<?php echo $base_url; ?>/sell/gadgets/<?php echo $resultbrand['brandname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4 col-centered"> 
        <img class="fix img-responsive" alt="TV" src="<?php echo $site_url ?>/images/TV.png"/>
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

<!--Tabs ENDS-->
</div>
<div class="tab-pane fade tab_bg <?php if($_GET['id'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab2">
<!--<div class="row text-center">
<h1 class="sub-heading">FAMILY</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR FAMILY TO CONTINUE</h2>
</div>-->

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your Apple TV for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your Apple TV.</h2>
</div>
<div class="row pad ">
</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active">
     <?php
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage`,productbrand.Name as `brandname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 24 AND productbrand.Name ='".$_SESSION['id']."'";
		
		$resultfamiliess = mysql_query($queryfamilyy);
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <a href="<?php echo $base_url; ?>/sell/gadgets/<?php echo $resultfamilyy['brandname']; ?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4 col-centered">
         <?php 
		if($resultfamilyy['familyimage'] != ""){
			?>
            <img class="fix img-responsive" style="height:179px;" alt="TV" src="<?php echo $site_url ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/>
            <?php
			}
		else{ 
		?> 
       <img class="fix img-responsive" alt="TV" src="<?php echo $site_url ?>/images/TV.png"/>
       <?php }?>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php } ?>
      </div>
    </div>
    </div>
  <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
  </div>

<!--Tabs ENDS-->
</div>
<!--Step 3 Starts-->
<div class="tab-pane fade tab_bg <?php if($_GET['family'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab3">

<!--<div class="row text-center">
<h1 class="sub-heading">GENERATION </h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model GENERATION</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Family <u><?php echo $family ;?></u></h3>
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your Apple TV for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your Apple TV.</h2>
</div>

<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

			<?php
                if($_SESSION["id"] == "Apple"){
            ?>
					<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#appleipodgenerationModal">How to identify your generation?</div>
            <?php
				}
			?>
      		<!--Modal-->
                <div class="modal fade" id="appleipodgenerationModal" role="dialog">
                    <div class="modal-dialog">
                    <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">How to identify your generation?</h4>
                            </div>
                            <div class="modal-body">
                                <div class="section">
                                    <h4> Touch </h4>
                                    <div class="floaters">
                                    	<div class="left floater">
                                            <h5>3rd Generation</h5>
                                            <img alt="Apple_Tv" src="<?php echo $site_url; ?>/images/TV.png">
                                            <p>Rounded metal back, Model A1318</p>
                                    	</div>
                                        <div class="left floater">
                                            <h5>4th Generation</h5>
                                            <img alt="apple_tv" src="<?php echo $site_url; ?>/images/TV.png">
                                            <p>Flat/angled metal back with camera, Model A1367</p>
                                        </div>
                                        <div class="left floater">
                                            <h5>5th Generation</h5>
                                            <img alt="ipod-help-touch-5" src="<?php echo $base_url; ?>/images/ipod_help_touch_5th.png">
                                            <p>Flat back in 5 colors, Model A1421</p>
                                        </div>
                                        <div class="clear"></div>
                                	</div>
                                </div>
                                <div class="section">
                                    <h4> Nano </h4>
                                    <div class="floaters">
                                        <div class="left floater">
                                            <h5>6th Generation</h5>
                                            <img alt="ipod-help-nano-6" src="<?php echo $base_url; ?>/images/ipod_help_nano_6th.png">
                                            <p>Small square with a touchscreen</p>
                                        </div>
                                        <div class="left floater">
                                            <h5>7th Generation</h5>
                                            <img alt="ipod-help-nano-7" src="<?php echo $base_url; ?>/images/ipod_help_nano_7th.png">
                                            <p>Tall, skinny metal housing with a touchscreen</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
          <!--Modal-->

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 generation" style="">
     
     
                            
                            <?php
 $querymemory =  "SELECT DISTINCT product.Generation as 'pgeneration', productfamily.Name as `familyname`,productbrand.Name as `brandname`  from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 24 AND productfamily.Name ='".$_SESSION['family']."'  AND productbrand.Name ='".$_SESSION['id']."' ";


$resultmemories = mysql_query($querymemory);
	while($resultmemory = mysql_fetch_array($resultmemories)){
?>
                            
                                             
                                              
       <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom:1px;"> 
      
       <a href="<?php echo $base_url; ?>/sell/gadgets/<?php echo $resultmemory['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemory['familyname']); ?>/<?php echo $resultmemory['pgeneration']; ?>" class="btn1 btn-custom"> <h2 style="font-size: 15px;"><?php echo $resultmemory['pgeneration']; ?></h2></a>
          
        </div>                              
                                           <?php } ?>
                                        
                                          
                               </select>
     </div>

</div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note :As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
</div>
</div>
<!--Step 3 ENDS-->
<!--Step 4 Starts-->
<div class="tab-pane fade tab_bg <?php if($_GET['generation'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab4">

<!--<div class="row text-center">
<h1 class="sub-heading">Model </h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Generation <u><?php //echo $generation ;?></u></h3>
</div>--><!-- row --> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your Apple TV <?php echo $generation; ?> generation for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your Apple TV <?php echo $generation; ?> generation.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
<?php
/*echo $_SESSION["carrier"];
echo $_SESSION["id"];
echo $_SESSION['phone'];*/

$querymemory1 =  "SELECT product.id as productid  , product.Description as `productdescription`, product.image_url as `image_url` ,product.Generation as 'pgeneration', product.ProductModel as 'productmodel', productfamily.Name as `familyname` , product.StorageCapacity as 'storagecapacity',productbrand.Name as `brandname` from product   INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.Generation ='".$_SESSION['generation']."' AND productfamily.Name ='".$_SESSION['family']."'";
$resultmemories1 = mysql_query($querymemory1);
	while($resultmemory1 = mysql_fetch_array($resultmemories1)){
?>
     <a href="<?php echo $base_url; ?>/sell/gadgets/<?php echo $resultmemory1['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemory1['familyname']); ?>/<?php echo $resultmemory1['pgeneration']; ?>/<?php echo $resultmemory1['productid']?>"><div class="col-lg-3 col-md-3 col-sm-3 portfolio-block col-centered">
     
       <?php
	 if($resultmemory1['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt="gen" src="<?php echo $site_url ?>/productimages/<?php echo $resultmemory1['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     
     <img class="fix img-responsive" alt="TV" src="<?php echo $site_url ?>/images/TV.png"/>
     <?php } ?>
        <h2><?php echo $resultmemory1['productdescription']?></h2>
     </div></a>
     
   <?php } ?>  
     
    </div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note: As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
</div>
</div>
<!--Step 4 ENDS-->
<!--Step 5 Starts-->
<div class="tab-pane fade tab_bg <?php if($_GET['model'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab5">

<!--<div class="row text-center">
<h1 class="sub-heading">Model condition</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model condition</h2>
    <div class="underline1"></div>-->
    <?php
 $queryproduct =  "SELECT product.id as productid , product.Description as `productdescription`, product.image_url as `image_url` , product.ProductModel as 'productmodel', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity' , product.GoodPrice as 'GoodPrice' , product.FlawessPrice as 'FlawlessPrice' , product.brokenno as 'brokenno' , product.brokenyes as 'brokenyes' , product.AcceptablePrice as 'AcceptablePrice' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.id=".$_SESSION['model'];
		
	$resultproducts = mysql_query($queryproduct);
	$resultproduct = mysql_fetch_array($resultproducts);
?>
   <!-- <h3 class="Sheading-styleh3">Your Selected model is <span style="color:#000;"><?php //echo $family ;?></span> <span style="color:#000;"><?php //echo $generation ;?></span> <span style="color:#000;"> <?php //echo $resultproduct['storagecapacity']; ?> (WiFi) </span></h3>
</div>--><!-- row --> 
 <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $resultproduct['productdescription']; ?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your Apple TV <?php echo $resultproduct['productdescription']; ?>.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

     <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt="TV image" src="<?php echo $site_url ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     <img class="fix" alt="apple tv" src="<?php echo $site_url ?>/images/TV.png"/>
       <?php } ?>
        <h2><?php echo $resultproduct['productdescription'];?></h2>
     </div>
     <div class="col-lg-8 col-md-8 col-sm-8 mcollectdt">
       <h1>What shape is it in?</h1>
    <div class="radio-group">
     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 topmargin">
    <input id="choice-c" type="radio" name="g" value="3"/>
        <label for='choice-c'>
            <span></span>
            Broken<span class="plabelp">Visible signs of use</span>                          
        </label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 topmargin">
        <input id="choice-a" type="radio" name="g" value="1"  checked/>
        <label for='choice-a'>
            <span></span>
            Good<span class="plabelp">Visible signs of use</span>                          
        </label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 topmargin">
        <input id="choice-b" type="radio" name="g" value="2" style="margin-left: 30%;"/>
        <label for='choice-b'>
            <span></span>
            Flawless <span class="plabelp">Looks like it's never been used</span>
        </label>
        </div>
</div> 

 <div id="good3" class="desc" style="margin-top:15%; display:none;">
 Does the phone device on? 
   <input id="choice-yes" type="radio" name="gchoice" value="4" style="margin:0 0 0 5px; 0" />Yes
   <input id="choice-no" type="radio" name="gchoice" value="5" style="margin:0 0 0 5px; 0" />No
   </div>
   
   <div id="good4" class="desc" style="display:none;">
   
      <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokenyesform">
   <h2> Your Gadget is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span>$<?php echo $resultproduct['brokenyes']; ?></span>
   <input type="hidden" name="condition" value="brokenyes" />
   <input type="hidden" name="price" value="<?php echo $resultproduct['brokenyes']; ?>" />
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
   <!--<h2> Your Gadget is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>-->
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span>$<?php echo $resultproduct['brokenno']; ?></span>
   <input type="hidden" name="condition" value="brokenno" />
   <input type="hidden" name="price" value="<?php echo $resultproduct['brokenno']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($resultproduct['brokenno'] > 0)
  {
	  ?>
   <button type="submit" class="getp-btn">get paid</button>
   <?php } ?>
   </p></div>
   </form>
   
    <?php if($resultproduct['brokenno'] == 0 || $resultproduct['brokenyes'] == 'NULL')
  {
	  ?>
      <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url ?>/recycling">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
   
     <?php } ?>
   </div>  
      <div id="good1" class="desc">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="goodform">
   <h2> Your gadget is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>An apparently untouched item in perfect condition.</li>
        <li> Original protective wrapping may be missing, but the original packaging is intact and pristine.</li>
        <li>There are absolutely no signs of wear on the item or its packaging. Instructions are included.</li>
        <li>Item is suitable for presenting as a gift.</li>
   </ul>
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span>$<?php echo $resultproduct['GoodPrice']; ?></span>
   <input type="hidden" name="condition" value="good" />
   <input type="hidden" name="price" value="<?php echo $resultproduct['GoodPrice']; ?>" />
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
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item</p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url; ?>/recycling" target="_blank">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      <?php
	  }
  ?>
   </div>
   
   <div id="good2" class="desc" style="display:none;">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="flawlessform">
   <h2> Your gadget is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>The item shows wear from consistent use, but it remains in good condition and works perfectly.</li>
        <li>It may be marked, have identifying markings on it, or show other signs of previous use.</li>
        
   </ul>
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span>$<?php echo $resultproduct['FlawlessPrice']; ?></span>
   <input type="hidden" name="condition" value="Flawless" />
   <input type="hidden" name="price" value="<?php echo $resultproduct['FlawlessPrice']; ?>" />
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
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item</p>
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
<!--Step 5 ENDS-->
<br /><br />
</div>
</div>
<?php
include "footer.php";
?>