<?php
/*
Plugin Name: Unlimited Logo Carousel 
Plugin URI: http://edatastyle.com/product/unlimited-logo-carousel/
Description: Unlimited Logo Carousel allows you to easily create logo carousel/slider to display logos of clients, partners, sponsors, affiliates etc.
Version:1.2
Author: eDataStyle
Author URI: http://edatastyle.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

defined( 'ED_LOGO_PATH' )    or  define( 'ED_LOGO_PATH',    plugin_dir_path( __FILE__ ) );
defined( 'ED_LOGO_URL' )    or  define( 'ED_LOGO_URL',    plugin_dir_url( __FILE__ ) );

load_plugin_textdomain( 'ed_logo', false, plugin_dir_path(__FILE__) . 'languages/' ); 
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-background-slider-master-activator.php
 */
function activate_ed_logo() {
	require_once plugin_dir_path( __FILE__ ) . '/inc/activator.php';
	Unlimited_Logo_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-background-slider-master-deactivator.php
 */
function deactivate_ed_logo() {
	require_once plugin_dir_path( __FILE__ ) . '/inc/deactivator.php';
	Unlimited_Logo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ed_logo' );
register_deactivation_hook( __FILE__, 'deactivate_ed_logo' );

if ( file_exists( ED_LOGO_PATH . '/inc/unlimited-logo-carousel.php' )) {
	require_once ED_LOGO_PATH . '/inc/unlimited-logo-carousel.php';

}
if ( file_exists( ED_LOGO_PATH . '/inc/logo-metabox.php' )) {
	require_once ED_LOGO_PATH . '/inc/logo-metabox.php';
}
if ( file_exists( ED_LOGO_PATH . '/inc/meta-settings.php' )) {
	require_once ED_LOGO_PATH . '/inc/meta-settings.php';
}
if ( file_exists( ED_LOGO_PATH . '/inc/options.php' )) {
	require_once ED_LOGO_PATH . '/inc/options.php';
}
if ( file_exists( ED_LOGO_PATH . '/inc/views.php' )) {
	require_once ED_LOGO_PATH . '/inc/views.php';
}


function ed_logo_carousel_admin_enqueue_scripts() {
	// admin utilities
	wp_enqueue_media();
	 // wp core styles
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );;

	 // wp core scripts
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-ui-accordion' );
 	//wp_enqueue_style( 'ed_bg_slider', plugins_url('assets/admin_ed_bg_style.css', __FILE__));
		
}
add_action( 'admin_enqueue_scripts', 'ed_logo_carousel_admin_enqueue_scripts' );


if( !function_exists('ed_logo_carousel_header_css') ){
	add_action('admin_head','ed_logo_carousel_header_css',0);
	function ed_logo_carousel_header_css(){
		echo '<style type="text/css">
			#menu-posts-ed_logo .dashicons-admin-post::before,#menu-posts-ed_logo .dashicons-format-standard::before{
			content:""!important;
			background:url('.ED_LOGO_URL.'/assets/logo.svg) no-repeat center center;	
			}
		</style>';	
	}
}

/**
 * The code that runs during plugin save meta data.
 */
if( !function_exists('ed_sanitize_text') ){
	function ed_sanitize_text( $arr ){
		$newArr = array();
	
		foreach( $arr as $key => $value )
		{
			$newArr[ $key ] = sanitize_text_field($value);
		}
	
		return $newArr;
	}
}

/**
 * The code that runs during plugin save meta data.
 */
if( !function_exists('ed_sanitize_url') ){
	function ed_sanitize_url( $arr ){
		$newArr = array();
	
		foreach( $arr as $key => $value )
		{
			$newArr[ $key ] = esc_url_raw(sanitize_text_field( $value ));
		}
	
		return $newArr;
	}
}
/**
 * The code that runs during plugin save meta data.
 */
if( !function_exists('ed_sanitize_html') ){
	function ed_sanitize_html( $arr ){
		$newArr = array();
	
		foreach( $arr as $key => $value )
		{
			$newArr[ $key ] = sanitize_text_field( wp_strip_all_tags( $value ) );
		}
	
		return $newArr;
	}
}