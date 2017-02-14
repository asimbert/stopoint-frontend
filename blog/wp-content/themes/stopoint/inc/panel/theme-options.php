<?php
/**
 * Catch Evolution Theme Options
 *
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 * @since Catch Evolution Pro 1.0
 */
add_action( 'admin_init', 'catchevolution_register_settings' );
add_action( 'admin_menu', 'catchevolution_options_menu' );


/**
 * Enqueue admin script and styles
 *
 * @uses wp_register_script, wp_enqueue_script, wp_enqueue_media and wp_enqueue_style
 * @Calling jquery, jquery-ui-tabs,jquery-cookie, jquery-ui-sortable, jquery-ui-draggable
 */
function catchevolution_admin_scripts() {
	//jquery-cookie registered in functions.php
	wp_enqueue_script( 'catchevolution_admin', get_template_directory_uri().'/inc/panel/admin.min.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-cookie', 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
	
    //For media uploader
    wp_enqueue_media();
        
    wp_enqueue_script( 'catchevolution_upload', get_template_directory_uri().'/inc/panel/add_image_scripts.min.js', array( 'jquery' ) );
	
    wp_enqueue_style( 'catchevolution_admin',get_template_directory_uri().'/inc/panel/admin.min.css', '',  '1.0', 'screen' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'catchevolution_admin_scripts' );


/*
 * Create a function for Theme Options Page
 *
 * @uses add_menu_page
 * @add action admin_menu 
 */
function catchevolution_options_menu() {
	
	add_theme_page( 
        __( 'Theme Options', 'catchevolution' ),           // Name of page
        __( 'Theme Options', 'catchevolution' ),           // Label in menu
        'edit_theme_options',                           // Capability required
        'theme_options',                                // Menu slug, used to uniquely identify the page
        'catchevolution_theme_options_do_page'             // Function that renders the options page
    );		

}


/*
 * Register options and validation callbacks
 *
 * @uses register_setting
 * @action admin_init
 */
function catchevolution_register_settings(){
	register_setting( 'catchevolution_options', 'catchevolution_options', 'catchevolution_theme_options_validate' );
}


/*
 * Render Catch Evolution Pro Theme Options page
 *
 * @uses settings_fields, get_option, bloginfo
 * @Settings Updated
 */
function catchevolution_theme_options_do_page() {
	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
	<div id="catchthemes" class="wrap">
    	
    	<form method="post" action="options.php">
			<?php
                settings_fields( 'catchevolution_options' );
                global $catchevolution_options_settings;
                $options = $catchevolution_options_settings;
            ?>   
            
            <?php if (false !== $_REQUEST['settings-updated']) : ?>
            	<div class="updated fade"><p><strong><?php _e('Options Saved', 'catchevolution'); ?></strong></p></div>
            <?php endif; ?>
            
			<div id="theme-option-header">
            
                <div id="theme-option-title">
                    <h2 class="title"><?php _e( 'Theme Options By', 'catchevolution' ); ?></h2>
                    <h2 class="logo">
                        <a href="<?php echo esc_url( __( 'http://catchthemes.com/', 'catchevolution' ) ); ?>" title="<?php esc_attr_e( 'Catch Themes', 'catchevolution' ); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri().'/inc/panel/images/catch-themes.png'; ?>" alt="<?php _e( 'Catch Themes', 'catchevolution' ); ?>" />
                        </a>
                    </h2>
                </div><!-- #theme-option-title -->
                
                <div id="upgradepro">
                	<a class="button" href="<?php echo esc_url(__('http://catchthemes.com/themes/catch-evolution-pro/','catchevolution')); ?>" title="<?php esc_attr_e('Upgrade to Catch Evolution Pro', 'catcheverest'); ?>" target="_blank"><?php printf(__('Upgrade to Catch Evolution Pro','catchevolution')); ?></a>
               	</div><!-- #upgradepro -->
            
                <div id="theme-support">
                    <ul>
                    	<li><a class="button donate" href="<?php echo esc_url(__('http://catchthemes.com/donate/','catchevolution')); ?>" title="<?php esc_attr_e('Donate to Catch Evolution', 'catchevolution'); ?>" target="_blank"><?php printf(__('Donate Now','evolution')); ?></a></li>
                  		<li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/theme-instructions/catch-evolution/','catchevolution')); ?>" title="<?php esc_attr_e('Theme Instruction', 'catchevolution'); ?>" target="_blank"><?php printf(__('Theme Instruction','catchevolution')); ?></a></li>
                   		<li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/support/','catchevolution')); ?>" title="<?php esc_attr_e('Support', 'catchevolution'); ?>" target="_blank"><?php printf(__('Support','catchevolution')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://www.facebook.com/catchthemes/','catchevolution')); ?>" title="<?php esc_attr_e('Like Catch Themes on Facebook', 'catchevolution'); ?>" target="_blank"><?php printf(__('Facebook','catchevolution')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://twitter.com/catchthemes/','catchevolution')); ?>" title="<?php esc_attr_e('Follow Catch Themes on Twitter', 'catchevolution'); ?>" target="_blank"><?php printf(__('Twitter','catchevolution')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://wordpress.org/support/view/theme-reviews/catch-evolution/','catchevolution')); ?>" title="<?php esc_attr_e('Rate us 5 Star on WordPress', 'catchevolution'); ?>" target="_blank"><?php printf(__('5 Star Rating','catchevolution')); ?></a></li>
                   	</ul>
                </div><!-- #theme-support --> 
                 
          	</div><!-- #theme-option-header -->                  
                            
            
            <div id="catchevolution_ad_tabs">
                <ul class="tabNavigation" id="mainNav">
                    <li><a href="#themeoptions"><?php _e( 'Theme Options', 'catchevolution' );?></a></li>
                    <li><a href="#slidersettings"><?php _e( 'Featured Post Slider', 'catchevolution' );?></a></li>
                    <li><a href="#sociallinks"><?php _e( 'Social Links', 'catchevolution' );?></a></li>
                    <?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
                    	<li><a href="#webmaster"><?php _e( 'Tools', 'catchevolution' );?></a></li>
                   	<?php endif; ?>
                </ul><!-- .tabsNavigation #mainNav -->
                   
                <!-- Option for Theme Options -->
                <div id="themeoptions">
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Favicon Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php _e( 'Disable Favicon?', 'catchevolution' ); ?></th>
                                         <input type='hidden' value='0' name='catchevolution_options[remove_favicon]'>
                                        <td><input type="checkbox" id="favicon" name="catchevolution_options[remove_favicon]" value="1" <?php checked( '1', $options['remove_favicon'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Fav Icon URL:', 'catchevolution' ); ?></th>
                                        <td><?php if ( !empty ( $options[ 'fav_icon' ] ) ) { ?>
                                                <input class="upload-url" size="65" type="text" name="catchevolution_options[fav_icon]" value="<?php echo esc_url( $options [ 'fav_icon' ] ); ?>" class="upload" />
                                            <?php } else { ?>
                                                <input size="65" type="text" name="catchevolution_options[fav_icon]" value="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" alt="fav" />
                                            <?php }  ?> 
                                            <input ref="<?php esc_attr_e( 'Insert as Fav Icon','catchevolution' );?>" class="catchevolution_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Fav Icon','catchevolution' );?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><?php _e( 'Preview: ', 'catchevolution' ); ?></th>
                                        <td> 
                                            <?php 
                                                if ( !empty( $options[ 'fav_icon' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'fav_icon' ] ).'" alt="fav" />';
                                                } else {
                                                    echo '<img src="'. get_template_directory_uri().'/images/favicon.ico" alt="fav" />';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Web Clip Icon Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php _e( 'Disable Web Clip Icon?', 'catchevolution' ); ?></th>
                                         <input type='hidden' value='0' name='catchevolution_options[remove_web_clip]'>
                                        <td><input type="checkbox" id="favicon" name="catchevolution_options[remove_web_clip]" value="1" <?php checked( '1', $options['remove_web_clip'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Web Clip Icon URL:', 'catchevolution' ); ?></th>
                                        <td><?php if ( !empty ( $options[ 'web_clip' ] ) ) { ?>
                                                <input class="upload-url" size="65" type="text" name="catchevolution_options[web_clip]" value="<?php echo esc_url( $options [ 'web_clip' ] ); ?>" class="upload" />
                                            <?php } else { ?>
                                                <input size="65" type="text" name="catchevolution_options[web_clip]" value="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" alt="fav" />
                                            <?php }  ?> 
                                            <input ref="<?php esc_attr_e( 'Insert as Web Clip Icon','catchevolution' );?>" class="catchevolution_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Web Clip Icon','catchevolution' );?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><?php _e( 'Preview: ', 'catchevolution' ); ?></th>
                                        <td> 
                                            <?php 
                                                if ( !empty( $options[ 'web_clip' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'web_clip' ] ).'" alt="Web Clip Icon" />';
                                                } else {
                                                    echo '<img src="'. get_template_directory_uri().'/images/apple-touch-icon.png" alt="Web Clip Icon" />';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><?php esc_attr_e( 'Note: Web Clip Icon for Apple devices. Recommended Size - Width 144px and Height 144px height, which will support High Resolution Devices like iPad Retina.', 'catchevolution' ); ?></p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->                     
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
                                	<tr>                            
                                        <th scope="row"><?php _e( 'Disable Header?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[disable_header]'>
                                        <td><input type="checkbox" id="headerlogo" name="catchevolution_options[disable_header]" value="1" <?php checked( '1', $options['disable_header'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>
                                    
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Change Custom Header Image (Buddha)?', 'catchevolution' ); ?></th>
                                        <td>
                                        	<a class="button" href="<?php echo admin_url('themes.php?page=custom-header'); ?>" title="<?php esc_attr_e( 'Click here to change header image', 'catchevolution' ); ?>"><?php _e( 'Click here to change header image', 'catchevolution' );?></a>
                                       	</td>
                                    </tr>
                                	<tr>                            
                                        <th scope="row"><?php _e( 'Disable Header Logo?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[remove_header_logo]'>
                                        <td><input type="checkbox" id="headerlogo" name="catchevolution_options[remove_header_logo]" value="1" <?php checked( '1', $options['remove_header_logo'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Logo url:', 'catchevolution' ); ?></th>
                                        <td>
                                            <?php  if ( !empty ( $options[ 'featured_logo_header' ] ) ) { ?>
                                             	<input  class="upload-url" size="65" type="text" name="catchevolution_options[featured_logo_header]" value="<?php echo esc_url ( $options [ 'featured_logo_header' ]); ?>" class="upload" />
                                                 <?php } else { ?>
                                                 <input class="upload-url" size="65" type="text" name="catchevolution_options[featured_logo_header]" value="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo" />
                                                 <?php }  ?>
                                                
                                                <input ref="<?php esc_attr_e( 'Insert as Header Logo','catchevolution' );?>" class="catchevolution_upload_image button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Header Logo','catchevolution' ); ?>" />
                                        </td>
                                    </tr>
                                	<tr>                            
                                        <th scope="row"><?php _e( 'Preview:', 'catchevolution' ); ?></th>
                                        <td>              
                                            <?php 
                                                if ( !empty( $options[ 'featured_logo_header' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'featured_logo_header' ] ).'" alt=""/>';
                                                } else {
                                                    echo '<img src="'. get_template_directory_uri().'/images/logo.png" alt="" />';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Site Title?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[remove_site_title]'>
                                        <td><input type="checkbox" id="headerlogo" name="catchevolution_options[remove_site_title]" value="1" <?php checked( '1', $options['remove_site_title'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Site Description (Tagline)?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[remove_site_description]'>
                                        <td><input type="checkbox" id="headerlogo" name="catchevolution_options[remove_site_description]" value="1" <?php checked( '1', $options['remove_site_description'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Move Site Title and Tagline?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[site_title_above]'>
                                        <td><input type="checkbox" id="site-title" name="catchevolution_options[site_title_above]" value="1" <?php checked( '1', $options['site_title_above'] ); ?> /> <?php _e('Check to move before the Logo', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Seperate Logo and Site Details?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[seperate_logo]'>
                                        <td><input type="checkbox" id="site-title" name="catchevolution_options[seperate_logo]" value="1" <?php checked( '1', $options['seperate_logo'] ); ?> /> <?php _e('Check to move down', 'catchevolution'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Enable Header Right Sidebar?', 'catchevolution' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo admin_url('widgets.php'); ?>" title="<?php esc_attr_e( 'Just add Widgets in Header Right Sidebar', 'catchevolution' ); ?>"><?php _e( 'Just add Widgets in Header Right Sidebar', 'catchevolution' );?></a>
                                        </td>
                                    </tr>                  
                                </tbody>
                            </table>                        

                      		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p>
                     			
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container -->                     
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Menu Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
                                	<tr>
                                        <th scope="row"><?php _e( 'Menu Tutorial', 'catchevolution' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo esc_url( __( 'http://catchthemes.com/blog/custom-menus-wordpress-themes/','catchevolution' ) ); ?>" title="<?php esc_attr_e( 'Menu Tutorial', 'catchevolution' ); ?>" target="_blank"><?php _e( 'Click Here to Read Menu Tutorial', 'catchevolution' );?></a>
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Create Menu', 'catchevolution' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo admin_url('nav-menus.php'); ?>" title="<?php esc_attr_e( 'Create Menu', 'catchevolution' ); ?>"><?php _e( 'Click Here to Create Menu', 'catchevolution' );?></a>
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Assign Menu to Respective Location', 'catchevolution' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo admin_url('nav-menus.php?action=locations'); ?>" title="<?php esc_attr_e( 'Assign Menu Location', 'catchevolution' ); ?>"><?php _e( 'Click Here to Assign Menu Location', 'catchevolution' );?></a>
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Add Menu in Header Right Sidebar', 'catchevolution' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo admin_url('widgets.php'); ?>" title="<?php esc_attr_e( 'Add Menu Widget in Header Right Sidebar', 'catchevolution' ); ?>"><?php _e( 'Add Menu Widget in Header Right Sidebar', 'catchevolution' );?></a>
                                        </td>
                                    </tr>
                                	<tr>                            
                                        <th scope="row"><?php _e( 'Disable Primary & Secondary Menu?', 'catchevolution' ); ?></th>
                                        <input type='hidden' value='0' name='catchevolution_options[disable_header_menu]'>
                                        <td><input type="checkbox" id="disable_header_menu" name="catchevolution_options[disable_header_menu]" value="1" <?php checked( '1', $options['disable_header_menu'] ); ?> /> <?php _e('Check to disable', 'catchevolution'); ?></td>
                                    </tr>                                
                                </tbody>
                            </table> 
                      		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'catchevolution' ); ?>" /></p>
                     			
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Search Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
                                	<tr> 
                                        <th scope="row"><label><?php _e( 'Default Display Text in Search', 'catchevolution' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchevolution_options[search_display_text]" value="<?php echo ( isset( $options[ 'search_display_text' ] ) ) ? esc_attr( $options[ 'search_display_text' ] ) : 'Search'; ?>" />
                                        </td>
                                    </tr>                                  
                                </tbody>
                            </table>                        

                      		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'catchevolution' ); ?>" /></p>
                     			
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container -->  
                    
            		<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Color Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">  
                                <tbody>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Default Color Scheme', 'catchevolution' ); ?></label></th>
                                        <td>
                                            <label title="color-light" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/light.png" alt="color-light" /><br />
                                            <input type="radio" name="catchevolution_options[color_scheme]" id="color-light" <?php checked($options['color_scheme'], 'light') ?> value="light"  />
                                            <?php _e( 'Light', 'catchevolution' ); ?>
                                            </label>
                                            <label title="color-dark" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/dark.png" alt="color-dark" /><br />
                                            <input type="radio" name="catchevolution_options[color_scheme]" id="color-dark" <?php checked($options['color_scheme'], 'dark') ?> value="dark"  />
                                            <?php _e( 'Dark', 'catchevolution' ); ?>
                                            </label>                                       
                                        </td>
                                    </tr>                                
                                
                                	<tr>
                                        <th>
                                            <label for="catchevolution_background_color">
                                                <?php _e( 'Main Background Color:', 'catchevolution' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<a class="button" href="<?php echo admin_url('themes.php?page=custom-background'); ?>">
                                            	<?php _e( 'Click Here to change Main Background Image/Color', 'catchevolution' ); ?>
                                           	</a>
                                        </td>
                                    </tr>                                                                                                     
                                    <tr>
                                        <th>
                                            <label for="catchevolution_header_color">
                                                <?php _e( 'Site Title Color:', 'catchevolution' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<a class="button" href="<?php echo admin_url('themes.php?page=custom-header'); ?>">
                                            	<?php _e( 'Click Here to change Site Title Color', 'catchevolution' ); ?>
                                           	</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>      
                      
                     		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p>	
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container -->                   

                    <div id="default-layout" class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Layout Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table content-layout">  
                                <tbody>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Default Layout', 'catchevolution' ); ?></label></th>
                                        <td>
                                        	<label title="right-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/right-sidebar.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="catchevolution_options[sidebar_layout]" id="right-sidebar" <?php checked($options['sidebar_layout'], 'right-sidebar') ?> value="right-sidebar"  />
                                            <?php _e( 'Right Sidebar', 'catchevolution' ); ?>
                                            </label>  
                                            
                                            <label title="left-Sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/left-sidebar.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="catchevolution_options[sidebar_layout]" id="left-sidebar" <?php checked($options['sidebar_layout'], 'left-sidebar') ?> value="left-sidebar"  />
                                            <?php _e( 'Left Sidebar', 'catchevolution' ); ?>
                                            </label>
                                             
                                            <label title="no-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/no-sidebar.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="catchevolution_options[sidebar_layout]" id="no-sidebar" <?php checked($options['sidebar_layout'], 'no-sidebar') ?> value="no-sidebar"  />
                                            <?php _e( 'No Sidebar', 'catchevolution' ); ?>
                                            </label>   
                                            
                                            <label title="three-columns" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/three-columns.png" alt="Three Columns" /><br />
                                            <input type="radio" name="catchevolution_options[sidebar_layout]" id="three-columns" <?php checked($options['sidebar_layout'], 'three-columns') ?> value="three-columns"  />
                                            <?php _e( 'Three Columns', 'catchevolution' ); ?>
                                            </label>                                                      
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Content Layout', 'catchevolution' ); ?></label></th>
                                        <td>
                                            <label title="content-excerpt" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/excerpt.png" alt="Excerpt/Blog Display" /><br />
                                            <input type="radio" name="catchevolution_options[content_layout]" id="content-excerpt" <?php checked($options['content_layout'], 'excerpt') ?> value="excerpt"  />
                                            <?php _e( 'Excerpt/Blog Display', 'catchevolution' ); ?>
                                            </label>
                                            <label title="content-full" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/full-content.png" alt="Full Content Display" /><br />
                                            <input type="radio" name="catchevolution_options[content_layout]" id="content-full" <?php checked($options['content_layout'], 'full') ?> value="full"  />
                                            <?php _e( 'Full Content Display', 'catchevolution' ); ?>
                                            </label>                  
                                        </td>
                                    </tr>  
                                    
                                    <?php if( $options['reset_sidebar_layout'] == '1' ) { $options['reset_sidebar_layout'] = '0'; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Reset Layout?', 'catchevolution' ); ?></th>
                                            <input type='hidden' value='0' name='catchevolution_options[reset_sidebar_layout]'>
                                            <td><input type="checkbox" id="reset_family" name="catchevolution_options[reset_sidebar_layout]" value="1" <?php checked( '1', $options['reset_sidebar_layout'] ); ?> /> <?php _e('Check to reset', 'catchevolution'); ?></td>
                                    </tr>  
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->   
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Homepage / Frontpage Category Setting', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <?php _e( 'Front page posts categories:', 'catchevolution' ); ?>
                                            <p>
                                                <small><?php _e( 'Only posts that belong to the categories selected here will be displayed on the front page.', 'catchevolution' ); ?></small>
                                            </p>
                                        </th>
                                        <td>
                                            <select name="catchevolution_options[front_page_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple">
                                                <option value="0" <?php if ( empty( $options['front_page_category'] ) ) { echo 'selected="selected"'; } ?>><?php _e( '--Disabled--', 'catchevolution' ); ?></option>
                                                <?php /* Get the list of categories */  
                                                    $categories = get_categories();
                                                    if( empty( $options[ 'front_page_category' ] ) ) {
                                                        $options[ 'front_page_category' ] = array();
                                                    }
                                                    foreach ( $categories as $category) :
                                                ?>
                                                <option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['front_page_category'] ) ) {echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select><br />
                                            <span class="description"><?php _e( 'You may select multiple categories by holding down the CTRL key.', 'catchevolution' ); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                    
					<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Excerpt / More Tag Settings', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
									<tr>
                                        <th scope="row"><label><?php _e( 'More Tag Text', 'catchevolution' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchevolution_options[more_tag_text]" value="<?php echo ( isset( $options[ 'more_tag_text' ] ) ) ? esc_attr( $options[ 'more_tag_text' ] ) : 'Continue Reading &rarr;'; ?>" />
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th scope="row"><?php _e( 'Excerpt length(words)', 'catchevolution' ); ?></th>
                                        <td><input type="text" size="3" name="catchevolution_options[excerpt_length]" value="<?php echo intval( $options[ 'excerpt_length' ] ); ?>" /></td>
                                    </tr>  
                                    <?php if( $options['reset_more_tag'] == '1' ) { $options['reset_more_tag'] = '0'; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Reset?', 'catchevolution' ); ?></th>
                                            <input type='hidden' value='0' name='catchevolution_options[reset_more_tag]'>
                                            <td><input type="checkbox" id="reset_more_tag" name="catchevolution_options[reset_more_tag]" value="1" <?php checked( '1', $options['reset_more_tag'] ); ?> /> <?php _e('Check to reset', 'catchevolution'); ?></td>
                                    </tr> 
                              	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Feed Redirect', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
									<tr>
                                        <th scope="row"><label><?php _e( 'Feed Redirect URL', 'catchevolution' ); ?></label>
                                        <p><small><?php _e( 'Add in the Feedburner URL', 'catchevolution' ); ?></small></p>
                                        </th>
                                        <td><input type="text" size="70" name="catchevolution_options[feed_url]" value="<?php echo esc_attr( $options[ 'feed_url' ] ); ?>" />
                                        </td>
                                    </tr>  
                               	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->        
                                        
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Custom CSS', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside"> 
                            <table class="form-table">  
                                <tbody>       
                                    <tr>
                                        <th scope="row"><?php _e( 'Enter your custom CSS styles.', 'catchevolution' ); ?></th>
                                        <td>
                                            <textarea name="catchevolution_options[custom_css]" id="custom-css" cols="90" rows="12"><?php echo esc_attr( $options[ 'custom_css' ] ); ?></textarea>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th scope="row"><?php _e( 'CSS Tutorial from W3Schools.', 'catchevolution' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo esc_url( __( 'http://www.w3schools.com/css/default.asp','catchevolution' ) ); ?>" title="<?php esc_attr_e( 'CSS Tutorial', 'catchevolution' ); ?>" target="_blank"><?php _e( 'Click Here to Read', 'catchevolution' );?></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->                     

                </div> <!-- #designsettings -->  

                
                <div id="slidersettings">
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Slider Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">                      
                                <tr>
                                    <th scope="row"><label><?php _e( 'Enable Sidebar', 'catchevolution' ); ?></label></th>
                                    <td>
                                        <label title="enable-slider-homepager" class="box">
                                        <input type="radio" name="catchevolution_options[enable_slider]" id="enable-slider-homepage" <?php checked($options['enable_slider'], 'enable-slider-homepage') ?> value="enable-slider-homepage"  />
                                        <?php _e( 'Homepage / Frontpage', 'catchevolution' ); ?>
                                        </label>
                                        <label title="enable-slider-allpage" class="box">
                                        <input type="radio" name="catchevolution_options[enable_slider]" id="enable-slider-allpage" <?php checked($options['enable_slider'], 'enable-slider-allpage') ?> value="enable-slider-allpage"  />
                                         <?php _e( 'Entire Site', 'catchevolution' ); ?>
                                        </label>
                                        <label title="disable-slider" class="box">
                                        <input type="radio" name="catchevolution_options[enable_slider]" id="disable-slider" <?php checked($options['enable_slider'], 'disable-slider') ?> value="disable-slider"  />
                                         <?php _e( 'Disable', 'catchevolution' ); ?>
                                        </label>                                
                                    </td>
                                </tr>                        
                                <tr>
                                    <th scope="row"><?php _e( 'Number of Slides', 'catchevolution' ); ?></th>
                                    <td><input type="text" name="catchevolution_options[slider_qty]" value="<?php echo intval( $options[ 'slider_qty' ] ); ?>" size="2" /></td>
                                </tr> 
        
                                <tr>
                                    <th>
                                        <label for="catchevolution_cycle_style"><?php _e( 'Transition Effect:', 'catchevolution' ); ?></label>
                                    </th>
                                    <td>
                                        <select id="catchevolution_cycle_style" name="catchevolution_options[transition_effect]">
                                            <option value="fade" <?php selected('fade', $options['transition_effect']); ?>><?php _e( 'fade', 'catchevolution' ); ?></option>
                                            <option value="wipe" <?php selected('wipe', $options['transition_effect']); ?>><?php _e( 'wipe', 'catchevolution' ); ?></option>
                                            <option value="scrollUp" <?php selected('scrollUp', $options['transition_effect']); ?>><?php _e( 'scrollUp', 'catchevolution' ); ?></option>
                                            <option value="scrollDown" <?php selected('scrollDown', $options['transition_effect']); ?>><?php _e( 'scrollDown', 'catchevolution' ); ?></option>
                                            <option value="scrollLeft" <?php selected('scrollLeft', $options['transition_effect']); ?>><?php _e( 'scrollLeft', 'catchevolution' ); ?></option>
                                            <option value="scrollRight" <?php selected('scrollRight', $options['transition_effect']); ?>><?php _e( 'scrollRight', 'catchevolution' ); ?></option>
                                            <option value="blindX" <?php selected('blindX', $options['transition_effect']); ?>><?php _e( 'blindX', 'catchevolution' ); ?></option>
                                            <option value="blindY" <?php selected('blindY', $options['transition_effect']); ?>><?php _e( 'blindY', 'catchevolution' ); ?></option>
                                            <option value="blindZ" <?php selected('blindZ', $options['transition_effect']); ?>><?php _e( 'blindZ', 'catchevolution' ); ?></option>
                                            <option value="cover" <?php selected('cover', $options['transition_effect']); ?>><?php _e( 'cover', 'catchevolution' ); ?></option>
                                            <option value="shuffle" <?php selected('shuffle', $options['transition_effect']); ?>><?php _e( 'shuffle', 'catchevolution' ); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Transition Delay', 'catchevolution' ); ?></th>
                                    <td>
                                        <input type="text" name="catchevolution_options[transition_delay]" value="<?php echo $options[ 'transition_delay' ]; ?>" size="2" />
                                       <span class="description"><?php _e( 'second(s)', 'catchevolution' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Transition Length', 'catchevolution' ); ?></th>
                                    <td>
                                        <input type="text" name="catchevolution_options[transition_duration]" value="<?php echo $options[ 'transition_duration' ]; ?>" size="2" />
                                        <span class="description"><?php _e( 'second(s)', 'catchevolution' ); ?></span>
                                    </td>
                                </tr>                      
        
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
                    <div class="option-container post-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Post Slider Options', 'catchevolution' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                            	<tr>
                                    <th scope="row"><?php _e( 'Post Slider Tutorial', 'catchevolution' ); ?></th>
                                    <td>
                                        <a class="button" href="<?php echo esc_url( __( 'http://catchthemes.com/blog/videos-blog/video-series-adding-featured-post-slider/','catchevolution' ) ); ?>" title="<?php esc_attr_e( 'Post Slider Tutorial', 'catchevolution' ); ?>" target="_blank"><?php _e( 'Click Here to Read Post Slider Tutorial', 'catchevolution' );?></a>
                                    </td>
                              	</tr>
                                <tr>                            
                                    <th scope="row"><?php _e( 'Exclude Slider post from Homepage posts?', 'catchevolution' ); ?></th>
                                     <input type='hidden' value='0' name='catchevolution_options[exclude_slider_post]'>
                                    <td><input type="checkbox" id="headerlogo" name="catchevolution_options[exclude_slider_post]" value="1" <?php checked( '1', $options['exclude_slider_post'] ); ?> /> <?php _e('Check to exclude', 'catchevolution'); ?></td>
                                </tr>
                                <tbody class="sortable">
                                    <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <tr>
                                        <th scope="row"><label class="handle"><?php _e( 'Featured Slider Post #', 'catchevolution' ); ?><span class="count"><?php echo absint( $i ); ?></span></label></th>
                                        <td><input type="text" name="catchevolution_options[featured_slider][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_slider', $options ) && array_key_exists( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>" />
                                        <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider', $options ) && array_key_exists ( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'catchevolution' ); ?></a>
                                        </td>
                                    </tr>                           
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here You can put your Post IDs which displays on Homepage as slider.', 'catchevolution' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->                   
                       
                </div><!-- #slidersettings -->
                
                <div id="sociallinks">
                	<div class="option-container">
                        <table class="form-table">
                            <tbody>
                            	<tr>                            
                                    <th scope="row"><?php _e( 'Enable Social Icons in Header Right Sidebar?', 'catchevolution' ); ?></th>
                                    <td>
                                        <a class="button" href="<?php echo admin_url('widgets.php'); ?>" title="<?php esc_attr_e( 'Just add Catch Evolution Social Widget in Header Right Sidebar', 'catchevolution' ); ?>"><?php _e( 'Just add Catch Evolution Social Widget in Header Right Sidebar', 'catchevolution' );?></a>
                                    </td>
                                </tr>     
                                <tr>                            
                                    <th scope="row"><?php _e( 'Enable Social Icons in Footer?', 'catchevolution' ); ?></th>
                                    <input type='hidden' value='0' name='catchevolution_options[disable_footer_social]'>
                                    <td><input type="checkbox" id="headerlogo" name="catchevolution_options[disable_footer_social]" value="1" <?php checked( '1', $options['disable_footer_social'] ); ?> /> <?php _e('Check to enable', 'catchevolution'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Facebook', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_facebook]" value="<?php echo esc_url( $options[ 'social_facebook' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Twitter', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_twitter]" value="<?php echo esc_url( $options[ 'social_twitter'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Google+', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_googleplus]" value="<?php echo esc_url( $options[ 'social_googleplus'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Pinterest', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_pinterest]" value="<?php echo esc_url( $options[ 'social_pinterest'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Youtube', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_youtube]" value="<?php echo esc_url( $options[ 'social_youtube' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Vimeo', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_vimeo]" value="<?php echo esc_url( $options[ 'social_vimeo' ] ); ?>" />
                                    </td>
                                </tr>
                                
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Linkedin', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_linkedin]" value="<?php echo esc_url( $options[ 'social_linkedin'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'AIM', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_aim]" value="<?php echo esc_url( $options[ 'social_aim'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'MySpace', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_myspace]" value="<?php echo esc_url( $options[ 'social_myspace' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Flickr', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_flickr]" value="<?php echo esc_url( $options[ 'social_flickr' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Tumblr', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_tumblr]" value="<?php echo esc_url( $options[ 'social_tumblr' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'deviantART', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_deviantart]" value="<?php echo esc_url( $options[ 'social_deviantart' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Dribbble', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_dribbble]" value="<?php echo esc_url( $options[ 'social_dribbble' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'WordPress', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_wordpress]" value="<?php echo esc_url( $options[ 'social_wordpress' ] ); ?>" />
                                    </td>
                                </tr>                           
                                <tr>
                                    <th scope="row"><h4><?php _e( 'RSS', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_rss]" value="<?php echo esc_url( $options[ 'social_rss' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Slideshare', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_slideshare]" value="<?php echo esc_url( $options[ 'social_slideshare' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Instagram', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_instagram]" value="<?php echo esc_url( $options[ 'social_instagram' ] ); ?>" />
                                    </td>
                                </tr>                           
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Skype', 'catchevolution' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_skype]" value="<?php echo esc_attr( $options[ 'social_skype' ] ); ?>" />
                                    </td>
                                </tr>
                                 <tr>
                                    <th scope="row"><h4><?php _e( 'Soundcloud', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_soundcloud]" value="<?php echo esc_url( $options[ 'social_soundcloud' ] ); ?>" />
                                    </td>
                                </tr>                               
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Email', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_email]" value="<?php echo sanitize_email( $options[ 'social_email' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Contact', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_contact]" value="<?php echo esc_url( $options[ 'social_contact' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Xing', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_xing]" value="<?php echo esc_url( $options[ 'social_xing' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Meetup', 'catchevolution' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catchevolution_options[social_meetup]" value="<?php echo esc_url( $options[ 'social_meetup' ] ); ?>" />
                                    </td>
                                </tr>                                                                
                            </tbody>
                        </table>                           
                        <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p>
                    </div><!-- .option-container -->
                </div><!-- #sociallinks -->
                
                <?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
                    <div id="webmaster">
                        <div class="option-container">
                            <h3 class="option-toggle"><a href="#"><?php _e( 'Header and Footer Codes', 'catchevolution' ); ?></a></h3>
                            <div class="option-content inside">
                                <table class="form-table">  
                                    <tbody>       
                                        <tr>
                                            <th scope="row"><?php _e( 'Code to display on Header', 'catchevolution' ); ?></th>
                                            <td>
                                            <textarea name="catchevolution_options[analytic_header]" id="analytics" rows="7" cols="80" ><?php echo esc_html( $options[ 'analytic_header' ] ); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td><td><?php _e('Note: Here you can put scripts from Google, Facebook etc. which will load on Header', 'catchevolution' ); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php _e('Code to display on Footer', 'catchevolution' ); ?></th>
                                            <td>
                                             <textarea name="catchevolution_options[analytic_footer]" id="analytics" rows="7" cols="80" ><?php echo esc_html( $options[ 'analytic_footer' ] ); ?></textarea>
                                 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td><td><?php _e( 'Note: Here you can put scripts from Google, Facebook, Add This etc. which will load on footer', 'catchevolution' ); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchevolution' ); ?>" /></p> 
                            </div><!-- .option-content -->
                        </div><!-- .option-container -->  
                    </div><!-- #webmaster -->
              	<?php endif; ?>      

            </div><!-- #catchevolution_ad_tabs -->
		</form>
	</div><!-- .wrap -->
<?php
}


/**
 * Validate content options
 * @param array $options
 * @uses esc_url_raw, absint, esc_textarea, sanitize_text_field, catchevolution_invalidate_caches
 * @return array 
 */
function catchevolution_theme_options_validate( $options ) {
	global $catchevolution_options_settings;
    $input_validated = $catchevolution_options_settings;
	
	global $catchevolution_options_defaults;
	$defaults = $catchevolution_options_defaults;
	
    $input = array();
    $input = $options;
	
	// data validation for responsive layout
	// data validation for favicon
	if ( isset( $input[ 'fav_icon' ] ) ) {
		$input_validated[ 'fav_icon' ] = esc_url_raw( $input[ 'fav_icon' ] );
	}
	if ( isset( $input['remove_favicon'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_favicon' ] = $input[ 'remove_favicon' ];
	}
	
	// data validation for web clip icon
	if ( isset( $input[ 'web_clip' ] ) ) {
		$input_validated[ 'web_clip' ] = esc_url_raw( $input[ 'web_clip' ] );
	}
	if ( isset( $input['remove_web_clip'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_web_clip' ] = $input[ 'remove_web_clip' ];
	}	
	
	//Remove Header
	if ( isset( $input['disable_header'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_header' ] = $input[ 'disable_header' ];
	} 
	
	// data validation for logo
	if ( isset( $input[ 'featured_logo_header' ] ) ) {
		$input_validated[ 'featured_logo_header' ] = esc_url_raw( $input[ 'featured_logo_header' ] );
	}
	if ( isset( $input['remove_header_logo'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_header_logo' ] = $input[ 'remove_header_logo' ];
	} 

	// data validation for site tile above logo
	if ( isset( $input['remove_site_title'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_site_title' ] = $input[ 'remove_site_title' ];
	} 
	if ( isset( $input['remove_site_description'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_site_description' ] = $input[ 'remove_site_description' ];
	} 
	if ( isset( $input['site_title_above'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'site_title_above' ] = $input[ 'site_title_above' ];
	}	

	// data validation to move logo
	if ( isset( $input['seperate_logo'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'seperate_logo' ] = $input[ 'seperate_logo' ];
	}		

	// data validation for Disable Primary Menu 
	if ( isset( $input['disable_header_menu'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_header_menu' ] = $input[ 'disable_header_menu' ];
	}	
	
	// data validation for Search Settings
	if ( isset( $input[ 'search_display_text' ] ) ) {
        $input_validated[ 'search_display_text' ] = sanitize_text_field( $input[ 'search_display_text' ] );
    }	

	// data validation for Color Scheme
	if ( isset( $input['color_scheme'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'color_scheme' ] = $input[ 'color_scheme' ];
	} 
	
    // data validation for Default Layout verification	
	if ( isset( $input[ 'sidebar_layout' ] ) ) {
		$input_validated[ 'sidebar_layout' ] = $input[ 'sidebar_layout' ];
	}
   // data validation for Homepage Content Layout verification
	if ( isset( $input[ 'content_layout' ] ) ) {
		$input_validated[ 'content_layout' ] = $input[ 'content_layout' ];
	}
	if ( isset( $input['reset_sidebar_layout'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_sidebar_layout' ] = $input[ 'reset_sidebar_layout' ];
		
		if ( $input['reset_sidebar_layout'] == 1 ) {
			global $catchevolution_options_defaults;
			$defaults = $catchevolution_options_defaults;
			$input_validated[ 'sidebar_layout' ] = $defaults[ 'sidebar_layout' ];
			$input_validated[ 'content_layout' ] = $defaults[ 'content_layout' ];
		}
	}	
	
	// data validation for Homepage/Frontpage posts categories
    if ( isset( $input['front_page_category' ] ) ) {
		$input_validated['front_page_category'] = $input['front_page_category'];
    }	
	
	// data validation for More Tags and Excerpt Length
    if ( isset( $input[ 'more_tag_text' ] ) ) {
        $input_validated[ 'more_tag_text' ] = htmlentities( sanitize_text_field ( $input[ 'more_tag_text' ] ), ENT_QUOTES, 'UTF-8' );
    }   
    //data validation for excerpt length
    if ( isset( $input[ 'excerpt_length' ] ) ) {
        $input_validated[ 'excerpt_length' ] = absint( $input[ 'excerpt_length' ] ) ? $input [ 'excerpt_length' ] : 30;
    }
	
   //data validation for reset more
	if ( isset( $input['reset_more_tag'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_more_tag' ] = $input[ 'reset_more_tag' ];
		
		if( $input['reset_more_tag'] == 1 ) {
			global $catchevolution_options_defaults;
			$defaults = $catchevolution_options_defaults;
			$input_validated[ 'more_tag_text' ] = $defaults[ 'more_tag_text' ];
			$input_validated[ 'excerpt_length' ] = $defaults[ 'excerpt_length' ];
		}	
	}		
	
	//Feed Redirect
	if ( isset( $input[ 'feed_url' ] ) ) {
		$input_validated['feed_url'] = esc_url_raw($input['feed_url']);
	}
	
	// data validation for Custom CSS Style
	if ( isset( $input['custom_css'] ) ) {
		$input_validated['custom_css'] = wp_kses_stripslashes($input['custom_css']);
	}	
		
    if ( isset( $input['exclude_slider_post'] ) ) {
        // Our checkbox value is either 0 or 1 
   		$input_validated[ 'exclude_slider_post' ] = $input[ 'exclude_slider_post' ];	
	
    }
	
	// data validation for Enable Slider
	if( isset( $input[ 'enable_slider' ] ) ) {
		$input_validated[ 'enable_slider' ] = $input[ 'enable_slider' ];
	}	
    // data validation for number of slides
	if ( isset( $input[ 'slider_qty' ] ) ) {
		$input_validated[ 'slider_qty' ] = absint( $input[ 'slider_qty' ] ) ? $input [ 'slider_qty' ] : 4;
	}
    // data validation for transition effect
    if( isset( $input[ 'transition_effect' ] ) ) {
        $input_validated['transition_effect'] = wp_filter_nohtml_kses( $input['transition_effect'] );
    }
    // data validation for transition delay
    if ( isset( $input[ 'transition_delay' ] ) && is_numeric( $input[ 'transition_delay' ] ) ) {
        $input_validated[ 'transition_delay' ] = $input[ 'transition_delay' ];
    }
    // data validation for transition length
    if ( isset( $input[ 'transition_duration' ] ) && is_numeric( $input[ 'transition_duration' ] ) ) {
        $input_validated[ 'transition_duration' ] = $input[ 'transition_duration' ];
    }	
	
	// data validation for Featured Post and Page Slider
	if ( isset( $input[ 'featured_slider' ] ) ) {
		$input_validated[ 'featured_slider' ] = array();
	}
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_slider' ][ $i ] ) && intval( $input[ 'featured_slider' ][ $i ] ) ) {
				$input_validated[ 'featured_slider' ][ $i ] = absint($input[ 'featured_slider' ][ $i ] );
			}
		}
	}		
	
	// data validation for Social Icons
	if ( isset( $input['disable_footer_social'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_footer_social' ] = $input[ 'disable_footer_social' ];
	}	
	if( isset( $input[ 'social_facebook' ] ) ) {
		$input_validated[ 'social_facebook' ] = esc_url_raw( $input[ 'social_facebook' ] );
	}
	if( isset( $input[ 'social_twitter' ] ) ) {
		$input_validated[ 'social_twitter' ] = esc_url_raw( $input[ 'social_twitter' ] );
	}
	if( isset( $input[ 'social_googleplus' ] ) ) {
		$input_validated[ 'social_googleplus' ] = esc_url_raw( $input[ 'social_googleplus' ] );
	}
	if( isset( $input[ 'social_pinterest' ] ) ) {
		$input_validated[ 'social_pinterest' ] = esc_url_raw( $input[ 'social_pinterest' ] );
	}	
	if( isset( $input[ 'social_youtube' ] ) ) {
		$input_validated[ 'social_youtube' ] = esc_url_raw( $input[ 'social_youtube' ] );
	}
	if( isset( $input[ 'social_vimeo' ] ) ) {
		$input_validated[ 'social_vimeo' ] = esc_url_raw( $input[ 'social_vimeo' ] );
	}	
	if( isset( $input[ 'social_linkedin' ] ) ) {
		$input_validated[ 'social_linkedin' ] = esc_url_raw( $input[ 'social_linkedin' ] );
	}
	if( isset( $input[ 'social_aim' ] ) ) {
		$input_validated[ 'social_aim' ] = esc_url_raw( $input[ 'social_aim' ] );
	}	
	if( isset( $input[ 'social_myspace' ] ) ) {
		$input_validated[ 'social_myspace' ] = esc_url_raw( $input[ 'social_myspace' ] );
	}
	if( isset( $input[ 'social_flickr' ] ) ) {
		$input_validated[ 'social_flickr' ] = esc_url_raw( $input[ 'social_flickr' ] );
	}
	if( isset( $input[ 'social_tumblr' ] ) ) {
		$input_validated[ 'social_tumblr' ] = esc_url_raw( $input[ 'social_tumblr' ] );
	}	
	if( isset( $input[ 'social_deviantart' ] ) ) {
		$input_validated[ 'social_deviantart' ] = esc_url_raw( $input[ 'social_deviantart' ] );
	}
	if( isset( $input[ 'social_dribbble' ] ) ) {
		$input_validated[ 'social_dribbble' ] = esc_url_raw( $input[ 'social_dribbble' ] );
	}	
	if( isset( $input[ 'social_wordpress' ] ) ) {
		$input_validated[ 'social_wordpress' ] = esc_url_raw( $input[ 'social_wordpress' ] );
	}	
	if( isset( $input[ 'social_rss' ] ) ) {
		$input_validated[ 'social_rss' ] = esc_url_raw( $input[ 'social_rss' ] );
	}
	if( isset( $input[ 'social_slideshare' ] ) ) {
		$input_validated[ 'social_slideshare' ] = esc_url_raw( $input[ 'social_slideshare' ] );
	}	
	if( isset( $input[ 'social_instagram' ] ) ) {
		$input_validated[ 'social_instagram' ] = esc_url_raw( $input[ 'social_instagram' ] );
	}	
	if( isset( $input[ 'social_skype' ] ) ) {
		$input_validated[ 'social_skype' ] = sanitize_text_field( $input[ 'social_skype' ] );
	}	
	if( isset( $input[ 'social_soundcloud' ] ) ) {
		$input_validated[ 'social_soundcloud' ] = esc_url_raw( $input[ 'social_soundcloud' ] );
	}		
	if( isset( $input[ 'social_email' ] ) &&  isset( $input[ 'social_email' ] )  ) {
		$input_validated[ 'social_email' ] = sanitize_email( $input[ 'social_email' ] );
	}	
	if( isset( $input[ 'social_contact' ] ) ) {
		$input_validated[ 'social_contact' ] = esc_url_raw( $input[ 'social_contact' ] );
	}
	if( isset( $input[ 'social_xing' ] ) ) {
		$input_validated[ 'social_xing' ] = esc_url_raw( $input[ 'social_xing' ] );
	}
	if( isset( $input[ 'social_meetup' ] ) ) {
		$input_validated[ 'social_meetup' ] = esc_url_raw( $input[ 'social_meetup' ] );
	}	

		
	//Tool Verification
	if( isset( $input[ 'analytic_header' ] ) ) {
		$input_validated[ 'analytic_header' ] = wp_kses_stripslashes( $input[ 'analytic_header' ] );
	}
	if( isset( $input[ 'analytic_footer' ] ) ) {
		$input_validated[ 'analytic_footer' ] = wp_kses_stripslashes( $input[ 'analytic_footer' ] );	
	}		
	
	//Clearing the theme option cache
	if( function_exists( 'catchevolution_themeoption_invalidate_caches' ) ) catchevolution_themeoption_invalidate_caches();
	
	return $input_validated;
}


/*
 * Clearing the cache if any changes in Admin Theme Option
 */
function catchevolution_themeoption_invalidate_caches(){
	delete_transient( 'catchevolution_responsive' ); // Disable responsive layout
	delete_transient( 'catchevolution_favicon' );	  // favicon on cpanel/ backend and frontend
	delete_transient( 'catchevolution_web_clip' ); // web clip icons
	delete_transient( 'catchevolution_inline_css' ); // Custom Inline CSS and color options
	delete_transient( 'catchevolution_sliders' ); // featured post slider
	delete_transient( 'catchevolution_social_networks' );  // Social links on header
	delete_transient( 'catchevolution_social_search' );  // Social links with search  on header
	delete_transient( 'catchevolution_site_verification' ); // scripts which loads on header	
	delete_transient( 'catchevolution_footercode' ); // scripts which loads on footer
	delete_transient( 'catchevolution_footer_content' ); // Footer content 
}

/*
 * Clearing the cache if any changes in post or page
 */
function catchevolution_post_invalidate_caches(){
	delete_transient( 'catchevolution_sliders' ); // featured post slider
}
//Add action hook here save post
add_action( 'save_post', 'catchevolution_post_invalidate_caches' );


/**
 * Function to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function catchevolution_the_year() {
    return date( __( 'Y', 'catchevolution' ) );
}


/**
 * Function to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function catchevolution_site_link() {
    return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}


/**
 * Function to display a link to WordPress.org.
 *
 * @return string
 */
function catchevolution_theme_name() {
    return '<span class="theme-name">' . __( 'Theme: Catch Evolution by ', 'catchevolution' ) . '</span>';    
}


/**
 * Function to display a link to Theme Link.
 *
 * @return string
 */
function catchevolution_theme_author() {
    
    return '<span class="theme-author"><a href="' . esc_url( 'http://catchthemes.com/' ) . '" target="_blank" title="' . esc_attr__( 'Catch Themes', 'catchevolution' ) . '">' . __( 'Catch Themes', 'catchevolution' ) . '</a></span>';

}


/**
 * Function to display Catch Evolution Assets
 *
 * @return string
 */
function catchevolution_assets(){
    $catchevolution_content = '<div class="copyright">'. esc_attr__( 'Copyright', 'catchevolution' ) . ' &copy; '. catchevolution_the_year() . ' ' . catchevolution_site_link() . ' ' . esc_attr__( 'All Rights Reserved', 'catchevolution' ) . '.</div><div class="powered">'. catchevolution_theme_name() . catchevolution_theme_author() . '</div>';
    return $catchevolution_content;
}


/**
 * Custom scripts and styles on Customizer for Catch Evolution
 *
 * @since Catch Evolution 2.3
 */
function catchevolution_customize_scripts() {
    wp_register_script( 'catchevolution_customizer_custom', get_template_directory_uri() . '/inc/panel/customizer-custom-scripts.js', array( 'jquery' ), '20140108', true );

    $catchevolution_misc_links = array(
                            'upgrade_link'              => esc_url( admin_url( 'themes.php?page=theme_options' ) ),
                            'upgrade_text'              => __( 'More Theme Options &raquo;', 'catchevolution' ),
                            );

    //Add More Theme Options Button
    wp_localize_script( 'catchevolution_customizer_custom', 'catchevolution_misc_links', $catchevolution_misc_links );

    wp_enqueue_script( 'catchevolution_customizer_custom' );

    wp_enqueue_style( 'catchevolution_customizer_custom', get_template_directory_uri() . '/inc/panel/catchevolution-customizer.css');
}
add_action( 'customize_controls_print_footer_scripts', 'catchevolution_customize_scripts');