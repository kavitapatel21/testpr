<style>
    .page-id-10567 {
        background-color: #f5f5f5;
    }

    * {
        font-family: "Work Sans", Sans-serif;
    }

    :root {
        --primary-color: #586d39;
    }

    .main-color {
        color: var(--primary-color);
    }

    .item {
        border-radius: 4px !important;
        /* height: 100%; */
        width: 100%;
    }

    .buttons a {
        text-decoration: none;
        padding: 0 20px;
        color: #000;
        font-size: 18px;
    }

    .buttons a.active {
        color: var(--primary-color);
        font-weight: bold;
    }

    .grid {
        grid-template-columns: 1fr;
        margin: 0 auto 80px;
        max-width: 90%;
        grid-gap: 20px;
        display: grid;
        width: 100%;
    }

    .two-img img {
        height: 330px;
        object-fit: cover;
        width: 100%;
    }

    .first-img img {
        height: 500px;
        object-fit: cover;
        width: 100%;
    }

    .drop-box img {
        height: auto;
        object-fit: cover;
        width: 100%;
    }

    .item a {
        display: flex;
        width: 100%;
    }


    .hide {
        display: none;
    }

    .card .badge {
        background-color: var(--primary-color);
        font-size: 12px;
        padding: 3px 8px;
    }

    .card-text {
        margin: 15px 0;
        font-size: 28px;
        letter-spacing: -.15px;
        font-weight: 550 !important;
        color: #333 !important;
        text-transform: capitalize !important;
    }

    .drop-img {
        width: 55px;
        height: 55px;
        text-align: center;
        background: var(--primary-color);
        border-radius: 50%;
        padding: 10px;
    }

    .star-bottom {
        flex: 1;
    }

    .star-group {
        margin-bottom: 40px;
    }

    .drop-box {
        display: flex;
        align-items: center;
    }

    .card {
        border-radius: 16px !important;
        overflow: hidden;
        transition-duration: 0.2s;
    }

    .card:hover {
        box-shadow: 0 0 50px -5px #0000004d;
    }

    .pagination {
        justify-content: center;
        margin-top: 30px;
        margin-bottom: 50px;
    }

    .pagination li {
        display: inline
    }

    .pagination li a {
        display: inline-block;
        text-decoration: none;
        padding: 5px 10px;
        color: #000
    }

    .pagination li a {
        border-radius: 50%;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
        width: 35px;
        height: 35px;
        text-align: center;
    }

    .pagination li a.active {
        background-color: var(--primary-color);
        color: #fff;
    }

    .pagination li a:hover:not(.active) {
        background-color: #ddd;
    }

    .news-later {
        border: 1px solid #c4cbd8;
        padding: 30px;
        border-radius: 8px;
        background-color: #fff;
        margin-bottom: 70px;
        border-radius: 16px;
    }

    .news-later input {
        height: 56px;
        margin-right: 30px;
        border-radius: 8px;
    }

    .news-later .btn {
        border-radius: 40px !important;
        padding: 0 20px;
        background-color: var(--primary-color);
        color: #fff;
        border: 0;
        font-weight: 600;
        font-size: 18px;
    }

    .input-group {
        flex-wrap: wrap;
    }

    .my-4.wow.fadeInUp mb-3 {
        padding-bottom: 50px;
    }

    .col-md-6 {
        padding-top: 15px;
        display: flex;
    }

    .col-md-8 {
        display: flex;
    }

    .raw {
        min-height: 480px;
    }

    strong {
        color: #333;
    }

    .news-letter-text {
        color: #333;
        font-weight: 550;
        font-size: 26px;
        text-transform: capitalize;
    }

    .btn:hover {
        color: #fff !important;
        background-color: #7aa56e !important;
    }

    .drop-img img {
        object-fit: contain;
    }

    .elementor-menu-toggle {
        color: #fff !important;
    }

    .elementor-22 .elementor-element.elementor-element-56a3b98 .elementor-menu-toggle {
        color: #fff;
    }

    .line-text {
        display: inline;
        text-transform: capitalize;
    }

    .col-md-4 {
        display: flex;
    }

    span.page-numbers.current {
        background-color: #586d39;
        border-radius: 50%;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
        width: 35px !important;
        height: 35px !important;
        text-align: center;
        color: white;
        padding: 5px;
    }

    .scrollbar {
        display: flex;
        overflow-x: auto;
        padding: 8px;
    }

    .scrollbar::-webkit-scrollbar {
        padding: 10px;
        width: 2px;
        height: 2px;
    }

    .scrollbar::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgb(255, 255, 255);
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }

    .scrollbar::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #f1f1f1;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
    }

    .scrollbar::-webkit-scrollbar-thumb:window-inactive {
        background: #f1f1f1;
    }

    @media(max-width:767px) {
        .item img {
            width: 100%;
            object-fit: contain;
        }

        .logo-img img {
            height: auto !important;
            max-width: 100%;
        }

        .first-img img {
            width: 100%;
            object-fit: cover;
        }

        .login-col {
            right: 0 !important;
            top: 9px !important;
        }

        .two-img img {
            height: fix;
            width: 100%;
            object-fit: cover;
        }

        .menu-item {
            margin-right: 10px !important;
        }
    }

    @media (max-width:576px) {
        .card-text {
            font-size: 20px;
        }
    }

    @media(max-width:486px) {
        .elementor-22 .elementor-element.elementor-element-165a0e3 {
            width: 100px !important;
        }
    }

    @media(max-width:375px) {
        .elementor-22 .elementor-element.elementor-element-e51696d img {
            margin-right: 60px;
        }

        .item img {
            object-fit: cover;
        }
    }

    @media(max-width:1024px) {
        .elementor-nav-menu--dropdown.elementor-nav-menu__container {
            margin-top: 0 !important;
        }

        .body-top {
            padding-top: 54px;
        }
    }

    @media screen and (max-width: 765px) and (min-width: 425px) {
        .app-image img.attachment-large.size-large {
            height: 60px !important;
            max-width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }
    }
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/template/js/get-env-val-js.js" type="text/javascript"></script>

<?php
/*
 * Template Name: New-Latest-Blog-page
 * description: >-
  Page template without sidebar
 */

get_header();
?>

<?php

/* Get .env file varible value [Start] */
$envFilePath = ABSPATH . '.env';
if (file_exists($envFilePath)) {
    $envFileContents = file_get_contents($envFilePath);
    $envFileLines = explode("\n", $envFileContents);
    // Parse and load the environment variables
    foreach ($envFileLines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    // Access environment variables
    $customVar = getenv('VARIABLE_NAME_SITE');
    echo $customVar . "<br>";
    echo getenv('VARIABLE_NAME')."<br>";
    // Use the variables in your code
    // ...
} else {
    // Handle the case when the .env file doesn't exist
    echo ".env file not found.<br>";
}
/* Get .env file variable value [End] */
global $wp;
$base = home_url($wp->request);
?>
<input type="hidden" name="base" value="<?php echo $base; ?>" />
<div class="container">
    <div class="buttons mt-5">
        <div class="scrollbar">
            <a href="#" class="tags button all active" data-tag="all">All</a>
            <?php
            $tags = get_tags(); //taxonomy=post_tag
            ?>
            <?php if ($tags) :
                foreach ($tags as $tag) : ?>
                    <a href="#" class="tags button <?php echo esc_attr($tag->name); ?>" data-tag="<?php echo esc_html($tag->name); ?>"><?php echo esc_html($tag->name); ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="append-data">
        <div class="row mt-5">
            <?php
            $firstPosts = array();
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $posts_per_page = get_option('posts_per_page');
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => $firstPosts,
                'paged' => $paged,
                'offset' => ($paged - 1) * $posts_per_page,
            );
            $loop = new WP_Query($args); ?><?php

                                            while ($loop->have_posts()) : $loop->the_post();
                                                $post_id = get_the_ID();
                                                $firstPosts[] = $post_id;
                                            ?>
            <div class="col-12 wow fadeInUp mb-3 " data-wow-duration="2s">
                <div class="card item fitness first-img">
                    <div class="row no-gutters raw">
                        <div class="col-md-8">
                            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($loop->ID)); ?>
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
                                            <img class="img-fluid" src="https://transdirect.plutustec.in/wp-content/uploads/2022/06/spheres.svg" />
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
                                            endwhile;
        ?>
        <?php wp_reset_postdata(); ?>

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => $firstPosts,
            'posts_per_page' => 6,
            'paged' => $paged,
            'offset' => ($paged - 1) * $posts_per_page,
        );
        $loop = new WP_Query($args); ?>
        <?php
        while ($loop->have_posts()) : $loop->the_post();
            $post_id = get_the_ID();
            $firstPosts[] = $post_id;
            //print_r($firstPosts);
        ?>
            <div class="col-md-6 wow fadeInUp mb-3" data-wow-duration="2s">
                <div class="card item life h-100 two-img">
                    <div>
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($loop->ID)); ?>
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
                                    <img class="img-fluid" src="https://transdirect.plutustec.in/wp-content/uploads/2022/06/spheres.svg" />
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
        endwhile;
        ?>
        <?php wp_reset_postdata(); ?>
        </div>


        <!-- Start Pagination - WP-PageNavi -->
        <?php
        $args = array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        );
        $loop = new WP_Query($args);
        $total_posts = $loop->found_posts;
        //echo $total_posts;
        $total_pg =  $loop->max_num_pages;
        //echo $total_pg;

        $big = 999999999;
        $tag =  '<div class="pagination-box wow fadeInUp mb-3 Inside-filter pagination">';
        $tag .=  paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $total_pg,
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


        <div class="my-4 wow fadeInUp mb-3 Inside-filter">
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


<?php
get_footer();
?>
<script>
    
    new WOW().init();
    wow = new WOW({
        boxClass: 'wow', // default
        animateClass: 'animated', // default
        offset: 0, // default
        mobile: true, // default
        live: true // default
    })
    // Check active classes
    var checkClass = function() {
        if ($('.item').parent().hasClass('hide')) {
            $('.item').parent().removeClass('hide');
        }
    };

    // Category filters
    $('.all').click(function() {
        checkClass();
        $('.row .col-12:nth-child(n+1)').addClass('hide');
        $('.row .col-12:first-child()').removeClass('hide');
    });
    $('.nutrition').click(function() {
        checkClass();
        $('.item:not(.nutrition)').parent().toggleClass('hide');
    });
    $('.fitness').click(function() {
        checkClass();
        $('.item:not(.fitness)').parent().toggleClass('hide');
    });
    $('.life').click(function() {
        checkClass();
        $('.item:not(.life)').parent().toggleClass('hide');
    });
    $('.recipes').click(function() {
        checkClass();
        $('.item:not(.recipes)').parent().toggleClass('hide');
    });
    $('.exercises').click(function() {
        checkClass();
        $('.item:not(.exercises)').parent().toggleClass('hide');
    });
    $('.workout').click(function() {
        checkClass();
        $('.item:not(.workout)').parent().toggleClass('hide');
    });

    // Active tag
    $('.button').click(function() {
        $('.button').removeClass('active');
        $(this).addClass('active');
    });

    $(".tags").click(function() {
      
        var param = $(this).data('tag');
        var base = $('input[name=base]').val()
        if (param == 'all') {
            var tags = '';
        } else {
            var tags = param;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                'action': 'get_tag_val',
                'param': tags,
                'base': base
            },
            beforeSend: function() {
                var form = jQuery('.Inside-filter').show();
                $('.append-data').empty().append(form);
    },
        success:function (result) {
            $('.append-data').empty().append(result);
    },    
        });
    });
</script>