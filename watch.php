<?php
include "header.php";
session_start();
unset($_SESSION['computer']);	
if(isset($_GET['id'])){
$_SESSION['id'] = str_replace("-"," ",$_GET['id']); 
}
$id = $_SESSION['id'];
if(isset($_GET['family'])){
$_SESSION["family"] = $_GET['family'];
}
$family = $_SESSION["family"];
if(isset($_GET['specification'])){
$_SESSION["specification"] = $_GET['specification'];
}
$specification = $_SESSION["specification"];
if(isset($_GET['model'])){
$_SESSION["model"] = $_GET['model'];
}
$model = $_SESSION["model"];
?>
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
                        <li class="<?php if($_GET['id'] == '' && $_GET['specification'] =='' && $_GET['model'] =='' ){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
                        <li class="<?php if($_GET['id'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT  MODEL</a></li> 
                        <li class="<?php if($_GET['specification'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab3" <?php if(isset($_SESSION['specification'])){?> data-toggle="tab" <?php } ?>><div class="step-no">3</div>SELECT SPECIFICATIONS</a></li> 
                        <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>><div class="step-no">4</div>SELECT CONDITION</a></li>
                    </ul>
                </div> 
            </div>
            <div class="container tab-content">
            	<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['generation'] ==''  && $_GET['model'] =='' && $_GET['specification'] ==''){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">
            		<!--<div class="row text-center">
            			<h1 class="sub-heading">BRAND</h1>
            			<div class="underline1"></div>
                		<h2 class="Sheading-style1 ">PLEASE SELECT YOUR BRAND TO CONTINUE</h2>
            		</div>-->
                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your smart watch for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your smart watch.</h2>
</div>
            		<div class="row tab-container"> 
            			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
                			<div class="tab-content">
                  					<div class="tab-pane fade in nomobile active" id="port-1">
<?php
$querybrand =  "SELECT DISTINCT productfamily.Name as `familyname`,productbrand.id as `brandid` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 5";
$resultbrands = mysql_query($querybrand);
while($resultbrand = mysql_fetch_array($resultbrands)){    
$querybrandimg =  "SELECT productfamily.image_url as `image_url` from productfamily WHERE productfamily.CategoryId = 5 AND productfamily.BrandId =".$resultbrand['brandid'];
	$resultbrandsimg = mysql_query($querybrandimg);
	$resultbrandimg = mysql_fetch_assoc($resultbrandsimg);                
?>
                    				<a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultbrand['familyname']); ?>">
                                    	<div class="portfolio-block col-lg-3 col-md-3 col-sm-4 col-centered"> 
                    						<?php
		if($resultbrandimg['image_url'] != ""){ ?>
		<img class="fix img-responsive" alt="TV" style="height:179px;" src="<?php echo $site_url ?>/productimages/<?php echo $resultbrandimg['image_url']; ?>"/>	
			<?php }
			else{
		?>
                    						<img class="fix img-responsive" alt="apple_watch" src="<?php echo $site_url ?>/images/apple_watch.png"/>
                                            <?php } ?>
                    						<h2><?php echo $resultbrand['familyname']; ?></h2>
                      
                    					</div>
                                    </a>
<?php } ?>
                  				</div>
                                
                                <div class="tab-pane fade in active navmobile" style="display:none;" id="port-1">
                                <ul class="nav nav-tabs nav-stacked">  
<?php
$querybrand =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 5";
$resultbrands = mysql_query($querybrand);
while($resultbrand = mysql_fetch_array($resultbrands)){               
?>
                    				<li><a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultbrand['familyname']); ?>">
                                    	
                    						<h4><?php echo $resultbrand['familyname']; ?></h4>
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
            	<div class="tab-pane fade tab_bg <?php if($_GET['id'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab2">
            		<!--<div class="row text-center">
            			<h1 class="sub-heading">MODEL</h1>
            			<div class="underline1"></div>
                		<h2 class="Sheading-style1 ">PLEASE SELECT YOUR MODEL TO CONTINUE</h2>
            		</div>-->
                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $_SESSION['id']; ?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $_SESSION['id']; ?>.</h2>
</div>
            		<div class="row pad ">
            		</div>
            		<div class="row tab-container"> 
            			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
                		<div class="nomobile">
                        	<div class="tab-content">
                  				<div class="tab-pane fade in active">
<?php
$queryfamilyy =  "Select distinct Generation,(Select image_url From product pr Where pr.Generation like p.Generation Limit 1) Image_url ,productfamily.Name as `familyname`  from product p INNER JOIN `productfamily` ON productfamily.Id=p.FamilyId where p.CategoryId =5 AND productfamily.Name ='".$_SESSION['id']."'";
$resultfamiliess = mysql_query($queryfamilyy);
while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
?>
               

               <a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>/<?php echo str_replace(" ","-",$resultfamilyy['Generation']); ?>">
                                    	<div class="portfolio-block col-lg-3 col-md-3 col-sm-4 col-centered"> 
                    						<img style="height:179px;" class="fix img-responsive" alt="<?=$resultfamilyy['Image_url']?>" src="<?php echo $base_url; ?>/productimages/<?=$resultfamilyy['Image_url']?>"/>
                    						<h2><?php echo $resultfamilyy['Generation']; ?></h2>
                    					</div>
                                    </a>
                      
                      
<?php } ?>
                  				</div>
                			</div>
                            </div>
                            <div class="navmobile" style="display:none;">
                            <div class="tab-content">
                  				<div class="tab-pane fade in active">
<?php
$queryfamilyy =  "Select distinct Generation,(Select image_url From product pr Where pr.Generation like p.Generation Limit 1) Image_url ,productfamily.Name as `familyname`  from product p INNER JOIN `productfamily` ON productfamily.Id=p.FamilyId where p.CategoryId =5 AND productfamily.Name ='".$_SESSION['id']."'";
$resultfamiliess = mysql_query($queryfamilyy);
while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
?>
               

                      
     <ul class="nav nav-tabs nav-stacked">                
              <li> <a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>/<?php echo str_replace(" ","-",$resultfamilyy['Generation']); ?>">
                                    	
                    						<h4><?php echo $resultfamilyy['Generation']; ?></h4>
                    				
                                    </a></li>
                                    </ul>
                                    
<?php } ?>
                  				</div>
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
            	<div class="tab-pane fade tab_bg <?php if($_GET['specification'] != '' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab3">
            		<!--<div class="row text-center">
            			<h1 class="sub-heading">SPECIFICATIONS </h1>
            			<div class="underline1"></div>
                		<h2 class="Sheading-style1 ">Please Select your model SPECIFICATIONS</h2>
                		<div class="underline1"></div>
                		<h3 class="Sheading-styleh3">Your Selected Model <u><?php //echo $specification ;?></u></h3>
            		</div>--> 
                    
                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $specification ;?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $specification ;?>.</h2>
</div>
            		<div class="row pad">
            			<!--<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                  			<div class=" col-lg-4 col-md-4 col-sm-4" >
                    			<h2>Select Size</h2>
                  				<select name="Scsize" class="compsfec" id="screens" onchange="getComboAS(this)">
                                	<option value="">Select Size</option>
<?php
/*$querymemory =  "SELECT DISTINCT product.ScreenSize as 'pscreensize' from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 5 AND productfamily.Name ='".$_SESSION['id']."' AND product.Generation = '".$_SESSION['specification']."' ";
$resultmemories = mysql_query($querymemory);
while($resultmemory = mysql_fetch_array($resultmemories)){*/
?>                                    
                    				<option value="<?php //echo $resultmemory['pscreensize']?>"><?php //echo $resultmemory['pscreensize']?></option>
<?php //} ?>
                        		</select>
            				</div>
                			<div class=" col-lg-4 col-md-4 col-sm-4" id="screensize" style="display:none"></div>
                		</div>-->
                		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" id="screenhard" style="clear:both; padding-top:20px;">
                         <?php





  $querymemoryh =  "SELECT  product.ScreenSize as 'pscreensize',product.Description as 'description' ,product.Generation as 'pgeneration' ,product.image_url as 'image_url' , product.id as 'productid' , product.Band as 'pband', productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 5 AND productfamily.Name ='".$_SESSION['id']."' AND product.Generation = '".$_SESSION['specification']."'";

  

 // $sspz = $resultmemoryph['psct'];



$resultmemoriesh = mysql_query($querymemoryh);

	while($resultmemoryph = mysql_fetch_array($resultmemoriesh)){

?>

                            

                                             
 
                                              

                                           	<div class="nomobile">
                                           <a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultmemoryph['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemoryph['pgeneration']); ?>/<?php echo $resultmemoryph['productid']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 

                                          <?php

	 if($resultmemoryph['image_url'] != ""){

		 ?>

     <img class="fix img-responsive" style="height:160px;" src="<?php echo $base_url; ?>/productimages/<?php echo $resultmemoryph['image_url']; ?>"/>      

         <?php

	 }

	 else{

	 ?>   

                                           <img class="fix img-responsive" style="height:179px;" src="<?php echo $base_url; ?>/images/apple_watch.png"/>

           <?php } ?>

        <h2 style="font-size: 16px; !important"><?php echo $resultmemoryph['description']; ?></h2>

        </div></a>
											</div>
                                            <div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">  
                                        	<li><a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultmemoryph['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemoryph['pgeneration']); ?>/<?php echo $resultmemoryph['productid']; ?>">

                                          <?php

	 if($resultmemoryph['image_url'] != ""){

		 ?>
<div class="prod_img">
     <img class="cellimg" src="<?php echo $base_url; ?>/productimages/<?php echo $resultmemoryph['image_url']; ?>"/>  </div>    

         <?php

	 }

	 else{

	 ?>   

                                           <div class="prod_img"><img class="cellimg" src="<?php echo $base_url; ?>/images/apple_watch.png"/></div>
 
           <?php } ?>

        <h4><?php echo $resultmemoryph['description']; ?></h4><div style="clear:both;"></div>

    </a></li>
</ul>
</div>         

                                        

                                          

                                                             

                                              

                                           <?php

										   #$selected_val = $_POST['Scsize']; 

										   

										    } ?>
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
                		<h2 class="Sheading-style1 ">Please Select your model condition</h2>-->
<?php
$queryproduct =  "SELECT product.id as productid , product.Description as `productdescription`, product.image_url as `image_url` , product.ProductModel as 'productmodel', product.CPU as 'cpu' , product.StorageCapacity as 'storagecapacity' , product.GoodPrice as 'GoodPrice' , product.FlawessPrice as 'FlawlessPrice',product.brokenno as 'brokenno' , product.brokenyes as 'brokenyes' , product.AcceptablePrice as 'AcceptablePrice' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId  WHERE product.id=".$_SESSION['model'];         
$resultproducts = mysql_query($queryproduct);
$resultproduct = mysql_fetch_array($resultproducts);
?>
                		<!--<h3 class="Sheading-styleh3">Your Selected model <span style="color:#000;"><?php //echo $resultproduct['productdescription'] ;?></span></h3>              
            		</div> -->
                    
                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $resultproduct['productdescription'] ;?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $resultproduct['productdescription'] ;?>.</h2>
</div>
            		<div class="row pad">
            			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                 				<div class="nomobile">
                            <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
<?php
if($resultproduct['image_url'] != ""){
?>
                 				<img class="fix img-responsive" alt="<?php echo $resultproduct['image_url']; ?>" style="height:179px;" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>      
<?php }else{?>
                 				<img class="fix" alt="apple watch" src="<?php echo $base_url; ?>/images/apple_watch.png"/>
<?php } ?>
                    			<h2><?php echo $resultproduct['productdescription']; ?></h2>
                 			</div>
                            </div>
                            <div class="navmobile" style="display:none;">
     						<ul class="nav nav-tabs nav-stacked">

                            
<?php
if($resultproduct['image_url'] != ""){
?>
                 				<li><a href="">
                                <div class="prod_img">
                                <img class="cellimg" alt="<?php echo $resultproduct['image_url']; ?>" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>  </div>    
<?php }else{?>
								<li><a href="">
                 				<div class="prod_img"><img class="cellimg" alt="apple watch" src="<?php echo $base_url; ?>/images/apple_watch.png"/></div>
<?php } ?>

                    			<h4><?php echo $resultproduct['productdescription']; ?></h4><div style="clear:both;"></div>
                 			
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
   <input id="choice-yes" type="radio" name="gchoice" value="4" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">YES</p> 
   <input id="choice-no" type="radio" name="gchoice" value="5" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">NO</p><div class="clearfix"></div>
   </div>
   
   <div id="good4" class="desc" style="display:none;">
   
      <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokenyesform">
   <h2 style="margin-top:0px;"> Your Smart Watch is in this condition if any of the following are true:</h2>
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
      
       <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokennoform"> <br>
 
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
               							<h2> Your smart watch is in this condition if any of the following are true:</h2>
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
	
               							<div class="step4l">
                                        	<p>
                                            	Your Stopoint Offer:&nbsp;&nbsp;
                                            	<span id="price_text_3">$<?php echo $resultproduct['GoodPrice']; ?></span>
               									<input type="hidden" name="condition" value="good" />
               									<input type="hidden" id="old_price_3" value="<?php echo $resultproduct['GoodPrice']; ?>" />
               									<input type="hidden" name="price" id="price_3" value="<?php echo $resultproduct['GoodPrice']; ?>" />
               									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($resultproduct['GoodPrice'] > 0)
{
?>
												<button type="submit" class="getp-btn">get paid</button>
<?php } ?>
               								</p>
                                        </div>
               						</form>
               
<?php if($resultproduct['GoodPrice'] == 0)
{
?>
                  					
                  					<br />
                  					<p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item</p>
                  					<p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
                  					<p>Please <a href="<?php echo $base_url; ?>/recycling" target="_blank">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
                  					
<?php }?>
               					</div>
               					<div id="good2" class="desc">
               						<form action="<?php echo $base_url; ?>/checkout2" method="post" name="flawlessform">
               							<h2> Your smart watch is in this condition if any of the following are true:</h2>
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
	
               							<div class="step4l">
                                        	<p>
                                            	Your Stopoint Offer:&nbsp;&nbsp;
                                                <span id="price_text_4">$<?php echo $resultproduct['FlawlessPrice']; ?></span>
               									<input type="hidden" name="condition" value="Flawless" />
               									<input type="hidden" id="old_price_4" value="<?php echo $resultproduct['FlawlessPrice']; ?>" />
               									<input type="hidden" name="price" id="price_4" value="<?php echo $resultproduct['FlawlessPrice']; ?>" />
               									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($resultproduct['FlawlessPrice'] >0)
{
?>
              									<button type="submit" class="getp-btn">get paid</button>
<?php } ?>
              								</p>
                                        </div>
              						</form>
<?php if($resultproduct['FlawlessPrice'] == 0)
{
?>
                  					<br />
                  					<p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item</p>
                  					<p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
                  					<p>Please <a href="<?php echo $base_url; ?>/recycling" target="_blank">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
<?php }?>
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
            		<br /><br />
            	</div>
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