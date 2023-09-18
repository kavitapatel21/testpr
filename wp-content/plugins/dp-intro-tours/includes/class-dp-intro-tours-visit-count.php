<?php

use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Arr;

class Dp_Intro_Tours_Visit_Count {



	public static function process_visit( $user_id ) {
		$visitedData = self::_get_visit_count( $user_id );
		$url         = Arr::get( $visitedData, 'url' );
		$data        = Arr::get( $visitedData, 'data' );
		if ( $url && isset( $data ) ) {
			if ( ! array_key_exists( $url, $data ) ) {
				$data[ $url ] = 0;
			}
			$data[ $url ]++;
			//update_user_meta($user_id, 'dpintro_visits', $data);
			Settings::update_user_data( 'dp_it_user_options', 'dpintro_visits', $user_id, $data );
		}
		return Arr::get( $data, $url, 0 );
	}

	public static function clear_data() {
	}

	private static function _get_visit_count( $user_id ) {
		$current_url = Dp_Intro_Tours_Helper::get_current_url();
		$current_url = Dp_Intro_Tours_Helper::unify_url( $current_url, true, true, true, true );
		//$visit_data = get_user_meta($user_id, 'dpintro_visits', true);
		$visit_data = Settings::get_user_data( 'dp_it_user_options', 'dpintro_visits', $user_id, null );
		if ( ! $visit_data ) {
			$visit_data = [];
		}
		$count = Arr::get( $visit_data, $current_url, 0 );
		return [
			'count' => $count,
			'data'  => $visit_data,
			'url'   => $current_url,
		];
	}

	public static function get_visit_count( $user_id ) {
		return Arr::get( self::_get_visit_count( $user_id ), 'count', 0 );
	}

}
?>
