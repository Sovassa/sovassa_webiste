<?php
/**
 * Creates pages, starter insights, and the primary menu.
 *
 * @package Sovassa
 */

/**
 * Seed the site once per content version.
 */
function sovassa_maybe_seed() {
	static $running = false;
	if ($running || get_option('sovassa_seeded_version') === SOVASSA_SEED_VERSION) {
		return;
	}
	if (!function_exists('is_blog_installed') || !is_blog_installed()) {
		return;
	}
	$running = true;
	sovassa_seed_site();
	update_option('sovassa_seeded_version', SOVASSA_SEED_VERSION);
	flush_rewrite_rules(false);
}
add_action('after_switch_theme', 'sovassa_maybe_seed');
add_action('init', 'sovassa_maybe_seed', 30);

/**
 * Create pages, posts, and the menu.
 */
function sovassa_seed_site() {
	$ids = array();
	foreach (sovassa_pages() as $slug => $page) {
		$parent_slug = '';
		$post_name   = $slug;
		if (str_contains($slug, '/')) {
			$parent_slug = str_replace('\\', '/', dirname($slug));
			$post_name   = basename($slug);
		}
		$parent_id = ($parent_slug && !empty($ids[$parent_slug])) ? (int) $ids[$parent_slug] : 0;
		$existing  = get_page_by_path($slug);
		if ($existing instanceof WP_Post) {
			$ids[$slug] = (int) $existing->ID;
			$update     = array('ID' => $existing->ID);
			if ('publish' !== $existing->post_status) {
				$update['post_status'] = 'publish';
			}
			if ($parent_id && (int) $existing->post_parent !== $parent_id) {
				$update['post_parent'] = $parent_id;
			}
			if (count($update) > 1) {
				wp_update_post($update);
			}
			continue;
		}
		$created = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_name'    => $post_name,
				'post_parent'  => $parent_id,
				'post_title'   => isset($page['wp_title']) ? $page['wp_title'] : $page['title'],
				'post_status'  => 'publish',
				'post_content' => '',
			),
			true
		);
		if (!is_wp_error($created)) {
			$ids[$slug] = (int) $created;
		}
	}

	if (!empty($ids['home'])) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $ids['home']);
	}
	update_option('permalink_structure', '/%postname%/');
	update_option('default_comment_status', 'closed');
	update_option('default_ping_status', 'closed');

	$sample = get_page_by_path('sample-page');
	if ($sample instanceof WP_Post) {
		wp_delete_post($sample->ID, true);
	}
	$hello = get_page_by_path('hello-world', OBJECT, 'post');
	if ($hello instanceof WP_Post) {
		wp_delete_post($hello->ID, true);
	}

	sovassa_seed_posts();
	sovassa_seed_menu($ids);
	sovassa_retire_legacy_content();
}

/**
 * Draft leftover Elementor pages and remove test insight posts.
 */
function sovassa_retire_legacy_content() {
	$pages = array(
		'services-2',
		'about-us',
		'contact-2',
		'blog-2',
		'portfolio',
		'testimonials',
		'partners',
		'team',
		'resources',
		'ai-search',
		'customer-cabinet',
		'customer-cabinet-2',
		'sitemap',
		'cookie-policy',
		'terms-conditions',
	);
	foreach ($pages as $slug) {
		$page = get_page_by_path($slug);
		if ($page instanceof WP_Post && 'draft' !== $page->post_status) {
			wp_update_post(
				array(
					'ID'          => $page->ID,
					'post_status' => 'draft',
				)
			);
		}
	}

	$solutions = get_page_by_path('solutions');
	if ($solutions instanceof WP_Post) {
		$children = get_pages(
			array(
				'child_of'    => $solutions->ID,
				'post_status' => array('publish', 'private', 'draft'),
			)
		);
		foreach ($children as $child) {
			if (!sovassa_page(get_page_uri($child))) {
				wp_update_post(
					array(
						'ID'          => $child->ID,
						'post_status' => 'draft',
					)
				);
			}
		}
	}

	$posts = array(
		'hello-world',
		'hello-world-1',
		'hello-world-2',
		'hello-world-3',
		'test-digital-growth-insights',
	);
	foreach ($posts as $slug) {
		$post = get_page_by_path($slug, OBJECT, 'post');
		if ($post instanceof WP_Post) {
			wp_delete_post($post->ID, true);
		}
	}
}

/**
 * Starter insight articles. Original launch copy, not client case studies.
 */
function sovassa_seed_posts() {
	$posts = array(
		array(
			'slug'     => 'how-to-brief-a-website-project',
			'title'    => 'How to brief a website project so design and build stay aligned',
			'category' => 'Technology',
			'excerpt'  => 'A useful website brief names the audience, the job of the site, and the decision a visitor should be able to make.',
			'content'  => '<p>A website project goes sideways when the brief is a list of pages and a deadline. The team can still design screens, but nobody has agreed what the site is supposed to change.</p><p>Start with the visitor. Who arrives, what they already know, and what they need to believe before they enquire. Then name the business job: explain a service, qualify a lead, support a launch, or replace a site that the team can no longer edit.</p><p>Collect the constraints in the same conversation. Brand rules, content you already have, systems the form must reach, languages, and the date that is real rather than hopeful. A short sitemap is useful after those points, not before them.</p><p>Sovassa treats that brief as the start of Discover. The pages, the design system, and the build plan should all be able to point back to it.</p>',
		),
		array(
			'slug'     => 'a-practical-seo-starting-point',
			'title'    => 'A practical SEO starting point for a new company site',
			'category' => 'Marketing',
			'excerpt'  => 'Early SEO work is mostly clarity: pages that match real searches, a site search engines can crawl, and a way to see what is changing.',
			'content'  => '<p>A new company does not need a large content factory on day one. It needs a site that can be found for the services it actually sells.</p><p>Begin with the queries a buyer would type: the service, the problem, and sometimes the industry. Each important query deserves a page with a specific promise, not a paragraph buried on the homepage.</p><p>Technical basics still matter. Unique titles, descriptive addresses, a sitemap, fast templates, and internal links between services, industries, and insights. Measurement is part of the same setup, so traffic is not a vanity number detached from enquiries.</p><p>Publishing can follow that foundation. Guides and comparisons earn their place when they answer a question a sales conversation already hears.</p>',
		),
		array(
			'slug'     => 'where-automation-should-wait',
			'title'    => 'Where automation helps a small team, and where it should wait',
			'category' => 'Technology',
			'excerpt'  => 'Automation is useful when a repeated handoff is already understood. It creates confusion when the process itself is still unstable.',
			'content'  => '<p>Teams often ask for an AI tool when the real issue is a messy handoff. Leads sit in inboxes. Reports are rebuilt by hand. The same questions are answered from scratch every week.</p><p>Those are good automation candidates once the steps are visible. Map who receives the work, what “done” means, and which system should hold the record. Then automate the step that is repeated and low judgement.</p><p>Wait when the offer, the audience, or the approval path is still changing every week. An automated workflow will freeze that confusion and make it harder to see.</p><p>Sovassa treats applied AI the same way: a product or workflow with a job, a data boundary, and a person who can tell whether the output is acceptable.</p>',
		),
		array(
			'slug'     => 'a-content-system-for-a-company-site',
			'title'    => 'A content system for a company that also sells through its website',
			'category' => 'Marketing',
			'excerpt'  => 'Content works harder when each piece has a page to support, a person to help, and a next step that matches the sales conversation.',
			'content'  => '<p>Company content drifts when it is planned as a calendar instead of a system. Posts go out, the website stays vague, and sales still writes the same explanation in every proposal.</p><p>Tie topics to the service pages you need people to understand. A piece of writing should make one of those pages clearer, answer a buying objection, or give the team something useful to send.</p><p>Repurposing is then straightforward. The same point can become a page section, a short social post, and a follow-up in a proposal. Measurement looks at assisted enquiries and sales usefulness, not only likes.</p><p>That is the content practice Sovassa sets up inside a broader marketing engagement: fewer orphaned assets, and a site that keeps getting easier to trust.</p>',
		),
	);

	$posts = array_merge($posts, sovassa_pillar_posts());

	foreach (array('Technology', 'Product', 'Business', 'Marketing', 'Founder', 'Proof', 'Sovassa') as $category_name) {
		if (!term_exists($category_name, 'category')) {
			wp_insert_term($category_name, 'category');
		}
	}

	foreach ($posts as $post) {
		$existing = get_page_by_path($post['slug'], OBJECT, 'post');
		$term     = term_exists($post['category'], 'category');
		if (!$term) {
			$term = wp_insert_term($post['category'], 'category');
		}
		$term_id = (is_array($term) && isset($term['term_id'])) ? (int) $term['term_id'] : 0;
		if ($existing instanceof WP_Post) {
			if ($term_id) {
				wp_set_post_categories((int) $existing->ID, array($term_id));
			}
			continue;
		}
		$post_id = wp_insert_post(
			array(
				'post_type'     => 'post',
				'post_name'     => $post['slug'],
				'post_title'    => $post['title'],
				'post_excerpt'  => $post['excerpt'],
				'post_content'  => $post['content'],
				'post_status'   => 'publish',
				'comment_status'=> 'closed',
				'ping_status'   => 'closed',
			),
			true
		);
		if (!is_wp_error($post_id) && $term_id) {
			wp_set_post_categories((int) $post_id, array($term_id));
		}
	}
}

/**
 * Create a primary menu that mirrors the public pages.
 *
 * @param array<string, int> $ids Page IDs keyed by slug.
 */
function sovassa_seed_menu($ids) {
	$menu_name = 'Primary';
	$menu      = wp_get_nav_menu_object($menu_name);
	$menu_id   = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu($menu_name);
	if ($menu_id <= 0) {
		return;
	}

	$linked = array();
	$items  = wp_get_nav_menu_items($menu_id);
	if (is_array($items)) {
		foreach ($items as $item) {
			if ('page' === $item->object) {
				$linked[] = (int) $item->object_id;
			}
		}
	}

	$position = count($linked);
	foreach (sovassa_menu_slugs() as $slug) {
		if (empty($ids[$slug]) || in_array($ids[$slug], $linked, true)) {
			continue;
		}
		$page = sovassa_page($slug);
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => isset($page['nav_label']) ? $page['nav_label'] : $page['wp_title'],
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $ids[$slug],
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => ++$position,
			)
		);
	}

	$locations            = get_theme_mod('nav_menu_locations');
	$locations            = is_array($locations) ? $locations : array();
	$locations['primary'] = $menu_id;
	$locations['footer']  = $menu_id;
	set_theme_mod('nav_menu_locations', $locations);
}
