<?php
/**
 * Plugin Dependency Class
 *
 * Adds plugin dependencies.
 *
 * @since 0.2.2
 *
 * @see tgmpa
 *
 * @package WordPress
 */
Class DFP_Ads_Wallpaper_Dependencies {

	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	public $plugins = array(
		array(
			'name'     => 'DFP - DoubleClick Ad Manager',
			'slug'     => 'dfp-ads',
			'required' => true,
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	public $config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'dfp-missing-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => 'Plugin Missing',        // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => 'Install Required Plugins',
			'menu_title'                      => 'DFP Ads Plugins',
			'nag_type'                        => 'error' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	public function register() {
		tgmpa( $this->plugins, $this->config );
	}

}