<?php require("inc/config.php"); ?>

<?php

//$projectsearch=$_GET['id'];

//$minamountnew = $_GET['minamount'];

//$minamount = $minamountnew *100;

?>

<?php

 $_SESSION['wherehard'] = $_POST['subIh']; 

  



 

?>





     <h2 class="lapth2">Select Model</h2>

  

     

                            

                            <?php





  $querymemoryh =  "SELECT  product.ScreenSize as 'pscreensize' ,product.Generation as 'pgeneration' ,product.image_url as 'image_url' , product.id as 'productid' , product.Band as 'pband', productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 5 AND productfamily.Name ='".$_SESSION['id']."' AND product.Generation = '".$_SESSION['specification']."' AND product.ScreenSize = '".$_SESSION['wheresize']."' AND product.Band = '".$_SESSION['wherehard']."'";

  

 // $sspz = $resultmemoryph['psct'];



$resultmemoriesh = mysql_query($querymemoryh);

	while($resultmemoryph = mysql_fetch_array($resultmemoriesh)){

?>

                            

                                             

                                              

                                           <a href="<?php echo $base_url; ?>/sell/watch/<?php echo str_replace(" ","-",$resultmemoryph['familyname']); ?>/<?php echo str_replace(" ","-",$resultmemoryph['pgeneration']); ?>/<?php echo $resultmemoryph['productid']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 

                                          <?php

	 if($resultmemoryph['image_url'] != ""){

		 ?>

     <img class="fix img-responsive" style="height:179px;" src="<?php echo $site_url; ?>/productimages/<?php echo $resultmemoryph['image_url']; ?>"/>      

         <?php

	 }

	 else{

	 ?>   

                                           <img class="fix img-responsive" style="height:179px;" src="<?php echo $base_url; ?>/images/apple_watch.png"/>

           <?php } ?>

        <h2 style="font-size: 16px; !important"><?php echo $resultmemoryph['pgeneration']; ?>&nbsp;<span><?php echo $resultmemoryph['pscreensize']; ?></span>&nbsp;<?php echo $resultmemoryph['pband']; ?></h2>

        </div></a>

                                        

                                          

                                                             

                                              

                                           <?php

										   #$selected_val = $_POST['Scsize']; 

										   

										    } ?>