/**jQuery('.pdf_one').on('click', function() {
	var order_id = jQuery(this).attr("data-id");
	
	var href = myScript.pluginsUrl + '/pdfoneajax/pdfoneajax.php?order_id='+order_id;

	url = href;
	window.open(url, '_blank');
})*/

jQuery('.pdf_one').on('click', function () {

	var order_id = jQuery(this).attr("data-id");

	//alert("order_id");
	//exit;
	jQuery.ajax({
		url: 'http://localhost/testpr/wp-content/plugins/pdfoneajax/testpdfoneajax.php',
		type: "post",
		data: {
			order_id: order_id,
		},
		success: function (ajaxValue) {
			// alert("Here");
			var win = window.open('', '_blank');
			win.location.href = ajaxValue;
		}
	});
})
