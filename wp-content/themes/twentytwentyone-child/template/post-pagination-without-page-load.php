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
/*
 * Template Name: post-pagination-without-page-load
 * description: >-
  Page template without sidebar
 */

get_header();
?>

<?php
$tag = ''; // Initialize the tag to be empty.
if (isset($_POST['tag'])) {
    $tag = sanitize_text_field($_POST['tag']); // Get the selected tag.
}

$paged = (isset($_POST['page'])) ? intval($_POST['page']) : 1; // Get the requested page number.
echo $paged;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 7, // Number of posts to display per page.
    'paged' => $paged,
    'tag' => $tag,
);

$custom_query = new WP_Query($args);
echo 'total posts:'.$totalpost = $custom_query->found_posts;
echo '<br>total pages:'.$total_pages = round($totalpost/7);
if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post();
        // Display your post content here.
        ?>
        <div class="post post-list" id="post-listing" data-totalposts = "<?php echo $total_pages ?>">
            <h6><?php the_title(); ?></h6>
            <!-- <div class="post-content">
                <?php //the_content(); ?>
            </div> -->
        </div>
        <?php
    endwhile;
endif;
?>

  

<!-- <div class="filter-tags">
    <?php 
    // wp_tag_cloud(array(
    //     'taxonomy' => 'post_tag', // Use 'post_tag' for post tags.
    //     'format' => 'list',
    //     'smallest' => 12,
    //     'largest' => 12,
    //     'unit' => 'px',
    // )); 
    ?>
</div> -->
<div class="pagination">
    <button class="prev">Previous</button>
    <?php
    for($i=1;$i<=$total_pages;$i++){
        echo '<h5 class="pg_no">' . $i . '</h5>';
    }
    ?>
    <button class="next">Next</button>
</div>
<div id="post-container">
    <!-- Filtered posts will be loaded here via AJAX -->
</div>

<div id="page-number">
    <!-- Page number will be updated dynamically -->
</div>

<div id="post-pagination">
    <!-- Pagination within filtered posts will be updated via AJAX -->
</div>

<script>
    jQuery(document).ready(function ($) {
    var $postList = $('.post-list');
    var $pagination = $('.pagination');
    var $prevButton = $pagination.find('.prev');
    var $nextButton = $pagination.find('.next');
    var $posts = $postList.children('h6');
    console.log($posts.length);
    //alert($posts.lenght);
    var postsPerPage = 7; // Adjust the number of posts per page as needed.
    var currentPage = 1;
    var numPages = Math.ceil($('#post-listing').data('totalposts'));
    alert(numPages);

    // Function to show the appropriate posts for the current page.
    function showPage(page) {
        $posts.hide();
        var start = (page - 1) * postsPerPage;
        var end = start + postsPerPage;
        $posts.slice(start, end).show();
    }

    // Initial page display.
    showPage(currentPage);

    // Next button click handler.
    $nextButton.on('click', function () {
        if (currentPage < numPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Previous button click handler.
    $prevButton.on('click', function () {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });
});
// jQuery(document).ready(function ($) {
//     var currentPage = 1; // Initialize the current page.

//     // Function to handle tag clicks and trigger AJAX.
//     $('.filter-tag').on('click', function () {
//         var tag = $(this).data('tag');
//         currentPage = 1; // Reset to page 1 when a new filter is selected.

//         // Make an AJAX request to your custom endpoint.
//         $.ajax({
//             type: 'POST',
//             url: '<?php //echo admin_url('admin-ajax.php'); ?>', // WordPress's AJAX URL.
//             data: {
//                 action: 'filter_posts',
//                 tag: tag,
//                 page: currentPage
//             },
//             success: function (response) {
//                 // Update the content area with the filtered posts.
//                 $('#post-container').html(response);
//                 // Update the page number element.
//                 $('#page-number').text(currentPage);
//             }
//         });
//     });
// });

jQuery(document).ready(function ($) {
    // Function to handle tag clicks and trigger AJAX.
    $('.page-numbers').on('click', function () {
        var pagenumber = $(this).html();
        //alert(pagenumber);

        // Make an AJAX request to your custom endpoint.
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>', // WordPress's AJAX URL.
            data: {
                action: 'filter_page_posts',
                //tag: tag,
                page: pagenumber
            },
            success: function (response) {
                console.log(response);
                // Update the content area with the filtered posts.
                $('#post-listing').empty();
                $('#post-listing').append(response);
                $('#post-container').html(response);
                // Update the page number element.
                $('#page-number').text(currentPage);
            }
        });
    });
});
</script>