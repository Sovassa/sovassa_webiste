<?php
/**
 * Three featured insights.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section = $args['page']['insights'];
$posts   = sovassa_posts_by_slug($section['slugs'], 3);
if (!$posts) {
	return;
}
?>
<section class="hp-band hp-band--mist" id="insights" aria-labelledby="hp-insights-title">
	<div class="hp-wrap">
		<?php sovassa_home_head($section['eyebrow'], $section['title'], '', 'hp-insights-title'); ?>
		<div class="hp-posts hp-rise">
			<?php foreach ($posts as $post_item) : ?>
				<?php
				$categories = get_the_category($post_item->ID);
				$category   = $categories ? $categories[0]->name : 'Insight';
				$file       = 'insight-' . sanitize_title($category) . '.webp';
				if (!file_exists(get_template_directory() . '/assets/images/' . $file)) {
					$file = 'insight-sovassa.webp';
				}
				$minutes = max(1, (int) round(str_word_count(wp_strip_all_tags($post_item->post_content)) / 220));
				?>
				<a class="hp-post" href="<?php echo esc_url(get_permalink($post_item)); ?>">
					<span class="hp-post__thumb"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $file); ?>" alt="" width="1280" height="720" loading="lazy"><span><?php echo esc_html($category); ?></span></span>
					<span class="hp-post__body">
						<span class="hp-post__meta"><?php echo esc_html($minutes); ?> min read</span>
						<h3><?php echo esc_html(get_the_title($post_item)); ?></h3>
						<span class="hp-post__text"><?php echo esc_html(get_the_excerpt($post_item)); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
		<p class="hp-center"><a class="hp-btn hp-btn--line" href="<?php echo esc_url(home_url('/insights/')); ?>">All insights</a></p>
	</div>
</section>
