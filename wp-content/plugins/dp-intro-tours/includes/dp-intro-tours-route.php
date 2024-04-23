<?php

use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Arr;


add_action( 'rest_api_init', 'dpit_admin_register_route' );

function dpit_admin_register_route() {
	register_rest_route(
		'dpintrotours/v1',
		'update-dp-basic-options',
		[
			'methods'             => WP_REST_SERVER::ALLMETHODS,
			'callback'            => 'dpit_update_dp_options',
			'permission_callback' => function ( $request ) {
				return current_user_can( 'edit_posts' );
			},
		]
	);
	register_rest_route(
		'dpintrotours/v1',
		'trigger-action',
		[
			'methods'             => WP_REST_SERVER::ALLMETHODS,
			'callback'            => 'dpit_trigger_action',
			'permission_callback' => function ( $request ) {
				return current_user_can( 'edit_posts' );
			},
		]
	);
	register_rest_route(
		'dpintrotours/v1',
		'set-transient',
		[
			'methods'             => WP_REST_SERVER::ALLMETHODS,
			'callback'            => 'dpit_set_transient_from_js',
			'permission_callback' => function ( $request ) {
				return is_user_logged_in();
			},
		]
	);
	/* register_rest_route('dpintrotours/v1', 'set-user-data', [
	'methods' => WP_REST_SERVER::ALLMETHODS,
	'callback' => 'dpit_set_user_data',
	'permission_callback' => function($request){
	return is_user_logged_in();
	},
	]);*/
}

function dpit_set_user_data( $data ) {

	$parameters = $data->get_params();
	if ( $parameters ) {
		$value = Arr::get( $parameters, 'value' );
		$key   = Arr::get( $parameters, 'key' );
		if ( $key ) {
			Settings::update_user_data( 'dp_it_user_options', $key, get_current_user_id(), $value );
			return true;
		}
	}
	wp_die();
}

function dpit_trigger_action( $data ) {
	$parameters = $data->get_params();
	if ( $parameters ) {
		$action_name = Arr::get( $parameters, 'actionName' );
		switch ( $action_name ) {
			case 'clear_visit_count':
				if ( current_user_can( 'edit_users' ) ) {
					Settings::delete_user_data( 'dp_it_user_options', 'dpintro_visits' );
					return true;
				}
		}
	}
}

function dpit_update_dp_options( $data ) {
	$parameters = $data->get_params();
	if ( $parameters ) {
		unset( $parameters['builder_api_key'] );
		$options = get_option( 'dp_it_basic_options', [] );
		$options = array_merge( $options, $parameters );
		update_option( 'dp_it_basic_options', $options );
	}
	wp_die();
}


function dpit_set_transient_from_js( $data ) {
	$parameters = $data->get_params();
	$res        = false;
	if ( $parameters ) {
		$transient_id = Dp_Intro_Tours_Helper::get_transient_id( $parameters['name'] );
		$transient    = get_transient( $transient_id );
		if ( $transient !== false ) {
			delete_transient( $transient_id );
		}
		$res = set_transient( $transient_id, $parameters['transientData'], $parameters['expirationS'] );
		if ( $res ) {
			return $res;
		}
	}
	wp_die();
}

?>
