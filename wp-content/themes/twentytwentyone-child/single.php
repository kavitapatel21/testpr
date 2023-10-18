<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
if($flag){
	echo $domain;
}else {
	echo 'variable is false';
}


/* Start the Loop */
while (have_posts()) :
	the_post();

	/**To adding back button for redirect to previous page START*/
	$previous = "javascript:history.go(-1)";
	if (isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
?>
	<a href="<?= $previous ?>">Back</a>
	<!--To adding back button for redirect to previous page END-->

	<!--Dispaly breadcrumb-->
	<p style="display: flex;
            flex-direction: row;
            font-size: 30px;"><?php get_breadcrumb(); ?></p>
			
<?php
	get_template_part('template-parts/content/content-single');

	if (is_attachment()) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: Parent post link. */
				'prev_text' => sprintf(__('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentytwentyone'), '%title'),
			)
		);
	}

	// If comments are open or there is at least one comment, load up the comment template.
	if (comments_open() || get_comments_number()) {
		comments_template();
	}

	// Previous/next post navigation.
	$twentytwentyone_next = is_rtl() ? twenty_twenty_one_get_icon_svg('ui', 'arrow_left') : twenty_twenty_one_get_icon_svg('ui', 'arrow_right');
	$twentytwentyone_prev = is_rtl() ? twenty_twenty_one_get_icon_svg('ui', 'arrow_right') : twenty_twenty_one_get_icon_svg('ui', 'arrow_left');

	$twentytwentyone_next_label     = esc_html__('Next post', 'twentytwentyone');
	$twentytwentyone_previous_label = esc_html__('Previous post', 'twentytwentyone');

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . $twentytwentyone_next . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">' . $twentytwentyone_prev . $twentytwentyone_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

/* Showing related posts [Start] */
// Query related posts 
$related_posts_args = array(
    'post_type' => 'post', // You can specify custom post types if needed
    'posts_per_page' => 2, // Number of related posts to display
    'post__not_in' => array(get_the_ID()), // Exclude the current post
    'orderby' => 'rand', // You can change the ordering method
);


$related_posts_query = new WP_Query($related_posts_args);

/* Related posts HTML [Start] */
if ($related_posts_query->have_posts()) :
?>
    <div class="related-posts">
        <h2>Related Posts</h2>
        <ul>
            <?php while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php
/*Related posts HTML [End] */

    // Reset post data
    wp_reset_postdata();
endif;

/* Showing related posts [End] */

get_footer();

?>

