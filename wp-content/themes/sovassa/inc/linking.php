<?php
/**
 * Internal links between insights and the services they support.
 *
 * Every insight answers a question someone asks before buying one of the
 * services. These links carry that reader to the service page, and give each
 * service page the writing that backs it up.
 *
 * @package Sovassa
 */

/**
 * Service slugs each insight supports, primary first.
 *
 * Posts not listed here still get related reading from their category.
 *
 * @return array<string, array<int, string>>
 */
function sovassa_post_services() {
	return array(
		'how-much-does-it-cost-to-build-an-app'             => array('mobile-app-development'),
		'how-long-does-app-development-take'                => array('mobile-app-development'),
		'mvp-vs-full-product'                               => array('mobile-app-development', 'ui-ux-design'),
		'native-vs-cross-platform'                          => array('mobile-app-development'),
		'flutter-vs-react-native'                           => array('mobile-app-development'),
		'signs-your-business-needs-an-app'                  => array('mobile-app-development'),
		'when-you-should-not-build-an-app'                  => array('mobile-app-development', 'web-development'),
		'how-to-validate-an-app-idea'                       => array('mobile-app-development', 'ui-ux-design'),
		'common-app-development-mistakes'                   => array('mobile-app-development'),
		'how-to-choose-an-app-development-company'          => array('mobile-app-development'),
		'how-much-does-a-business-website-cost'             => array('web-development'),
		'website-redesign-checklist'                        => array('web-development', 'ui-ux-design'),
		'how-to-brief-a-website-project'                    => array('web-development'),
		'landing-page-vs-website'                           => array('web-development', 'google-ads'),
		'website-speed-and-conversion'                      => array('web-development'),
		'how-to-build-a-b2b-website'                        => array('web-development', 'digital-marketing'),
		'website-architecture'                              => array('web-development', 'seo'),
		'cms-comparison'                                    => array('web-development'),
		'website-launch-checklist'                          => array('web-development', 'seo'),
		'website-ux-mistakes'                               => array('ui-ux-design', 'web-development'),
		'website-conversion-optimisation'                   => array('ui-ux-design', 'digital-marketing'),
		'why-websites-do-not-generate-leads'                => array('digital-marketing', 'web-development'),
		'a-practical-seo-starting-point'                    => array('seo'),
		'how-long-seo-takes'                                => array('seo'),
		'seo-vs-paid-advertising'                           => array('seo', 'google-ads'),
		'why-traffic-does-not-equal-leads'                  => array('digital-marketing', 'seo'),
		'b2b-lead-generation'                               => array('digital-marketing', 'google-ads'),
		'digital-marketing-funnel'                          => array('digital-marketing'),
		'marketing-metrics-businesses-should-track'         => array('digital-marketing'),
		'how-technology-and-marketing-should-work-together' => array('digital-marketing', 'web-development'),
		'content-marketing-strategy'                        => array('content-marketing'),
		'a-content-system-for-a-company-site'               => array('content-marketing', 'web-development'),
		'linkedin-for-b2b-companies'                        => array('social-media-marketing', 'content-marketing'),
		'where-automation-should-wait'                      => array('ai-automation'),
	);
}

/**
 * Services an insight supports.
 *
 * @param WP_Post|int|null $post Post, defaults to the current one.
 * @return array<int, string>
 */
function sovassa_services_for_post($post = null) {
	$post = get_post($post);
	if (!$post instanceof WP_Post) {
		return array();
	}
	$map = sovassa_post_services();
	return isset($map[$post->post_name]) ? $map[$post->post_name] : array();
}

/**
 * Insight slugs that support a service. Primary matches come first.
 *
 * @param string $service Service slug.
 * @return array<int, string>
 */
function sovassa_post_slugs_for_service($service) {
	$primary   = array();
	$secondary = array();
	foreach (sovassa_post_services() as $slug => $services) {
		$position = array_search($service, $services, true);
		if (0 === $position) {
			$primary[] = $slug;
		} elseif (false !== $position) {
			$secondary[] = $slug;
		}
	}
	return array_merge($primary, $secondary);
}

/**
 * Published insights by slug, kept in the order given.
 *
 * @param array<int, string> $slugs   Post slugs.
 * @param int                $count   Maximum posts.
 * @param array<int, int>    $exclude Post IDs to leave out.
 * @return array<int, WP_Post>
 */
function sovassa_posts_by_slug($slugs, $count, $exclude = array()) {
	if (!$slugs) {
		return array();
	}
	return get_posts(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'post_name__in'       => $slugs,
			'orderby'             => 'post_name__in',
			'posts_per_page'      => $count,
			'post__not_in'        => $exclude,
			'ignore_sticky_posts' => true,
		)
	);
}

/**
 * Three insights to read next: same service first, then same category.
 *
 * @param WP_Post $post Current post.
 * @return array<int, WP_Post>
 */
function sovassa_related_posts($post) {
	$related = array();
	foreach (sovassa_services_for_post($post) as $service) {
		$found   = sovassa_posts_by_slug(
			sovassa_post_slugs_for_service($service),
			3 - count($related),
			array_merge(array($post->ID), wp_list_pluck($related, 'ID'))
		);
		$related = array_merge($related, $found);
		if (count($related) >= 3) {
			return $related;
		}
	}
	$categories = wp_get_post_categories($post->ID);
	if ($categories) {
		$related = array_merge(
			$related,
			get_posts(
				array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'category__in'        => $categories,
					'posts_per_page'      => 3 - count($related),
					'post__not_in'        => array_merge(array($post->ID), wp_list_pluck($related, 'ID')),
					'ignore_sticky_posts' => true,
				)
			)
		);
	}
	return $related;
}

/**
 * Print post cards for a list of posts.
 *
 * @param array<int, WP_Post> $posts Posts.
 */
function sovassa_post_cards($posts) {
	global $post;
	echo '<div class="post-grid">';
	foreach ($posts as $post) {
		setup_postdata($post);
		sovassa_post_card();
	}
	echo '</div>';
	wp_reset_postdata();
}

/**
 * After an insight: the service it supports, then what to read next.
 */
function sovassa_post_next_steps() {
	$post     = get_post();
	$services = sovassa_services_for_post($post);
	$related  = sovassa_related_posts($post);
	if ($services) {
		$service = sovassa_page($services[0]);
		if ($service) {
			?>
			<div class="container container--narrow">
			<aside class="article-service" aria-label="Related service">
				<p class="link-card__kicker">Where Sovassa helps</p>
				<h2><?php echo esc_html($service['nav_label']); ?></h2>
				<p><?php echo esc_html(isset($service['card']) ? $service['card'] : $service['intro']); ?></p>
				<div class="article-service__links">
					<a class="btn btn--primary btn--sm" href="<?php echo esc_url(sovassa_url($services[0])); ?>">See <?php echo esc_html($service['nav_label']); ?> <?php sovassa_icon('arrow'); ?></a>
					<?php foreach (array_slice($services, 1) as $slug) : ?>
						<?php $extra = sovassa_page($slug); ?>
						<?php if ($extra) : ?>
							<a class="text-link" href="<?php echo esc_url(sovassa_url($slug)); ?>"><?php echo esc_html($extra['nav_label']); ?> <?php sovassa_icon('arrow'); ?></a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</aside>
			</div>
			<?php
		}
	}
	if ($related) {
		?>
		<section class="section section--tint">
			<div class="container">
				<?php sovassa_section_head('Keep reading', 'Related insights', ''); ?>
				<?php sovassa_post_cards($related); ?>
			</div>
		</section>
		<?php
	}
}

/**
 * On a service page: the insights that back it up.
 *
 * @param string $service Service slug.
 */
function sovassa_service_insights($service) {
	$posts = sovassa_posts_by_slug(sovassa_post_slugs_for_service($service), 3);
	if (!$posts) {
		return;
	}
	?>
	<section class="section">
		<div class="container">
			<?php sovassa_section_head('Insights', 'Questions buyers ask before this work', 'Plain answers we give in first conversations.'); ?>
			<?php sovassa_post_cards($posts); ?>
			<p><a class="text-link" href="<?php echo esc_url(home_url('/insights/')); ?>">All insights <?php sovassa_icon('arrow'); ?></a></p>
		</div>
	</section>
	<?php
}
