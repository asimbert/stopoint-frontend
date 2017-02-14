<?php require("inc/config.php"); ?>
<?php
//$projectsearch=$_GET['id'];
//$minamountnew = $_GET['minamount'];
//$minamount = $minamountnew *100;
?>
<?php
 $_SESSION['wherehard'] = $_POST['subIh']; 
  

 
?>

<div style="visibility:hidden;" class="tooltip_heading" data-toggle="modal" data-target="#MacModal">How to find your system specifications?</div>
     <h2 class="lapth2">Select Hard Drive Size</h2>
  
     <select name="Scsize" class="compsfec" id="sHard" onchange="location = this.options[this.selectedIndex].value;">
                                            <option value="">Select Hard Drive Size</option>
                            
                            <?php

if($_SESSION['specification'] == 'Mac Mini'){
  $querymemoryh =  "SELECT DISTINCT product.StorageCapacity as 'psct',product.CPU as 'cpu',productfamily.Name as `familyname`,productbrand.Name as `brandname` from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND  productfamily.Name ='".$_SESSION['specification']."' AND product.ScreenSize=''  AND product.CPU ='".$_SESSION['wherehard']."' AND productbrand.Name ='".$_SESSION['id']."'";
  }
  else{
	   $querymemoryh =  "SELECT DISTINCT product.StorageCapacity as 'psct' ,product.CPU as 'cpu',productfamily.Name as `familyname`,productbrand.Name as `brandname` from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND  productfamily.Name ='".$_SESSION['specification']."' AND product.ScreenSize='".$_SESSION['wherevalue']."'  AND product.CPU ='".$_SESSION['wherehard']."' AND productbrand.Name ='".$_SESSION['id']."'";
	  }
 // $sspz = $resultmemoryph['psct'];

$resultmemoriesh = mysql_query($querymemoryh);
	while($resultmemoryph = mysql_fetch_array($resultmemoriesh)){
?>
                            
                                             
                                              
                                            <option value="<?php echo $base_url; ?>/sell/computers/<?php echo $resultmemoryph['brandname']; ?>/<?php echo str_replace(" ","-",$resultmemoryph['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemoryph['psct']);?>/<?php echo str_replace(" ","-",$_SESSION['wherehard']); ?>/<?php echo $_SESSION['wherevalue']; ?>"><?php echo $resultmemoryph['psct']?></option>
                                        
                                          
                                                             
                                              
                                           <?php
										   #$selected_val = $_POST['Scsize']; 
										   
										    } ?>
                                        
                                          
                               </select>
                               
  


                   
                

  


