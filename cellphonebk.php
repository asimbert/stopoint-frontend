v<?php
include "header.php";

// Start the session
session_start();
if(!isset($_GET['id']) && !isset($_GET['phone']) && !isset($_GET['carrier']) && !isset($_GET['model'])){
	
 unset($_SESSION['model']);
 unset($_SESSION['carrier']);
 unset($_SESSION['phone']);
 unset($_SESSION['id']);
 
unset($_SESSION['condition']);
 unset($_SESSION['address1']);
 unset($_SESSION['address2']);
 unset($_SESSION['city']);
 unset($_SESSION['state']);
 unset($_SESSION['zip']);
 unset($_SESSION['phone']);
  unset($_SESSION['country']);
  unset($_SESSION['specification']);
  unset($_SESSION['computer']);
	}
if(isset($_GET['ps'])){
	 $_SESSION['id'] = mysql_real_escape_string($_GET['id']);
	  $id = $_SESSION['id'];
 $_SESSION['phone'] = mysql_real_escape_string($_GET['phone']);
  $phone = $_SESSION['phone'];
	
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
$model = $_SESSION["model"];

?>
<!-- steps --> 

<div class=" step container-fluid">
<div class="container">
<ul class=" step-tab nav nav-justified  tabs">
<?php

 ?>
      <li class="<?php if($_GET['id'] == '' && $_GET['phone'] =='' && $_GET['carrier'] =='' && $_GET['model'] ==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab1" data-toggle="tab"><div class="step-no">1</div>SELECT BRAND</a></li>
 
    <li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab2" <?php if(isset($_SESSION['id'])){?> data-toggle="tab" <?php } ?>><div class="step-no">2</div>SELECT MODEL</a></li>
    
    <li class="<?php if($_GET['id'] != '' && $_GET['ps']==''){echo 'active';} elseif ($_GET['phone'] != ''){ echo 'active' ;} else { echo '' ;}?>"><a href="#tab3" <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?>><div class="step-no">3</div>SELECT CARRIER</a></li>
    
     
      <li class="<?php if($_GET['carrier'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab4" <?php if(isset($_SESSION['model'])){?> data-toggle="tab" <?php } ?>><div class="step-no">4</div>PHONE SPECIFICATION</a></li>
      <li class="<?php if($_GET['model'] != ''){ echo 'active' ;} else { echo '' ;} ?>"><a href="#tab5" <?php if(isset($_SESSION['carrier'])){?> data-toggle="tab" <?php } ?>><div class="step-no">5</div>WHAT SHAPE IS</a></li>
    </ul>
</div><!-- end container --> 
</div><!-- end container-fluid --> 

<div class="container tab-content">
<!-- row --> 
<div class="tab-pane fade tab_bg <?php if($_GET['id'] == '' && $_GET['phone'] =='' && $_GET['carrier'] =='' && $_GET['model'] =='' ){ echo 'active in' ;} else { echo 'inactive' ;} ?>" id="tab1">
<div class="row text-center">
<h1 class="sub-heading">BRAND</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR BRAND TO CONTINUE</h2>
</div>

<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="port-1">
      <?php
	  $querybrand =  "SELECT DISTINCT productbrand.Name as `brandname` from product INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 1";
	$resultbrands = mysql_query($querybrand);
	while($resultbrand = mysql_fetch_array($resultbrands)){
	
	  ?>
        <!--<a href="?id=apple"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <img class="fix img-responsive" src="images/iphone.png"/>
        <h2>Apple</h2>
          
        </div></a>-->
        <a href="?id=<?php echo $resultbrand['brandname']; ?>"><div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
        <?php if($resultbrand['brandname'] == 'Samsung'){ ?>
        <img class="fix img-responsive" style="width:180px;" src="images/samsung.png" alt="Samsung"/>
           <?php } else{
			   ?>
               <img class="fix img-responsive" src="images/iphone.png" alt="IPhone"/>
               <?php
			   } ?>
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


    
    
<div class="<?php if($_GET['id'] != ''  &&  $_GET['ps']==''){ echo 'tab-pane fade tab_bg active in' ;} elseif($_GET['ps']!='' && $_GET['id'] != '' && $_GET['phone'] !=''){echo 'tab-pane fade tab_bg' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab2">
<div class="row text-center">
<h1 class="sub-heading">MODEL</h1>

<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR MODEL TO CONTINUE</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3 ">Your Selected Brand is <span style="color:#000;"><?php echo $id; ?></span></h3>
</div>


<!--Tabs Start-->
<div class="row tab-container"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
    <!-- Tab panes -->
    <div class="tab-content">
  
      <div class="tab-pane fade in active" id="port-1">
      <?php
		
		if($_SESSION["id"] == "Apple"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=1";
		}
		
		if($_SESSION["id"] == "Samsung"){
		$queryfamilyy =  "SELECT DISTINCT productfamily.Name as `familyname` from product INNER JOIN `productfamily` ON productfamily.id=product.FamilyId WHERE product.CategoryId = 1 AND product.BrandId=2";
		}
		
	$resultfamiliess = mysql_query($queryfamilyy);
	while($resultfamilyy = mysql_fetch_array($resultfamiliess)){
		?>
        <?php if($_SESSION["id"] == "Samsung"){ ?>
        <a href="?phone=<?php echo $resultfamilyy['familyname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <img class="fix img-responsive" style="height:179px;" src="images/samsung.png"  alt="<?=$resultfamily2['familyname']?>"/>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php }
		else{
		 ?>
         <a href="?phone=<?php echo $resultfamilyy['familyname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> 
        <img class="fix img-responsive" src="images/iphone.png"  alt="<?=$resultfamily2['familyname']?>"/>
        <h2><?php echo $resultfamilyy['familyname']; ?></h2>
          
        </div></a>
        <?php } } ?>
      <!--   
       <a href="?phone=iphone4s"> <div class="col-lg-3 col-md-3 col-sm-3 portfolio-block"> 
        <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>iPhone 4S</h2>
        </div></a>
         
        <a href="?phone=iphone5"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>iPhone 5</h2> 
        </div></a>
        <a href="?phone=iphone5c"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>iPhone 5C</h2> 
        </div></a>
        <a href="?phone=iphone5s"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>iPhone 5S</h2> 
        </div></a>
        <a href="?phone=iphone6"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
          <h2>iPhone 6</h2> 
        </div></a>
        
        <a href="?phone=iphone6p"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>IPhone 6 Plus</h2>
        </div></a>-->
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
		
	$resultfamilies2 = mysql_query($queryfamily2);
	while($resultfamily2 = mysql_fetch_array($resultfamilies2)){
		?>
      <div class="tab-pane fade" id="port-<?php echo $count2; ?>">
      <?php if($_SESSION["id"] == "Samsung"){ ?>
        <a href="?phone=<?php echo $resultfamily2['familyname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" style="height:179px;" src="images/samsung.png" alt="<?=$resultfamily2['familyname']?>"/>
          <h2><?php echo $resultfamily2['familyname']; ?></h2> 
        </div></a>
        
        <?php }
		else{
			?>
            <a href="?phone=<?php echo $resultfamily2['familyname']; ?>"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png" alt="<?=$resultfamily2['familyname']?>"/>
          <h2><?php echo $resultfamily2['familyname']; ?></h2> 
        </div></a>
            <?php
			}
		 ?>
         
      </div>
      <?php $count2++; } ?>
      <!-- end port 2 -->
      <!--<div class="tab-pane fade" id="port-3">
       <a href="?phone=iphone4s"> <div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>IPhone 4S</h2> 
        </div></a>
       
       
        
        
      </div>-->
      <!-- end port 3 -->
      <!--<div class="tab-pane fade" id="port-4">
       <a href="?phone=iphone5"> <div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
         <h2>IPhone 5</h2>
        </div></a>
       
        
       
      </div>-->
      <!-- end port 4 -->
      <!--<div class="tab-pane fade" id="port-5">
       <a href="?phone=iphone5c"> <div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
         <h2>IPhone 5C</h2> 
        </div></a>
        
        
      </div>-->
      <!-- end port 5 -->
      <!--<div class="tab-pane fade" id="port-6">
       <a href="?phone=iphone5s"> <div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
           <h2>IPhone 5S</h2> 
        </div></a>
        
      </div>-->
      <!-- end port 6 -->
      <!--<div class="tab-pane fade" id="port-7">
        <a href="?phone=iphone6"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
         <h2>IPhone 6</h2> 
        </div></a>
      </div>-->
      <!-- end port 7 --> 
      <!--<div class="tab-pane fade" id="port-8">
        <a href="?phone=iphone6p"><div class="portfolio-block col-lg-3 col-md-3 col-sm-4"> <img class="fix img-responsive" src="images/iphone.png"/>
         <h2>IPhone 6 Plus</h2> 
        </div></a>
        
       
      </div>-->
      <!-- end port 8 -->
    </div>
    </div>
 <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div> 
  </div>

<!--Tabs ENDS-->
</div>
<div class="<?php if($_GET['ps']!='' && $_GET['id'] != '' && $_GET['phone'] !=''){echo 'tab-pane fade tab_bg  active in' ;}else{if($_GET['phone'] != ''){ echo 'tab-pane fade tab_bg  active in' ;} else { echo 'tab-pane fade tab_bg' ;} }?>" id="tab3">

<div class="row text-center">
<h1 class="sub-heading">SELECT CARRIER</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">PLEASE SELECT YOUR CARRIER TO CONTINUE</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Model <u><?php echo $phone ;?></u></h3>
</div><!-- row --> 

<div class="row pad"> 
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

     <a href="?carrier=ATT"><div class="col-lg-3 col-md-3 col-sm-3 carrboxc1">
     <img src="images/at&t.png" class="img-responsive" alt="carrier">
     </div></a>
     <a href="?carrier=Sprint"><div class="col-lg-3 col-md-3 col-sm-3 carrboxc1">
     <img src="images/sprint.png" class="img-responsive" alt="carrier">
     </div></a>
     <div class="col-lg-3 col-md-3 col-sm-3 carrboxc1">
     <a href="?carrier=T-Mobile"><img src="images/tmobile.png" class="img-responsive" alt="carrier"></a>
     </div>
     <a href="?carrier=Verizom"><div class="col-lg-3 col-md-3 col-sm-3 carrboxc1">
     <img src="images/Verizon_Logo.png" class="img-responsive" alt="carrier">
     </div></a>
    </div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

     <a href="?carrier=Unlocked"><div class="col-lg-3 col-md-3 col-sm-3 carrboxc1">
     <img src="images/funlock.png" class="img-responsive" alt="carrier">
     </div></a>
     
    </div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
</div>



</div>

<!--Step 3 Starts-->
<div class="<?php if($_GET['carrier'] != ''){ echo 'tab-pane fade tab_bg  active in' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab4">

<div class="row text-center">
<h1 class="sub-heading">Model Memory</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model memory</h2>
    <div class="underline1"></div>
    <h3 class="Sheading-styleh3">Your Selected Model <u><?php echo $phone ;?></u> And Your Selected Carrier <u><?php echo $carrier ;?></u></h3>
</div><!-- row --> 

<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<?php
/*echo $_SESSION["carrier"];
echo $_SESSION["id"];
echo $_SESSION['phone'];*/

 $querymemory =  "SELECT product.id as productid , product.Description as `productdescription` , product.StorageCapacity as 'storagecapacity' from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productbrand` ON productbrand.id=product.BrandId WHERE product.CategoryId = 1 AND carriers.Name='".$_SESSION['carrier']."' AND productfamily.Name ='".$_SESSION['phone']."' AND productbrand.Name ='".$_SESSION['id']."'";
$resultmemories = mysql_query($querymemory);
	while($resultmemory = mysql_fetch_array($resultmemories)){
?>
     <a href="?model=<?php echo $resultmemory['productid']?>"><div class="col-lg-3 col-md-3 col-sm-3 carrbox">
      <?php if($_SESSION["id"] == "Samsung"){ ?>
     <img class="fix" style="height:179px;" src="images/samsung.png" alt="Samsung"/>
     <?php }
	 else{
	  ?>
      <img class="fix" src="images/iphone.png" alt="IPhone"/>
      <?php } ?>
        <h2><?php echo $phone ; ?>&nbsp;<span><?php echo $resultmemory['storagecapacity']?></span>&nbsp;<?php echo $carrier ; ?></h2>
     </div></a>
     <!--<a href="?model=iphone4-16gb"><div class="col-lg-3 col-md-3 col-sm-3 carrbox">
     <img class="fix" src="images/iphone.png"/>
       <h2>iPhone 4&nbsp;<span>16GB</span> (AT&T)</h2>
     </div></a>
     <a href="?model=iphone4-8gb"><div class="col-lg-3 col-md-3 col-sm-3 carrbox">
     <img class="fix" src="images/iphone.png"/>
       <h2>iPhone 4&nbsp;<span>32GB</span> (AT&T)</h2>
     </div></a>-->
     <?php } ?>
    </div>

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
 <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
</div>
</div>



</div>
<!--Step 3 ENDS-->

<!--Step 4 Starts-->
<div class="<?php if($_GET['model'] != ''){ echo 'tab-pane fade tab_bg  active in' ;} else { echo 'tab-pane fade tab_bg' ;} ?>" id="tab5">

<div class="row text-center">
<h1 class="sub-heading">Model condition</h1>
<div class="underline1"></div>
    <h2 class="Sheading-style1 ">Please Select your model condition</h2>
</div><!-- row --> 

<div class="row pad">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
<?php
$queryproduct =  "SELECT * from product WHERE product.id=".$_SESSION['model'];
		
	$resultproducts = mysql_query($queryproduct);
	$resultproduct = mysql_fetch_array($resultproducts);
?>
     <div class="col-lg-3 col-md-3 col-sm-3 mcollect">
      <?php if($_SESSION["id"] == "Samsung"){ ?>
     <img class="fix" style="height:179px;" src="images/samsung.png" alt="Samsung"/> 
      <?php } 
	  else{
	  ?>
      <img class="fix" src="images/iphone.png" alt="IPhone"/>
      <?php } ?>
     
        <h2><?php echo $resultproduct['Description']; ?></h2>
     </div>
     <div class="col-lg-8 col-md-8 col-sm-8 mcollectdt">
       <h1>What shape is it in?</h1>
       
    	
    
    <div class="radio-group">
    
        <input id="choice-a" type="radio" name="g" value="1"  checked/>
        <label for='choice-a'>
            <span></span>
            Good<p class="plabelp">Visible signs of use</p>                          
        </label>
    
        <input id="choice-b" type="radio" name="g" value="2" style="margin-left: 30%;"/>
        <label for='choice-b'>
            <span></span>
            Flawless <p class="plabelp">Looks like it's never been used</p>
        </label>
    
</div> 
     
<script type="text/javascript">
$(document).ready(function() {
    $("input[name$='g']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#good" + test).show();
    });
});
</script>
   <div id="good1" class="desc">
   <form action="checkout2.php" method="post" name="goodform">
   <h2> Your Phone is in this condition if any of the following are true:</h2>
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
      <span>You could make offer to this product</span>
      <?php
	  }
  ?>
   </div>
   
   <div id="good2" class="desc" style="display:none;">
   <form action="checkout2.php" method="post" name="flawlessform">
   <h2> Your Phone is in this condition if any of the following are true:</h2>
   <ul class="step4ul">
   		<li>The item shows wear from consistent use, but it remains in good condition and works perfectly.</li>
        <li>It may be marked, have identifying markings on it, or show other signs of previous use.</li>
        
   </ul>
   <div class="step4l"><p>Your Stopoint Offer:&nbsp;&nbsp;<span>$<?php echo $resultproduct['FlawessPrice']; ?></span>
   <input type="hidden" name="condition" value="Flawless" />
   <input type="hidden" name="price" value="<?php echo $resultproduct['FlawessPrice']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <!--<form action="checkout2.php" id="checkoutform2" name="checkoutform2" method="post">
   <input type="hidden" name="model" value="<?php //echo $_SESSION['model'] ?>" />
    <input type="hidden" name="carrier" value="<?php //echo $_SESSION['carrier'] ?>" />
     <input type="hidden" name="phone" value="<?php //echo $_SESSION['phone'] ?>" />-->
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
      <span>You could make offer to this product</span>
      <?php
	  }
  ?>
  <!-- </form>-->
   </div>
     <p class="pmsgb">Note : As part of our trading process with our customers, we make it clear that we do not accept lost or stolen items.</p>
     </div>
     
     
    </div>


</div>



</div>
<!--Step 4 ENDS-->

</div>

<?php
include "footer.php";
?>