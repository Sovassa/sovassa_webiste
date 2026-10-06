<?php
/**
 * Titles, meta descriptions, and structured data.
 *
 * @package Sovassa
 */

/**
 * Prefer the page's own title.
 *
 * @param string $title Generated title.
 * @return string
 */
function sovassa_document_title($title) {
	$page = sovassa_current_page();
	if ($page && !empty($page['meta_title'])) {
		return (string) $page['meta_title'];
	}
	if (is_singular('post')) {
		return get_the_title() . ' | Sovassa Technologies';
	}
	return $title;
}
add_filter('pre_get_document_title', 'sovassa_document_title');

/**
 * Meta description for the current view.
 *
 * @return string
 */
function sovassa_meta_description() {
	$page = sovassa_current_page();
	if ($page && !empty($page['meta_description'])) {
		return (string) $page['meta_description'];
	}
	if (is_singular('post')) {
		$excerpt = get_the_excerpt();
		if ($excerpt) {
			return wp_strip_all_tags($excerpt);
		}
	}
	return 'Sovassa Technologies helps companies build digital products and market them with a single team. Web, mobile, AI, design, SEO, and growth programs.';
}

/**
 * Print meta tags and JSON-LD.
 */
function sovassa_seo_head() {
	$description = sovassa_meta_description();
	$url         = sovassa_current_url();
	$title       = wp_get_document_title();
	$image       = get_template_directory_uri() . '/assets/images/og-share.png';

	if (sovassa_is_noindex_view()) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	}
	$verification = isset(sovassa_config()['search_console_verification']) ? sovassa_config()['search_console_verification'] : '';
	if (is_string($verification) && preg_match('/^[A-Za-z0-9_-]{8,128}$/', $verification)) {
		echo '<meta name="google-site-verification" content="' . esc_attr($verification) . '">' . "\n";
	}
	echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
	echo '<meta property="og:site_name" content="Sovassa Technologies">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
	echo '<meta property="og:type" content="' . (is_singular('post') ? 'article' : 'website') . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
	echo '<meta property="og:image:width" content="1200">' . "\n";
	echo '<meta property="og:image:height" content="630">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";

	$graph = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			sovassa_organization_schema(),
		),
	);

	$breadcrumb = sovassa_breadcrumb_schema();
	if ($breadcrumb) {
		$graph['@graph'][] = $breadcrumb;
	}

	$page = sovassa_current_page();
	if ($page && isset($page['layout']) && 'service' === $page['layout']) {
		$graph['@graph'][] = array(
			'@type'       => 'Service',
			'name'        => isset($page['wp_title']) ? $page['wp_title'] : $page['title'],
			'description' => $page['meta_description'],
			'provider'    => array('@id' => home_url('/#organization')),
			'url'         => $url,
			'areaServed'  => 'Worldwide',
		);
	}

	if ($page && !empty($page['faq']) && is_array($page['faq'])) {
		$questions = array();
		foreach ($page['faq'] as $item) {
			$questions[] = array(
				'@type'          => 'Question',
				'name'           => $item['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item['a'],
				),
			);
		}
		$graph['@graph'][] = array(
			'@type'      => 'FAQPage',
			'mainEntity' => $questions,
		);
	}

	if (is_singular('post')) {
		$graph['@graph'][] = array(
			'@type'         => 'Article',
			'headline'      => get_the_title(),
			'description'   => $description,
			'datePublished' => get_the_date('c'),
			'dateModified'  => get_the_modified_date('c'),
			'author'        => array(
				'@type' => 'Organization',
				'name'  => 'Sovassa Technologies',
			),
			'publisher'     => array('@id' => home_url('/#organization')),
			'mainEntityOfPage' => $url,
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
remove_action('wp_head', 'rel_canonical');
add_action('wp_head', 'sovassa_seo_head', 5);

/**
 * Organization node.
 *
 * @return array<string, mixed>
 */
function sovassa_organization_schema() {
	$config = sovassa_config();
	return array(
		'@type' => 'Organization',
		'@id'   => home_url('/#organization'),
		'name'      => $config['name'],
		'url'       => home_url('/'),
		'logo'      => get_template_directory_uri() . '/assets/images/logo.png',
		'email'     => $config['email'],
		'telephone' => $config['phone'],
		'sameAs'    => sovassa_same_as_urls(),
		'address'   => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Zirakpur',
			'addressCountry'  => 'IN',
		),
		'description' => 'Sovassa Technologies is a technology and digital marketing company. We build products, market them, and help companies grow.',
	);
}

/**
 * Breadcrumb structured data for the current page.
 *
 * @return array<string, mixed>|null
 */
function sovassa_breadcrumb_schema() {
	$items = sovassa_breadcrumb_items();
	if (count($items) < 2) {
		return null;
	}
	$list = array();
	foreach ($items as $index => $item) {
		$entry = array(
			'@type'    => 'ListItem',
			'position' => $index + 1,
			'name'     => $item['label'],
		);
		if (!empty($item['url'])) {
			$entry['item'] = $item['url'];
		}
		$list[] = $entry;
	}
	return array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $list,
	);
}

/**
 * Visible breadcrumb items.
 *
 * @return array<int, array<string, string>>
 */
function sovassa_breadcrumb_items() {
	$items = array(
		array(
			'label' => 'Home',
			'url'   => home_url('/'),
		),
	);

	if (is_singular('post')) {
		$items[] = array(
			'label' => 'Insights',
			'url'   => home_url('/insights/'),
		);
		$items[] = array(
			'label' => get_the_title(),
			'url'   => get_permalink(),
		);
		return $items;
	}

	$page = sovassa_current_page();
	if (!$page || is_front_page()) {
		return array();
	}

	if (!empty($page['crumb_parent']['slug'])) {
		$parent = sovassa_page($page['crumb_parent']['slug']);
		$items[] = array(
			'label' => $page['crumb_parent']['label'],
			'url'   => home_url(sovassa_path($page['crumb_parent']['slug'])),
		);
		unset($parent);
	}

	$items[] = array(
		'label' => isset($page['wp_title']) ? $page['wp_title'] : $page['title'],
		'url'   => sovassa_current_url(),
	);
	return $items;
}

/**
 * Whether this view should stay out of the index.
 *
 * Thank-you stays noindex. Author archives and categories with no published
 * posts are the same. Populated categories and singular pages are unchanged.
 *
 * @return bool
 */
function sovassa_is_noindex_view() {
	if (is_page('thank-you') || is_author()) {
		return true;
	}
	if (!is_category()) {
		return false;
	}
	$term = get_queried_object();
	return $term instanceof WP_Term && (int) $term->count < 1;
}

/**
 * Public URL with the site's trailing-slash permalink style.
 *
 * Query strings stay on the URL. The path is the part that receives the slash.
 *
 * @param string $url Absolute URL.
 * @return string
 */
function sovassa_public_url($url) {
	if (!is_string($url) || '' === $url) {
		return home_url('/');
	}
	$parts = wp_parse_url($url);
	if (!is_array($parts)) {
		return user_trailingslashit($url);
	}
	$path    = isset($parts['path']) ? $parts['path'] : '/';
	$slashed = user_trailingslashit(home_url($path));
	if (!empty($parts['query'])) {
		$slashed .= '?' . $parts['query'];
	}
	return $slashed;
}

/**
 * Canonical for the current page of an archive.
 *
 * Page 1 uses the archive root. Later pages use WordPress pagination links.
 *
 * @param string $first_page URL of page 1.
 * @return string
 */
function sovassa_paged_public_url($first_page) {
	$paged = max(1, (int) get_query_var('paged'));
	if ($paged > 1) {
		return sovassa_public_url((string) get_pagenum_link($paged));
	}
	return sovassa_public_url($first_page);
}

/**
 * Current canonical URL.
 *
 * Singular pages keep get_permalink(), so service pages and parameterized
 * contact/thank-you URLs still canonicalize to the clean permalink.
 *
 * @return string
 */
function sovassa_current_url() {
	if (is_singular()) {
		return (string) get_permalink();
	}
	if (is_front_page()) {
		$front_page = max((int) get_query_var('paged'), (int) get_query_var('page'));
		if ($front_page < 2) {
			return home_url('/');
		}
	}
	if (is_home()) {
		$posts_page = (int) get_option('page_for_posts');
		$link       = $posts_page ? get_permalink($posts_page) : get_post_type_archive_link('post');
		if (is_string($link) && '' !== $link) {
			return sovassa_paged_public_url($link);
		}
	}
	if (is_category() || is_tag() || is_tax()) {
		$term = get_queried_object();
		$link = ($term instanceof WP_Term) ? get_term_link($term) : '';
		if (is_string($link) && '' !== $link) {
			return sovassa_paged_public_url($link);
		}
	}
	if (is_author()) {
		$author = get_queried_object();
		if ($author instanceof WP_User) {
			return sovassa_paged_public_url(get_author_posts_url((int) $author->ID));
		}
	}
	if (is_search()) {
		$paged = max(1, (int) get_query_var('paged'));
		if ($paged > 1) {
			return sovassa_public_url((string) get_pagenum_link($paged));
		}
		return sovassa_public_url(get_search_link());
	}
	global $wp;
	$request = isset($wp->request) ? (string) $wp->request : '';
	if ('' === $request) {
		return home_url('/');
	}
	return sovassa_public_url(home_url('/' . $request));
}

/**
 * Event name for a completed form, so Analytics can mark it as a key event.
 *
 * page_view still fires for every page, including the confirmation page.
 * These names are separate, so only a real submission can be a key event.
 *
 * @param string $sent Value of the thank-you `sent` query argument.
 * @return string
 */
function sovassa_analytics_event_name($sent) {
	$events = array(
		'contact'     => 'thank_you',
		'quote'       => 'thank_you',
		'application' => 'career_application',
		'newsletter'  => 'sign_up',
	);
	return isset($events[$sent]) ? $events[$sent] : '';
}

/**
 * Load analytics only after the visitor accepts, and only when a measurement ID is set.
 */
function sovassa_analytics_script() {
	$id = sovassa_config()['analytics_id'];
	if (!is_string($id) || !preg_match('/^G-[A-Z0-9]+$/', $id)) {
		return;
	}
	$id = esc_js($id);

	$event_js = '';
	if (is_page('thank-you')) {
		$sent = isset($_GET['sent']) ? sanitize_key(wp_unslash($_GET['sent'])) : '';
		$name = sovassa_analytics_event_name($sent);
		if ('' !== $name) {
			$name     = esc_js($name);
			$type     = esc_js($sent);
			$event_js = "try {
			var seen = 'sovassa_event:' + location.pathname + location.search;
			if (!sessionStorage.getItem(seen)) {
				sessionStorage.setItem(seen, '1');
				gtag('event', '" . $name . "', { form_type: '" . $type . "', method: 'website_form' });
			}
		} catch (ignore) {
			gtag('event', '" . $name . "', { form_type: '" . $type . "', method: 'website_form' });
		}";
		}
	}

	echo "<script>
	window.sovassaLoadAnalytics = function () {
		if (document.getElementById('sovassa-ga')) return;
		var script = document.createElement('script');
		script.id = 'sovassa-ga';
		script.async = true;
		script.src = 'https://www.googletagmanager.com/gtag/js?id=" . $id . "';
		document.head.appendChild(script);
		window.dataLayer = window.dataLayer || [];
		function gtag(){window.dataLayer.push(arguments);}
		window.gtag = gtag;
		gtag('js', new Date());
		gtag('config', '" . $id . "', { anonymize_ip: true });
		" . $event_js . "
	};
	if (document.cookie.indexOf('sovassa_cookie=all') !== -1) window.sovassaLoadAnalytics();
	document.addEventListener('sovassa-consent', window.sovassaLoadAnalytics);
	</script>\n";
}
add_action('wp_footer', 'sovassa_analytics_script', 20);

/**
 * Public profile URLs for Organization schema.
 *
 * @return array<int, string>
 */
function sovassa_same_as_urls() {
	$urls = array();
	$social = isset(sovassa_config()['social']) ? sovassa_config()['social'] : array();
	if (!is_array($social)) {
		return $urls;
	}
	foreach ($social as $url) {
		if (is_string($url) && '' !== $url) {
			$urls[] = $url;
		}
	}
	return array_values($urls);
}

/**
 * Old Elementor addresses that should not stay in the index.
 *
 * @return array<string, string>
 */
function sovassa_legacy_redirect_map() {
	return array(
		'services-2'                         => '/services/',
		'about-us'                           => '/about/',
		'contact-2'                          => '/contact/',
		'blog-2'                             => '/insights/',
		'portfolio'                          => '/work/',
		'testimonials'                       => '/work/',
		'partners'                           => '/about/',
		'team'                               => '/about/',
		'resources'                          => '/insights/',
		'ai-search'                          => '/seo/',
		'customer-cabinet'                   => '/contact/',
		'customer-cabinet-2'                 => '/contact/',
		'sitemap'                            => '/',
		'cookie-policy'                      => '/cookies/',
		'terms-conditions'                   => '/terms/',
		'hello-world'                        => '/insights/',
		'hello-world-1'                      => '/insights/',
		'hello-world-2'                      => '/insights/',
		'hello-world-3'                      => '/insights/',
		'test-digital-growth-insights'       => '/insights/',
		'insights/hello-world'               => '/insights/',
		'insights/hello-world-1'             => '/insights/',
		'insights/hello-world-2'             => '/insights/',
		'insights/hello-world-3'             => '/insights/',
		'insights/test-digital-growth-insights' => '/insights/',
		'services/web-development'           => '/web-development/',
		'services/ai-automation'             => '/ai-automation/',
		'privacy-policy'                     => '/privacy/',
		'request-quote'                      => '/get-a-quote/',
		'website-conversion-optimisation-2'  => '/website-conversion-optimisation/',
	);
}

/**
 * Destination for a legacy path, when one exists.
 *
 * @param string $path Request path without slashes.
 * @return string
 */
function sovassa_legacy_redirect_target($path) {
	$map = sovassa_legacy_redirect_map();
	if (isset($map[$path])) {
		return $map[$path];
	}
	if (str_starts_with($path, 'solutions/') && !sovassa_page($path)) {
		return '/solutions/';
	}
	return '';
}

/**
 * Send leftover Elementor URLs to the page that replaced them.
 */
function sovassa_legacy_redirects() {
	if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
		return;
	}
	$request = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '';
	$path    = trim((string) wp_parse_url($request, PHP_URL_PATH), '/');
	if ('' === $path) {
		return;
	}
	$target = sovassa_legacy_redirect_target($path);
	if ('' === $target) {
		return;
	}
	wp_safe_redirect(home_url($target), 301);
	exit;
}
add_action('template_redirect', 'sovassa_legacy_redirects', 0);

/**
 * /page/2/ and later are not pages of the static homepage.
 *
 * Insights keeps /insights/page/2/ because that request is not the front page.
 */
function sovassa_invalid_front_pagination() {
	if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
		return;
	}
	if ('page' !== get_option('show_on_front')) {
		return;
	}
	$front_id = (int) get_option('page_on_front');
	if ($front_id < 1 || !is_page($front_id)) {
		return;
	}
	$page = max((int) get_query_var('paged'), (int) get_query_var('page'));
	if ($page < 2) {
		return;
	}
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	nocache_headers();
	remove_action('template_redirect', 'redirect_canonical');
}
add_action('template_redirect', 'sovassa_invalid_front_pagination', 1);

/**
 * Keep confirmation, duplicate, and author URLs out of the sitemap.
 *
 * @param array<string, mixed> $args      Query args.
 * @param string               $post_type Post type.
 * @return array<string, mixed>
 */
function sovassa_sitemap_posts_query_args($args, $post_type) {
	$exclude = array();
	if ('page' === $post_type) {
		$thank_you = get_page_by_path('thank-you');
		if ($thank_you instanceof WP_Post) {
			$exclude[] = (int) $thank_you->ID;
		}
	}
	if ('post' === $post_type) {
		$duplicate = get_page_by_path('website-conversion-optimisation-2', OBJECT, 'post');
		if ($duplicate instanceof WP_Post) {
			$exclude[] = (int) $duplicate->ID;
		}
	}
	if ($exclude) {
		$args['post__not_in'] = isset($args['post__not_in']) ? array_map('intval', (array) $args['post__not_in']) : array();
		$args['post__not_in'] = array_merge($args['post__not_in'], $exclude);
	}
	return $args;
}
add_filter('wp_sitemaps_posts_query_args', 'sovassa_sitemap_posts_query_args', 10, 2);

/**
 * Author archives are not landing pages.
 *
 * @param WP_Sitemaps_Provider|false $provider Provider instance.
 * @param string                     $name     Provider name.
 * @return WP_Sitemaps_Provider|false
 */
function sovassa_sitemap_skip_users($provider, $name) {
	if ('users' === $name) {
		return false;
	}
	return $provider;
}
add_filter('wp_sitemaps_add_provider', 'sovassa_sitemap_skip_users', 10, 2);

/**
 * Empty categories stay out of the sitemap. Populated categories stay in.
 *
 * @param array<string, mixed> $args     Term query args.
 * @param string               $taxonomy Taxonomy name.
 * @return array<string, mixed>
 */
function sovassa_sitemap_taxonomies_query_args($args, $taxonomy) {
	if ('category' === $taxonomy) {
		$args['hide_empty'] = true;
	}
	return $args;
}
add_filter('wp_sitemaps_taxonomies_query_args', 'sovassa_sitemap_taxonomies_query_args', 10, 2);
