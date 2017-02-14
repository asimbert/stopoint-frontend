<?php
/**
 * Implements an optional custom header for Catch Evolution Pro.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Catch+Box_Pro
 * @since Catch Evolution Pro 1.0
 */

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses catchevolution_header_style() to style front-end.
 * @uses catchevolution_admin_header_style() to style wp-admin form.
 * @uses catchevolution_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since Catch Evolution Pro 1.0
 */
function catchevolution_custom_header_setup() {
	
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '000',
		
		// Header image default
		'default-image'			=> get_template_directory_uri() . '/images/headers/buddha.jpg',
		
		// Set height and width, with a maximum value for the width.
		'height'                 => 400,
		'width'                  => 1600,
		
		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,
			
		// Random image rotation off by default.
		'random-default'         => false,	
			
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'catchevolution_header_style',
		'admin-head-callback'    => 'catchevolution_admin_header_style',
		'admin-preview-callback' => 'catchevolution_admin_header_image',
	);

	$args = apply_filters( 'custom-header', $args );

	// Add support for custom header
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'catchevolution_custom_header_setup' );


if ( ! function_exists( 'catchevolution_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_header_style() {
	global $catchevolution_options_settings, $catchevolution_options_defaults;
    $options = $catchevolution_options_settings;	
	$defaults = $catchevolution_options_defaults;

	$text_color = get_header_textcolor();
	
	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-details {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php 
	
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // catchevolution_header_style

if ( ! function_exists( 'catchevolution_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_admin_header_style() {
	global $catchevolution_options_settings, $catchevolution_options_defaults;
    $options = $catchevolution_options_settings;	
	$defaults = $catchevolution_options_defaults;
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#site-logo {
		float: left;
		line-height: 0;
	}
	#site-details {
		float: left;
	}
	#site-logo.title-right {
		padding-right: 20px;
	}
	#site-title {
		font-size: 46px;
		font-weight: bold;
		line-height: 50px;
		padding: 0;
		margin: 0;
	}
	#site-title a {
		color: #111111;
		text-decoration: none;
	}
	#site-description {
		color: #7a7a7a;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
		line-height: 1.62em;
		padding-left: 5px;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
		
	<?php endif; ?>
	#headimg img {
		height: auto;
		max-width: 100%;
	}
	</style>
<?php
}
endif; // catchevolution_admin_header_style


if ( ! function_exists( 'catchevolution_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
        
        <?php catchevolution_headerdetails(); ?>

		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // catchevolution_admin_header_image


if ( ! function_exists( 'catchevolution_header_top_menu' ) ) :
/**
 * Header Menu
 *
 * @Hooked in catchevolution_after_headercontent
 * @since Catch Evolution 1.0
 */
function catchevolution_header_top_menu() { 
	// Getting data from Theme Options
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings; 
	
	if ( has_nav_menu( 'top', 'catchevolution' ) ) : ?>
        <div id="fixed-header-top" class="full-menu">
            <div class="wrapper">
                <?php 
				echo '<nav id="access-top" role="navigation">';
					$args = array(
						'theme_location'    => 'top',
						'container' 		=> false,
						'items_wrap'        => '<ul id="top-nav" class="menu">%3$s</ul>' 
					);
					wp_nav_menu( $args );
				echo '</nav><!-- #access -->
            </div><!-- .wrapper -->
        </div><!-- #header-menu -->';
	endif; 
	
} // catchevolution_header_top_menu
endif;

add_action( 'catchevolution_before_header', 'catchevolution_header_top_menu', 10 ); 


if ( ! function_exists( 'catchevolution_logo' ) ) :
/**
 * Template for Logo
 *
 * To override this in a child theme
 * simply create your own catchevolution_logo(), and that function will be used instead.
 *
 * @since Catch Evolution Pro 1.0
 */
function catchevolution_logo() {
		
	delete_transient( 'catchevolution_logo' );	
	
	// Getting data from Theme Options
	global $catchevolution_options_settings, $catchevolution_options_defaults;
    $options = $catchevolution_options_settings;	
	$defaults = $catchevolution_options_defaults;
	$sitedetails = $options['site_title_above'];
	$text_color = get_header_textcolor();
	$seperatelogo = $options['seperate_logo'];
	
	
	$removetitle = $options['remove_site_title'];
	$removedesc = $options['remove_site_description'];
	
	
	
	if ( ( !$catchevolution_logo = get_transient( 'catchevolution_logo' ) ) && empty( $options[ 'remove_header_logo' ] ) ) {
		echo '<!-- refreshing cache -->';	
		
		$catchevolution_logo = '';
		
		if ( empty( $sitedetails ) && ( 'blank' == $text_color ) ) {
			$classses = 'title-disable';
		}
		elseif ( empty( $sitedetails ) && ( 'blank' != $text_color ) && ( empty( $removetitle ) || empty( $removedesc ) ) && empty( $seperatelogo ) ) {
			$classses = 'title-right';
		}
		elseif ( !empty( $sitedetails ) && ( 'blank' != $text_color ) && ( empty( $removetitle ) || empty( $removedesc ) ) && empty( $seperatelogo ) ) {
			$classses = 'title-left';
		}
		else {
			$classses = 'clear';
		}
		
		$catchevolution_logo .= '<div id="site-logo" class="' . $classses . '">';
			
		$catchevolution_logo .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
		
		if ( !empty( $options[ 'featured_logo_header' ] ) ) {
		
			$catchevolution_logo .= '<img src="' . esc_url( $options['featured_logo_header'] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
		
		} else {
			
			// if empty featured_logo_header on theme options, display default logo
			$catchevolution_logo .='<img src="' . esc_url( $defaults['featured_logo_header'] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
		}
		
		$catchevolution_logo .= '</a></div><!-- #site-logo -->';

		set_transient( 'catchevolution_logo', $catchevolution_logo, 86940 );
	}
	echo $catchevolution_logo;	
} // catchevolution_logo
endif;


if ( ! function_exists( 'catchevolution_site_details' ) ) :
/**
 * Template for Site Details
 *
 * To override this in a child theme
 * simply create your own catchevolution_header_details(), and that function will be used instead.
 *
 * @since Catch Evolution Pro 1.0
 */
function catchevolution_site_details() { 
	// Getting data from Theme Options
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;
	$removetitle = $options['remove_site_title'];
	$removedesc = $options['remove_site_description'];
	$seperatelogo = $options['seperate_logo'];
	
	if ( !empty ( $seperatelogo ) ) { 
		$classses = 'clear';
	} 
	else { 
		$classses = 'normal';
	};
?> 
	<?php if ( empty( $removetitle ) || empty( $removedesc ) ) { ?>
		<div id="site-details" class="<?php echo $classses; ?>">
			<?php if ( empty( $removetitle ) ) : ?>
				<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>  
			<?php if ( empty( $removedesc ) ) : ?>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
		</div>   
		<?php
	}
}
endif;


if ( ! function_exists( 'catchevolution_headerdetails' ) ) :
/**
 * Header Details including Site Logo, Title and Description
 *
 * @Hooked in catchevolution_headercontent
 * @since Catch Evolution 1.0
 */
function catchevolution_headerdetails() {
	
	// Getting data from Theme Options
	global $catchevolution_options_settings;
	$options = $catchevolution_options_settings;
	$sitedetails = $options['site_title_above'];
	
	echo '<div id="logo-wrap" class="clearfix">';
	
	if ( empty( $sitedetails ) ) {
		echo catchevolution_logo();
		echo catchevolution_site_details();
	} else {
		echo catchevolution_site_details();
		echo catchevolution_logo();
	}
	
	echo '</div><!-- #logo-wrap -->';

} 
endif; //catchevolution_headerdetails

add_action( 'catchevolution_headercontent', 'catchevolution_headerdetails', 10 ); 


if ( ! function_exists( 'catchevolution_header_search' ) ) :
/**
 * Header Search Box
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_header_search() { ?>
	<aside class="widget widget_search" id="header-search">
		<?php get_search_form(); ?>
	</aside>
    <?php
}        
endif; //catchevolution_header_search


/**
 * Header Right Sidebar
 *
 * @Hooked in catchevolution_headercontent
 * @since Catch Evolution 1.0
 */
add_action( 'catchevolution_headercontent', 'catchevolution_header_rightpsidebar', 15 ); 
function catchevolution_header_rightpsidebar() {
	get_sidebar( 'headerright' ); 
}  


if ( ! function_exists( 'catchevolution_featured_header' ) ) :
/**
 * Header Image
 *
 * Uses Custom Header and Featued Images
 * @Hooked in catchevolution_headercontent
 * @since Catch Evolution 1.0
 */
function catchevolution_featured_header() { 
	global $wp_query, $post, $paged, $_wp_default_headers;
	
	// Header Image
	$header_image_path = get_header_image();

	// Check if this is a post or page, if it has a thumbnail, and if it's a big one
	if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
			has_post_thumbnail( $post->ID ) &&
			( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
			$image[1] >= HEADER_IMAGE_WIDTH ) :
		// Houston, we have a new header image!
		echo '<div id="header-image">';
			echo get_the_post_thumbnail( $post->ID );
		echo '</div>';
	elseif ( get_header_image() ) : ?>
		<div id="header-image">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</div>
	<?php endif; 
	
	
} // catchevolution_featured_header
endif;

add_action( 'catchevolution_after_headercontent', 'catchevolution_featured_header', 10 ); 


if ( ! function_exists( 'catchevolution_header_menu' ) ) :
/**
 * Header Menu
 *
 * @Hooked in catchevolution_after_headercontent
 * @since Catch Evolution 1.0
 */
function catchevolution_header_menu() { 
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;	
	$header_menu = $options['disable_header_menu'];
	
	if ( empty ( $header_menu ) ) : ?>
	
    <div id="header-menu">
        <nav id="access" role="navigation">
            <h3 class="assistive-text"><?php _e( 'Primary menu', 'catchevolution' ); ?></h3>
            <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
            <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'catchevolution' ); ?>"><?php _e( 'Skip to primary content', 'catchevolution' ); ?></a></div>
            <div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'catchevolution' ); ?>"><?php _e( 'Skip to secondary content', 'catchevolution' ); ?></a></div>
            <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
        
            <?php
                if ( has_nav_menu( 'primary', 'catchevolution' ) ) { 
                    $args = array(
                        'theme_location'    => 'primary',
                        'container_class' 	=> 'menu-header-container wrapper', 
                        'items_wrap'        => '<ul class="menu">%3$s</ul>' 
                    );
                    wp_nav_menu( $args );
                }
                else {
                    echo '<div class="menu-header-container wrapper">';
                        wp_page_menu( array( 'menu_class'  => 'menu' ) );
                    echo '</div>';
                } ?> 		
                   
            </nav><!-- #access -->
            
        <?php if ( has_nav_menu( 'secondary', 'catchevolution' ) ) { 
			// Check is footer menu is enable or not
			$options = get_option( 'catchevolution_options' );
			if ( !empty ($options ['enable_menus'] ) ) :
				$menuclass = "mobile-enable";
			else :
				$menuclass = "mobile-disable";
			endif;
			?>
            <nav id="access-secondary" class="<?php echo $menuclass; ?>" role="navigation">
                <h3 class="assistive-text"><?php _e( 'Secondary menu', 'catchevolution' ); ?></h3>
                    <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
                    <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'catchevolution' ); ?>"><?php _e( 'Skip to primary content', 'catchevolution' ); ?></a></div>
                    <div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'catchevolution' ); ?>"><?php _e( 'Skip to secondary content', 'catchevolution' ); ?></a></div>
                <?php wp_nav_menu( array( 'theme_location'  => 'secondary', 'container_class' 	=> 'menu-secondary-container wrapper' ) );  ?>
            </nav>
        <?php }	
		
	echo '</div><!-- #header-menu -->';
	
	endif;
	
} // catchevolution_header_menu
endif;

add_action( 'catchevolution_after_header', 'catchevolution_header_menu', 15 );