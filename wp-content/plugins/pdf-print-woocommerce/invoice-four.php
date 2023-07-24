<style>
body{
	font-family: 'Open Sans', sans-serif;
}
.heading{margin:auto;font-size:24px !important;margin-bottom:20px;margin-top:5px;}
.heading h3{font-size:24px !important;font-weight:bold;}
.footer_th{text-align:center; background-color: rgb(141, 138, 138); border: none !important; color: rgb(255, 255, 255); padding-top: 12px; padding-bottom: 12px;}
.totals th.description, table.totals td.price {width: 50%;}
	.order-details thead td{text-align:center;}
.totals th, table.totals td {border: 1px solid rgb(204, 204, 204);}
.totals th {color: rgb(255, 255, 255);background-color: rgb(141, 138, 138);border-color: rgb(141, 138, 138);text-align:left;}
table.totals td{text-align:right;}
.order-details thead td, .totals th {
    color: white;
    background-color: #8D8A8A;
    border-color: #8D8A8A;
}
.order-details thead tr{
	text-align:center;
}
table{
	border-collapse:collapse;
	font-size:12px;
}
table.totals th{
	text-align:center;
}
table th{font-weight:bold;}
table.totals th, table.totals td {
    border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
}
.order-details td, .order-details th {
    border: 1px solid #ddd;
    padding: 8px;
}
.address.billing-address .price{text-align:left;border:0;}
.order-data-addresses{width:100%;margin-bottom:20px;}
.order-details tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
<?php 

global $wpdb;
require_once( '../../../wp-config.php' );
require_once( '../../../wp-load.php' );
$tablename = 'wp_order_pdf_id';
$order_id = $wpdb->get_results("SELECT order_id FROM $tablename");
$pdf =  $order_id[0]->order_id;
$order =  $order_id[0]->order_id;



$order = wc_get_order($order); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<table class="heading">
	<tr>
		<td>
			<?php echo '<h3>納品書</h3>'; ?>
		</td>
	</tr>
</table>
<table class="order-data-addresses">
	<tbody>
		<tr>
			<td class="address billing-address" width="70%">
			<?php 
			$cus_form_add = get_post_meta($pdf, '_cus_form_add' );
			$address = $cus_form_add[0]; 
			if($address){ 
			echo $address;
			}else{
			?>
				<?php 
					$billing_company = $order->get_billing_company();
					if($billing_company){
					echo $order->get_billing_company();?> 御中<?php 
					}else{
					
					echo $order->get_billing_last_name().' '.$order->get_billing_first_name(); 
					?> 様
				<?php } ?>
				<?php } ?>
			</td>
			<td class="address billing-address" width="30%" style="margin-top:20px;">
				<table class="totals" style="margin-top:20px;width:100%;">
					<tfoot>
						<tr>
							<th class="description textcenter">No</th>
							<?php 
							$post_id = $wpdb->get_results("SELECT pdf FROM `wp_order_sequence` WHERE (order_id = $pdf)");	
							$predefineNumber = sprintf('%09d', $post_id[0]->pdf);					
							?>
							<td class="price" style="border:1px solid #ccc;"><span class="order-number"><?php echo "1".$predefineNumber; ?></span></td>
						</tr>										
						<?php $cus_form_info_issue_date_four  = get_post_meta( $order_id[0]->order_id, '_cus_form_info_bill_date_four'); 
						
						//echo "<pre>";
						//print_r($cus_form_info_issue_date_four);
							if($cus_form_info_issue_date_four [0]){
							?>
							<tr>
								<th class="description textcenter">発行日</th>
								<td class="price" style="border:1px solid #ccc;"><span class="invoice-date"><?php echo date_i18n(wc_date_format(), strtotime($cus_form_info_issue_date_four[0])); ?></span></td>
							</tr>
							<?php }else{ ?>
							
							<tr>
								<th class="description textcenter">発行日</th>
								<?php $current_date = date('Y-m-d');?>
								<td class="price" style="border:1px solid #ccc;"><span class="invoice-date"><?php echo date_i18n(wc_date_format(), strtotime($current_date)); ?></span></td>
							</tr>
							
							<?php } ?>									
					</tfoot>
				</table>
			</td>
		</tr>	
		<tr>
			<td class="address billing-address">
				下記のとおり、納品致します。
			</td>
		</tr>
		<tr style="vertical-align: baseline;">
			<td class="address billing-address">
				<table class="totals remove-border" style="width:100%" border="0">
					<tfoot>
						<tr>
							<td style="width:50%;border:0;">
								<table class="totals remove-border" style="width:100%" border="0">
									<tfoot>
										<tr>
											<th style="width:20%" class="description textcenter">件名</th>
											<?php $cus_form_store = get_post_meta( $pdf, '_cus_form_store' ); ?>
											<?php if($cus_form_store[0]){ ?>
											<td class="price"><span class="order-number"><?php echo $cus_form_store[0] ?></span></td>
											<?php }else{ ?>
											<td class="price"><span class="order-number">通信販売</span></td>
											<?php } ?>
										</tr>
										<tr>
											<th style="width:20%" class="description textcenter">決済方法</th>
											<td class="price">
												<span class="invoice-date"><?php echo $payment_title = $order->get_payment_method_title(); ?></span>															</td>
										</tr>
										<tr>
											<th style="width:20%" class="description textcenter">出荷予定日</th>
										<?php
											 $key_1_values = get_post_meta( $pdf, '_wc_shipment_tracking_items' ); 
											 if($key_1_values){
											 $count = count($key_1_values[0]);
											 }
											 if($count > 2){
												 ?>
												 <td class="price"><span class="order-number"> 
												 <?php 
												 $date_arr = array();
												 foreach ($key_1_values[0] as $value){
													  $date = $value['date_shipped'];
													  array_push($date_arr, $date);
												 }
												 sort($date_arr);
												 $date_count = count($date_arr);								 
												 $first_date =  date('m/d/Y', $date_arr[0]);
												 echo date_i18n(wc_date_format(), strtotime($first_date));
												 echo "-";
												 $last_date =  date('m/d/Y', $date_arr[$date_count-1]);
												 echo date_i18n(wc_date_format(), strtotime($last_date));
												 ?>
												 </span></td>
												 <?php

											 }else if($count >= 1){

												  ?>
												  <td class="price"><span class="order-number"> 
												  <?php
												  $num_count = 0;
												  foreach ($key_1_values[0] as $value){

													  $two_date = date('m/d/Y',$value['date_shipped']);
													  echo date_i18n(wc_date_format(), strtotime($two_date));

													$num_count = $num_count + 1;
													 if ($num_count < $count ) {
														echo " - ";
													}
												  }
												  ?>	</span></td>
												<?php
											 }else{
												?><td class="price"><span class="order-number">未定</span></td> <?php
											}	
											?>

										</tr>

										<?php $ship_date = get_post_meta( $pdf, 'wc4jp-tracking-ship-date' ); ?>
											<?php if($ship_date[0]){ ?>
										<tr>
											<th style="width:20%" class="description textcenter">納品予定日</th>
											<td class="price"><span class="invoice-date"><?php echo date_i18n(wc_date_format(), strtotime($ship_date[0])); ?></span>											</td>
										</tr>
											<?php } ?>
									</tfoot>
								</table>
							</td>
							<td style="width:50%;border:0;">
								<table style="width:100%;border:0;">
										<tfoot>
										<?php $tracking_id = get_post_meta( $pdf, '_wc_shipment_tracking_items' ); 
										if($tracking_id){
										?>
										<tr>
											<th style="width:20%" class="description textcenter">問合せ番号</th>											
											<td class="price"><span class="order-number">
											<?php 
											
											foreach ($tracking_id as $id){
											$num_of_items = count($id);
											$num_count = 0;
												foreach($id as $tid){												
													echo $tid['tracking_number'];
													$num_count = $num_count + 1;
													 if ($num_count < $num_of_items) {
														echo ", ";
													}
													

												}
											}	
											?>
											<?php //echo $key_1_values[0][0]['tracking_number']; ?>
											</span></td>
										</tr>
										<?php } ?>
										<!--courier name -->
										<?php
										$key_1_values = get_post_meta( $pdf, '_wc_shipment_tracking_items' ); 					
										if($key_1_values){
										?>
										<tr>
											<th style="width:20%" class="description textcenter">配送会社</th>
											<td class="price"><span class="invoice-date">
											<?php 
											
											foreach ($key_1_values as $id){
											$num_of_items = count($id);
											$num_count = 0;
												foreach($id as $tid){												
													$pname = $tid['tracking_provider'];
													
													$tracking_provider_name = $wpdb->get_results("SELECT custom_provider_name FROM wp_woo_shippment_provider WHERE ts_slug = '$pname'");
													echo $tracking_provider_name[0]->custom_provider_name;
													$num_count = $num_count + 1;
													 if ($num_count < $num_of_items) {
														echo ", ";
													}
													

												}
											}	
											?>
											<?php //echo $key_1_values[0][0]['tracking_provider']; ?>
											</span></td>
										</tr>
										<?php } ?>
										<!-- -->
										<?php 
										$delivery_date = get_post_meta( $order_id[0]->order_id, 'wc4jp-delivery-date' ); 
										$delivery_time = get_post_meta( $order_id[0]->order_id, 'wc4jp-delivery-time-zone' ); 
										//$date_time = $delivery_date[0] .' - '. $delivery_time[0];
										?>
										<?php if($delivery_date){ ?>
										<tr>
											<th style="width:20%" class="description textcenter">希望配達日</th>
											<td class="price"><span class="order-number"><?php echo  date_i18n(wc_date_format(), strtotime($delivery_date[0])); ?>													</span>
											</td>
										</tr>
										<?php } ?>
										<?php if($delivery_time){ ?>
										<tr>
											<th style="width:20%" class="description textcenter">希望時間</th>
											<td class="price"><span class="order-number"><?php echo $delivery_time[0]; ?></span></td>
										</tr>
										<?php } ?>
									</tfoot>
								</table>
							</td>
						</tr>
					</tfoot>
				</table>
				<table class="totals" style="margin-top: 10px;margin-bottom:10px;" cellpadding="0" cellspacing="0">
					<tfoot>
						<tr>
							<th style="width:30%;" class="description textcenter">合計金額</th>
							<td style=" border: 1px solid #ccc;" class="price">
								<span class="totals-price">
									<span class="woocommerce-Price-amount amount">
										<bdi>
											<?php 
											echo number_format($order->get_total());
											//echo $order->get_formatted_order_total(); ?>
										</bdi>
									</span>
									円 （税込）
								</span>
							</td>
						</tr>
					</tfoot>
				</table>
				<table class="totals remove-border" style="width:100%" border="0">
					<tfoot>
						<tr>
							<td style="width:50%;border:0;">
								<table style="width:100%;border:0;">
									<tfoot>
										<?php 
										$order = wc_get_order( $pdf ); 
										$order_data = $order->get_data();
										$order_billing_name = $order_data['billing']['first_name'];
										$order_billing_last_name = $order_data['billing']['last_name'];
										$full_name = $order_billing_last_name ."".$order_billing_name; 
										if($full_name){ 
										?>
										<tr>
											<th style="width:20%" class="description textcenter">注文者名</th>
											<td class="price"><span class="order-number"><?php echo $full_name; ?></span></td>
										</tr>
										<?php } ?>
										<?php 
										$order = wc_get_order( $pdf ); 
										$order_data = $order->get_data();
										$order_postcode =  $order_data['billing']['postcode'];
										$order_city =  $order_data['billing']['city'];
										$order_address_one =  $order_data['billing']['address_1'];
										$order_address_two =  $order_data['billing']['address_2'];
										$full_address = $order_postcode .''. $order_city .''. $order_address_one .''. $order_address_two;
										if($full_address){
										?>
										<tr>
											<th style="width:20%" class="description textcenter">ご住所</th>
										
											<td class="price"><span class="order-number"><?php echo $full_address; ?></span></td>
										</tr>
										<?php } ?>
										<?php 
										$order = wc_get_order( $pdf ); 
										$order_data = $order->get_data();
										$order_billing_phone = $order_data['billing']['phone'];
										if($order_billing_phone){
										?>
										<tr>
											<th style="width:20%" class="description textcenter">電話番号</th>										
											<td class="price"><span class="order-number"><?php echo $order_billing_phone; ?></span></td>
										</tr>
										<?php } ?>
									</tfoot>
								</table>
							</td>
							<td style="width:50%;border:0;">
								<table style="width:100%;border:0;">
									<tfoot>
									<?php 
									$order = wc_get_order( $pdf ); 
									$order_data = $order->get_data();
									$order_shipping_first_name = $order_data['shipping']['first_name'];
									$order_shipping_last_name = $order_data['shipping']['last_name'];
									$shipping_full_name =  $order_shipping_last_name ."".$order_shipping_first_name;
									if($shipping_full_name){
									?>
									
										<tr>
											<th style="width:20%" class="description textcenter">配送先名</th>										
											<td class="price"><span class="order-number"><?php echo $shipping_full_name; ?></span></td>
										</tr>
									<?php } ?>
									<?php 
										$order = wc_get_order( $pdf ); 
										$order_data = $order->get_data();
										$order_postcode =  $order_data['shipping']['postcode'];
										$order_city =  $order_data['shipping']['city'];
										$order_address_one =  $order_data['shipping']['address_1'];
										$order_address_two =  $order_data['shipping']['address_2'];
										$shipping_full_address = $order_postcode .''. $order_city .''. $order_address_one .''. $order_address_two;
										if($shipping_full_address){?>
										<tr>
											<th style="width:20%" class="description textcenter">ご住所</th>
										
											<td class="price"><span class="order-number"><?php echo $shipping_full_address; ?></span></td>
										</tr>
										<?php } ?>
										<?php 
										$order = wc_get_order( $pdf ); 
										$order_data = $order->get_data();
										$order_shipping_first_phone = $order_data['shipping']['phone'];
										if($order_shipping_first_phone){
										?>
										<tr>
											<th style="width:20%" class="description textcenter">電話番号</th>										
											<td class="price"><span class="order-number"><?php echo $order_shipping_first_phone; ?></span></td>
										</tr>
										<?php } ?>
										

									</tfoot>
								</table>
							</td>
						</tr>
					</tfoot>
				</table>
			</td>
			<td class="address billing-address" style="line-height:20px;vertical-align: top;">
				<p>
				<?php 
					//global $wpdb;
					//$img = $wpdb->get_results("SELECT `meta_value` FROM `wp_usermeta` WHERE `meta_key` = 'field_four'"); 
					//$img[0]->meta_value;
					$logo_two = get_option( 'pdf-print-woocommerce-option-logo-two' );
					?>
					<?php if($logo_two){ ?>
					<img style="width:150px;margin-bottom:15px;" src="<?php echo $logo_two; ?>">
					<?php } ?>
				</p>
				<p style="margin-bottom:20px;"><?php echo $logo_one = get_option( 'pdf-print-woocommerce-option-company-name' ); ?></p>
				<p style="margin-bottom:20px;"><?php echo $pincode = get_option( 'pdf-print-woocommerce-option-pincode' ); ?></p>
				<div class="center">
					<p style="margin-bottom:20px;"><?php echo $address = get_option( 'pdf-print-woocommerce-option-address' );?></p>
					<p style="margin-bottom:20px;">TEL: <?php echo $tele = get_option( 'pdf-print-woocommerce-option-tele' ); ?></p>
					<p style="margin-bottom:20px;">FAX: <?php echo $fax = get_option( 'pdf-print-woocommerce-option-fax' ); ?></p>
					<?php 
					$tax = get_option( 'pdf-print-woocommerce-option-tax' );
					?>
					<?php if($tax){ ?>
					<p style="margin-bottom:20px;">事業者登録番号: <?php echo $tax; ?></p>	
					<?php } ?>
				</div>
				<div style="position:absolute; margin-top: 18%; padding-right: 12%;">
					<p style="position:absolute; width: 10%; height:5%; float: right;">
					<?php 
					//global $wpdb;
					//$img = $wpdb->get_results("SELECT `meta_value` FROM `wp_usermeta` WHERE `meta_key` = 'field_three'"); 
					//$img[0]->meta_value;
					$logo_one = get_option( 'pdf-print-woocommerce-option-logo-one' );
					?>
					<?php if($logo_one){ ?>
					<img src="<?php echo $logo_one; ?>">
					<?php } ?>
					</p>
				</div>
			</td>
		</tr>
	</tbody>
</table>
<table class="order-details" style="width: 100%;">
    <thead>
        <tr>
            <td class="product" colspan="2" style="font-weight:bold;">
                <font><font>摘要</font></font>
            </td>
            <td class="quantity" style="font-weight:bold;">
                <font><font>数量</font></font>
            </td>
            <td class="price" style="font-weight:bold;">
                <font><font>単価</font></font>
            </td>
            <td class="line_cost" style="font-weight:bold;">
                <font><font>金額</font></font>
            </td>
        </tr>
    </thead>
    <tbody>
	<?php 
	//$order = wc_get_order($order); 

	$eight_products_total_arr = array();
	$eight_products_total_tax_arr = array();
	
	$ten_products_total_arr = array();
	$ten_products_total_tax_arr = array();
	foreach ($order->get_items() as $item_key => $item ){
		$product = $item->get_product();
		
		$item_subtotal  = $item->get_subtotal();	
		$item_subto_tax = $item->get_subtotal_tax();
		$item_total = $item_subtotal + $item_subto_tax;
		
		$qua     = $item->get_quantity();
		$item_total_qty = $item_total / $qua;
		
		// get tax class rate
		$tax = new WC_Tax();
		$taxes = $tax->get_rates($product->get_tax_class());
		$rates = array_shift($taxes);
		$item_rate = round(array_shift($rates));
		// get tax class rate
	?>
        <tr class="">
            <td class="" colspan="2" style="border-top: 0;">
                <span class="">
				
                <font><font><?php echo $item_name    = $item->get_name();?></font></font>
				</span>
				<?php if($item_rate == 8) { 
				
				// 8% product total and product tax 
				$eight_products_total = round($item->get_total()); 
				$eight_products_total_tax = round($item->get_total_tax()); 
				array_push($eight_products_total_arr, $eight_products_total);
				array_push($eight_products_total_tax_arr, $eight_products_total_tax);
				// 8% product total and product tax 
				
				?>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <?php echo $product_sku    = $product->get_sku();?>  ※ </font></font>
				<?php }else{ 
				// 10% product total and product tax 
				$ten_products_total = round($item->get_total()); 
				$ten_products_total_tax = round($item->get_total_tax()); 
				array_push($ten_products_total_arr, $ten_products_total);
				array_push($ten_products_total_tax_arr, $ten_products_total_tax);
				// 10% product total and product tax 
				?>
				<font><font> <?php echo $product_sku    = $product->get_sku();?></font></font>
				<?php } ?>
            </td>
            <td class="" style="text-align:right;">
                <div class="">
                    <font><font> <?php echo number_format($quantity     = $item->get_quantity());  ?> </font></font>
                </div>
            </td>
            <td class="" style="text-align:right;">
                <font>
                    <font>
                       <?php echo  "¥".number_format($product_price  = $item_total_qty); ?>
                    </font>
                </font>
            </td>
            <td class="" data-sort-value="" style="text-align:right;">
                <div class="">
                    <font><font><?php echo "¥".number_format($product_price*$quantity); ?></font></font>
                </div>
            </td>
        </tr>
		<?php }
	?>
    </tbody>

    <tbody id="order_refunds"></tbody>
</table>
<table class="">
	<thead>
		<tr>
			<?php if($eight_products_total_arr){ ?>
			<th style="font-weight: normal!important;">※は軽減税率対象</th>
			<?php } ?>
		</tr>
	</thead>
</table>

	<?php
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

	//shipping 
	$final_sip_total =  $order->get_total_shipping();
	$final_sip_tax_total = $order->get_shipping_tax();
	
	$shipping_total =  $final_sip_total +  $final_sip_tax_total;
	round($shipping_total);
	//shipping

	$all_total = $cod_total + $cod_tax_total + $ten_products_total + $final_sip_total + $final_sip_tax_total;

	// for 10% tax calculation start
	$ten_tax_calculation = $all_total - round($all_total / 1.10);
	$ten_calculation_round = round($ten_tax_calculation);
	
	$consumption_tax_total = $eight_calculation_round + $ten_calculation_round;
	// for 10%  tax calculation end
	?>
<table class="notes-totals" style="width: 100%; margin-top:25px;">
    <tbody>
        <tr class="no-borders">
            <td class="no-borders" style="width: 60%;">
                &nbsp;
                <div class="customer-notes">
                    <div></div>
                </div>
                <table class="totals" border="0px" style="text-align: right; padding-left: 20%; border: 0px;margin:auto;">
                    <tfoot>
					<?php if($eight_products_total) { ?>
                        <tr style="border: none;">
                            <td style="border: none; text-align:right !important; padding-left: 25%;">
                                8%対象<?php echo number_format(round($eight_products_total)); ?>円 内消費税<?php echo number_format($eight_calculation_round); ?>円
                            </td>
                        </tr>
						<?php } ?>
						<?php if($ten_products_total) { ?>
                        <tr style="border: none;">
                            <td style="border: none; text-align:right !important; padding-left: 25%;">
                                10%対象<?php echo number_format(round($all_total)); ?>円 内消費税<?php echo number_format($ten_calculation_round); ?>円
                            </td>
                        </tr>
						<?php } ?>
                    </tfoot>
                </table>
            </td>
            <td class="">
                <div id=""></div>
                <table class="totals" style="width: 100%;">
                    <tfoot>
                        <tr>
                            <th class="label description" colspan="2" style="font-family: 'Open Sans', sans-serif;">
							<span class="" data-tip=""></span> 商品小計</th>
                            <td class="">
                                <span class="" style="font-family: 'Open Sans', sans-serif;">
                                    <bdi><span class=""></span><?php echo $order->get_subtotal_to_display();?></bdi>
                                </span>
                            </td>
                        </tr>
						<!-- new  -->
						<?php 
						global $wpdb;
						$tax_que = "SELECT sum(meta_value)  FROM `wp_woocommerce_order_itemmeta` WHERE order_item_id IN (SELECT distinct order_item_id FROM `wp_woocommerce_order_items` WHERE order_id = $pdf) and meta_key in ('discount_amount','discount_amount_tax')";
						$tax_query_array = $wpdb->get_results($tax_que);
						

						$array = json_decode(json_encode($tax_query_array), true);	
						foreach ($array as $dis) {
						$sum = $dis['sum(meta_value)'];
						
						?>
						<?php if ($sum){ ?>
						<tr>
                            <th class="label description" colspan="2" style="font-family: 'Open Sans', sans-serif;">
							<span class="" data-tip=""></span>割引</th>
                            <td class="">
                                <span class="" style="font-family: 'Open Sans', sans-serif;">
                                    <bdi><span class=""></span><?php echo '¥'.number_format($sum); ?></bdi>
                                </span>
                            </td>
                        </tr>
						<?php } ?>
						<?php } ?>
						<!-- new  -->
						 <tr>
                            <th class="label description" colspan="2" style="font-family: 'Open Sans', sans-serif;">
							<span class="" data-tip=""></span> 送料</th>
                            <td class="" style="font-family: 'Open Sans', sans-serif;">
                                <span class="">
                                    <bdi><span class=""></span><?php echo '¥'.number_format($shipping_total); ?></bdi>
                                </span>
                            </td>
                        </tr>
						<?php if($cod_total_and_tax){?>
						 <tr>
                            <th class="label description" colspan="2" style="font-family: 'Open Sans', sans-serif;">
							<span class="" data-tip=""></span> 手数料</th>
                            <td class="">
                                <span class="" style="font-family: 'Open Sans', sans-serif;">
                                    <bdi><span class=""></span><?php echo '¥'.$cod_total_and_tax; ?></bdi>
                                </span>
                            </td>
                        </tr>
						<?php } ?>
						 <tr>
                            <th class="label description" colspan="2" style="font-family: 'Open Sans', sans-serif;">
							<span class="" data-tip=""></span> 内消費税合計</th>
                            <td class="">
                                <span class="" style="font-family: 'Open Sans', sans-serif;">
                                    <bdi><span class=""></span><?php echo '¥'.number_format($consumption_tax_total); ?></bdi>
                                </span>
                            </td>
                        </tr>
						 <tr>
                            <th class="label description" colspan="2" style="font-family: 'Open Sans', sans-serif;">
								<span class="" data-tip=""></span> 合計金額
							 </th>
                            <td class="">
                                <span class="" style="font-family: 'Open Sans', sans-serif;">
                                    <bdi><span class=""></span><?php echo $order->get_formatted_order_total(); ?></bdi>
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table style="width:100%;margin-top: 25px;">
	<thead>
		<tr>
			<th class="footer_th" style="">備考</th>
		</tr>		
		<tr>
			<td class="product" style="text-align:left; background-color: #fff; color:black; border:none;">
			<?php 
			$cus_form_info_receipt_detail = get_post_meta( $order_id[0]->order_id, '_cus_form_info_receipt_detail');
			echo $cus_form_info_receipt_detail[0];
			?>
			</td>
		</tr>		
	</thead>
</table>
</body>
</html>