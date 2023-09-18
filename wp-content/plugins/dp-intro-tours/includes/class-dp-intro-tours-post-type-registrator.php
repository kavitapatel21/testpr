<?php

/**
 *
 * @link  https://deeppresentation.com
 * @since 1.0.0
 *
 * @package    Dp_Intro_Tours
 * @subpackage Dp_Intro_Tours/includes
 */

class Dp_Intro_Tours_Post_Type_Registrator {




	public function register_intro_tour() {
		$labels = [
			'name'               => __( 'Intro Tours', 'dp-intro-tours' ),
			'singular_name'      => __( 'Intro Tour', 'dp-intro-tours' ),
			'add_new'            => __( 'Add New', 'dp-intro-tours' ),
			'add_new_item'       => __( 'Add New Intro Tour', 'dp-intro-tours' ),
			'edit_item'          => __( 'Edit Intro Tour', 'dp-intro-tours' ),
			'new_item'           => __( 'New Intro Tour', 'dp-intro-tours' ),
			'all_items'          => __( 'All Intro Tours', 'dp-intro-tours' ),
			'view_item'          => __( 'View Intro Tour', 'dp-intro-tours' ),
			'view_items'         => __( 'View Intro Tours', 'dp-intro-tours' ),
			'search_items'       => __( 'Search Intro Tours', 'dp-intro-tours' ),
			'not_found'          => __( 'No Intro Tours found', 'dp-intro-tours' ),
			'not_found_in_trash' => __( 'No Intro Tours found in the Trash', 'dp-intro-tours' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Intro Tours', 'dp-intro-tours' ),
		];

		$args = [
			'labels'              => $labels,
			'menu_icon'           => 'data:image/svg+xml;base64,' . base64_encode( Dp_Intro_Tours_Helper::get_plugin_ico_svg( DP_INTRO_TOURS_NAME ) ),
			'hierarchical'        => true,
			'description'         => __( 'Intro Tours', 'dp-intro-tours' ),
			'supports'            => [ 'title' ],
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
		];

		if ( ! post_type_exists( 'dp_intro_tours' ) ) {
			register_post_type( 'dp_intro_tours', $args );
		}
	}

}

?>
