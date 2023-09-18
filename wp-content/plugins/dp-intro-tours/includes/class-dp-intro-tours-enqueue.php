<?php

use IntroToursWPackio\Enqueue;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Silence is golden
}

class Dp_Intro_Tours_Enqueue {
	private static $instance = null;
	/**
	 * Enqueue all the assets for an entrypoint inside a source.
	 *
	 * @throws \LogicException If manifest.json is not found in the directory.
	 *
	 * @param string $name The name of the files entry.
	 * @param string $entryPoint Which entrypoint would you like to enqueue.
	 * @param array  $config Additional configuration.
	 * @return array Associative with `css` and `js`. Each of them are arrays
	 *               containing ['handle' => string, 'url' => string].
	 */
	public static function enqueue_js( $name, $entryPoint, $config, $js_script_data_var_name = '', $js_script_data = null ) {
		$res = null;
		if ( self::$instance ) {
			$config['js'] = true;
			$res          = self::$instance->enqueue( $name, $entryPoint, $config );
			if ( $js_script_data_var_name && $js_script_data ) {
				$entry_point = array_pop( $res['js'] );
				wp_localize_script( $entry_point['handle'], $js_script_data_var_name, $js_script_data );
			}
		}
		return $res;
	}

	public static function enqueue_css( $name, $entryPoint, $config = [], $dynamic_css = null ) {
		$res = null;
		if ( self::$instance ) {
			$config['css'] = true;
			$res           = self::$instance->enqueue( $name, $entryPoint, $config );
			if ( $dynamic_css ) {
				$entry_point = array_pop( $res['css'] );
				wp_add_inline_style( $entry_point['handle'], $dynamic_css );
			}
		}
		return $res;
	}


	/**
	 * Create an instance of the Enqueue helper class.
	 *
	 * @throws \LogicException If $type is not plugin or theme.
	 *
	 * @param string         $appName     Name of the application, same as wpackio.project.js.
	 * @param string         $outputPath  Output path relative to the root of this plugin/theme, same as wpackio.project.js.
	 * @param string         $version     Version of your plugin/theme, used to generate query URL.
	 * @param string         $type        The type of enqueue, either 'plugin' or 'theme', same as wpackio.project.js.
	 * @param string|boolean $pluginPath  If this is a plugin, then pass absolute path of the plugin main file, otherwise pass false.
	 * @param string         $themeType   If this is a theme, then you can declare if it is a 'child' or 'regular' theme.
	 */
	public static function init( $appName, $outputPath, $version, $type = 'plugin', $pluginPath = false, $themeType = 'regular' ) {
		if ( ! self::$instance ) {
			self::$instance = new Enqueue( $appName, $outputPath, $version, $type, $pluginPath, $themeType );
			return true;
		}
		return false;
	}
}

?>
