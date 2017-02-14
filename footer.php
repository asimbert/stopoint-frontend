<?php
include "footer_popularsearches1.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$sell = substr($path, 0, 6);

$r = explode('/', $path);
$r = array_filter($r);
$r = array_merge($r, array()); 
?>
<div class="footer container-fluid">
  <div class="fc container">
    <div class="mob_f-blocks f-blocks col-lg-3 col-md-3 col-sm-4">
      <h4>ABOUT US</h4>
      <ul class="qick-links">
        <li><a href="<?php echo $base_url ?>/about">About Us</a></li>
        <li><a href="<?php echo $base_url ?>/privacypolicy">Privacy Policy</a></li>
        <li><a href="<?php echo $base_url ?>/termsconditions">Terms and Conditions</a></li>
        <li><a href="<?php echo $base_url ?>/legal">Law Enforcement</a></li>
        <li><a href="<?php echo $base_url ?>/sitemap.php" target="_blank">Sitemap</a></li>
        <li><a href="<?php echo $base_url ?>/recycling" target="_blank">Recycle</a></li>
        <li><a href="<?php echo $base_url ?>/press">Press & Media</a></li>
        <li><a href="<?php echo $base_url ?>/reviews">Reviews</a></li>
        <li><a href="<?php echo $base_url ?>/blog/">Blog</a></li>
		 <li><a href="<?php echo $base_url ?>/coupon-code/">Coupon Code</a></li>
      </ul>
     </div>
    <div class="mob_f-blocks f-blocks col-lg-3 col-md-3 col-sm-4">
      <h4>CONTACT INFORMATION</h4>
      <ul class="qick-links">
        
        
        <li><a href="<?php echo $base_url ?>/contact">Contact Us</a></li></br>
		<li><a href="<?php echo $base_url ?>/price-match">Price Match Guaranteed</a></li></br>



<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup">
<form action="//stopoint.us11.list-manage.com/subscribe/post?u=0f009b1683c3e3d837990dd1a&amp;id=0b4a57f447" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<h4>Subscribe to our mailing list</h4>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address </label></br></br>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_0f009b1683c3e3d837990dd1a_0b4a57f447" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->

        
         
      </ul>
    </div>
   
    <div class="mob_f-blocks f-blocks col-lg-3 col-md-3 col-sm-4">
      <h4 style="margin-bottom:20px;">SOCIAL MEDIA</h4>
      <div><!--<a class="fl" href="#"><img src="<?php //echo $base_url ?>/images/fb.jpg"/></a>-->
      <div id="fb-root"></div>

<div class="fb-page" data-href="https://www.facebook.com/stopointtrade" data-width="230" data-height="195" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/stopointtrade"><a href="https://www.facebook.com/stopointtrade">Stopoint.com</a></blockquote></div></div>
      </div>
      <div style="clear:both"><!--<a class="fl" href="#"><img src="<?php //echo $base_url ?>/images/tw.jpg"/></a>-->
        <ul class="fb">
          <li><span class="b1"><a href="https://twitter.com/stopointtrade" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false">Follow</a></span></li>
		  <li class="g-follow" data-annotation="bubble" data-height="20" data-href="https://google.com/+Stopointtrade" data-rel="author"></li>
        </ul>
      </div>
    </div>
    <div class="f-bar f-blocks col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="col-xs-12" style="padding:0px; text-align:center; font-size:17px;">
      	<a style="padding:0px 5% 0px 0px;" href="<?php echo $base_url ?>/help">Help</a>
      	<a style="padding:0px 5% 0px 5%;" href="<?php echo $base_url ?>/termsconditions">Terms of Service</a>
        <a style="padding:0px 0px 0px 5%;" href="http://www.stopoint.com/blog/">Blog</a>
      </div>
      
      <div class="f_cnt">
      
      <a href="tel:+1-888-246-4919" class="phoneanchor">1 (888) 246-4919</a>
      
      </div>
      
      
      
    </div>
    <div class="f-sociallinks f-blocks col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding:0px;">
      <ul style="list-style:none; padding:0px; margin-left:0px;">
      	<li style="display:inline; padding:0px;"><a href="https://www.facebook.com/stopointtrade" target="_blank"><img width="36" height="39" src="<?php echo $base_url ?>/images/topbar/mobfacebook.png" alt="Facebook Icon"/></a></li>
        <li style="display:inline; padding:0px;"><a href="https://twitter.com/stopointtrade" target="_blank"><img width="36" height="39" src="<?php echo $base_url ?>/images/topbar/mobtwitter.png" alt="Twitter Icon"/></a></li>
        <li style="display:inline; padding:0px;"><a href="<?php echo $base_url ?>/contact" target="_blank"><img width="36" height="39" src="<?php echo $base_url ?>/images/topbar/mobcontact.png" alt="Contact Icon"/></a></li>
      </ul>
    </div>
    <div class="f1-blocks f-blocks col-lg-3 col-md-3 col-sm-12"> <a href="https://www.stopoint.com"> <img style="display: inline-block;" class="watermark img-responsive" src="<?php echo $base_url ?>/images/watermark.png" alt="WaterMark"/></a>
      <p>Stopoint.com allows you to sell your high-end electronics with our easy to use 'select-ship-and pay system'. We dedicate our time to ensure you are properly funded in less than 24 hours after receiving your product.</p>
      <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=gd7mCytP9mrDtw838FR1lAftIHtfhdWpZhMG2Lua75YYvam6Gr7P49C5HD6F"></script></span>
    </div>
  </div>
  <div class="container copyright">
  	<p>&copy;2016 Stopoint, Inc. All Rights Reserved, Patents Pending.Stopoint is not affiliated with the manufacturers of the items available for trade-in. Stopoint and the Stopoint logo are trademarks of Stopoint, Inc., registered in the U.S. All other trademarks, logos and brands are the property of their respective owners.</p>
  </div>
  <div class="container mobcopyright">
  	<p>&copy;2016 Stopoint, Inc. All Rights Reserved.</p>
  </div>
</div>
<!--<div id="fb-root"></div>-->
<script type="text/javascript" src="<?php echo $base_url ?>/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo $base_url ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>/js/wow.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>/js/auto-complete.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>/js/star-rating.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!--Messages_Edit-->
<?php
if($expurl[0] == "/messages_edit.php"){
?>
<script type="text/javascript">

$(document).ready(function(){
	
$("#button").click(function(){
$(".reply").toggle();
});
$("#button1").click(function(){
$(".new").toggle();
});
});

</script>
<?php
}
?>
<!--Login-->
<?php
if($expurl[0] == "/login.php" || $expurl[0] == "/login"){
?>
<script type="text/javascript">
			jQuery(function ($) {
			function hasHtml5Validation () {
			return typeof document.createElement('input').checkValidity === 'function';
			}
			if (hasHtml5Validation()) {
			$('.validate-form').submit(function (e) {
			if (!this.checkValidity()) {
			e.preventDefault();
			$(this).addClass('invalid');
			$('#status').html('invalid');
			} else {
			$(this).removeClass('invalid');
			$('#status').html('submitted');
			}
			});
			}
			$( "#payment" ).change(function () {
			if(document.getElementById('payment').value == 1){
			$("#paypalemail").prop('required',true);
			}
			if(document.getElementById('payment').value == 2){
			$("#paypalemail").prop('required',false);
			}
			});
			});
			function hasHtml5Validation () {
			return typeof document.createElement('input').checkValidity === 'function';
			}
			if (hasHtml5Validation()) {
			$('.validate-form').submit(function (e) {
			if (!this.checkValidity()) {
			e.preventDefault();
			$(this).addClass('invalid');
			$('#status').html('invalid');
			} else {
			$(this).removeClass('invalid');
			$('#status').html('submitted');
			}
			});
			}
			</script>
            
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.init({
appId      : '913710248641693',
channelUrl : '//stopoint.com/', 
status     : true, 
cookie     : true, 
xfbml      : true  
});
};
(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));

</script>
<?php
}
?>
<!--Checkout-->
<?php
if($expurl[0] == "/checkout.php" || $expurl[0] == 'checkout'){
?>
<script type="text/javascript">
function validateEmail(p1, p2) {

    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
		alert('Confirm Email must match with Email');
        p2.setCustomValidity('Confirm Email must match with Email');
		return false;
    } else {
        p2.setCustomValidity('');
		
		return true;
    }
}

</script>

<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	appId      : '913710248641693', // replace your app id here
	channelUrl : '//stopoint.com/', 
	status     : true, 
	cookie     : true, 
	xfbml      : true  
	});
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));




</script>
<?php
}
?>
<!--Thankyou-->
<?php
if($expurl[0] == "/thankyou.php"){
?>
<script type="text/javascript">
    jQuery(function ($) {
        $('.panel-heading span.clickable').on("click", function (e) {
            if ($(this).hasClass('panel-collapsed')) {
                // expand the panel
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
            else {
                // collapse the panel
                $(this).parents('.panel').find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
        });
    });
</script>
<?php
}
?>
<!--Register-->
<?php
if($expurl[0] == "/register.php" || $expurl[0] == "/create-account"){
?>
<script type="text/javascript">
function validatePass(p1, p2) {
    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
        p2.setCustomValidity('Password not match');
    } else {
        p2.setCustomValidity('');
    }
}
</script>
<?php
}
?>
<?php
if($expurl[0] == "/checkout2.php" || $r[0] == 'checkout2'){
?>
  <script type="text/javascript">
    jQuery(function ($) {
        $('.panel-heading span.clickable').on("click", function (e) {
            if ($(this).hasClass('panel-collapsed')) {
                // expand the panel
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
            else {
                // collapse the panel
                $(this).parents('.panel').find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
        });
		
		$( "#paypalcollapse" ).click(function() {
  			$('#check').attr('area-expanded', 'false');
			$( "#check" ).removeClass( "in" );

  
});

$( "#checkcollapse" ).click(function() {
  			$('#paypal').attr('area-expanded', 'false');
			$( "#paypal" ).removeClass( "in" );
  
});

function hasHtml5Validation () {
 return typeof document.createElement('input').checkValidity === 'function';
}
if (hasHtml5Validation()) {
 $('.validate-form').submit(function (e) {
   if (!this.checkValidity()) {
     // Prevent default stops form from firing
     e.preventDefault();
     $(this).addClass('invalid');
     $('#status').html('invalid');
   } else {
     $(this).removeClass('invalid');
     $('#status').html('submitted');
   }
 });
}
    });
	
	

</script>
  <?php } ?> 
   <?php
if($expurl[0] == "/confirmpayment.php" || $r[0] == 'confirmpayment'){
?>
  <script type="text/javascript">
    jQuery(function ($) {
        $('.panel-heading span.clickable').on("click", function (e) {
            if ($(this).hasClass('panel-collapsed')) {
                // expand the panel
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
            else {
                // collapse the panel
                $(this).parents('.panel').find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
        });
    });
	
	function hasHtml5Validation () {
 return typeof document.createElement('input').checkValidity === 'function';
}
if (hasHtml5Validation()) {
 $('.validate-form').submit(function (e) {
   if (!this.checkValidity()) {
	  $('#termscheckbox').css('outline-color', 'red');
$('#termscheckbox').css('outline-style', 'solid');
$('#termscheckbox').css('outline-width', 'thin');
     // Prevent default stops form from firing
     e.preventDefault();
     $(this).addClass('invalid');
     $('#status').html('invalid');
   } else {
     $(this).removeClass('invalid');
     $('#status').html('submitted');
   }
 });
}
</script>
  <?php } ?> 
  <?php
  if($expurl[0] == "/register.php" || $expurl[0] == "/create-account"){
?>
  <script type="text/javascript">
    
	function hasHtml5Validation () {
 return typeof document.createElement('input').checkValidity === 'function';
}
if (hasHtml5Validation()) {
 $('.validate-form').submit(function (e) {
   if (!this.checkValidity()) {
	  $('#termscheckbox').css('outline-color', 'red');
$('#termscheckbox').css('outline-style', 'solid');
$('#termscheckbox').css('outline-width', 'thin');
     // Prevent default stops form from firing
     e.preventDefault();
     $(this).addClass('invalid');
     $('#status').html('invalid');
   } else {
     $(this).removeClass('invalid');
     $('#status').html('submitted');
   }
 });
}
</script>
  <?php } ?> 

  	<!--Order_Edit-->
<?php
if($expurl[0] == "/order_edit.php"){
?>
<script type="text/javascript">
$(document).ready(function(){
$("#button").click(function(){
$(".reply").toggle();
});
$("#button1").click(function(){
$(".new").toggle();
});
});
</script>

<script type="text/javascript">
function validateRating(p1) {
    if (p1.value == '' || p1.value == 0) {
		alert('Please rate your review.');
		return false;
    } else {
		return true;
    }
}
</script>

<?php
}
?>

		<!--CellPhone-->
<?php
if($expurl[0] == "/cellphone.php" || $r[1] != ''){
?>
<script type="text/javascript">
$(document).ready(function() {
    $("input[name$='g']").click(function() {
		
        var test = $(this).val();

if(test == 3){
$("div.desc").show();
}
else{
        $("div.desc").hide();
}
        $("#good" + test).show();
    });
	
	 $("input[name$='gchoice']").click(function() {
		
        var test = $(this).val();
if(test == 4){
	
	 $("#good5").hide();
	 $("#good4").show();
	}
	
	if(test == 5){
		
	 $("#good4").hide();
	 $("#good5").show();
	}
        //$("div.desc").hide();
		
    });
});
</script>
<?php
}
?>

		<!--Tv-->
<?php
if($expurl[0] == "/ipod.php" || $r[1] != ''){
?>
<script type="text/javascript">
$(document).ready(function() {
    $("input[name$='g']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#good" + test).show();
    });
	
	 $("input[name$='gchoice']").click(function() {
		
        var test = $(this).val();
if(test == 4){
	
	 $("#good5").hide();
	 $("#good4").show();
	}
	
	if(test == 5){
		
	 $("#good4").hide();
	 $("#good5").show();
	}
        //$("div.desc").hide();
		
    });
});
</script>
<?php
}
?>

		<!--Testimonials-->
<?php

if($expurl[0] == "/testimonials.php" || $r[0] == "reviews"){


?>
<script type="text/javascript">
jQuery(document).ready(function () {
	$('.rb-rating').rating({'showCaption':false, 'disabled':true, 'showClear':false });
});
</script>

<script type="text/javascript">
		$(function() {
			$("#demo4").paginate({
				count 		: 50,
				start 		: 20,
				display     : 12,
				border					: false,
				text_color  			: '#79B5E3',
				background_color    	: 'none',	
				text_hover_color  		: '#2573AF',
				background_hover_color	: 'none', 
				images		: false,
				mouse		: 'press'
			});
		});
</script>
<?php
}
?>

		<!--Gadgets-->
<?php
if($expurl[0] == "/gadgets.php" || $r[1] == 'gadgets' ){
?>
<script type="text/javascript">
$(document).ready(function() {
    $("input[name$='g']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#good" + test).show();
    });
	
	 $("input[name$='gchoice']").click(function() {
		
        var test = $(this).val();
if(test == 4){
	
	 $("#good5").hide();
	 $("#good4").show();
	}
	
	if(test == 5){
		
	 $("#good4").hide();
	 $("#good5").show();
	}
        //$("div.desc").hide();
		
    });
});
</script>
<?php
}
?>

		<!--Tbletes-->
<?php
if($expurl[0] == "/tablets.php" || $r[1] == 'tablet'){
?>
<script type="text/javascript">
function reply_click(clicked_id){
	$('html,body').animate({
        scrollTop: $("#ajximg").offset().top},
        'slow');
	var optimg = document.getElementById('ajximg');
	$.ajax({
       url: '<?php echo $site_url; ?>/ajacimg.php',
       data: {"subimg":clicked_id},
       type: 'post',
       success:function(data){
		   
			 document.getElementById("ajximg").innerHTML = data;
			 optimg.style.display = 'block';
       }
    });
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("input[name$='g']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#good" + test).show();
    });
	$("input[name$='gchoice']").click(function() {
		
        var test = $(this).val();
if(test == 4){
	
	 $("#good5").hide();
	 $("#good4").show();
	}
	
	if(test == 5){
		
	 $("#good4").hide();
	 $("#good5").show();
	}
        //$("div.desc").hide();
		
    });
});
</script>
<?php
}
?>

		<!--Computers-->
<?php
if($expurl[0] == "/computers.php" || $r[1] == 'computers'){
?> 
<script type="text/javascript">
function getComboA(sel) {
	
	var optProcessor = document.getElementById('screenprocessor');
	var values = sel.value; 
	$.ajax({
		url: '<?php echo $base_url; ?>/ajac.php',
		data: {"subId":values},
		type: 'post',
		success:function(data){
			document.getElementById("screenprocessor").innerHTML = data;
			optProcessor.style.display = 'block';
		}
	});
}

function getComboB(hard) {
	var opthard = document.getElementById('screenhard');
	var vhard = hard.value;
	$.ajax({
		url: '<?php echo $base_url; ?>/ajach.php',
		data: {"subIh":vhard},
		type: 'post',
		success:function(data){
			document.getElementById("screenhard").innerHTML = data;
			opthard.style.display = 'block';
		}
	});
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("input[name$='g']").click(function() {
		var test = $(this).val();
		$("div.desc").hide();
		$("#good" + test).show();
	});
	
	$("input[name$='gchoice']").click(function() {
		
        var test = $(this).val();
if(test == 4){
	
	 $("#good5").hide();
	 $("#good4").show();
	}
	
	if(test == 5){
		
	 $("#good4").hide();
	 $("#good5").show();
	}
        //$("div.desc").hide();
		
    });
});
</script>

<?php
}
?>
   
     <!--Watch-->
<?php

 
if($expurl[0] == "/watch.php" || $r[1] == 'watch'){
	
?>      

<script type="text/javascript">
function getComboAS(sel) {
	
	var optProcessor = document.getElementById('screensize');
	var values = sel.value; 
	$.ajax({
		url: '<?php echo $site_url; ?>/ajacs.php',
		data: {"subId":values},
		type: 'post',
		success:function(data){
			
			document.getElementById("screensize").innerHTML = data;
			optProcessor.style.display = 'block';
		}
	});
}
                    
function getComboBS(hard) {
	var opthard = document.getElementById('screenhard');
	var vhard = hard.value;
	$.ajax({
		url: '<?php echo $site_url; ?>/ajachws.php',
		data: {"subIh":vhard},
		type: 'post',
		success:function(data){
			document.getElementById("screenhard").innerHTML = data;
			opthard.style.display = 'block';
		}
	});
}
</script>

<script type="text/javascript">
$(document).ready(function() {
	$("input[name$='g']").click(function() {
		var test = $(this).val();
		$("div.desc").hide();
		$("#good" + test).show();
	});
	
	$("input[name$='gchoice']").click(function() {
		
        var test = $(this).val();
if(test == 4){
	
	 $("#good5").hide();
	 $("#good4").show();
	}
	
	if(test == 5){
		
	 $("#good4").hide();
	 $("#good5").show();
	}
        //$("div.desc").hide();
		
    });
});
</script>
<?php
}
?> 

		<!--Dashboard-->
<?php
if($expurl[0] == "/dashboard.php" || $r[0] == 'my-account'){
?>
<script type="text/javascript">
jQuery(function ($) {
	function hasHtml5Validation () {
		return typeof document.createElement('input').checkValidity === 'function';
	}
	if (hasHtml5Validation()) {
 		$('.validate-form').submit(function (e) {
   			if (!this.checkValidity()) {
				e.preventDefault();
				$(this).addClass('invalid');
				$('#status').html('invalid');
   			} else {
				$(this).removeClass('invalid');
				$('#status').html('submitted');
   			}
		});
}

	$( "#payment" ).change(function () {
		if(document.getElementById('payment').value == 1){
			$("#paypalemail").prop('required',true);
		}
		if(document.getElementById('payment').value == 2){
			$("#paypalemail").prop('required',false);
		}
	});
});

function hasHtml5Validation () {
	return typeof document.createElement('input').checkValidity === 'function';
}
if (hasHtml5Validation()) {
	$('.validate-form').submit(function (e) {
		if (!this.checkValidity()) {
			e.preventDefault();
			$(this).addClass('invalid');
			$('#status').html('invalid');
	   } else {
		 $(this).removeClass('invalid');
		 $('#status').html('submitted');
	   }
 	});
}
</script>
<?php
}
?> 

		<!--Footer-->
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.2&appId=913710248641693";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
!function(d,s,id){
	var js,fjs=d.getElementsByTagName(s)[0],
	p=/^http:/.test(d.location)?'http':'https';
	if(!d.getElementById(id)){
		js=d.createElement(s);
		js.id=id;
		js.src=p+'://platform.twitter.com/widgets.js';
		fjs.parentNode.insertBefore(js,fjs);
	}
}(document, 'script', 'twitter-wjs');
</script>

<script type="text/javascript">
(function(i,s,o,g,r,a,m){
	i['GoogleAnalyticsObject']=r;
	i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();
		a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];
		a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-67281027-1', 'auto');
ga('send', 'pageview');
</script>

   <!--Header-->  
<script type="text/javascript">
$(document).ready(function() {
	$("#owl-demo").owlCarousel({
		autoPlay: 3000,
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3]
	});
});

$(document).ready(function() {
	var owl = $("#owl-demo");
	owl.owlCarousel();
	$(".next").click(function(){
		owl.trigger('owl.next');
	})
	$(".prev").click(function(){
		owl.trigger('owl.prev');
	})
});
</script>

<script type="text/javascript">
	new WOW().init();
</script>
  
<!-- Google Code for Remarketing Tag -->

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 976913846;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
function FBLogin(){
	
	FB.login(function(response){
	
		if(response.authResponse){
			
			window.location.href = "https://www.stopoint.com/actions.php?action=fblogin&nocheckout=false";
			
		}
	}, {scope: 'email,user_likes,user_friends,publish_actions,user_birthday,user_location',return_scopes: true});
}

function FBLogincheck(){
	
FB.login(function(response){
	
		if(response.authResponse){
			
			window.location.href = "https://www.stopoint.com/actions.php?action=fblogin&checkout=true";
		}
	}, {scope: 'email,user_likes,user_friends,publish_actions,user_birthday,user_location',return_scopes: true});
}
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/976913846/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>