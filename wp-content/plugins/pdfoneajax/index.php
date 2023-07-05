
<?php

/**
 * Plugin Name: Order-PDF
 * Plugin URI: https://www.osusumeshop.jp/
 * Description: osusumeshop
 * Version: 0.1
 * Author: osusumeshop
 * Author URI: https://www.osusumeshop.jp/
 **/

// create table
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = 'wp_order_pdf_id';

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  order_id mediumint(9) NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
// create table


add_action('admin_enqueue_scripts', 'mslb_public_scripts');

function mslb_public_scripts()
{
    wp_enqueue_script('custom_js', plugins_url('/js/pdf.js', __FILE__), array('jquery'), '', true);
}


add_action('init', 'my_rewrite');
function my_rewrite()
{
    global $wp_rewrite;

    add_rewrite_rule('list-data/$', WP_PLUGIN_URL . '/invoice-one.php', 'top');
    $wp_rewrite->flush_rules(true);
}


add_filter('manage_edit-shop_order_columns', 'custom_shop_order_column', 11);
function custom_shop_order_column($columns)
{
    $reordered_columns = array();
    foreach ($columns as $key => $column) {
        $reordered_columns[$key] = $column;


        if ($key ==  'wc_actions') {
            $reordered_columns['my-column1'] = __('PDF', 'theme_slug');
        }
    }
    return $reordered_columns;
}



add_action('manage_shop_order_posts_custom_column', 'custom_orders_list_column_content', 10, 2);
function custom_orders_list_column_content($column, $post_id)
{
    if ('my-column1' == $column) {
?>

        <ul class="wpo_wcpdf-actions">
            <li>
                <a class='button exists pdf_one' style="margin-top: 4px;" data-id="<?php echo $post_id; ?>" href="#">見積書</a>
                <!--<a class='button exists pdf_two'   style="margin-top: 4px;"   data-id="<?php //echo $post_id; 
                                                                                            ?>" href="#" >請求書</a>
			<a class='button exists pdf_three' style="margin-top: 4px;"   data-id="<?php //echo $post_id; 
                                                                                    ?>" href="#">出荷指示書</a>
			<a class='button exists pdf_four'  style="margin-top: 4px;"   data-id="<?php //echo $post_id; 
                                                                                    ?>" href="#">納品書</a>
			<a class='button exists pdf_five'  style="margin-top: 4px;"   data-id="<?php //echo $post_id; 
                                                                                    ?>" href="#">領収書</a> -->
            </li>
        </ul>
    <?php
    }
}


wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/pdf.js');
wp_localize_script('my-script', 'myScript', array(
    'pluginsUrl' => plugins_url(),
));


//Add fields in order details
// Adding Meta container admin shop_order pages
add_action('add_meta_boxes', 'mv_add_meta_boxes');
if (!function_exists('mv_add_meta_boxes')) {
    function mv_add_meta_boxes()
    {
        add_meta_box('mv_other_fields', __('My Field', 'woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core');
    }
}

// Adding Meta field in the meta container admin shop_order pages
if (!function_exists('mv_add_other_fields_for_packaging')) {
    function mv_add_other_fields_for_packaging()
    {
        global $post;

        $meta_field_data = get_post_meta($post->ID, '_my_field_slug', true) ? get_post_meta($post->ID, '_my_field_slug', true) : '';

        echo 'Order id:' . $post->ID;
    }
}

add_action('admin_menu', 'register_my_custom_submenu');

function register_my_custom_submenu()
{
    add_submenu_page('woocommerce', 'My Custom Submenu', 'My custom menu', 'manage_options', 'my-custom-submenu', 'my_custom_submenu_callback');
}

function my_custom_submenu_callback()
{
    $user_id = get_current_user_id();
    if (isset($_POST['SubmitBtn'])) {
        $fone = $_POST['field_one'];
        //update_option('field_one', $fone);
        update_user_meta($user_id, 'field_one', $fone);
        //echo $fone;
        //echo '<br>';
        $ftwo = $_POST['field_two'];
        update_user_meta($user_id, 'field_two', $ftwo);
        //echo $ftwo;
        //echo '<br>';
        //$fileone = $_FILES['field_three']['name'];
        if ($_FILES['field_three']['name']) {

            //$errors = array();
            $file_name = $_FILES['field_three']['name'];
            $file_size = $_FILES['field_three']['size'];
            $file_tmp = $_FILES['field_three']['tmp_name'];
            $file_type = $_FILES['field_three']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['field_three']['name'])));
            $extensions = array("jpeg", "jpg", "png", "pdf");
            if (in_array($file_ext, $extensions) === false) {
                //$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            //if ($file_size > 2097152) {
            //   $errors[] = 'File size must be excately 2 MB';
            // }
            ///if (empty($errors) == true) {

            $uploadfile    =  WP_CONTENT_DIR . '/uploads/';
            move_uploaded_file($file_tmp, $uploadfile . '/' . $file_name);
            //move_uploaded_file($file_tmp, $uploadfile . '/' . time() . "_" . $file_name);
            $upload_file_url    =  get_site_url() . '/wp-content/uploads/' . $file_name;

            $src = media_sideload_image($upload_file_url, null, null, 'src');
            //echo $src;
            //die;
            $image_id = attachment_url_to_postid($src);
            update_user_meta($user_id, 'field_three', $src);
            //$sets = get_option( 'wcfm_marketplace_options' );
            //$sets['store_seal_logo'] = $image_id;
            //update_option('wcfm_marketplace_options', $sets);

            // } else {
            //    print_r($errors);
            //}
        }
        if ($_FILES['field_four']['name']) {

            //$errors = array();
            $file_name = $_FILES['field_four']['name'];
            $file_size = $_FILES['field_four']['size'];
            $file_tmp = $_FILES['field_four']['tmp_name'];
            $file_type = $_FILES['field_four']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['field_four']['name'])));
            $extensions = array("jpeg", "jpg", "png", "pdf");
            if (in_array($file_ext, $extensions) === false) {
                //$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            //if ($file_size > 2097152) {
            //   $errors[] = 'File size must be excately 2 MB';
            // }
            ///if (empty($errors) == true) {

            $uploadfile    =  WP_CONTENT_DIR . '/uploads/';
            move_uploaded_file($file_tmp, $uploadfile . '/' . $file_name);
            //move_uploaded_file($file_tmp, $uploadfile . '/' . time() . "_" . $file_name);
            $upload_file_url    =  get_site_url() . '/wp-content/uploads/' . $file_name;

            $src = media_sideload_image($upload_file_url, null, null, 'src');
            //echo $src;
            //die;
            $image_id = attachment_url_to_postid($src);
            update_user_meta($user_id, 'field_four', $src);
            //$sets = get_option( 'wcfm_marketplace_options' );
            //$sets['store_seal_logo'] = $image_id;
            //update_option('wcfm_marketplace_options', $sets);

            // } else {
            //    print_r($errors);
            //}
        }
        $user_info = get_user_meta($user_id);
        //echo '<pre>';
        //print_r($user_info);
        //var_dump($user_info);
        //echo $fileone;
        //echo '<br>';
        //$filetwo = $_FILES['field_four']['name'];
        //echo $filetwo;
        //echo '<br>';
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <?php $field_one_val = get_user_meta($user_id, 'field_one', true); //echo $field_one_val;
        ?>
        <label class="">First Name</label>
        <input type="text" id="field_one" name="field_one" class="wcfm-text wcfm_ele" style="width: 30%;" value="<?php echo $field_one_val; ?>" placeholder="">
        <br>
        <?php $field_two_val = get_user_meta($user_id, 'field_two', true); ?>
        <label class="">Last Name</label>
        <input type="text" id="field_two" name="field_two" class="wcfm-text wcfm_ele" style="width: 30%;" value="<?php echo $field_two_val; ?>" placeholder="">
        <br>
        <?php $field_three_val = get_user_meta($user_id, 'field_three', true); ?>
        <input type="file" class="wcfm-text wcfm_ele" name="field_three" style="width:200px">
        <div><img src="<?php echo $field_three_val; ?>" alt="Store Invoice Seal Logo" width="50" height="50" style="border-radius: 40px;"> </div>
        </div>
        <br>
        <?php $field_four_val = get_user_meta($user_id, 'field_four', true);
        //echo $field_one_val;
        ?>
        <input type="file" class="wcfm-text wcfm_ele" name="field_four" style="width:200px">
        <div><img src="<?php echo $field_four_val; ?>" alt="Store Invoice Seal Logo" width="50" height="50" style="border-radius: 40px;"> </div>
        </div>
        <br>
        <input type="submit" name="SubmitBtn" value="Submit" />
    </form>
<?php
}
