<?php

use IntroToursDP\Wp\Acf;
use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Arr;
use IntroToursDP\Std\Core\Str;


// Aktuální verze
define( 'DPIT_DB_VERSION', 8 );



class Dp_Intro_Tours_Upgrade {



	public function __construct() {
		// DBG RUN LAST ALWAYS
		//update_option( 'dpit_db_version', DPIT_DB_VERSION - 1 );
		//update_option( 'dp_it_text_styles_options', [] );
	}

	public function init() {
		if ( ! wp_doing_ajax() && ! wp_doing_cron() ) {

			$currently_saved_db_version = get_option( 'dpit_db_version', false );
			if ( $currently_saved_db_version < DPIT_DB_VERSION ) {

				$transient_id            = 'dpit_upgrade_in_process';
				$dpit_upgrade_in_process = get_transient( $transient_id );
				if ( $dpit_upgrade_in_process ) {
					return;
				}
				set_transient( $transient_id, true, 50 );
				//trigger_error( 'Intro Tour Tutorial upgrade script ... STARTED' );

				/* UPGRADE CODE GOES HERE */
				switch ( $currently_saved_db_version ) {
					case false:
						update_option( 'dpit_db_version', DPIT_DB_VERSION );
						break;
					case 0:
					case 1:
						// Back compatibility of accent color ( was changed to purple for new installations)
						// Keep turquoise for old installations
						if ( ! Settings::get_setting_array_field( 'dp_it_general_options', 'dp_it_accent_color', '' ) ) {
							Settings::update_setting_array( 'dp_it_general_options', 'dp_it_accent_color', '#2f6e6d' );
						}
						$this->go_trough_all_tours( [ $this, 'set_steps_url_meta' ] ); // Upgrade to major 2.*.*
						update_option( 'dpit_db_version', 2 );
						break;
					case 2:
						$this->go_trough_all_tours( [ $this, 'upgrade_mobile_menu_alt' ] );
						update_option( 'dpit_db_version', 3 );
						break;
					case 3:
						$this->go_trough_all_tours( [ $this, 'force_q_mark_without_slash_in_admin_url' ] );
						update_option( 'dpit_db_version', 4 );
						break;
					case 4:
						$this->go_trough_all_tours( [ $this, 'rebuild_steps' ] );
						update_option( 'dpit_db_version', 5 );
						break;
					case 5:
						$this->go_trough_all_tours( [ $this, 'rebuild_steps' ] );
						update_option( 'dpit_db_version', 6 );
						break;
					case 6:
						update_option( 'dp_it_text_styles_options', [] );
						Settings::migrate_option_array_field( 'dp_it_general_options', 'dp_it_general_options', '0', 'useThemeDefaultFont', 'inherit_all_styles' );
						$old_global_theme_name = Settings::get_setting_array_field( 'dp_it_general_options', 'theme', Dp_Intro_Tours_Helper::get_themes_select_def_val( true ) );
						Settings::update_setting_array( 'dp_it_general_options', 'theme', $this->get_theme_name_v5( $old_global_theme_name, true ) );
						$this->go_trough_all_tours( [ $this, 'upgrade_tour_v5' ], null, get_option( 'dp_it_general_options', [] ) );
						update_option( 'dpit_db_version', 7 );
						break;
					case 7:
						// fix - 'default' was stored in global options
						$default_global_theme_key = Dp_Intro_Tours_Helper::get_themes_select_def_val( true );
						$default_tour_theme_key   = Dp_Intro_Tours_Helper::get_themes_select_def_val( false );
						$global_theme_key         = Settings::get_setting_array_field( 'dp_it_general_options', 'theme', $default_global_theme_key );
						if ( $global_theme_key === $default_tour_theme_key ) {
							Settings::update_setting_array( 'dp_it_general_options', 'theme', $default_global_theme_key );
						}
						update_option( 'dpit_db_version', 8 );
						break;
					default:
						break;
				}
				delete_transient( $transient_id );
				//trigger_error( 'Intro Tour Tutorial upgrade script ... FINISHED' );
			}
			// PRO vs FREE data compatibility
			$this->check_build_type_compatibility_for_all_tours();

		}
	}


	/*  public function init_admin_head() {
		$currently_saved_db_version = get_option( 'dpit_db_version', false );
		if ( $currently_saved_db_version < DPIT_DB_VERSION ) {
			switch ( $currently_saved_db_version ) {
				case 6:
					$users = get_users();
					Dp_Intro_Tours_Helper::profile_update();
					update_option( 'dpit_db_version', 7 );
					break;
			}
		}
	}*/


	private function upgrade_tour_v5( $general_options ) {
		$tour_ID        = get_the_ID();
		$old_theme_name = Acf::get_group_field( 'intro_design', 'theme', $tour_ID, Dp_Intro_Tours_Helper::get_themes_select_def_val( false ) );
		Acf::update_group_field( 'intro_design', 'theme', $this->get_theme_name_v5( $old_theme_name, false ) );
		$hide_bullets      = Arr::sget( $general_options, 'hideBullets', '0' );
		$hide_step_numbers = Arr::sget( $general_options, 'hideStepNumbers', '0' );
		$show_progress     = Arr::sget( $general_options, 'showProgress', '0' );
		Acf::update_group_field( 'dp_tour_behaviour', 'show_bullet_navigation', $hide_bullets === '1' ? 0 : 1 );
		Acf::update_group_field( 'dp_tour_behaviour', 'show_progress_bar', $show_progress === '1' ? 1 : 0 );
		Acf::update_group_field( 'dp_tour_behaviour', 'show_step_numbers', $hide_step_numbers === '1' ? 0 : 1 );
	}

	private function get_theme_name_v5( $old_theme_name, bool $is_global_option = false ) {
		switch ( $old_theme_name ) {

			case 'light':
			case 'light2':
			case 'flat':
			case 'flat2':
				return 'basic';
			case 'dark':
				return 'colored-bottom';
			case 'dark2':
				return 'dark';
			case 'modern':
				return 'minimal';
			case 'fancybar':
				return 'sticky';
			case 'colored':
				return 'colored';
			case 'default':
				return $is_global_option ? 'basic' : 'default';
			default:
				return 'basic';

		}
	}


	private function check_build_type_compatibility_for_all_tours() {
		$build_type = get_option( 'dpit_plugin_build_type', null );
		if ( ! $build_type || $build_type !== DP_INTRO_TOURS_DP_BUILD_TYPE ) {

			$transient_id                                     = 'dpit_build_type_compatibility_upgrade_in_process';
			$dpit_build_type_compatibility_upgrade_in_process = get_transient( $transient_id );
			if ( $dpit_build_type_compatibility_upgrade_in_process ) {
				return;
			}
			set_transient( $transient_id, true, 50 );
			//trigger_error( 'Intro Tour Tutorial - build type compatibility upgrade ... STARTED' );

			// Build type was changed
			$this->go_trough_all_tours( [ $this, 'fix_build_type_change' ] );
			update_option( 'dpit_plugin_build_type', DP_INTRO_TOURS_DP_BUILD_TYPE );
			//trigger_error( 'Intro Tour Tutorial - build type compatibility upgrade ... FINISHED' );
			delete_transient( $transient_id );
		}
	}

	private function fix_build_type_change() {
		$tour_ID = get_the_ID();
		switch ( DP_INTRO_TOURS_DP_BUILD_TYPE ) {
			case 'PRO':
				// From FREE to PRO
				$recreate_res = Dp_Intro_Tours_Helper::recreate_step_table( $tour_ID, null, true );
				if ( $recreate_res['was_changed'] ) {
					Dp_Intro_Tours_Helper::store_plugin_version( $tour_ID );

					update_field( 'intro_steps', $recreate_res['raw_data'], $tour_ID );
				}
				break;
			case 'FREE':
				// From PRO to FREE
				Dp_Intro_Tours_Helper::readjust_first_tour_page( $tour_ID );
				break;
		}
	}

	private function set_steps_url_meta() {
		$tour_ID              = get_the_ID();
		$stored_by_build_type = Dp_Intro_Tours_Helper::get_plugin_version_from_intro_data( $tour_ID, true );
		if ( $stored_by_build_type && $stored_by_build_type !== DP_INTRO_TOURS_DP_BUILD_TYPE ) {
			$this->_set_steps_url_meta( $tour_ID, $stored_by_build_type );
		}
		$this->_set_steps_url_meta( $tour_ID, DP_INTRO_TOURS_DP_BUILD_TYPE );
	}

	public function upgrade_mobile_menu_alt_step_props( $old_step, $new_step ) {
		$mob_menu_selector = Arr::sget( $old_step, 'selector_in_mobile_menu' );
		if ( $mob_menu_selector ) {
			$new_step['alt_mobile_selector'] = $mob_menu_selector;
			$new_step['is_in_mobile_menu']   = '1';
		}
		return $new_step;
	}

	private function upgrade_mobile_menu_alt() {
		if ( DP_INTRO_TOURS_IS_PRO ) {
			$tour_ID      = get_the_ID();
			$recreate_res = Dp_Intro_Tours_Helper::recreate_step_table( $tour_ID, null, false, true, [ $this, 'upgrade_mobile_menu_alt_step_props' ] );
			if ( $recreate_res['was_changed'] ) {
				Dp_Intro_Tours_Helper::store_plugin_version( $tour_ID );
				update_field( 'intro_steps', $recreate_res['raw_data'], $tour_ID );
			}
		}
	}

	public function force_q_mark_without_slash_in_admin_url_step_props( $step_data ) {
		$url = Arr::sget( $step_data, 'url' );
		if ( $url ) {
			$force_q_mark_without_slash = Str::starts_with( $url, '/wp-admin' );
			$step_data['url']           = Dp_Intro_Tours_Helper::unify_url( $url, false, false, true, false, $force_q_mark_without_slash );
		}
		return $step_data;
	}

	private function force_q_mark_without_slash_in_admin_url() {
		$tour_ID = get_the_ID();
		if ( DP_INTRO_TOURS_IS_PRO ) {
			$recreate_res = Dp_Intro_Tours_Helper::recreate_step_table( $tour_ID, null, false, true, null, [ $this, 'force_q_mark_without_slash_in_admin_url_step_props' ] );
			if ( $recreate_res['was_changed'] ) {
				Dp_Intro_Tours_Helper::store_plugin_version( $tour_ID );
				update_field( 'intro_steps', $recreate_res['raw_data'], $tour_ID );
			}
			Dp_Intro_Tours_Helper::update_steps_url( $tour_ID );
		}
	}

	private function rebuild_steps() {
		$tour_ID      = get_the_ID();
		$recreate_res = Dp_Intro_Tours_Helper::recreate_step_table( $tour_ID, null );
		if ( $recreate_res['was_changed'] ) {
			Dp_Intro_Tours_Helper::store_plugin_version( $tour_ID );
			update_field( 'intro_steps', $recreate_res['raw_data'], $tour_ID );
		}
		Dp_Intro_Tours_Helper::update_steps_url( $tour_ID );
	}

	private function _set_steps_url_meta( $tour_ID, $build_type ) {
		switch ( $build_type ) {
			case 'PRO':
				// From FREE to PRO
				$recreate_res = Dp_Intro_Tours_Helper::recreate_step_table( $tour_ID, null, false, true );
				if ( $recreate_res['was_changed'] ) {
					Dp_Intro_Tours_Helper::store_plugin_version( $tour_ID );
					update_field( 'intro_steps', $recreate_res['raw_data'], $tour_ID );
				}
				break;
			case 'FREE':
				// From PRO to FREE
				Dp_Intro_Tours_Helper::update_steps_url( $tour_ID, $build_type );
				break;
		}
	}


	private function go_trough_all_tours( $action_callback = null, $additional_query_args = null, $additional_callback_args = null ) {
		if ( $action_callback ) {
			$args = [
				'post_type'      => 'dp_intro_tours',
				'posts_per_page' => '-1',
				//'post__in'       => [ 4873 ],
			];
			//'post__in' => [4123], 'post__in' => [2313, 2431]
			if ( $additional_query_args ) {
				$args = array_merge( $args, $additional_query_args );
			}
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					call_user_func( $action_callback, $additional_callback_args );
				}
			}
			wp_reset_query();
		}
	}
}

?>
