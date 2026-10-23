<?php
/**
 * Sovassa Technologies theme.
 *
 * @package Sovassa
 */

define('SOVASSA_VERSION', '2.2.3');
define('SOVASSA_SEED_VERSION', '5');

require get_template_directory() . '/inc/config.php';
require get_template_directory() . '/inc/content.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/content/insights-posts.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enquiries.php';
require get_template_directory() . '/inc/seo.php';
require get_template_directory() . '/inc/privacy.php';
require get_template_directory() . '/inc/performance.php';
require get_template_directory() . '/inc/linking.php';
require get_template_directory() . '/inc/articles.php';

/**
 * Whether a plugin in this folder is active. The theme steps aside for
 * Rank Math, Site Kit, and SureCookie so the page never prints two of a thing.
 *
 * @param string $folder Plugin folder, for example 'seo-by-rank-math'.
 * @return bool
 */
function sovassa_plugin_active($folder) {
	static $active = null;
	if (null === $active) {
		$active = (array) get_option('active_plugins', array());
		if (is_multisite()) {
			$active = array_merge($active, array_keys((array) get_site_option('active_sitewide_plugins', array())));
		}
	}
	foreach ($active as $plugin) {
		if (is_string($plugin) && str_starts_with($plugin, $folder . '/')) {
			return true;
		}
	}
	return false;
}

/**
 * Theme supports and menus.
 */
function sovassa_setup_theme() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support(
		'html5',
		array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets')
	);
	add_theme_support('responsive-embeds');
	register_nav_menus(
		array(
			'primary' => __('Primary', 'sovassa'),
			'footer'  => __('Footer', 'sovassa'),
		)
	);
	add_image_size('sovassa-card', 960, 600, true);
}
add_action('after_setup_theme', 'sovassa_setup_theme');

/**
 * Front-end assets.
 */
function sovassa_enqueue_assets() {
	wp_enqueue_style(
		'sovassa-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		SOVASSA_VERSION
	);
	if (is_front_page()) {
		wp_enqueue_style(
			'sovassa-home',
			get_template_directory_uri() . '/assets/css/home.css',
			array('sovassa-main'),
			SOVASSA_VERSION
		);
		wp_enqueue_script(
			'sovassa-home',
			get_template_directory_uri() . '/assets/js/home.js',
			array(),
			SOVASSA_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
	wp_enqueue_script(
		'sovassa-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		SOVASSA_VERSION,
		true
	);
	$current_page = function_exists('sovassa_current_page') ? sovassa_current_page() : null;
	$is_quote     = is_page('get-a-quote') || is_page('quote') || ($current_page && isset($current_page['layout']) && 'quote' === $current_page['layout']);
	if ($is_quote) {
		wp_enqueue_script(
			'sovassa-quote',
			get_template_directory_uri() . '/assets/js/quote.js',
			array(),
			SOVASSA_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
	wp_enqueue_script(
		'dmca-badge',
		'https://images.dmca.com/Badges/DMCABadgeHelper.min.js',
		array(),
		null,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action('wp_enqueue_scripts', 'sovassa_enqueue_assets');

/**
 * Favicon.
 */
function sovassa_favicon() {
	$icon = get_template_directory_uri() . '/assets/images/favicon.svg?ver=' . SOVASSA_VERSION;
	echo '<link rel="icon" href="' . esc_url($icon) . '" type="image/svg+xml">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url($icon) . '">' . "\n";
}
add_action('wp_head', 'sovassa_favicon', 1);

/**
 * Body classes for the current layout.
 *
 * @param array<int, string> $classes
 * @return array<int, string>
 */
function sovassa_body_classes($classes) {
	$page = sovassa_current_page();
	if ($page && !empty($page['layout'])) {
		$classes[] = 'layout-' . sanitize_html_class($page['layout']);
	}
	if (is_front_page()) {
		$classes[] = 'is-front';
	}
	return $classes;
}
add_filter('body_class', 'sovassa_body_classes');

/**
 * Remember the cookie choice for six months. Analytics stays off unless the visitor accepts it.
 */
function sovassa_handle_cookie() {
	$nonce = isset($_POST['sovassa_cookie_nonce']) ? sanitize_text_field(wp_unslash($_POST['sovassa_cookie_nonce'])) : '';
	if (!wp_verify_nonce($nonce, 'sovassa_cookie')) {
		wp_safe_redirect(home_url('/'));
		exit;
	}
	$choice = (isset($_POST['choice']) && 'all' === $_POST['choice']) ? 'all' : 'essential';
	setcookie(
		'sovassa_cookie',
		$choice,
		array(
			'expires'  => time() + (180 * DAY_IN_SECONDS),
			'path'     => COOKIEPATH ? COOKIEPATH : '/',
			'domain'   => COOKIE_DOMAIN,
			'secure'   => is_ssl(),
			'httponly' => false,
			'samesite' => 'Lax',
		)
	);
	$back = wp_get_referer();
	wp_safe_redirect($back ? $back : home_url('/'));
	exit;
}
add_action('admin_post_nopriv_sovassa_cookie', 'sovassa_handle_cookie');
add_action('admin_post_sovassa_cookie', 'sovassa_handle_cookie');
