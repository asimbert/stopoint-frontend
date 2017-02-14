<?php require("inc/config.php"); ?>
<?php
//$projectsearch=$_GET['id'];
//$minamountnew = $_GET['minamount'];
//$minamount = $minamountnew *100;
?>
<?php
 $_SESSION['wherevalue'] = $_POST['subId'].'"'; 
 
?>
<div style="visibility:hidden;" class="tooltip_heading" data-toggle="modal" data-target="#MacModal">How to find your system specifications?</div>

     <h2 class="lapth2">Select Processor</h2>
  
     <select name="Scsize" class="compsfec" id="processor" onchange="getComboB(this)">
                                            <option value="">Select Processor</option>
                            
                            <?php


 $querymemory =  "SELECT    DISTINCT product.CPU as 'cpu' from product  INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 2 AND  productfamily.Name ='".$_SESSION['specification']."' AND product.ScreenSize='".$_SESSION['wherevalue']."'  AND productbrand.Name ='".$_SESSION['id']."'";

$resultmemoriesp = mysql_query($querymemory);
	while($resultmemoryp = mysql_fetch_array($resultmemoriesp)){
?>
                            
                                             
                                              
                                            <option value="<?php echo $resultmemoryp['cpu']?>"><?php echo $resultmemoryp['pscreensize']?>&nbsp;<?php echo $resultmemoryp['cpu']?></option>
                                        
                                          
                                                             
                                              
                                           <?php
										   #$selected_val = $_POST['Scsize']; 
										   
										    } ?>
                                        
                                          
                               </select>
                               
  


                   
                

  


