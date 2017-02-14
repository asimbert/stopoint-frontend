<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="main">

 *

 * @package Catch Themes

 * @subpackage Catch_Evolution_Pro

 * @since Catch Evolution 1.0

 */

?><!DOCTYPE html>

<!--[if IE 6]>

<html id="ie6" <?php language_attributes(); ?>>

<![endif]-->

<!--[if IE 7]>

<html id="ie7" <?php language_attributes(); ?>>

<![endif]-->

<!--[if IE 8]>

<html id="ie8" <?php language_attributes(); ?>>

<![endif]-->

<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<link rel="profile" href="http://gmpg.org/xfn/11" />



<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />






 			<link type="text/css" href="/blog/wp-content/themes/stopoint/css/bootstrap.min.css" rel="stylesheet">

            <link type="text/css" href="/blog/wp-content/themes/stopoint/style1.css" rel="stylesheet">

            <link type="text/css" href="/blog/wp-content/themes/stopoint/css/animate.css" rel="stylesheet">

            <link type="text/css" href="/blog/wp-content/themes/stopoint/css/owl.carousel.css" rel="stylesheet">

            <link type="text/css" href="/blog/wp-content/themes/stopoint/css/owl.theme.css" rel="stylesheet">

            <link type="text/css" href="/blog/wp-content/themes/stopoint/css/bootstrap-glyphicons.css" rel="stylesheet">

            <link type="text/css" href="/blog/wp-content/themes/stopoint/css/small.css" rel="stylesheet">

<?php

	/* Always have wp_head() just before the closing </head>

	 * tag of your theme, or you will break many plugins, which

	 * generally use this hook to add elements to <head> such

	 * as styles, scripts, and meta tags.

	 */

	wp_head();
	
	

?>

</head>



<body <?php body_class(); ?>>



<?php 

/** 

 * catchevolution_before hook

 */

do_action( 'catchevolution_before' ); ?>



<div id="page" class="hfeed site">



	<?php 

    /** 

     * catchevolution_before_header hook

     */

    do_action( 'catchevolution_before_header' ); ?>

        

    	<?php 

		/** 

		 * catchevolution_before_headercontent hook

		 *

		 * @hooked catchevolution_header_topsidebar - 10

		 */

		do_action( 'catchevolution_before_headercontent' ); ?>

        

    	<div id="header-content" class="clearfix">

        

        	

  <div class="topbar container-fluid">

				<div class="container mobcontainer">

					<div class="row"> 

						<a href="http://www.stopoint.com/" style=""><img class="moblogo logo img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="Logo"/></a>

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
  <div class="container" style="padding:0px;">
    <div class="row" style="margin:0px;">
      <div class=" col-lg-12" style="padding:0px;">
        
        
        <nav class="navbar-default" style="text-align:left;"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="" style="margin-top:6px;">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle" style="margin: -39px 0 0 0;"> 
            	<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
            </button>
          </div>
          <!-- Collection of nav links and other content for toggling -->
          <div id="navbarCollapse" class="mainavbar collapse navbar-collapse">
            <?php
            if (has_nav_menu('primary')) :
              wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav')); 
            endif;
           ?>
          </div>
        </nav>
      
      
      </div>
    </div>
    <!-- end row1 --> 
  </div>
  <!-- end container --> 
</div>
<!-- end mainavbar --> 

                        <ul class="navtop desk-navtop">
                        
<?php
if(isset($_SESSION['login_username'])){
?>
                            <li><strong><?php echo "Welcome, <a href='dashboard.php'>".$_SESSION['login_username']."!"; ?></a></strong></li>
                            <li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/icon4.png" alt="Logout"/><a href="http://www.stopoint.com/logout">Logout</a></li>
<?php
}elseif(isset($_SESSION['FULLNAME'])){
?>
                            <li>
                            <img class="img-circle" src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture" alt="Profiel Image">
                            <strong><?php echo "Welcome, ".$_SESSION['FULLNAME']."!"; ?></strong>
                            </li>
							<li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/icon4.png" alt="Logout"/><a href="http://www.stopoint.com/signfacebook/logout">Logout</a></li>
<?php
}else{
?>
                            <li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/icon4.png" alt="Login"/><a href="http://www.stopoint.com/login">Login</a></li>
<?php
}
?>

                            <li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/icon6.png" alt="Help"/><a href="http://www.stopoint.com/help">Help</a></li>

                            <li><a href="https://www.facebook.com/stopointtrade" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/facebook.png" alt="Facebook"/></a><a href="https://twitter.com/stopointtrade" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/twitter.png" alt="Twitter" /></a></li>

						</ul>

					</div>

                </div> 

			</div>

  <!-- end row --> 

<!-- main nav bar -->


<div class="mainavbar container-fluid desknav">

  <div class="container">

    <div class="row">

      <div class=" col-lg-8 col-md-10">

        <nav class="navbar navbar-default"> 

          <!-- Brand and toggle get grouped for better mobile display -->

          <div class="navbar-header">

            <!--<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>-->

            <a href="#" class="navbar-brand">Welcome To Stopoint !</a> </div>

          <!-- Collection of nav links and other content for toggling -->

          <!--<div id="navbarCollapse" class="collapse navbar-collapse">-->
 <nav id="nav-main" class="clearfix" role="navigation">
          <?php
            if (has_nav_menu('primary')) :
              wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav')); 
            endif;
           ?>
         </nav>   
            <!--<ul class="nav navbar-nav">

              <li class="active"><a href="https://www.stopoint.com"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/topbar/icon7.png" alt="bar"/></a></li>

              <li><a href="https://www.stopoint.com/cellphone">PHONES</a></li>

              <li><a href="https://www.stopoint.com/computers">LAPTOPS</a></li>

              <li><a href="https://www.stopoint.com/tablets">TABLET</a></li>

              <li><a href="https://www.stopoint.com/Tv">TV</a></li>

              <li><a href="https://www.stopoint.com/watch">WATCHES</a></li>

              <li><a href="https://www.stopoint.com/gadgets">OTHER GADGETS</a></li>

                </ul>-->

            

          <!--</div>-->

        </nav>

      </div>

    </div>

    <!-- end row1 --> 

  </div>

  <!-- end container --> 

</div>

<!-- end mainavbar --> 



	<!-- #branding -->

    

        <?php 

		/** 

		 * catchevolution_after_header hook

		 *

		 * @hooked catchevolution_featured_header - 10

         * @hooked catchevolution_header_menu - 15

		 */

		 //do_action( 'catchevolution_after_header' ); ?>

    

	<?php 

    /** 

     * catchevolution_before_main hook

     */

    do_action( 'catchevolution_before_main' ); 

    ?>

    

	<div id="main" class="clearfix">



    	<div class="wrapper">

<?php 
if ( is_front_page() && is_home() ) {
if( function_exists("get_smooth_slider") ){ get_smooth_slider( $slider_id="1"); } 
} ?>
 			<?php 

			/** 

			 * catchevolution_before_contentsidebarwrap hook

			 */

			do_action( 'catchevolution_before_contentsidebarwrap' ); 

			?> 

        	

            <div class="content-sidebar-wrap">       

    

				<?php 

                /** 

                 * catchevolution_before_primary hook

                 *

                 * @hooked catchevolution_slider_display - 10 if full width image slide is selected

                 */

                do_action( 'catchevolution_before_primary' ); ?>

                

                <div id="primary">

                

                    <?php do_action( 'catchevolution_before_content' ); ?>

                    

                    <div id="content" role="main">

                        <?php 

                        /** 

                         * catchevolution_content hook

                         *

                         * @hooked catchevolution_slider_display - 10 if full width image slide is not selected

                         */

                        do_action( 'catchevolution_content' ); ?>