<?php
include "header.php";
	unset($_SESSION['computer']);
if(isset($_GET['ps'])){
	 $_SESSION['id'] = mysql_real_escape_string($_GET['id']);
	  $id = $_SESSION['id'];
 $_SESSION['phone'] = mysql_real_escape_string($_GET['phone']);
  $phone = $_SESSION['phone'];
	
	
	
	if ($_GET['q'] == '/help') {
  echo 'This is some help text.';
  exit;
}
	
	}
	
if(isset($_GET['id'])){
$_SESSION['id'] = $_GET['id'];
}
 $id = $_SESSION['id'];
 
 //echo $id;
 if(isset($_GET['phone'])){
  $_SESSION["phone"] = $_GET['phone'];
 }
 $phone = $_SESSION["phone"];
 
 if(isset($_GET['carrier'])){
	 if($_GET['carrier'] == "ATT"){
		 $_GET['carrier'] = 'AT&T';
		 }
 $_SESSION["carrier"] = $_GET['carrier'];
 }
 
 $carrier = $_SESSION["carrier"];
 
 if(isset($_GET['model'])){
  $_SESSION["model"] = $_GET['model'];
 
 }
@$model = $_SESSION["model"];

?>
<style>/*
#breadcrumbs-two{
  overflow: hidden;
  width: 100%;
  margin-bottom: 1%;
  margin-top: 1%;
}

#breadcrumbs-two li{
  float: left;
  margin: 0 .5em 0 1em;
  list-style:none;
}
#breadcrumbs-two a{
  background: #ddd;
  padding: .7em 1em;
  float: left;
  text-decoration: none;
  color: #444;
  text-shadow: 0 1px 0 rgba(255,255,255,.5); 
  position: relative;
}

#breadcrumbs-two a:hover{
  background: #99db76;
}

#breadcrumbs-two a::before{
  content: "";
  position: absolute;
  top: 50%; 
  margin-top: -1.5em;   
  border-width: 1.5em 0 1.5em 1em;
  border-style: solid;
  border-color: #ddd #ddd #ddd transparent;
  left: -1em;
}

#breadcrumbs-two a:hover::before{
  border-color: #99db76 #99db76 #99db76 transparent;
}

#breadcrumbs-two a::after{
  content: "";
  position: absolute;
  top: 50%; 
  margin-top: -1.5em;   
  border-top: 1.5em solid transparent;
  border-bottom: 1.5em solid transparent;
  border-left: 1em solid #ddd;
  right: -1em;
}

#breadcrumbs-two a:hover::after{
  border-left-color: #99db76;
}

#breadcrumbs-two .current,
#breadcrumbs-two .current:hover{
  font-weight: bold;
  background: none;
}

#breadcrumbs-two .current::after,
#breadcrumbs-two .current::before{
  content: normal;
}
#breadcrumbs-two li.active a{ background: #99db76;font-weight: bold;color: #fff; }
#breadcrumbs-two li.active a::before {
 border-color: #99db76 #99db76 #99db76 transparent;
 font-weight: bold;color: #fff;
}
#breadcrumbs-two li.active a::after {
  border-left-color: #99db76;
}*/

<!--new-->

#breadcrumbs-two{
  overflow: hidden;
  width: 100%;
  margin-bottom: 1%;
  margin-top: 1%;
 
}
#breadcrumbs-two li{
  float: left;
  margin: 0 -0.1em 0 0.5em;
  list-style:none;
  border-width: 0.1em;
  border-style: solid;
  border-color: #ddd;
  border-radius:9px;
}
#breadcrumbs-two a{
 
  padding: .1em 1em;
  float: left;
  text-decoration: none;
  color: #444;
  text-shadow: 0 1px 0 rgba(255,255,255,.5); 
  position: relative;
}
#breadcrumbs-two a:hover{
  background: #99db76;
  border-radius: 9px;
}
#breadcrumbs-two a::before{
  content: "";
  position: absolute;
  top: 50%; 
  margin-top: -1.5em;   
 /* border-width: 1.5em 0 1.5em 1em;
  border-style: solid;
  border-color: #ddd #ddd #ddd transparent;
  left: -1em;*/
}
#breadcrumbs-two a:hover::before{
  border-color: #99db76 #99db76 #99db76 transparent;
}
#breadcrumbs-two a::after{
  content: "";
  position: absolute;
  top: 50%; 
  margin-top: -1.5em;   
/*  border-top: 1.5em solid transparent;
  border-bottom: 1.5em solid transparent;
  border-left: 1em solid #ddd;*/
 /* right: -1em;*/
 
}

#breadcrumbs-two a:hover::after{
  border-left-color: #99db76;
}

#breadcrumbs-two .current,
#breadcrumbs-two .current:hover{
  font-weight: bold;
  background: none;
}

#breadcrumbs-two .current::after,
#breadcrumbs-two .current::before{
  content: normal;
}
#breadcrumbs-two .arrow_right {
    border-bottom: 6px solid transparent;
    border-left: 6px solid #e4e6de;
    border-top: 6px solid transparent;
    float: left;
    height: 0;
   margin-left: 7px;
    margin-top: 7px;
    width: 0;
}
#breadcrumbs-two li.active a{ background: #99db76;font-weight: bold;color: #fff; border-radius: 9px; }
#breadcrumbs-two li.active a::before {
 border-color: #99db76 #99db76 #99db76 transparent;
 border-radius: 9px;
 font-weight: bold;color: #fff;
}
#breadcrumbs-two li.active a::after {
  border-left-color: #99db76;
}<!--end new-->

</style>
<img class="display-none" src="https://stopoint.com/assets/images/yes.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/no.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/yes-focus.png" style="visibility: hidden;">
<img class="display-none" src="https://stopoint.com/assets/images/no-focus.png" style="visibility: hidden;">
<!-- steps --> <input type="hidden" id="model" value="<?php echo $model; ?>" /><input type="hidden" id="coupon_code" value="<?php echo isset($_SESSION['coupon_code'])?$_SESSION['coupon_code']:""; ?>" /><input type="hidden" id="coupon_code_index" value="<?php echo isset($_SESSION['coupon_code_index'])?$_SESSION['coupon_code_index']:""; ?>" /><input type="hidden" id="coupon_code_condition" value="<?php echo isset($_SESSION['coupon_code_condition'])?$_SESSION['coupon_code_condition']:""; ?>" />
<div class=" step container-fluid">
<div class="container">
<ul class=" step-tab nav nav-justified  tabs">

      <li class="<?php if($_GET['id'] == '' && $_GET['phone'] =='' && $_GET['carrier'] =='' && $_GET['model'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
      <li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT MODEL</a></li>
      <li class="<?php if($_GET['phone'] != '' && $_GET['ps']==''){echo 'active';} elseif ($_GET['phone'] != ''){ echo 'active' ;} else { echo '' ;}?>"><a href="#tab3" <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?>><div class="step-no">3</div>SELECT CARRIER</a></li>
      <li class="<?php if($_GET['carrier'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4" <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?>><div class="step-no">4</div>PHONE SPECIFICATION</a></li>
      <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>><div class="step-no">5</div>WHAT SHAPE IS</a></li>
    </ul>
 <!--   <br>
    
     <ul  id="breadcrumbs-two" style="margin-left: 52px;padding-bottom:20px">
	
	
	<li class="<?php if($_GET['id'] == '' && $_GET['phone'] =='' && $_GET['carrier'] =='' && $_GET['model'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab">SELECT BRAND</a></li><div class="arrow_right"></div>
	<li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>>SELECT MODEL</a></li><div class="arrow_right"></div>
	<li class="<?php if($_GET['phone'] != '' && $_GET['ps']==''){echo 'active';} elseif ($_GET['phone'] != ''){ echo 'active' ;} else { echo '' ;}?>"><a href="#tab3" <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?>>SELECT CARRIER</a></li><div class="arrow_right"></div>
	<li class="<?php if($_GET['carrier'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4" <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?>>PHONE SPECIFICATION</a></li><div class="arrow_right"></div>
    <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>>WHAT SHAPE IS</a></li>
</ul>  -->
	
	 
</div><!-- end container --> 
</div><!-- end container-fluid --> 

<div class="container tab-content">
<!-- row --> 
<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['phone'] =='' && $_GET['carrier'] =='' && $_GET['model'] =='' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your cell phone for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your cell phone.</h2>
</div>
<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active navmobile" style="display:none;" id="port-1">
        <ul class="nav nav-tabs nav-stacked">  
<?php 
$querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 1";
	$resultbrands = mysql_query($querybrand);
	if(mysql_num_rows($resultbrands) >0 ){
while($resultbrand = mysql_fetch_array($resultbrands)){

?>
 <?php if($resultbrand['brandname'] == 'Samsung'){ ?>
       <li><a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung">
        <h4><?php echo $resultbrand['brandname']; ?></h4>
           <?php } else if($resultbrand['brandname'] == 'Apple'){
			   ?>
            <li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>">
               <h4><?php echo $resultbrand['brandname']; ?></h4>
               <?php
			   }
			    else if($resultbrand['brandname'] == 'Motorola'){
			   ?>
               <li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>">
               <h4><?php echo $resultbrand['brandname']; ?></h4>
               <?php
			   }
			    else if($resultbrand['brandname'] == 'HTC'){
			   ?>
               <li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>">
               <h4><?php echo $resultbrand['brandname']; ?></h4>
               <?php
			   }
			   
			    else if($resultbrand['brandname'] == 'LG'){
			   ?>
               <li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>"> 
               <h4><?php echo $resultbrand['brandname']; ?></h4>
               <?php
			   }
			    ?>
          
       </li></a>

<?php
}
	}else{?>
	
	<div align="center">No Data to show</div>
	<?php }?>
</ul>  
</div>
      <div class="tab-pane fade in active nomobile" id="port-1">
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 1";
	$resultbrands = mysql_query($querybrand);
	
	if(mysql_num_rows($resultbrands) >0 ){
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        
        <?php if($resultbrand['brandname'] == 'Samsung'){ ?>
        <a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung"> <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> <!--class col-centered removed -->
        <img alt="s6 image" class="fix img-responsive" style="height:179px;"  src="<?php echo $base_url ?>/productimages/GalaxyS6Edge.png"/>
           <?php } else if($resultbrand['brandname'] == 'Apple'){
			   ?>
               <a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>"> <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
               <img alt="iphone 6 image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/iPhone6Plus.png"/>
               <?php
			   }
			    else if($resultbrand['brandname'] == 'Motorola'){
			   ?>
               <a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>"> <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
               <img alt="iphone 6 image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/droidmini.png"/>
               <?php
			   }
			    else if($resultbrand['brandname'] == 'HTC'){
			   ?>
               <a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>"> <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
               <img alt="iphone 6 image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/HTCM8.png"/>
               <?php
			   }
			   
			    else if($resultbrand['brandname'] == 'LG'){
			   ?>
               <a href="<?php echo $base_url; ?>/sell/cell-phone/<?php echo $resultbrand['brandname']; ?>"> <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
               <img alt="iphone 6 image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/LGOptimusGE970.png"/>
               <?php
			   }
			    ?>
           <h2><?php echo $resultbrand['brandname']; ?></h2>
        </div></a>
<?php }
	} else{?>
	
	<div align="center">No Data to show</div>
	<?php }?>
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


<div class="<?php if($_GET['id'] != ''  &&  $_GET['ps']==''){ echo 'tab-pane fade tab_bg active in' ;} elseif($_GET['ps']!='' && $_GET['id'] != '' && $_GET['phone'] !=''){echo 'tab-pane fade tab_bg' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab2">


<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<?php
if($id == 'Apple'){
 ?>
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your iPhone for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your iPhone.</h2>
<?php } 
else{
	?>
<h1 class="newheading1" style="font-size:24px; margin:0px;">Sell your <?php echo $id; ?> Cell phone for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $id; ?> Cell phone.</h2>
	<?php
	}
?>
</div>
<div class="row tab-container"> 
	<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    	<!-- Tab panes -->
		<div class="tab-content">
			<?php
                if($_SESSION["id"] == "Apple"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#iPhoneModal">Which model do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="iPhoneModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which model do I have?</h4>
						</div>
						<div class="modal-body">
							Identify your iPhone by referring to the model number printed on the back of the device.
                            <br>
                            <br>
                            <span class="">iPhone 4:</span>
                            Model A1332 or A1349 (glass back)
                            <br>
                            <span class="">iPhone 4S:</span>
                            Model A1387 or A1431 (glass back, Siri)
                            <br>
                            <span class="">iPhone 5:</span>
                            Model A1428, A1429, or A1442 (aluminum back, 4" screen)
                            <br>
                            <span class="">iPhone 5C:</span>
                            Model A1456, A1507, A1529, A1532, A1516 or A1526 (colored plastic back)
                            <br>
                            <span class="">iPhone 5S:</span>
                            Model A1453, A1457, A1530, A1533, A1518, or A1528 (aluminum back, fingerprint reader)
                            <br>
                            <span class="">iPhone 6:</span>
                            Model A1549, A1586, or A1589(4.7" screen)
                            <br>
                            <span class="">iPhone 6 Plus:</span>
                            Model A1522, A1524, or A1593(5.5" screen)
                            <br>
                            <br>
                            Please note that we do NOT accept the
                            <span class="">original iPhone</span>
                            (model A1203),
                            <span class="">iPhone 3G</span>
                            (model A1241 or A1324), or
                            <span class="">iPhone 3GS</span>
                            (model A1303 or A1325.)
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
        <div class="tab-pane fade in active nomobile" id="port-2">
      <?php
		
		if($_SESSION["id"] == "Apple"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=1";
		}
		
		if($_SESSION["id"] == "Samsung"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=2";
		}
		
		if($_SESSION["id"] == "HTC"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=6";
		}
		
		if($_SESSION["id"] == "Motorola"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=7";
		}
		
		if($_SESSION["id"] == "LG"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=5";
		}
		
	$resultfamiliess = mysql_query($queryfamilyy);
	if(isset($_SESSION["id"])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <?php if($_SESSION["id"] == "Samsung"){ ?>
        <a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <?php
		if($resultfamilyy['familyimage'] != ""){
		?>
        <img alt="cellphone1 image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/>
        <?php	
			}
			else{
		 ?>
        <img alt="samsung image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/images/samsung.png"/>
        <?php } ?>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php }
		else{
		 ?>
         <a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
         <?php
		if($resultfamilyy['familyimage'] != ""){
		?>
        <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/>
        <?php	
			}
			else{ 
		 ?>
        <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/images/iphone.png"/>
        <?php } ?>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php } } } ?>
      </div>
      
      <div class="tab-pane fade in active navmobile" style="display:none;" id="port-2">
      <ul class="nav nav-tabs nav-stacked"> 
      <?php
		
		if($_SESSION["id"] == "Apple"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=1";
		}
		
		if($_SESSION["id"] == "Samsung"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=2";
		}
		
		if($_SESSION["id"] == "HTC"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=6";
		}
		
		if($_SESSION["id"] == "Motorola"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=7";
		}
		
		if($_SESSION["id"] == "LG"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname`, productfamily.image_url as `familyimage` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=5";
		}
		
	$resultfamiliess = mysql_query($queryfamilyy);
	if(isset($_SESSION["id"])){
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <?php if($_SESSION["id"] == "Samsung"){ ?>
       <li> <a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>"> 
        <?php
		if($resultfamilyy['familyimage'] != ""){
		?>
        <div class="prod_img"><img alt="cellphone1 image" class="cellimg" src="<?php echo $base_url ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/></div>
        <?php	
			}
			else{
		 ?>
        <div class="prod_img"><img alt="samsung image" class="cellimg" src="<?php echo $base_url ?>/images/samsung.png"/></div>
        <?php } ?>
        <h4><?php echo $resultfamilyy['familyname']; ?></h4>
          <div style="clear:both;"></div>
        </a></li>
        <?php }
		else{
		 ?>
         <li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$resultfamilyy['familyname']); ?>">
         <?php
		if($resultfamilyy['familyimage'] != ""){
		?>
        <div class="prod_img"><img alt="cellphone image" class="cellimg" src="<?php echo $base_url ?>/productimages/<?php echo $resultfamilyy['familyimage']; ?>"/></div>
        <?php	
			}
			else{ 
		 ?>
        <div class="prod_img"><img alt="cellphone image" class="cellimg" src="<?php echo $base_url ?>/images/iphone.png"/></div>
        <?php } ?>
        <h4><?php echo $resultfamilyy['familyname']; ?></h4>
          <div style="clear:both;"></div>
        </a></li>
        <?php } } } ?>
        </ul>
      </div>
      <!-- end port-1 -->
      <?php
		$count2 = 2;
		if($_SESSION["id"] == "Apple"){
		$queryfamily2 =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=1";
		
		}
		
		if($_SESSION["id"] == "Samsung"){
		$queryfamily2 =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=2";
		}
		
		if($_SESSION["id"] == "HTC"){
		$queryfamily2 =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=6";
		}
		
		if($_SESSION["id"] == "LG"){
		$queryfamily2 =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=5";
		}
		
		if($_SESSION["id"] == "Motorola"){
		$queryfamily2 =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=7";
		}
		
	$resultfamilies2 = mysql_query($queryfamily2);
	if(isset($_SESSION["id"])){
	while($resultfamily2 = mysql_fetch_array($resultfamilies2)){
		?>
      <div class="tab-pane fade" id="port-<?php echo $count2; ?>">
      <?php if($_SESSION["id"] == "Samsung"){ ?>
        <a href="<?php echo $site_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$resultfamily2['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/images/samsung.png"/>
          <h2><?php echo $resultfamily2['familyname']; ?></h2> 
        </div></a>
        
        <?php }
		else{
			?>
            <a href="<?php echo $site_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];} ?>/<?php echo str_replace(" ","-",$resultfamily2['familyname']); ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img alt="cellphone image" class="fix img-responsive" src="<?php echo $base_url ?>/images/iphone.png"/>
          <h2><?php echo $resultfamily2['familyname']; ?></h2> 
        </div></a>
            <?php
			}
		 ?>
         
      </div>
      <?php $count2++; } } ?>
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
<div class="<?php if($_GET['ps']!='' && $_GET['id'] != '' && $_GET['phone'] !=''){echo 'tab-pane fade tab_bg  active in' ;}else{if($_GET['phone'] != ''){ echo 'tab-pane fade tab_bg  active in' ;} else { echo 'tab-pane fade tab_bg' ;} }?>" id="tab3">

<!--<div class="row text-center">
<h1 class="sub-heading">SELECT CARRIER</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR CARRIER TO CONTINUE</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Model <span style="color:#000;"><?php //echo $phone ;?></span></h3>
</div>--><!-- row --> 

<?php
$carrier_filtered_q = "SELECT DISTINCT carriers.Name as carrier_name from product 
	INNER JOIN `carriers` ON carriers.id=product.CarrierId 
	INNER JOIN `productfamily` ON productfamily.id=product.FamilyId 
	INNER JOIN `productbrand` ON productbrand.id=product.BrandId 
WHERE 
	product.CategoryId = 1 AND 
	productbrand.Name ='".$_SESSION["id"]."' AND 
	productfamily.Name like'%".$phone."%'";
	
$carrier_filtered_r = mysql_query($carrier_filtered_q);	
?>

<div class="nomobile">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Select Carrier for your <?php echo $phone ;?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $phone ;?>.</h2>
</div>
<div class="row pad"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

			<?php
                if($_SESSION["id"] == "Samsung"){
            ?>
			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#samsungcarrierModal">Which carrier do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="samsungcarrierModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which carrier do I have?</h4>
						</div>
						<div class="modal-body">
                            The carrier (service provider) name is typically printed on the outside of the phone or displayed on the phone's start-up screen.
    						<br>
    						<br>
    						Please note: we do not accept all carriers for this brand of phone. We only accept phones from Verizon, T-Mobile, Sprint, AT&amp;T, or Factory Unlocked. Any other phones received by Gazelle will have a $0 trade-in value (including carriers such as US Cellular, Virgin Mobile, Cricket and other regional carriers.)
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
<?php
if($_SESSION['id'] == 'Samsung'){
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$r = explode('/', $path);
	$r = array_filter($r);
	$r = array_merge($r, array()); 
?>

	<?php
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>
		  <?php
			if($carrier_name === "AT&T"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/AT-T">
					<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/atandt.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Sprint"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Sprint">
					<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/sprint.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "T-Mobile"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
					<a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/T-Mobile">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/tmobile.png" class="fix img-responsive">
					</a>
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Verizon"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Verizon">
					<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/Verizon_Logo.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Unlocked"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Unlocked">
					<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/funlock.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
	<?php
		}
	?>
    
  <?php }
  else{
  ?>
	
  <?php
	  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $r = explode('/', $path);
	$r = array_filter($r);
	$r = array_merge($r, array()); 
	  ?>
		<?php
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
		?>
		<?php
			if($carrier_name === "AT&T"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/AT-T">
					<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/atandt.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Sprint"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Sprint">
					<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/sprint.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "T-Mobile"){
			?>
				<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
					<a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/T-Mobile">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/tmobile.png" class="fix img-responsive">
					</a>
				</div>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Verizon"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Verizon">
					<div class="col-lg-3 col-md-3 col-sm-4 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/Verizon_Logo.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
			
			<?php
			if($carrier_name === "Unlocked"){
			?>
				<a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Unlocked">
					<div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
						<img alt="cellphone image" src="<?php echo $base_url ?>/images/funlock.png" class="fix img-responsive">
					</div>
				</a>
			<?php
			}
			?>
		<?php
			}
		?>
	  
      <?php
	  }
    ?>
	 </div>
     </div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>


<div class="nomobile">  
<?php
//include 'stopoint-press.php';
?>
</div>  
<div class="navmobile" style="display:none">  
<?php
//include 'stopoint-press-mobile.php';
?>
</div> 
</div>


<div class="navmobile" style="display:none">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Select Carrier for your <?php echo $phone ;?> for cash</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $phone ;?>.</h2>
</div>
<div class="row pad"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

			<?php
                if($_SESSION["id"] == "Samsung"){
            ?>
			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#samsungcarrierModal">Which carrier do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="samsungcarrierModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which carrier do I have?</h4>
						</div>
						<div class="modal-body">
                            The carrier (service provider) name is typically printed on the outside of the phone or displayed on the phone's start-up screen.
    						<br>
    						<br>
    						Please note: we do not accept all carriers for this brand of phone. We only accept phones from Verizon, T-Mobile, Sprint, AT&amp;T, or Factory Unlocked. Any other phones received by Gazelle will have a $0 trade-in value (including carriers such as US Cellular, Virgin Mobile, Cricket and other regional carriers.)
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
      <div class="navmobile" style="display:none;">
        <ul class="nav nav-tabs nav-stacked">
<?php
$carrier_filtered_r = mysql_query($carrier_filtered_q);
if($_SESSION['id'] == 'Samsung'){
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$r = explode('/', $path);
	$r = array_filter($r);
	$r = array_merge($r, array()); 
?>
	<?php
		
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>     
   
   <?php
		if($carrier_name === "AT&T"){
		?>
	<li><a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/AT-T"><h4>At&amp;T</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Sprint"){
		?>
			<li><a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Sprint"><h4>Sprint</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "T-Mobile"){
		?>
			<li><a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/T-Mobile"><h4>T Mobile</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Verizon"){
		?>
			<li><a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Verizon"><h4>Verizon</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Unlocked"){
		?>
			<li><a href="<?php echo $base_url; ?>/sell/cell-phone/Samsung/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Unlocked"><h4>Unlocked</h4></a></li>
		<?php
		}
		?>		
		
	<?php
		}
	?>         
 
  <?php }
  else{
	  
	  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $r = explode('/', $path);
	$r = array_filter($r);
	$r = array_merge($r, array()); 
	  ?>
	  
	  <?php
		
		while($carrier_filtered_rows = mysql_fetch_assoc($carrier_filtered_r)){
			$carrier_name = $carrier_filtered_rows['carrier_name'];
			//echo $carrier_name . ",";
	?>     
   
   <?php
		if($carrier_name === "AT&T"){
		?>
	<li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/AT-T"><h4>AT&amp;T</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Sprint"){
		?>
	<li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Sprint"><h4>Sprint</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "T-Mobile"){
		?>
	<li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/T-Mobile"><h4>T Mobile</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Verizon"){
		?>
	<li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Verizon"><h4>Verizon</h4></a></li>
		<?php
		}
		?>
		
		<?php
		if($carrier_name === "Unlocked"){
		?>
	<li><a href="<?php echo $base_url; ?>/sell/cell-phone/<?php if($_SESSION['id'] == 'Apple'){ echo 'iphone';} else{ echo $_SESSION["id"];}?>/<?php echo str_replace(" ","-",$_SESSION['phone']); ?>/Unlocked"><h4>Unlocked</h4></a></li>
		<?php
		}
		?>		
		
	<?php
		}
	?>
	
    
      <?php
	  }
    ?>
    </ul>
</div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
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
<div class="<?php if($_GET['carrier'] != ''){ echo 'tab-pane fade tab_bg  active in' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab4">


<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;">Select your <?php echo $phone; ?> <?php echo $carrier; ?> to sell.</h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $phone ;?>.</h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 maincenter">

			<?php
                if($_SESSION["id"] == "Apple"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#iPhoneSpecificationModal">What's my iPhone's capacity?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="iPhoneSpecificationModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">What's my iPhone's capacity?</h4>
						</div>
						<div class="modal-body">
							Capacity can be found in Settings > General > About.
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
      
      		<?php
                if($_SESSION["id"] == "Samsung"){
            ?>
			<div style="cursor:pointer; text-align:left;" class="tooltip_heading" data-toggle="modal" data-target="#samsungSpecificationModal">What model Samsung phone do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="samsungSpecificationModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">What model Samsung phone do I have?</h4>
						</div>
						<div class="modal-body">
                            Your model number will be structured like "SGH-T959" or "GT-I9020A" and can be found in the settings menu or under the battery.
							<h3>Please note: We only accept models listed on this page.</h3>
							<p>Any other phone models received by Gazelle will have a $0 trade-in value.</p>
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->

<?php
/*echo $_SESSION["carrier"];
echo $_SESSION["id"];
echo $_SESSION['phone'];*/

 $querymemory =  "SELECT product.id as productid , productfamily.Name as `familyname`, product.Description as `productdescription`,carriers.Name as `carriername`, product.image_url as `image_url` , product.StorageCapacity as 'storagecapacity' from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 1 AND carriers.Name='".$_SESSION['carrier']."' AND productfamily.Name ='".$_SESSION['phone']."' AND productbrand.Name ='".$_SESSION['id']."'";
$resultmemories = mysql_query($querymemory);
$resultnumbers = mysql_num_rows($resultmemories);
if($resultnumbers == 0){

	?>
    <div class="row text-center">
    <h3 class="Sheading-error">This carrier <span style="color:#000;"><?php echo $carrier ;?></span> don't have <span style="color:#000;"><?php echo $phone ;?></span> model</h3>
    </div>
	<?php
	
	}
else{
	while($resultmemory = mysql_fetch_array($resultmemories)){
?>
     	<div class="nomobile">
     <a href="<?php echo $base_url; ?>/<?php echo 'sell-'.str_replace(" ","-",$resultmemory['productdescription']); ?>/<?php echo $resultmemory['productid']?>"><div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
     
      <?php
	 if($resultmemory['image_url'] != ""){
		 ?>
     <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/<?php echo $resultmemory['image_url']; ?>"/>      
         <?php
	 }
	 else{ ?>
	 <?php if($_SESSION["id"] == "Samsung"){ ?>
     <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/images/samsung.png"/>
     <?php }
	 else{
	  ?>
      <img alt="iphone image" class="fix img-responsive" src="<?php echo $base_url ?>/images/iphone.png"/>
      <?php } }?>
        <h2><?php echo $resultmemory['productdescription']?></h2>
     </div></a>
     </div>
     
     <div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">  
     <li><a href="<?php echo $base_url; ?>/<?php echo 'sell-'.str_replace(" ","-",$resultmemory['productdescription']); ?>/<?php echo $resultmemory['productid']?>">
     
      <?php
	 if($resultmemory['image_url'] != ""){
		 ?>
     <div class="prod_img">
     <img alt="cellphone image" class="cellimg" src="<?php echo $base_url ?>/productimages/<?php echo $resultmemory['image_url']; ?>"/>  </div>    
         <?php
	 }
	 else{ ?>
	 <?php if($_SESSION["id"] == "Samsung"){ ?>
     <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/images/samsung.png"/>
     <?php }
	 else{
	  ?>
      <img alt="iphone image" class="fix img-responsive" src="<?php echo $base_url ?>/images/iphone.png"/>
      <?php } }?>
        <h4><?php echo $resultmemory['productdescription']?></h4>
        <div style="clear:both;"></div>
     </a>
     </div>
     <?php } } ?>
    </ul>
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
<div class="<?php if($_GET['model'] != ''){ echo 'tab-pane fade tab_bg  active in' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab5">

<!--<div class="row text-center">
<h1 class="sub-heading">Model condition</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model condition</h2>-->
<?php
$queryproduct =  "SELECT * from product WHERE product.id=".$_SESSION['model'];
		
	$resultproducts = mysql_query($queryproduct);
	if(isset($_SESSION['model'])){
	$resultproduct = mysql_fetch_array($resultproducts);
	}
?>    
    <!--<h3 class="Sheading-styleh3">Your Selected Model is <span style="color:#000;"><?php echo $resultproduct['Description'] ;?></span></h3>
</div>--><!-- row --> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<h1 class="newheading1" style="font-size:24px; margin:0px;"><?php echo $resultproduct['Description'] ;?></h1>
<h2 class="newheading2" style="font-size:16px; margin:10px 0px 20px 0px;">It takes just a few minutes to sell your <?php echo $resultproduct['Description'] ;?></h2>
</div>
<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

     
<div class="navmobile" style="display:none;">
     <ul class="nav nav-tabs nav-stacked">  
     
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <li>
     <a href="">
     <div class="prod_img"><img class="cellimg" alt="cellphone image" src="<?php echo $base_url ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>    </div>
         <?php
	 }
	 else{
	 ?>
      <?php if($_SESSION["id"] == "Samsung"){ ?>
     <li><a href=""><div class="prod_img"><img class="cellimg" alt="samsung image" src="<?php echo $base_url ?>/images/samsung.png"/> </div>
      <?php } 
	  else{
	  ?>
     <li><a href=""><div class="prod_img"> <img class="cellimg" alt="cellphone image" src="<?php echo $base_url ?>/images/iphone.png"/></div>
      <?php } } ?>
        <h4><?php echo $resultproduct['Description']; ?></h4><div style="clear:both;"></div></li></a>
        
     
     </ul>
     </div>
     <div class="nomobile">
     <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block">
     <?php
	 if($resultproduct['image_url'] != ""){
		 ?>
     <img alt="cellphone image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/productimages/<?php echo $resultproduct['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
      <?php if($_SESSION["id"] == "Samsung"){ ?>
     <img alt="samsung image" class="fix img-responsive" style="height:179px;" src="<?php echo $base_url ?>/images/samsung.png"/> 
      <?php } 
	  else{
	  ?>
      <img alt="cellphone image" style="height:179px;" class="fix img-responsive" src="<?php echo $base_url ?>/images/iphone.png"/>
      <?php } } ?>
        <h2><?php echo $resultproduct['Description']; ?></h2>
     </div>
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
        <input id="choice-a" type="radio" name="g" value="1" style="margin-left: 30%;" />
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
     <p class="device-power">Does the device power on?</p>
   <input id="choice-yes" type="radio" name="gchoice" value="4" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">YES</p>
   <input id="choice-no" type="radio" name="gchoice" value="5" style="margin:0 0 0 5px; 0" /><p class="mobile-hidden inline">NO</p><div class="clearfix"></div>
   </div>
   
   <div id="good4" class="desc" style="display:none;">
    <form action="<?php echo $site_url; ?>/checkout2" method="post" name="brokenyesform">
   <h2 style="margin-top:0px;"> Your Phone is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>   <br>	<div>		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_1" />		<button type="button" id="coupon_code_btn_1" onclick="applyCouponCode('1','brokenyes')">Apply</button></p>	</div>	<div class="alert alert_1" style="display:none">	</div>	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_1">$<?php echo $resultproduct['brokenyes']; ?></span>
   <input type="hidden" name="condition" value="brokenyes" />	<input type="hidden" id="old_price_1" value="<?php echo $resultproduct['brokenyes']; ?>" /> 
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
   <!--<h2 style="margin-top:0px;"> Your Phone is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>Does power on properly</li>
		<li>Cracked glass or Screen is broken</li>
		<li>Backlight is not functioning properly</li>
		<li>Heavy scratches or scuffs on body</li>
		<li>Multiple dead pixels</li>
   </ul>-->	<br>	<div>		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_2" />		<button type="button" id="coupon_code_btn_2" onclick="applyCouponCode('2','brokenno')">Apply</button></p>	</div>	<div class="alert alert_2" style="display:none">	</div>	
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_2">$<?php echo $resultproduct['brokenno']; ?></span>
   <input type="hidden" name="condition" value="brokenno" />	<input type="hidden" id="old_price_2" value="<?php echo $resultproduct['brokenno']; ?>" />
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
 
   <div id="good1" class="desc" style="display:none; ">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="goodform">
   <h2> Your Phone is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>The item shows wear from consistent use, but it remains in good condition and works perfectly.</li>
        <li>It may be marked, have identifying markings on it, or show other signs of previous use.</li>
   </ul>	<br>	<div>		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_3" />		<button type="button" id="coupon_code_btn_3" onclick="applyCouponCode('3','good')">Apply</button></p>	</div>	<div class="alert alert_3" style="display:none">	</div>
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_3">$<?php echo $resultproduct['GoodPrice']; ?></span>
   
   <input type="hidden" name="condition" value="good" />	<input type="hidden" id="old_price_3" value="<?php echo $resultproduct['GoodPrice']; ?>" />
   <input type="hidden" name="price" id="price_3" value="<?php echo $resultproduct['GoodPrice']; ?>" />
	
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($resultproduct['GoodPrice'] > 0)
	{ ?>
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
	  <p>Please <a href="<?php echo $base_url ?>/recycling">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      
      <?php
	  }
  ?>
   </div>
   
   <div id="good2" class="desc" style="padding-top:20px;">
   <form action="<?php echo $site_url; ?>/checkout2" method="post" name="flawlessform">
   <h2> Your Phone is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		
        <li>An apparently untouched item in perfect condition.</li>
        <li> Original protective wrapping may be missing, but the original packaging is intact and pristine.</li>
        <li>There are absolutely no signs of wear on the item or its packaging. Instructions are included.</li>
        <li>Item is suitable for presenting as a gift.</li>

        
   </ul>	<br>	<div>		<p>Coupon Code:<input class="coupon_code" placeholder="Enter coupon" type="text" name="coupon_code" id="coupon_code_4" />		<button type="button" id="coupon_code_btn_4" onclick="applyCouponCode('4','Flawless')">Apply</button></p>	</div>	<div class="alert alert_4" style="display:none">	</div>
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span id="price_text_4">$<?php echo $resultproduct['FlawessPrice']; ?></span>
      <input type="hidden" name="condition" value="Flawless" />	<input type="hidden" id="old_price_4" value="<?php echo $resultproduct['FlawessPrice']; ?>" />   <input type="hidden" name="price" id="price_4" value="<?php echo $resultproduct['FlawessPrice']; ?>" />
   
   <!--<input type="hidden" name="condition" value="Flawless" />
   <input type="hidden" name="price" value="<?php echo $resultproduct['FlawessPrice']; ?>" />-->
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php if($resultproduct['FlawessPrice'] >0)
  {
	  ?>
  <button type="submit" class="getp-btn">get paid</button>
  <?php } ?>
  
  </div>
  
  </form>
  <?php if($resultproduct['FlawessPrice'] == 0)
  {
	  ?>
      
      <br />
      <p style="text-align:center; font-weight:bold; font-size:16px;">Unfortunately, we can't offer you any money for this item<p>
	  <p>Even though we can't pay you, we'd still like to help you recycle it responsibly.</p>
	  <p>Please <a href="<?php echo $base_url ?>/recycling">check out these recycling resources</a> for ideas on how you can recycle electronics simply and safely</p>
      
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


<!--Step 4 ENDS-->
<br /><br />

</div>

<?php
include "footer.php";
?><!--<script type="text/javascript" src="/js/coupon-code.js"></script> --><script>function applyCouponCode(index,condition){	var coupon_code = $("#coupon_code_"+index).val();	var model = $("#model").val();		$.ajax({		type:"GET",		url : "/apply-coupon-code.php",		data : "coupon_code="+coupon_code + "&model="+model + "&condition="+condition + "&index="+index,		async: false,		success : function(response) {			data = response;			return response;		},		error: function() {			alert('Error occured'+response);		}	});	var price = $("#old_price_"+index).val();	var arr = data.split(";");	var status = arr[1];	if(status == "INVALID"){		$(".alert_"+index).removeClass("alert-success");		$(".alert_"+index).addClass("alert-warning display-block");		$(".alert_"+index).html(arr[2]);				$("#price_text_"+index).html("$" + price);		$("#price_"+index).val(price);			}else{		var discount_price = arr[3];		var after_discount = Math.round(parseFloat(price)+parseFloat(discount_price));		$(".alert_"+index).removeClass("alert-warning");		$(".alert_"+index).addClass("alert-success display-block");		$(".alert_"+index).html(arr[2]);				$("#price_text_"+index).html(price + "+" + Math.round(discount_price) + "=" + after_discount);		$("#price_"+index).val(after_discount);	}}function removeCouponCode(coupon_code, index, condition){	var coupon_code = $("#coupon_code_"+index).val();	var model = $("#model").val();		$.ajax({		type:"GET",		url : "/remove-coupon-code.php",		data : "coupon_code="+coupon_code + "&model="+model + "&condition="+condition + "&index="+index,		async: false,		success : function(response) {			data = response;			return response;		},		error: function() {			alert('Error occured');		}	});	var price = $("#old_price_"+index).val();		$(".alert_"+index).removeClass("alert-success");	$(".alert_"+index).addClass("alert-warning display-block");	$(".alert_"+index).html("Coupon Code removed successfully.");		$("#price_text_"+index).html("$" + price);	$("#price_"+index).val(price);}  $( function() {	  if($( "#coupon_code" ).val() != ""){		  var ind = $( "#coupon_code_index" ).val();		  var cond = $( "#coupon_code_condition" ).val();		 $("#coupon_code_"+ind).val($( "#coupon_code" ).val());	     applyCouponCode(ind,cond) 	  }	    } );</script>

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