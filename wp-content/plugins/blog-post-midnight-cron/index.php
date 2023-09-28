<?php

/**
 * Plugin Name: mid-night-cron-blog-posts
 * Plugin URI: https://transdirect.plutustec.in/
 * Description: recovr blogs
 * Version: 0.1
 * Author: recovr
 * Author URI: https://transdirect.plutustec.in/
 **/


/**Creating custom cron for add-update post on admin panel [Start] */
/* function my_cron_schedules($schedules)
{
	if (!isset($schedules["daily"])) {
		$schedules["daily"] = array(
			'interval' => 24 * 60,
			'display' => __('Once daily')
		);
	}
	return $schedules;
}
add_filter('cron_schedules', 'my_cron_schedules'); */

// Define a function to schedule the cron job on plugin activation
function schedule_plugin_cron_job() {
    // Calculate the timestamp for when you want the cron job to run (e.g., every day at midnight)
    $timestamp = strtotime('today midnight');

    // Schedule the cron job
    wp_schedule_event($timestamp, 'daily', 'my_blog_posts_midnight_cron');
}

// Hook the function to run when the plugin is activated
register_activation_hook(__FILE__, 'schedule_plugin_cron_job');

//add_action('init', 'my_task_function');
//add_action('init', 'my_task_function');
add_action('my_blog_posts_midnight_cron', 'my_task_function');
function my_task_function()
{
	echo require_once 'custom-cron.php';
}
/**Creating custom cron for add-update post on admin panel [End] */

// Define a function to remove the scheduled cron event
function remove_plugin_cron_job() {
    // Use the same hook name that you used when scheduling the event
    wp_clear_scheduled_hook('my_blog_posts_midnight_cron');
}

// Hook the function to run when the plugin is deactivated
register_deactivation_hook(__FILE__, 'remove_plugin_cron_job');
