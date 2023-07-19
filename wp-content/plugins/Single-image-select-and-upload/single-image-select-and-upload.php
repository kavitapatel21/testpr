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
?>
	<div class="wrap">
		<h1>Theme Panel</h1>
		<form method="post" action="" enctype="multipart/form-data">
		<img src="<?php echo get_option('image_one'); ?>" class="image_one" alt="image one" width="100" height="100">
		<br>
			<input class="image_one_url" type="text" name="image_one" size="60" value="<?php echo get_option('image_one'); ?>">
			<a href="#" class="image_one_upload">Upload</a>
			<br>
			<br>
			
			<img src="<?php echo get_option('image_two'); ?>" class="image_two" alt="image two" width="100" height="100">
			<br>
			<input class="image_two_url" type="text" name="image_two" size="60" value="<?php echo get_option('image_two'); ?>">
			<a href="#" class="image_two_upload">Upload</a>
			<?php
			submit_button();
			?>
		</form>
	</div>
	<?php
	if(isset($_POST['submit'])){
				$image_one = $_POST['image_one'];		
    				if (get_option('image_one') == $image_one ){
						echo "Image 1 not changed";
        			//return;
    				}else{
						echo "Image 1 changed";
        			update_option('image_one',$image_one );
    				}
				$image_two = $_POST['image_two'];
    				if (get_option('image_two') == $image_two ){
						echo "Image 2 not changed";
        			//return;
    				}else{
						echo "Image 2 changed";
        			update_option('image_two',$image_two);
    				}
				 }
	?>
	<script>
		var image_one = '<?php echo get_option('image_one'); ?>';
		var image_two = '<?php echo get_option('image_two'); ?>';
		jQuery('.image_one_url').val(image_one).trigger('change');
		jQuery('.image_two_url').val(image_two).trigger('change');
		jQuery('.image_one').attr('src', ''+image_one+'').trigger('change');
		jQuery('.image_two').attr('src', ''+image_two+'').trigger('change');
	</script>
<?php
}
//Custom settings API for multiple image uploading & fetching START

//Admin panel script START
function footer_script(){
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
						})
						.open();
				});
			});
			//Custom settings API theme option script END
		</script>
	<?php
	}
	add_action("admin_footer", "footer_script");
	//Admin panel script END
	
