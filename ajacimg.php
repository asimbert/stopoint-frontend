<?php require("inc/config.php"); ?>
<?php
//$projectsearch=$_GET['id'];
//$minamountnew = $_GET['minamount'];
//$minamount = $minamountnew *100;
?>
<?php
 $_SESSION['whereimg'] = $_POST['subimg']; 
 
  $_SESSION['whereimg'];
 
 
?>
<h2>Select Model</h2>

			<?php
                if($_SESSION["id"] == "Microsoft"){
            ?>
			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#microsoftipadspecificationModal">What is my tablet's capacity?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="microsoftipadspecificationModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">What is my tablet's capacity?</h4>
						</div>
						<div class="modal-body">
                                Follow these steps to find the capacity:
                                <br>
                                -From the Start screen, tap or click Desktop.
                                <br>
                                -Tap or click the File Explorer icon on the taskbar (appears as a file folder).
                                <br>
                                -Tap or click Computer from the column on the left.
                                <br>
                                -The amount of storage space on your hard disk is shown (for example, 16 GB free of 24 GB).  
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
			
			<?php
                if($_SESSION["id"] == "Google"){
            ?>
			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#googleipadspecificationModal">What is my tablet's capacity?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="googleipadspecificationModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">What is my tablet's capacity?</h4>
						</div>
						<div class="modal-body">
                              The capacity can be found in the device Settings menu. 
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
			
			<?php
                if($_SESSION["id"] == "Samsung"){
            ?>
			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#samsungipadspecificationModal">Which model do I have?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="samsungipadspecificationModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Which model do I have?</h4>
						</div>
						<div class="modal-body">
                             The model number can be found in the device Settings menu.  The smaller Galaxy Note device can be found in the Samsung Cell Phone section. 
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
      
			<?php
                if($_SESSION["id"] == "Apple"){
            ?>
			<div style="cursor:pointer" class="tooltip_heading" data-toggle="modal" data-target="#appleipadspecificationModal">What is my iPad's capacity?</div>
            <?php
				}
			?>
      		<!--Modal-->
			<div class="modal fade" id="appleipadspecificationModal" role="dialog">
				<div class="modal-dialog">
      			<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">What is my iPad's capacity?</h4>
						</div>
						<div class="modal-body">
                            You can find your iPad's capacity in Settings > General > About. 
						</div>
					</div>  
				</div>
			</div>
      <!--Modal-->
<?php 
if($_SESSION['id'] != "Apple"){
//Commented because iPad was being matched by iPad Mini, iPad Pro etc.
//$querycarrier = "SELECT product.id as 'productid', product.Description as `productdescription` , product.StorageCapacity as 'storagecapacity', product.image_url as 'image_url' , productfamily.Name as 'familyname', productbrand.Name as 'brandname', carriers.Name as carriersname  from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."' AND productfamily.Name like '%".$_SESSION['family']."%' AND carriers.Name='".$_SESSION['whereimg']."'";	

$querycarrier = "SELECT product.id as 'productid', product.Description as `productdescription` , product.StorageCapacity as 'storagecapacity', product.image_url as 'image_url' , productfamily.Name as 'familyname', productbrand.Name as 'brandname', carriers.Name as carriersname  from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."' AND productfamily.Name = '".$_SESSION['family']."' AND carriers.Name='".$_SESSION['whereimg']."'";	
	}
	else{
//Commented - See above comment for the query.
//$querycarrier = "SELECT product.id as 'productid', product.Description as `productdescription` , product.StorageCapacity as 'storagecapacity' , product.image_url as 'image_url' , productfamily.Name as 'familyname' ,productbrand.Name as 'brandname' , carriers.Name as carriersname  from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."' AND productfamily.Name like'%".$_SESSION['family']."%' AND product.Generation='".$_SESSION['generation']."' AND carriers.Name='".$_SESSION['whereimg']."'";

$querycarrier = "SELECT product.id as 'productid', product.Description as `productdescription` , product.StorageCapacity as 'storagecapacity' , product.image_url as 'image_url' , productfamily.Name as 'familyname' ,productbrand.Name as 'brandname' , carriers.Name as carriersname  from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 3 AND productbrand.Name ='".$_SESSION['id']."' AND productfamily.Name ='".$_SESSION['family']."' AND product.Generation='".$_SESSION['generation']."' AND carriers.Name='".$_SESSION['whereimg']."'";
	}
$resultcarrier = mysql_query($querycarrier);
$resultnumber = mysql_num_rows($resultcarrier);
if($resultnumber == 0){
	?>
    <h3 class="Sheading-error">This Family <span style="color:#000;"><?php echo $_SESSION['family'];?></span> and generation <span style="color:#000;"><?php echo $_SESSION['generation'];?></span>, <span style="color:#000;"><?php echo $_SESSION['whereimg'];?></span> don't have any model</h3>
    <?php
	
	}

else{
	while($resultcarr = mysql_fetch_array($resultcarrier)){
		
		//$modelname = $resultcarr['familyname'];
?>
<a href='<?php echo $site_url; ?>/sell-<?php echo str_replace(" ","-",str_replace('"', 'inches', $resultcarr['productdescription']));?>/<?php echo $resultcarr['productid']; ?>'><div class="portfolio-block col-lg-3 col-md-3 col-sm-4">
 <?php
	 if($resultcarr['image_url'] != ""){
		 ?>
     <img class="fix img-responsive" style="height:179px;" src="<?php echo $site_url; ?>/productimages/<?php echo $resultcarr['image_url']; ?>"/>      
         <?php
	 }
	 else{
	 ?>
     <img src="<?php echo $site_url; ?>/images/gen.png" class="fix img-responsive" alt="carrier">
     <?php } ?>
     <h2><?php echo str_replace('"', ' inches',$resultcarr['productdescription']); ?></h2>
     </div></a>
<?php } } ?>