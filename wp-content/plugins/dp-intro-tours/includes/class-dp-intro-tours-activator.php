<?php

use IntroToursDP\Wp\AdminPromo;

/**
 * Fired during plugin activation
 *
 * @link  https://deeppresentation.com
 * @since 1.0.0
 *
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 * @author     Tomas Groulik <tomas.groulik@gmail.com>
 */
class Dp_Intro_Tours_Activator {



	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
		AdminPromo::reset_promo_states( 'dp_it_basic_options' );
		// store admin color scheme to publicly accessible data in db
		Dp_Intro_Tours_Helper::profile_update();
	}

}

?>
