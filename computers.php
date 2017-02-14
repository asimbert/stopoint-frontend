<?php
include "header.php";
session_start();
if(isset($_GET['ps'])){
	 $_SESSION['id'] = mysql_real_escape_string($_GET['id']);
	  $id = $_SESSION['id'];
 $_SESSION['specification'] = mysql_real_escape_string($_GET['specification']);
  $family = $_SESSION['specification'];
	
	}


if(isset($_GET['id'])){
$_SESSION['id'] = $_GET['id'];
}
 $id = $_SESSION['id'];
 
 //echo $id;
 if(isset($_GET['model'])){
  $_SESSION["model"] = $_GET['model'];
 }
 $computer = $_SESSION["model"];
 
 if(isset($_GET['specification'])){
 $_SESSION["specification"] = $_GET['specification'];
 }
 
 $specification = $_SESSION["specification"];
 
 if(isset($_GET['computer'])){
  $_SESSION["computer"] = $_GET['computer'];
 
 }
$model = $_SESSION["computer"];

//echo $model;
$_SESSION['process'] = mysql_real_escape_string($_GET['process']);
$process=$_SESSION['process'];
//echo $process;
$_SESSION['screen'] = mysql_real_escape_string($_GET['screen']);
$screen=$_SESSION['screen'].'"';
//echo $screen;

?>
<style type="text/css">
@media only screen and (max-width:736px) {
	.mcollectdt label, p.pradio span {
    font-size: 14px !important;
	}
	input#choice-c, input#choice-b, input#choice-a, input#choice-al, input#choice-bl {
    width: 20px!important;
    height: 20px!important;
	}
}
</style>
<!-- steps --> 
<img class="display-none" src="https://stopoint.com/assets/images/yes.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/no.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/yes-focus.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/no-focus.png" style="visibility: hidden;">
<input type="hidden" id="model" value="<?php echo $computer; ?>" />
<input type="hidden" id="coupon_code" value="<?php echo isset($_SESSION['coupon_code'])?$_SESSION['coupon_code']:""; ?>" />
<input type="hidden" id="coupon_code_index" value="<?php echo isset($_SESSION['coupon_code_index'])?$_SESSION['coupon_code_index']:""; ?>" />
<input type="hidden" id="coupon_code_condition" value="<?php echo isset($_SESSION['coupon_code_condition'])?$_SESSION['coupon_code_condition']:""; ?>" />

<div class=" step container-fluid">
<div class="container">
<ul class=" step-tab nav nav-justified  tabs">
<?php

 ?>
      <li class="<?php if($_GET['id'] == '' && $_GET['specification'] =='' && $_GET['computer'] =='' && $_GET['model'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
    
     <li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT FAMILY</a></li> 
    
     <li class="<?php if($_GET['id'] != '' && $_GET['ps']!=''){echo 'active';} elseif ($_GET['specification'] != ''){ echo 'active' ;} else { echo '' ;}?>"><a href="#tab3"  <?php if(isset($_SESSION['specification'])){?> data-toggle="tab" <?php } ?> ><div class="step-no">3</div>SPECIFICATIONS</a></li>
    
      <li class="<?php if($_GET['computer'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4" <?php if(isset($_SESSION['computer'])){?> data-toggle="tab" <?php } ?>><div class="step-no">4</div>SELECT MODEL</a></li>
        
      <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>><div class="step-no">5</div>SELECT CONDITION</a></li>
    </ul>
</div><!-- end container --> 
</div><!-- end container-fluid --> 

<div class="container tab-content">
<!-- row --> 
<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['specification'] ==''  && $_GET['computer'] =='' && $_GET['model'] ==''){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your computers for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">Fast payment, Fair prices, Free shipping.</h2>
</div>
<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
    <!-- Tab panes -->
    <div class="tab-content">
       <div class="tab-pane fade in active navmobile" style="display:none;" id="port-1">
      <ul class="nav nav-tabs nav-stacked">  
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        <li><a href="<?php echo $base_url; ?>/sell/computers/<?php echo $resultbrand['brandname']; ?>">
        <?php
		if($resultbrand['brandname'] == 'Microsoft'){ ?>
		 
		<?php }
		else{
		 ?>
       
        <?php } ?>
        <h4><?php echo $resultbrand['brandname']; ?></h4>
          
       </a></li>
       <?php } ?>
</ul>
      </div>
      
      
      <div class="tab-pane fade in active nomobile" id="port-1">
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        <a href="<?php echo $base_url; ?>/sell/computers/<?php echo $resultbrand['brandname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <?php
		if($resultbrand['brandname'] == 'Microsoft'){ ?>
		 <img class="fix img-responsive" src="<?php echo $base_url; ?>/images/SurfaceBook.png" alt="MacBook Pro"/>	
		<?php }
		else{
		 ?>
        <img class="fix img-responsive" src="<?php echo $base_url; ?>/images/macbook-pro.jpg" alt="MacBook Pro"/>
        <?php } ?>
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
 
  

<div class="<?php if($_GET['id'] != ''  &&  $_GET['ps']==''){ echo 'tab-pane fade tab_bg active in' ;} elseif($_GET['ps']!='' && $_GET['id'] != '' && $_GET['specification'] !=''){echo 'tab-pane fade tab_bg' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab2">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $_SESSION['id']; ?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">Fast payment, Fair prices, Free shipping.</h2>
</div>
<div class="row pad ">



</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    <!-- Tab panes -->
    <div class="tab-content">
         <div class="tab-pane fade in active nomobile">
      <?php //if($_SESSION["id"] == "Apple"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname` , productfamily.image_url as `familyimage`,productbrand.Name as `brandname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND productbrand.Name='".$_SESSION['id']."'";
	//	}
		$resultfamiliess = mysql_query($queryfamilyy);
		
		if(isset($_SESSION["id"])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
	
		?>
        <a href="<?php echo $base_url; ?>/sell/computers/<?php echo $resultfamilyy['brandname']; ?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <?php
		if($resultfamilyy['familyimage'] != ""){
			?>
            <img class="fix img-responsive" style="height:179px;" alt="image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/>
            <?php
			}
		else{ 
		?>
        <img class="fix img-responsive" height="179px;" alt="macbook-pro" src="<?php echo $base_url; ?>/images/macbook-pro.jpg"/>
        <?php } ?>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php }} ?>
      </div>
     
      <div class="tab-pane fade in active navmobile" style="display:none;">
        <ul class="nav nav-tabs nav-stacked">  
      <?php //if($_SESSION["id"] == "Apple"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname` , productfamily.image_url as `familyimage`,productbrand.Name as `brandname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND productbrand.Name='".$_SESSION['id']."'";
	//	}
		$resultfamiliess = mysql_query($queryfamilyy);
		
		if(isset($_SESSION["id"])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
	
		?>
        <li><a href="<?php echo $base_url; ?>/sell/computers/<?php echo $resultfamilyy['brandname']; ?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>">
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
        <?php }} ?>
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
<!--Tabs ENDS-->
</div>


<!--Step 3 Starts-->
<div class="tab-pane fade tab_bg <?php if($_GET['specification'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab3">

<!--<div class="row text-center">

<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model Specification</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Brand is <span style="color:#000;"><?php echo $id; ?></span> AND Your Selected Family <span style="color:#000;"><?php echo $specification ;?></span></h3>
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $id; ?> <?php echo $specification ;?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">Fast payment, Fair prices, Free shipping.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<div class="col-lg-4 col-md-4 col-sm-4" id="screensize">

			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#MacModal">How to find your system specifications?</div>
      		<!--Modal-->
			<div class="modal fade" id="MacModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">How to find your system specifications?</h4>
						</div>
						<div class="modal-body">
							<div class="section">
                            	<h4> Step 1 </h4>
                                <p> Click the Apple button in the upper left corner and choose 'About this Mac.' </p>
                                <img alt="Mac-help-step1" src="<?php echo $base_url; ?>/images/specificaton_step1.png">
                                <div class="clear"></div>
                            </div>
                            <div class="section">
                            	<h4> Step 2 </h4>
                                <p> If you are running OS X Mavericks or earlier, click on 'More Info'. Otherwise skip to step 3.' </p>
                                <img alt="Mac-help-step2" src="<?php echo $base_url; ?>/images/specificaton_step2.png">
                                <div class="clear"></div>
                            </div>
                            <div class="section">
                            	<h4> Step 3 </h4>
                                <p> Here you will find details about your Macbook, including the screen size, processor type, and model year. </p>
                                <div class="multi-image-column">
                                <img alt="Mac-help-step3" style="float:right; margin-right: 15px;" src="<?php echo $base_url; ?>/images/specificaton_step3-1.png">
                                <img width="215" alt="Mac-help-step23-yosemite" style="float:right; margin-top:10px; margin-right: 15px;" src="<?php echo $base_url; ?>/images/specificaton_step3-2.png">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="section">
                            	<h4> Step 4 </h4>
                                <p> Click 'System Report' for additional specifications such as model identifier. Click 'Storage' to find hard drive capacity (round up to the closest option.)</p>
                                <div class="multi-image-column">
                                <img alt="Mac-help-step4" src="<?php echo $base_url; ?>/images/specificaton_step4-1.png">
                                <img width="215" alt="Mac-help-step4-yosemite" src="<?php echo $base_url; ?>/images/specificaton_step4-2.png">
                                </div>
                                <div class="clear"></div>
                            </div>
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
     
      <?php
  if($_SESSION['specification'] == "Mac Mini"){
	  
	  ?>
       <h2 class="lapth2">Select Processor</h2>
  
     <select name="Scsize" class="compsfec" id="processor" onchange="getComboB(this)">
                                            <option value="">Select Processor</option>
                            
                            <?php


 $querymemory =  "SELECT    DISTINCT product.CPU as 'cpu' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND  productfamily.Name ='".$_SESSION['specification']."' AND product.ScreenSize=''  AND productbrand.Name ='".$_SESSION['id']."'";

$resultmemoriesp = mysql_query($querymemory);
	while($resultmemoryp = mysql_fetch_array($resultmemoriesp)){
?>
                            
                                             
                                              
                                            <option value="<?php echo $resultmemoryp['cpu']?>"><?php echo $resultmemoryp['pscreensize']?>&nbsp;<?php echo $resultmemoryp['cpu']?></option>
                                        
                                          
                                                             
                                              
                                           <?php
										   #$selected_val = $_POST['Scsize']; 
										   
										    } ?>
                                        
                                          
                               </select>
      <?php
  }
  else{
  ?>
  
     <h2 class="lapth2">Select Screen Size</h2>
 
     <select name="Scsize" class="compsfec" id="screens" onchange="getComboA(this)">
                                            <option value="">Select Size</option>
                            
                            <?php


$querymemory =  "SELECT DISTINCT   product.ScreenSize as 'pscreensize' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND  productfamily.Name ='".$_SESSION['specification']."' AND productbrand.Name ='".$_SESSION['id']."'";
$resultmemories = mysql_query($querymemory);
	while($resultmemory = mysql_fetch_array($resultmemories)){
?>
                            
                                             
                                              
                                            <option value="<?php echo $resultmemory['pscreensize']?>"><?php echo $specification; ?>&nbsp;<?php echo $resultmemory['pscreensize']?></option>
                                        
                                          
                                                             
                                              
                                           <?php
										   $selected_val = $_POST['Scsize']; 
										   
										    } ?>
                                        
                                          
                               </select>
                               <?php  } ?>
                               
     </div>
<!--END SCREEN SIZE-->

<div class="col-lg-4 col-md-4 col-sm-4" id="screenprocessor" style="display: none;">
     
     </div>

<div class="col-lg-4 col-md-4 col-sm-4" id="screenhard" style="display: none;">
     
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
<div class="tab-pane fade tab_bg <?php if($_GET['computer'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab4">

<!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $specification ;?> <?php echo $_SESSION['wherevalue'] ;?>> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">Fast payment, Fair prices, Free shipping.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
<?php
if($_SESSION['specification'] == 'Mac Mini'){
$querymemory1 =  "SELECT product.id as productid ,product.ProductModel as 'productmodel' ,product.ProductCode as productcode, product.Description as `productdescription`,  product.image_url as 'image_url' ,product.SubFamily as 'subfamily' , product.ProductModel as 'productmodel', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity',productbrand.Name as `brandname`, productfamily.Name as `familyname` from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2  AND  productfamily.Name ='".$_SESSION['specification']."' AND product.ScreenSize='' AND product.CPU ='".$process."' AND productbrand.Name ='".$_SESSION['id']."' AND product.StorageCapacity ='".$model."'";	
	}
else{
 $querymemory1 =  "SELECT product.id as productid ,product.ProductModel as 'productmodel',product.ScreenSize as 'screensize' ,product.ProductCode as productcode, product.Description as `productdescription`, product.image_url as 'image_url' ,product.SubFamily as 'subfamily' , product.ProductModel as 'productmodel', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity',productbrand.Name as `brandname`,productfamily.Name as `familyname` from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2  AND  productfamily.Name ='".$_SESSION['specification']."' AND product.ScreenSize='".$screen."' AND product.CPU ='".$process."' AND productbrand.Name ='".$_SESSION['id']."' AND product.StorageCapacity ='".$model."'";
}

$resultmemories = mysql_query($querymemory1);
$resultnumbers = mysql_num_rows($resultmemories);
if($resultnumbers == 0){
	?>
    <div class="row text-center">
    <h3 class="Sheading-error">This Family <span style="color:#000;"><?php echo $specification ;?></span> and specification <span style="color:#000;"><?php echo $_SESSION['wherevalue'] ;?></span>, <span style="color:#000;"><?php echo $_SESSION['wherehard'];?></span> don't have any model</h3>
    </div>
    <?php
	}
	else{
	while($resultmemory = mysql_fetch_array($resultmemories)){?>
         <div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">  
     
        <?php
		if($_SESSION['specification'] == "Mac Mini"){
?>
     <li><a href='<?php echo $base_url; ?>/sell/computers/<?php echo $resultmemory['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemory['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemory['storagecapacity']);?>/<?php echo str_replace(" ","-",$_SESSION['wherehard']); ?>/1/<?php echo $resultmemory['productid'];?>'>
     <?php }
	 else{
	  ?>
       <li><a href='<?php echo $base_url; ?>/sell/computers/<?php echo $resultmemory['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemory['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemory['storagecapacity']);?>/<?php echo str_replace(" ","-",$_SESSION['wherehard']); ?>/<?php echo $resultmemory['screensize']; ?>/<?php echo $resultmemory['productid'];?>'>
     <?php
	 }
	 ?>
      <?php
	 if($resultmemory['image_url'] != ""){
		 ?>
     <div class="prod_img"> <img alt="image" class="cellimg" src="<?php echo $base_url; ?>/productimages/<?php echo $resultmemory['image_url']; ?>"/>  
     </div>   
         <?php
	 }
	 else{
		 ?>
      <div class="prod_img"><img class="class="cellimg"" src="<?php echo $base_url; ?>/images/macbook-pro.jpg"/></div>
        <?php } ?>
        <h4><?php echo str_replace('"', '',$resultmemory['productdescription']) ?></h4>
     </a></li>
     </ul>
     </div>
      <div class="nomobile">
     <?php
     if($_SESSION['specification'] == "Mac Mini"){
?>
     <a href='<?php echo $base_url; ?>/sell/computers/<?php echo $resultmemory['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemory['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemory['storagecapacity']);?>/<?php echo str_replace(" ","-",$_SESSION['wherehard']); ?>/1/<?php echo $resultmemory['productid'];?>'>
     <?php }
	 else{
	  ?>
       <a href='<?php echo $base_url; ?>/sell/computers/<?php echo $resultmemory['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemory['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemory['storagecapacity']);?>/<?php echo str_replace(" ","-",$_SESSION['wherehard']); ?>/<?php echo $resultmemory['screensize']; ?>/<?php echo $resultmemory['productid'];?>'>
     <?php
	 }
	 ?>
     <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
      <?php
	 if($resultmemory['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt="image" src="<?php echo $base_url; ?>/productimages/<?php echo $resultmemory['image_url']; ?>"/>      
         <?php
	 }
	 else{
		 ?>
     <img class="fix img-responsive" src="<?php echo $base_url; ?>/images/macbook-pro.jpg"/>
        <?php } ?>
        <h2><?php echo str_replace('"', '',$resultmemory['productdescription']) ?></h2>
     </div></a>
     </div>
   <?php } } ?>   
     
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
<!--Step 4 ENDS-->
<!--Step 5 Starts-->
<div class="tab-pane fade tab_bg <?php if($_GET['model'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab5">
<?php
$queryproduct =  "SELECT product.id as productid , product.Description as `productdescription`,  product.image_url as `image_url` , product.ProductModel as 'productmodel', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity' , product.ScreenSize as 'ScreenSize' , product.OrderNumber as 'OrderNumber' , product.GoodPrice as 'GoodPrice' , product.brokenno as 'brokenno' , product.brokenyes as 'brokenyes' , product.FlawessPrice as 'FlawlessPrice' , product.AcceptablePrice as 'AcceptablePrice' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.id=".$_SESSION['model'];
		
	$resultproducts = mysql_query($queryproduct);
	if(isset($_SESSION['model'])){
	$resultproduct = mysql_fetch_array($resultproducts);
	}
?>
<!--<div class="row text-center">
<h1 class="sub-heading">Model condition</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model condition</h2>
   <h3 class="Sheading-styleh3">Your Selected model is <span style="color:#000;"><?php //echo $specification ;?></span> <span style="color:#000;"><?php //if($resultproduct['ScreenSize'] == ""){ //echo $_SESSION['wherevalue']; } else{ echo $_SESSION['wherevalue']; }?></span> <span style="color:#000;"><?php //echo $resultproduct['cpu']; ?></span> <span style="color:#000;"><?php //echo $resultproduct['OrderNumber']; ?></span> <span style="color:#000;"><?php //echo $resultproduct['storagecapacity']; ?></span></h3>
</div>--><!-- row --> 

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo str_replace('"', '',$resultproduct['productdescription']); ?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">Fast payment, Fair prices, Free shipping.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
     <div class="nomobile">
     <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" alt="<?php echo $resultproduct['image_url']; ?>" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     <img class="fix" alt="macbook-pro" src="<?php echo $base_url; ?>/images/macbook-pro.jpg"/>
     
     <?php  }?>
        <h2><?php echo str_replace('"', '',$resultproduct['productdescription']); ?></h2>
     </div>
     </div>
     <div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">  
     
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <li><a href=""><div class="prod_img"><img class="cellimg" alt="<?php echo $resultproduct['image_url']; ?>" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/> </div>     
         <?php
	 }
	 else{
	 ?>
     <li><a href=""><div class="prod_img"><img class="cellimg" alt="macbook-pro" src="<?php echo $base_url; ?>/images/macbook-pro.jpg"/></div>
     
     <?php  }?>
        <h4><?php echo str_replace('"', '',$resultproduct['productdescription']); ?></h4>
        </a>
        </li>
     </ul>
     </div>
     <div class="col-lg-9 col-md-8 col-sm-8 mcollectdt">
       <h1>What shape is it in?</h1>
       
    	
    
    <div class="radio-group">
    
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 topmargin" style="margin-left: -18px!important;">
    <input id="choice-c" type="radio" name="g" value="6"/>
        <label for='choice-c'>
            <span></span>
            Broken<span class="plabelp">Has functional or physical problems</span>                          
        </label>
        </div>
        
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 topmargin">
        <input id="choice-al" type="radio" name="g"  value="1" />
        <label id="choice-ala" class="complabel">
            <span></span>
            Fair<span class="plabelp">heavy physical defects, or minor functional defects</span>                          
        </label>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 topmargin">
        <input id="choice-bl" type="radio" name="g" value="2">
        <label id="choice-bla" class="complabel">
            <span></span>
        
            Good<span class="plabelp">Normal signs of use</span>                          
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 topmargin" >
        <input id="choice-c" type="radio" name="g" value="3" checked />
        <label id="choice-cla" class="complabel">
            <span></span>
            Flawless <span class="plabelp">Looks like it's never been used</span>
        </label>
       </div>
    
</div> 

<div id="good6" class="desc" style="margin-top:15%; display:none;">
     <p class="device-power">Does the device power on?</p>
   <input id="choice-yes" type="radio" name="gchoice" value="4" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">YES</p>
   <input id="choice-no" type="radio" name="gchoice" value="5" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">NO</p><div class="clearfix"></div>
   </div>
   
   <div id="good4" class="desc" style="display:none;">
    <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokenyesform">
   <h2> Your Computer is in this condition if any of the following are true:</h2>
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
   
    <?php if($resultproduct['brokenyes'] == 0 || $resultproduct['brokenyes'] == '' )
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
  <!-- <h2> Your Computer is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		
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
   
    <?php if($resultproduct['brokenno'] == 0 || $resultproduct['brokenno'] == '')
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
   <h2 style="margin-top:19% !important;"> Your Macbook is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   	<li>Item remains in good working condition</li>
	<li>Scratches or scuffs on body</li>
	<li>Multiple dead pixels</li>
	<li>Heavy wear, such as multiple dents, on the housing</li>

        
   </ul>
   
   	<br>
	<div>
		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_5" />
		<button type="button" id="coupon_code_btn_5" onclick="applyCouponCode('5','acceptable')">Apply</button></p>
	</div>
	<div class="alert alert_5" style="display:none">
	</div>
	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_5">$<?php echo $resultproduct['AcceptablePrice']; ?></span>
   <input type="hidden" name="condition" value="acceptable" />
   <input type="hidden"id="old_price_5" value="<?php echo $resultproduct['AcceptablePrice']; ?>" />
   <input type="hidden" name="price" id="price_5" value="<?php echo $resultproduct['AcceptablePrice']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($resultproduct['AcceptablePrice'] > 0)
  {
	  ?>
   <button type="submit" class="getp-btn">get paid</button>
   <?php } ?>
   </p></div>
   </form>
   
    <?php if($resultproduct['AcceptablePrice'] == 0)
  {
	  ?>
      <!--<span>You could make offer to this product</span>-->
      <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url; ?>/recycling" target="_blank">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      <?php
	  }
  ?>
   </div>
   
   <div id="good2" class="desc" style="display:none;">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="flawlessform">
   <h2 style="margin-top:19% !important;"> Your Macbook is in this condition if any of the following are true: </h2>
   <ul class="step4ul">
   	<li>The item shows wear from consistent use, but it remains in good condition and works perfectly.</li>
	<li>It may be marked, have identifying markings on it, or show other signs of previous use.</li>
	<li>No cracks on screen or body</li>
	<li>Powers on and makes calls</li>

        
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
  <?php if($resultproduct['GoodPrice'] >0)
  {
	  ?>
  <button type="submit" class="getp-btn">get paid</button>
  <?php } ?>
  </div>
  </form>
      <?php
      if($resultproduct['GoodPrice'] == 0){
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
   
   <div id="good3" class="desc">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="flawlessform">
   <h2 style="margin-top:19% !important;"> Your Macbook is in this condition if any of the following are true: </h2>
   <ul class="step4ul">
   		<li>An apparently untouched item in perfect condition.</li>
        <li>Original protective wrapping may be missing, but the original packaging is intact and pristine.</li>
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