<?php

/**
 * Register jquery scripts
 *
 * @register jquery cycle and custom-script
 * hooks action wp_enqueue_scripts
 */
function catchevolution_scripts_method() {
	global $post, $wp_query, $catchevolution_options_settings;
   	$options = $catchevolution_options_settings;
	
	// Get value from Theme Options panel
	$enableslider = $options[ 'enable_slider' ];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts');
	
	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	
	// Enqueue catchevolution Sytlesheet
	wp_enqueue_style( 'catchevolution_style', get_stylesheet_uri() );
	
	// Register JQuery cycle all and JQuery set up as dependent on Jquery-cycle
	wp_register_script( 'jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5', true );
	
	// Slider JS load loop
	if ( ( $enableslider == 'enable-slider-allpage' ) || ( ( is_front_page() || ( is_home() && $page_id != $page_for_posts ) ) && $enableslider == 'enable-slider-homepage' ) ) {
		wp_enqueue_script( 'catchevolution-slider', get_template_directory_uri() . '/js/catchevolution.slider.js', array( 'jquery-cycle' ), '1.0', true );	
	}
	
	//Responsive 
	wp_enqueue_script('catchevolution-menu', get_template_directory_uri() . '/js/catchevolution-menu.min.js', array('jquery'), '1.1.0', true);
	wp_enqueue_style( 'catchevolution-responsive', get_template_directory_uri() . '/css/responsive.css' );
	wp_enqueue_script( 'catchevolution-fitvids', get_template_directory_uri() . '/js/catchevolution-fitvids.min.js', array( 'jquery' ), '20130324', true );	
	
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
	
	//Browser Specific Enqueue Script i.e. for IE 1-6
	$catchevolution_ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-6]/',$catchevolution_ua)) {
		wp_enqueue_script( 'catchevolution-pngfix', get_template_directory_uri() . '/js/pngfix.min.js' );	  
	}
	//browser specific queuing i.e. for IE 1-8
	if(preg_match('/(?i)msie [1-8]/',$catchevolution_ua)) {
	 	wp_enqueue_script( 'catchevolution-ieltc8', get_template_directory_uri() . '/js/catchevolution-ielte8.min.js', array( 'jquery' ), '20130114', false );	
		wp_enqueue_style( 'catchevolution-iecss', get_template_directory_uri() . '/css/ie.css' );
	}
	
} // catchevolution_scripts_method
add_action( 'wp_enqueue_scripts', 'catchevolution_scripts_method' );


/**
 * Register script for admin section
 *
 * No scripts should be enqueued within this function.
 * jquery cookie used for remembering admin tabs, and potential future features... so let's register it early
 * @uses wp_register_script
 * @action admin_enqueue_scripts
 */
function catchevolution_register_js() {
	//jQuery Cookie
	wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.min.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'catchevolution_register_js' );


if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	* Filters wp_title to print a neat <title> tag based on what is being viewed.
	*
	* @param string $title Default title text for current view.
	* @param string $sep Optional separator.
	* @return string The filtered title.
	*/
	function catchevolution_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}
		
		global $page, $paged;
		
		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );
		
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		
		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
		}
		
		return $title;
		
	}
		
	add_filter( 'wp_title', 'catchevolution_wp_title', 10, 2 );
	
	/**
	* Title shim for sites older than WordPress 4.1.
	*
	* @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	* @todo Remove this function when WordPress 4.3 is released.
	*/
	function catchevolution_render_title() {
	?>
		<title><?php wp_title( '&#124;', true, 'right' ); ?></title>
	<?php
	}
	add_action( 'wp_head', 'catchevolution_render_title' );
endif;


/**
 * Responsive Layout
 *
 * @get the data value of responsive layout from theme options
 * @display responsive meta tag 
 * @action wp_head
 */
function catchevolution_responsive() {
	
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';

} // catchevolution_responsive
add_filter( 'wp_head', 'catchevolution_responsive', 1 );


/**
 * Get the favicon Image from theme options
 *
 * @uses favicon 
 * @get the data value of image from theme options
 * @display favicon
 *
 * @uses default favicon if favicon field on theme options is empty
 *
 * @uses set_transient and delete_transient 
 */
function catchevolution_favicon() {
	//delete_transient( 'catchevolution_favicon' );	
	
	if( ( !$catchevolution_favicon = get_transient( 'catchevolution_favicon' ) ) ) {
		
		global $catchevolution_options_settings;
        $options = $catchevolution_options_settings;	
		
		echo '<!-- refreshing cache -->';
		if ( empty( $options[ 'remove_favicon' ] ) ) :
			// if not empty fav_icon on theme options
			if ( !empty( $options[ 'fav_icon' ] ) ) :
				$catchevolution_favicon = '<link rel="shortcut icon" href="'.esc_url( $options[ 'fav_icon' ] ).'" type="image/x-icon" />'; 	
			else:
				// if empty fav_icon on theme options, display default fav icon
				$catchevolution_favicon = '<link rel="shortcut icon" href="'. get_template_directory_uri() .'/images/favicon.ico" type="image/x-icon" />';
			endif;
		endif;		
		
		set_transient( 'catchevolution_favicon', $catchevolution_favicon, 86940 );	
	}	
	echo $catchevolution_favicon ;	
} // catchevolution_favicon

//Load Favicon in Header Section
add_action('wp_head', 'catchevolution_favicon');

//Load Favicon in Admin Section
add_action( 'admin_head', 'catchevolution_favicon' );


/**
 * Enqueue the styles for the current color scheme.
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_enqueue_color_scheme() {
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;	
	$color_scheme = $options['color_scheme'];

	if ( 'dark' == $color_scheme )
		wp_enqueue_style( 'dark', get_template_directory_uri() . '/colors/dark.css', array(), null );	

	do_action( 'catchevolution_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'catchevolution_enqueue_color_scheme' );


/**
 * Hooks the Custom Inline CSS to head section
 *
 * @since Catch Evolution Pro 1.0
 */
function catchevolution_inline_css() {
	//delete_transient( 'catchevolution_inline_css' );	
	
	global $catchevolution_options_settings, $catchevolution_options_defaults;
	$options = $catchevolution_options_settings;	
	$defaults = $catchevolution_options_defaults;
		
	if ( ( !$catchevolution_inline_css = get_transient( 'catchevolution_inline_css' ) ) && ( !empty( $options[ 'disable_header' ] ) || !empty( $options[ 'custom_css' ] ) ) ) {		
		echo '<!-- refreshing cache -->' . "\n";
			
		$catchevolution_inline_css = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n";
		$catchevolution_inline_css	.= '<style type="text/css" media="screen">' . "\n";		
		
		//Disable Header
		if( !empty( $options[ 'disable_header' ] ) ) {
			$catchevolution_inline_css	.=  "#branding { display: none; }" . "\n";
		}	
			
		//Custom CSS Option
		if( !empty( $options[ 'custom_css' ] ) ) {
			$catchevolution_inline_css	.=  $options['custom_css'] . "\n";
		}				
		
		$catchevolution_inline_css	.= '</style>' . "\n";
			
		set_transient( 'catchevolution_inline_css', $catchevolution_inline_css, 86940 );
	}
	echo $catchevolution_inline_css;
}
add_action('wp_head', 'catchevolution_inline_css');


/**
 * Sets the post excerpt length.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function catchevolution_excerpt_length( $length ) {
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;
	
	if( empty( $options['excerpt_length'] ) )
		$options = catchevolution_get_default_theme_options();
		
	$length = $options['excerpt_length'];
	return $length;
}
add_filter( 'excerpt_length', 'catchevolution_excerpt_length' );


/**
 * Returns a "Continue Reading" link for excerpts
 */
function catchevolution_continue_reading_link() {
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;
	$more_tag_text = $options[ 'more_tag_text' ];

	return ' <a class="more-link" href="'. esc_url( get_permalink() ) . '">' . sprintf( __( '%s', 'catchevolution' ), esc_attr( $more_tag_text ) ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and catchevolution_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function catchevolution_auto_excerpt_more( $more ) {
	return catchevolution_continue_reading_link();
}
add_filter( 'excerpt_more', 'catchevolution_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function catchevolution_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= catchevolution_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'catchevolution_custom_excerpt_more' );


if ( ! function_exists( 'catchevolution_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function catchevolution_content_nav( $nav_id ) {
	global $wp_query;
	
	/**
	 * Check Jetpack Infinite Scroll
	 * if it's active then disable pagination
	 */
	if ( class_exists( 'Jetpack', false ) ) {
		$jetpack_active_modules = get_option('jetpack_active_modules');
		if ( $jetpack_active_modules && in_array( 'infinite-scroll', $jetpack_active_modules ) ) {
			return false;
		}
	}
	
	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';
	
	if ( $wp_query->max_num_pages > 1 ) { ?>
        <nav role="navigation" id="<?php echo $nav_id; ?>">
        	<h3 class="assistive-text"><?php _e( 'Post navigation', 'catchevolution' ); ?></h3>
			<?php if ( function_exists('wp_pagenavi' ) )  { 
                wp_pagenavi();
            }
            elseif ( function_exists('wp_page_numbers' ) ) { 
                wp_page_numbers();
            }
            else { ?>	
                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'catchevolution' ) ); ?></div>
                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'catchevolution' ) ); ?></div>
            <?php 
            } ?>
        </nav><!-- #nav -->	
	<?php 
	}
}
endif; // catchevolution_content_nav


/**
 * Return the URL for the first link found in the post content.
 *
 * @since Catch Evolution 1.0
 * @return string|bool URL or false when no link is present.
 */
function catchevolution_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'catchevolution_footer_sidebar_class' ) ) :
/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function catchevolution_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}
endif; // catchevolution_footer_sidebar_class


if ( ! function_exists( 'catchevolution_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own catchevolution_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'catchevolution' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'catchevolution' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'catchevolution' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'catchevolution' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'catchevolution' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'catchevolution' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'catchevolution' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for catchevolution_comment()


if ( ! function_exists( 'catchevolution_posted_on' ) ) : 
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own catchevolution_posted_on to override in a child theme
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_posted_on() {
	/* Check Author URL to Support Google Authorship
	* 
	* By deault the author will link to author archieve page
	* But if the author have added their Website in Profile page then it will link to author website
	*/	
	if ( get_the_author_meta( 'user_url' ) != '' ) {
		$catchevolution_author_url = 	esc_url( get_the_author_meta( 'user_url' ) );						  
	}
	else {
		$catchevolution_author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );
	}
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date updated" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'catchevolution' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		$catchevolution_author_url,
		esc_attr( sprintf( __( 'View all posts by %s', 'catchevolution' ), get_the_author() ) ),
		get_the_author()
	);	
}
endif;


/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Catch Evolution 1.0
 */
function catchevolution_body_classes( $classes ) {
	global $post, $catchevolution_options_settings;
    $options = $catchevolution_options_settings;	
	$themeoption_layout = $options['sidebar_layout'];
	
	if ( !is_active_sidebar( 'catchevolution_woocommerce_sidebar' ) && ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) {
		$classes[] = 'woocommerce-nosidebar';
	}
	
	if ( has_nav_menu( 'top', 'catchevolution' ) && !empty ( $header_logo ) ) { 
		$classes[] = 'has-header-top menu-logo';
	}
	elseif ( has_nav_menu( 'top', 'catchevolution' ) && empty ( $header_logo ) ) {
		$classes[] = 'has-header-top';
	}
	
	if ( !empty( $options['disable_header'] ) ) { 
		$classes[] = 'disable-header';
	}
	
	if ( $post)  {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'catchevolution-sidebarlayout', true );
		} else {
			$layout = get_post_meta( $post->ID,'catchevolution-sidebarlayout', true ); 
		}
	}

	if ( empty( $layout ) || ( !is_page() && !is_single() && 'product' != get_post_type() ) ) {
		$layout='default';
	}	
	if ( $layout == 'three-columns' || ( $layout=='default' && $themeoption_layout == 'three-columns' ) || is_page_template( 'page-three-columns.php' ) ) {
		$classes[] = 'three-columns';
	}
	elseif ( $layout == 'no-sidebar' || ( $layout=='default' && $themeoption_layout == 'no-sidebar' ) || is_page_template( 'page-disable-sidebar.php' ) ) {
		$classes[] = 'no-sidebar';
	}
	elseif ( $layout == 'no-sidebar-one-column' || ( $layout=='default' && $themeoption_layout == 'no-sidebar-one-column' ) || is_page_template( 'page-onecolumn.php' ) ) {
		$classes[] = 'no-sidebar one-column';
	}
	elseif ( $layout == 'no-sidebar-full-width' || ( $layout=='default' && $themeoption_layout == 'no-sidebar-full-width' )  || is_page_template( 'page-fullwidth.php' ) ) {
		$classes[] = 'no-sidebar full-width';
	}
	elseif ( $layout == 'left-sidebar' || ( $layout=='default' && $themeoption_layout == 'left-sidebar' ) ) {
		$classes[] = 'left-sidebar';
	}
	elseif ( $layout == 'right-sidebar' || ( $layout=='default' && $themeoption_layout == 'right-sidebar' ) ) {
		$classes[] = 'right-sidebar';
	}	
	
	return $classes;
}
add_filter( 'body_class', 'catchevolution_body_classes' );


/**
 * Adds in post and Page ID when viewing lists of posts and pages
 * This will help the admin to add the post ID in featured slider
 * 
 * @param mixed $post_columns
 * @return post columns
 */
function catchevolution_post_id_column( $post_columns ) {
	$beginning = array_slice( $post_columns, 0 ,1 );
	$beginning[ 'postid' ] = __( 'ID', 'catchevolution'  );
	$ending = array_slice( $post_columns, 1 );
	$post_columns = array_merge( $beginning, $ending );
	return $post_columns;
}
add_filter( 'manage_posts_columns', 'catchevolution_post_id_column' );


function catchevolution_posts_id_column( $col, $val ) {
	if( $col == 'postid' ) echo $val;
}
add_action( 'manage_posts_custom_column', 'catchevolution_posts_id_column', 10, 2 );


function catchevolution_posts_id_column_css() {
	echo '<style type="text/css">#postid { width: 40px; }</style>';
}
add_action( 'admin_head-edit.php', 'catchevolution_posts_id_column_css' );


/**
 * Function to pass the variables for php to js file.
 * This funcition passes the slider effect variables.
 */

function catchevolution_pass_slider_value() {
	
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;	
	
	$transition_effect = $options[ 'transition_effect' ];
	
	$transition_delay = $options[ 'transition_delay' ] * 1000;
	
	$transition_duration = $options[ 'transition_duration' ] * 1000;
	
	wp_localize_script( 
		'catchevolution-slider',
		'js_value',
		array(
			'transition_effect' => $transition_effect,
			'transition_delay' => $transition_delay,
			'transition_duration' => $transition_duration
		)
		
	);
	
}//catchevolution_pass_slider_value


if ( ! function_exists( 'catchevolution_sliders' ) ) :
/**
 * This function to display featured posts slider
 *
 * @get the data value from theme options
 * @displays on the index
 *
 * @useage Featured Image, Title and Excerpt of Post
 *
 * @uses set_transient and delete_transient
 */
function catchevolution_sliders() {	

	global $post, $catchevolution_options_settings;
    $options = $catchevolution_options_settings;	
	$postperpage = $options[ 'slider_qty' ];
	$layout = $options[ 'sidebar_layout' ];	
	
	//delete_transient( 'catchevolution_sliders' );
	
	// This function passes the value of slider effect to js file 
    if( function_exists( 'catchevolution_pass_slider_value' ) ) {
      	catchevolution_pass_slider_value();
  	}
		
	if( ( !$catchevolution_sliders = get_transient( 'catchevolution_sliders' ) ) && !empty( $options[ 'featured_slider' ] ) ) {
		echo '<!-- refreshing cache -->';
		
		$catchevolution_sliders = '
		<div id="slider" class="post-slider">
			<section id="slider-wrap">';
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => $postperpage,
				'post__in'		 => $options[ 'featured_slider' ],
				'orderby' 		 => 'post__in',
				'ignore_sticky_posts' => 1 // ignore sticky posts
			));
				
			$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
				$title_attribute = esc_attr( apply_filters( 'the_title', get_the_title( $post->ID ) ) );
				
				if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
				
				$catchevolution_sliders .= '
				<div class="'.$classes.'">
					<a href="'.get_permalink().'" title="'.sprintf( esc_attr__( 'Permalink to %s', 'catchevolution' ), the_title_attribute( 'echo=0' ) ).'" rel="bookmark">
						'.get_the_post_thumbnail( $post->ID, 'featured-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class'	=> 'pngfix' ) ).'
					</a>
					<div class="featured-text">
						<div class="featured-text-wrap">'
							.the_title( '<span class="slider-title">','</span>', false ).' <span class="sep">:</span>
							<span class="slider-excerpt">'.get_the_excerpt().'</span>
						</div>
					</div><!-- .featured-text -->
				</div> <!-- .slides -->';
			endwhile; wp_reset_query();
		$catchevolution_sliders .= '
			</section> <!-- .slider-wrap -->
			<div id="controllers">
			</div><!-- #controllers -->
		</div> <!-- #featured-slider -->';
		set_transient( 'catchevolution_sliders', $catchevolution_sliders, 86940 );
	}
	echo $catchevolution_sliders;	
} 
endif; //catchevolution_sliders	


if ( ! function_exists( 'catchevolution_default_sliders' ) ) :
/**
 * Shows Default Slider Demo if there is not iteam in Featured Post Slider
 */
function catchevolution_default_sliders() { 
	//delete_transient( 'catchevolution_default_sliders' );
	
	// This function passes the value of slider effect to js file 
    if( function_exists( 'catchevolution_pass_slider_value' ) ) {
      	catchevolution_pass_slider_value();
  	}	
	
	if ( !$catchevolution_default_sliders = get_transient( 'catchevolution_default_sliders' ) ) {
		echo '<!-- refreshing cache -->';	
		$catchevolution_default_sliders = '
		<div id="slider">
			<section id="slider-wrap">
				<div class="slides displayblock">
					<div class="featured-img">
						<span><img src="'. get_template_directory_uri() . '/images/slider/slider-1.jpg" class="pngfix wp-post-image" alt="Featured Image-1" title="Featured Image-1"></span>
					</div>
				</div> <!-- .slides -->
				<div class="slides displaynone">
					<div class="featured-img">
						<span><img src="'. get_template_directory_uri() . '/images/slider/slider-2.jpg" class="pngfix wp-post-image" alt="Featured Image-2" title="Featured Image-2"></span>
					</div>
				</div> <!-- .slides -->
			</section> <!-- .slider-wrap -->
			<div id="controllers">
			</div><!-- #controllers -->
		</div><!-- #slider -->';
			
	set_transient( 'catchevolution_default_sliders', $catchevolution_default_sliders, 86940 );
	}
	echo $catchevolution_default_sliders;	
}
endif; //catchevolution_default_sliders	


if ( ! function_exists( 'catchevolution_slider_display' ) ) :
/**
 * Display slider
 */
function catchevolution_slider_display() {
	global $post, $wp_query, $catchevolution_options_settings;
   	$options = $catchevolution_options_settings;	
	$enableslider = $options[ 'enable_slider' ];
	$featuredslider = $options[ 'featured_slider' ];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 	
		
	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();	
	
	if ( ( $enableslider == 'enable-slider-allpage' ) || ( ( is_front_page() || ( is_home() && $page_id != $page_for_posts ) ) && $enableslider == 'enable-slider-homepage' ) ) :
		
		// Select Slider
		if ( !empty( $featuredslider ) ) {
			catchevolution_sliders();
		}
		else {
			catchevolution_default_sliders();
		}
		
	endif;
	
}
endif; //catchevolution_slider_display

add_action( 'catchevolution_content', 'catchevolution_slider_display', 10 );


/**
 * Alter the query for the main loop in home page
 * @uses pre_get_posts hook
 */
function catchevolution_alter_home( $query ){
	global $post, $catchevolution_options_settings;
    $options = $catchevolution_options_settings;
	$cats = $options[ 'front_page_category' ];

    if ( $options[ 'exclude_slider_post'] != "0" && !empty( $options[ 'featured_slider' ] ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $options[ 'featured_slider' ];
		}
	}
	
	if ( !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] = $options[ 'front_page_category' ];
		}
	}	
	
}
add_action( 'pre_get_posts','catchevolution_alter_home' );


/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function catchevolution_wp_page_menu( $page_markup ) {
    preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
        $divclass = $matches[1];
        $replace = array('<div class="'.$divclass.'">', '</div>');
        $new_markup = str_replace($replace, '', $page_markup);
        $new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
        return $new_markup; }

add_filter( 'wp_page_menu', 'catchevolution_wp_page_menu' );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function catchevolution_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'catchevolution_page_menu_args' );


/**
 * Replacing classed in default wp_page_menu
 *
 * REPLACE "current_page_item" WITH CLASS "current-menu-item"
 * REPLACE "current_page_ancestor" WITH CLASS "current-menu-ancestor"
 */
function current_to_active($text){
	$replace = array(
		// List of classes to replace with "active"
		'current_page_item' => 'current-menu-item',
		'current_page_ancestor' => 'current-menu-ancestor',
	);
	$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
add_filter( 'wp_page_menu', 'current_to_active' );


if ( ! function_exists( 'catchevolution_comment_form_fields' ) ) :
/**
 * Altering Comment Form Fields
 * @uses comment_form_default_fields filter
 */
function catchevolution_comment_form_fields( $fields ) {
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$commenter = wp_get_current_commenter();
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_attr__( 'Name', 'catchevolution' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_attr__( 'Email', 'catchbox' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>'; 
    return $fields;
	
}
endif; //catchevolution_comment_form_fields

add_filter( 'comment_form_default_fields', 'catchevolution_comment_form_fields' );


/**
 * Redirect WordPress Feeds To FeedBurner
 */
function catchevolution_rss_redirect() {	
	global $catchevolution_options_settings;
    $options = $catchevolution_options_settings;

	
    if ($options['feed_url']) {
		$url = 'Location: '.$options['feed_url'];
		if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT']))
		{
			header($url);
			header('HTTP/1.1 302 Temporary Redirect');
		}
	}
}
add_action('template_redirect', 'catchevolution_rss_redirect');


/**
 * shows footer content
 */
function catchevolution_footer_content() { 
	//delete_transient( 'catchevolution_footer_content_new' );	
	
	if ( ( !$catchevolution_footer_content = get_transient( 'catchevolution_footer_content_new' ) ) ) {
		echo '<!-- refreshing cache -->';

		$catchevolution_footer_content = catchevolution_assets();
		
    	set_transient( 'catchevolution_footer_content_new', $catchevolution_footer_content, 86940 );
    }
	echo $catchevolution_footer_content;
}
add_action( 'catchevolution_site_generator', 'catchevolution_footer_content', 15 );


if ( ! function_exists( 'catchevolution_social_networks' ) ) :
/**
 * This function for social links display
 *
 * @fetch links through Theme Options
 * @use in widget
 * @social links, Facebook, Twitter and RSS
  */
function catchevolution_social_networks() {
	//delete_transient( 'catchevolution_social_networks' );
	
	// get the data value from theme options
	global $catchevolution_options_settings;
	$options = $catchevolution_options_settings;	

    $elements = array();

	$elements = array( 	$options[ 'social_facebook' ], 
						$options[ 'social_twitter' ],
						$options[ 'social_googleplus' ],
						$options[ 'social_linkedin' ],
						$options[ 'social_pinterest' ],
						$options[ 'social_youtube' ],
						$options[ 'social_vimeo' ],
						$options[ 'social_aim' ],
						$options[ 'social_myspace' ],
						$options[ 'social_flickr' ],
						$options[ 'social_tumblr' ],
						$options[ 'social_deviantart' ],
						$options[ 'social_dribbble' ],
						$options[ 'social_myspace' ],
						$options[ 'social_wordpress' ],
						$options[ 'social_rss' ],
						$options[ 'social_slideshare' ],
						$options[ 'social_instagram' ],
						$options[ 'social_skype' ],
						$options[ 'social_soundcloud' ],
						$options[ 'social_email' ],
						$options[ 'social_contact' ],
						$options[ 'social_xing' ],
						$options[ 'social_meetup' ]
					);
	$flag = 0;
	if( !empty( $elements ) ) {
		foreach( $elements as $option) {
			if( !empty( $option ) ) {
				$flag = 1;
			}
			else {
				$flag = 0;
			}
			if( $flag == 1 ) {
				break;
			}
		}
	}	
	
	if ( ( !$catchevolution_social_networks = get_transient( 'catchevolution_social_networks' ) ) && ( $flag == 1 ) )  {
		echo '<!-- refreshing cache -->';
		
		$catchevolution_social_networks .='
		<div class="social-profile"><ul>';

			//facebook
			if ( !empty( $options[ 'social_facebook' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="facebook"><a href="'.esc_url( $options[ 'social_facebook' ] ).'" title="'. esc_attr__( 'Facebook', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Facebook', 'catchevolution' ).'</a></li>';
			}
			//Twitter
			if ( !empty( $options[ 'social_twitter' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="twitter"><a href="'.esc_url( $options[ 'social_twitter' ] ).'" title="'. esc_attr__( 'Twitter', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Twitter', 'catchevolution' ).'</a></li>';
			}
			//Google+
			if ( !empty( $options[ 'social_googleplus' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="google-plus"><a href="'.esc_url( $options[ 'social_googleplus' ] ).'" title="'. esc_attr__( 'Google+', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Google+', 'catchevolution' ).'</a></li>';
			}
			//Linkedin
			if ( !empty( $options[ 'social_linkedin' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="linkedin"><a href="'.esc_url( $options[ 'social_linkedin' ] ).'" title="'. esc_attr__( 'Linkedin', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Linkedin', 'catchevolution' ).'</a></li>';
			}
			//Pinterest
			if ( !empty( $options[ 'social_pinterest' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="pinterest"><a href="'.esc_url( $options[ 'social_pinterest' ] ).'" title="'. esc_attr__( 'Pinterest', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Pinterest', 'catchevolution' ).'</a></li>';
			}				
			//Youtube
			if ( !empty( $options[ 'social_youtube' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="you-tube"><a href="'.esc_url( $options[ 'social_youtube' ] ).'" title="'. esc_attr__( 'YouTube', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'YouTube', 'catchevolution' ).'</a></li>';
			}
			//Vimeo
			if ( !empty( $options[ 'social_vimeo' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="viemo"><a href="'.esc_url( $options[ 'social_vimeo' ] ).'" title="'. esc_attr__( 'Vimeo', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Vimeo', 'catchevolution' ).'</a></li>';
			}				
			//Slideshare
			if ( !empty( $options[ 'social_aim' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="aim"><a href="'.esc_url( $options[ 'social_aim' ] ).'" title="'. esc_attr__( 'AIM', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'AIM', 'catchevolution' ).'</a></li>';
			}				
			//MySpace
			if ( !empty( $options[ 'social_myspace' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="myspace"><a href="'.esc_url( $options[ 'social_myspace' ] ).'" title="'. esc_attr__( 'MySpace', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'MySpace', 'catchevolution' ).'</a></li>';
			}
			//Flickr
			if ( !empty( $options[ 'social_flickr' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="flickr"><a href="'.esc_url( $options[ 'social_flickr' ] ).'" title="'. esc_attr__( 'Flickr', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Flickr', 'catchevolution' ).'</a></li>';
			}
			//Tumblr
			if ( !empty( $options[ 'social_tumblr' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="tumblr"><a href="'.esc_url( $options[ 'social_tumblr' ] ).'" title="'. esc_attr__( 'Tumblr', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Tumblr', 'catchevolution' ).'</a></li>';
			}
			//deviantART
			if ( !empty( $options[ 'social_deviantart' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="deviantart"><a href="'.esc_url( $options[ 'social_deviantart' ] ).'" title="'. esc_attr__( 'deviantART', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'deviantART', 'catchevolution' ).'</a></li>';
			}
			//Dribbble
			if ( !empty( $options[ 'social_dribbble' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="dribbble"><a href="'.esc_url( $options[ 'social_dribbble' ] ).'" title="'. esc_attr__( 'Dribbble', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Dribbble', 'catchevolution' ).'</a></li>';
			}
			//WordPress
			if ( !empty( $options[ 'social_wordpress' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="wordpress"><a href="'.esc_url( $options[ 'social_wordpress' ] ).'" title="'. esc_attr__( 'WordPress', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'WordPress', 'catchevolution' ).'</a></li>';
			}				
			//RSS
			if ( !empty( $options[ 'social_rss' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="rss"><a href="'.esc_url( $options[ 'social_rss' ] ).'" title="'. esc_attr__( 'RSS', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'RSS', 'catchevolution' ).'</a></li>';
			}	
			//Slideshare
			if ( !empty( $options[ 'social_slideshare' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="slideshare"><a href="'.esc_url( $options[ 'social_slideshare' ] ).'" title="'. esc_attr__( 'Slideshare', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Slideshare', 'catchevolution' ).'</a></li>';
			}
			//Instagram
			if ( !empty( $options[ 'social_instagram' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="instagram"><a href="'.esc_url( $options[ 'social_instagram' ] ).'" title="'. esc_attr__( 'Instagram', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Instagram', 'catchevolution' ).'</a></li>';
			}				
			//Skype
			if ( !empty( $options[ 'social_skype' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="skype"><a href="'.esc_attr( $options[ 'social_skype' ] ).'" title="'. esc_attr__( 'Skype', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Skype', 'catchevolution' ).'</a></li>';
			}
			//Soundcloud
			if ( !empty( $options[ 'social_soundcloud' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="soundcloud"><a href="'.esc_url( $options[ 'social_soundcloud' ] ).'" title="'. esc_attr__( 'Soundcloud', 'catchevolution' ) .'" target="_blank">'. esc_attr__( 'Soundcloud', 'catchevolution' ) .'</a></li>';
			}	
			//Email
			if ( !empty( $options[ 'social_email' ] )  && is_email( $options[ 'social_email' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="email"><a href="mailto:'.sanitize_email( $options[ 'social_email' ] ).'" title="'. esc_attr__( 'Email', 'catchevolution' ) .'" target="_blank">'. esc_attr__( 'Email', 'catchevolution' ) .'</a></li>';
			}	
			//Contact
			if ( !empty( $options[ 'social_contact' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="contactus"><a href="'.esc_url( $options[ 'social_contact' ] ).'" title="'. esc_attr__( 'Contact', 'catchevolution' ) .'">'. esc_attr__( 'Contact', 'catchevolution' ) .'</a></li>';
			}	
			//Xing
			if ( !empty( $options[ 'social_xing' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="xing"><a href="'.esc_url( $options[ 'social_xing' ] ).'" title="'. esc_attr__( 'Xing', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Xing', 'catchevolution' ).'</a></li>';
			}
			//Meetup
			if ( !empty( $options[ 'social_meetup' ] ) ) {
				$catchevolution_social_networks .=
					'<li class="meetup"><a href="'.esc_url( $options[ 'social_meetup' ] ).'" title="'. esc_attr__( 'Meetup', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Meetup', 'catchevolution' ).'</a></li>';
			}

			$catchevolution_social_networks .='
		</ul></div>';
		
		set_transient( 'catchevolution_social_networks', $catchevolution_social_networks, 86940 );	 
	}
	echo $catchevolution_social_networks;
}
endif; //catchevolution_social_networks


/**
 * Footer Social Icons
 *
 */
function catchevolution_footer_social() {		
	global $catchevolution_options_settings;
	$options = $catchevolution_options_settings;	
	
	if ( !empty( $options[ 'disable_footer_social' ] ) ) :
		return catchevolution_social_networks();
	endif;	
}
add_action( 'catchevolution_site_generator', 'catchevolution_footer_social', 10 );


if ( ! function_exists( 'catchevolution_social_search' ) ) :
/**
 * This function for social links display
 *
 * @fetch links through Theme Options
 * @use in widget
 * @social links, Facebook, Twitter and RSS
  */
function catchevolution_social_search() {
	//delete_transient( 'catchevolution_social_search' );
	
	// get the data value from theme options
	global $catchevolution_options_settings;
	$options = $catchevolution_options_settings;	

    $elements = array();

	$elements = array( 	$options[ 'social_facebook' ], 
						$options[ 'social_twitter' ],
						$options[ 'social_googleplus' ],
						$options[ 'social_linkedin' ],
						$options[ 'social_pinterest' ],
						$options[ 'social_youtube' ],
						$options[ 'social_vimeo' ],
						$options[ 'social_aim' ],
						$options[ 'social_myspace' ],
						$options[ 'social_flickr' ],
						$options[ 'social_tumblr' ],
						$options[ 'social_deviantart' ],
						$options[ 'social_dribbble' ],
						$options[ 'social_myspace' ],
						$options[ 'social_wordpress' ],
						$options[ 'social_rss' ],
						$options[ 'social_slideshare' ],
						$options[ 'social_instagram' ],
						$options[ 'social_skype' ],
						$options[ 'social_soundcloud' ],
						$options[ 'social_email' ],
						$options[ 'social_contact' ],
						$options[ 'social_xing' ],
						$options[ 'social_meetup' ]
					);
	$flag = 0;
	if( !empty( $elements ) ) {
		foreach( $elements as $option) {
			if( !empty( $option ) ) {
				$flag = 1;
			}
			else {
				$flag = 0;
			}
			if( $flag == 1 ) {
				break;
			}
		}
	}	
	
	if ( ( !$catchevolution_social_search = get_transient( 'catchevolution_social_search' ) ) && ( $flag == 1 ) )  {
		echo '<!-- refreshing cache -->';
		
		$catchevolution_social_search .='
		<div class="social-profile"><ul>';
	
			//facebook
			if ( !empty( $options[ 'social_facebook' ] ) ) {
				$catchevolution_social_search .=
					'<li class="facebook"><a href="'.esc_url( $options[ 'social_facebook' ] ).'" title="'. esc_attr__( 'Facebook', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Facebook', 'catchevolution' ).'</a></li>';
			}
			//Twitter
			if ( !empty( $options[ 'social_twitter' ] ) ) {
				$catchevolution_social_search .=
					'<li class="twitter"><a href="'.esc_url( $options[ 'social_twitter' ] ).'" title="'. esc_attr__( 'Twitter', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Twitter', 'catchevolution' ).'</a></li>';
			}
			//Google+
			if ( !empty( $options[ 'social_googleplus' ] ) ) {
				$catchevolution_social_search .=
					'<li class="google-plus"><a href="'.esc_url( $options[ 'social_googleplus' ] ).'" title="'. esc_attr__( 'Google+', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Google+', 'catchevolution' ).'</a></li>';
			}
			//Linkedin
			if ( !empty( $options[ 'social_linkedin' ] ) ) {
				$catchevolution_social_search .=
					'<li class="linkedin"><a href="'.esc_url( $options[ 'social_linkedin' ] ).'" title="'. esc_attr__( 'Linkedin', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Linkedin', 'catchevolution' ).'</a></li>';
			}
			//Pinterest
			if ( !empty( $options[ 'social_pinterest' ] ) ) {
				$catchevolution_social_search .=
					'<li class="pinterest"><a href="'.esc_url( $options[ 'social_pinterest' ] ).'" title="'. esc_attr__( 'Pinterest', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Pinterest', 'catchevolution' ).'</a></li>';
			}				
			//Youtube
			if ( !empty( $options[ 'social_youtube' ] ) ) {
				$catchevolution_social_search .=
					'<li class="you-tube"><a href="'.esc_url( $options[ 'social_youtube' ] ).'" title="'. esc_attr__( 'YouTube', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'YouTube', 'catchevolution' ).'</a></li>';
			}
			//Vimeo
			if ( !empty( $options[ 'social_vimeo' ] ) ) {
				$catchevolution_social_search .=
					'<li class="viemo"><a href="'.esc_url( $options[ 'social_vimeo' ] ).'" title="'. esc_attr__( 'Vimeo', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Vimeo', 'catchevolution' ).'</a></li>';
			}				
			//Slideshare
			if ( !empty( $options[ 'social_aim' ] ) ) {
				$catchevolution_social_search .=
					'<li class="aim"><a href="'.esc_url( $options[ 'social_aim' ] ).'" title="'. esc_attr__( 'AIM', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'AIM', 'catchevolution' ).'</a></li>';
			}				
			//MySpace
			if ( !empty( $options[ 'social_myspace' ] ) ) {
				$catchevolution_social_search .=
					'<li class="myspace"><a href="'.esc_url( $options[ 'social_myspace' ] ).'" title="'. esc_attr__( 'MySpace', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'MySpace', 'catchevolution' ).'</a></li>';
			}
			//Flickr
			if ( !empty( $options[ 'social_flickr' ] ) ) {
				$catchevolution_social_search .=
					'<li class="flickr"><a href="'.esc_url( $options[ 'social_flickr' ] ).'" title="'. esc_attr__( 'Flickr', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Flickr', 'catchevolution' ).'</a></li>';
			}
			//Tumblr
			if ( !empty( $options[ 'social_tumblr' ] ) ) {
				$catchevolution_social_search .=
					'<li class="tumblr"><a href="'.esc_url( $options[ 'social_tumblr' ] ).'" title="'. esc_attr__( 'Tumblr', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Tumblr', 'catchevolution' ).'</a></li>';
			}
			//deviantART
			if ( !empty( $options[ 'social_deviantart' ] ) ) {
				$catchevolution_social_search .=
					'<li class="deviantart"><a href="'.esc_url( $options[ 'social_deviantart' ] ).'" title="'. esc_attr__( 'deviantART', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'deviantART', 'catchevolution' ).'</a></li>';
			}
			//Dribbble
			if ( !empty( $options[ 'social_dribbble' ] ) ) {
				$catchevolution_social_search .=
					'<li class="dribbble"><a href="'.esc_url( $options[ 'social_dribbble' ] ).'" title="'. esc_attr__( 'Dribbble', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Dribbble', 'catchevolution' ).'</a></li>';
			}
			//WordPress
			if ( !empty( $options[ 'social_wordpress' ] ) ) {
				$catchevolution_social_search .=
					'<li class="wordpress"><a href="'.esc_url( $options[ 'social_wordpress' ] ).'" title="'. esc_attr__( 'WordPress', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'WordPress', 'catchevolution' ).'</a></li>';
			}				
			//RSS
			if ( !empty( $options[ 'social_rss' ] ) ) {
				$catchevolution_social_search .=
					'<li class="rss"><a href="'.esc_url( $options[ 'social_rss' ] ).'" title="'. esc_attr__( 'RSS', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'RSS', 'catchevolution' ).'</a></li>';
			}	
			//Slideshare
			if ( !empty( $options[ 'social_slideshare' ] ) ) {
				$catchevolution_social_search .=
					'<li class="slideshare"><a href="'.esc_url( $options[ 'social_slideshare' ] ).'" title="'. esc_attr__( 'Slideshare', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Slideshare', 'catchevolution' ).'</a></li>';
			}
			//Instagram
			if ( !empty( $options[ 'social_instagram' ] ) ) {
				$catchevolution_social_search .=
					'<li class="instagram"><a href="'.esc_url( $options[ 'social_instagram' ] ).'" title="'. esc_attr__( 'Instagram', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Instagram', 'catchevolution' ).'</a></li>';
			}				
			//Skype
			if ( !empty( $options[ 'social_skype' ] ) ) {
				$catchevolution_social_search .=
					'<li class="skype"><a href="'.esc_attr( $options[ 'social_skype' ] ).'" title="'. esc_attr__( 'Skype', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Skype', 'catchevolution' ).'</a></li>';
			}
			//Soundcloud
			if ( !empty( $options[ 'social_soundcloud' ] ) ) {
				$catchevolution_social_search .=
					'<li class="soundcloud"><a href="'.esc_url( $options[ 'social_soundcloud' ] ).'" title="'. esc_attr__( 'Soundcloud', 'catchevolution' ) .'" target="_blank">'. esc_attr__( 'Soundcloud', 'catchevolution' ) .'</a></li>';
			}	
			//Email
			if ( !empty( $options[ 'social_email' ] )  && is_email( $options[ 'social_email' ] ) ) {
				$catchevolution_social_search .=
					'<li class="email"><a href="mailto:'.sanitize_email( $options[ 'social_email' ] ).'" title="'. esc_attr__( 'Email', 'catchevolution' ) .'" target="_blank">'. esc_attr__( 'Email', 'catchevolution' ) .'</a></li>';
			}
			//Contact
			if ( !empty( $options[ 'social_contact' ] ) ) {
				$catchevolution_social_search .=
					'<li class="contactus"><a href="'.esc_url( $options[ 'social_contact' ] ).'" title="'. esc_attr__( 'Contact', 'catchevolution' ) .'">'. esc_attr__( 'Contact', 'catchevolution' ) .'</a></li>';
			}
			//Xing
			if ( !empty( $options[ 'social_xing' ] ) ) {
				$catchevolution_social_search .=
					'<li class="xing"><a href="'.esc_url( $options[ 'social_xing' ] ).'" title="'. esc_attr__( 'Xing', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Xing', 'catchevolution' ).'</a></li>';
			}	
			//Meetup
			if ( !empty( $options[ 'social_meetup' ] ) ) {
				$catchevolution_social_search .=
					'<li class="meetup"><a href="'.esc_url( $options[ 'social_meetup' ] ).'" title="'. esc_attr__( 'Meetup', 'catchevolution' ) .'" target="_blank">'.esc_attr__( 'Meetup', 'catchevolution' ).'</a></li>';
			}	
			//Search Icon
			$catchevolution_social_search .= '<li class="social-search">' . get_search_form( false ) . '</li>';
	
			$catchevolution_social_search .='
		</ul></div>';
		
		set_transient( 'catchevolution_social_search', $catchevolution_social_search, 86940 );	 
	}
	echo $catchevolution_social_search;
}
endif; //catchevolution_social_search


/**
 * Site Verification  and Webmaster Tools
 *
 * If user sets the code we're going to display meta verification
 * @get the data value from theme options
 * @uses wp_head action to add the code in the header
 * @uses set_transient and delete_transient API for cache
 */
function catchevolution_site_verification() {
	//delete_transient( 'catchevolution_site_verification' );

	if ( ( !$catchevolution_site_verification = get_transient( 'catchevolution_site_verification' ) ) )  {
		
		// get the data value from theme options
		global $catchevolution_options_settings;
		$options = $catchevolution_options_settings;
		echo '<!-- refreshing cache -->';	
		
		$catchevolution_site_verification = '';
		
		//site stats, analytics header code
		if ( !empty( $options['analytic_header'] ) ) {
			$catchevolution_site_verification .=  $options[ 'analytic_header' ] ;
		}
		
		set_transient( 'catchevolution_site_verification', $catchevolution_site_verification, 86940 );
	}
	echo $catchevolution_site_verification;
}
add_action('wp_head', 'catchevolution_site_verification');


/**
 * This function loads the Footer Code such as Add this code from the Theme Option
 *
 * @get the data value from theme options
 * @load on the footer ONLY
 * @uses wp_footer action to add the code in the footer
 * @uses set_transient and delete_transient
 */
function catchevolution_footercode() {
	//delete_transient( 'catchevolution_footercode' );	
	
	if ( ( !$catchevolution_footercode = get_transient( 'catchevolution_footercode' ) ) ) {

		// get the data value from theme options
		global $catchevolution_options_settings;
   	 	$options = $catchevolution_options_settings;
		echo '<!-- refreshing cache -->';	
		
		//site stats, analytics header code
		if ( !empty( $options['analytic_footer'] ) ) {
			$catchevolution_footercode =  $options[ 'analytic_footer' ] ;
		}
			
		set_transient( 'catchevolution_footercode', $catchevolution_footercode, 86940 );
	}
	echo $catchevolution_footercode;
}
add_action('wp_footer', 'catchevolution_footercode');


/**
 * Get the Web Clip Icon Image from theme options
 *
 * @uses web_clip and remove_web_clip 
 * @get the data value of image from theme options
 * @display favicon
 *
 * @uses default Web Click Icon if web_clip field on theme options is empty
 *
 * @uses set_transient and delete_transient 
 */
function catchevolution_web_clip() {
	//delete_transient( 'catchevolution_web_clip' );	
	
	if( ( !$catchevolution_web_clip = get_transient( 'catchevolution_web_clip' ) ) ) {
		
		global $catchevolution_options_settings;
        $options = $catchevolution_options_settings;	
		
		//echo '<!-- refreshing cache -->';
		if ( empty( $options[ 'remove_web_clip' ] ) ) :
			// if not empty fav_icon on theme options
			if ( !empty( $options[ 'web_clip' ] ) ) :
				$catchevolution_web_clip = '<link rel="apple-touch-icon-precomposed" href="'.esc_url( $options[ 'web_clip' ] ).'" />'; 	
			else:
				// if empty fav_icon on theme options, display default fav icon
				$catchevolution_web_clip = '<link rel="apple-touch-icon-precomposed" href="'. get_template_directory_uri() .'/images/apple-touch-icon.png" />';
			endif;
		endif;	
	
		
		set_transient( 'catchevolution_web_clip', $catchevolution_web_clip, 86940 );	
	}	
	echo $catchevolution_web_clip ;	
} // catchevolution_web_clip

//Load WebClip in Header Section
add_action('wp_head', 'catchevolution_web_clip');


if ( ! function_exists( 'catchevolution_footer_menu' ) ) :
/**
 * Footer Menu
 *
 * @Hooked in catchevolution_after_footer_sidebar
 * @since Catch Evolution 1.2.1
 */
function catchevolution_footer_menu() { 

	if ( has_nav_menu( 'footer', 'catchevolution' ) ) {
		?>
		<nav id="access-footer" class="mobile-disable" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Footer menu', 'catchevolution' ); ?></h3>
			<?php wp_nav_menu( array( 'theme_location'  => 'footer', 'container_class' => 'menu-footer-container wrapper', 'depth' => 1 ) );  ?>
		</nav>
	<?php } 
	
} // catchevolution_footer_menu
endif;

add_action( 'catchevolution_after_footer_sidebar', 'catchevolution_footer_menu', 10 ); 

/**
 * Third Sidebar
 *
 * @Hooked in catchevolution_before_primary
 * @since Catch Evolution 1.1
 */

function catchevolution_third_sidebar() {
	get_sidebar( 'third' ); 
}  
add_action( 'catchevolution_after_contentsidebarwrap', 'catchevolution_third_sidebar', 10 );