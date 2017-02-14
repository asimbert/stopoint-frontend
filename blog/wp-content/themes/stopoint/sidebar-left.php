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
 *The header right widget area is triggered if any of the areas
 */
if ( is_active_sidebar( 'catchevolution_left_sidebar' ) ) : 
?>
<aside id="sidebar-left" class="widget-area sidebar clearfix">
	<?php dynamic_sidebar( 'catchevolution_left_sidebar' ); ?>
</aside> <!-- #sidebar-top -->
<?php endif;