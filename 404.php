<?php
require_once 'header.php';
if (strstr($_SERVER['REQUEST_URI'],'/')) {
    header('HTTP/1.0 404 Not Found');
}	
?>



        <section id="content">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-14">
                     <header class="content-title">
                                <div class="title-bg">
                                    <h2 class="title" id="carrier">The page you were looking for doesn't exist.</h2>
                                </div><!-- End .title-bg -->
                              <!--  <p class="title-desc">Only with us you can get a new model with a discount.</p>-->
                            </header>
                   <h2 style="font-size:72px;"><span style="opacity: 1;">4</span><span style="opacity: 1;">0</span><span style="opacity: 1;">4</span></h2>
        			<p>Sorry for the inconvenience. <a href="index">Get back to our home page</a>.</p>
<p>If you require further immediate assistance, please <a href="contact" target="_blank">reach out</a> to us.</p>
  <div class="row">
  <ul class="social-links clearfix">
                               <!-- <li><a href="https://www.facebook.com/stopointtrade" class="social-icon icon-facebook"></a></li>
                                <li><a href="https://twitter.com/stopoint1" class="social-icon icon-twitter"></a></li>
                                <li><a href="contact" class="social-icon icon-email"></a></li>-->
                            </ul></div>
        					
        					
        				</div><!-- End .row -->
        				
        				
        			</div><!-- End .col-md-14 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->
        
        </section><!-- End #content -->
        <br /><br/>
         <?php
require_once 'footer.php';

?>