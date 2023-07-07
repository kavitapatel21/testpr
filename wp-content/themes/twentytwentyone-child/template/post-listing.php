<?php
/* Template Name: Post Listing
Post Type: post, page, event */

$args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'post',
);
$query = new WP_Query($args);
if ($query->have_posts()) :

    while ($query->have_posts()) : $query->the_post(); {
?>
            <a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a>
<?php
            echo '<br>';
            echo $post->post_content;
        }

    endwhile;
else :
endif;
?>