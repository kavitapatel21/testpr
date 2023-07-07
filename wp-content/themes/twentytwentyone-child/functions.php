<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}


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

/**Get Breadcrumb in single.php START */
function get_breadcrumb()
{
	echo '<a href="' . home_url() . '" rel="nofollow">Home</a>';
	if (is_category() || is_single()) {
		echo "&nbsp;&#187;&nbsp;";
		the_category(' &bull; ');
		if (is_single()) {
			echo " &nbsp;&#187;&nbsp;";
			the_title();
		}
	} elseif (is_page()) {
		echo "&nbsp;&#187;&nbsp;";
		echo the_title();
	} elseif (is_search()) {
		echo "&nbsp;&#187;&nbsp;Search Results for... ";
		echo '"<em>';
		echo the_search_query();
		echo '</em>"';
	}
}
/**Get Breadcrumb in single.php END */