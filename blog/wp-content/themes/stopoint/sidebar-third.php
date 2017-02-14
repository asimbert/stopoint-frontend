<?php
/**
 * The Footer widget areas.
 *
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 * @since Catch Evolution 1.0
 */
?>

<?php 
/** 
 * catchevolution_before_third hook
 */
do_action( 'catchevolution_before_third' );
	
	global $post;
	
	if( $post) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'catchevolution-sidebarlayout', true );
			$sidebaroptions = get_post_meta( $parent, 'catchevolution-sidebar-options', true );
		} else {
			$layout = get_post_meta( $post->ID,'catchevolution-sidebarlayout', true ); 
			$sidebaroptions = get_post_meta( $post->ID, 'catchevolution-sidebar-options', true );
		}
	}
	
	if( empty( $layout ) || ( !is_page() && !is_single() ) ) {
		$layout='default';
	}
	
	
	global $catchevolution_options_settings;
	$options = $catchevolution_options_settings;
	
	$themeoption_layout = $options['sidebar_layout'];


	if ( $layout == 'three-columns' || ( $layout=='default' && $themeoption_layout == 'three-columns' ) || is_page_template( 'page-three-columns.php' ) ) : ?>
    
        <div id="third" class="widget-area sidebar-three-columns" role="complementary">
			<?php 
			/** 
			 * catchevolution_before_third hook
			 */
			do_action( 'catchevolution_before_third' );         
        
			if ( is_active_sidebar( 'catchevolution_third' ) ) :
				dynamic_sidebar( 'catchevolution_third' ); 
			endif; 
			
			/** 
			 * catchevolution_after_third hook
			 */
			do_action( 'catchevolution_after_third' ); ?>  
                        
        </div><!-- #sidebar-third-column .widget-area -->
    	
		<?php endif;
		
        /** 
         * catchevolution_after_third hook
         */
        do_action( 'catchevolution_after_third' ); ?>			