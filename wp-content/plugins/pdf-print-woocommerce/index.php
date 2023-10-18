<?php
/**
* Plugin Name: pdf-print-woocommerce
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
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
// create table

// create table
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = 'wp_order_sequence';

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  order_id mediumint(9) NOT NULL,
  pdf mediumint(9) NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
// create table


add_action('admin_enqueue_scripts', 'mslb_public_scripts');
function mslb_public_scripts(){
    wp_enqueue_script('custom_js', plugins_url( '/js/pdf.js', __FILE__ ), array('jquery'), '', true);
}


wp_enqueue_script('my-script', plugins_url() . '/pdf-print-woocommerce/js/pdf.js');
wp_localize_script('my-script', 'myScript', array(
    'pluginsUrl' => plugins_url(),
));


//css start
function css() {
    wp_register_style('css', plugins_url('/css/style.css',__FILE__ ));
    wp_enqueue_style('css');
}

add_action( 'admin_init','css');
//css end

add_filter( 'manage_edit-shop_order_columns', 'custom_shop_order_column',11);
function custom_shop_order_column($columns)
{
    $reordered_columns = array();
    foreach( $columns as $key => $column){
        $reordered_columns[$key] = $column;
		
		
        if( $key ==  'wc_actions' ){
            $reordered_columns['my-column1'] = __( 'PDF','theme_slug');
        }
    }
    return $reordered_columns;
}



add_action( 'manage_shop_order_posts_custom_column' , 'custom_orders_list_column_content', 10, 2 );
function custom_orders_list_column_content( $column, $post_id ){
    if( 'my-column1' == $column )
    {
      ?>
	  
	  <?php 
	  	$plugins_image_url_1 = plugins_url().'/pdf-print-woocommerce/image/1.svg'; 
		$plugins_image_url_2 = plugins_url().'/pdf-print-woocommerce/image/2.svg';
		$plugins_image_url_3 = plugins_url().'/pdf-print-woocommerce/image/3.svg';
		$plugins_image_url_4 = plugins_url().'/pdf-print-woocommerce/image/4.svg';
		$plugins_image_url_5 = plugins_url().'/pdf-print-woocommerce/image/5.svg';

	  ?>
	  <ul class="wpo_wcpdf-actions">
			<li>
			<?php 
			$pdf_one_on_off = get_option( 'pdf-print-woocommerce-option-pdf-one-on' );  
			if($pdf_one_on_off == 'on'){
			?>
			<a class='button exists pdf_one' title="見積書"   style="margin-top: 4px;background-image: url(<?php echo $plugins_image_url_1; ?>);
    background-repeat: no-repeat;background-position: center;padding: 10px 15px 20px;background-size: 23px 23px"   data-id="<?php echo $post_id; ?>" href="#"></a>
			<?php } ?>
			<?php 
			$pdf_two_on_off = get_option( 'pdf-print-woocommerce-option-pdf-two-on' );  
			if($pdf_two_on_off == 'on'){
			?>
			<a class='button exists pdf_two'   title ="請求書"  style="margin-top: 4px;background-image: url(<?php echo $plugins_image_url_2; ?>);
    background-repeat: no-repeat;background-position: center;padding: 10px 15px 20px;background-size: 23px 23px"   data-id="<?php echo $post_id; ?>" href="#" ></a>
			<?php } ?>
			<?php 
			$pdf_three_on_off = get_option( 'pdf-print-woocommerce-option-pdf-three-on' );  
			if($pdf_three_on_off == 'on'){
			?>
			<a class='button exists pdf_three' title ="出荷指示書" style="margin-top: 4px;background-image: url(<?php echo $plugins_image_url_3; ?>);
    background-repeat: no-repeat;background-position: center;padding: 10px 15px 20px;background-size: 23px 23px"   data-id="<?php echo $post_id; ?>" href="#"></a>
			<?php } ?>
			<?php 
			$pdf_four_on_off = get_option( 'pdf-print-woocommerce-option-pdf-four-on' );  
			if($pdf_four_on_off == 'on'){
			?>
			<a class='button exists pdf_four'  title ="納品書"  style="margin-top: 4px;background-image: url(<?php echo $plugins_image_url_4; ?>);
    background-repeat: no-repeat;background-position: center;padding: 10px 15px 20px;background-size: 23px 23px"   data-id="<?php echo $post_id; ?>" href="#"></a>
			<?php } ?>
			<?php 
			$pdf_five_on_off = get_option( 'pdf-print-woocommerce-option-pdf-five-on' );  
			if($pdf_five_on_off == 'on'){
			?>
			<a class='button exists pdf_five'  title ="領収書" style="margin-top: 4px;background-image: url(<?php echo $plugins_image_url_5; ?>);
    background-repeat: no-repeat;background-position: center;padding: 10px 15px 20px;background-size: 23px 23px"   data-id="<?php echo $post_id; ?>" href="#"></a>
			<?php } ?>

			<?php $pdf_five_on_off = get_option( 'pdf-print-woocommerce-option-pdf-five-on' );  if($pdf_five_on_off == 'on'){ ?>
			<!----Added "no-links" class in select option to prevent redirection on edit-order page woocommerce------->
			<!--<select name="vendor_list" id="vendor_list" class="no-link">
							<option value="choose me" style="display: none">Choose one</option>
							<option value="demo1">demo 1</option>
							<option value="demo2">demo 2</option>
			</select>-->
			<?php } ?>
			</li>
		</ul>
	  <?php
    }
}



// Add meta box start
add_action( 'add_meta_boxes', 'mv_add_meta_boxes' );
if ( ! function_exists( 'mv_add_meta_boxes' ) )
{
    function mv_add_meta_boxes()
    {
        add_meta_box( 'mv_other_fields', __('PDF 書類の作成','woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core' );
    }
}

if ( ! function_exists( 'mv_add_other_fields_for_packaging' ) )
{
    function mv_add_other_fields_for_packaging()
    {
        global $post;
        $meta_field_data = get_post_meta( $post->ID, '_my_field_slug', true ) ? get_post_meta( $post->ID, '_my_field_slug', true ) : '';
?>
 <ul class="wpo_wcpdf-actions">
			<li>
			<?php $pdf_one_on_off = get_option( 'pdf-print-woocommerce-option-pdf-one-on' );  if($pdf_one_on_off == 'on'){ ?>
			<a class='button exists pdf_one'   style="margin-top: 4px;"   data-id="<?php echo $post->ID; ?>" href="#">見積書</a>
			<?php } ?>
			<?php $pdf_two_on_off = get_option( 'pdf-print-woocommerce-option-pdf-two-on' );  if($pdf_two_on_off == 'on'){ ?>
			<a class='button exists pdf_two'   style="margin-top: 4px;"   data-id="<?php echo $post->ID; ?>" href="#" >請求書</a>
			<?php } ?>
			<?php $pdf_three_on_off = get_option( 'pdf-print-woocommerce-option-pdf-three-on' );  if($pdf_three_on_off == 'on'){ ?>
			<a class='button exists pdf_three' style="margin-top: 4px;"   data-id="<?php echo $post->ID; ?>" href="#">出荷指示書</a>
			<?php } ?>
			<?php $pdf_four_on_off = get_option( 'pdf-print-woocommerce-option-pdf-four-on' );  if($pdf_four_on_off == 'on'){ ?>
			<a class='button exists pdf_four'  style="margin-top: 4px;"   data-id="<?php echo $post->ID; ?>" href="#">納品書</a>
			<?php } ?>
			<?php $pdf_five_on_off = get_option( 'pdf-print-woocommerce-option-pdf-five-on' );  if($pdf_five_on_off == 'on'){ ?>
			<a class='button exists pdf_five'  style="margin-top: 4px;"   data-id="<?php echo $post->ID; ?>" href="#">領収書</a>
			<?php } ?>
			
			</li>
		</ul>
<?php		
    }
}
// Add meta box end


// add menu start
add_action('admin_menu', 'register_my_custom_submenu');
function register_my_custom_submenu()
{
    add_submenu_page('woocommerce', 'My Custom Submenu', 'PDF 印刷', 'manage_options', 'my-custom-submenu', 'my_custom_submenu_callback');
}
function my_custom_submenu_callback()
{
	//echo "<pre>";
	//print_r($_POST);
	
	$user_id = get_current_user_id();
    if (isset($_POST['SubmitBtn'])) {
       

	   $fone = $_POST['field_one'];
        //update_user_meta($user_id, 'field_one', $fone);
		update_option( 'pdf-print-woocommerce-option-tax', $fone);
		
        //$ftwo = $_POST['field_two'];
       // update_user_meta($user_id, 'field_two', $ftwo);
		
		$ffive = $_POST['field_five'];
       // update_user_meta($user_id, 'field_five', $ffive);
		update_option( 'pdf-print-woocommerce-option-day', $ffive);
		
		$company_name = $_POST['company_name'];
		update_option( 'pdf-print-woocommerce-option-company-name', $company_name);
		
		$pincode = $_POST['pincode'];
		update_option( 'pdf-print-woocommerce-option-pincode', $pincode);
		
		$address = $_POST['address'];
		update_option( 'pdf-print-woocommerce-option-address', $address);
		
		$tele = $_POST['tele'];
		update_option( 'pdf-print-woocommerce-option-tele', $tele); 
		
		$fax = $_POST['fax'];
		update_option( 'pdf-print-woocommerce-option-fax', $fax); 
		
		$pdf_one_on_off = $_POST['one_on_off'];
		if($pdf_one_on_off){
		update_option( 'pdf-print-woocommerce-option-pdf-one-on', $pdf_one_on_off); 
		}else{
		update_option( 'pdf-print-woocommerce-option-pdf-one-on', 'off'); 	
		}
		
		$pdf_two_on_off = $_POST['two_on_off'];
		if($pdf_two_on_off){
		update_option( 'pdf-print-woocommerce-option-pdf-two-on', $pdf_two_on_off); 
		}else{
		update_option( 'pdf-print-woocommerce-option-pdf-two-on', 'off'); 	
		}
		
		$pdf_three_on_off = $_POST['three_on_off'];
		if($pdf_three_on_off){
		update_option( 'pdf-print-woocommerce-option-pdf-three-on', $pdf_three_on_off); 
		}else{
		update_option( 'pdf-print-woocommerce-option-pdf-three-on', 'off'); 	
		}
		
		$pdf_four_on_off = $_POST['four_on_off'];
		if($pdf_four_on_off){
		update_option( 'pdf-print-woocommerce-option-pdf-four-on', $pdf_four_on_off); 
		}else{
		update_option( 'pdf-print-woocommerce-option-pdf-four-on', 'off'); 	
		}
		
		$pdf_five_on_off = $_POST['five_on_off'];
		if($pdf_five_on_off){
		update_option( 'pdf-print-woocommerce-option-pdf-five-on', $pdf_five_on_off); 
		}else{
		update_option( 'pdf-print-woocommerce-option-pdf-five-on', 'off'); 	
		}
		
		if ($_FILES['field_three']['name']) {
			
			$imageInformation = getimagesize($_FILES['field_three']['tmp_name']);
			

			$imageWidth = $imageInformation[0]; //Contains the Width of the Image
			$imageHeight = $imageInformation[1]; //Contains the Height of the Image
			if($imageWidth <= 300 && $imageHeight <=292)
			{
			
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
            $uploadfile    =  WP_CONTENT_DIR . '/uploads/';
            move_uploaded_file($file_tmp, $uploadfile . '/' . $file_name);
            $upload_file_url    =  get_site_url() . '/wp-content/uploads/' . $file_name;
            $src = media_sideload_image($upload_file_url, null, null, 'src');
            $image_id = attachment_url_to_postid($src);
            //update_user_meta($user_id, 'field_three', $src);
			update_option( 'pdf-print-woocommerce-option-logo-one', $src);
			}else{
				echo "<div style='margin-top: 20px;font-size: 14px;color: red;font-weight: 500;'>";
				echo "300px X 292pxの画像をアップロードしてください。";
				echo "</div>";
			}

        }
		
		if ($_FILES['field_four']['name']) {
			
			$imageInformation = getimagesize($_FILES['field_four']['tmp_name']);
			

			$imageWidth = $imageInformation[0]; //Contains the Width of the Image
			$imageHeight = $imageInformation[1]; //Contains the Height of the Image
			if($imageWidth <= 386 && $imageHeight <=85)
			{


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
            $uploadfile    =  WP_CONTENT_DIR . '/uploads/';
            move_uploaded_file($file_tmp, $uploadfile . '/' . $file_name);
            $upload_file_url    =  get_site_url() . '/wp-content/uploads/' . $file_name;

            $src = media_sideload_image($upload_file_url, null, null, 'src');

            $image_id = attachment_url_to_postid($src);
            //update_user_meta($user_id, 'field_four', $src);
			update_option( 'pdf-print-woocommerce-option-logo-two', $src);
			}else{
				echo "<div style='margin-top: 20px;font-size: 14px;color: red;font-weight: 500;'>";
				echo "368px X 85pxの画像をアップロードしてください。";
				echo "</div>";
			}

        }
	}		
	
?>
<h3>PDF 印刷</h3>
 <form action="" method="post" enctype="multipart/form-data">
		
		
		<?php $company_name = get_option( 'pdf-print-woocommerce-option-company-name' ); ?>
		<label style="font-size: 17px; margin-right: 87px;">会社名</label>
        <input type="text" id="company_name" name="company_name" class="" style="width: 30%;" value="<?php echo $company_name; ?>" placeholder="">
		</br></br>
		
		<?php $pincode = get_option( 'pdf-print-woocommerce-option-pincode' ); ?>
		<label style="font-size: 17px; margin-right: 71px;">郵便番号</label>
        <input type="text" id="pincode" name="pincode" class="" style="width: 30%;" value="<?php echo $pincode; ?>" placeholder="">
		</br></br>
		
		<?php $address = get_option( 'pdf-print-woocommerce-option-address' ); ?>
		<label style="font-size: 17px; margin-right: 105px;">住所</label>
        <input type="text" id="address" name="address" class="" style="width: 30%;" value="<?php echo $address; ?>" placeholder="">
		</br></br>
		
		<?php $tele = get_option( 'pdf-print-woocommerce-option-tele' ); ?>
		<label style="font-size: 17px; margin-right: 109px;">Tele</label>
        <input type="text" id="tele" name="tele" class="" style="width: 30%;" value="<?php echo $tele; ?>" placeholder="">
		</br></br>
		
		<?php $fax = get_option( 'pdf-print-woocommerce-option-fax' ); ?>
		<label style="font-size: 17px; margin-right: 114px;">Fax</label>
        <input type="text" id="fax" name="fax" class="" style="width: 30%;" value="<?php echo $fax; ?>" placeholder="">
		</br></br>
		
		<?php $tax = get_option( 'pdf-print-woocommerce-option-tax' ); ?>
		<label style="font-size: 17px; margin-right: 20px;">事業者登録番号</label>
        <input type="text" id="field_one" name="field_one" class="" style="width: 30%;" value="<?php echo $tax; ?>" placeholder="">
		</br></br>
		
		<?php //$field_two_val = get_user_meta($user_id, 'field_two', true); ?>
		<!-- <label style="font-size: 17px; margin-right: 71px;">銀行口座</label>
        <input type="text" id="field_two" name="field_two" class="" style="width: 30%;" value="<?php //echo $field_two_val; ?>" placeholder="">
		</br></br> -->
		
		<?php $day = get_option( 'pdf-print-woocommerce-option-day' ); ?>
		<label style="font-size: 17px; margin-right: 36px;">支払期限日数</label>
        <input type="number" id="field_five" name="field_five" class="" style="width: 30%;" value="<?php echo $day; ?>" placeholder="日数">
		</br></br>
		
		<?php $logo_one = get_option( 'pdf-print-woocommerce-option-logo-one' ); ?>
		<div style="margin-bottom: 20px; display: flex; align-items: center;">
		<label style="font-size: 17px; margin-right: 20px;">角盤</label>
        <input type="file" class="" name="field_three" style="width:200px">
        <div>
		<img src="<?php echo $logo_one;  ?>" alt="Store Invoice Seal Logo"  style="border-radius: 0px; width: 80px;">
		
		</div>
		<div>
		</div>
		</div>
		</br>
   
		<?php $logo_two = get_option( 'pdf-print-woocommerce-option-logo-two' ); ?>
		<div style="margin-bottom: 20px; display: flex; align-items: center;">
        <label style="font-size: 17px; margin-right: 19px; ">ロゴ</label>
        <input type="file" class="" name="field_four" style="width:200px">
        <div>
		<img src="<?php echo $logo_two; ?>" alt="Store Invoice Seal Logo"  style="border-radius: 0px; width: 200px;">
		</div>
		</div>
		</br>
		
		
		<?php $pdf_one_on_off = get_option( 'pdf-print-woocommerce-option-pdf-one-on' ); ?>
		<div style="margin-bottom: 20px;display: flex;align-items: center;">
		<div style="font-size: 17px; margin-right: 41px;">見積書</div>
		<label class="switch">
		<input type="checkbox" id="togBtn" name="one_on_off"  <?php echo $pdf_one_on_off === "on" ? 'checked=checked' : ''; ?>>
		<div class="slider round"></div>
		</label>
		</div>
		</br>
		
		<?php $pdf_two_on_off = get_option( 'pdf-print-woocommerce-option-pdf-two-on' ); ?>
		<div style="margin-bottom: 20px;display: flex;align-items: center;">
		<div style="font-size: 17px; margin-right: 41px;">請求書</div>
		<label class="switch">
		<input type="checkbox" id="togBtn" name="two_on_off"  <?php echo $pdf_two_on_off === "on" ? 'checked=checked' : ''; ?>>
		<div class="slider round"></div>
		</label>
		</div>
		</br>
		
		<?php $pdf_three_on_off = get_option( 'pdf-print-woocommerce-option-pdf-three-on' ); ?>
		<div style="margin-bottom: 20px;display: flex;align-items: center;">
		<div style="font-size: 17px; margin-right: 10px;">出荷指示書</div>
		<label class="switch">
		<input type="checkbox" id="togBtn" name="three_on_off"  <?php echo $pdf_three_on_off === "on" ? 'checked=checked' : ''; ?>>
		<div class="slider round"></div>
		</label>
		</div>
		</br>
		
		<?php $pdf_four_on_off = get_option( 'pdf-print-woocommerce-option-pdf-four-on' ); ?>
		<div style="margin-bottom: 20px;display: flex;align-items: center;">
		<div style="font-size: 17px; margin-right: 45px;">納品書</div>
		<label class="switch">
		<input type="checkbox" id="togBtn" name="four_on_off"  <?php echo $pdf_four_on_off === "on" ? 'checked=checked' : ''; ?>>
		<div class="slider round"></div>
		</label>
		</div>
		</br>
		
		<?php $pdf_five_on_off = get_option( 'pdf-print-woocommerce-option-pdf-five-on' ); ?>
		<div style="margin-bottom: 20px;display: flex;align-items: center;">
		<div style="font-size: 17px; margin-right: 45px;">領収書</div>
		<label class="switch">
		<input type="checkbox" id="togBtn" name="five_on_off"  <?php echo $pdf_five_on_off === "on" ? 'checked=checked' : ''; ?>>
		<div class="slider round"></div>
		</label>
		</div>
		</br>    
        <input type="submit" name="SubmitBtn" value="保存" />
		
 </form>
<?php
}

// add menu end

//functio for change order total table in order details page
add_action('woocommerce_admin_order_totals_after_total', 'custom_admin_order_totals_after_tax', 10, 1 );
function custom_admin_order_totals_after_tax( $order_id ) {
	?>
	<style>
#woocommerce-order-items .wc-order-totals:nth-child(4), #woocommerce-order-items .wc-order-totals:nth-child(5) {
    display: none;
}
	</style>
	<?php
   
    
	$order = wc_get_order($order_id);
	$wc_order = wc_get_order($order_id);
	
	$eight_products_total_arr = array();
	$eight_products_total_tax_arr = array();
	
	$ten_products_total_arr = array();
	$ten_products_total_tax_arr = array();
	foreach ($order->get_items() as $item_key => $item ){
	$product = $item->get_product();
	$tax = new WC_Tax();
	$taxes = $tax->get_rates($product->get_tax_class());
	$rates = array_shift($taxes);
	$item_rate = round(array_shift($rates));
	
		if($item_rate == 8) {
			
		$eight_products_total = round($item->get_total()); 
		$eight_products_total_tax = round($item->get_total_tax()); 
		array_push($eight_products_total_arr, $eight_products_total);
		array_push($eight_products_total_tax_arr, $eight_products_total_tax);
			
		}else{
			
		$ten_products_total = round($item->get_total()); 
		$ten_products_total_tax = round($item->get_total_tax()); 
		array_push($ten_products_total_arr, $ten_products_total);
		array_push($ten_products_total_tax_arr, $ten_products_total_tax);
		
		}
	}
	
	// for 8% total and tax start	
	$eight_products_total_imp =  implode(", ",$eight_products_total_arr);	
	$eight_products_total_exp = explode(" ",$eight_products_total_imp);
	$eight_products_final_total = round(array_sum($eight_products_total_exp));
			
	$eight_products_total_tax_imp =  implode(", ",$eight_products_total_tax_arr);	
	$eight_products_total_tax_exp = explode(" ",$eight_products_total_tax_imp);
	$eight_products_final_tax_total = round(array_sum($eight_products_total_tax_exp));

	$eight_products_total = $eight_products_final_total + $eight_products_final_tax_total;
	// for 8% total and tax end
	// for 8% tax calculation start
	$eight_tax_calculation = $eight_products_total - round($eight_products_total / 1.08);
	$eight_calculation_round = round($eight_tax_calculation);
	// for 8%  tax calculation end
	
	
	// for 10% total and tax start
	$ten_products_total_imp =  implode(", ",$ten_products_total_arr);	
	$ten_products_total_exp = explode(" ",$ten_products_total_imp);
	$ten_products_final_total = round(array_sum($ten_products_total_exp));
		
	$ten_products_total_tax_imp =  implode(", ",$ten_products_total_tax_arr);	
	$ten_products_total_tax_exp = explode(" ",$ten_products_total_tax_imp);
	$ten_products_final_tax_total = round(array_sum($ten_products_total_tax_exp));

	$ten_products_total = $ten_products_final_total + $ten_products_final_tax_total;
	// for 10% total and tax end
	

	
	//shipping 
	$final_sip_total =  $order->get_total_shipping();
	$final_sip_tax_total = $order->get_shipping_tax();
	
	$shipping_total =  $final_sip_total +  $final_sip_tax_total;
	round($shipping_total);
	//shipping
	
	// cod start 
	$cod_arr = array();
	$cod_tax_arr = array();
	foreach( $order->get_items('fee') as $item_id => $item_fee ){
		$cod = $item_fee->get_total();
		array_push($cod_arr, $cod);
		$cod_tax = $item_fee->get_total_tax();
		array_push($cod_tax_arr, $cod_tax);
	}

	$cod_imp =  implode(", ",$cod_arr);	
	$cod_exp = explode(" ",$cod_imp);
	$cod_total = round($pro_sum = array_sum($cod_exp));

	$cod_tax_imp =  implode(", ",$cod_tax_arr);	
	$cod_tax_exp = explode(" ",$cod_tax_imp);
	$cod_tax_total = round($pro_sum = array_sum($cod_tax_exp));	
	
	$cod_total_and_tax =  $cod_total + $cod_tax_total;
	// cod end
	
	$all_total = $cod_total + $cod_tax_total + $ten_products_total + $final_sip_total + $final_sip_tax_total;
	
	$ten_tax_calculation = $all_total - round($all_total / 1.10);
	$ten_calculation_round = round($ten_tax_calculation);
	
	$consumption_tax_total = $eight_calculation_round + $ten_calculation_round;
    ?>
		<tr>
			<td class="label">商品小計:</td>
			<td width="1%"></td>
			<td class="total">
				<span class="woocommerce-Price-amount amount">
				<bdi>
				<span class="woocommerce-Price-currencySymbol">
				</span><?php echo $order->get_subtotal_to_display();?>
				</bdi>
				</span>
				</td>
		</tr>
		
		<!-- new  -->
		<?php 
		global $wpdb;
		$tax_que = "SELECT sum(meta_value)  FROM `wp_woocommerce_order_itemmeta` WHERE order_item_id IN (SELECT distinct order_item_id FROM `wp_woocommerce_order_items` WHERE order_id = $order_id) and meta_key in ('discount_amount','discount_amount_tax')";
		
		
		$tax_query_array = $wpdb->get_results($tax_que);
		
		//echo $wpdb->last_query;
		//echo "<pre>";
		//print_r($tax_query_array);

		$array = json_decode(json_encode($tax_query_array), true);	
		foreach ($array as $dis) {
		$sum = $dis['sum(meta_value)'];
		
		?>
		<?php if ($sum){ ?>
		<tr>
			<td class="label">手数料:</td>
			<td width="1%"></td>
			<td class="total">
				<span class="woocommerce-Price-amount amount">
				<bdi>
				<span class="woocommerce-Price-currencySymbol">
				</span><?php echo '¥'.number_format($sum);?>
				</bdi>
				</span>
				</td>
		</tr>
		<?php } ?>
		<?php } ?>
						<!-- new  -->
		
		<tr>
			<td class="label">送料:</td>
			<td width="1%"></td>
			<td class="total">
				<span class="woocommerce-Price-amount amount">
				<bdi>
				<span class="woocommerce-Price-currencySymbol">
				</span><?php echo '¥'.number_format($shipping_total);?>
				</bdi>
				</span>
				</td>
		</tr>
		<?php if($cod_total_and_tax){ ?>
		<tr>
			<td class="label">手数料:</td>
			<td width="1%"></td>
			<td class="total">
				<span class="woocommerce-Price-amount amount">
				<bdi>
				<span class="woocommerce-Price-currencySymbol">
				</span><?php echo '¥'.number_format($cod_total_and_tax);?>
				</bdi>
				</span>
				</td>
		</tr>
		<?php } ?>
		
		<tr>
			<td class="label">内消費税合計:</td>
			<td width="1%"></td>
			<td class="total">
				<span class="woocommerce-Price-amount amount">
				<bdi>
				<span class="woocommerce-Price-currencySymbol">
				</span><?php echo '¥'.number_format($consumption_tax_total); ?>
				</bdi>
				</span>
				</td>
		</tr>
		
		<tr>
			<td class="label">合計金額:</td>
			<td width="1%"></td>
			<td class="total">
				<span class="woocommerce-Price-amount amount">
				<bdi>
				<span class="woocommerce-Price-currencySymbol">
				</span><?php echo $order->get_formatted_order_total(); ?>
				</bdi>
				</span>
				</td>
		</tr>
    <?php
}

function op_register_menu_meta_box() {
    add_meta_box(
        'Some identifier of your custom box',
        esc_html__( 'フォーム情報', 'text-domain' ),
        'render_meta_box',
        'shop_order', 
        'normal', 
        'low'
    );
}
add_action( 'add_meta_boxes', 'op_register_menu_meta_box' );

function render_meta_box() {
	$id = get_the_ID();
	
	$cus_form_add = get_post_meta( $id, '_cus_form_add' );
	$cus_form_store = get_post_meta( $id, '_cus_form_store' );
	$cus_form_info_date = get_post_meta( $id, '_cus_form_info_date' ); 
	$cus_form_info_exp_date = get_post_meta( $id, '_cus_form_info_exp_date' ); 
	$cus_form_info_quotation = get_post_meta( $id, '_cus_form_info_quotation' ); 
	$cus_form_info_deli_date = get_post_meta( $id, '_cus_form_info_deli_date' ); 
	$cus_form_info_bill_date_four = get_post_meta( $id, '_cus_form_info_bill_date_four' ); 
	$cus_form_info_deli_detail = get_post_meta( $id, '_cus_form_info_deli_detail' ); 
	$cus_form_info_bill_date = get_post_meta( $id, '_cus_form_info_bill_date' ); 
	$cus_form_info_invoice_detail = get_post_meta( $id, '_cus_form_info_invoice_detail' ); 
	
	$cus_form_info_issue_date = get_post_meta( $id, '_cus_form_info_issue_date' ); 
	$cus_form_info_receipt_detail = get_post_meta( $id, '_cus_form_info_receipt_detail' ); 
	$cus_form_info_ship_issue_date = get_post_meta( $id, '_cus_form_info_ship_issue_date' ); 
	$cus_form_info_ship_issue_detail = get_post_meta( $id, '_cus_form_info_ship_issue_detail' ); 
	$cus_form_info_state_issue_date = get_post_meta( $id, '_cus_form_info_state_issue_date' ); 
	$cus_form_info_state_issue_detail = get_post_meta( $id, '_cus_form_info_state_issue_detail' ); 
	$cus_form_last_date = get_post_meta( $id, '_cus_form_last_date' ); 
?>
<style>
			.order-detail-container {
				width: 100%;
				display: grid;
				grid-template-columns: 1fr 1fr 1fr;
			}

			.order-detail-container .custom-detail-col .wcfm-detail-box {
				border: 1px solid #ddd;
				padding: 12px;
				border-radius: 10px;
			}

			.order-detail-container p.wcfm_title {
				width: 100%;
			}
			.form-control{
				display: block;
				width: 100%;
				height: calc(1.5em + 0.75rem + 2px);
				
				font-size: 1rem;
				font-weight: 400;
				line-height: 1.5;
				color: #495057;
				background-color: #fff;
				background-clip: padding-box;
				border: 1px solid #ced4da;
				border-radius: 0.25rem;
			}
			textarea.form-control {
    height: auto;
}
</style>
<form name="" id="" action="" method="">
<input type="hidden" name="order_id" value="<?php echo $id; ?>">
<div class="wcfm-clearfix"></div><br />
<!-- collapsible -->
<div class="page_collapsible orders_details_items" id="wcfm_orders_items_options"><?php _e('帳票情報', 'wc-frontend-manager'); ?><span></span></div>
<div class="wcfm-container order-detail-container" style="gap: 20px; grid-template-columns: 1fr 1fr;">
	<div class="custom-detail-col">
					<div class="wcfm-detail-box">
					
					<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">宛名</font>
								</font>
							</strong></p>
					<input type="text" id="_cus_form_add" name="_cus_form_add" class="wcfm-text wcfm_ele form-control" value="<?php echo $cus_form_add[0] ?>" placeholder="">
					
					<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">件名</font>
								</font>
							</strong></p>
					<input type="text" id="_cus_form_store" name="_cus_form_store" class="wcfm-text wcfm_ele form-control" value="<?php echo $cus_form_store[0] ?>" placeholder="">
					
					
						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">見積日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_date" name="_cus_form_info_date" class="wcfm-text wcfm_ele form-control" value="<?php echo$cus_form_info_date[0] ?>" placeholder="">

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">有効期限</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_exp_date" name="_cus_form_info_exp_date" class="wcfm-text wcfm_ele form-control" value="<?php echo $cus_form_info_exp_date[0] ?>" placeholder="">

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">見積書備考欄</font>
								</font>
							</strong></p>
						<textarea id="_cus_form_info_quotation" name="_cus_form_info_quotation" class="wcfm-text wcfm_ele form-control"> <?= $cus_form_info_quotation[0]; ?></textarea>

						<!-- <p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">納品日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_deli_date" name="_cus_form_info_deli_date" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_info_deli_date[0]; ?>" placeholder=""> -->
						
						<!-- -->
						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">納品書発行日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_bill_date_four" name="_cus_form_info_bill_date_four" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_info_bill_date_four[0]; ?>" placeholder="">
						
						<!-- -->

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">納品書備考欄</font>
								</font>
							</strong></p>
						<textarea id="_cus_form_info_deli_detail" name="_cus_form_info_deli_detail" class="wcfm-text wcfm_ele form-control"><?= $cus_form_info_deli_detail[0]; ?></textarea>

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">請求日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_bill_date" name="_cus_form_info_bill_date" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_info_bill_date[0]; ?>" placeholder="">

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">請求書備考欄</font>
								</font>
							</strong></p>
						<textarea id="_cus_form_info_invoice_detail" name="_cus_form_info_invoice_detail" class="wcfm-text wcfm_ele form-control"><?= $cus_form_info_invoice_detail[0]; ?></textarea>
					</div>
				</div>
				<div class="custom-detail-col">
					<div class="wcfm-detail-box">
						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">領収書発行日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_issue_date" name="_cus_form_info_issue_date" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_info_issue_date[0]; ?>" placeholder="">

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">領収書備考欄</font>
								</font>
							</strong></p>
						<textarea id="_cus_form_info_receipt_detail" name="_cus_form_info_receipt_detail" class="wcfm-text wcfm_ele form-control"><?= $cus_form_info_receipt_detail[0]; ?></textarea>

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">出荷指示書発行日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_ship_issue_date" name="_cus_form_info_ship_issue_date" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_info_ship_issue_date[0]; ?>" placeholder="">

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">出荷指示書備考欄</font>
								</font>
							</strong></p>
						<textarea id="_cus_form_info_ship_issue_detail" name="_cus_form_info_ship_issue_detail" class="wcfm-text wcfm_ele form-control"><?= $cus_form_info_ship_issue_detail[0]; ?></textarea>

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">精算書発行日</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_info_state_issue_date" name="_cus_form_info_state_issue_date" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_info_state_issue_date[0]; ?>" placeholder="">

						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">精算書備考欄(販売店用)</font>
								</font>
							</strong></p>
						<textarea id="_cus_form_info_state_issue_detail" name="_cus_form_info_state_issue_detail" class="wcfm-text wcfm_ele form-control"><?= $cus_form_info_state_issue_detail[0]; ?></textarea>
						<!-- -->
						<p class="wcfm_ele wcfm_title"><strong>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;" class="">請求支払い期限</font>
								</font>
							</strong></p>
						<input type="date" id="_cus_form_last_date" name="_cus_form_last_date" class="wcfm-text wcfm_ele form-control" value="<?= $cus_form_last_date[0]; ?>" placeholder="">
						
						<!-- -->
						
						
					</div>
				</div>
	<div class="custom-detail-col"></div>
				<div class="custom-detail-col" style="text-align: right;padding: 12px;">
				<input type="button" name="submit" id="" class="order_details add_note button" style="font-size: 16px;background-color: #206aa7;color: #fff; padding: 0px 24px;" value="更新"></button>
				<div class="e_msg" style="display:none; font-weight:500; color:green;">注文を更新しました。</div>
				</div>
				
</div>
</form>

<script>
jQuery(document).on('click', '.order_details', function(e) {

				var order_id = jQuery('input[name="order_id"]').val();
				
				var cus_form_add = jQuery('input[name="_cus_form_add"]').val();
				var cus_form_store = jQuery('input[name="_cus_form_store"]').val();
				var cus_form_info_date = jQuery('input[name="_cus_form_info_date"]').val();
				var cus_form_info_exp_date = jQuery('input[name="_cus_form_info_exp_date"]').val();				
				var cus_form_info_quotation = jQuery('#_cus_form_info_quotation').val();
				var cus_form_info_deli_date = jQuery('input[name="_cus_form_info_deli_date"]').val();
				
				var cus_form_info_bill_date_four = jQuery('input[name="_cus_form_info_bill_date_four"]').val();
				
				var cus_form_info_deli_detail = jQuery('#_cus_form_info_deli_detail').val();
				var cus_form_info_bill_date = jQuery('input[name="_cus_form_info_bill_date"]').val();
				var cus_form_info_invoice_detail = jQuery('#_cus_form_info_invoice_detail').val();
				var cus_form_info_issue_date = jQuery('input[name="_cus_form_info_issue_date"]').val();
				var cus_form_info_receipt_detail = jQuery('#_cus_form_info_receipt_detail').val();
				
				var cus_form_info_ship_issue_date = jQuery('input[name="_cus_form_info_ship_issue_date"]').val();
				var cus_form_info_ship_issue_detail = jQuery('#_cus_form_info_ship_issue_detail').val();
				var cus_form_info_state_issue_date = jQuery('input[name="_cus_form_info_state_issue_date"]').val();
				var cus_form_info_state_issue_detail = jQuery('#_cus_form_info_state_issue_detail').val();		
				var cus_form_last_date = jQuery('#_cus_form_last_date').val();						
				
				jQuery.ajax({
					type: 'POST',
					dataType: 'json',
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					data: {
						'action': 'order_details_form',
						'order_id': order_id,
						'cus_form_add': cus_form_add,
						'cus_form_store': cus_form_store,
						'cus_form_info_date': cus_form_info_date,
						'cus_form_info_exp_date': cus_form_info_exp_date,
						'cus_form_info_quotation': cus_form_info_quotation,
						'cus_form_info_deli_date': cus_form_info_deli_date,
						
						'cus_form_info_bill_date_four': cus_form_info_bill_date_four,
						
						'cus_form_info_deli_detail': cus_form_info_deli_detail,
						'cus_form_info_bill_date': cus_form_info_bill_date,
						'cus_form_info_invoice_detail': cus_form_info_invoice_detail,
						'cus_form_info_issue_date': cus_form_info_issue_date,
						'cus_form_info_receipt_detail': cus_form_info_receipt_detail,
						
						'cus_form_info_ship_issue_date': cus_form_info_ship_issue_date,
						'cus_form_info_ship_issue_detail': cus_form_info_ship_issue_detail,
						'cus_form_info_state_issue_date': cus_form_info_state_issue_date,
						'cus_form_info_state_issue_detail': cus_form_info_state_issue_detail,
						'cus_form_last_date': cus_form_last_date,
						
						
					},

					success: function(response) {
						console.log(response);
							jQuery('.e_msg').show();
					}
				});
		
			
		});
		
		

	

</script>

<?php
}


add_action('wp_ajax_order_details_form', 'order_details_form');
add_action('wp_ajax_nopriv_order_details_form', 'order_details_form');
function order_details_form()
{	
	$order_id = $_POST['order_id'];
	
	$cus_form_add = $_POST['cus_form_add'];
	$cus_form_store = $_POST['cus_form_store'];
	$cus_form_info_date = $_POST['cus_form_info_date'];
	$cus_form_info_exp_date = $_POST['cus_form_info_exp_date'];
	$cus_form_info_quotation = $_POST['cus_form_info_quotation'];
	$cus_form_info_deli_date = $_POST['cus_form_info_deli_date'];
	
	$cus_form_info_bill_date_four = $_POST['cus_form_info_bill_date_four'];
	
	$cus_form_info_deli_detail = $_POST['cus_form_info_deli_detail'];
	$cus_form_info_bill_date = $_POST['cus_form_info_bill_date'];
	$cus_form_info_invoice_detail = $_POST['cus_form_info_invoice_detail'];
	$cus_form_info_issue_date = $_POST['cus_form_info_issue_date'];
	$cus_form_info_receipt_detail = $_POST['cus_form_info_receipt_detail'];
	
	$cus_form_info_ship_issue_date = $_POST['cus_form_info_ship_issue_date'];
	$cus_form_info_ship_issue_detail = $_POST['cus_form_info_ship_issue_detail'];
	$cus_form_info_state_issue_date = $_POST['cus_form_info_state_issue_date'];
	$cus_form_info_state_issue_detail = $_POST['cus_form_info_state_issue_detail'];
	$cus_form_last_date = $_POST['cus_form_last_date'];
	
	if (isset($cus_form_add)) {
				update_post_meta($order_id, '_cus_form_add', $cus_form_add);
	}
	
	if (isset($cus_form_store)) {
				update_post_meta($order_id, '_cus_form_store', $cus_form_store);
	}
	
	if (isset($cus_form_info_date)) {
				update_post_meta($order_id, '_cus_form_info_date', $cus_form_info_date);
	}
	if (isset($cus_form_info_exp_date)) {
				update_post_meta($order_id, '_cus_form_info_exp_date', $cus_form_info_exp_date);
	}
	if (isset($cus_form_info_quotation)) {
				update_post_meta($order_id, '_cus_form_info_quotation', $cus_form_info_quotation);
	}
	if (isset($cus_form_info_deli_date)) {
				update_post_meta($order_id, '_cus_form_info_deli_date', $cus_form_info_deli_date);
	}
	
	if (isset($cus_form_info_bill_date_four)) {
				update_post_meta($order_id, '_cus_form_info_bill_date_four', $cus_form_info_bill_date_four);
	}
	
	if (isset($cus_form_info_deli_detail)) {
				update_post_meta($order_id, '_cus_form_info_deli_detail', $cus_form_info_deli_detail);
	}
	if (isset($cus_form_info_bill_date)) {
				update_post_meta($order_id, '_cus_form_info_bill_date', $cus_form_info_bill_date);
	}
	if (isset($cus_form_info_invoice_detail)) {
				update_post_meta($order_id, '_cus_form_info_invoice_detail', $cus_form_info_invoice_detail);
	}
	if (isset($cus_form_info_issue_date)) {
				update_post_meta($order_id, '_cus_form_info_issue_date', $cus_form_info_issue_date);
	}
	if (isset($cus_form_info_receipt_detail)) {
				update_post_meta($order_id, '_cus_form_info_receipt_detail', $cus_form_info_receipt_detail);
	}
	
	if (isset($cus_form_info_ship_issue_date)) {
				update_post_meta($order_id, '_cus_form_info_ship_issue_date', $cus_form_info_ship_issue_date);
	}
	if (isset($cus_form_info_ship_issue_detail)) {
				update_post_meta($order_id, '_cus_form_info_ship_issue_detail', $cus_form_info_ship_issue_detail);
	}
	if (isset($cus_form_info_state_issue_date)) {
				update_post_meta($order_id, '_cus_form_info_state_issue_date', $cus_form_info_state_issue_date);
	}
	if (isset($cus_form_info_state_issue_detail)) {
				update_post_meta($order_id, '_cus_form_info_state_issue_detail', $cus_form_info_state_issue_detail);
	}
	if (isset($cus_form_last_date)) {
				update_post_meta($order_id, '_cus_form_last_date', $cus_form_last_date);
	}
	
	return true;
	die;
}

