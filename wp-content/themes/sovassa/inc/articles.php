<?php
/**
 * Long-form rewrites of the starter insights.
 *
 * Each article body lives in inc/content/articles/<slug>.html. The theme writes
 * it into the post once per version, and only when nobody has edited that post
 * in WordPress since the theme last wrote it. Edited posts are left alone and
 * listed in an admin notice, so a rewrite never replaces someone's own changes.
 *
 * @package Sovassa
 */

/**
 * Articles to apply. Raise 'version' to push a revised body.
 *
 * @return array<string, array<string, mixed>>
 */
function sovassa_articles() {
	return array(
		'how-much-does-it-cost-to-build-an-app' => array(
			'version' => 1,
			'excerpt' => 'What actually sets the cost of an app: scope, user roles, platforms, integrations, and the costs teams forget. Plus how to get an estimate you can trust.',
		),
		'how-much-does-a-business-website-cost' => array(
			'version' => 1,
			'excerpt' => 'What sets the cost of a business website: scope, design, content, CMS, and integrations. Plus the costs outside the build and how to compare quotes.',
		),
		'how-to-choose-an-app-development-company' => array(
			'version' => 1,
			'excerpt' => 'How to choose an app development company: what to look for, questions to ask, warning signs, and the contract terms that protect you.',
		),
		'how-long-does-app-development-take' => array(
			'version' => 1,
			'excerpt' => 'The stages of app development, what makes each take longer, store review rules, and how to shorten the timeline without shipping something fragile.',
		),
		'seo-vs-paid-advertising' => array(
			'version' => 1,
			'excerpt' => 'SEO vs paid advertising compared: speed, cost, control, and long-term value. When each one fits, and why most businesses need both.',
		),
		'how-long-seo-takes' => array(
			'version' => 1,
			'excerpt' => 'How long SEO takes, what happens in what order, what speeds it up or slows it down, and how to tell it is working before traffic grows.',
		),
		'native-vs-cross-platform' => array(
			'version' => 1,
			'excerpt' => 'Native vs cross-platform app development: the real trade-offs in cost, performance, and maintenance, and how to choose for your product.',
		),
		'flutter-vs-react-native' => array(
			'version' => 1,
			'excerpt' => 'Flutter vs React Native compared for business apps: language, interface, talent, ecosystem, and performance, and how to choose for your team.',
		),
		'website-redesign-checklist' => array(
			'version' => 1,
			'excerpt' => 'A website redesign checklist covering goals, URL mapping and redirects, SEO, tracking, launch-day checks, and monitoring after go-live.',
		),
		'why-websites-do-not-generate-leads' => array(
			'version' => 1,
			'excerpt' => 'Why business websites struggle to turn traffic into qualified pipeline, and the structural, psychological, and technical fixes that generate real leads.',
		),
		'landing-page-vs-website' => array(
			'version' => 1,
			'excerpt' => 'Landing pages vs full websites compared: conversion mechanics, paid search efficiency, SEO implications, and how to choose the right destination for your traffic.',
		),
		'website-speed-and-conversion' => array(
			'version' => 1,
			'excerpt' => 'How page speed impacts pipeline, conversion rates, and SEO ranking: Core Web Vitals thresholds, the latency tax on revenue, technical bottlenecks, and how to fix them.',
		),
		'b2b-lead-generation' => array(
			'version' => 1,
			'excerpt' => 'A practical framework for B2B inbound lead generation: defining qualified opportunities, aligning search intent with service pages, eliminating conversion leaks, and marketing-to-sales handoffs.',
		),
		'how-to-build-a-b2b-website' => array(
			'version' => 1,
			'excerpt' => 'The step-by-step blueprint for building a high-converting B2B website: buyer persona navigation, service page architecture, objection handling, tech stack selection, and conversion paths.',
		),
	);
}

/**
 * Write pending article versions into their posts.
 */
function sovassa_apply_articles() {
	$articles = sovassa_articles();
	$applied  = get_option('sovassa_articles_applied', array());
	$applied  = is_array($applied) ? $applied : array();
	$pending  = array();
	foreach ($articles as $slug => $article) {
		if (!isset($applied[$slug]) || (int) $applied[$slug] < (int) $article['version']) {
			$pending[$slug] = $article;
		}
	}
	if (!$pending || get_transient('sovassa_articles_lock')) {
		return;
	}
	set_transient('sovassa_articles_lock', 1, MINUTE_IN_SECONDS);

	$skipped = get_option('sovassa_articles_skipped', array());
	$skipped = is_array($skipped) ? $skipped : array();
	foreach ($pending as $slug => $article) {
		$file = __DIR__ . '/content/articles/' . $slug . '.html';
		$post = get_page_by_path($slug, OBJECT, 'post');
		if (!is_readable($file) || !$post instanceof WP_Post) {
			continue;
		}
		if (!sovassa_article_untouched($post)) {
			$skipped[$slug] = (int) $article['version'];
			$applied[$slug] = (int) $article['version'];
			continue;
		}
		$result = wp_update_post(
			array(
				'ID'           => $post->ID,
				'post_content' => trim((string) file_get_contents($file)),
				'post_excerpt' => $article['excerpt'],
			),
			true
		);
		if (is_wp_error($result)) {
			continue;
		}
		$saved = get_post($post->ID);
		update_post_meta($post->ID, '_sovassa_article_hash', md5($saved->post_content));
		$applied[$slug] = (int) $article['version'];
		unset($skipped[$slug]);
	}
	update_option('sovassa_articles_applied', $applied);
	update_option('sovassa_articles_skipped', $skipped);
	delete_transient('sovassa_articles_lock');
}
add_action('init', 'sovassa_apply_articles', 40);

/**
 * Whether the theme may replace this post's body.
 *
 * True when the theme wrote the current body itself, or when the post has
 * never been edited since it was created.
 *
 * @param WP_Post $post Post.
 * @return bool
 */
function sovassa_article_untouched($post) {
	$hash = get_post_meta($post->ID, '_sovassa_article_hash', true);
	if ($hash) {
		return md5($post->post_content) === $hash;
	}
	return $post->post_modified_gmt === $post->post_date_gmt;
}

/**
 * Tell editors which rewrites were skipped because the post had been edited.
 */
function sovassa_articles_notice() {
	if (!current_user_can('edit_posts')) {
		return;
	}
	$skipped = get_option('sovassa_articles_skipped', array());
	if (!is_array($skipped) || !$skipped) {
		return;
	}
	$links = array();
	foreach (array_keys($skipped) as $slug) {
		$post = get_page_by_path($slug, OBJECT, 'post');
		if ($post instanceof WP_Post) {
			$links[] = '<a href="' . esc_url(get_edit_post_link($post->ID)) . '">' . esc_html(get_the_title($post)) . '</a>';
		}
	}
	if (!$links) {
		return;
	}
	echo '<div class="notice notice-warning"><p>' . esc_html__('These insights were edited in WordPress, so the theme did not replace them with the new long-form version. The new text is in the theme folder under inc/content/articles/:', 'sovassa') . ' ' . wp_kses_post(implode(', ', $links)) . '</p></div>';
}
add_action('admin_notices', 'sovassa_articles_notice');
