<?php
/**
 * Keep plugin assets off pages the theme renders itself.
 *
 * Elementor still holds data for the old home page and LatePoint is installed
 * without being used, so both load CSS, jQuery, and scripts on every page.
 * None of it is needed where the theme draws the layout.
 *
 * @package Sovassa
 */

/**
 * Whether the theme draws this view without the_content() from a page builder.
 *
 * Pages that fall back to the_content() in page.php keep Elementor, in case one
 * of them was built with it.
 *
 * @return bool
 */
function sovassa_renders_own_layout() {
	if (is_admin() || (isset($_GET['elementor-preview']) && current_user_can('edit_posts'))) {
		return false;
	}
	if (is_front_page() || sovassa_current_page()) {
		return true;
	}
	return !is_page();
}

/**
 * Asset handles the theme never needs, matched by prefix.
 *
 * @return array<int, string>
 */
function sovassa_unused_asset_prefixes() {
	$prefixes = array('latepoint-');
	if (sovassa_renders_own_layout()) {
		$prefixes = array_merge(
			$prefixes,
			array('elementor-', 'e-animation-', 'widget-', 'font-awesome-', 'swiper', 'eicons', 'jquery-numerator')
		);
	}
	return $prefixes;
}

/**
 * Dequeue matching styles and scripts. jQuery and jQuery UI drop out on their own
 * once nothing that is still queued depends on them.
 */
function sovassa_dequeue_unused_assets() {
	$prefixes = sovassa_unused_asset_prefixes();
	foreach (array(wp_styles(), wp_scripts()) as $deps) {
		foreach ($deps->queue as $handle) {
			foreach ($prefixes as $prefix) {
				if (str_starts_with($handle, $prefix)) {
					if ($deps instanceof WP_Scripts) {
						wp_dequeue_script($handle);
					} else {
						wp_dequeue_style($handle);
					}
					break;
				}
			}
		}
	}
}
add_action('wp_enqueue_scripts', 'sovassa_dequeue_unused_assets', 9999);
// Elementor and LatePoint can enqueue late: icon fonts and Google Fonts arrive just
// before the head prints its styles, others while the page renders.
add_action('wp_print_styles', 'sovassa_dequeue_unused_assets', 0);
add_action('wp_print_footer_scripts', 'sovassa_dequeue_unused_assets', 0);

/**
 * Elementor's Montserrat and Source Sans Pro requests. The theme ships its own fonts.
 *
 * @param bool $print Whether Elementor prints Google Fonts.
 * @return bool
 */
function sovassa_skip_elementor_fonts($print) {
	return sovassa_renders_own_layout() ? false : $print;
}
add_filter('elementor/frontend/print_google_fonts', 'sovassa_skip_elementor_fonts');

/**
 * LatePoint adds inline CSS and a body class even when nothing is booked.
 *
 * @param array<int, string> $classes Body classes.
 * @return array<int, string>
 */
function sovassa_trim_body_classes($classes) {
	$drop = array('latepoint');
	if (sovassa_renders_own_layout()) {
		$classes = array_filter(
			$classes,
			function ($class) {
				return !str_starts_with($class, 'elementor-');
			}
		);
	}
	return array_values(array_diff($classes, $drop));
}
add_filter('body_class', 'sovassa_trim_body_classes', 99);

/**
 * Emoji detection script and styles. Browsers render emoji natively.
 */
function sovassa_disable_emoji() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('wp_enqueue_scripts', 'wp_enqueue_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'sovassa_disable_emoji');

/**
 * Small header leaks: the WordPress version and the pingback endpoint.
 *
 * @param array<string, string> $headers Response headers.
 * @return array<string, string>
 */
function sovassa_trim_headers($headers) {
	unset($headers['X-Pingback']);
	return $headers;
}
add_filter('wp_headers', 'sovassa_trim_headers');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
add_filter('the_generator', '__return_empty_string');
