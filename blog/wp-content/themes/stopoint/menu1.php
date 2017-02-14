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
