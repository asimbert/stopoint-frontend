

<!-- main nav bar -->


<div class="mainavbar container-fluid desknav">

  <div class="container">

    <div class="row">

      <div class=" col-lg-12">

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

