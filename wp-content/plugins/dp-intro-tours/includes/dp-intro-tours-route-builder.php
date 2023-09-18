<?php
use IntroToursDP\Wp\Acf;
use IntroToursDP\Wp\WpStd;
use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Arr;



add_action( 'rest_api_init', 'dp_builder_register_route' );

function dp_builder_register_route() {
	register_rest_route(
		'dpintrotours/v1',
		'save-changes',
		[
			'methods'             => WP_REST_SERVER::ALLMETHODS,
			'callback'            => 'dpit_save_changes',
			'permission_callback' => function ( $request ) {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	register_rest_route(
		'dpintrotours/v1',
		'delete-tour',
		[
			'methods'             => WP_REST_SERVER::ALLMETHODS, //WP_REST_SERVER::DELETABLE,
			'callback'            => 'dpit_delete_tour',
			'permission_callback' => function ( $request ) {
				return current_user_can( 'delete_posts' );
			},
		]
	);

	register_rest_route(
		'dpintrotours/v1',
		'get-compatible-post',
		[
			'methods'             => WP_REST_SERVER::READABLE,
			'callback'            => 'dpit_get_compatible_post',
			'permission_callback' => function ( $request ) {
				return current_user_can( 'read' );
			},
		]
	);
}

function dpit_delete_tour( $data ) {
	$builder_api_key = $_GET['builder_api_key'];
	if ( $builder_api_key === Dp_Intro_Tours_Helper::get_builder_api_key() ) {
		if ( current_user_can( 'delete_posts' ) ) {
			$parameters = $data->get_params();
			if ( $parameters ) {
				$tourId       = $parameters['tourId'];
				$force_delete = $parameters['forceDelete'];
				if ( $tourId ) {
					wp_delete_post( $tourId, $force_delete );
					return true;
				}
			}
		} else {
			return new WP_Error( 'no_capabilities_to_delete_intro_tours', __( 'You have no capabilities to delete intro tours', 'dp-intro-tours' ), [ 'status' => 401 ] );
		}
		return false;
	}
	wp_die( __( 'Unauthorized! Try it somewhere else!', 'dp-intro-tours' ) );
}

function dpit_get_compatible_post( $data ) {
	$builder_api_key = $_GET['builder_api_key'];
	if ( $builder_api_key === Dp_Intro_Tours_Helper::get_builder_api_key() ) {
		if ( current_user_can( 'read' ) ) {
			$parameters = $data->get_params();
			if ( $parameters && array_key_exists( 'url', $parameters ) ) {
				$post = WpStd::get_post_by_url_path( $parameters['url'] );

				return $post ? $post->ID : null;
			}
			return false;
		} else {
			return new WP_Error( 'no_capabilities_to_edit_intro_tours', __( 'You have no capabilities to edit intro tours', 'dp-intro-tours' ), [ 'status' => 401 ] );
		}
	}
	wp_die( __( 'Unauthorized! Try it somewhere else!', 'dp-intro-tours' ) );
}


function dpit_save_changes( $data ) {
	$builder_api_key = $_GET['builder_api_key'];
	$res             = false;
	if ( $builder_api_key === Dp_Intro_Tours_Helper::get_builder_api_key() ) {
		if ( current_user_can( 'edit_posts' ) ) {
			$parameters = $data->get_params();
			if ( $parameters ) {
				$changes                  = $parameters['stepChanges'];
				$trigger_changes          = $parameters['triggerChanges'];
				$mobile_menu_changes      = $parameters['mobileMenuChanges'];
				$url_var_examples_changes = $parameters['urlVarExamplesChanges'];
				$stepAddedRemovedHist     = $parameters['stepAddedRemovedHist'];
				$tourId                   = $parameters['tourId'];

				$allowedProps       = Dp_Intro_Tours_Helper::get_step_definition_names();
				$step_data          = Acf::get_table_field_as_assoc_array_of_columns( 'intro_steps', $tourId, true ) ?? [];
				$store_step_changes = false;
				if ( isset( $step_data ) ) {

					if ( $stepAddedRemovedHist && count( $stepAddedRemovedHist ) ) {
						$store_step_changes             = true;
						$needToRecalculateRelationships = true;
						foreach ( $stepAddedRemovedHist as $val ) {
							if ( $val['action'] === 'add' ) {
								array_splice( $step_data, $val['idx'], 0, [ [] ] );
							}
							if ( $val['action'] === 'remove' ) {
								array_splice( $step_data, $val['idx'], 1 );
							}
						}
					}
					$needToRecalculateRelationships = false;
					if ( $changes && count( $changes ) ) {
						$store_step_changes = true;
						foreach ( $changes as $stepIdx => $stepChange ) {
							if ( $stepChange && is_array( $stepChange ) ) {
								foreach ( $allowedProps as $propName ) {
									if ( array_key_exists( $propName, $stepChange ) ) {
										$propVal = $stepChange[ $propName ];
										if ( $propName === 'url' ) {
											if ( $propVal != $step_data[ $stepIdx ][ $propName ] ) {
												$needToRecalculateRelationships = true;
											}
										}
										$step_data[ $stepIdx ][ $propName ] = $propVal;
									} elseif ( ! array_key_exists( $propName, $step_data[ $stepIdx ] ) ) {
										$step_data[ $stepIdx ][ $propName ] = '';
									}
								}
							}
						}
					}
					if ( $store_step_changes ) {
						if ( $needToRecalculateRelationships ) {
							Dp_Intro_Tours_Helper::update_pro_url_relationships( $tourId, $step_data );
						}
						foreach ( $step_data as $idx => $step ) {
							$new_url                  = esc_html( $step['url'] );
							$step_data[ $idx ]['url'] = $new_url;
						}
						Acf::update_table_field_from_assoc_array_of_columns_ntn( $step_data, 'intro_steps', $tourId, true, array_keys( $allowedProps ), DP_ACF_TABLE_VERSION );
						Dp_Intro_Tours_Helper::store_plugin_version( $tourId );

					}
					$res = true;
				}

				if ( $trigger_changes && count( $trigger_changes ) ) {
					foreach ( $trigger_changes as $triggerIdx => $triggerChange ) {
						if ( $triggerChange ) {
							switch ( $triggerIdx ) {
								case 0:
									$triggerCfg = Acf::get_field( 'intro_trigger', $tourId, true );
									if ( $triggerCfg && is_array( $triggerCfg ) ) {
										$triggerCfg['intro_trigger_selector'] = $triggerChange;
										update_field( 'intro_trigger', $triggerCfg, $tourId );
										$res = true;
									}
									break;
								case 1:
									$triggerCfg = Acf::get_field( 'intro_trigger_2', $tourId, true );
									if ( $triggerCfg && is_array( $triggerCfg ) ) {
										$triggerCfg['intro_trigger_selector'] = $triggerChange;
										update_field( 'intro_trigger_2', $triggerCfg, $tourId );
										$res = true;
									}
									break;
							}
						}
					}
				}

				if ( $mobile_menu_changes && count( $mobile_menu_changes ) ) {
					foreach ( $mobile_menu_changes as $key => $change ) {
						if ( $change ) {
							switch ( $key ) {
								case 'opener':
									Settings::update_setting_array( 'dp_it_mobile_menu_options', 'opener_selector', $change, true );
									$res = true;
									break;
								case 'closer':
									Settings::update_setting_array( 'dp_it_mobile_menu_options', 'closer_selector', $change, true );
									$res = true;
									break;
							}
						}
					}
				}

				if ( $url_var_examples_changes && count( $url_var_examples_changes ) ) {
					Acf::update_group_field( 'intro_url_variables', 'url_vars_examples', $url_var_examples_changes[0], $tourId );
				}
			}
			return $res;
		} else {
			return new WP_Error( 'no_capabilities_to_edit_intro_tours', __( 'You have no capabilities to edit intro tours', 'dp-intro-tours' ), [ 'status' => 401 ] );
		}
	}
	wp_die( __( 'Unauthorized! Try it somewhere else!', 'dp-intro-tours' ) );
}

?>
