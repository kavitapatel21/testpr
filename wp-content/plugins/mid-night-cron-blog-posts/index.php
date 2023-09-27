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
function my_cron_schedules($schedules)
{
	if (!isset($schedules["1min"])) {
		$schedules["1min"] = array(
			'interval' => 60,
			'display' => __('Once every 1 minutes')
		);
	}
	return $schedules;
}
add_filter('cron_schedules', 'my_cron_schedules');

if (!wp_next_scheduled('my_task_hook')) {
	wp_schedule_event(time(), '1min', 'my_task_hook');
}

//add_action('init', 'my_task_function');
//add_action('init', 'my_task_function');
function my_task_function()
{
	echo require_once 'custom-cron.php';
}
/**Creating custom cron for add-update post on admin panel [End] */