<style>
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

    /** .breadcrumb {
        background: transparent;
    }*/

    .post-pagination a {
        color: #fff !important;
        background: #586d39;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
    }

    .breadcrumb-item {
        text-align: center;
    }

    .breadcrumb-item a {
        color: #757575 !important;
    }

    .breadcrumb-item.active {
        color: var(--primary-color);
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

    .item img {
        height: auto;
        object-fit: cover;
        width: 100%;
    }

    .hide {
        display: none;
    }

    .card-body .badge {
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

    .card-body {
        border-radius: 16px !important;
        overflow: hidden;
        transition-duration: 0.2s;
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

        .login-col {
            right: 0 !important;
            top: 9px !important;
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
<?php
/**
 * The template for displaying all upcoming single posts
 */

get_header();
echo "normal post type";
?>
<!--<div class="row my-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb-item"><a href="#"><?php //get_breadcrumb(); 
                                                        ?></a></div>
        </nav>
    </div>
</div>
<hr>-->
<div class="container">
    <div class="append-data">
        <div class="row mt-5">
            <?php
            /* Start the Loop */
            while (have_posts()) :
                the_post();
                $post_id = get_the_ID();
            ?>
                <div class="col-md-9 m-auto wow fadeInUp mb-3" data-wow-duration="2s">
                    <div class=" item fitness h-100">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="card-body px-0 d-flex flex-wrap h-100 flex-column">
                                    <div>
                                        <?php $posttags = get_the_tags();
                                        if ($posttags) {
                                            foreach ($posttags as $tag) { ?>
                                                <span class="badge badge-secondary">
                                                    <span class="badge badge-secondary"><?php echo $tag->name; ?></span>
                                                </span>
                                        <?php }
                                        } ?>
                                    </div>
                                    <h3 class="card-text mt-3"><?php the_title(); ?></h3>
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
                            <div class="col-12 m-auto">
                                <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post_id)); ?>
                                <img class="img-fluid" src="<?php echo $url; ?>" alt="...">
                            </div>
                            <div class="col-12 mt-4">
                                <p><?php echo the_content(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; // End of the loop. 
            ?>
        </div>
    </div>

    <?php
    $next_post = get_adjacent_post(false, '', false);
    $next_post_url = get_the_permalink($next_post);

    $previous_post = get_adjacent_post(false, '', true);
    $previous_post_url = get_the_permalink($previous_post);
    ?>

    <div class="row col-md-9 mx-auto p-0 post-pagination mt-4">
        <div class="col-6 p-0"><a href="<?php echo $previous_post_url; ?>" class="prev_post_url">
                &lt;&lt; Previous</a></div>
        <div class="col-6 p-0 text-right">
            <a href="<?php echo $next_post_url; ?>" class="next_post_url">Next &gt;&gt;</a>
        </div>
    </div>


    <div class="my-4 wow fadeInUp mb-3 Inside-tag">
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

<?php
get_footer();
?>
<script>
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
    })
</script>