jQuery('.pdf_one').on('click', function() {
	var order_id = jQuery(this).attr("data-id");
	var href = myScript.pluginsUrl + '/pdf-print-woocommerce/pdfoneajax.php?order_id='+order_id;
	url = href;
	window.open(url, '_blank');
})

jQuery('.pdf_two').on('click', function() {
	var order_id = jQuery(this).attr("data-id");
	var href = myScript.pluginsUrl + '/pdf-print-woocommerce/pdftwoajax.php?order_id='+order_id;
	url = href;
	window.open(url, '_blank');
})

jQuery('.pdf_three').on('click', function() {
	var order_id = jQuery(this).attr("data-id");
	var href = myScript.pluginsUrl + '/pdf-print-woocommerce/pdfthreeajax.php?order_id='+order_id;
	url = href;
	window.open(url, '_blank');
})

jQuery('.pdf_four').on('click', function() {
	var order_id = jQuery(this).attr("data-id");
	var href = myScript.pluginsUrl + '/pdf-print-woocommerce/pdffourajax.php?order_id='+order_id;
	url = href;
	window.open(url, '_blank');
})

jQuery('.pdf_five').on('click', function() {
	var order_id = jQuery(this).attr("data-id");
	var href = myScript.pluginsUrl + '/pdf-print-woocommerce/pdffiveajax.php?order_id='+order_id;
	url = href;
	window.open(url, '_blank');
})
