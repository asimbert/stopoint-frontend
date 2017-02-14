<?php
	require("inc/config.php");
 	$_SESSION['wheresize'] = $_POST['subId'];  
?>


     <h2>Select Band</h2>
  



  
     <select name="Scsize" class="compsfec" id="processor" onchange="getComboBS(this)">
                                            <option value="">Select Band</option>
                            
                            <?php


  $querymemory =  "SELECT  product.ScreenSize as 'pscreensize' , product.Band as 'pband' from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 5 AND productfamily.Name ='".$_SESSION['id']."' AND product.Generation = '".$_SESSION['specification']."' AND product.ScreenSize = '".$_SESSION['wheresize']."'";

$resultmemoriesp = mysql_query($querymemory);
	while($resultmemoryp = mysql_fetch_array($resultmemoriesp)){
?>
                            
                                             
                                              
                                            <option value="<?php echo $resultmemoryp['pband']?>"><?php echo $resultmemoryp['pband']?></option>
                                        
                                          
                                                             
                                              
                                           <?php
										   #$selected_val = $_POST['Scsize']; 
										   
										    } ?>
                                        
                                          
                               </select>
                               
  


                   
                

  


