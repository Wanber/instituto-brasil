<?php

/**
 * Fired during plugin activation
 *
 * @since      1.0.0
 *
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Background_Slider_Master
 * @subpackage Background_Slider_Master/includes
 * @author     iCanWP Team, Sean Roh, Chris Couweleers
 */

class Unlimited_Logo_Activator {

	/**
	 * Checks for logo_carousel slides created from previous settings and convert them to be compatible with the new setting.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$ed_team_options = array(
			'auto_play'  => 'yes',
			'auto_play_speed' =>'4000',
			'slide_speed' =>'800',
			'stop_on_hover'  => 'yes',
			'next_prev_buttons'  => 'yes',
			'next_prev_position'  => 'center',
			'pagination'  => 'yes',
			'mouse_drag'  => 'yes',
			'lazy_load'  => 'yes',
			'desktop'  => '5',	
			'mini_desktop'  => '4',
			'tablet'  =>'3',
			'mobile' =>'2',
			'arrows_size' =>'30',
			'arrows_bg' =>'#da5d5d',
			'arrows_color' =>'#ffffff',
			'arrows_bg_h' =>'#9f3c3c',
			'arrows_color_h' =>'#ffffff',
			'pagination_color' =>'#da5d5d',
			'pagination_color_h' =>'#9f3c3c',
			'tooltip_bg' =>'#0e0a0a',
			'tooltip_color' =>'#ffffff',
			'tooltip_size' =>'12',
			'logo_border' =>'no',
			'border_size' => '1',
			'border_color' => '#d5d5d5',
			'border_color_h' => '#bd0000',
		);
		add_option('ed_logo_carousel_options', $ed_team_options);
	}
	
}
