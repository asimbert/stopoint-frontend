<script>
$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        // Avoid following the href location when clicking
        event.preventDefault(); 
        // Avoid having the menu to close when clicking
        event.stopPropagation(); 
        // If a menu is already open we close it
        $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
        // opening the one you clicked on
        $(this).parent().addClass('open');
    });
</script>


<!-- main nav bar -->
<div class="container-fluid mobnav" style="padding:0px;">
    <div class="row" style="margin:0px;">
      <div class=" col-lg-12" style="padding:0px;">
        
        
        <nav class="navbar-default"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="" style="margin-top:6px;">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle" style="margin: -39px 0 0 0; float:left; border:none; background:none; padding:6px 10px;"> 
            	<!--<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> -->
                
                <span><img src="<?php echo $base_url ?>/images/nav_icon.png" width="30" alt="bar"/></span>
                
                
                
            </button>
          </div>
          <!-- Collection of nav links and other content for toggling -->
          <div id="navbarCollapse" class="mainavbar collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="http://www.stopoint.com"><img src="<?php echo $base_url ?>/images/topbar/icon7.png" alt="bar"/></a></li>
              <li><a href="<?php echo $base_url ?>/sell/cell-phone/iphone">iPhone</a></li>
              <li><a href="<?php echo $base_url ?>/sell/cell-phone">CELL PHONE</a></li>
              <li><a href="<?php echo $base_url ?>/sell/computers">COMPUTER</a></li>
              <li><a href="<?php echo $base_url ?>/sell/tablet">TABLET</a></li>
              <li><a href="<?php echo $base_url ?>/sell/ipod">iPod</a></li>
              <li><a href="<?php echo $base_url ?>/sell/watch">WATCHES</a></li>
              <li><a href="<?php echo $base_url ?>/sell/gadgets">GADGETS</a></li>
              <li class="dropdown" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px; border-top:1px solid #ddd;" class="dropdown-toggle" data-toggle="dropdown" href="#">ABOUT US <span class="caret"></span></a>
              	<ul style="margin-left:0px; background-color:#454645;" class="dropdown-menu">
                	<li class="menu-item active" style=""><a style="background-color:#454645; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/about">About Us</a></li>
                    <li class="menu-item" style=""><a style="background-color:#454645; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/privacypolicy">Privacy Policy</a></li>
                    <li class="menu-item" style=""><a style="background-color:#454645; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/termsconditions">Terms And Conditions</a></li>
                    <li class="menu-item" style=""><a style="background-color:#454645; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/legal">Law Enforcement</a></li>
                    <li class="menu-item" style=""><a style="background-color:#454645; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/sitemap.xml">Site Map</a></li>
                </ul>
              </li>
              <li class="dropdown" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;" class="dropdown-toggle" data-toggle="dropdown" href="#">CONTACT US <span class="caret"></span></a>
              	<ul style="margin-left:0px; background-color:#454645;" class="dropdown-menu">
                    <li class="menu-item" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/contact">Contact Us</a></li>
                </ul>
              </li>
              <li><a data-toggle="modal" href="#myModal">TRACK ORDER</a></li>
              <li class="dropdown" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;" class="dropdown-toggle" data-toggle="dropdown" href="#">MY STOPOINT <span class="caret"></span></a>
              	<ul style="margin-left:0px; background-color:#454645;" class="dropdown-menu">
                	<?php
						if(isset($_SESSION['login_username'])){
					?>
                    <li class="menu-item active" style="color: #e9e9ea;"> Welcome <a style='background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;' href='<?php echo $base_url; ?>/my-account'><?=$_SESSION['login_username']?>!</a></li>
                	<li class="menu-item active" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/logout"><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Logout"/> Logout</a></li>
                    <?php
						}elseif(isset($_SESSION['FULLNAME'])){
					?>
                    <li class="menu-item active" style="color: #e9e9ea;"> Welcome <a style='background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;' href='<?php echo $base_url; ?>/my-account'><?=$_SESSION['FULLNAME']?>!</a></li>
                	<li class="menu-item active" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/signfacebook/logout.php"><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Logout"/> Logout</a></li>
                    <?php
						}else{
					?>
                	<li class="menu-item active" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;" href="<?php echo $base_url ?>/login"><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Login"/> Login</a></li>
                    <?php
						}
					?>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      
    
      </div>
     
      
    </div>
    <!-- end row1 --> 

  <!-- end container --> 
</div>
<!-- end mainavbar --> 
