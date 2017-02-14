<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 * @since Catch Evolution 1.0
 */
?>

<?php 
/** 
 * catchevolution_before_secondary hook
 */
do_action( 'catchevolution_before_secondary' );

	global $post;
	
	if ( $post ) {
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
	
	if ( !is_active_sidebar( 'catchevolution_woocommerce_sidebar' ) && ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) {
		$layout = 'no-sidebar';
	}
	
	global $catchevolution_options_settings;
	$options = $catchevolution_options_settings;
	$themeoption_layout = $options['sidebar_layout'];
    
	if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' || $layout == 'three-columns' || ( $layout=='default' && $themeoption_layout == 'left-sidebar') || ( $layout=='default' && $themeoption_layout == 'right-sidebar') || ( $layout=='default' && $themeoption_layout == 'three-columns' ) ) : 
	?>
        
        <div id="secondary" class="widget-area" role="complementary">
			<?php 
			/** 
			 * catchevolution_before_widget hook
			 */
			do_action( 'catchevolution_before_widget' );
			
			if ( is_active_sidebar( 'catchevolution_woocommerce_sidebar' ) && ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) :
				dynamic_sidebar( 'catchevolution_woocommerce_sidebar' ); 
          	elseif ( is_active_sidebar( 'sidebar-1' ) ) : 
				dynamic_sidebar( 'sidebar-1' );
			else :
				echo '<!-- No Widget in Sidebar -->';
			endif; ?>
	
 			<?php 
			/** 
			 * catchevolution_after_widget hook
			 */
			do_action( 'catchevolution_after_widget' ); ?>  
               
        </div><!-- #secondary .widget-area -->
    <?php endif;
	
/** 
 * catchevolution_after_secondary hook
 */
do_action( 'catchevolution_after_secondary' ); ?>