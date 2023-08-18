<?php
global $wpdb;
require_once( '../../../wp-load.php' );
//echo '<pre>';
//print_r($_POST);
$order_id = $_POST['order_id'];
$tablename = 'wp_order_pdf_id';

$delete = $wpdb->query("TRUNCATE TABLE $tablename");
$data=array('order_id' => $order_id);
$wpdb->insert( $tablename, $data);
include_once 'vendor/autoload.php';
// Language file with translations
$languageFile = include_once 'language_file.php';

	$config = [
		//'mode' => 'ja',
		//'allow_charset_conversion' => true,
		//"autoScriptToLang" => true,
		//"autoLangToFont" => true,
		//'format' => 'A4', 
		
		'mode' => 'ja',
		"autoScriptToLang" => true,
		"autoLangToFont" => true,
		'allow_charset_conversion' => true,
		'useSubstitutions' => true,
		'format' => 'A4', 			

	];
	$mpdf = new \Mpdf\Mpdf($config);
	$mpdf->SetHTMLFooter('<table width="100%"><tr><td width="33%" align="right">{PAGENO}/{nbpg}</td></tr></table>');

	//********************************

	$tablename = 'wp_order_sequence';
	
	$ord_id = $wpdb->get_results("SELECT pdf FROM `wp_order_sequence` WHERE (order_id = $order_id)");
	$id =  $ord_id[0]->pdf;

	if($id){
	
	}else{
		
		$ord_count = $wpdb->get_results("SELECT count(*) as totalrecord FROM `wp_order_sequence`");			
		$data = array(
		'order_id' => $order_id, 
		'pdf' =>$ord_count[0]->totalrecord+1
		);
		$wpdb->insert( $tablename, $data);
	}

	//************************************
 
	$plugins_url = plugins_url().'/pdf-print-woocommerce/invoice-one.php';
	$template = file_get_contents($plugins_url);
	//print_r($template);
	//die;
	$pdfcontent = $template;
	header('Content-type: application/pdf');

	// Replace words in the content with translations Start
	$translatedContent = strtr($pdfcontent, $languageFile);
	
	$mpdf->WriteHTML($translatedContent);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->autoLangToFont  = true;
	$filename = "見積書" . '_'.date('YmdHis') . '_' . $order_id . '.pdf';
	//$filename = $mpdf->Output($filename, 'D');
	if ($filename == false) {
		wp_send_json_error();
	} else {
		wp_send_json_success($filename);
	}
	die;
	
?>

