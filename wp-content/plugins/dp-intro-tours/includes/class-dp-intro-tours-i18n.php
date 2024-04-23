<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link  https://deeppresentation.com
 * @since 1.0.0
 *
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 * @author     Tomas Groulik <tomas.groulik@gmail.com>
 */
class Dp_Intro_Tours_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'dp-intro-tours',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

		load_plugin_textdomain(
			'acf-table',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}

?>
