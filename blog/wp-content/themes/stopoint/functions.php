<?php
/**
 * Catch Evolution functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, catchevolution_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'catchevolution_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Catch Themes
 * @subpackage Catch_Evolution
 * @since Catch Evolution 1.0
 */


/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 678;	
	

if ( ! function_exists( 'catchevolution_content_width' ) ) :
/**
 * Change the content width based on the Theme Settings and Page/Post Settings
 */
function catchevolution_content_width() {
	
	//Getting Ready to load data from Theme Options Panel
	global $post, $wp_query, $content_width, $catchevolution_options_settings;
   	$options = $catchevolution_options_settings;
	$themeoption_layout = $options['sidebar_layout'];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	
	// Blog Page setting in Reading Settings
	if ( $page_id == $page_for_posts ) {
		$layout = get_post_meta( $page_for_posts,'catchevolution-sidebarlayout', true );
	}	
	// Settings for page/post/attachment
	elseif ( $post) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'catchevolution-sidebarlayout', true );
		} else {
			$layout = get_post_meta( $post->ID,'catchevolution-sidebarlayout', true ); 
		}
	}
	
	if ( empty( $layout ) || ( !is_page() && !is_single() ) ) {
		$layout='default';
	}	

	if ( ( $layout == 'three-columns' || ( $layout=='default' && $themeoption_layout == 'three-columns') ) ) {
		$content_width = 454; /* pixels */	
	}
	
}
endif; // catchevolution_content_width

add_action( 'template_redirect', 'catchevolution_content_width' );


/**
 * Tell WordPress to run catchevolution_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'catchevolution_setup' );


if ( ! function_exists( 'catchevolution_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override catchevolution_setup() in a child theme, add your own catchevolution_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,custom headers and backgrounds.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Catch Evolution, use a find and replace
	 * to change 'catchevolution' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'catchevolution', get_template_directory() . '/languages' );	

	/**
     * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
     * @see http://codex.wordpress.org/Function_Reference/add_editor_style
     */
	add_editor_style();
	
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	/**
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );	

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'chat' ) );
	
	// Load up theme options defaults
	require( get_template_directory() . '/inc/panel/catchevolution-themeoptions-defaults.php' );
	
	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/panel/theme-options.php' );
	
	// Register Sidebar and Widget.
	require( get_template_directory() . '/inc/catchevolution-widgets.php' );
	
	// Load up our Catch Evolution Pro's Functions
	require( get_template_directory() . '/inc/catchevolution-functions.php' );

	// Load up our Catch Evolution Pro's metabox
	require( get_template_directory() . '/inc/catchevolution-metabox.php' );

	/**
     * This feature enables Jetpack plugin Infinite Scroll
     */		
    add_theme_support( 'infinite-scroll', array(
		'type'           => 'click',										
        'container'      => 'content',
        'footer_widgets' => array( 'sidebar-2', 'sidebar-3', 'sidebar-4' ),
        'footer'         => 'page',
    ) );
	
	/**
     * This feature enables custom-menus support for a theme.
     * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
     */		
	register_nav_menus(array(
		'top' 		=> __( 'Fixed Header Top Menu', 'catchevolution' ),
		'primary' 	=> __( 'Primary Menu', 'catchevolution' ),
	   	'secondary'	=> __( 'Secondary Menu', 'catchevolution' ),
		'footer'	=> __( 'Footer Menu', 'catchevolution' )
	) );

	// Add support for custom backgrounds	
	add_theme_support( 'custom-background' ); 

	/**
     * This feature enables post-thumbnail support for a theme.
     * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
	add_theme_support( 'post-thumbnails' );
	
	//Featued Posts for Normal Width
	add_image_size( 'featured-slider', 754, 400, true ); // Used for featured posts if a large-feature doesn't exist
	
	//Featured Posts for Full Width
	add_image_size( 'featured-slider-larger', 1190, 500, true ); // Used for featured posts if a large-feature doesn't exist
	
	//Plugin Support for WooCommerce
	catchevolution_woocommerce_activated();

}
endif; // catchevolution_setup


/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );


if ( ! function_exists( 'catchevolution_woocommerce_activated' ) ) :
/**
 * Add Suport for WooCommerce Plugin
 */	
function catchevolution_woocommerce_activated() {
	if ( class_exists( 'woocommerce' ) ) { 
		add_theme_support( 'woocommerce' );			
	    require( get_template_directory() . '/inc/catchevolution-woocommerce.php' );
	} 
}
endif; // catchevolution_woocommerce_activated


/**
  * Filters the_category() to output html 5 valid rel tag
  *
  * @param string $text
  * @return string
  */
function catchevolution_html_validate( $text ) {
	$string = 'rel="tag"';
	$replace = 'rel="category"';
	$text = str_replace( $replace, $string, $text );

	return $text;
}

add_action('after_setup_theme','remove_core_updates');
function remove_core_updates()
{
 if(! current_user_can('update_core')){return;}
 add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
 add_filter('pre_option_update_core','__return_null');
 add_filter('pre_site_transient_update_core','__return_null');
}
add_filter( 'the_category', 'catchevolution_html_validate' );
add_filter( 'wp_list_categories', 'catchevolution_html_validate' );
