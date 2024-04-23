<?php

/*
*
* @link              https://deeppresentation.com/
* @since             1.0.0
* @package           Intro_Tour_Tutorial
*
* @wordpress-plugin
* Plugin Name:       Intro Tour Tutorial
* Plugin URI:        https://deeppresentation.com/plugins/dp-intro-tours
* Description:       You create an intuitive tour that guides people through your website or co workers to manage your website through wordpress admin board. You can choose the way how and when your tour starts, how does it look and behave, all in one download. It's all possible without special technical knowledge, because plug-in integrates the visual builder for creating such a tour. If you have deeper technical knowledge you can benefit with advanced configuration, that can provide your abilities to set the tour up on even special scenarios.
* Version:           5.4.1
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Tomáš Groulík <deeppresentation>
* Author URI:        https://deeppresentation.com/
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       dp-intro-tours
* Domain Path:       /languages
*/



// If this file is called directly, abort.


if ( ! defined( 'WPINC' ) ) {
	die;
}


$plugin_base_name = plugin_basename( __FILE__ );

if ( is_admin() && ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
// Check FREE version - and deactivate
if ( is_admin() && $plugin_base_name === 'dp-intro-tours-pro/dp-intro-tours.php' && is_plugin_active( 'dp-intro-tours/dp-intro-tours.php' ) ) {

	add_action(
		'admin_notices',
		function() {
			deactivate_plugins( 'dp-intro-tours/dp-intro-tours.php', true );
			if ( class_exists( 'IntroToursDP\Wp\AdminNotice' ) ) {
				IntroToursDP\Wp\AdminNotice::render_notice( // class loaded from FREE version
					__( 'FREE version of the Intro Tour Tutorial plugin has been deactivated. You can safely delete it. All tours previously created by the FREE version are kept, so don\'t worry about losing them. Please reload admin board to get PRO fully in.', 'dp-intro-tours' ),
					'warning',
					false,
					'',
					'',
					'',
					true,
					'',
					'dpit-notice'
				);
			}
		},
		10,
		0
	);
} else {
	$pluginDirPath = plugin_dir_path( __FILE__ );
	define( 'DP_INTRO_TOURS_PLUGIN_BASE_NAME', $plugin_base_name );
	define( 'DP_INTERNAL_ACF_FIELDS', true );
	define( 'DP_ACF_TABLE_VERSION', '1.3.11' );
	define( 'DP_INTRO_TOURS_HOW_TO_DOC', 'https://deeppresentation.com/how-to/category/intro-tour-tutorial-plugin/' );
	define( 'DP_INTRO_TOURS_API_DOC', 'https://deeppresentation.com/how-to/intro-tour-tutorial-plugin/api/' );
	define( 'DP_INTRO_TOURS_CSS_DOC', 'https://deeppresentation.com/how-to/intro-tour-tutorial-plugin/css-customization/' );
	define( 'DP_INTRO_TOURS_V5_DOC', 'https://deeppresentation.com/how-to/intro-tour-tutorial-plugin/upgrade-to-v5/' );
	define( 'DP_INTRO_TOURS_CONTACT_LINK', 'https://deeppresentation.com/contact/' );


	require_once $pluginDirPath . 'vendor/autoload.php';
	// Build type support - changed from build scripts ... defined at dp-wpdev-workflow.js
	require_once $pluginDirPath . 'dp-build-type.php';
	include_once $pluginDirPath . 'includes/class-dp-intro-tours-enqueue.php';

	define( 'DP_INTRO_TOURS_IS_PRO', DP_INTRO_TOURS_DP_BUILD_TYPE === 'PRO' );


	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-dp-intro-tours-activator.php
	 */
	function activate_dp_intro_tours() {
		include_once plugin_dir_path( __FILE__ ) . 'includes/class-dp-intro-tours-activator.php';
		Dp_Intro_Tours_Activator::activate();
	}
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-dp-intro-tours-deactivator.php
	 */
	function deactivate_dp_intro_tours() {
		include_once plugin_dir_path( __FILE__ ) . 'includes/class-dp-intro-tours-deactivator.php';
		Dp_Intro_Tours_Deactivator::deactivate();
	}
	register_activation_hook( __FILE__, 'activate_dp_intro_tours' );
	register_deactivation_hook( __FILE__, 'deactivate_dp_intro_tours' );

	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require $pluginDirPath . 'includes/class-dp-intro-tours.php';

	function run_dp_intro_tours() {
		Dp_Intro_Tours_Enqueue::init(
			'dpIntroTours',
			'dist',
			DP_INTRO_TOURS_VERSION,
			'plugin',
			__FILE__
		);

		$plugin = new Dp_Intro_Tours();
		$plugin->run();
	}
	run_dp_intro_tours();
}

?>
