<?php
require_once('wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

global $wpdb;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://recovr.com/wp-json/custom/v1/get-blog-posts',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$res = json_decode($response);
foreach ($res->data as $post_data) {
    $post_id = $post_data->post_id;
    $post_title = $post_data->post_title;
    $post_status = $post_data->post_status;
    $post_content = $post_data->post_content;
    $post_date = $post_data->post_published_date;
    $post_tags = $post_data->post_tag;
    $post_category = $post_data->post_category;

    $category_ids = array();

    // Loop through category names and get their IDs
    foreach ($post_category as $category_name) {
        $category = get_term_by('name', $category_name, 'category');
        if ($category && !is_wp_error($category)) {
            $category_ids[] = $category->term_id;
        } else {
            // Category doesn't exist, so create it
            $new_category_id = wp_create_category($category_name);
            if (!is_wp_error($new_category_id)) {
                $category_ids[] = $new_category_id;
            }
        }
    }
    // echo "category ids:";
    // print_r($category_ids);

    //$post_author = $post_data->post_author;
    $post_author_name = $post_data->post_author; // Replace with the actual author's name from your API data.
    $post_author_id = null;

    // Check if the author already exists.
    $existing_author = get_user_by('login', $post_author_name);

    if ($existing_author) {
        // Author exists, get their ID.
        $post_author_id = $existing_author->ID;
        //echo "user exist id:" . $post_author_id;
    } else {
        // Author doesn't exist, create a new user with the "author" role.
        $user_data = array(
            'user_login' => $post_author_name,
            'user_pass' => wp_generate_password(),
            'display_name' => $post_author_name,
            'role' => 'author', // Specify the role here.
        );

        $post_author_id = wp_insert_user($user_data);
        //echo "user created id:" . $post_author_id;
    }
    $image = $post_data->post_featured_img_src; // url of image

    //check if post with $post_data->post_id is already in database, if so, update post $post_data->post_id
    if (get_post_status($post_data->post_id)) {
        $post = array(
            'ID'  =>   $post_id,
            'post_title' =>  $post_title,
            'post_content' =>  $post_content,
            'post_status' =>  $post_status,
            'post_author' =>  $post_author_id,
            'post_type' => 'post',
            'post_date' => $post_date,
            'tags_input' => $post_tags,
            // 'tax_query' => array(
            // 	'relation' => 'AND',
            // 	array(
            // 		'taxonomy' => 'category', // Specify the taxonomy (e.g., 'category', 'custom_taxonomy').
            // 		'field' => 'name', // You can specify the field to search in (e.g., 'name', 'term_id', 'slug').
            // 		'terms' => $post_category, // Replace with the category names you want to query.
            // 		'operator' => 'IN', // Use 'IN' to include posts in any of the specified categories.
            // 	),
            // ),
        );

        // Update post categories using wp_set_post_categories
        if (!empty($category_ids)) {
            wp_set_post_categories($post_id, $category_ids);
        }
        // print_r($post);
        // echo '<br>';
        $post_id = wp_update_post($post);

        // Set the featured image
        // Extract the basename from the image URL
        $image_url_basename = wp_basename($image);
        //echo $image_url_basename;


        // Construct the SQL query to find the image by basename
        $sql = $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s",
            '%' . $wpdb->esc_like($image_url_basename)
        );

        $image_id = $wpdb->get_var($sql);
        if (has_post_thumbnail($post_id)) {
            echo "image already set";
        } else {
            if ($image_id) {
                echo "image found";
                // An image with the same basename exists in the media library; set it as the featured image
                set_post_thumbnail($post_id, $image_id);
            } else {
                // The image does not exist in the media library, so let's add it
                echo "new image found & uploaded";
                $image_id = media_sideload_image($image, $post_id, '', 'id');
                if (!is_wp_error($image_id)) {
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }
    }
    //if not in database, add post with $post_data->post_id
    else {
        $post = array(
            'import_id'  =>   $post_id, //Cretae post with custom id (get id by third-party api call)
            'post_title' =>  $post_title,
            'post_content' =>  $post_content,
            'post_status' =>  $post_status,
            'post_author' =>  $post_author_id,
            'post_type' => 'post',
            'post_date' => $post_date,
            'tags_input' => $post_tags,
            // 'tax_query' => array(
            // 	'relation' => 'AND',
            // 	array(
            // 		'taxonomy' => 'category', // Specify the taxonomy (e.g., 'category', 'custom_taxonomy').
            // 		'field' => 'name', // You can specify the field to search in (e.g., 'name', 'term_id', 'slug').
            // 		'terms' => $post_category, // Replace with the category names you want to query.
            // 		'operator' => 'IN', // Use 'IN' to include posts in any of the specified categories.
            // 	),
            // ),
        );
        // Update post categories using wp_set_post_categories
        if (!empty($category_ids)) {
            wp_set_post_categories($post_id, $category_ids);
        }
        // print_r($post);
        // echo '<br>';
        $post_id = wp_insert_post($post);

        // Set the featured image
        // Extract the basename from the image URL
        $image_url_basename = wp_basename($image);
        global $wpdb;

        // Construct the SQL query to find the image by basename
        $sql = $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s",
            '%' . $wpdb->esc_like($image_url_basename)
        );

        $image_id = $wpdb->get_var($sql);
        if (has_post_thumbnail($post_id)) {
            echo "image already set";
        } else {
            if ($image_id) {
                echo "image found";
                // An image with the same basename exists in the media library; set it as the featured image
                set_post_thumbnail($post_id, $image_id);
            } else {
                // The image does not exist in the media library, so let's add it
                echo "new image found & uploaded";
                $image_id = media_sideload_image($image, $post_id, '', 'id');
                if (!is_wp_error($image_id)) {
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }
    }
}