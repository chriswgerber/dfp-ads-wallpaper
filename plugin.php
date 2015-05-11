<?php
/**
 * @wordpress-plugin
 * Plugin Name:       DFP Ad Manager - Wallpaper Ad
 * Plugin URI:        http://www.chriswgerber.com/dfp-ads/wallpaper
 * Description:       Provides framework for Wallpaper Ad Position
 * Version:           0.1.0
 * Author:            Chris W. Gerber
 * Author URI:        http://www.chriswgerber.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dfp-ads-wallpaper
 * Github Plugin URI: https://github.com/ThatGerber/dfp-ads-wallpaper
 * GitHub Branch:     master
 *
 *
 * The Plugin File
 *
 * @link              http://www.chriswgerber.com/dfp-ads/wallpaper
 * @since             0.1.0
 * @subpackage        DFP-Ads-Wallpaper
 */

function dfp_wallpaper_init() {
	if ( class_exists( 'dfp_ads' ) ) {

		/** Queueing up the Wallpaper ad */
		global $dfp_ads;
		include( 'assets/class.dfp_wallpaper_ad.php' );
		$wallpaper_ad          = new DFP_Wallpaper_Ad ( $dfp_ads );
		$wallpaper_ad->dir_uri = plugins_url( null, __FILE__ );
		$position_id           = dfp_get_settings_value( 'dfp_wallpaper_id' );
		$wallpaper_position    = dfp_get_ad_position( $position_id );
		if ( $wallpaper_position !== false ) {
			$wallpaper_ad->ad_position( $wallpaper_position );
		}

		// Filter Ad Position into the DFP Ads object
		add_filter( 'pre_dfp_ads_to_js', array( $wallpaper_ad, 'send_ads_to_js' ) );

		// Adds Styles to head.
		add_action( 'wp_head', array( $wallpaper_ad, 'css_style' ) );

        /* Section headings */
        add_filter( 'dfp_ads_settings_sections', ( function( $sections ) {
            $sections['wallpaper_settings'] = array(
                'id'    => 'wallpaper_settings',
                'title' => 'Wallpaper Settings'
            );

            return $sections;
        } ) );

		/* Wallpaper Ad setting */
		add_filter( 'dfp_ads_settings_fields', ( function ( $fields ) {
			$fields['dfp_wallpaper_id'] = array(
				'id'          => 'dfp_wallpaper_id',
				'field'       => 'text',
                'callback'    => 'ads_dropdown',
				'title'       => 'Wallpaper Ad Title',
				'section'     => 'wallpaper_settings',
				'description' => 'Enter the ad code for the wallpaper ad.'
			);

			return $fields;
		} ) );
	}
}
add_action( 'plugins_loaded', 'dfp_wallpaper_init' );