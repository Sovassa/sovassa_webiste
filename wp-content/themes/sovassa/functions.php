<?php
/**
 * Sovassa Technologies theme.
 *
 * @package Sovassa
 */

define('SOVASSA_VERSION', '1.3.7');
define('SOVASSA_SEED_VERSION', '3');

require get_template_directory() . '/inc/config.php';
require get_template_directory() . '/inc/content.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/content/insights-posts.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enquiries.php';
require get_template_directory() . '/inc/seo.php';

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
		'sovassa-fonts',
		'https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'sovassa-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array('sovassa-fonts'),
		SOVASSA_VERSION
	);
	wp_enqueue_script(
		'sovassa-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		SOVASSA_VERSION,
		true
	);
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
 * Preconnect to the font host.
 *
 * @param array<int, string|array<string, string>> $urls
 * @param string                                   $relation_type
 * @return array<int, string|array<string, string>>
 */
function sovassa_resource_hints($urls, $relation_type) {
	if ('preconnect' === $relation_type) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter('wp_resource_hints', 'sovassa_resource_hints', 10, 2);

/**
 * Favicon.
 */
function sovassa_favicon() {
	$icon = get_template_directory_uri() . '/assets/images/favicon-32.png?ver=' . SOVASSA_VERSION;
	$touch = get_template_directory_uri() . '/assets/images/apple-touch-icon.png?ver=' . SOVASSA_VERSION;
	echo '<link rel="icon" href="' . esc_url($icon) . '" type="image/png" sizes="32x32">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url($touch) . '">' . "\n";
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
