<?php

use IntroToursDP\Wp\Settings;
use IntroToursDP\Std\Core\Arr;



/**
 * The settings of the plugin.
 *
 * @link  http://github.com/
 * @since 1.0.0
 *
 * @package    GG_Interactive_Map
 * @subpackage GG_Interactive_Map/admin
 */

/**
 * Class Dp_Intro_Tours_Admin_Settings
 */
class Dp_Intro_Tours_Admin_Settings {





	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct() {

	}


	public function render_admin_notice_container() {
	}


	protected function get_settings_tab_cfg() {
		$use_wp_theme_text_styles = Settings::get_setting_array_bool( 'dp_it_general_options', 'inherit_all_styles', false );

		return [
			'general'     => [ 'title' => __( 'General', 'dp-intro-tours' ) ],
			'labeling'    => [ 'title' => __( 'Labeling', 'dp-intro-tours' ) ],
			'text_styles' => [
				'title'    => __( 'Text Styles', 'dp-intro-tours' ),
				'disabled' => $use_wp_theme_text_styles,
			],
		];
	}

	protected function render_settings_tabs_inner( $active_tab ) {
		$tab_cfg = $this->get_settings_tab_cfg();
		foreach ( $tab_cfg as $id => $data ) {
			if ( ! Arr::get( $data, 'disabled', false ) ) {
				?>
				<a href="?page=dp_intro_tours&tab=<?php echo $id; ?>" class="nav-tab <?php echo $active_tab === $id ? 'nav-tab-active' : ''; ?>"><?php echo Arr::get( $data, 'title', $id ); ?></a>
				<?php
			}
		}
	}

	protected function render_settings_tabs( $active_tab ) {
		?>
		<nav class="nav-tab-wrapper">
		<?php
		$this->render_settings_tabs_inner( $active_tab );
		?>
		</nav>
		<?php
	}


	public function setup_plugin_options_menu() {
		add_options_page(
			__( 'Intro Tour Tutorial Options', 'dp-intro-tours' ), // The title to be displayed in the browser window for this page.
			__( 'Intro Tour Tutorial', 'dp-intro-tours' ),         // The text to be displayed for this menu item
			'manage_options',                // Which type of users can see this menu item
			'dp_intro_tours', // The unique ID - that is, the slug - for this menu item
			[ $this, 'render_settings_page_content' ] // The name of the function to call when rendering this menu's page
		);
	}

	protected function add_plugin_submenu_options() {
		$tab_cfg = $this->get_settings_tab_cfg();
		foreach ( $tab_cfg as $id => $data ) {
			if ( ! Arr::get( $data, 'disabled', false ) ) {
				$title = Arr::get( $data, 'title', $id );
				add_submenu_page( 'dp_intro_tours', $title, $title, 'manage_options', $id === 'general' ? 'dp_intro_tours' : '?page=dp_intro_tours&tab=' . $id );
			}
		}
	}

	public function highlight_submenu_active_item( $parent_file ) {
		 global $submenu_file;
		if ( isset( $_GET['page'] ) && $_GET['page'] === 'dp_intro_tours' ) {
			if ( isset( $_GET['tab'] ) ) {
				$submenu_file = '?page=' . $_GET['page'] . '&tab=' . $_GET['tab'];
			}
		}

		return $parent_file;
	}


	/**
	 * Renders a simple page to display for the theme menu defined above.
	 */
	public function render_settings_page_content() {
		?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap dpit-g-options">

		<h1>
			<strong><?=DP_INTRO_TOURS_NAME?></strong>
			<?= __( 'Global Options', 'dp-intro-tours' )?>
			<?php
			$badge_href = DP_INTRO_TOURS_IS_PRO
				? DP_INTRO_TOURS_HOW_TO_DOC
				: DP_INTRO_TOURS_PRODUCT_FEATURES_LINK_PRO;
			?>
			<a href="<?= $badge_href; ?>" target="_blank" class="dpit-g-options__heading-note">
				<?php if ( DP_INTRO_TOURS_IS_PRO ) { ?>
					<?= __( 'Thank you for using PRO', 'dp-intro-tours' ); ?> 
				<?php } else { ?>
					<?= __( 'Discover the PRO', 'dp-intro-tours' ); ?> 
				<?php } ?>
			</a>
		</h1>
		<p class="dpit-g-options__desc dpit-g-options__desc--main"><?= __( 'Plugin options that will affect all tours created', 'dp-intro-tours' ); ?></p>
		<?php $this->render_admin_notice_container(); ?>
		<?php settings_errors(); ?>

		<?php
		if ( isset( $_GET['tab'] ) ) {
			$active_tab = $_GET['tab'];
		}
		$active_tab = empty( $active_tab ) ? 'general' : $active_tab;
		$this->render_settings_tabs( $active_tab );
		switch ( $active_tab ) {
			default:
				?>
		<form method="post" action="options.php">
				<?php
				$this->render_active_tab_content( $active_tab );
				$this->render_submit_button( $active_tab );
				?>
		</form>

		<?php } ?>

	</div>
		<?php
	}

	protected function render_submit_button( $active_tab ) {
		submit_button();
	}

	protected function render_active_tab_content( $active_tab ) {
		$optionId = 'dp_it_' . $active_tab . '_options';
		settings_fields( $optionId );
		do_settings_sections( $optionId );
	}


	public function general_options_description() {
		$this->render_option_heading(
			__( 'Plugin General Options', 'dp-intro-tours' ),
			__( 'You can setup global style and behavior here.', 'dp-intro-tours' ),
			__( 'Some of these options are overridable by', 'dp-intro-tours' ),
			true
		);
	}

	protected function render_option_heading( string $heading, string $sub_heading = '', string $specific_config_text = '', bool $news_enabled = false, $sub_heading_id = '', bool $call_2_review_en = false ) {
		?>
			<h2 class="dpit-settings__heading"><?= $heading ?></h2>
			<p <?= ( $sub_heading_id ? ( ' id="' . $sub_heading_id . '"' ) : '' );?> class="dpit-g-options__desc dpit-g-options__width-fix"><?= $sub_heading; ?></p>
			<div class="dpit-settings__info">	
		

				<?php if ( $news_enabled || $call_2_review_en ) { ?>
					<div class="dpit-settings__cta-wrap">
					<?php if ( $news_enabled ) { ?>
						<div class="dpit-settings__news">
							<strong class="dpit-settings__news-label"><?= __( 'NEWS', 'dp-intro-tours' ) . ': ' ?></strong> 
							<a class="button button-secondary dpit-settings__btn dpit-settings__btn--news"  href="<?= DP_INTRO_TOURS_API_DOC; ?>" target="_blank">
								<?= __( 'API ( PHP & JS )', 'dp-intro-tours' ); ?>
							</a>
							<a class="button button-secondary dpit-settings__btn dpit-settings__btn--news"  href="<?= DP_INTRO_TOURS_V5_DOC; ?>" target="_blank">
								<?= __( 'Upgrade to v5', 'dp-intro-tours' ); ?>
							</a>
						</div>
						<?php } ?>
						<?php
						if ( $call_2_review_en && ! DP_INTRO_TOURS_IS_PRO ) {
							Dp_Intro_Tours_Helper::render_call_2_rating( 'dpit-settings__c2r' );}
						?>
					</div>
				<?php } ?>
				<?php if ( $specific_config_text ) { ?>
					<div class="dpit-settings__spec-cfg">
						<?= $specific_config_text ?>:  
						<a class="button button-secondary dpit-settings__btn" href="<?= get_dashboard_url( get_current_user_id(), 'edit.php?post_type=dp_intro_tours' ); ?>">
							<?= __( 'Specific tour configuration', 'dp-intro-tours' ); ?>
						</a>
					</div>
				<?php } ?>

			</div>
		<?php
	}



	protected function option_hint_pro_promo( $override_by_specific_tour_cfg = false, $prefix_by_space = true, bool $forcePro = false ) {
		$link_to_pro = Dp_Intro_Tours_Helper::get_pro_link_html();
		$res         = '';
		if ( $override_by_specific_tour_cfg ) {
			$res = $this->option_hint_pro_promo_override_tour_spec( $link_to_pro, $prefix_by_space, $forcePro );
		} elseif ( ! DP_INTRO_TOURS_IS_PRO ) {
			$res = ( $prefix_by_space ? ' ' : '' ) . __( 'Available in', 'dp-intro-tours' ) . ' ' . $link_to_pro;
		}
		return $res;
	}

	protected function option_hint_pro_promo_override_tour_spec( $link_to_pro, $prefix_by_space = true, bool $forcePro = false ) {
		$res = $prefix_by_space ? ' ' : '';
		if ( ! DP_INTRO_TOURS_IS_PRO && ! $forcePro ) {
			$res .= __( 'This can be overridden by specific tour configuration in', 'dp-intro-tours' ) . ' ' . $link_to_pro;
		} else {
			$res .= __( 'This can be overridden by specific tour configuration.', 'dp-intro-tours' );
		}
		return $res;
	}

	protected function get_general_options_cfg_arr() {
		$query_params_defs = Dp_Intro_Tours_Helper::get_dp_intro_query_params( false );
		$proOnly           = ! DP_INTRO_TOURS_IS_PRO ? '1' : '0';
		$res               = [
			[
				'id'         => 'inherit_all_styles', //inherit_all_styles   useThemeDefaultFont
				'title'      => __( 'Use WordPress Theme Text Styles', 'dp-intro-tours' ),
				'defVal'     => '0',
				'renderArgs' => [
					'type' => 'checkbox',
					'hint' => __( 'Use default fonts and text styles from your WordPress theme. If disabled, text styles option tab is available to customize fonts and text styles', 'dp-intro-tours' ) . $this->option_hint_pro_promo(),
				],
			],
			[
				'id'         => 'dp_it_accent_color',
				'title'      => __( 'Default Accent Color', 'dp-intro-tours' ),
				'defVal'     => '#1d6093',
				'renderArgs' => [
					'type'        => 'color',
					'size'        => 5,
					'placeholder' => '#1d6093',
					'hint'        => __( 'Global accent color for all intro tours', 'dp-intro-tours' ) . '.' . $this->option_hint_pro_promo( true, true, true ) . ' ' . Dp_Intro_Tours_Helper::get_pro_link_html(
						Dp_Intro_Tours_Helper::build_dp_query_string(
							[
								'dp_qp_lock' => 'start-theme-demo',
								'dp_qp_step' => '1',
							],
							$query_params_defs
						),
						'Choose accent color visually'
					),
				],
			],
			[
				'id'         => 'theme',
				'title'      => __( 'Default Theme', 'dp-intro-tours' ),
				'defVal'     => Dp_Intro_Tours_Helper::get_themes_select_def_val( true ),
				'renderArgs' => [
					'options'     => Dp_Intro_Tours_Helper::get_themes_select_options( true ),
					'type'        => 'select',
					'placeholder' => Dp_Intro_Tours_Helper::get_themes_select_placeholder(),
					'size'        => 95,
					'hint'        => DP_INTRO_TOURS_IS_PRO
					? __( 'Global design of intro.', 'dp-intro-tours' ) . $this->option_hint_pro_promo( true ) . ' ' . Dp_Intro_Tours_Helper::get_pro_link_html( Dp_Intro_Tours_Helper::build_dp_query_string( [ 'dp_qp_lock' => 'start-theme-demo' ], $query_params_defs ), 'Choose your theme visually' )
					: __( 'Global design of intro. In PRO there is another 5 themes and global theme can be overridden by configuration of specific tour. ', 'dp-intro-tours' ) . ' ' . Dp_Intro_Tours_Helper::get_pro_link_html( Dp_Intro_Tours_Helper::build_dp_query_string( [ 'dp_qp_lock' => 'start-theme-demo' ], $query_params_defs ), 'Choose your theme visually' ),
				],
			],
			[
				'id'         => 'admin_board_tour_en',
				'title'      => __( 'Enable Tours on Admin Board', 'dp-intro-tours' ),
				'defVal'     => '0',
				'renderArgs' => [
					'type'     => 'checkbox',
					'hint'     => __( 'Enable creating and running a tours on WordPress admin board.', 'dp-intro-tours' ),
					'pro_only' => $proOnly,
				],
			],
			[
				'id'         => 'extend_toolbar_publish_buttons',
				'title'      => __( 'Extend admin toolbar publish buttons', 'dp-intro-tours' ),
				'defVal'     => '0',
				'renderArgs' => [
					'type' => 'checkbox',
					'hint' => __( 'Duplicate WordPress admin board action buttons (publish, save draft, preview etc.) at all applicable WordPress admin board pages (not intro tours only)', 'dp-intro-tours' ),
				],
			],
			[
				'id'         => 'load_all_themes',
				'title'      => __( 'Load all themes (ADVANCED)', 'dp-intro-tours' ),
				'defVal'     => '0',

				'renderArgs' => [
					'hint'     => sprintf( __( 'It allows changing themes on the fly in the frontend by adding theme id %1$s as a class to the main document element (html tag).', 'dp-intro-tours' ), '[dpit-theme-dark, dpit-theme-basic, dpit-theme-minimal, dpit-theme-sticky etc]' ) . $this->option_hint_pro_promo(),
					'type'     => 'checkbox',
					'pro_only' => $proOnly,
				],
			],
			[
				'id'         => 'hide_elements_at_start',
				'title'      => __( 'Hide elements when tour is running', 'dp-intro-tours' ),
				'defVal'     => '',
				'renderArgs' => [
					'type'        => 'text',
					'size'        => 40,
					'placeholder' => '#wpadminbar, #chat-application-iframe, .class-of-elements-i-want-to-hide',
					'hint'        => __( 'CSS selectors (delimited by \',\') of elements, that should be hidden, when tour starts and shown again when tour ends.', 'dp-intro-tours' ),
				],
			],
			[
				'id'         => 'z_index_base',
				'title'      => __( 'Z-Index Base (ADVANCED)', 'dp-intro-tours' ),
				'defVal'     => 16777200, // safari max

				'renderArgs' => [
					'type'      => 'text',
					'inputType' => 'number',
					'min'       => 0,
					'max'       => 2147483600,
					'size'      => 1,
					'hint'      => __( 'Set the z-index of the base for the layers of the intro tour. Tour\'s layers range of z-index is: &lt;z_index_base, z_index_base + 20&gt;. If you set it too low, the intro tour layers may disappear behind the standard layer of your site.', 'dp-intro-tours' ),
				],
			],
			[
				'id'         => 'debug_console',
				'title'      => __( 'Debug Console Output', 'dp-intro-tours' ),
				'defVal'     => '0',
				'renderArgs' => [
					'type' => 'checkbox',
					'hint' => __( 'Activate only for debug purposes.', 'dp-intro-tours' ),
				],
			],
		];
		if ( current_user_can( 'edit_users' ) ) {
			$res[] = [
				'id'         => 'clear_visit_count',
				'title'      => __( 'Clear Logged-In Visit Count', 'dp-intro-tours' ),
				'defVal'     => '0',
				'renderArgs' => [
					'type'           => 'action',
					'name'           => 'clear_visit_count',
					'btn_root_class' => 'dpit-admin-btn',
					'msg_success'    => __( 'Successfully cleared', 'dp-intro-tours' ),
					'msg_failed'     => __( 'Clearing failed', 'dp-intro-tours' ),
					'title'          => __( 'Clear', 'dp-intro-tours' ),
					'hint'           => __( 'Clear visit count to reset First User Visit feature for logged in users', 'dp-intro-tours' ),

				],
			];
		}
		return $res;
	}

	public function initialize_general_options() {
		Settings::init_setting_array(
			'dp_it_general_options',
			'general_options_section',
			'',
			'dp_it_general_options',
			$this->get_general_options_cfg_arr(),
			[ $this, 'general_options_description' ],
			false,
			'dpit-settings'
		);
	}


	public function labeling_options_description() {
		$this->render_option_heading(
			__( 'Labeling options', 'dp-intro-tours' ),
			__( 'You can customize texts of intro elements globally here.', 'dp-intro-tours' ),
			__( 'It is possible to override them by', 'dp-intro-tours' )
		);
	}

	public function initialize_labeling_options() {

		Settings::init_setting_array(
			'dp_it_labeling_options',
			'labeling_options_section',
			'',
			'dp_it_labeling_options',
			[
				[
					'id'         => 'button_arrows',
					'title'      => __( 'Button Arrow Icons', 'dp-intro-tours' ),
					'defVal'     => Dp_Intro_Tours_Helper::get_button_arrow_select_def_val( true ),
					'renderArgs' => [
						'options'     => Dp_Intro_Tours_Helper::get_button_arrow_select_options( true ),
						'type'        => 'select',
						'placeholder' => 'Vector',
						'size'        => 55,
						'hint'        => Dp_Intro_Tours_Helper::get_button_arrow_select_instructions(
							__( 'Selection of arrow icons for buttons in the tooltip', 'dp-intro-tours' ),
							true
						),
					],
				],
				[
					'id'         => 'nextLabel',
					'title'      => __( 'Next Step Button', 'dp-intro-tours' ),
					'defVal'     => __( 'Next', 'dp-intro-tours' ),
					'renderArgs' => [
						'placeholder' => __( 'Next', 'dp-intro-tours' ),
						'type'        => 'text',
						'size'        => 10,
						'hint'        => __( 'Custom text for next step button.', 'dp-intro-tours' ),
					],
				],
				[
					'id'         => 'prevLabel',
					'title'      => __( 'Previous Step Button', 'dp-intro-tours' ),
					'defVal'     => __( 'Back', 'dp-intro-tours' ),
					'renderArgs' => [
						'placeholder' => __( 'Back', 'dp-intro-tours' ),
						'type'        => 'text',
						'size'        => 10,
						'hint'        => __( 'Custom text for previous step button.', 'dp-intro-tours' ),
					],
				],
				[
					'id'         => 'skipLabel',
					'title'      => __( 'Cancel Tour Button', 'dp-intro-tours' ),
					'defVal'     => __( 'Cancel', 'dp-intro-tours' ),
					'renderArgs' => [
						'placeholder' => __( 'Cancel', 'dp-intro-tours' ),
						'type'        => 'text',
						'size'        => 10,
						'hint'        => __( 'Custom text for cancel tour button.', 'dp-intro-tours' ),
					],
				],
				[
					'id'         => 'doneLabel',
					'title'      => __( 'Finished Tour Button', 'dp-intro-tours' ),
					'defVal'     => __( 'Done', 'dp-intro-tours' ),
					'renderArgs' => [
						'placeholder' => __( 'Done', 'dp-intro-tours' ),
						'type'        => 'text',
						'size'        => 10,
						'hint'        => __( 'Custom text of finished tour button.', 'dp-intro-tours' ),
					],
				],
			],
			[ $this, 'labeling_options_description' ],
			false,
			'dpit-settings'
		);
	}

	public function text_styles_options_description() {
		$see_advanced_text_styles = Settings::get_setting_array_bool( 'dp_it_text_styles_options', 'see_advanced_text_styles', false );
		if ( ! $see_advanced_text_styles ) {
			$this->render_option_heading(
				__( 'Text styles options', 'dp-intro-tours' ),
				__( 'Here you can tweak sizes and margins in intro tooltip easily by 2 options.', 'dp-intro-tours' ),
				'',
				false,
				'',
				true
			);
		} else {
			$this->render_option_heading(
				__( 'Advanced text styles options', 'dp-intro-tours' ),
				__( 'You can customize fonts and styles of intro tooltip texts in detail here.', 'dp-intro-tours' ),
				'',
				false,
				'',
				true
			);
		}

	}

	public function initialize_text_styles_options() {
		$FONT_SIZE_UNIT_LBL        = __( 'Font size unit', 'dp-intro-tours' );
		$FONT_SIZE_UNIT_BR_POSTFIX = ' <br>[' . $FONT_SIZE_UNIT_LBL . ']';
		$font_hint_addition        = Dp_Intro_Tours_Helper::get_generic_i18n( 'font_option_hint' );
		$heading_approx_hint       = __( 'All other heading sizes (h1 - h6) and the bottom margins of the headings are approximated based on the values of h2 and h5.', 'dp-intro-tours' );

		$use_wp_theme_text_styles = Settings::get_setting_array_bool( 'dp_it_general_options', 'inherit_all_styles', false );
		$see_advanced_text_styles = Settings::get_setting_array_bool( 'dp_it_text_styles_options', 'see_advanced_text_styles', false );

		if ( ! $use_wp_theme_text_styles ) {
			Settings::init_setting_array(
				'dp_it_text_styles_options',
				'text_styles_options_section',
				'',
				'dp_it_text_styles_options',
				[
					[
						'id'         => 'all_in_1_size_coef',
						'title'      => __( 'Adjust all font sizes and margins coef [%]', 'dp-intro-tours' ),
						'defVal'     => 95,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0,
							'max'       => 1000,
							'step'      => 1,
							'hint'      => __( 'Affects all font sizes and text margins in intro tooltip. Base for size calculation are font size and margins values that you can see and set, when See Advanced Text Styles Options is on.', 'dp-intro-tours' ),
						],
					],
					[
						'id'         => 'mobile_size_coef',
						'title'      => __( 'Adjust mobile sizes by % from wide-screen size', 'dp-intro-tours' ),
						'defVal'     => 90,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0,
							'max'       => 1000,
							'step'      => 1,
							'hint'      => __( ' Eg. 100% => no change, 80% => smaller on mobiles. Affects all options bellow.', 'dp-intro-tours' ),
						],
					],
					[
						'id'         => 'see_advanced_text_styles',
						'title'      => __( 'See Advanced Text Styles Options', 'dp-intro-tours' ),
						'defVal'     => '0',
						'renderArgs' => [
							'type' => 'checkbox',
							'hint' => __( 'See advanced text styles options to customize in detail. If enabled, advanced text styles option tab is available.', 'dp-intro-tours' ) . $this->option_hint_pro_promo(),
						],
					],
					[
						'id'         => 'p_font',
						'title'      => __( 'Font family of paragraphs', 'dp-intro-tours' ),
						'defVal'     => '',
						'renderArgs' => [
							'type'        => 'text',
							'size'        => 30,
							'placeholder' => __( 'e.g. Ubuntu, Tahoma, Sans-Serif', 'dp-intro-tours' ),
							'hint'        => __( 'Font family of paragraph inside a intro tooltip.', 'dp-intro-tours' ) . ' ' . $font_hint_addition,
							'hidden'      => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'h_font',
						'title'      => __( 'Font family of all heading texts', 'dp-intro-tours' ),
						'defVal'     => '',
						'renderArgs' => [
							'type'        => 'text',
							'size'        => 30,
							'placeholder' => __( 'e.g. Ubuntu, Tahoma, Sans-Serif', 'dp-intro-tours' ),
							'hint'        => __( 'Font family of all heading texts inside a intro tooltip.', 'dp-intro-tours' ) . ' ' . $font_hint_addition,
							'hidden'      => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'btn_font',
						'title'      => __( 'Font family of the buttons', 'dp-intro-tours' ),
						'defVal'     => '',
						'renderArgs' => [
							'type'        => 'text',
							'size'        => 30,
							'placeholder' => __( 'e.g. Ubuntu, Tahoma, Sans-Serif', 'dp-intro-tours' ),
							'hint'        => __( 'Font family of the buttons inside a intro tooltip. It is overridable by specific tour configuration.', 'dp-intro-tours' ) . ' ' . $font_hint_addition,
							'hidden'      => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'font_size_unit',
						'title'      => $FONT_SIZE_UNIT_LBL,
						'defVal'     => 'em',
						'renderArgs' => [
							'options'     => [ 'em', 'rem', 'px', 'pt', 'vw', '%' ],
							'type'        => 'select',
							'placeholder' => 'em',
							'size'        => 55,
							'hint'        => __( 'It affects all font options below. The \'em\' option derives value from the font size of parent element on the current page (defined usually by your WP theme)', 'dp-intro-tours' ),
							'hidden'      => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'p_font_size',
						'title'      => __( 'Font size of paragraphs', 'dp-intro-tours' ) . $FONT_SIZE_UNIT_BR_POSTFIX,
						'defVal'     => 1,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0.001,
							'max'       => 1000,
							'step'      => 'any',
							'hint'      => __( 'Font size of paragraphs inside a intro tooltip', 'dp-intro-tours' ),
							'hidden'    => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'h2_font_size',
						'title'      => __( 'Font size of heading 2', 'dp-intro-tours' ) . $FONT_SIZE_UNIT_BR_POSTFIX,
						'defVal'     => 1.765,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0.001,
							'max'       => 1000,
							'step'      => 'any',
							'hint'      => __( 'Font size of heading 2 inside a intro tooltip', 'dp-intro-tours' ) . ' ' . $heading_approx_hint,
							'hidden'    => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'h5_font_size',
						'title'      => __( 'Font size of heading 5', 'dp-intro-tours' ) . $FONT_SIZE_UNIT_BR_POSTFIX,
						'defVal'     => 1.05,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0.001,
							'max'       => 1000,
							'step'      => 'any',
							'hint'      => __( 'Font size of heading 5 inside a intro tooltip', 'dp-intro-tours' ) . ' ' . $heading_approx_hint,
							'hidden'    => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'p_mb',
						'title'      => __( 'Bottom margin of paragraph [% from Font size of paragraphs]', 'dp-intro-tours' ),
						'defVal'     => 10,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0,
							'max'       => 100,
							'size'      => 1,
							'hint'      => __( 'Bottom margin of paragraph inside a intro tooltip [% from Font size of paragraphs]', 'dp-intro-tours' ),
							'hidden'    => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'h2_mb',
						'title'      => __( 'Bottom margin of heading 2 [% from Font size of heading 2]', 'dp-intro-tours' ),
						'defVal'     => 13,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0,
							'max'       => 100,
							'size'      => 1,
							'hint'      => __( 'Bottom margin of heading 2 inside a intro tooltip [% from Font size of heading 2]', 'dp-intro-tours' ) . ' ' . $heading_approx_hint,
							'hidden'    => ! $see_advanced_text_styles,
						],
					],
					[
						'id'         => 'h5_mb',
						'title'      => __( 'Bottom margin of heading 5 [% from Font size of heading 5]', 'dp-intro-tours' ),
						'defVal'     => 10,
						'renderArgs' => [
							'type'      => 'text',
							'inputType' => 'number',
							'min'       => 0,
							'max'       => 100,
							'size'      => 1,
							'hint'      => __( 'Bottom margin of heading 5 inside a intro tooltip [% from Font size of heading 5]', 'dp-intro-tours' ) . ' ' . $heading_approx_hint,
							'hidden'    => ! $see_advanced_text_styles,
						],
					],
				],
				[ $this, 'text_styles_options_description' ],
				false,
				'dpit-settings'
			);
		}
	}

}

?>
