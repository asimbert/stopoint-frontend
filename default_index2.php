<?php

// Permanent 301 Redirect via PHP

//header( "HTTP/1.1 301 Moved Permanently" ); 

include "mod_rewrite.php";

include "header.php";

$query = "SELECT testimonial.id as TestimonailId, testimonial.UserId as UserId, testimonial.OrderId as OrderId, testimonial.Name as Title, testimonial.Contents as Contents, testimonial.Date as Date, testimonial.ShowOnHomePage as ShowOnHomePage, testimonial.UserName as Name FROM `testimonial` WHERE ShowOnHomePage=1 ORDER BY testimonial.Date desc ";

$retestimonials=mysql_query($query);

mysql_num_rows($retestimonials);

$i = 0;

while($wetestimonials=mysql_fetch_array($retestimonials)){

$date= date('m.d.Y', strtotime($wetestimonials['Date']));

$testimonial[$i] = array();

array_push($testimonial[$i], $wetestimonials['TestimonailId'], $wetestimonials['UserId'], $wetestimonials['OrderId'], $wetestimonials['Title'], $wetestimonials['Contents'], $date, $wetestimonials['ShowOnHomePage'], $wetestimonials['Name'], $wetestimonials['Image']);

$i = $i + 1;

}

$query = "SELECT productcategory.Name as categoryname, productbrand.Name as brandname, productfamily.Name as familyname,productfamily.image_url as image_url FROM `productfamily` INNER JOIN `productcategory` ON productcategory.Id=productfamily.CategoryId INNER JOIN `productbrand` ON productbrand.id=productfamily.BrandId  WHERE productfamily.IsHot = 1";

$rehotitems=mysql_query($query);

?>

<!-- Index Page Desktop Version -->
<link rel="stylesheet" href="assets/css/give-5-style.css">
<div class="desktop-home">
<?php
if($_GET['lg'] == 'err_log'){
	?>
<div class="alert alert-danger" style="margin:0px; text-align:center;background-color: #20b2aa;color: #fff;border-color: transparent; border-color:transparent; border-radius:0px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> You have successfully logged out.</strong>
  	</div>
   <?php } ?>
<div class="slider container-fluid text-center img-responsive">

<div class="col-lg-6 col-md-6">

</div>

<div class="col-lg-6 col-md-6 col-lg-offset-6">

  <h1 style="font-size:35px; margin-top:0px; margin-bottom:7px">TRADE-IN YOUR CELL PHONE <span>& </span> ELECTRONIC</h1>

  <h2 style="font-size:31px; margin-bottom:20px;">Your Offer is Just Seconds Away</h2>
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

  <a href="<?php echo $base_url; ?>/sell/cell-phone/iphone"><img class="" style="float:right; width:211px;" src="<?php echo $base_url; ?>/images/index-banner-b1.png" alt="index banner" /></a>

  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

  <a href="<?php echo $base_url; ?>/sell-now"><img class="" style="float:left; width:211px; min-height:81px;" src="<?php echo $base_url; ?>/images/index-banner-b3.png" alt="index-banner-3" /></a>

  </div>

<div class="col-lg-12 text-center services1">

    <ul style="margin-top:10px; padding:0px;">

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon9.png" alt="FREE-SHIPPING Icon"/>Free Shipping</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon10.png" alt="FREE-QUOTE Icon"/>30 Days Lock-in Price</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon11.png" alt="NO-RISK Icon"/>No Risk</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon12.png" alt="PRICE-GUARANTEED Icon"/>Get Paid in 24 Hrs</li>

    </ul>

    </div>
</div>

</div>

<div class="hiw container">

  <div class="row text-center" style="margin-bottom:25px;">

    <h1 class="Mheding-style1 ">How It Works</h1>

    <div class="underline1"></div>

    <h2 class="Sheading-style1 ">3 EASY STEPS</h2>

  </div>

  <div class="row">

    <div class="text-center col-lg-4 col-md-4 col-sm-4">

      <div class="steps bg1">

        <div class="count">1</div>

        <h1>GET A FREE OFFER</h1>

        <p>Simply find your gadget and answer a few easy questions.</p>

      </div>

    </div>

    <div class=" text-center col-lg-4 col-md-4 col-sm-4 " >

      <div class="steps bg2">

        <div class="count">2</div>

        <h1>SHIP IT TO STOPOINT</h1>

        <p>Print out your pre-paid shipping label, pack your device and drop it at any Fedex Store.</p>

      </div>

    </div>

    <div class="text-center col-lg-4 col-md-4 col-sm-4" >

      <div class="steps bg3">

        <div class="count">3</div>

        <h1>GET PAID FAST</h1>

        <p>Get paid via PayPal within 24 hours, or receive a check on your mailbox in 3 days.</p>

      </div>

    </div>

  </div>

  <div class="button"><a href="<?php echo $base_url; ?>/sell-now"> Sell Now</a></div>

</div>

<div class="container-fluid hotitems">

  <div class="row text-center">

    <h1 class="Mheding-style1 color">Sell Your Gadgets</h1>

    <p class="detail col-lg-8 col-lg-offset-2"></p>

  </div>

  <div class="row">

    <div class="col-lg-8 col-lg-offset-2 text-center services" style="background-color:#f4f4f4; opacity:0.8">

    <ul style="margin-top:10px; padding:0px;">

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon9.png" alt="FREE-SHIPPING Icon"/>Free Shipping</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon10.png" alt="FREE-QUOTE Icon"/>30 Days Lock-in Price</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon11.png" alt="NO-RISK Icon"/>No Risk</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon12.png" alt="PRICE-GUARANTEED Icon"/>Get Paid in 24 Hrs</li>

    </ul>

    </div>

  </div>

  <a class="btn prev"> &lt; </a>

  <a class="btn next"> <?=">"?> </a>

<div class="container">

 <div id="owl-demo" class="owl-carousel ">

 		<?php

		while($wehotitems=mysql_fetch_array($rehotitems)){

			if($wehotitems['categoryname'] == "Cell Phone"){

		?><div class="item"><a href="<?php echo $base_url; ?>/sell/cell-phone/<?= str_replace(" ","-",$wehotitems['brandname']); ?>/<?= str_replace(" ","-",$wehotitems['familyname']) ;?>"><p><?=$wehotitems['familyname']?></p><img height="225" class="fix img-reponsive" src="<?php echo $base_url; ?>/productimages/<?=$wehotitems['image_url']?>" alt="Cell Phone"/></a></div>		

			<?php	}

			

			if($wehotitems['categoryname'] == "Computers"){

		?><div class="item"><a href="<?php echo $base_url; ?>/sell/computers/<?=str_replace(" ","-",$wehotitems['brandname']);?>/<?= str_replace(" ","-",$wehotitems['familyname']);?>"><p><?=$wehotitems['familyname']?></p><img height="225" class="fix img-reponsive" src="<?php echo $base_url; ?>/productimages/<?=$wehotitems['image_url']?>" alt="Laptops"/></a></div>		

			<?php	}

			

			if($wehotitems['categoryname'] == "Tablets"){

		?><div class="item"><a href="<?php echo $base_url; ?>/sell/tablet/<?= str_replace(" ","-",$wehotitems['brandname']); ?>/<?= str_replace(" ","-",$wehotitems['familyname'])?>"><p><?=$wehotitems['familyname']?></p><img height="225" class="fix img-reponsive" src="<?php echo $base_url; ?>/productimages/<?=$wehotitems['image_url']?>" alt="Tablets"/></a></div>		

			<?php	}

			

			if($wehotitems['categoryname'] == "Watches"){

		?><div class="item"><a href="<?php echo $base_url; ?>/sell/watch/<?= str_replace(" ","-",$wehotitems['familyname'])?>"><p><?=$wehotitems['familyname']?></p><img height="225" class="fix img-reponsive" src="<?php echo $base_url; ?>/productimages/<?=$wehotitems['image_url']?>" alt="Watches"/></a></div>		

			<?php	}

			

			if($wehotitems['categoryname'] == "TV"){

		?><div class="item"><a href="<?php echo $base_url; ?>/sell/gadgets/<?= str_replace(" ","-",$wehotitems['brandname'])?>"><p><?=$wehotitems['familyname']?></p><img height="225" class="fix img-reponsive" src="<?php echo $base_url; ?>/productimages/<?=$wehotitems['image_url']?>" alt="Tv"/></a></div>		

			<?php	}

		

		}

		?>  

 </div>

</div>



</div>

<div class="container-fluid testimonials">

<div class="container">

<div class="row text-center" style="margin-bottom:20px;">

<h1 class="Mheding-style1">REVIEWS</h1>

</div>
<!-- TrustBox widget - 0 -->
<div class="trustpilot-widget" data-locale="en-US" data-template-id="539ad60defb9600b94d7df2c" data-businessunit-id="566208860000ff0005865012" data-style-height="250px" data-style-width="100%" data-stars="5">
	<a href="https://www.trustpilot.com/review/stopoint.com" target="_blank">Trustpilot</a>
</div>
<!-- End TrustBox widget -->
<div class="button" style="margin-top:40px; margin-bottom:40px; width: 220px"><a href="https://www.trustpilot.com/review/stopoint.com" target="_blank"> View All TrustPilot Review</a></div>
<div style="width:100%; height: 2px; background:#ccc;">

</div>
<div class="row">

<?php

if(mysql_num_rows($retestimonials) == 1){

?>

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

      </div>

	  <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

		<h2><?=$testimonial[0][7]?>, <span><?=$testimonial[0][5]?></span></h2>

		<p><?=$testimonial[0][4]?></p>

		<div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/qw2.jpg" alt="User Image"/>

        </div>

      </div>

      

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

      </div>

    

      <?php

	  }

	  elseif(mysql_num_rows($retestimonials) == 2){

	  ?>

    

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

        <div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/qw.jpg" alt="User Image"/>

        </div>

        <h2><?=$testimonial[0][7]?>, <span><?=$testimonial[0][5]?></span></h2>

        <p><?=$testimonial[0][4]?></p>

      </div>

      

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

      </div>

      

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

        <div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/qw3.png" alt="User Image"/>

        </div>

        <h2><?=$testimonial[1][7]?>, <span><?=$testimonial[1][5]?></span></h2>

        <p><?=$testimonial[1][4]?></p>

      </div>

    

      <?php

	  }

	  else{

	  ?>

    

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

        <div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/qw.jpg" alt="User Image"/>

        </div>

        <h2><?=$testimonial[0][7]?>, <span><?=$testimonial[0][5]?></span></h2>

        <p><?=$testimonial[0][4]?></p>

      </div>

      

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

        <h2><?=$testimonial[1][7]?>, <span><?=$testimonial[1][5]?></span></h2>

        <p><?=$testimonial[1][4]?></p>

        <div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/qw2.jpg" alt="User Image"/>

        </div>

      </div>

      

      <div class="tm text-center col-lg-4 col-md-4 col-sm-4">

        <div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/qw3.png" alt="User Image"/>

        </div>

        <h2><?=$testimonial[2][7]?>, <span><?=$testimonial[2][5]?></span></h2>

        <p><?=$testimonial[2][4]?></p>

      </div>

    

      <?php

	  }

	  ?>

      

    </div>

    <div class="button" style="margin-top:40px; margin-bottom:40px;"><a href="<?php echo $base_url; ?>/reviews"> View All Reviews</a></div>

  </div>

</div>

<div class="container-fluid mobiletestimonials" style="padding:0px;">

  <div class="container">

    <div class="row text-center" style="margin-bottom:20px;">

      <h1 class="Mheding-style1">TESTIMONIALS</h1>

    </div>

    <div class="row" style="margin-left:0px; margin-right:0px;">

      	<div class="tm text-center col-lg-12 col-md-12 col-sm-12">

            <div class="round">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/default.png" alt="User Image"/>

            </div>

            <h2><?=$testimonial[0][7]?>, <span><?=$testimonial[0][5]?></span></h2>

            <p><?=$testimonial[0][4]?></p>

      	</div>

    </div>

    </div>

    <div class="button" style="margin-top:40px; margin-bottom:40px;"><a href="<?php echo $base_url; ?>/reviews"> View All Reviews</a></div>

</div>

<!-- slider -->
<div class="pricematch container-fluid text-center">
<h1>MATCH5</h1>
<h2>MATCH5 Promise: The Best Price … Plus $5 More</h2> 
<p class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">Sell your electronic device at Stopoint and get $5 more in cash than our competitors' best offer.</p>
<br><br>
<div class="button btn-give5"><a href="https://www.stopoint.com/price-match"> Learn More</a></div>
</div>
<div style="width:100%; position:absolute;">

<img  class="clock" alt="clock image" style="margin-left: auto;margin-right: auto;display: block;" src="images/pricematch.png"/>

</div>
<!-- slider -->

<!-- Temporary removed Give5 -->
<div class="give5b-main" style="display:none">
	<div class="g5b-main-area">

		<img class="g5b-logo" src="assets/banner/logo.png">

		<div class="g5b-right">
			<p class="g5b-text">
				For every gadget we receive, we give $5 to charity to provide toys and bring smile to children in Haiti during the Christmas holiday.
			</p>
			<div class="button btn-give5"><a href="https://www.stopoint.com/foundation"> Learn More</a></div>
		</div>

	</div>
</div>
<?php
include 'stopoint-press.php';
?>
</div>

<!-- Index Page Movile Version -->

<div class="mobile-home">

<div class="slider container-fluid text-center">

<div class="col-lg-8 col-md-8 m_cnt_l">
<div class="mobile_slide_cnt">
	<h1>TRADE-IN</h1>
    <p>YOUR CELL PHONE & ELECTRONICS</p>
    
<div class="your_offers">
	<h2>Your Offer is Just Seconds Away</h2>
<ul>
	<li><img src="<?php echo $base_url; ?>/images/topbar/icon9.png" alt="FREE-SHIPPING Icon"/>FREE SHIPPING</li>
    <li><img src="<?php echo $base_url; ?>/images/topbar/icon11.png" alt="NO-RISK Icon"/>NO RISK</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon10.png" alt="FREE-QUOTE Icon"/>30 Days Lock-in Price</li>

      

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon12.png" alt="PRICE-GUARANTEED Icon"/>Get Paid In 24 Hrs</li>

</ul>

</div>


</div>


</div>

<div class="col-lg-4 col-md-4 m_cnt_r">
<img src="<?php echo $base_url; ?>/images/mini_mob.png" width="100%" alt="mini_mobile"/><br />


<a class="m_info" href=" https://www.stopoint.com/sell-now">Sell Now</a>

</div>


<!--<div class="col-lg-6 col-md-6">

  <h1 style="font-size:64px; margin-top:0px; margin-bottom:0px; letter-spacing: 6px;">TRADE-IN</h1>

  <h1 style="font-size:20px; margin-top:0px; margin-bottom:7px;">YOUR CELL PHONE <span style="font-size:20px;">& </span> ELECTRONICS</h1>

  <h2 style="font-size:13px; margin-bottom:13px;">Your Offer is Just Seconds Away</h2>
  
  <div class="col-lg-12 text-center services1">

    <ul style="margin-top:10px; padding:0px;">

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon9.png" alt="FREE-SHIPPING Icon"/>FREE SHIPPING</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon10.png" alt="FREE-QUOTE Icon"/>30 Days Lock-in Price</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon11.png" alt="NO-RISK Icon"/>NO RISK</li>

      <li><img src="<?php echo $base_url; ?>/images/topbar/icon12.png" alt="PRICE-GUARANTEED Icon"/>Get Paid In 24 Hrs</li>

    </ul>

    </div>
  

</div>-->

</div>

<div class="hiw container" style="margin-top:0px;">

  <div class="row">

    <div class="text-center col-lg-6 col-md-6 col-sm-4 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/cell-phone/iphone">

        	<div class="col-xs-12">

        		<img src="<?php echo $base_url; ?>/images/mobile-home-iphone.png" alt="home-iphone" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>iPhone</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-4 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/cell-phone">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-samsung.png" alt="home-samsung" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Cell Phone</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-4 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/tablet/Apple">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-ipad.png" alt="home-ipad" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>iPad</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/tablet">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-tablets.png" alt="home-tablets" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Tablet</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/watch">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-watches.png" alt="home-watches" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Smart Watch</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/ipod/iPod-Nano">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-ipodnano.png" alt="home-ipodnano" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>iPod Nano</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/ipod/iPod-Touch">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-ipodtouch.png" alt="home-ipodtouch" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>iPod Touch</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/gadgets">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/mobile-home-tv.png" alt="home-tv" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>TV</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/computers/Apple">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/macbook_compare_og.png" alt="home-macbook" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Mac</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/gadgets">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/gadgets.png" alt="home-gadgets" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Gadgets</span>

            </div>

        </a>

    </div>
    
      <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/computers">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/Computer.png" alt="home-macbook" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Computer</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/gadgets/Beats">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/beats.png" alt="home-gadgets" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Beats</span>

            </div>

        </a>

    </div>
    
      <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/gadgets/Camera">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/camera.png" alt="home-macbook" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Camera</span>

            </div>

        </a>

    </div>

    <div class="text-center col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-items">

    	<a href="<?php echo $base_url; ?>/sell/gadgets/Video-Game">

        	<div class="col-xs-12">

        		<img class="img-responsive" src="<?php echo $base_url; ?>/images/gamingconsole.png" alt="home-gadgets" />

            </div>

            <div class="col-xs-12" style="padding:0px;">

            	<span>Gaming Console</span>

            </div>

        </a>

    </div>

  </div>



<br />

<div class="container-fluid mobiletestimonials testimonials" style="padding:0px;margin: -15px;">

  <div class="container">

    <div class="row text-center" style="margin-bottom:20px;">

      <h1 class="Mheding-style1" style="margin-bottom: -20px;">REVIEWS</h1>

    </div>
<!-- TrustBox widget - 0 -->
<div class="trustpilot-widget" data-locale="en-US" data-template-id="539ad60defb9600b94d7df2c" data-businessunit-id="566208860000ff0005865012" data-style-height="250px" data-style-width="100%" data-stars="5">
	<a href="https://www.trustpilot.com/review/stopoint.com" target="_blank">Trustpilot</a>
</div>
<!-- End TrustBox widget -->
<div class="button" style="margin-top:40px; margin-bottom:40px; width: 220px"><a href="https://www.trustpilot.com/review/stopoint.com" target="_blank"> View All TrustPilot Review</a></div>
<div style="width:100%; height: 2px; background:#ccc;">

</div>
    <div class="row" style="margin-left:0px; margin-right:0px;">

      	<div class="tm text-center col-lg-12 col-md-12 col-sm-12" style="margin-bottom:10px;">

            <div class="round" style="display:none;">

                <img height="213" width="213" class="timg img-circle" src="<?php echo $base_url; ?>/images/users/default.png" alt="User Image"/>

            </div>

            <h2 style="margin-top: 8px;"><?=$testimonial[0][7]?>, <span><?=$testimonial[0][5]?></span></h2>

            <p><?=$testimonial[0][4]?></p>

      	</div>

    </div>

    </div>

    <div class="button" style="margin-bottom:10px;"><a href="<?php echo $base_url; ?>/reviews"> View All Reviews</a></div>

</div>
</div>
<div style="height:15.5px;"></div>

<!-- slider -->
<div class="pricematch container-fluid text-center">
<h1>MATCH5</h1>
<h2>MATCH5 Promise: The Best Price … Plus $5 More</h2> 
<p class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">Sell your electronic device at Stopoint and get $5 more in cash than our competitors' best offer.</p>
<br><br>
<div class="button btn-give5"><a href="https://www.stopoint.com/price-match"> Learn More</a></div>
</div>
<div style="width:100%; position:absolute;">

<img  class="clock" alt="clock image" style="margin-left: auto;margin-right: auto;display: block;" src="images/pricematch.png"/>

</div>
<!-- slider -->

<!-- Temporary removed Give5 -->
<div class="give5b-main" style="display:none">
	<div class="g5b-main-area">

		<img class="g5b-logo" src="assets/banner/logo.png">

		<div class="g5b-right">
			<p class="g5b-text">
				For every gadget we receive, we give $5 to charity to provide toys and bring smile to Children in Haiti during the Christmas holiday.
			</p>
			<div class="button btn-give5"><a href="https://www.stopoint.com/foundation"> Learn More</a></div>
		</div>

	</div>
</div>
<div class="hiw container" style="margin-top:0px;">
<?php
include 'stopoint-press-mobile.php';
?>
</div>

</div>





<?php

include "footer.php";

?>

<!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.sync.bootstrap.min.js" async></script>
<!-- End Trustbox script -->