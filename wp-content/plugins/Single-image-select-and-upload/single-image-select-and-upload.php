<?php

/**
 * Plugin Name: Custom Single Image Selector & Uploader
 * Plugin URI: 
 * Description: Custom plugin for select & upload single images & stored in database wp_options table
 * Version: 0.1
 * Author: Kavita
 * Author URI: 
 **/

function add_theme_menu_items()
{
	add_menu_page("Single Image Theme Panel", "Single Image Theme Panel", "manage_options", "theme-panel", "theme_settings_pages", null, 99);
}
add_action("admin_menu", "add_theme_menu_items");

//Custom settings API START
function theme_settings_pages()
{
	if (function_exists('wp_enqueue_media')) {
		wp_enqueue_media();
	} else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
?><style>
	#close{
    	position: absolute;
    	z-index: 1;
    	background-color: white;
    	left: 90px;
    	font-weight: 500;
		color: black;
    	font-size: 18px;
    	border-radius: 5px;
		text-decoration: none;
	}
	.image_one,.image_two{
		position: relative;
	}
   </style>
	<div class="wrap">
		<h1>Theme Panel</h1>
		<form method="post" action="" enctype="multipart/form-data">
			<div id="upload_img" class="upload_img_one">
			<?php if(get_option('image_one')){
			?>
			<a id="close" href=""> X </a>
			<?php }
			?>
			<img src="<?php echo get_option('image_one'); ?>" class="image_one" alt="image one" width="100" height="100" data-option="image_one">
			</div>
			<br>
			<input class="image_one_url" type="text" name="image_one" size="60" value="<?php echo get_option('image_one'); ?>">
			<a href="#" class="image_one_upload">Upload</a>
			<br>
			<br>

			<div id="upload_img" class="upload_img_two">
			<?php if(get_option('image_two')){
			?>
			<a id="close" href=""> X </a>
			<?php }
			?>
			<img src="<?php echo get_option('image_two'); ?>" class="image_two" alt="image two" width="100" height="100" data-option="image_two">
			</div>
			<br>
			<input class="image_two_url" type="text" name="image_two" size="60" value="<?php echo get_option('image_two'); ?>">
			<a href="#" class="image_two_upload">Upload</a>
			
			<?php
			submit_button();
			?>
		</form>
	</div>
	<?php
	if (isset($_POST['submit'])) {
		$image_one = $_POST['image_one'];
		if (get_option('image_one') == $image_one) {
			echo "Image 1 not changed";
			//return;
		} else {
			echo "Image 1 changed";
			update_option('image_one', $image_one);
		}
		$image_two = $_POST['image_two'];
		if (get_option('image_two') == $image_two) {
			echo "Image 2 not changed";
			//return;
		} else {
			echo "Image 2 changed";
			update_option('image_two', $image_two);
		}
	}
	?>
	<script>
		var image_one = '<?php echo get_option('image_one'); ?>';
		var image_two = '<?php echo get_option('image_two'); ?>';
		jQuery('.image_one_url').val(image_one).trigger('change');
		jQuery('.image_two_url').val(image_two).trigger('change');
		jQuery('.image_one').attr('src', '' + image_one + '').trigger('change');
		jQuery('.image_two').attr('src', '' + image_two + '').trigger('change');
		if(image_one){
			jQuery('.upload_img_one').append('<a id="close" href="" style="position: absolute;z-index: 1;background-color: white;left: 90px;font-weight: 500;color: black;font-size: 18px;border-radius: 5px;text-decoration: none;"> X </a>');
		}
		if(image_two){
			jQuery('.upload_img_two').append('<a id="close" href="" style="position: absolute;z-index: 1;background-color: white;left: 90px;font-weight: 500;color: black;font-size: 18px;border-radius: 5px;text-decoration: none;"> X </a>');
		}
	</script>
<?php
}
//Custom settings API for multiple image uploading & fetching START

//Admin panel script START
function footer_script()
{
?>
	<script>
		//Custom settings API theme option script START
		jQuery(document).ready(function($) {
			$('.image_one_upload').click(function(e) {
				e.preventDefault();
				var custom_uploader = wp.media({
						title: 'Custom Image',
						button: {
							text: 'Upload Image'
						},
						multiple: false // Set this to true to allow multiple files to be selected
					})
					.on('select', function() {
						var attachment = custom_uploader.state().get('selection').first().toJSON();
						$('.image_one').attr('src', attachment.url);
						$('.image_one_url').val(attachment.url);
						//jQuery('.upload_img_one').append('<a id="close" href="" style="position: absolute;z-index: 1;background-color: white;left: 90px;font-weight: 500;color: black;font-size: 18px;border-radius: 5px;text-decoration: none;"> X </a>');
					})
					.open();
			});
			$('.image_two_upload').click(function(e) {
				e.preventDefault();
				var custom_uploader = wp.media({
						title: 'Custom Image',
						button: {
							text: 'Upload Image'
						},
						multiple: false // Set this to true to allow multiple files to be selected
					})
					.on('select', function() {
						var attachment = custom_uploader.state().get('selection').first().toJSON();
						$('.image_two').attr('src', attachment.url);
						$('.image_two_url').val(attachment.url);
						//jQuery('.upload_img_two').append('<a id="close" href="" style="position: absolute;z-index: 1;background-color: white;left: 90px;font-weight: 500;color: black;font-size: 18px;border-radius: 5px;text-decoration: none;"> X </a>');
					})
					.open();
			});
		});
		//Custom settings API theme option script END

		//remove image one on cross click START
		/**jQuery(document).on('click', '#close', function () {
			
    		jQuery.ajax({
        		type: 'POST',
        		url: '<?php //echo admin_url('admin-ajax.php'); ?>',
        		data: {"action": "your_delete_action"},
        		success: function (data) {
            	alert('delete'); 
				window.location.reload();
				//jQuery('#submit').trigger('click');
        		}
    		});
		});*/
	//remove image one on cross click END

	//remove selected img on cross click START
		jQuery(document).on('click', '#close', function () {
			var imageContainer = jQuery(this).parent('#upload_img');
  			var slected_img = imageContainer.find('img').data("option");
			//alert(slected_img);
    		jQuery.ajax({
        		type: 'POST',
        		url: '<?php echo admin_url('admin-ajax.php'); ?>',
        		data: {"action": "your_delete_action","slected-img": slected_img},
        		success: function (data) {
            	alert('image deleted'); 
				window.location.reload();
        		}
    		});
		});
	//remove selected img on cross click END

	</script>
<?php
}
add_action("admin_footer", "footer_script");
	//Admin panel script END

	//remove selected image from the database START(ajax action)
	add_action('wp_ajax_your_delete_action','clear_log_ajax');
	function clear_log_ajax() {
		if($_POST['slected-img'] == 'image_one'){
			update_option('image_one','');
		}
		if($_POST['slected-img'] == 'image_two'){
			update_option('image_two','');
		}
		die();
	}
	//remove selected image from the database END(ajax action)