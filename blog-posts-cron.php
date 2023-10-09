<?php

require_once("wp-load.php");
require_once('wp-includes/wp-db.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once('wp-admin/includes/taxonomy.php');


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
    /**Get API data [Start] */
    $post_id = $post_data->post_id;
    echo 'postid:' . $post_id;
    $post_title = $post_data->post_title;
    $post_content = $post_data->post_content;
    $post_status = $post_data->post_status;
    $post_date = $post_data->post_published_date;
    $post_tags = $post_data->post_tag;
    $post_category = $post_data->post_category;
    $post_author_name = $post_data->post_author;
    $image_url = $post_data->post_featured_img_src; // url of image
    /**Get API data [End] */

    /**Create post_Author [Start] */
    $post_author_id = null;
    // Check if the author already exists.
    $existing_author = get_user_by('login', $post_author_name);
    if ($existing_author) {
        // Author exists, get their ID.
        $post_author_id = $existing_author->ID;
    } else {
        // Author doesn't exist, create a new user with the "author" role.
        $user_data = array(
            'user_login' => $post_author_name,
            'user_pass' => wp_generate_password(),
            'display_name' => $post_author_name,
            'role' => 'author', // Specify the role here.
        );
        $post_author_id = wp_insert_user($user_data);
    }
     // Loop through category names and get their IDs [Start]
     $category_ids = array();
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
     if (!empty($category_ids)) {
         wp_set_post_categories($post_id, $category_ids);
     }
    /**Create post_Author [End] */

    /**Insert Posts [Start] */
    $existing_post = get_page_by_title($post_title, OBJECT, 'post');
    if (!$existing_post) {
        $post = array(
            'import_id'  =>   $post_id,
            'post_title' =>  $post_title,
            'post_status' =>  $post_status,
            'post_content' =>  $post_content,
            'post_date' => $post_date,
            'tags_input' => $post_tags,
            'post_author' =>  $post_author_id,
            'post_type' => 'post',
        );

        $post_id = wp_insert_post($post);

       
        /**Insert Posts [End] */
    } else {
        /**Update posts [Start] */
        $post = array(
            'import_id'  =>   $post_id,
            'post_title' =>  $post_title,
            'post_status' =>  $post_status,
            'post_content' =>  $post_content,
            'post_date' => $post_date,
            'tags_input' => $post_tags,
            'post_author' =>  $post_author_id,
            'post_type' => 'post',
        );
        $post_id = wp_update_post($post);
        /**Update posts [End] */
    }
    
}

//Call image upload & set function
upload_img_from_api();
