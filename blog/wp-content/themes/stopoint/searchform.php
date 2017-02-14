<?php
/**
 * The template for displaying search forms in Catch Evolution
 *
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 * @since Catch Evolution 1.0
 */
 
global $catchevolution_options_settings;
$options = $catchevolution_options_settings;

$catchevolution_search_display_text = $options[ 'search_display_text' ];

?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'catchevolution' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php echo esc_attr( $catchevolution_search_display_text ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'catchevolution' ); ?>" />
	</form>
