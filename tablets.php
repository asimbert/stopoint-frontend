<?php

//ini_set("display_errors", "1");
//error_reporting(E_ALL);

include "header.php";
session_start();
unset($_SESSION['computer']);
if(isset($_GET['ps'])){
	 $_SESSION['id'] = mysql_real_escape_string($_GET['id']);
	  $id = $_SESSION['id'];
 $_SESSION['family'] = mysql_real_escape_string($_GET['family']);
  $family = $_SESSION['family'];
	
	}
if(isset($_GET['id'])){
$_SESSION['id'] = $_GET['id'];
}
 $id = $_SESSION['id'];
 if(isset($_GET['phone'])){
  $_SESSION["phone"] = $_GET['phone'];
 }
 $phone = $_SESSION["phone"];
 
 if(isset($_GET['carrier'])){
	 if($_GET['carrier'] == "ATandT"){
		 $_GET['carrier'] = 'AT&T';
		 }
 $_SESSION["carrier"] = $_GET['carrier'];
 }
 if(isset($_GET['family'])){
  $_SESSION["family"] = $_GET['family'];
 
 }
$family = $_SESSION["family"];
 if(isset($_GET['generation'])){
	 if($_GET['generation'] == "generation"){
		 $_GET['generation'] = 'generation';
		 }
 $_SESSION["generation"] = $_GET['generation'];
 $generation = $_SESSION["generation"];
 }
 
 $carrier = $_SESSION["carrier"];
 
 if(isset($_GET['model'])){
  $_SESSION["model"] = $_GET['model'];
 
 }
$model = $_SESSION["model"];

?>
<!-- steps --> 
<img class="display-none" src="https://stopoint.com/assets/images/yes.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/no.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/yes-focus.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/no-focus.png" style="visibility: hidden;">
<input type="hidden" id="model" value="<?php echo $model; ?>" />
<input type="hidden" id="coupon_code" value="<?php echo isset($_SESSION['coupon_code'])?$_SESSION['coupon_code']:""; ?>" />
<input type="hidden" id="coupon_code_index" value="<?php echo isset($_SESSION['coupon_code_index'])?$_SESSION['coupon_code_index']:""; ?>" />
<input type="hidden" id="coupon_code_condition" value="<?php echo isset($_SESSION['coupon_code_condition'])?$_SESSION['coupon_code_condition']:""; ?>" />

<div class=" step container-fluid">
<div class="container">
<ul class=" step-tab nav nav-justified  tabs">
<?php

 ?>
      <li class="<?php if($_GET['id'] == ''  && $_GET['model'] =='' && $_GET['carrier'] =='' && $_GET['family'] =='' && $_GET['generation'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
    
      <li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT FAMILY</a></li>
    <?php
	if($_SESSION['id'] == 'Apple'){
	 ?>
      <li class="<?php if($_GET['id'] != '' && $_GET['ps']!=''){echo 'active';} elseif ($_GET['family'] != ''){ echo 'active' ;} else { echo '' ;}?>"><a href="#tab3" <?php if(isset($_SESSION['family'])){?> data-toggle="tab" <?php } ?>><div class="step-no">3</div>SELECT GENERATION</a></li>
    <?php } ?>
      <li class="<?php if($_GET['generation'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4"  <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?> ><div class="step-no">3</div>SELECT CARRIER</a></li>
    
      <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5"  <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?> ><div class="step-no">4</div>WHAT SHAPE IS</a></li>
    </ul>
</div><!-- end container --> 
</div><!-- end container-fluid --> 

<div class="container tab-content">
<!-- row --> 
<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['model'] =='' && $_GET['family'] =='' && $_GET['carrier'] =='' && $_GET['generation'] ==''){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">


<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell Your Tablet for Cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your tablet.</h2>
</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active nomobile" id="port-1">
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.CategoryId = 3 ";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        <a href="<?php echo $base_url; ?>/sell/tablet/<?php echo $resultbrand['brandname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <?php
		if($resultbrand['brandname'] == "Apple"){
		 ?>
        <img class="fix img-responsive" style="height:179px;"  alt="gen" src="<?php echo $base_url; ?>/productimages/iPadAir.png"/>
        <?php }
		else if($resultbrand['brandname'] == "Samsung"){
		 ?>
         <img class="fix img-responsive" style="height:179px;" alt="gen" src="<?php echo $base_url; ?>/productimages/GalaxyTab4.png"/>
         <?php }
		 else if($resultbrand['brandname'] == "Google"){
		 ?>
         <img class="fix img-responsive" style="height:179px;" alt="gen" src="<?php echo $base_url; ?>/productimages/Nexus9.png"/>
         <?php }
		 
		 else if($resultbrand['brandname'] == "Microsoft"){
		 ?>
         <img class="fix img-responsive" style="height:179px;" alt="gen" src="<?php echo $base_url; ?>/productimages/SurfacePro.png"/>
         <?php }
		  ?>
        <h2><?php echo $resultbrand['brandname']; ?></h2>
          
        </div></a>
       <?php } ?>

      </div>
      
      <div class="tab-pane fade in active navmobile" style="display:none;" id="port-1">
       <ul class="nav nav-tabs nav-stacked">  
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.CategoryId = 3 ";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        <li><a href="<?php echo $base_url; ?>/sell/tablet/<?php echo $resultbrand['brandname']; ?>">
        <?php
		if($resultbrand['brandname'] == "Apple"){
		 ?>
       
        <?php }
		else if($resultbrand['brandname'] == "Samsung"){
		 ?>
         
         <?php }
		 else if($resultbrand['brandname'] == "Google"){
		 ?>
         
         <?php }
		 
		 else if($resultbrand['brandname'] == "Microsoft"){
		 ?>
         
         <?php }
		  ?>
        <h4><?php echo $resultbrand['brandname']; ?></h4>
          
        </a></li>
       <?php } ?>
</ul>  
</div>
      </div>
     
    
    </div>
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
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
 
  
<div class="<?php if($_GET['id'] != ''  &&  $_GET['ps']==''){ echo 'tab-pane fade tab_bg active in' ;} elseif($_GET['ps']!='' && $_GET['id'] != '' && $_GET['family'] !=''){echo 'tab-pane fade tab_bg' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab2">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell Your <?php echo $id ;?> Tablet for Cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $id ;?> tablet.</h2>
</div>
<div class="row pad ">



</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
    <!-- Tab panes -->
    
   			<?php
                if($_SESSION["id"] == "Microsoft"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#microsoftipadfamilyModal">Which version do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="microsoftipadfamilyModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which version do I have?</h4>
						</div>
						<div class="modal-body">
                            Surface RT runs Windows RT operating system and comes in 32 or 64GB.
                            <br>
                            Surface Pro runs Windows 8 Pro, comes in 64 or 128GB and includes a stylus.  
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
			
			<?php
                if($_SESSION["id"] == "Google"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#googleipadfamilyModal">Which model do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="googleipadfamilyModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which model do I have?</h4>
						</div>
						<div class="modal-body">
                            The Nexus 7 has a 7" screen and has "Asus" branding on the back.
                            <br>
                            The Nexus 10 has a 10" screen and has "Samsung" branding on the back.
                            <br>
                            The Nexus 4 phone can be found under LG cell phones.   
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
			
			<?php
                if($_SESSION["id"] == "Samsung"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#samsungipadfamilyModal">Which version do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="samsungipadfamilyModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which version do I have?</h4>
						</div>
						<div class="modal-body">
                            You can identify your tablet by referring to the model number in the Settings menu.
                            <br>
                            -The Galaxy Tab 2 has a 7" or 10.1" screen and was released in 2012. It is model GT-P3110, GT-P5113, SCH-i705, SCH-i915, SPH-P500 or SGH-i497.
<br>
                            -The Galaxy Note has a 10.1" screen and includes a stylus. It is model SCH-i925 or GT-N8013.
                            <br>
                            <br>
                            Please note that we do not accept first generation Galaxy Tabs.  
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
			
			<?php
                if($_SESSION["id"] == "Apple"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#appleipadfamilyModal">Which iPad do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="appleipadfamilyModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which iPad do I have?</h4>
						</div>
						<div class="modal-body">
                            Identify your iPad by referring to the model number printed on the back of the device.
                            <br>
                            <br>
                            <strong>iPad Mini</strong>
                            <br>
                            <strong>iPad Mini:</strong>
                            Model A1455, A1454, or A1432 (7.9" screen)
                            <br>
                            <strong>iPad Mini Retina Display:</strong>
                            Model A1489 or A1490 (7.9" retina screen)
                            <br>
                            <br>
                            <strong>iPad Air</strong>
                            <br>
                            <strong>1st generation:</strong>
                            Model A1474 or A1475 (lightning connector and thin bezel)
                            <br>
                            <br>
                            <strong>iPad</strong>

                            <br>
                            <strong>1st generation:</strong>
                            Model A1337 or A1219 (no camera)
                            <br>
                            <strong>2nd generation:</strong>
                            Model A1396, A1397, or A1395 (camera and 30-pin connector)
                            <br>
                            <strong>3rd generation:</strong>
                            Model A1430, A1403 or A1416 (Siri, HD camera, 30-pin connector)
                            <br>
                            <strong>4th generation:</strong>
                            Model A1460, A1459, or A1458 (retina display and lighting connector) 
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
    
    <div class="tab-content">
      <div class="tab-pane fade in active nomobile">
      <?php 
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname` ,productbrand.Name as `brandname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."'";
		
		$resultfamiliess = mysql_query($queryfamilyy);
		
		$mdname = $resultfamilyy['familyname'];
		if(isset($_SESSION['id'])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <a href="<?php echo $base_url; ?>/sell/tablet/<?php echo str_replace(" ","-",$resultfamilyy['brandname']);  ?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4 col-centered"> 
        <?php
		if($resultfamilyy['familyimage'] != ""){
			?>
            <img class="fix img-responsive" style="height:179px;" alt="<?php echo $resultfamilyy['familyimage']; ?>" src="<?php echo $base_url; ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/>
            <?php
			}
		else{ 
		?>
        <img class="fix img-responsive" alt="gen" src="<?php echo $base_url; ?>/images/gen.png"/>
        <?php } ?>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
        </div></a>
        <?php } } ?>
      </div>
      
      <div class="tab-pane fade in active navmobile" style="display:none;">
      <ul class="nav nav-tabs nav-stacked">  
      <?php 
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname` ,productbrand.Name as `brandname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."'";
		
		$resultfamiliess = mysql_query($queryfamilyy);
		
		$mdname = $resultfamilyy['familyname'];
		if(isset($_SESSION['id'])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <li><a href="<?php echo $base_url; ?>/sell/tablet/<?php echo str_replace(" ","-",$resultfamilyy['brandname']);  ?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>">
        <?php
		if($resultfamilyy['familyimage'] != ""){
			?>
            
            <?php
			}
		else{ 
		?>
        <?php } ?>
        <h4><?php echo $resultfamilyy['familyname']; ?></h4>
        </a></li>
        <?php } } ?>
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
<div class="tab-pane fade tab_bg <?php if($_GET['family'] != '' && $_SESSION['id'] == 'Apple' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab3">


<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell Your <?php echo $id ;?> <?php echo $family ;?> Tablet for Cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $id ;?> <?php echo $family ;?> tablet </h2>
</div>
<div class="row pad ">



</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    <!-- Tab panes -->
    
     <?php


 $queryfamilyy = "SELECT DISTINCT product.Generation as 'pgeneration',productfamily.Name as 'familyname',productbrand.Name as 'brandname' from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."' AND productfamily.Name='".$_SESSION['family']."'";
		
		$resultfamiliess = mysql_query($queryfamilyy);
		
		//$mdname = $resultfamilyy['familyname'];
		if(isset($_SESSION['family'])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
?>

 <a href="<?php echo $base_url; ?>/sell/tablet/<?php echo str_replace(" ","-",$resultfamilyy['brandname']);  ?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>/<?php echo str_replace(" ","-",$resultfamilyy['pgeneration']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <img class="fix img-responsive" style="height:179px;" alt="gen" src="<?php echo $base_url; ?>/images/gen.png"/>
        <h2><?php echo $resultfamilyy['pgeneration']; ?></h2>
          
        </div></a>
        <?php } }?>
    
    
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
<?php
/*$carrier_filtered_q = "SELECT DISTINCT carriers.Name as carrier_name from product 
	INNER JOIN `carriers` ON carriers.id=product.CarrierId 
	INNER JOIN `productfamily` ON productfamily.id=product.FamilyId 
	INNER JOIN `productbrand` ON productbrand.id=product.BrandId 
WHERE 
	product.CategoryId = 3 AND 
	productbrand.Name ='".$id."' AND 
	productfamily.Name like'%".$family."%' AND 
	product.Generation='".$generation."'";*/
	
$carrier_filtered_q = "SELECT DISTINCT carriers.Name as carrier_name from product 
	INNER JOIN `carriers` ON carriers.id=product.CarrierId 
	INNER JOIN `productfamily` ON productfamily.id=product.FamilyId 
	INNER JOIN `productbrand` ON productbrand.id=product.BrandId 
WHERE 
	product.CategoryId = 3 AND 
	productbrand.Name ='".$id."' AND 
	productfamily.Name ='".$family."' AND 
	product.Generation='".$generation."'";	
	
$carrier_filtered_r = mysql_query($carrier_filtered_q);	
?>

<!--Step 3 Starts-->
<?php
if(($_SESSION['id'] == 'Google' || $_SESSION['id'] == 'Samsung' || $_SESSION['id'] == 'Microsoft')  && isset($_GET['family'])){
 ?>
<div class="tab-pane fade tab_bg <?php  echo 'active in' ?>" id="tab4">


<!--<div class="row text-center">
<h1 class="sub-heading">SELECT CARRIER </h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR CARRIER TO CONTINUE</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3"> Your Selected Brand <span style="color:#000;"><?php //echo $id ;?></span> AND Your Selected Family <span style="color:#000;"><?php //echo $family ;?></span>&nbsp;AND Your Selected Generation <span style="color:#000;"><?php //echo $generation ;?></span></h3>
    
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell Your <?php echo $id ;?> <?php echo $family ;?> Tablet for Cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $id ;?> <?php echo $family ;?> tablet.</h2>
</div>
<div class="row pad">
<div class="nomobile">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

	<?php
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>
			<?php
			if($carrier_name === "AT&T"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $base_url; ?>/images/atandt.png" style="cursor:pointer;" class="fix img-responsive" id="AT&T" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "WiFi"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $base_url; ?>/images/wifi.png" style="cursor:pointer;" class="fix img-responsive" id="WiFi" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "T-Mobile"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $base_url; ?>/images/tmobile.png" style="cursor:pointer;" class="fix img-responsive" id="T-Mobile" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Sprint"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $base_url; ?>/images/sprint.png" style="cursor:pointer;" class="fix img-responsive" id="Sprint" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Unlocked"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $base_url; ?>/images/funlock.png" style="cursor:pointer;" class="fix img-responsive" id="Unlocked" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Verizon"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $base_url; ?>/images/Verizon_Logo.png" style="cursor:pointer;" class="fix img-responsive" id="Verizon" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
	<?php
		}
		
	?>	
</div>
</div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<div class="tab-pane fade in active navmobile" style="display:none;">
        <ul class="nav nav-tabs nav-stacked">  
    <?php
		$carrier_filtered_r = mysql_query($carrier_filtered_q);
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>
		<?php
		if($carrier_name === "AT&T"){
		?>
			<li><a id="AT&T" onClick="reply_click(this.id)"><h4>AT&amp;T</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "WiFi"){
		?>
			<li><a id="WiFi" onClick="reply_click(this.id)"><h4>WiFi</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "T-Mobile"){
		?>
			<li><a id="T-Mobile" onClick="reply_click(this.id)"><h4>T Mobile</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Sprint"){
		?>
			<li><a id="Sprint" onClick="reply_click(this.id)"><h4>Sprint</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Unlocked"){
		?>
			<li><a id="Unlocked" onClick="reply_click(this.id)"><h4>Unlocked</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Verizon"){
		?>
			<li><a id="Verizon" onClick="reply_click(this.id)"><h4>Verizon</h4></a></li>
		<?php
		}
		?>
	<?php
		}
	?>
         
    </ul>
    </div>
</div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="ajximg" style="display:block;"></div>
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
<?php } 
else if($_SESSION['id'] == 'Apple' && $_GET['generation'] != ""){
?>
<div class="tab-pane fade tab_bg <?php  echo 'active in' ?>" id="tab4">

<!--<div class="row text-center">
<h1 class="sub-heading">SELECT CARRIER </h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR CARRIER TO CONTINUE</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3"> Your Selected Brand <span style="color:#000;"><?php echo $id ;?></span> AND Your Selected Family <span style="color:#000;"><?php echo $family ;?></span>&nbsp;AND Your Selected Generation <span style="color:#000;"><?php echo $generation ;?></span></h3>
    
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell Your <?php echo $id ;?> <?php echo $family ;?> <?php echo $generation ;?> Tablet for Cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $id ;?> <?php echo $family ;?> <?php echo $generation ;?> tablet.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<div class="nomobile">
	<?php
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>
			<?php
			if($carrier_name === "AT&T"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $site_url; ?>/images/atandt.png" style="cursor:pointer;" class="fix img-responsive" id="AT&T" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "WiFi"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $site_url; ?>/images/wifi.png" style="cursor:pointer;" class="fix img-responsive" id="WiFi" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "T-Mobile"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $site_url; ?>/images/tmobile.png" style="cursor:pointer;" class="fix img-responsive" id="T-Mobile" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Sprint"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $site_url; ?>/images/sprint.png" style="cursor:pointer;" class="fix img-responsive" id="Sprint" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Unlocked"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $site_url; ?>/images/funlock.png" style="cursor:pointer;" class="fix img-responsive" id="Unlocked" alt="carrier" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Verizon"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
					 <img src="<?php echo $site_url; ?>/images/Verizon_Logo.png" style="cursor:pointer;" class="fix img-responsive" id="Verizon" onClick="reply_click(this.id)">
				</div>
			<?php
			}
			?>
	<?php
		}
		
	?>

    
    
       
    
    
</div>
  <div class="tab-pane fade in active navmobile" style="display:none;">
        <ul class="nav nav-tabs nav-stacked">  
	<?php
		$carrier_filtered_r = mysql_query($carrier_filtered_q);
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>
		<?php
		if($carrier_name === "AT&T"){
		?>
			<li><a id="AT&T" onClick="reply_click(this.id)"><h4>AT&amp;T</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "WiFi"){
		?>
			<li><a id="WiFi" onClick="reply_click(this.id)"><h4>WiFi</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "T-Mobile"){
		?>
			<li><a id="T-Mobile" onClick="reply_click(this.id)"><h4>T Mobile</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Sprint"){
		?>
			<li><a id="Sprint" onClick="reply_click(this.id)"><h4>Sprint</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Unlocked"){
		?>
			<li><a id="Unlocked" onClick="reply_click(this.id)"><h4>Unlocked</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Verizon"){
		?>
			<li><a id="Verizon" onClick="reply_click(this.id)"><h4>Verizon</h4></a></li>
		<?php
		}
		?>
	<?php
		}
	?>         
    </ul>
    </div>
</div>
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="ajximg" style="display:block;"></div>
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
<?php } ?>
<div class="tab-pane fade tab_bg <?php if($_GET['model'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab5">


<?php
 $queryproduct =  "SELECT product.id as productid , product.Description as `productdescription` , product.image_url as `image_url`, product.ProductModel as 'productmodel',product.Generation as 'generation', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity' , product.GoodPrice as 'GoodPrice' , product.FlawessPrice as 'FlawlessPrice' ,product.brokenno as 'brokenno' , product.brokenyes as 'brokenyes' ,  carriers.Name as 'CarrierName' , product.AcceptablePrice as 'AcceptablePrice' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.id=".$_SESSION['model'];
		
	$resultproducts = mysql_query($queryproduct);
	if(isset($_SESSION['model'])){
	$resultproduct = mysql_fetch_array($resultproducts);
	}
?>

<!--<div class="row text-center">
<h1 class="sub-heading">Model condition</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model condition</h2>
    
    <h3 class="Sheading-styleh3">Your Selected model is <span style="color:#000;"><?php //echo $family;?></span> <span style="color:#000;"><?php //echo $resultproduct['storagecapacity']; ?></span> <span style="color:#000;"><?php //echo $resultproduct['generation'];?></span> <span style="color:#000;">(<?php //echo $resultproduct['CarrierName'];?>)</span></h3>
    
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;"><?php echo str_replace('"', ' inches',$resultproduct['productdescription']);?></h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo str_replace('"', ' inches', $resultproduct['productdescription']) ;?></h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<div class="nomobile">
     <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
     
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt="gen" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     <img class="fix img-responsive" alt="gen image" src="<?php echo $base_url; ?>/images/gen.png"/>
       <?php } ?>  
     <h2> <?php echo str_replace('"', ' inches',$resultproduct["productdescription"]);?></h2>
        
     </div>
     </div>
     <div class="tab-pane fade in active navmobile" style="display:none;">
        <ul class="nav nav-tabs nav-stacked">  
     
     
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <li><a href=""> <div class="prod_img"><img class="cellimg" style="height:179px;" alt="gen" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/></div>      
         <?php
	 }
	 else{
	 ?>
     <li><a href=""> <div class="prod_img"><img class="cellimg" alt="gen image" src="<?php echo $base_url; ?>/images/gen.png"/></div>
       <?php } ?>  
     <h4> <?php echo str_replace('"', ' inches',$resultproduct["productdescription"]);?></h4>
        <div style="clear:both;"></div></a>
         </li>
     
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
   <p class="device-power">Does the phone device on? </p>
   <input id="choice-yes" type="radio" name="gchoice" value="4" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">YES</p>
   <input id="choice-no" type="radio" name="gchoice" value="5" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">NO</p><div class="clearfix"></div>
   </div>
   
   <div id="good4" class="desc" style="display:none;">
   
       <form action="<?php echo $base_url; ?>/checkout2" method="post" name="brokenyesform">
   <h2 style="margin-top:0px;"> Your tablet is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>
   <br>
   <div>
		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code_1" id="coupon_code_1" />
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
      
       <form action="<?php echo $base_url; ?>/checkout2" method="post" name="brokennoform">
   <h2 style="margin-top:0px;"> Your tablet is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>
   
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
   <form action="<?php echo $base_url; ?>/checkout2" method="post" name="goodform">
   <h2> Your tablet is in this condition if any of the following are true:</h2>
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
   <form action="<?php echo $base_url; ?>/checkout2" method="post" name="flawlessform">
   <h2> Your tablet is in this condition if any of the following are true:</h2>
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