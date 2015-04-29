<?php
/**
 * DFP Wallpaper Ad
 *
 * Holds the data that will be sent to the front end for display.
 *
 * @link  http://www.chriswgerber.com/dfp-ads/wallpaper
 * @since 0.1.0
 *
 * @package    WordPress
 * @subpackage DFP-Ads-Wallpaper
 */

class DFP_Wallpaper_Ad {

	/**
	 * Script Name
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @var string
	 */
	public $script_name = 'dfp_ads_wallpaper';

	/**
	 * Ad position Object
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @var DFP_Ad_Position|null
	 */
	public $ad_position;

	/**
	 * URI of Plugin Directory
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $dir_uri;

	/**
	 * DFP Ads Object
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @var DFP_Ads
	 */
	public $dfp_ads;

	/**
	 * PHP5 Constructor
	 *
	 * @param $dfp_ads DFP_Ads
	 */
	public function __construct( DFP_Ads $dfp_ads ) {
		$this->dfp_ads = $dfp_ads;

		// Enqueues Scripts and Styles
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts_and_styles' ) );
	}

	/**
	 * Adds the Ad position of the Wallpaper ad to the class.
	 *
	 * Not run in the constructor because it relies on information
	 * not yet available to the class.
	 *
	 * @since 0.1.0
	 * @access public
	 *
	 * @param DFP_Ad_Position $ad_position
	 */
	public function ad_position( DFP_Ad_Position $ad_position ) {

		$this->ad_position = $ad_position;
	}

	/**
	 * Registers Scripts. There is no data to localize
	 *
	 * @since 0.1.0
	 * @access public
	 */
	public function scripts_and_styles() {

		// Preps the script
		wp_register_script(
			$this->script_name,
			$this->dir_uri . '/assets/dfp-wallpaper.js',
			array( $this->dfp_ads->script_name, 'jquery' ),
			false,
			false
		);
		// Enqueue
		wp_enqueue_script( $this->script_name );
	}

	/**
	 * Styles for the popunder ad.
	 *
	 * Adds CSS Styles to the head. Will target OOP slot for Wallpaper Ad.
	 *
	 * @since 0.1.0
	 * @access public
	 */
	public function css_style() {
		?>
		<style type="text/css">
			.dfp_wallpaper_ad > div {
				position: fixed;
				top: 0;
				left: 0;
				width: 100% !important;
				height: 100% !important;
				z-index: -1;
				background-size: cover;
			}
			.dfp_wallpaper_ad > div > iframe {
				width: 100% !important;
				height: 100% !important;
			}
		</style>
	<?php
	}

	/**
	 * Filtering in Wallpaper Position
	 *
	 * @since 0.1.0
	 * @access public
	 *
	 * @param DFP_Ads $dfp_ads
	 *
	 * @return DFP_Ads
	 */
	public function send_ads_to_js( $dfp_ads ) {

		$dfp_ads->wallpaper_ad = $this->ad_position;

		return $dfp_ads;
	}

}