<?php
echo "testpdfone here";
//die;
echo $order_id = $_POST['order_id'];


include_once 'vendor/autoload.php';
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	//header('Content-type: application/pdf');

	$config = [
		'mode' => '+aCJK',
		"autoScriptToLang" => true,
		"autoLangToFont" => true,
	];
	$mpdf = new \Mpdf\Mpdf($config);

	$pdfcontent = '<h1>Hello</h1>';

	$mpdf->WriteHTML($pdfcontent);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->autoLangToFont  = true;

	$pdfString = $mpdf->Output('MyPDF.pdf', 'S');
	$pdfBase64 = base64_encode($pdfString);
	echo 'data:application/pdf;base64,Content-Disposition: attachment' . $pdfBase64;
	
	//die;
