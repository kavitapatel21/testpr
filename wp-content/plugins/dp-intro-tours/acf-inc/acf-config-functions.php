<?php

use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Str;
use IntroToursDP\Std\Core\Path;


define( 'DP_INTRO_TOURS_PRO_ONLY_CLASS', 'dpit-pro-only' );
define( 'DP_INTRO_TOURS_SPACER', '<br>' );
define( 'DP_INTRO_TOURS_PRO_ONLY_HIDDEN_CLASS', 'dpit-pro-only dpit-pro-only--hidden' );
define( 'DP_INTRO_TOURS_PRO_ONLY_NO_EVENTS_CLASS', 'dpit-pro-only dpit-pro-only--no-event' );
define( 'DP_INTRO_TOURS_PRO_POSTFIX', ( ! DP_INTRO_TOURS_IS_PRO ? ' (<span class="dpit-pro-postfix">PRO<span>)' : '' ) );
define( 'DP_INTRO_TOURS_PRODUCT_FEATURES_LINK_PRO_A_TAG', '<a href="' . DP_INTRO_TOURS_PRODUCT_FEATURES_LINK_PRO . '" target="_blank">' . __( 'check out the PRO version', 'dp-intro-tours' ) . '</a>' );



function dpit_acf_print_default_val( $default_val ) {
	return DP_INTRO_TOURS_SPACER . __( 'default', 'dp-intro-tours' ) . ': ' . $default_val;
}

function dpit_init_acf_cfg() {
	if ( ! function_exists( 'get_editable_roles' ) ) {
		require_once ABSPATH . 'wp-admin/includes/user.php';
	}
	$editable_roles      = [];
	$editable_roles_data = get_editable_roles();
	if ( $editable_roles_data ) {
		foreach ( $editable_roles_data as $key => $data ) {
			$editable_roles[ $key ] = $data['name'];
		}
	}
	acf_add_local_field_group(
		[
			'key'                   => 'group_5e4c8efda20c2',
			'title'                 => __( 'Tour Options', 'dp-intro-tours' ) . ( DP_INTRO_TOURS_IS_PRO ? ' (PRO)' : '' ),
			'fields'                => array_filter(
				[
					[
						'key'               => 'field_5e4c8efdab990',
						'label'             => __( 'Activate', 'dp-intro-tours' ),
						'name'              => 'intro_enabled',
						'type'              => 'true_false',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => 'acf-field--main',
							'id'    => '',
						],
						'message'           => __( 'When tour is deactivated, you can still edit it with visual builder, however it is not executed for public.', 'dp-intro-tours' ),
						'default_value'     => '0',
						'ui'                => 1,
						'ui_on_text'        => __( 'Active', 'dp-intro-tours' ),
						'ui_off_text'       => __( 'Inactive', 'dp-intro-tours' ),
					],

					dpit_get_acf_design_config( Dp_Intro_Tours_Helper::get_themes_select_options( false ) ),
					dpit_get_acf_behavior_config(),
					dpit_get_acf_trigger_config( 0, $editable_roles ),

					[
						'key'               => 'field_6e5c8efdcfc27',
						'label'             => __( 'Additional Trigger', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
						'name'              => 'add_additional_trigger',
						'type'              => 'true_false',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => 'acf-field--main ' . DP_INTRO_TOURS_PRO_ONLY_CLASS,
							'id'    => '',
						],
						'message'           => __( 'Add second trigger so you can combine their settings and cover huge amount of use cases. E.g. run automatically but just in case of first visit of particular user together with starting when an info button is pressed.', 'dp-intro-tours' ),
						'default_value'     => 0,
						'ui'                => 1,
						'ui_on_text'        => __( 'Enabled', 'dp-intro-tours' ),
						'ui_off_text'       => __( 'Disabled', 'dp-intro-tours' ),
					],
					DP_INTRO_TOURS_IS_PRO ? dpit_get_acf_trigger_config( 1, $editable_roles ) : null,
					[
						'key'               => 'field_5e4c8efdcfc17',
						'label'             => __( 'Steps', 'dp-intro-tours' ),
						'name'              => 'intro_steps',
						'type'              => 'table',
						'instructions'      => __( 'Define Your tour step by step', 'dp-intro-tours' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => 'acf-field--no-info-icon acf-field--main',
							'id'    => '',
						],
						'use_header'        => 1,
						'use_caption'       => 2,
					],
					dpit_get_acf_labeling_config(),
					dpit_get_acf_url_vars_config(),
				]
			),
			'location'              => [
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'dp_intro_tours',
					],
				],
			],
			'menu_order'            => 0,
			'position'              => 'acf_after_title',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		]
	);

	dpit_init_acf_cfg_helper();
}

function dpit_init_acf_cfg_helper() {
	acf_add_local_field_group(
		[
			'key'                   => 'group_5e4c5f78c342c',
			'title'                 => 'Intro tour - helper',
			'fields'                => [
				[
					'key'               => 'field_5a4c6efdb55d2',
					'label'             => 'Steps url unified',
					'name'              => 'steps_url_unified_serialized',
					'type'              => 'textarea',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '100',
						'class' => 'acf-field--no-info-icon',
						'id'    => '',
					],
					'default_value'     => '',
					'placeholder'       => '',
					'maxlength'         => '',
					'rows'              => '',
					'new_lines'         => '',
				],
				[
					'key'               => 'field_5f7795cf760c7',
					'label'             => __( 'Start URL count', 'dp-intro-tours' ),
					'name'              => 'start_url_cnt',
					'type'              => 'number',
					'instructions'      => __( 'Defines how many start urls the tour has', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'default_value'     => 1,
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'min'               => 0,
					'max'               => PHP_INT_MAX,
					'step'              => 1,
				],
				[
					'key'               => 'field_5a4c6eedb55d2',
					'label'             => 'Steps url relative',
					'name'              => 'steps_url_relative_serialized',
					'type'              => 'textarea',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '100',
						'class' => 'acf-field--no-info-icon',
						'id'    => '',
					],
					'default_value'     => '',
					'placeholder'       => '',
					'maxlength'         => '',
					'rows'              => '',
					'new_lines'         => '',
				],
				[
					'key'               => 'field_5e4c8efdb55d2',
					'label'             => 'Plugin Version',
					'name'              => 'plugin_version',
					'type'              => 'text',
					'instructions'      => 'Store version of plugin which updated current intro tour last time.',
					'required'          => 0,
					'conditional_logic' => '',
					'wrapper'           => [
						'width' => '',
						'class' => 'acf-field--no-info-icon',
						'id'    => '',
					],
					'default_value'     => '',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				],
			],
			'location'              => [
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'dp_intro_tours',
					],
				],
			],
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => DP_INTRO_TOURS_DP_ADMIN_DEBUG_EN,
			'description'           => '',
		]
	);
}

function dpit_get_acf_cfg_trigger_choices() {
	$res = [
		'click'       => __( 'Mouse click', 'dp-intro-tours' ),
		'mousedown'   => __( 'Press mouse button', 'dp-intro-tours' ),
		'mouseup'     => __( 'Release mouse button', 'dp-intro-tours' ),
		'dblclick'    => __( 'Mouse double-click', 'dp-intro-tours' ),
		'mouseover'   => __( 'Mouse hover over element', 'dp-intro-tours' ),
		'mousewheel'  => __( 'Mouse wheel action', 'dp-intro-tours' ),
		'mouseout'    => __( 'Mouse cursor leaving the element', 'dp-intro-tours' ),
		'contextmenu' => __( 'Context menu open', 'dp-intro-tours' ),
		'inviewport'  => ( DP_INTRO_TOURS_IS_PRO ) ? __( 'Element is scrolled in viewport', 'dp-intro-tours' ) : null,
		'touchstart'  => __( 'Touch start', 'dp-intro-tours' ),
		'touchmove'   => __( 'Touch move', 'dp-intro-tours' ),
		'touchend'    => __( 'Touch end', 'dp-intro-tours' ),
		'touchcancel' => __( 'Touch cancel', 'dp-intro-tours' ),
		'keydown'     => __( 'Keyboard key down', 'dp-intro-tours' ),
		'keypress'    => __( 'Keyboard key press', 'dp-intro-tours' ),
		'keyup'       => __( 'Keyboard key up', 'dp-intro-tours' ),
		'focus'       => __( 'Form become focused', 'dp-intro-tours' ),
		'blur'        => __( 'Form lose focus', 'dp-intro-tours' ),
		'change'      => __( 'Form changed (typing ... )', 'dp-intro-tours' ),
		'submit'      => __( 'Form was submitted', 'dp-intro-tours' ),
	];
	return array_filter( $res );
}

function dpit_get_editable_roles() {
	global $wp_roles;

	$all_roles      = $wp_roles->roles;
	$editable_roles = apply_filters( 'editable_roles', $all_roles );

	return $editable_roles;
}

function dpit_get_acf_trigger_config( $idx = 0, $editable_roles = [] ) {

	$trigger_object_page_is_defined_text = ( DP_INTRO_TOURS_IS_PRO )
	? __( 'The page is defined by Page/Post/CPT URL of the first intro step in STEPS table.', 'dp-intro-tours' )
	: __( 'The page is defined by Page / Post / Product option above.', 'dp-intro-tours' );

	$mobile_breakpoint = Settings::get_setting_array_field( 'dp_it_mobile_breakpoints_options', 'mobile', '480' );

	$query_params_defs = Dp_Intro_Tours_Helper::get_dp_intro_query_params( false );

	$res = [
		'key'               => $idx === 0 ? 'field_5e4c8efdabd76' : 'field_6e4c8efdabd76',
		'label'             => $idx === 0 ? __( 'Trigger', 'dp-intro-tours' ) : __( 'Trigger 2', 'dp-intro-tours' ),
		'name'              => $idx === 0 ? 'intro_trigger' : 'intro_trigger_2',
		'type'              => 'group',
		'instructions'      => __( 'Defines where and how this tour will start.', 'dp-intro-tours' ),
		'required'          => 0,
		'conditional_logic' => $idx === 0 ? '' : [
			[
				[
					'field'    => 'field_6e5c8efdcfc27',
					'operator' => '!=',
					'value'    => 0,
				],
			],
		],
		'wrapper'           => [
			'width' => '',
			'class' => '',
			'id'    => '',
		],
		'layout'            => 'block',
		'sub_fields'        => array_filter(
			[
				[
					'key'               => $idx === 0 ? 'field_5e4c8efdb4a15' : 'field_6e4c8efdb4a15',
					'label'             => __( 'First User Visit Only', 'dp-intro-tours' ),
					'name'              => 'first_user_visit_only',
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'message'           => __( "Run an initial tour only on a user's first visit.", 'dp-intro-tours' ),
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => '',
					'ui_off_text'       => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e4e6af65230f' : 'field_6e3367f65230f',
					'label'             => __( 'First N Visits Only', 'dp-intro-tours' ),
					'name'              => 'first_n_user_visit',
					'type'              => 'number',
					'instructions'      => __( "Run the initial tour only on the user's first N visits.", 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb4a15' : 'field_6e4c8efdb4a15',
								'operator' => '==',
								'value'    => 1,
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'default_value'     => 1,
					'placeholder'       => __( 'First N visits', 'dp-intro-tours' ),
					'prepend'           => '',
					'append'            => '',
					'min'               => 1,
					'max'               => '',
					'step'              => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e56b493fb1b9' : 'field_6e56b493fb1b9',
					'label'             => __( 'Lock by URL Parameter', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
					'name'              => 'lock_by_url_parameter',
					'type'              => 'true_false',
					'instructions'      => __( 'You can send intro tour invitation to specific person only by sending a tour start URL with an unlock parameter', 'dp-intro-tours' )
						. DP_INTRO_TOURS_SPACER
						. __( 'E.g. for tour starting on the home page:', 'dp-intro-tours' ) . ' www.your-home-page-address.com/?<strong>' . Dp_Intro_Tours_Helper::set_dp_url_param( 'dp_qp_lock', $query_params_defs, 'Your Unlock Key', false ) . '</strong>' // dp_to_check
						. DP_INTRO_TOURS_SPACER
						. __( 'If you want the tour to start as soon as the visitor clicks on the link sent to them, then set options below as Trigger Object = Whole Page and Page Event = Page load.', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS,
						'id'    => '',
					],
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => __( 'Locked', 'dp-intro-tours' ),
					'ui_off_text'       => __( 'Unlocked', 'dp-intro-tours' ),
				],
				[
					'key'               => $idx === 0 ? 'field_6e4c2eedb15d0' : 'field_6eec2eed515d0',
					'label'             => __( 'Unlock key', 'dp-intro-tours' ),
					'name'              => 'intro_tour_key_unlock',
					'type'              => 'text',
					'instructions'      => sprintf( __( 'Defines a URL key to unlock the tour for selected users only. The tour only starts for users to whom you submit a URL with a key in the form of the %s parameter.', 'dp-intro-tours' ), '<strong>' . Dp_Intro_Tours_Helper::set_dp_url_param( 'dp_qp_lock', $query_params_defs, 'Your Unlock Key', false ) . '</strong>' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e56b493fb1b9' : 'field_6e56b493fb1b9',
								'operator' => '==',
								'value'    => '1',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => DP_INTRO_TOURS_PRO_ONLY_HIDDEN_CLASS,
						'id'    => '',
					],
					'default_value'     => 'my_url_key_12345',
					'placeholder'       => __( 'my_url_key_12345', 'dp-intro-tours' ),
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e52b493fb1f9' : 'field_5e56b493cb1f9',
					'label'             => __( 'Allow Just for Logged in Users', 'dp-intro-tours' ),
					'name'              => 'allow_just_for_logged_in_users',
					'type'              => 'true_false',
					'instructions'      => __( 'Enable this setting if you want to run the tour ONLY for logged in / registered users. It works together with', 'dp-intro-tours' ) . ' <strong>' . __( 'First N Visits Only', 'dp-intro-tours' ) . '</strong> ' . __( 'option and counts logged in visits separately.', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
					'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
				],
				[
					'key'               => $idx === 0 ? 'field_61faad1aa7efe' : 'field_61aaad1aa7efe',
					'label'             => __( 'Disable for User Roles', 'dp-intro-tours' ),
					'name'              => 'disable_for_roles',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0, /*[
						[
							[
								'field'    => $idx === 0 ? 'field_5e52b493fb1f9' : 'field_5e56b493cb1f9',
								'operator' => '==',
								'value'    => '1',
							],
						],
					]*/
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'choices'           => $editable_roles,
					'default_value'     => [],
					'allow_null'        => 0,
					'multiple'          => 1,
					'ui'                => 1,
					'ajax'              => 0,
					'return_format'     => 'value',
					'placeholder'       => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e52b4935b1f9' : 'field_5ea6b493cb1f9',
					'label'             => __( 'Enable for Mobile Phones', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
					'name'              => 'allow_for_mobile',
					'type'              => 'true_false',
					'instructions'      => sprintf( __( 'To disable the tour for mobile phones with a screen width of less then or equal to %d pixels, turn off this setting. You can adjust the mobile screen width limit in the global settings of the plugin.', 'dp-intro-tours' ), $mobile_breakpoint ),
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS,
						'id'    => '',
					],
					'message'           => '',
					'default_value'     => 1,
					'ui'                => 1,
					'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
					'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
				],
				[
					'key'               => $idx === 0 ? 'field_5e52b4915b1f9' : 'field_5ea62493cb1f9',
					'label'             => __( 'Enable for Wide Screens', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
					'name'              => 'allow_for_wide_screens',
					'type'              => 'true_false',
					'instructions'      => sprintf( __( 'To disable the tour for devices with a screen larger than %d pixels, turn off this setting. You can adjust the mobile screen width limit in the global settings of the plugin.', 'dp-intro-tours' ), $mobile_breakpoint ),
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS,
						'id'    => '',
					],
					'message'           => '',
					'default_value'     => 1,
					'ui'                => 1,
					'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
					'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
				],
				( $idx === 0 ) ? [
					'key'               => 'field_5e56b493fb1f9',
					'label'             => __( 'Global Start at All Pages', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
					'name'              => 'global_start_at_all_pages',
					'type'              => 'true_false',
					'instructions'      => __( 'To run this tour globally on all pages, turn this setting on.', 'dp-intro-tours' )
						. DP_INTRO_TOURS_SPACER
						. __( 'ADVANCED: You can filter where to start with our', 'dp-intro-tours' )
						. ' <a href="' . DP_INTRO_TOURS_API_DOC . '" target="_blank">'
						. __( 'API ( PHP & JS )', 'dp-intro-tours' )
						. '</a>',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS . ( ( DP_INTRO_TOURS_IS_PRO ) ? ' acf-field--ia' : '' ),
						'id'    => '',
					],
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
					'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
				] : null,
				( ! DP_INTRO_TOURS_IS_PRO && $idx === 0 ) ? [
					'key'               => 'field_5e4aec4c9c300',
					'label'             => __( 'Pages / Posts / Products', 'dp-intro-tours' ) . ' / ' . ( ( ! DP_INTRO_TOURS_IS_PRO ) ? '<a class="' . DP_INTRO_TOURS_PRO_ONLY_CLASS . '">' : '' ) . __( 'Custom Post Types, Variable URL', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX . ( ( ! DP_INTRO_TOURS_IS_PRO ) ? '</a>' : '' ),
					'name'              => 'intro_related_posts',
					'type'              => 'page_link',
					'instructions'      => __( 'Defines the pages / posts / products where the introductory tour should start.', 'dp-intro-tours' )
					. ( ( ! DP_INTRO_TOURS_IS_PRO ) ? DP_INTRO_TOURS_SPACER . __( 'To run it on other custom types, or use variable url eg. run at all product pages:', 'dp-intro-tours' )
					. DP_INTRO_TOURS_SPACER . '<em>/product/{product-id}</em>' . DP_INTRO_TOURS_SPACER . __( 'please', 'dp-intro-tours' )
					. ' ' . DP_INTRO_TOURS_PRODUCT_FEATURES_LINK_PRO_A_TAG : '' ),
					'required'          => 0,
					'conditional_logic' => DP_INTRO_TOURS_IS_PRO ? [
						[
							[
								'field'    => 'field_5e56b493fb1f9',
								'operator' => '==',
								'value'    => '0',
							],
						],
					] : 0,
					'wrapper'           => [
						'width' => '',
						'class' => DP_INTRO_TOURS_IS_PRO ? '' : 'acf-field--ia',
						'id'    => '',
					],
					'post_type'         => ! DP_INTRO_TOURS_IS_PRO ? [
						0 => 'post',
						1 => 'page',
						2 => 'product',
					] : null,
					'taxonomy'          => '',
					'allow_null'        => 0,
					'allow_archives'    => 1,
					'multiple'          => 1,
				] : null,
				[
					'key'               => $idx === 0 ? 'field_5e4c8efdb51e3' : 'field_6e4c8efdb51e3',
					'label'             => __( 'Trigger Object', 'dp-intro-tours' ),
					'name'              => 'trigger_object',
					'type'              => 'radio',
					'instructions'      => __( 'Specifies the type of trigger:', 'dp-intro-tours' ) . DP_INTRO_TOURS_SPACER . ' • ' . __( 'WHOLE PAGE: page load, window resize etc.', 'dp-intro-tours' ) . ' ' . $trigger_object_page_is_defined_text . DP_INTRO_TOURS_SPACER . ' • ' . __( "CUSTOM SELECTOR: e.g. '.button or #btn' ( defined manually as css selector or visually by our frontend builder).", 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'choices'           => [
						'page'            => __( 'Whole page (eg when loading a page)', 'dp-intro-tours' ),
						'custom_selector' => __( 'Custom selector - visual selection (eg when clicking on a button)', 'dp-intro-tours' ),
					],
					'allow_null'        => 0,
					'other_choice'      => 0,
					'default_value'     => $idx === 0 ? 'page' : 'custom_selector',
					'layout'            => 'horizontal',
					'return_format'     => 'value',
					'save_other_choice' => 0,
				],
				[
					'key'               => $idx === 0 ? 'field_5e4c8efdb55d0' : 'field_6e4c8efdb55d0',
					'label'             => __( 'Selector', 'dp-intro-tours' ),
					'name'              => 'intro_trigger_selector',
					'type'              => 'text',
					'instructions'      => __( 'Defines the CSS selector for the element (button) that is responsible for initiating this tour.', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb51e3' : 'field_6e4c8efdb51e3',
								'operator' => '!=',
								'value'    => 'page',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'default_value'     => '',
					'placeholder'       => __( 'Specify a DOM element as a trigger', 'dp-intro-tours' ),
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e4c8efdb59b4' : 'field_6e4c8efdb59b4',
					'label'             => __( 'Event', 'dp-intro-tours' ),
					'name'              => 'intro_trigger_event',
					'type'              => 'select',
					'instructions'      => __( 'Defines the type of event that is used as a starter (on specified element by Selector field above)', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb51e3' : 'field_6e4c8efdb51e3',
								'operator' => '!=',
								'value'    => 'page',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'choices'           => dpit_get_acf_cfg_trigger_choices(),
					'default_value'     => [
						0 => 'click',
					],
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 1,
					'ajax'              => 0,
					'return_format'     => 'value',
					'placeholder'       => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e4e67f65130f' : 'field_6e4e47f65230f',
					'label'             => __( 'Code of Pressed Key', 'dp-intro-tours' ),
					'name'              => 'specific_key_pressed',
					'type'              => 'number',
					'instructions'      => __( "Code of keyboard key, that needs to be pressed to activate trigger. Default empty or '0' -> all keys activate trigger. You can find your keycode here: ", 'dp-intro-tours' ) . '<a href="https://www.w3.org/2002/09/tests/keys.html" target="_blank">Keycode info</a>',
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb59b4' : 'field_6e4c8efdb59b4',
								'operator' => '==',
								'value'    => 'keydown',
							],
						],
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb59b4' : 'field_6e4c8efdb59b4',
								'operator' => '==',
								'value'    => 'keypress',
							],
						],
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb59b4' : 'field_6e4c8efdb59b4',
								'operator' => '==',
								'value'    => 'keyup',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => 'acf-field--ia acf-field--key-code',
						'id'    => '',
					],
					'default_value'     => '',
					'placeholder'       => __( 'Keyboard key code', 'dp-intro-tours' ),
					'prepend'           => '',
					'append'            => '',
					'min'               => 0,
					'max'               => '',
					'step'              => '',
				],
				[
					'key'               => $idx === 0 ? 'field_5e4c8efdb5d9f' : 'field_6e4c8efdb5d9f',
					'label'             => __( 'Page Event', 'dp-intro-tours' ),
					'name'              => 'intro_trigger_event_window',
					'type'              => 'select',
					'instructions'      => __( 'Defines the type of event that is used as a trigger. (page load, page scroll, page resize)', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb51e3' : 'field_6e4c8efdb51e3',
								'operator' => '==',
								'value'    => 'page',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'choices'           => [
						'load'   => __( 'Page load', 'dp-intro-tours' ),
						'scroll' => __( 'Page scroll', 'dp-intro-tours' ),
						'resize' => __( 'Page resize', 'dp-intro-tours' ),
					],
					'default_value'     => [
						0 => 'load',
					],
					'allow_null'        => 0,
					'multiple'          => 0,
					'ui'                => 1,
					'ajax'              => 0,
					'return_format'     => 'value',
					'placeholder'       => '',
				],

				( DP_INTRO_TOURS_IS_PRO ) ? [
					'key'               => $idx === 0 ? 'field_5e4e67f65230f' : 'field_6e4e67f65230f',
					'label'             => __( 'In View Port Offset', 'dp-intro-tours' ),
					'name'              => 'in_view_port_offset',
					'type'              => 'number',
					'instructions'      => __( "By default, the tour starts when the top of the element hits the top of the window. But what if we want to start a tour when the element is, for example, 20px from above? Just use this option and set a number without 'px' or '%'. The unit is selected in the field below.", 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb59b4' : 'field_6e4c8efdb59b4',
								'operator' => '==',
								'value'    => 'inviewport',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'default_value'     => 0,
					'placeholder'       => __( 'Offset in pixels or %', 'dp-intro-tours' ),
					'prepend'           => '',
					'append'            => '',
					'min'               => '',
					'max'               => '',
					'step'              => '',
				] : null,
				( DP_INTRO_TOURS_IS_PRO ) ? [
					'key'               => $idx === 0 ? 'field_5e4e697552310' : 'field_6e4e697552310',
					'label'             => __( 'In View Port Offset Unit', 'dp-intro-tours' ),
					'name'              => 'in_view_port_offset_unit',
					'type'              => 'radio',
					'instructions'      => __( 'Specifies unit of In View Port Offset option.', 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb59b4' : 'field_6e4c8efdb59b4',
								'operator' => '==',
								'value'    => 'inviewport',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'choices'           => [
						''  => 'px',
						'%' => '%',
					],
					'allow_null'        => 0,
					'other_choice'      => 0,
					'default_value'     => 'px',
					'layout'            => 'horizontal',
					'return_format'     => 'value',
					'save_other_choice' => 0,
				] : null,
				[
					'key'               => $idx === 0 ? 'field_5e4dcb233ca1a' : 'field_6e4dcb233ca1a',
					'label'             => __( 'Once Per Starting Page Load', 'dp-intro-tours' ),
					'name'              => 'once_per_session_only',
					'type'              => 'true_false',
					'instructions'      => __( "E.g. if 'Event' is set as 'Element is scrolled in viewport', tour won't start, when element is scrolled in view for second time, after previous tour has finished.", 'dp-intro-tours' ),
					'required'          => 0,
					'conditional_logic' => [
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb51e3' : 'field_6e4c8efdb51e3',
								'operator' => '!=',
								'value'    => 'page',
							],
						],
						[
							[
								'field'    => $idx === 0 ? 'field_5e4c8efdb5d9f' : 'field_6e4c8efdb5d9f',
								'operator' => '!=',
								'value'    => 'load',
							],
						],
					],
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'message'           => __( 'Run intro tour only once during current webpage load.', 'dp-intro-tours' ),
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => '',
					'ui_off_text'       => '',
				],
			]
		),
	];
	return $res;
}

function dpit_get_acf_behavior_config() {
	return [
		'key'               => 'field_5f77156b760c6',
		'label'             => __( 'Behavior', 'dp-intro-tours' ),
		'name'              => 'dp_tour_behaviour',
		'type'              => 'group',
		'instructions'      => __( 'Adjusts tour\'s behaviour.', 'dp-intro-tours' ),
		'required'          => 0,
		'conditional_logic' => 0,
		'wrapper'           => [
			'width' => '',
			'class' => '',
			'id'    => '',
		],
		'layout'            => 'block',
		'sub_fields'        => [
			[
				'key'               => 'field_5f74566bbe6e9',
				'label'             => __( 'Show bullet navigation', 'dp-intro-tours' ),
				'name'              => 'show_bullet_navigation',
				'type'              => 'true_false',
				'instructions'      => __( 'Turn this setting off to hide bullet navigation feature for this tour', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 1,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f74566bbe6e7',
				'label'             => __( 'Show progress bar', 'dp-intro-tours' ),
				'name'              => 'show_progress_bar',
				'type'              => 'true_false',
				'instructions'      => __( 'Turn this setting off to hide progress bar feature for this tour', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f74566bbe6e1',
				'label'             => __( 'Show step numbers', 'dp-intro-tours' ),
				'name'              => 'show_step_numbers',
				'type'              => 'true_false',
				'instructions'      => __( 'Turn this setting off to hide step number badges for this tour', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 1,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f74566bbe6e2',
				'label'             => __( 'Disable Exit on Overlay Click', 'dp-intro-tours' ),
				'name'              => 'disable_exit_on_backdrop_click',
				'type'              => 'true_false',
				'instructions'      => __( 'Turn this setting on to disable the end of the tour when the user clicks on the overlay.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 1,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f74566bce6e2',
				'label'             => __( 'Should Be Content Under Overlay Blurred?', 'dp-intro-tours' ),
				'name'              => 'overlay_blurred',
				'type'              => 'true_false',
				'instructions'      => __( 'If on, surrounding of targeted element is underemphasized by blur filter instead of dimming.', 'dp-intro-tours' )
				 . '<br><br><strong>' . __( 'This feature hasn\'t been supported by all browsers yet.', 'dp-intro-tours' ) . '</strong>',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'Yes', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'No', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f77379ebe6e4',
				'label'             => __( 'Increment Step After Reload', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
				'name'              => 'increment_step_after_reload',
				'type'              => 'true_false',
				'instructions'      => __( 'Submission of non-AJAX forms support.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS,
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f77a79ebe6e4',
				'label'             => __( 'Skip Absent Ref. Element', 'dp-intro-tours' ),
				'name'              => 'skip_absent_ref_el',
				'type'              => 'true_false',
				'instructions'      => __( 'Skip a step whose reference element is not on the page or is hidden.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f77379abe6e4',
				'label'             => __( 'Strict URL Compare', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
				'name'              => 'strict_url_compare',
				'type'              => 'true_false',
				'instructions'      => __( 'If On, the URLs of the next step are strictly compared - query parameters included. It reloads between 2 steps with the same URL but different query parameters.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS,
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 1,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f77879abe6e4',
				'label'             => __( 'Allow Redirect To Extraneous Web', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
				'name'              => 'allow_redirect_to_extraneous_url',
				'type'              => 'true_false',
				'instructions'      => __( "If On, you can configure step's url as an extraneous and it won't be blocked.", 'dp-intro-tours' )
					. DP_INTRO_TOURS_SPACER . __( 'Of course this has a sense only for a last step as after such a redirection tours ends.', 'dp-intro-tours' )
					. DP_INTRO_TOURS_SPACER . __( 'In this way you can create cross domain tour, if you configure starting of tour at your other owned domain or you can just redirect visitor at the and of the tour to extraneous url from whatever reason.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => DP_INTRO_TOURS_PRO_ONLY_CLASS,
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f773e9eb36e4',
				'label'             => __( 'Hide Previous Step Button', 'dp-intro-tours' ),
				'name'              => 'hide_previous_step_button',
				'type'              => 'true_false',
				'instructions'      => __( 'Hide previous step button (web app and dynamic links support, where previous doesn\'t work)', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f773e4eb36e4',
				'label'             => __( 'Hide Skip Tour Button', 'dp-intro-tours' ),
				'name'              => 'hide_skip_button',
				'type'              => 'true_false',
				'instructions'      => __( 'Hide button for exiting of the tour.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f778e9eb36e4',
				'label'             => __( 'Disable Bullet Navigation', 'dp-intro-tours' ),
				'name'              => 'disable_navigation_by_bullets',
				'type'              => 'true_false',
				'instructions'      => __( 'When this setting is on, visitor can\'t navigate to intro steps by click on navigational bullets in intro tooltip.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f7754e7be6e3',
				'label'             => __( 'Disable Running Bullets Animation', 'dp-intro-tours' ),
				'name'              => 'disable_starting_animation',
				'type'              => 'true_false',
				'instructions'      => __( 'Disable running bullets animation in the beginning of thr tour and in case of redirection to other page in PRO.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f7795ca760c7',
				'label'             => __( 'Size of the Bullet Animation Container [ vw ]', 'dp-intro-tours' ),
				'name'              => 'bullet_anim_size',
				'type'              => 'number',
				'instructions'      => __( 'Adjust the size of the bullet animation container: 10 - 90 vw ( % from actual window width )', 'dp-intro-tours' ) . dpit_acf_print_default_val( '50vw' ),
				'required'          => 0,
				'conditional_logic' => [
					[
						[
							'field'    => 'field_5f7754e7be6e3',
							'operator' => '==',
							'value'    => '0',
						],
					],
				],
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => 50,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => 20,
				'max'               => 90,
				'step'              => 1,
			],
			[
				'key'               => 'field_5f77a5ca760c7',
				'label'             => __( 'Animation: Bullet Radius [ % ]', 'dp-intro-tours' ),
				'name'              => 'bullet_anim_border_radius',
				'type'              => 'number',
				'instructions'      => __( 'Adjust rounding of bullet in animation: 0 - 300% of the bullet size', 'dp-intro-tours' ) . DP_INTRO_TOURS_SPACER . ' • ' . __( '50% = circle shape ( default )', 'dp-intro-tours' ) . DP_INTRO_TOURS_SPACER . ' • ' . __( '0% = squared shape', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => [
					[
						[
							'field'    => 'field_5f7754e7be6e3',
							'operator' => '==',
							'value'    => '0',
						],
					],
				],
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => 50,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => 0,
				'max'               => 300,
				'step'              => 1,
			],
			[
				'key'               => 'field_5f7755ca760c7',
				'label'             => __( 'Scroll Speed [ 0 - 100 % ]', 'dp-intro-tours' ),
				'name'              => 'scroll_speed',
				'type'              => 'number',
				'instructions'      => ' • &ensp;0: ' . __( 'the slowest', 'dp-intro-tours' ) . DP_INTRO_TOURS_SPACER . ' • 100: ' . __( 'no scrolling (immediately fade into to next step)', 'dp-intro-tours' ) . dpit_acf_print_default_val( '20%' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => 20,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => 0,
				'max'               => 100,
				'step'              => 1,
			],
			[
				'key'               => 'field_6e3367665230f',
				'label'             => __( 'Maximal Tooltip Width [px]', 'dp-intro-tours' ),
				'name'              => 'max_tooltip_width',
				'type'              => 'number',
				'instructions'      => __( 'Maximal width of intro tooltip in pixels.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => __( 'Max. tooltip width [ px ]', 'dp-intro-tours' ),
				'prepend'           => '',
				'append'            => '',
				'min'               => 0,
				'max'               => '',
				'step'              => '',
			],
		],
	];
}

function dpit_get_acf_design_config( $themes ) {
	$query_params_defs = Dp_Intro_Tours_Helper::get_dp_intro_query_params( false );
	return [
		'key'               => 'field_5f26bac05c86c',
		'label'             => __( 'Design', 'dp-intro-tours' ),
		'name'              => 'intro_design',
		'type'              => 'group',
		'instructions'      => __( 'Override global design settings from', 'dp-intro-tours' ) . ' <a href="' . Path::combine_url( get_site_url(), Dp_Intro_Tours_Helper::get_plugin_settings_page_path( 'general' ) ) . '">' . __( "plugin's global setting page", 'dp-intro-tours' ) . '</a> ' . __( 'particularly for this tour.', 'dp-intro-tours' ),
		'required'          => 0,
		'conditional_logic' => 0,
		'wrapper'           => [
			'width' => '',
			'class' => '',
			'id'    => '',
		],
		'layout'            => 'block',
		'sub_fields'        => [
			[
				'key'               => 'field_5f26bc465c86e',
				'label'             => __( 'Theme', 'dp-intro-tours' ),
				'name'              => 'theme',
				'type'              => 'select',
				'instructions'      => __( 'Override default theme option from plugin\'s global options page for this tour.', 'dp-intro-tours' ) . ' ' . Dp_Intro_Tours_Helper::get_pro_link_html( Dp_Intro_Tours_Helper::build_dp_query_string( [ 'dp_qp_lock' => 'start-theme-demo' ], $query_params_defs ), 'Choose your theme visually' ),
				'required'          => 0,
				'conditional_logic' => [
					[
						[
							'field'    => 'field_5f74566abe6e9',
							'operator' => '==',
							'value'    => '0',
						],
					],
				],
				'wrapper'           => [
					'width' => '',
					'class' => Str::classes( [ 'acf-field--ia' => true ] ),
					'id'    => '',
				],
				'choices'           => $themes,
				'default_value'     => [
					0 => Dp_Intro_Tours_Helper::get_themes_select_def_val( false ),
				],
				'allow_null'        => 0,
				'multiple'          => 0,
				'ui'                => 1,
				'return_format'     => 'value',
				'ajax'              => 0,
				'placeholder'       => '',
			],
			[
				'key'               => 'field_5f74566abe6e9',
				'label'             => __( 'Do not load any theme style', 'dp-intro-tours' ),
				'name'              => 'do_not_load_theme',
				'type'              => 'true_false',
				'instructions'      => __( "If you plan to use custom CSS for major restylings, you may want to turn this option on. This ensures that only the necessary styles are loaded, so you don't have to overload all of the theme's CSS styles.", 'dp-intro-tours' )
					. DP_INTRO_TOURS_SPACER
					. __( 'Check documentation', 'dp-intro-tours' )
					. ': <a href="' . DP_INTRO_TOURS_CSS_DOC . '" target="_blank">'
					. __( 'CSS customization', 'dp-intro-tours' )
					. '</a>',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => Str::classes( [ 'acf-field--ia' => true ] ),
					'id'    => '',
				],
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => __( 'On', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Off', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f26da3c5c86f',
				'label'             => __( 'Accent Color', 'dp-intro-tours' ),
				'name'              => 'dp_it_accent_color',
				'type'              => 'color_picker',
				'instructions'      => __( 'Override default accent color from plugin\'s global settings page for this tour.', 'dp-intro-tours' ) . ' ' . Dp_Intro_Tours_Helper::get_pro_link_html(
					Dp_Intro_Tours_Helper::build_dp_query_string(
						[
							'dp_qp_lock' => 'start-theme-demo',
							'dp_qp_step' => '1',
						],
						$query_params_defs
					),
					'Choose accent color visually'
				),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => Str::classes( [ 'acf-field--ia' => true ] ),
					'id'    => '',
				],
				'default_value'     => '',
			],
			[
				'key'               => 'field_5f26bb5a5c86d',
				'label'             => __( 'Font family of the buttons', 'dp-intro-tours' ),
				'name'              => 'custom_font',
				'type'              => 'text',
				'instructions'      => __( 'Overrides font family of the buttons inside a intro tooltip.', 'dp-intro-tours' ) . ' ' . Dp_Intro_Tours_Helper::get_generic_i18n( 'font_option_hint' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => __( 'e.g. Ubuntu, Lato, \'Lucida Grande\', Tahoma, Sans-Serif', 'dp-intro-tours' ),
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_5f7795ba760c7',
				'label'             => __( 'Tooltip container radius override', 'dp-intro-tours' ) . ' [ px ]',
				'name'              => 'tooltip_radius',
				'type'              => 'number',
				'instructions'      => __( 'Override the radius of intro tooltip [px].', 'dp-intro-tours' ) . dpit_acf_print_default_val( __( '-1 => default intro theme value is used', 'dp-intro-tours' ) ),
				'required'          => 0,
				'conditional_logic' => '',
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => -1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => -1,
				'max'               => 1000,
				'step'              => 1,
			],
			[
				'key'               => 'field_5f7795bc760c7',
				'label'             => __( 'Button radius override', 'dp-intro-tours' ) . ' [ px ]',
				'name'              => 'button_radius',
				'type'              => 'number',
				'instructions'      => __( 'Override the radius of intro buttons [px].', 'dp-intro-tours' ) . dpit_acf_print_default_val( __( '-1 => default intro theme value is used', 'dp-intro-tours' ) ),
				'required'          => 0,
				'conditional_logic' => '',
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => -1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => -1,
				'max'               => 1000,
				'step'              => 1,
			],
			[
				'key'               => 'field_5f7795aa760c7',
				'label'             => __( 'Highlight layer radius override', 'dp-intro-tours' ) . ' [ px ]',
				'name'              => 'highlight_radius',
				'type'              => 'number',
				'instructions'      => __( 'Override the radius of highlighting layer [px].', 'dp-intro-tours' ) . dpit_acf_print_default_val( __( '-1 => default intro theme value is used', 'dp-intro-tours' ) ),
				'required'          => 0,
				'conditional_logic' => '',
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => -1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'min'               => -1,
				'max'               => 1000,
				'step'              => 1,
			],
		],
	];
}


function dpit_get_acf_url_vars_config() {
	$pro_only_classes = ! DP_INTRO_TOURS_IS_PRO ? DP_INTRO_TOURS_PRO_ONLY_NO_EVENTS_CLASS : '';
	return [
		'key'               => 'field_5f26baaa5c86c',
		'label'             => __( 'Variables in URL', 'dp-intro-tours' ) . DP_INTRO_TOURS_PRO_POSTFIX,
		'name'              => 'intro_url_variables',
		'type'              => 'group',
		'instructions'      => __( 'URL variables allow you to define the variables of the URL portion of each step to create universal tours!' )
			. DP_INTRO_TOURS_SPACER
			. '<div class="dp-info-icon dp-info-icon--inline dp-info-icon--pre" data-info-text="' . Dp_Intro_Tours_Helper::get_generic_i18n( 'custom_url_vars_desc_detail' ) . '"></div>'
			. Dp_Intro_Tours_Helper::get_generic_i18n( 'custom_url_vars_desc' )
			. DP_INTRO_TOURS_SPACER
			. Dp_Intro_Tours_Helper::get_generic_i18n( 'custom_url_vars_example' )
			. DP_INTRO_TOURS_SPACER
			. Dp_Intro_Tours_Helper::get_generic_i18n( 'system_url_vars_desc' )
			. DP_INTRO_TOURS_SPACER
			. Dp_Intro_Tours_Helper::get_generic_i18n( 'system_url_vars_example' )
			. DP_INTRO_TOURS_SPACER
			. Dp_Intro_Tours_Helper::get_generic_i18n( 'system_url_vars_desc_detail' ),
		'required'          => 0,
		'conditional_logic' => 0,
		'wrapper'           => [
			'width' => '',
			'class' => '',
			'id'    => '',
		],
		'layout'            => 'block',
		'sub_fields'        => [
			[
				'key'               => 'field_5e4c8eadab990',
				'label'             => __( 'Enable url variables', 'dp-intro-tours' ),
				'name'              => 'url_vars_enabled',
				'type'              => 'true_false',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => $pro_only_classes,
					'id'    => '',
				],
				'message'           => __( 'Enable / disable URL variables.', 'dp-intro-tours' ),
				'default_value'     => '1',
				'ui'                => 1,
				'ui_on_text'        => __( 'Active', 'dp-intro-tours' ),
				'ui_off_text'       => __( 'Inactive', 'dp-intro-tours' ),
			],
			[
				'key'               => 'field_5f26f35a5c86d',
				'label'             => __( 'Variable Examples for Visual Builder Start', 'dp-intro-tours' ),
				'name'              => 'url_vars_examples',
				'type'              => 'textarea',
				'readonly'          => '1',
				'instructions'      => __( 'Example values are used to concretize starting url (first step) for visual builder only - they has no effect in live tour.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => $pro_only_classes,
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
		],
	];
}

function dpit_get_acf_labeling_config() {
	return [
		'key'               => 'field_5f26baca5c86c',
		'label'             => __( 'Labeling', 'dp-intro-tours' ),
		'name'              => 'intro_labeling',
		'type'              => 'group',
		'instructions'      => __( 'Override of', 'dp-intro-tours' ) . ' <a href="' . Path::combine_url( get_site_url(), Dp_Intro_Tours_Helper::get_plugin_settings_page_path( 'labeling' ) ) . '">' . __( "plugin's global labeling options", 'dp-intro-tours' ) . '</a> ' . __( 'particularly for this tour.', 'dp-intro-tours' ),
		'required'          => 0,
		'conditional_logic' => 0,
		'wrapper'           => [
			'width' => '',
			'class' => '',
			'id'    => '',
		],
		'layout'            => 'block',
		'sub_fields'        => [
			[
				'key'               => 'field_61faad1aa7ebe',
				'label'             => __( 'Button Arrow Icons', 'dp-intro-tours' ),
				'name'              => 'button_arrows',
				'type'              => 'select',
				'instructions'      => Dp_Intro_Tours_Helper::get_button_arrow_select_instructions(
					sprintf( __( 'Override the global option for %s in buttons in the tooltip', 'dp-intro-tours' ), '<strong>' . __( 'selection of arrow icons', 'dp-intro-tours' ) . '</strong>' ),
					false
				),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'choices'           => Dp_Intro_Tours_Helper::get_button_arrow_select_options( false ),
				'default_value'     => [ 0 => Dp_Intro_Tours_Helper::get_button_arrow_select_def_val( false ) ],
				'allow_null'        => 0,
				'ui'                => 1,
				'ajax'              => 0,
				'return_format'     => 'value',
				'placeholder'       => '',
			],

			[
				'key'               => 'field_5f26b35a5c86d',
				'label'             => __( 'Next Step Button', 'dp-intro-tours' ),
				'name'              => 'nextLabel',
				'type'              => 'text',
				'instructions'      => __( 'Custom text for next step button.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => Dp_Intro_Tours_Helper::get_generic_i18n( 'next' ),
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_5f46b35a5c86d',
				'label'             => __( 'Previous Step Button', 'dp-intro-tours' ),
				'name'              => 'prevLabel',
				'type'              => 'text',
				'instructions'      => __( 'Custom text for previous step button.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => Dp_Intro_Tours_Helper::get_generic_i18n( 'back' ),
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_5f26a35a5c86d',
				'label'             => __( 'Cancel Tour Button', 'dp-intro-tours' ),
				'name'              => 'skipLabel',
				'type'              => 'text',
				'instructions'      => __( 'Custom text for cancel tour button.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => __( 'Skip', 'dp-intro-tours' ),
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_5f26b35abc86d',
				'label'             => __( 'Finished Tour Button', 'dp-intro-tours' ),
				'name'              => 'doneLabel',
				'type'              => 'text',
				'instructions'      => __( 'Custom text of finished tour button.', 'dp-intro-tours' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => __( 'Done', 'dp-intro-tours' ),
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
		],
	];
}

?>
