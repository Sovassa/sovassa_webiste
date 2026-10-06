<?php
/**
 * Page content registry.
 *
 * @package Sovassa
 */

/**
 * All marketing pages, keyed by slug.
 *
 * @return array<string, array<string, mixed>>
 */
function sovassa_pages() {
	static $pages = null;
	if (null === $pages) {
		$pages = array_merge(
			require __DIR__ . '/content/company.php',
			require __DIR__ . '/content/services.php',
			require __DIR__ . '/content/markets.php',
			require __DIR__ . '/content/industries.php'
		);
	}
	return $pages;
}

/**
 * One page definition.
 *
 * @param string $slug Page slug.
 * @return array<string, mixed>|null
 */
function sovassa_page($slug) {
	$pages = sovassa_pages();
	return isset($pages[$slug]) ? $pages[$slug] : null;
}

/**
 * The structured page for the current request, when one exists.
 *
 * @return array<string, mixed>|null
 */
function sovassa_current_page() {
	if (is_front_page()) {
		return sovassa_page('home');
	}
	if (is_home()) {
		return sovassa_page('insights');
	}
	if (is_page()) {
		$post = get_queried_object();
		if ($post instanceof WP_Post) {
			$uri  = get_page_uri($post);
			$page = sovassa_page($uri);
			if (!$page) {
				$page = sovassa_page($post->post_name);
			}
			return $page;
		}
	}
	return null;
}

/**
 * Public path for a slug. The home page lives at /.
 *
 * @param string $slug Page slug.
 * @return string
 */
function sovassa_path($slug) {
	if ('home' === $slug) {
		return '/';
	}
	return '/' . trim($slug, '/') . '/';
}

/**
 * Absolute URL for a slug or an already-absolute path.
 *
 * @param string $slug_or_path Slug or path.
 * @return string
 */
function sovassa_url($slug_or_path) {
	if (str_starts_with($slug_or_path, 'http') || str_starts_with($slug_or_path, '/')) {
		$path = str_starts_with($slug_or_path, 'http') ? $slug_or_path : $slug_or_path;
		return str_starts_with($path, 'http') ? $path : home_url($path);
	}
	return home_url(sovassa_path($slug_or_path));
}

/**
 * Overlay and footer navigation groups.
 *
 * @return array<int, array<string, mixed>>
 */
function sovassa_nav_groups() {
	return array(
		array(
			'label' => 'Company',
			'links' => array('about', 'work', 'careers', 'contact'),
		),
		array(
			'label' => 'Build',
			'links' => array('web-development', 'mobile-app-development', 'ai-automation', 'ui-ux-design'),
		),
		array(
			'label' => 'Market',
			'links' => array('seo', 'digital-marketing', 'social-media-marketing', 'google-ads', 'content-marketing'),
		),
		array(
			'label' => 'Grow',
			'links' => array('solutions', 'industries', 'technologies', 'insights'),
		),
	);
}

/**
 * Flat list of pages that belong in the WordPress menu.
 *
 * @return array<int, string>
 */
function sovassa_menu_slugs() {
	$slugs = array('about', 'services', 'work', 'technologies', 'insights', 'careers', 'contact', 'get-a-quote');
	foreach (sovassa_nav_groups() as $group) {
		foreach ($group['links'] as $slug) {
			$slugs[] = $slug;
		}
	}
	return array_values(array_unique($slugs));
}
