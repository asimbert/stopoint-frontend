<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the id=main div and all content after

 *

 * @package Catch Themes

 * @subpackage Catch_Evolution_Pro

 * @since Catch Evolution Pro 1.0

 */

?>

		</div><!-- #content-sidebar-wrap -->

        <?php 

		/** 

		 * catchevolution_after_contentsidebarwrap hook

		 *

         * @hooked catchevolution_third_sidebar - 10

		 */

		do_action( 'catchevolution_after_contentsidebarwrap' ); 

		?>   

	</div><!-- .wrapper -->

</div><!-- #main -->



<?php 

/** 

 * catchevolution_after_main hook

 */

do_action( 'catchevolution_after_main' ); 

?>    



<footer id="colophon" role="contentinfo">

	<?php

	/** 

	 * catchevolution_before_footer_menu hook

	 */

	do_action( 'catchevolution_before_footer_sidebar' ); 

		

	/* A sidebar in the footer? Yep. You can can customize

	 * your footer with three columns of widgets.

	 */

	get_sidebar( 'footer' );

		

	/** 

	 * catchevolution_before_footer_menu hook

	 */

	do_action( 'catchevolution_after_footer_sidebar' ); 		

    ?>

   

<div class="footer container-fluid">

  <div class="fc container">

    <div class="mob_f-blocks f-blocks col-lg-3 col-md-3 col-sm-4">

      <h2>ABOUT US</h2>

      <ul class="qick-links" style="margin-left: 0px;">

        <li><a href="https://www.stopoint.com/about">About Us</a></li>

        <li><a href="https://www.stopoint.com/privacypolicy">Privacy Policy</a></li>

        <li><a href="https://www.stopoint.com/termsconditions">Terms and Conditions</a></li>

        <li><a href="https://www.stopoint.com/legal">Law Enforcement</a></li>

        <li><a href="https://www.stopoint.com/sitemap.xml" target="_blank">Sitemap</a></li>

        <li><a href="https://www.stopoint.com/recycling" target="_blank">Recycle</a></li>
        
        <li><a href="https://www.stopoint.com/blog/">Blog</a></li>

      </ul>

    </div>

    <div class="mob_f-blocks f-blocks col-lg-3 col-md-3 col-sm-4">

      <h2>CONTACT INFORMATION</h2>

      <ul class="qick-links" style="margin-left: 0px;">

        <li><a href="https://www.stopoint.com">STOPOINT</a></li>

        <li><a href="mailto:support&#64;stopoint&#46;com" title="Stopoint Email">Stopoint Email</a></li>

        <li><a href="https://www.stopoint.com/contact">Contact Us</a></li>

      </ul>

    </div>

    

    <div class="mob_f-blocks f-blocks col-lg-3 col-md-3 col-sm-4">

      <h2 style="margin-bottom:20px;">SOCIAL MEDIA</h2>

      <div><!--<a class="fl" href="#"><img src="images/fb.jpg"/></a>-->

      <div id="fb-root"></div>



<div class="fb-page" data-href="https://www.facebook.com/stopointtrade" data-width="230" data-height="195" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/stopointtrade"><a href="https://www.facebook.com/stopointtrade">Stopoint.com</a></blockquote></div></div>

      </div>

      <div style="clear:both"><!--<a class="fl" href="#"><img src="images/tw.jpg"/></a>-->

        <ul class="fb">

          <li><span class="b1"><a href="https://twitter.com/stopointtrade" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false">Follow</a></span></li>
		  <li class="g-follow" data-annotation="bubble" data-height="20" data-href="https://google.com/+Stopointtrade" data-rel="author"></li>

        </ul>

      </div>

    </div>

    <div class="f-bar f-blocks col-lg-3 col-md-3 col-sm-12 col-xs-12">

      <div class="col-xs-12" style="padding:0px; text-align:center; font-size:17px;">
      	<a style="padding:0px 6px 0px 0px;" href="https://www.stopoint.com/help">Help</a>
      	<a style="padding:0px 6px 0px 6px;" href="https://www.stopoint.com/termsconditions">Terms of Service</a>
        <a style="padding:0px 0px 0px 6px;" href="https://www.stopoint.com/blog/">Blog</a>
      </div>

    </div>

    <div class="f-sociallinks f-blocks col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding:0px;">

      <ul style="list-style:none; padding:0px; margin-left:0px;">

      	<li style="display:inline; padding:0px;"><a href="https://www.facebook.com/stopointtrade" target="_blank"><img width="36" height="39" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/mobfacebook.png" alt="Facebook Icon"/></a></li>

        <li style="display:inline; padding:0px;"><a href="https://twitter.com/stopointtrade" target="_blank"><img width="36" height="39" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/mobtwitter.png" alt="Twitter Icon"/></a></li>

        <li style="display:inline; padding:0px;"><a href="https://www.stopoint.com/contact" target="_blank"><img width="36" height="39" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/mobcontact.png" alt="Contact Icon"/></a></li>

      </ul>

    </div>

    <div class="f1-blocks f-blocks col-lg-3 col-md-3 col-sm-12"> <a href="https://www.stopoint.com"> <img style="display: inline-block;" class="watermark img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/watermark.png" alt="WaterMark"/></a>

      <p>Stopoint.com allows you to sell your high-end electronics with our easy to use select ship-and-pay system. We dedicate our time to ensure you are properly funded in less than 24 hours after receiving your product.</p>

      <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=gd7mCytP9mrDtw838FR1lAftIHtfhdWpZhMG2Lua75YYvam6Gr7P49C5HD6F"></script></span>

    </div>

  </div>

  <div class="container copyright">

  	<p>&copy;2015 Stopoint, Inc. All Rights Reserved, Patents Pending.Stopoint is not affiliated with the manufacturers of the items available for trade-in. Stopoint and the Stopoint logo are trademarks of Stopoint, Inc., registered in the U.S. All other trademarks, logos and brands are the property of their respective owners.</p>

  </div>

  <div class="container mobcopyright">

  	<p>&copy;2015 Stopoint, Inc. All Rights Reserved.</p>

  </div>

</div>

<!--<div id="fb-root"></div>-->

<script type="text/javascript" src="/blog/wp-content/themes/stopoint/js/jquery.min.js"></script> 

<script type="text/javascript" src="/blog/wp-content/themes/stopoint/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/blog/wp-content/themes/stopoint/js/wow.js"></script>

<script type="text/javascript" src="/blog/wp-content/themes/stopoint/js/owl.carousel.js"></script>

<script type="text/javascript" src="/blog/wp-content/themes/stopoint/js/auto-complete.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>

	<!--Footer-->
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1584683941803099";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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

<!-- #site-generator -->

       

</footer><!-- #colophon -->



</div><!-- #page -->



<?php 

/** 

 * catchevolution_after hook

 */

do_action( 'catchevolution_after' );

?>



<?php wp_footer(); ?>



</body>

</html>