<?php
include "header.php";
?>

<!-- Sitemap --> 
<div class="container">
<div class="row text-center">
<h1 class="sub-heading">Sitemap</h1>
<div class="underline1"></div>
</div><!-- row --> 

<div class="row pad">
<div id="body">
            
            <section class="content-wrapper main-content clear-fix">
                

 <div class="container">
<div class="col-lg-3 col-md-3 col-sm-3">
 <div>
 <ul class="">

        <h2 class="fontchange">Categories</h2>
 <li><a href="<?php echo $base_url; ?>"> Home </a></li>
 <li><a href="<?php echo $base_url; ?>/sell/cell-phone" target="_blank"> Phones</a></li>
<li><a href="<?php echo $base_url; ?>/sell/computers" target="_blank"> Computers</a></li>
<li><a href="<?php echo $base_url; ?>/sell/tablets" target="_blank"> Tablet</a></li>
<li><a href="<?php echo $base_url; ?>/sell/ipod" target="_blank"> iPod</a></li>
<li><a href="<?php echo $base_url; ?>/sell/watch" target="_blank"> Watches</a></li>
<li><a href="<?php echo $base_url; ?>/sell/gadgets" target="_blank">Gadgets</a></li>


      </ul>
</div>

<ul>
<h2 class="fontchange">Account</h2>
 <li><a href="<?php echo $base_url; ?>/create-account"> Create Account </a></li>
   <li> <a hidefocus="hidefocus" href="<?php echo $base_url; ?>/login">Log In</a></li>

</ul>
<div>
  <ul class="">
        <h2 class="fontchange">About Stopoint</h2>
   	<li><a href="<?php echo $base_url; ?>/checkout"> Express Checkout</a></li>
	<li><a href="<?php echo $base_url; ?>/testimonials"> Testimonials</a></li>
	<li><a href="<?php echo $base_url; ?>/sell-now"> Easy Steps</a></li>
    <li><a href="<?php echo $base_url; ?>/about"> About Us </a></li>
    <li><a href="<?php echo $base_url; ?>/privacypolicy">Privacy Policy</a></li>
    <li><a href="<?php echo $base_url; ?>/termsconditions">Terms and Conditions</a></li>
    <li><a href="<?php echo $base_url; ?>/legal">Law Enforcement</a></li>
    <li><a href="<?php echo $base_url; ?>/press">Press</a></li>
     <li><a href="<?php echo $base_url; ?>/blog">Blog</a></li>
        
        
      
      </ul>
</div>
</div>
</div>

<style>
    .fontchange {
          font-size: 20px;
    }


    .directory-index a {
         color: #83BC2D;
    font-family: 'Open Sans',sans-serif;
    padding: 4px 0;
    display: inline-block;
    width: 3.703703704%;
    text-align: center;
    -ms-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border: solid #e5e5e5;
    border-width: 1px 1px 1px 0;
    font-weight: bold;
    transition: .3s background-color,0.3s border-color;
}
    .directory-index a:first-child {
    border-left-width: 1px;
}
    .directory-index a:hover, .directory-index a.selected,.directory-index a.active {
    border-color: #83BC2D;
    background-color: #83BC2D;
    color: white;
    text-decoration: none;
}


</style>


            </section>
        </div>
</div><!-- row --> 

</div><!-- end container --> 
<!-- end sitemap --> 





<br>
<?php
include "footer.php";
?>
