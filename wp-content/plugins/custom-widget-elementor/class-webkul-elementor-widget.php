<?php
/**
 * Plugin Name: Webkul custom elementor widget
 * Plugin URI: http://www.webkul.com
 * Description: create a own custom elementor wight with help of programming.
 * Author: Webkul
 * Author URI: http://www.webkul.com
 * Version: 1.0.0
 *
 * Domain Path: /languages/
**/

/**
 * Create a widget class and extend elementor widget class.
 */
// function enqueue_elementor_widgets() {
//     wp_enqueue_script('elementor-widgets', plugin_dir_url(__FILE__) . 'js/elementor-widgets.js', array('jquery'), '1.0', true);
//     wp_enqueue_style('elementor-widgets', plugin_dir_url(__FILE__) . 'css/elementor-widgets.css');
// }
// add_action('wp_enqueue_scripts', 'enqueue_elementor_widgets');
// class Webkul_Elementor_Widget  extends Elementor\Widget_Base {

//     /**
//      * Widget name
//      *
//      * @return void
//      */
//     public function get_name() {
//         return 'Add content';
//     }

//     /**
//      * Widget title.
//      *
//      * @return void
//      */
//     public function get_title() {
//         return esc_html__( 'Add content', 'webkul' );
//     }

//     /**
//      * widget icon(more icon: https://elementor.github.io/elementor-icons/ )
//      *
//      * @return void
//      */
//     public function get_icon() {
//         return 'eicon-code';
//     }

//     /**
//      * Widget category.
//      *
//      * @return void
//      */
//     public function get_categories() {
//         return array( 'general' );
//     }

//     /**
//      * Widget search keywords
//      *
//      * @return void
//      */
//     public function get_keywords() {
//         return array( 'Webkul', 'Add content', 'content', 'description' );
//     }


//     /**
//      * Show output
//      *
//      * @return void
//      */
//     public function render() {
//         echo '<p>';
//         echo "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
//         echo '</p>';
//     }
// }



/**Regiter cutom elementor widget [End] */
/**Create custom elementor widget [End] */