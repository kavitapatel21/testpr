<?php 
echo "Hello gym-mebers";
?>
<div class="body-top">
    <div class="container">
        <div class="buttons mt-5">
            <div class="scrollbar">
                <a href="#" class="tags button all" data-tag="all">All</a>
                <?php
                
                /**get current tag Start */
                $tag = get_queried_object();
                $current_tag = $tag->slug;
                /**get current tag End */
                $tags = get_tags(); //taxonomy=post_tag
                ?>
                <?php if ($tags) :
                    foreach ($tags as $tag) : if ($tag->slug === $current_tag) { ?>
                            <a href="#" class="tags button active <?php echo esc_attr($tag->name); ?>" data-tag="<?php echo esc_html($tag->name); ?>" id="<?php echo esc_html($tag->name); ?>"><?php echo esc_html($tag->name); ?></a>
                        <?php } else { ?>
                            <a href="#" class="tags button <?php echo esc_attr($tag->name); ?>" data-tag="<?php echo esc_html($tag->name); ?>" id="<?php echo esc_html($tag->name); ?>"><?php echo esc_html($tag->name); ?></a>
                    <?php }
                    endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="append-data">
            <div class="row mt-5">
                <?php

                $firstPosts = [];
                while (have_posts()) : the_post();
                    $post_id = get_the_ID();
                    if (empty($firstPosts)) {
                        $firstPosts[] = $post_id;
                ?>
                        <div class="col-12 wow fadeInUp mb-3 " data-wow-duration="2s">
                            <div class="card item fitness first-img">
                                <div class="row no-gutters raw">
                                    <div class="col-md-8">
                                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post_id)); ?>
                                        <a href="<?php the_permalink(); ?>"><img class="img-fluid" src="<?php echo $url; ?>" alt="..."></a>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body d-flex flex-wrap h-100 flex-column">
                                            <div>
                                                <?php $posttags = get_the_tags();
                                                if ($posttags) {
                                                    foreach ($posttags as $tag) { ?>
                                                        <span class="badge badge-secondary"><span class="badge badge-secondary"><?php echo $tag->name; ?></span></span>
                                                <?php }
                                                } ?>
                                            </div>
                                            <h3 class="card-text"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                                            <div class="star-bottom d-flex flex-column justify-content-between">
                                                <div class="star-group">
                                                    <i class="fa-solid fa-star main-color"></i>
                                                    <i class="fa-solid fa-star main-color"></i>
                                                    <i class="fa-solid fa-star main-color"></i>
                                                    <i class="fa-solid fa-star main-color"></i>
                                                    <i class="fa-solid fa-star main-color"></i>
                                                </div>
                                                <div class="drop-box">
                                                    <div class="drop-img mr-2">
                                                        <img class="img-fluid" src="https://recovr.com/wp-content/uploads/2022/06/spheres.svg" />
                                                    </div>
                                                    <div class="">
                                                        <span><strong><?php echo get_the_author(); ?></strong></span>
                                                        <span>-</span>
                                                        <span class="text-muted">recovr.com</span>
                                                        <p class="mb-0 text-muted"><strong><?php echo get_the_date('F jS, Y'); ?></strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                endwhile;
                ?>
                <?php wp_reset_postdata(); ?>
                <?php
                while (have_posts()) : the_post();
                    $post_id = get_the_ID();
                    if (!in_array($post_id, $firstPosts)) {

                ?>
                        <div class="col-md-6 wow fadeInUp mb-3" data-wow-duration="2s">
                            <div class="card item life h-100 two-img">
                                <div>
                                    <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post_id)); ?>
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $url; ?>" class="card-img-top" alt="..."></a>
                                </div>
                                <div class="card-body d-flex flex-wrap h-100 flex-column">
                                    <div>
                                        <?php $posttags = get_the_tags();
                                        if ($posttags) {
                                            foreach ($posttags as $tag) { ?>
                                                <span class="badge badge-secondary"><span class="badge badge-secondary"><?php echo $tag->name; ?></span></span>
                                        <?php }
                                        } ?>
                                    </div>
                                    <h3 class="card-text"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                                    <div class="star-bottom d-flex flex-column justify-content-between">
                                        <div class="star-group">
                                            <i class="fa-solid fa-star main-color"></i>
                                            <i class="fa-solid fa-star main-color"></i>
                                            <i class="fa-solid fa-star main-color"></i>
                                            <i class="fa-solid fa-star main-color"></i>
                                            <i class="fa-solid fa-star main-color"></i>
                                        </div>
                                        <div class="drop-box">
                                            <div class="drop-img mr-2">
                                                <img class="img-fluid" src="https://recovr.com/wp-content/uploads/2022/06/spheres.svg" />
                                            </div>
                                            <div class="">
                                                <span><strong><?php echo get_the_author(); ?></strong></span>
                                                <span>-</span>
                                                <span class="text-muted">recovr.com</span>
                                                <p class="mb-0 text-muted"><strong><?php echo get_the_date('F jS, Y'); ?></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                endwhile;
                ?>
                <?php wp_reset_postdata(); ?>
            </div>


            <!-- Start Pagination - WP-PageNavi -->
            <?php
            $url = $_SERVER['REQUEST_URI'];
            $s = explode("/", $url);
            $has_tag = $s[1];
            $tag_val = $s[2];
            $args = array(
                'post_type' => 'post',
                'tag' => $tag_val,
            );
            $firstPosts = array();
            $loop = new WP_Query($args);
            //print_r($args);
            //echo $loop->found_posts;
            ?>
            <?php
            $big = 999999999;
            $newbase = 'http://localhost/testpr/tag/' . $tag_val;
            // Fallback if there is not base set.
            $fallback_base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));

            // Set the base.
            $base = isset($newbase) ? trailingslashit($newbase) . '%_%' : $fallback_base;
            $tag =  '<div class="pagination-box wow fadeInUp mb-3 filter-pagination Inside-tag pagination">';
            $tag .=  paginate_links(array(
                'base' => $base,
                'format' => 'page/%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $loop->max_num_pages,
                'show_all' => true,
                'prev_text' => '<<',
                'next_text' => '>>'
            ));
            $tag .=  '</div>'; ?>
            <?php
            if ($loop->max_num_pages > 1) : ?>
                <ul class="pagination">
                    <li class="tags"><?php echo $tag; ?></li>
                </ul>
            <?php endif;
            ?>
            <!-- End Pagination -->

            <div class="my-4 wow fadeInUp mb-3 Inside-filter Inside-tag">
                <div class="news-later">
                    <div class="row align-items-center">
                        <div class="col-md-6 wow fadeInUp mb-3 mb-md-0 line-text">
                            <h5 class="footer-top-subtitile"> Subscribe to our Newsletter </h5>
                            <h3 class="footer-title"> <span class="news-letter-text">For the latest in fitness,<br>wellbeing and trainer tips</span> </h3>
                        </div>
                        <div class="col-md-6 wow fadeInUp mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Sign Me Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>