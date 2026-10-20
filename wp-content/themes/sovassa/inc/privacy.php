<?php
/**
 * Keep WordPress account names out of public responses.
 *
 * The site publishes as the company, so visitors never need a user's login,
 * display name, or author archive.
 *
 * @package Sovassa
 */

/**
 * Hide the users endpoints from logged-out REST requests. The block editor
 * still uses them, because editors are logged in.
 *
 * @param array<string, mixed> $endpoints Registered routes.
 * @return array<string, mixed>
 */
function sovassa_hide_rest_users($endpoints) {
	if (is_user_logged_in()) {
		return $endpoints;
	}
	foreach (array_keys($endpoints) as $route) {
		if (str_starts_with($route, '/wp/v2/users')) {
			unset($endpoints[$route]);
		}
	}
	return $endpoints;
}
add_filter('rest_endpoints', 'sovassa_hide_rest_users');

/**
 * Author archives, including ?author=1, would reveal the user slug.
 * Send them to Insights before WordPress redirects to /author/<slug>/.
 */
function sovassa_redirect_author_archives() {
	if (is_admin() || !is_author()) {
		return;
	}
	wp_safe_redirect(home_url('/insights/'), 301);
	exit;
}
add_action('template_redirect', 'sovassa_redirect_author_archives', 0);

/**
 * oEmbed responses name the post author. Use the company instead.
 *
 * @param array<string, mixed> $data oEmbed response.
 * @return array<string, mixed>
 */
function sovassa_oembed_author($data) {
	$data['author_name'] = sovassa_config()['name'];
	$data['author_url']  = home_url('/');
	return $data;
}
add_filter('oembed_response_data', 'sovassa_oembed_author');

/**
 * Feeds print the author as dc:creator. Use the company there too.
 *
 * @param string|null $name Author display name.
 * @return string|null
 */
function sovassa_feed_author($name) {
	return is_feed() ? sovassa_config()['name'] : $name;
}
add_filter('the_author', 'sovassa_feed_author');
