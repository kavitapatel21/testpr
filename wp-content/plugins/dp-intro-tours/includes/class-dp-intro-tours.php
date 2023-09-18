<?php

use IntroToursDP\Wp\Acf;
use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Str;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link  https://deeppresentation.com
 * @since 1.0.0
 *
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 * @author     Tomas Groulik <tomas.groulik@gmail.com>
 */
class Dp_Intro_Tours {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Dp_Intro_Tours_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	protected $builder_mode;


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->set_locale();

		$this->builder_mode = Dp_Intro_Tours_Helper::get_dp_url_param( 'dp_qpb_builder_mode' );

		$plugin_public = ( DP_INTRO_TOURS_IS_PRO )
		? new Dp_Intro_Tours_Public_PRO()
		: new Dp_Intro_Tours_Public();

		$this->define_include_hooks( $this->builder_mode );
		$this->define_admin_hooks( $plugin_public, $this->builder_mode );
		$this->define_public_hooks( $plugin_public, $this->builder_mode );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Dp_Intro_Tours_Loader. Orchestrates the hooks of the plugin.
	 * - Dp_Intro_Tours_I18n. Defines internationalization functionality.
	 * - Dp_Intro_Tours_Admin. Defines all hooks for the admin area.
	 * - Dp_Intro_Tours_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_dependencies() {
		/**
		* The class responsible for orchestrating the actions and filters of the
		* core plugin.
		*/
		$pluginDir = dirname( __FILE__ );

		include_once plugin_dir_path( $pluginDir ) . 'includes/class-dp-intro-tours-helper.php';

		include_once plugin_dir_path( $pluginDir ) . 'includes/class-dp-intro-tours-visit-count.php';

		include_once plugin_dir_path( $pluginDir ) . 'includes/class-dp-intro-tours-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		include_once plugin_dir_path( $pluginDir ) . 'includes/class-dp-intro-tours-i18n.php';

		include_once plugin_dir_path( $pluginDir ) . 'includes/class-dp-intro-tours-post-type-registrator.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		include_once plugin_dir_path( $pluginDir ) . 'admin/class-dp-intro-tours-admin.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		include_once plugin_dir_path( $pluginDir ) . 'public/class-dp-intro-tours-public.php';

		include_once plugin_dir_path( $pluginDir ) . 'includes/class-dp-intro-tours-upgrade.php';

		/* Initialize REST API */
		include_once plugin_dir_path( $pluginDir ) . 'includes/dp-intro-tours-route-builder.php';
		include_once plugin_dir_path( $pluginDir ) . 'includes/dp-intro-tours-route.php';

		/* Initialize of option page */
		include_once plugin_dir_path( $pluginDir ) . 'admin/class-dp-intro-tours-admin-settings.php';

		if ( DP_INTRO_TOURS_DP_ADMIN_DEBUG_EN ) {
			include_once plugin_dir_path( $pluginDir ) . 'dbg/class-dp-intro-tours-dbg.php';
		}

		if ( DP_INTRO_TOURS_IS_PRO ) {
			$adminator = DP_INTRO_TOURS_ADMINATOR;
			include_once plugin_dir_path( $pluginDir ) . 'PRO/class-dp-intro-tours-wplink.php';
			include_once plugin_dir_path( $pluginDir ) . 'PRO/class-dp-intro-tours-admin-pro.php';
			include_once plugin_dir_path( $pluginDir ) . 'PRO/class-dp-intro-tours-admin-settings-pro.php';
			include_once plugin_dir_path( $pluginDir ) . 'PRO/class-dp-intro-tours-public-pro.php';
			include_once plugin_dir_path( $pluginDir ) . 'PRO/class-dp-intro-tours-admin-promo-pro.php';
			include_once plugin_dir_path( $pluginDir ) . 'PRO/adminators/class-dp-intro-tours-adminator-core.php';
			include_once plugin_dir_path( $pluginDir ) . "PRO/adminators/{$adminator}/class-dp-intro-tours-adminator.php";
		} else {
			include_once plugin_dir_path( $pluginDir ) . 'admin/class-dp-intro-tours-admin-promo.php';
		}

		// Include ACF and ACF Table
		include_once plugin_dir_path( $pluginDir ) . 'acf-inc/acf-include.php';

		include_once plugin_dir_path( $pluginDir ) . '/admin/class-dp-intro-tours-acf-field-table.php';
		if ( DP_INTERNAL_ACF_FIELDS ) {
			include_once plugin_dir_path( $pluginDir ) . 'acf-inc/acf-config-functions.php';
			dpit_init_acf_cfg();
		}

		$this->loader = new Dp_Intro_Tours_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Dp_Intro_Tours_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function set_locale() {
		$plugin_i18n = new Dp_Intro_Tours_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}


	/**
	 * Register all of the hooks related to both - public-facing and also admin area functionality
	 * of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_include_hooks( $builder_mode ) {
		$plugin_post_type_registrator = new Dp_Intro_Tours_Post_Type_Registrator();
		$plugin_upgrader              = new Dp_Intro_Tours_Upgrade();

		$this->loader->add_action( 'init', $plugin_post_type_registrator, 'register_intro_tour', 5 );

		if ( ! wp_doing_ajax() ) {
			$this->loader->add_action( 'init', $plugin_upgrader, 'init', 7 );
			//$this->loader->add_action( 'admin_head', $plugin_upgrader, 'init_admin_head', 0 );
		}

		$this->loader->add_filter( 'mce_buttons', $this, 'adjust_mce_buttons', 999999 );
		$this->loader->add_filter( 'mce_buttons_2', $this, 'adjust_mce_buttons_2', 999999 );
		$this->loader->add_action( 'admin_footer', $this, 'render_tiny_mce' );
		$this->loader->add_action( 'wp_footer', $this, 'render_tiny_mce' );

		if ( DP_INTRO_TOURS_IS_PRO ) {
			$is_admin = is_admin();
			if ( $is_admin || $builder_mode ) {
				$dp_wplink = new Dp_Intro_Tours_Wplink( $builder_mode );
				$this->loader->add_action( 'wp_ajax_dp-wp-link-ajax', $dp_wplink, 'dp_wp_link_ajax', 10, 0 );

				$this->loader->add_action( $is_admin ? 'admin_footer' : 'wp_footer', $dp_wplink, 'wp_link_dialog' );
			}
		}

	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_admin_hooks( $plugin_public, $builder_mode ) {
		$plugin_admin  = null;
		$admin_tour_en = Settings::get_setting_array_field( 'dp_it_general_options', 'admin_board_tour_en', '0' ) === '1' && DP_INTRO_TOURS_IS_PRO;
		if ( DP_INTRO_TOURS_IS_PRO ) {
			$adminator       = new Dp_Intro_Tours_Adminator();
			$plugin_admin    = new Dp_Intro_Tours_Admin_PRO( $adminator );
			$plugin_settings = new Dp_Intro_Tours_Admin_Settings_PRO( $adminator );
			$plugin_promo    = new Dp_Intro_Tours_Admin_Promo_PRO( $adminator );
			$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_hidden_options' );
			$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_license_options' );
			$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_mobile_menu_options' );
			$this->loader->add_filter( 'plugin_action_links_' . DP_INTRO_TOURS_PLUGIN_BASE_NAME, $adminator, 'action_links' );
			$this->loader->add_action( 'in_plugin_update_message-dp-intro-tours-pro/dp-intro-tours.php', $plugin_admin, 'prefix_plugin_update_message', 10, 2 );

		} else {
			$plugin_admin    = new Dp_Intro_Tours_Admin();
			$plugin_settings = new Dp_Intro_Tours_Admin_Settings();
			$plugin_promo    = new Dp_Intro_Tours_Admin_Promo();
			$this->loader->add_action( 'in_plugin_update_message-dp-intro-tours/dp-intro-tours.php', $plugin_admin, 'prefix_plugin_update_message', 10, 2 );
		}

		//$this->loader->add_action( 'admin_menu', $plugin_admin, 'publish_sticky', 5, 0 );

		$this->loader->add_action( 'admin_notices', $plugin_promo, 'add_admin_notice', 10, 0 );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_permalink_notice', 10, 0 );

		$this->loader->add_action( 'admin_menu', $plugin_settings, 'setup_plugin_options_menu' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_general_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_labeling_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_text_styles_options' );

		$this->loader->add_action( 'admin_head', $plugin_admin, 'admin_theme_colors_check' );

		$this->loader->add_filter( 'redirect_post_location', $plugin_admin, 'redirect_from_transient' );
		$this->loader->add_action( 'wp_print_footer_scripts', $plugin_admin, 'delete_dpintro_builder_transient' );
		$this->loader->add_filter( 'preview_post_link', $plugin_admin, 'change_tour_permalink', 10, 2 );

		$this->loader->add_filter( 'post_type_link', $plugin_admin, 'change_tour_permalink', 10, 2 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'acf/save_post', $plugin_admin, 'on_post_updated' );

		$this->loader->add_action( 'acf/input/admin_head', $plugin_admin, 'edit_form_after_title' );
		$this->loader->add_filter( 'acf/update_value/name=intro_steps', $plugin_admin, 'on_update_intro_steps_field', 10, 3 );
		$this->loader->add_filter( 'acf/load_value/name=intro_steps', $plugin_admin, 'on_load_intro_steps_field', 10, 3 );

		$this->loader->add_filter( 'parent_file', $plugin_settings, 'highlight_submenu_active_item' );

		$this->loader->add_action( 'profile_update', $plugin_admin, 'profile_update' );

		$this->loader->add_filter( 'enter_title_here', $plugin_admin, 'change_tour_title_placeholder', 10, 2 );

		$this->loader->add_filter( 'manage_dp_intro_tours_posts_columns', $plugin_admin, 'manage_dp_intro_tours_posts_columns', 0, 1 );
		$this->loader->add_action( 'manage_dp_intro_tours_posts_custom_column', $plugin_admin, 'manage_dp_intro_tours_posts_custom_column', 10, 2 );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_settings_navig_to_dpit_cpt_admin_menu' );

		if ( $admin_tour_en ) {
			// tour on admin board
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_public, 'enqueue_scripts_on_admin_board', $builder_mode ? 1 : 10 );
		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_public_hooks( $plugin_public, $builder_mode ) {
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', $builder_mode ? 1 : 10 );
		$this->loader->add_action( 'admin_bar_menu', $plugin_public, 'customize_toolbar', 100, 1 );
	}


	public function render_tiny_mce() {
		$builder_mode  = Dp_Intro_Tours_Helper::get_dp_url_param( 'dp_qpb_builder_mode' );
		$admin_tour_en = Settings::get_setting_array_field( 'dp_it_general_options', 'admin_board_tour_en', '0' ) === '1' && DP_INTRO_TOURS_IS_PRO;
		if ( ! is_admin() && $builder_mode == 1 ) {
			Dp_Intro_Tours_Helper::render_tiny_mce();
		} elseif ( is_admin() && Dp_Intro_Tours_Helper::is_singular_intro_tour() ) {
			wp_enqueue_style( 'editor-buttons' );
			Dp_Intro_Tours_Helper::render_tiny_mce();
		} elseif ( $admin_tour_en && is_admin() && $builder_mode == 1 ) {
			wp_enqueue_style( 'editor-buttons' );
			Dp_Intro_Tours_Helper::render_tiny_mce();
		}
	}

	public function adjust_mce_buttons( $toolbar_buttons ) {
		if ( is_admin() && Dp_Intro_Tours_Helper::is_dp_intro_cpt_admin() || ! is_admin() && $this->builder_mode == 1 ) {
			$toolbar_buttons = Dp_Intro_Tours_Helper::filter_mce_toolbar( $toolbar_buttons, 1 );
		}
		return $toolbar_buttons;
	}

	public function adjust_mce_buttons_2( $toolbar_buttons ) {
		if ( is_admin() && Dp_Intro_Tours_Helper::is_dp_intro_cpt_admin() || ! is_admin() && $this->builder_mode == 1 ) {
			$toolbar_buttons = Dp_Intro_Tours_Helper::filter_mce_toolbar( $toolbar_buttons, 2 );
		}
		return $toolbar_buttons;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since  1.0.0
	 * @return Dp_Intro_Tours_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

}

?>
