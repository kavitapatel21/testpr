<?php
/**
* Plugin Name: Custom Multi Image Selector & Uploader
* Plugin URI: 
* Description: Custom plugin for select & upload multiple images & stored in database wp_options table
* Version: 0.1
* Author: Kavita
* Author URI: 
**/

//Add admin menu on admin panel START
function add_theme_menu_item_for_multi_img()
{
	//Add menu page for multiple image upload in theme options START
	add_menu_page("Multiple Image Theme Panel", "Multiple Image Upload Theme Panel", "manage_options", "multiple-img-theme-panel", "theme_settings_pages_multiple_img", null, 99);
	//Add menu page for multiple image upload in theme options END
}
add_action("admin_menu", "add_theme_menu_item_for_multi_img");
//Add admin menu on admin panel END

//HTML for multiple image fetch & upload START
function theme_settings_pages_multiple_img()
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
		<h1>Multiple Images Theme Panel</h1>
		<form action="" method="post" enctype="multipart/form-data">  
			<br>
			<div class="mutiple_img_one_listing">
			
			</div>
			<input type="hidden" name="selected_image_id" id="selected_image_id" value="">
			<input class="multiple_img_one_url" type="text" name="multiple_img_one" size="60" value="">
			<a href="#" class="multiple_img_one_upload">Upload</a>
			<!--<input type="file" id="uploadFile" name="uploadFile[]" multiple class="multiple_img_one_upload"/>-->
			<br>
			<br>
			
			<div class="mutiple_img_two_listing">
			
			</div>
			<input class="multiple_img_two_url" type="text" name="multiple_img_two" size="60" value="">
			<a href="#" class="multiple_img_two_upload">Upload</a>
			<br><br>
			<input type="submit" class="btn btn-success" name='submitImage' value="Submit"/>  
			<?php
			//submit_button();
			?>
		</form>
	</div>


	<?php
	if(isset($_POST['submitImage']))  
	{  
		//For image one START
		if($add_url = get_option('multi_img_one')){
		$url_arr = array();
		$new_url = array();
		$add_url = array();	
			for($i = 0; $i < count($_POST['myplugin_attachment_id_array_two']); ++$i){
			$url =  $_POST['myplugin_attachment_id_array_two'][$i] . "<br>";
			array_push($url_arr, $url);
		 	}
			foreach ($url_arr as $value) {
				if ( in_array($value, $add_url)){
				   echo "not added";
				}else{
					echo "added";	
					array_push($add_url, $value);	
					update_option('multi_img_one',$add_url);
				}	
		  	}
		}else{}
		$add_url = get_option('multi_img_one');
		foreach ($add_url as $src) {
			?>
			<script>
			var src = '<?php echo $src ?>'; 
			var newsrc = src.replace('<br>', '');
			jQuery('.mutiple_img_one_listing').empty().append('<img class="new_images" src="' + newsrc + '" width="100" height="100" style="margin-left:5px;">');
			</script>
			<?php
		}
	}
	}	

		//if(count($_POST['myplugin_attachment_id_array_two']) > 0){
		/**$url_arr = array();
			for($i = 0; $i < count($_POST['myplugin_attachment_id_array_two']); ++$i){
			$url =  $_POST['myplugin_attachment_id_array_two'][$i] . "<br>";
			array_push($url_arr, $url);
		 	}
			$add_url = array();	
			foreach ($url_arr as $value) {
				//echo "Image 1 changed";
				$get_url = get_option('multi_img_one');	
				$list = implode(',', $add_url);
				print_r($list);
				if ( in_array($value, $get_url)){
				   echo "not added";
				}else{
					echo "added";
					array_push($add_url, $value);	
					
					update_option('multi_img_one',$add_url);
				}	
		  	}
    		$get_url = get_option('multi_img_one');		
			foreach ($get_url as $src) {
				?>
				<script>
				var src = '<?php echo $src ?>'; 
				var newsrc = src.replace('<br>', '');
				jQuery('.mutiple_img_one_listing').append('<img class="new_images" src="' + newsrc + '" width="100" height="100" style="margin-left:5px;">');
				</script>
				<?php
			}**/
		//}
		//For image one END

		//For image two START
		/**$url_arr = array();
		if(count($_POST['myplugin_attachment_id_array']) > 0){
			for($i = 0; $i < count($_POST['myplugin_attachment_id_array']); ++$i) {
			$url =  $_POST['myplugin_attachment_id_array'][$i] . "<br>";
			array_push($url_arr, $url);
 			}
			$add_url = array();	
			foreach ($url_arr as $value) {
				//echo "Image 1 changed";
				array_push($add_url, $value);	
		
				$get_url = get_option('multi_img_two');	
				if ( in_array($value, $get_url)){
				echo "Image 2 not changed";
				//return;
				}else{
					foreach ($get_url as $src) {
					?>
					<script>
					var src = '<?php echo $src ?>'; 
					var newsrc = src.replace('<br>', '');
					jQuery('.mutiple_img_two_listing').append('<img class="new_images" src="' + newsrc + '" width="100" height="100" style="margin-left:5px;">');
					</script>
					<?php
					}
				}	
			}
		}**/
	//For image two END

//HTML for multiple image fetch & upload END

//Admin panel script START
function plugin_footer_script(){
    ?>
    <script>
			//Custom settings API theme option script for multiple image upload START
		jQuery(document).ready(function($) {
            $('.multiple_img_one_upload').click(function(e) {
				$('.mutiple_img_one_listing').empty();
                e.preventDefault();
                var custom_uploader = wp.media({
                        title: 'Custom Image',
                        button: {
                            text: 'Upload Image'
                        },
                        multiple: true // Set this to true to allow multiple files to be selected
                    })
                    .on('select', function() {
                        	var attachment = custom_uploader.state().get('selection').map( 
							function( attachment ) {
								attachment.toJSON();
								return attachment;
							});
							var i;
           					for (i = 0; i < attachment.length; ++i) {
                			//sample function 1: add image preview
                			$('.mutiple_img_one_listing').append('<img class="new_images" src="' + attachment[i].attributes.url + '" width="100" height="100" style="margin-left:5px;">');
							$('.mutiple_img_one_listing').append('<input id="myplugin-image-input' +attachment[i].id+'" type="hidden" name="myplugin_attachment_id_array_two[]"  value="' + attachment[i].attributes.url + '">');
						}
                    }).open();
            });
			$('.multiple_img_two_upload').click(function(e) {
				$('.mutiple_img_two_listing').empty();
                e.preventDefault();
                var custom_uploader = wp.media({
                        title: 'Custom Image',
                        button: {
                            text: 'Upload Image'
                        },
                        multiple: true // Set this to true to allow multiple files to be selected
                    })
                    .on('select', function() {
                        var attachment = custom_uploader.state().get('selection').map( 
							function( attachment ) {
								attachment.toJSON();
								return attachment;
							});
							var i;
           					for (i = 0; i < attachment.length; ++i) {
                			//sample function 1: add image preview
                			$('.mutiple_img_two_listing').append('<img class="new_images" src="' + attachment[i].attributes.url + '" width="100" height="100" style="margin-left:5px;">');
            			    $('.mutiple_img_two_listing').append('<input id="myplugin-image-input' +attachment[i].id+'" type="hidden" name="myplugin_attachment_id_array[]"  value="' + attachment[i].attributes.url + '">');	
						}
                    }).open();
            });
        });
		//Custom settings API theme option script for multiple image upload END
    </script>
<?php
}
add_action("admin_footer", "plugin_footer_script");
//Admin panel script END

