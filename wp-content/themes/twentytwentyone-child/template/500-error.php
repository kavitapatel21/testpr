<?php
// Custom 500 Internal Server Error page
get_header(); // Include your theme's header

echo '<div class="error-page">';
echo '<h1>500 Internal Server Error</h1>';
echo '<p>Custom error message goes here.</p>';
echo '</div>';

get_footer(); // Include your theme's footer