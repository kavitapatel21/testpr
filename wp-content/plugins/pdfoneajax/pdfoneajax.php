<?php
global $wpdb;
require_once( '../../../wp-load.php' );
$order_id = $_GET['order_id'];
$tablename = 'wp_order_pdf_id';

$delete = $wpdb->query("TRUNCATE TABLE $tablename");

$data=array('order_id' => $order_id);
$wpdb->insert( $tablename, $data);

include_once 'vendor/autoload.php';
	$config = [
		//'mode' => 'ja+aCJK',
		'mode' => 'ja',
		'allow_charset_conversion' => true,
		"autoScriptToLang" => true,
		"autoLangToFont" => true,
		'useSubstitutions' => true,
		'format' => 'A4', 
	];
	$mpdf = new \Mpdf\Mpdf($config);	
	$plugins_url = plugins_url().'/pdfoneajax/invoice-one.php';
	//$pdfcontent = $html;
	$template = file_get_contents($plugins_url);
 	//print_r($template);
 	//die;
	$pdfcontent = $template;
	header('Content-type: application/pdf');
	$mpdf->WriteHTML($pdfcontent);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->Output('MyPDF.pdf', 'D');
	//die;
	
?>

