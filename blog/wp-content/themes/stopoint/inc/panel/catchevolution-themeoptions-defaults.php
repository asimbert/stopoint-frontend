<?php
/**
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 * @since Catch Evolution Pro 1.0
 */

/**
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 */
global $catchevolution_options_defaults;
$catchevolution_options_defaults = array(
	'fav_icon'							=> get_template_directory_uri().'/images/favicon.ico',
 	'remove_favicon'					=> '1',	
	'web_clip'							=> get_template_directory_uri().'/images/apple-touch-icon.png',
 	'remove_web_clip'					=> '1',
	'featured_logo_header'				=> get_template_directory_uri().'/images/logo.png',
	'disable_header'					=> '0',
 	'remove_header_logo'				=> '1',
 	'remove_site_title'					=> '0',
 	'remove_site_description'			=> '0',
	'site_title_above'					=> '0',
	'seperate_logo'						=> '0',
	'disable_header_menu'				=> '0',
	'search_display_text'				=> 'Search',
	'color_scheme'						=> 'light',
	'sidebar_layout'					=> 'right-sidebar',
	'content_layout'					=> 'excerpt',
	'reset_sidebar_layout'				=> '2',
 	'front_page_category'				=> array(),
	'exclude_slider_post'				=> '0',
 	'slider_qty'						=> 4,
	'enable_slider'						=> 'enable-slider-homepage',
	'featured_slider'					=> array(),
 	'transition_effect'					=> 'fade',
 	'transition_delay'					=> 4,
 	'transition_duration'				=> 1,
	'disable_footer_social'				=> 0,
 	'social_facebook'					=> '',
 	'social_twitter'					=> '',
 	'social_googleplus'					=> '',
 	'social_pinterest'					=> '',
 	'social_youtube'					=> '',
 	'social_vimeo'						=> '',
 	'social_linkedin'					=> '',
 	'social_aim'						=> '',
 	'social_myspace'					=> '',
 	'social_flickr'						=> '',
 	'social_tumblr'						=> '',
 	'social_deviantart'					=> '',
 	'social_dribbble'					=> '',
 	'social_wordpress'					=> '',
 	'social_rss'						=> '',
	'social_slideshare'					=> '',
 	'social_instagram'					=> '',
 	'social_skype'						=> '',
	'social_soundcloud'					=> '',
	'social_email'						=> '',
	'social_contact'					=> '',
	'social_xing'						=> '',
	'social_meetup'						=> '',
 	'custom_css'						=> '',
 	'analytic_header'					=> '',
 	'analytic_footer'					=> '',
 	'sidebar_layout'					=> 'right-sidebar',
 	'more_tag_text'						=> 'Continue Reading &rarr;',
 	'excerpt_length'					=> 30,
	'reset_more_tag'					=> '2',
	'feed_url'							=> '',
);
global $catchevolution_options_settings;
$catchevolution_options_settings = catchevolution_options_set_defaults( $catchevolution_options_defaults );

function catchevolution_options_set_defaults( $catchevolution_options_defaults ) {
	$catchevolution_options_settings = array_merge( $catchevolution_options_defaults, (array) get_option( 'catchevolution_options', array() ) );
	return $catchevolution_options_settings;
}