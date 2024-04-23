<?php

use IntroToursDP\Wp\AdminPromo;
use IntroToursDP\Wp\AdminNotice;



class Dp_Intro_Tours_Admin_Promo {

	public function get_pro_promo_texts() {
		$plugin_PRO_name = '<strong>' . DP_INTRO_TOURS_PRODUCT_TITLE_PRO . '</strong>';
		return [
			//"Thank U for using DP Intro Tours. If U wanna support me to enhance this plugin and develop more FREE stuff, would be great ",
			sprintf( __( "Yes! You don't need to limit yourself to single-page intro tour only. %s can rock your whole web up !!", 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'Do you want to target the main menu elements? With %s it will also play well in mobile view. Thanks to our visual builder, its setup is easy and intuitive :)', 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'Do you want to skip some step or even select another target element depending on whether the step is displayed on a mobile or widescreen? You can do so with %s. Thanks to our visual builder, its setup is easy and intuitive :)', 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( "In %s, you can choose from 5 fancy design themes. Therefore, you can precisely match the vibe of your web. In addition, you can override default tour's behavior, theme, accent color and font for each tour separately :)", 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'Would you like to send an intro tour invitation just for a specific people? May you want to give a try to %s and boost this feature.', 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'In the %s version, you can insert WP short-codes in intro tips and make the tour a much more complex tool.', 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'In %s you can setup simultaneously 2 trigger configurations for each tour. Therefore you can combine their settings and cover huge amount of use cases. E.g. run automatically but just in case of first visit of particular visitor together with starting when an info button is pressed :)', 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'Would you like your visitors to take a tour of variable URL sites, such as a tour of all product detail pages and its sub-pages, or user public dashboards? In %s you have opportunity to do so.', 'dp-intro-tours' ), $plugin_PRO_name ),
			sprintf( __( 'Would you like to offer your co-workers or those who have access to web administration interactive tutorials on how to use the WordPress admin board and all your custom integrated modules on it? In %s you can easily create a tour also on the back-end side.', 'dp-intro-tours' ), $plugin_PRO_name ),

		];
	}
	/*
	public static function get_a4r_texts(){
		return 	[
			'ok'          => __( 'OK, you deserved it', 'dp-intro-tours' ),
			'already-did' => __( 'I already did', 'dp-intro-tours' ),
			'no-good'     => __( 'No, not good enough', 'dp-intro-tours' ),
			'a4r-suggestion' => Dp_Intro_Tours_Helper::get_generic_i18n('a4r-suggestion')
		];
	}*/

	public function add_admin_notice() {
		$screen = get_current_screen();

		AdminPromo::backward_comp_add_activated_options( 'dp_it_basic_options' );
		if ( ! $screen ) {
			return;
		}
		Dp_Intro_Tours_Helper::try_render_upgrade_notice();
		$a4r_notice_id   = DP_INTRO_TOURS_PREFIX . '-a4r-notice';
		$activated_weeks = floor( AdminPromo::get_activated_days( 'dp_it_basic_options', 0 ) / 7 );
		switch ( $screen->base ) {
			case 'dashboard':
				if ( AdminPromo::is_right_time_for_ask_4_rating( 13, $a4r_notice_id, 'dp_it_basic_options' ) ) {
					AdminNotice::render_ask_for_rating_notice(
						$activated_weeks,
						DP_INTRO_TOURS_NAME,
						DP_INTRO_TOURS_PRODUCT_ASK_FOR_RATING_LINK_FREE,
						$a4r_notice_id,
						plugin_dir_url( __FILE__ ) . '../includes/assets/images/5-stars-500x116.png',
						'5 stars',
						'dpit-notice',
						'dpit-a4r-5star-img'
					);
				} elseif ( $this->is_right_time_for_pro_promo( 7, 55 ) ) {
					$this->render_random_promo_notice();
				}
				break;
			case 'post':
			case 'edit':
				if ( $screen->post_type === 'dp_intro_tours' ) {
					if ( AdminPromo::is_right_time_for_ask_4_rating( 8, $a4r_notice_id, 'dp_it_basic_options' ) ) {
						AdminNotice::render_ask_for_rating_notice(
							$activated_weeks,
							DP_INTRO_TOURS_NAME,
							DP_INTRO_TOURS_PRODUCT_ASK_FOR_RATING_LINK_FREE,
							$a4r_notice_id,
							plugin_dir_url( __FILE__ ) . '../includes/assets/images/5-stars-500x116.png',
							'5 stars',
							'dpit-notice',
							'dpit-a4r-5star-img'
						);
					} elseif ( $this->is_right_time_for_pro_promo( 4, 94 ) ) {
						$this->render_random_promo_notice();
					}
				}
				break;
		}
	}

	public function render_random_promo_notice() {
		$promo_texts = $this->get_pro_promo_texts();
		if ( $promo_texts && count( $promo_texts ) ) {
			$text_idx = wp_rand( 0, count( $promo_texts ) - 1 );
			$text     = $promo_texts[ $text_idx ];
			AdminNotice::render_notice(
				$text,
				'success',
				true,
				$text_idx !== 2 ? DP_INTRO_TOURS_PRODUCT_LINK_PRO : DP_INTRO_TOURS_PRODUCT_LINK_PRO . '#dp-intro-tours-themes',
				'button button-primary button-pro-promo dpit-notice__button--upper-case',
				__( 'Upgrade Now', 'dp-intro-tours' ),
				true,
				__( '15% just for you with coupon code: VBVHUUR9', 'dp-intro-tours' ),
				'dpit-notice'
			);
		}
	}

	public function is_right_time_for_pro_promo( $minDaysActivated, $randomChance, $cookie_name = '' ) {
		if ( AdminPromo::is_right_time_for_random( $minDaysActivated, $randomChance, 'dp_it_basic_options', $cookie_name ) ) {
			$args = [
				'post_type'      => 'dp_intro_tours',
				'order'          => 'DESC',
				'orderby'        => 'date',
				'posts_per_page' => '1',
				'meta_key'       => 'intro_enabled',
				'meta_value'     => '1',
				'post_status'    => 'publish',
			];

			$query = new WP_Query( $args );
			$count = $query->post_count;
			wp_reset_query();
			return $count > 0;
		}
		return false;
	}
}
?>
