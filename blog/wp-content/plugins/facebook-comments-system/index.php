<?php
/**
 * Plugin Name: Facebook Comments System
 * Plugin URI: http://arturssmirnovs.com/blog/facebook-comments-system-wordpress/
 * Description: Facebook Comments System allows you to easely add facebook comments to your wordpress website. Facebook comments allow users to comment on entry using their facebook account.
 * Version: 1.1
 * Author: Arturs Smirnovs
 * Author URI: http://arturssmirnovs.com/
 * License: GPLv2 or later
*/

/*
Copyright 2015  Arturs Smirnovs  (email : info@arturssmirnovs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Loads admin styles for admin panel
 */
function as_facebook_comments_plugin_admin_styles() {
    wp_register_style( 'facebook-comments-system-admin-style', plugins_url( '/admin-style.css', __FILE__ ), array(), '1.1', 'all');
    wp_enqueue_style( 'facebook-comments-system-admin-style' );
}

/**
 * Add admin panel option page
 */
function as_facebook_comments_menu() {
	add_submenu_page( 'options-general.php', 'Facebook Comments', 'Facebook Comments', 'manage_options', 'as-facebook-comments', 'as_facebook_comments_cb' );
}

/**
 * Admin panel option page layout
 */
function as_facebook_comments_cb() {
	echo '<div class="wrap back-to-top-advanced-admin-wrap">';
	echo '<div class="back-to-top-advanced-admin-col-left">';
	echo '<div class="back-to-top-advanced-admin-col-left-inner">';
	echo '<div class="back-to-top-advanced-admin-well back-to-top-advanced-admin-header"><h1>Facebook Comments Settings</h1></div>';
	echo '<h2 class="back-to-top-advanced-admin-display-none"></h2>';
	echo '<div class="back-to-top-advanced-admin-well">';
	echo '<form method="post" action="options.php">';
	settings_fields( 'as-facebook-comments-settings' );
	do_settings_sections( 'as-facebook-comments-settings' );
	echo '<table class="form-table">';
	echo '<tr>';
	echo '<th scope="row"><label>Show on Post, Pages</label></th>';
	echo '<td><select name="as_fb_comments_show" id="as_fb_comments_show">';
	echo '<option value="3"'; if ('3'==get_option('as_fb_comments_show')) echo 'selected';echo '>Show posts</option>';
	echo '<option value="2"'; if ('2'==get_option('as_fb_comments_show')) echo 'selected';echo '>Show pages</option>';
	echo '<option value="1"'; if ('1'==get_option('as_fb_comments_show')) echo 'selected';echo '>Show Both</option>';
	echo '<option value="0"'; if ('0'==get_option('as_fb_comments_show')) echo 'selected';echo '>Hide all</option>';
	echo '</select></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>HTML5</label></th>';
	echo '<td><select name="as_fb_comments_html5" id="as_fb_comments_html5">';
	echo '<option value="1"'; if ('1'==get_option('as_fb_comments_html5')) echo 'selected';echo '>On</option>';
	echo '<option value="0"'; if ('0'==get_option('as_fb_comments_html5')) echo 'selected';echo '>Off</option>';
	echo '</select></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>Color Scheme</label></th>';
	echo '<td><select name="as_fb_comments_colorscheme" id="as_fb_comments_colorscheme">';
	echo '<option value="light"'; if ('light'==get_option('as_fb_comments_colorscheme')) echo 'selected';echo '>Light</option>';
	echo '<option value="dark"'; if ('dark'==get_option('as_fb_comments_colorscheme')) echo 'selected';echo '>Dark</option>';
	echo '</select></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>Order by</label></th>';
	echo '<td><fieldset><legend class="screen-reader-text"><span>Time Format</span></legend>';
	echo '<label title="social"><input type="radio" name="as_fb_comments_order_by" value="social"'; if ('social'==get_option('as_fb_comments_order_by')) echo 'checked="checked" '; echo ' /><span>Social</span></label><br />';
	echo '<label title="time"><input type="radio" name="as_fb_comments_order_by" value="time"'; if ('time'==get_option('as_fb_comments_order_by')) echo 'checked="checked" '; echo ' /><span>Time</span></label><br />';
	echo '<label title="reverse_time"><input type="radio" name="as_fb_comments_order_by" value="reverse_time"'; if ('reverse_time'==get_option('as_fb_comments_order_by')) echo 'checked="checked" '; echo '/><span>Reverse Time</span></label><br />';
	echo '</fieldset></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>Mobile</label></th>';
	echo '<td><input name="as_fb_comments_mobile" type="checkbox" id="as_fb_comments_mobile" value="1"'; if ('1'==get_option('as_fb_comments_mobile')) echo 'checked="checked" '; echo ' /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>Number Of Posts</label></th>';
	echo '<td><input type="text" name="as_fb_comments_num_posts" value="'.esc_attr(get_option('as_fb_comments_num_posts')).'" class="input" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>APP ID</label></th>';
	echo '<td><input type="text" name="as_fb_comments_appid" value="'.esc_attr(get_option('as_fb_comments_appid')).'" class="input" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row"><label>Width</label></th>';
	echo '<td><input type="text" name="as_fb_comments_width" value="'.esc_attr(get_option('as_fb_comments_width')).'" class="input" /></td>';
	echo '</tr>';
	echo '</table>';
	submit_button();
	echo '</form>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '<div class="back-to-top-advanced-admin-col-right">';
	echo '<a href="http://arturssmirnovs.com/donate/?plugin=2&version=1.1" target="_blank">';
	echo '<img src="http://arturssmirnovs.com/images/donate-banner-300x600.png">';
	echo '</a>';
	echo '</div>';
	echo '<div class="back-to-top-advanced-admin-clearfix"></div>';
	echo '</div>';
}

/**
 * Outputs fb graph info
 */
function as_facebook_comments_fbgraphinfo() {
?>	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=<?php echo get_option('as_fb_comments_appid'); ?>&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script><?php
}

/**
 * Outputs fb comments
 */
function as_facebook_comments_show($content) {
	if ((is_single() && get_option('as_fb_comments_show') == 1) ||
		(is_single() && get_option('as_fb_comments_show') == 3) ||
		(is_page() && get_option('as_fb_comments_show') == 1) ||
		(is_page() && get_option('as_fb_comments_show') == 2)
		) {
		if (get_post_meta( get_the_ID(), '_fcs_disable', true ) == 0) {
			if (get_option('as_fb_comments_html5') == 1) {
				$content .= '<div class="fb-comments" data-href="'.get_permalink().'" data-width="'.get_option('as_fb_comments_width').'" data-numposts="'.get_option('as_fb_comments_num_posts').'" data-colorscheme="'.get_option('as_fb_comments_colorscheme').'" data-numposts="'.get_option('as_fb_comments_num_posts').'" data-order-by="'.get_option('as_fb_comments_order_by').'"></div>';	
			} else {
				$content .= '<div class="fb-comments" href="'.get_permalink().'" width="'.get_option('as_fb_comments_width').'" num_posts="'.get_option('as_fb_comments_num_posts').'" colorscheme="'.get_option('as_fb_comments_colorscheme').'" num_posts="'.get_option('as_fb_comments_num_posts').'" order_by="'.get_option('as_fb_comments_order_by').'"></div>';			
			}
		}
	}
	return $content;
}

/**
 * Register settings
 */
function as_facebook_comments_register_settings() {
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_show' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_html5' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_colorscheme' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_appid' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_mobile' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_num_posts' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_order_by' );
	register_setting( 'as-facebook-comments-settings', 'as_fb_comments_width' );
}

/**
 * Activate settings
 */
function as_facebook_comments_activate() {
	add_option( 'as_fb_comments_show', '1', '', 'yes' );
	add_option( 'as_fb_comments_html5', '1', '', 'yes' );
	add_option( 'as_fb_comments_colorscheme', 'light', '', 'yes' );
	add_option( 'as_fb_comments_appid', '', '', 'yes' );
	add_option( 'as_fb_comments_mobile', '1', '', 'yes' );
	add_option( 'as_fb_comments_num_posts', '5', '', 'yes' );
	add_option( 'as_fb_comments_order_by', 'social', '', 'yes' );
	add_option( 'as_fb_comments_width', '100%', '', 'yes' );
}

/**
 * Delete settings
 */
function as_facebook_comments_deactivate() {
	delete_option( 'as_fb_comments_show');
	delete_option( 'as_fb_comments_html5');
	delete_option( 'as_fb_comments_colorscheme');
	delete_option( 'as_fb_comments_appid');
	delete_option( 'as_fb_comments_mobile' );
	delete_option( 'as_fb_comments_num_posts' );
	delete_option( 'as_fb_comments_order_by' );
	delete_option( 'as_fb_comments_width' );
}

/**
 * Meta box
 */
function as_facebook_comments__add_meta_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'facebook_comments_system',
			__( 'Facebook Comments System', 'myplugin_textdomain' ),
			'as_facebook_comments__meta_box_callback',
			$screen
		);
	}
}

/**
 * Meta box cb
 */
function as_facebook_comments__meta_box_callback( $post ) {
	wp_nonce_field( 'as_facebook_comments_meta_box', 'as_facebook_comments_meta_box_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_fcs_disable', true );
	echo '<label for="facebook_comments_system_disable">';
	_e( 'Disable Facebook Comments System for this entry', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<input name="facebook_comments_system_disable" type="checkbox" id="facebook_comments_system_disable" value="1"'; if ('1'==$value) echo 'checked="checked" '; echo ' />';
}

/**
 * Meta box save
 */
function as_facebook_comments_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['as_facebook_comments_meta_box_meta_box_nonce'] ) ) { return; }
	if ( ! wp_verify_nonce( $_POST['as_facebook_comments_meta_box_meta_box_nonce'], 'as_facebook_comments_meta_box' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
	}
	if ( ! isset( $_POST['facebook_comments_system_disable'] ) ) { return; }
	$my_data = sanitize_text_field( $_POST['facebook_comments_system_disable'] );
	update_post_meta( $post_id, '_fcs_disable', $my_data );
}

/**
 * Actions/hooks
 */
register_activation_hook( __FILE__, 'as_facebook_comments_activate' );
register_deactivation_hook( __FILE__, 'as_facebook_comments_deactivate' );
add_action('admin_menu', 'as_facebook_comments_menu');
add_action( 'admin_init', 'as_facebook_comments_register_settings' );
add_action( 'admin_enqueue_scripts', 'as_facebook_comments_plugin_admin_styles' );
add_action( 'add_meta_boxes', 'as_facebook_comments__add_meta_box' );
add_action( 'save_post', 'as_facebook_comments_save_meta_box_data' );
add_action('wp_head', 'as_facebook_comments_fbgraphinfo');
add_filter( 'the_content', 'as_facebook_comments_show', 100 );
?>