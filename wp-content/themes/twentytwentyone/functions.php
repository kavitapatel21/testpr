<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twenty_twenty_one_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('twentytwentyone', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1568, 9999);

		register_nav_menus(
			array(
				'primary' => esc_html__('Primary menu', 'twentytwentyone'),
				'footer'  => esc_html__('Secondary menu', 'twentytwentyone'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');
		$background_color = get_theme_mod('background_color', 'D1E4DD');
		if (127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex($background_color)) {
			add_theme_support('dark-editor-style');
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ($is_IE) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style($editor_stylesheet_path);

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__('Extra small', 'twentytwentyone'),
					'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone'),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__('Small', 'twentytwentyone'),
					'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone'),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__('Normal', 'twentytwentyone'),
					'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone'),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__('Large', 'twentytwentyone'),
					'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone'),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__('Extra large', 'twentytwentyone'),
					'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone'),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__('Huge', 'twentytwentyone'),
					'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone'),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__('Gigantic', 'twentytwentyone'),
					'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone'),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__('Black', 'twentytwentyone'),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__('Dark gray', 'twentytwentyone'),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__('Gray', 'twentytwentyone'),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__('Green', 'twentytwentyone'),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__('Blue', 'twentytwentyone'),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__('Purple', 'twentytwentyone'),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__('Red', 'twentytwentyone'),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__('Orange', 'twentytwentyone'),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__('Yellow', 'twentytwentyone'),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__('White', 'twentytwentyone'),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__('Purple to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__('Green to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to green', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__('Red to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__('Purple to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__('Red to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if (is_customize_preview()) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support('starter-content', twenty_twenty_one_get_starter_content());
		}

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Add support for custom line height controls.
		add_theme_support('custom-line-height');

		// Add support for experimental link color control.
		add_theme_support('experimental-link-color');

		// Add support for experimental cover block spacing.
		add_theme_support('custom-spacing');

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support('custom-units');

		// Remove feed icon link from legacy RSS widget.
		add_filter('rss_widget_feed_link', '__return_empty_string');
	}
}
add_action('after_setup_theme', 'twenty_twenty_one_setup');

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init()
{

	register_sidebar(
		array(
			'name'          => esc_html__('Footer', 'twentytwentyone'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'twenty_twenty_one_widgets_init');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
}
add_action('after_setup_theme', 'twenty_twenty_one_content_width', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts()
{
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ($is_IE) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get('Version'));
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
	}

	// RTL styles.
	wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');

	// Print styles.
	wp_enqueue_style('twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get('Version'), 'print');

	// Threaded comment reply styles.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get('Version'),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if (has_nav_menu('primary')) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array('twenty-twenty-one-ie11-polyfills'),
			wp_get_theme()->get('Version'),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array('twenty-twenty-one-ie11-polyfills'),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_scripts');

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script()
{

	wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
}

add_action('enqueue_block_editor_assets', 'twentytwentyone_block_editor_script');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix()
{

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
?>
		<script>
			/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", (function() {
				var t, e = location.hash.substring(1);
				/^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
			}), !1);
		</script>
	<?php
	}
}
add_action('wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix');

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages()
{
	$custom_css = twenty_twenty_one_get_non_latin_css('front-end');

	if ($custom_css) {
		wp_add_inline_style('twenty-twenty-one-style', $custom_css);
	}
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages');

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init()
{
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri('/assets/js/customize-preview.js'),
		array('customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers'),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_preview_init', 'twentytwentyone_customize_preview_init');

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts()
{

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts');

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes()
{
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters('twentytwentyone_html_classes', '');
	if (!$classes) {
		return;
	}
	echo 'class="' . esc_attr($classes) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class()
{
	?>
	<script>
		if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
			document.body.classList.add('is-IE');
		}
	</script>
	<?php
}
add_action('wp_footer', 'twentytwentyone_add_ie_class');

if (!function_exists('wp_get_list_item_separator')) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator()
	{
		/* translators: Used between list items, there is a space after the comma. */
		return __(', ', 'twentytwentyone');
	}
endif;

//add_action('init', 'enrolls_students');
function enrolls_students()
{

	include_once(get_stylesheet_directory() . '/vendor/autoload.php');
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$config = [
		'mode' => '+aCJK',
		// "allowCJKoverflow" => true, 
		"autoScriptToLang" => true,
		// "allow_charset_conversion" => false,
		"autoLangToFont" => true,
	];
	$mpdf = new \Mpdf\Mpdf($config);
	//$data = array();
	$pdfcontent = '<h1>こんにちは元気ですか</h1>
		<h2>Employee Details</h2>
		<table autosize="1">
		<tr>
		<?php echo "Hii"?>
		<td style="width: 33%"><strong>NAME</strong></td>
		<td style="width: 36%"><strong>ADDRESS</strong></td>
		<td style="width: 30%"><strong>PHONE</strong></td>
		</tr>
		</table>';

	$mpdf->WriteHTML($pdfcontent);
	$mpdf->SetDisplayMode('fullpage');
	//$mpdf->list_indent_first_level = 0; 
	//$mpdf->autoScriptToLang  = true;
	$mpdf->autoLangToFont  = true;

	//call watermark content and image
	//$mpdf->SetWatermarkText('etutorialspoint');
	//$mpdf->showWatermarkText = true;
	//$mpdf->watermarkTextAlpha = 0.1;

	//output in browser
	//$mpdf->Output();
	$mpdf->Output('MyPDF.pdf', 'D');
	die;
}

/**add_action('init', 'enrolls_studentss');
function enrolls_studentss()
{
	$html = "<table class='head container'>
	<tr>
		<td style='width:100%;text-align:center;' class='header'>
			
			
				<?php echo 'here'; ?>
				<h3 style='font-size: 18pt;'>見積書</h3>
		
				
			
		</td>
	</tr>
</table>";
	echo $html;
}**/

add_action('woocommerce_after_single_product_summary', 'wp_kama_woocommerce_after_single_product_summary_action');
function wp_kama_woocommerce_after_single_product_summary_action()
{
	global $woocommerce, $product, $post;
	if ($product->is_type('variable')) {
		$available_variations = $product->get_available_variations();
		$name = $product->get_title();
		$id = $product->get_id();
		$product_id = $id;
		// echo 
		$product_attr = get_post_meta($id, '_product_attributes');

		//acf group start

		//acf group end
	?>
		<div class="varation_table_main" style="overflow-x:auto;">
			<table class="varation_table" style="width:100%;white-space: nowrap;">
				<tbody>
					<tr>
						<th style="text-align:center;background-color: #f5f5f5;width: 300px;">SKU</th>
						<?php
						$specifications_group_id = 8748; // ID of the your group as you mentioned 
						$specifications_fields = array();
						$fields = acf_get_fields($specifications_group_id);
						$i = 0;
						foreach ($fields as $field) {
							$field_value = get_field($field['name']);
							if ($field_value && !empty($field_value)) {
						?>
								<th style="text-align:center;background-color: #f5f5f5;"><?php echo $field['label']; ?></th>
						<?php }
							$i++;
							if ($i == 3) break;
						} ?>
						<?php
						foreach ($product_attr as $attr) {
							foreach ($attr as $attribute) {
						?>
								<th style="text-align:center;background-color: #f5f5f5;">
									<?php $taxonomy   = $attribute['name'];
									echo $label_name = wc_attribute_label($taxonomy);
									?>
								</th>
						<?php
							}
						}
						?>

						<th style="text-align:center;background-color: #f5f5f5;">在庫状況</th>
						<th style="text-align:center;background-color: #f5f5f5;">価格</th>
						<th style="text-align:center;background-color: #f5f5f5;">数量</th>
						<th style="text-align:center;background-color: #f5f5f5;">カートに追加</th>


					</tr>
					<?php foreach ($available_variations as $key => $value) {
						echo "<pre>";
						//print_r($value); 
					?>
						<tr>
							<td style="font-size: 14px !important;">
								<div style="width: 300px;white-space: break-spaces;margin:auto;"><?php echo $value['sku']; ?></div>
							</td>
							<?php
							$specifications_group_id = 8748; // ID of the your group as you mentioned 
							$specifications_fields = array();
							$fields = acf_get_fields($specifications_group_id);
							$i = 0;
							foreach ($fields as $field) {
								$field_value = get_field($field['name']);
								if ($field_value && !empty($field_value)) {
							?>
									<td style="text-align:center;font-size: 14px;"><?php echo $specifications_fields[$field['name']]['value'] = $field_value; ?></td>
							<?php }
								$i++;
								if ($i == 3) break;
							} ?>

							<?php
							foreach ($value['attributes'] as $attr_key => $attr_value) {


							?>
								<td style="font-size: 14px !important;">
									<b>
										<?php
										$result = substr($attr_key, 0, 16);
										//echo $result;
										if ($result == 'attribute_pa_add') {
											$taxonomy = str_replace('attribute_', '', $attr_key);
											$koostis = $product->get_attribute($taxonomy);
											$str_explode = explode(",", $koostis);

										?>
											<select id="<?php echo $taxonomy; ?>" class="variable" data-id="<?php echo $value['variation_id']; ?>" name="<?php echo $attr_key; ?>" data-attribute_name="<?php echo $attr_key; ?>" data-show_option_none="yes">
												<option value="">
													<font style="vertical-align: inherit;">
														<font style="vertical-align: inherit;">選んでください</font>
													</font>
												</option>
												<?php foreach ($str_explode as $str) {  ?>

													<option value="<?php echo $str; ?>">
														<font style="vertical-align: inherit;">
															<font style="vertical-align: inherit;"><?php echo $str; ?></font>
														</font>
													</option>
												<?php } ?>
											</select>
										<?php
										} else if ($result = substr($attr_key, 0, 16) == 'attribute_%') {
											echo $attr_value;
										} else {
											//echo "Hiiiii";
											echo $attr_value;

											global $wpdb;
											$slug = "SELECT name FROM `wp_terms` WHERE slug = '" . $attr_value . "'";
											$slug_query_array = $wpdb->get_results($slug);
											echo $slug_query_array[0]->name;
										}
										?>
									</b>
								</td>
							<?php } ?>

							<td style="font-size: 14px !important;">
								<?php
								$stock = $value['max_qty'];
								if ($stock > 0) {
									echo "<div style='color:#77a464; font-weight:bold;'>";
									echo $stock;
									echo "<div>";
								} else {
									echo "<div style='color:red; font-weight:bold;'>";
									echo "在庫切れ";
									echo "<div>";
								}
								?>
							</td>
							<td style="font-size: 14px !important;"><?php echo "¥" . number_format($value['display_price']); ?></td>
							<td class="variant_product_quantity" style="font-size: 14px !important;">
								<?php $permalink = get_permalink($product->get_id());
								$step = 1;
								$min_value = 1;
								$max_value = 10000;
								$input_name = $id;
								$input_value = 1;
								$input_name = $id;
								$sku = $product->get_sku();
								?>

								<div class="quantity">
									<label class="screen-reader-text" for="<?php echo esc_attr($id); ?>"><?php esc_html_e('Quantity', 'woocommerce'); ?></label>
									<input type="button" value="-" class="qty_button minus quantity_counter" data-id="<?php echo $value['variation_id'] ?>" />
									<input type="number" data-id="<?php echo $value['variation_id'] ?>" id="<?php echo esc_attr($id); ?>" class="input-text qty text quantity_counter" step="<?php echo esc_attr($step); ?>" min="<?php echo esc_attr($min_value); ?>" max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'woocommerce'); ?>" size="4" />
									<input type="button" value="+" class="qty_button plus quantity_counter" data-id="<?php echo $value['variation_id'] ?>" />
								</div>

							</td>
							<td style="width:115px;font-size: 14px !important;">
								<form action="<?php echo esc_url($product->add_to_cart_url()); ?>" method="post" enctype='multipart/form-data' id="cart_form">
									<input type="hidden" name="variation_id" value="<?php echo $value['variation_id'] ?>" />
									<input type="hidden" name="product_id" value="<?php echo esc_attr($post->ID); ?>" />
									<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($post->ID); ?>" />
									<input type="hidden" id="<?php echo "quantityy_" . $value['variation_id'] ?>" name="quantity" class="quantity_value" value="1" data-id="<?php echo $value['variation_id'] ?>" data-prduct-id="<?php echo esc_attr($post->ID); ?>" />

									<?php
									if (!empty($value['attributes'])) {
										foreach ($value['attributes'] as $attr_key => $attr_value) {
									?>
											<input id="<?php echo $attr_key . "_" . $value['variation_id'] ?>" type="hidden" name="<?php echo $attr_key ?>" value="<?php echo $attr_value ?>">
									<?php
										}
									}
									?>
									<?php
									$stock = $value['max_qty'];
									if ($stock > 0) {
									?>
										<button type="submit" class="single_add_to_cart_button">
											<?php echo apply_filters('single_add_to_cart_text', __('', 'woocommerce'), $product->product_type); ?>
										</button>
									<?php } else { ?>
										<button type="submit" class="single_add_to_cart_button" disabled>
											<?php echo apply_filters('single_add_to_cart_text', __('', 'woocommerce'), $product->product_type); ?>
										</button>
									<?php }
									?>
								</form>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>

			<button type="submit" class="custom_addtocart" id="custom_addtocart">
				ADD TO CART
			</button>
		</div>
		<script>
			jQuery('.variable').on('change', function() {
				var dropdown_name = jQuery(this).attr('name');
				var product_id = jQuery(this).data('id');
				var select_value = this.value;
				jQuery('#' + dropdown_name + '_' + product_id).val(select_value);
			});

			jQuery(function(jQuery) {

				// Quantity "plus" and "minus" buttons
				jQuery(document.body).on('click', '.plus, .minus', function() {
					var qty = jQuery(this).closest('.quantity').find('.qty');
					//alert(qty);
					var val = parseFloat(qty.val());


					var max = parseFloat(qty.attr('max'));
					var min = parseFloat(qty.attr('min'));
					var step = parseFloat(qty.attr('step'));

					// Change the value if plus or minus
					if (jQuery(this).is('.plus')) {
						if (max && (max <= val)) {
							qty.val(max);
						} else {
							qty.val(val + step);
							var plus_val = val + step
							//alert(val + step);
							var data_id_val = jQuery(this).attr("data-id");
							jQuery('#quantityy_' + data_id_val).val(plus_val).trigger('change');
							//var variant_id = jQuery(this).attr('data-id');
							//jQuery('.quantity_value').attr('data-id',variant_id).val(plus_val);
						}
					} else {
						if (min && (min >= val)) {
							qty.val(min);
						} else if (val > 1) {
							qty.val(val - step);
							var minus_val = val - step
							var data_id_val = jQuery(this).attr("data-id");
							jQuery('#quantityy_' + data_id_val).val(minus_val).trigger('change');;
							//alert(minus_val);
							//jQuery('.quantity_value').val(minus_val);
						}
					}

				});
			});

			jQuery('#custom_addtocart').click(function(e) {
				var prduct_arr = [];
				prduct_id_index = 0;
				var quantity_arr = [];
				qty_index = 0;
				var variant_id_arr = [];
				variant_id_index = 0;
				jsonObj = [];
				//prd = {};
				jQuery("input[id^='quantityy_']").each(function(i, el) {
					//console.log('quantity:'+jQuery(this).val());
					//console.log('variation-id:'+jQuery(this).data('id'));
					var quantity = jQuery(this).val();
					//alert(quantity);
					var variation_id = jQuery(this).data('id');
					var product_id = jQuery(this).data('prduct-id');
					prooduct = {};
					prooduct["quantity"] = quantity;
					prooduct["variation_id"] = variation_id;
					prooduct["product_id"] = product_id;
					jsonObj.push(prooduct);
				});
				//console.log(jsonObj);
				//console.log(quantity_arr);
				//console.log(variant_id_arr);
				//console.log(prduct_arr);

				//var formData = jQuery('#cart_form').serialize();
				//console.log(formData);
				var data = jsonObj;
				console.log(data);
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					dataType: 'json',
					data: {
						action: 'woocommerce_ajax_add_to_cart',
						frmdata: data
					},
					//contentType: "application/json",
					complete: function(data) {
						alert('success');
						window.location.href = "http://localhost/testpr/cart/";
					}
				});
				e.preventDefault();
			});
		</script>
<?php
	}
}

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{

	$data = $_POST['frmdata'];
	foreach ($data as $prd) {
		$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($prd['product_id']));
		$quantity = empty($prd['quantity']) ? 1 : wc_stock_amount($prd['quantity']);
		$variation_id = absint($prd['variation_id']);

		if (WC()->cart->add_to_cart($product_id, $quantity, $variation_id)) {

			do_action('woocommerce_ajax_added_to_cart', $product_id);
			echo "ADDEDDDDDDDDDDDDDDDDDD";

			if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
				wc_add_to_cart_message(array($product_id => $quantity), true);
			}

			WC_AJAX::get_refreshed_fragments();
			die;
		} else {

			$data = array(
				'error' => true,
				'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
			);

			echo wp_send_json($data);
		}
	}
	wp_die();
}



//Add panel in product details page admin
add_filter('woocommerce_product_data_tabs', function($tabs) {
	$tabs['additional_info'] = [
		'label' => __('Custom plugin fields', 'txtdomain'),
		'target' => 'additional_product_data',
		'class' => ['hide_if_external'],
		'priority' => 25
	];
	return $tabs;
});

add_action('woocommerce_product_data_panels', function() {
	?><div id="additional_product_data" class="panel woocommerce_options_panel hidden"><?php
 
	woocommerce_wp_text_input([
		'id' => '_dummy_text_input',
		'label' => __('Dummy text input', 'txtdomain'),
		'wrapper_class' => 'show_if_simple',
	]);
	woocommerce_wp_checkbox([
		'id' => '_dummy_checkbox',
		'label' => __('Dummy checkbox', 'txtdomain'),
		'wrapper_class' => 'hide_if_grouped',
	]);
	woocommerce_wp_text_input([
		'id' => '_dummy_text_input',
		'label' => __('Dummy text input', 'txtdomain'),
		'type' => 'text',
	]);
 
	?></div><?php
});

add_action('woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product($post_id);
	
	$product->update_meta_data('_dummy_text_input', sanitize_text_field($_POST['_dummy_text_input']));
 
	$dummy_checkbox = isset($_POST['_dummy_checkbox']) ? 'yes' : '';
	$product->update_meta_data('_dummy_checkbox', $dummy_checkbox);
 
	$product->update_meta_data('_dummy_number_input', sanitize_text_field($_POST['_dummy_number_input']));
	
	$product->save();
});