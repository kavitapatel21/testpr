/*! DO NOT EDIT THIS FILE. This file is a auto generated on 2023-03-25 */
jQuery(document).ready(function(r){r(".wcfm_product_multivendor").click(function(o){o.preventDefault(),r(".wcfm_product_multivendor").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});o={action:"wcfmmp_product_multivendor_clone",product_id:r(".wcfm_product_multivendor").data("product_id"),wcfm_ajax_nonce:wcfm_params.wcfm_ajax_nonce};jQuery.post(wcfm_params.ajax_url,o,function(o){o&&($response_json=jQuery.parseJSON(o),wcfm_notification_sound.play(),$response_json.redirect)&&(window.location=$response_json.redirect)})}),r('select[name="spmv_orderby"]').each(function(){r(this).change(function(){($spmv_sroter=r(this)).parent().parent().find(".wcfmmp_product_mulvendor_table_container").block({message:null,overlayCSS:{background:"#fff",opacity:.6}});var o={action:"wcfmmp_more_offers_sorting",product_id:$spmv_sroter.data("product_id"),sorting:$spmv_sroter.val(),wcfm_ajax_nonce:wcfm_params.wcfm_ajax_nonce};r.ajax({type:"POST",url:wcfm_params.ajax_url,data:o,success:function(o){$spmv_sroter.parent().parent().find(".wcfmmp_product_mulvendor_table_container").replaceWith(o)}})})})});