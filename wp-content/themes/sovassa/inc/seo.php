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

	if (is_page('thank-you')) {
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
 * Current canonical URL.
 *
 * @return string
 */
function sovassa_current_url() {
	if (is_singular()) {
		return (string) get_permalink();
	}
	if (is_front_page()) {
		return home_url('/');
	}
	global $wp;
	return home_url(add_query_arg(array(), $wp->request));
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
