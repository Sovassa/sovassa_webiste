<?php
/**
 * Insights index.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page  = $args['page'];
$query = sovassa_insights_query(40);
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container">
		<div class="filters">
			<a class="chip" href="<?php echo esc_url(home_url('/insights/')); ?>">All</a>
			<?php foreach ($page['categories'] as $category) :
				$term = get_term_by('name', $category, 'category');
				if (!$term || is_wp_error($term) || (int) $term->count < 1) {
					continue;
				}
				?>
				<a class="chip" href="<?php echo esc_url(get_category_link($term)); ?>"><?php echo esc_html($category); ?></a>
			<?php endforeach; ?>
		</div>
		<?php if ($query->have_posts()) : ?>
			<?php $query->the_post(); ?>
			<article class="plain-card featured-insight">
				<img class="post-card__image" src="<?php echo esc_url(sovassa_insight_image_uri()); ?>" alt="" width="1280" height="720">
				<p class="link-card__kicker">Featured</p>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p><?php echo esc_html(get_the_excerpt()); ?></p>
				<a class="text-link" href="<?php the_permalink(); ?>">Read insight <?php sovassa_icon('arrow'); ?></a>
			</article>
			<div class="post-grid">
				<?php
				while ($query->have_posts()) :
					$query->the_post();
					sovassa_post_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p>The first articles are on their way.</p>
		<?php endif; ?>
	</div>
</section>
<section class="section section--tint" id="subscribe">
	<div class="container split">
		<div>
			<?php sovassa_section_head('Subscribe', 'Occasional notes, not a drip campaign.', 'Leave an email if you want the next insight. We store it only for that purpose.'); ?>
		</div>
		<form class="form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<?php sovassa_form_notice(); ?>
			<?php sovassa_form_hidden('newsletter'); ?>
			<label>
				<span>Email</span>
				<input type="email" name="email" required autocomplete="email">
			</label>
			<?php sovassa_consent_field(); ?>
			<button class="btn btn--primary" type="submit">Save my email</button>
		</form>
	</div>
</section>
<section class="section">
	<div class="container card-grid card-grid--3">
		<article class="plain-card" id="guides">
			<h3>Guides</h3>
			<p>The articles above are the guides we have published. Longer guides will be added when a topic needs more than a single note.</p>
		</article>
		<article class="plain-card" id="videos">
			<h3>Videos</h3>
			<p>Short explainers will be published here when they are recorded. We will not embed placeholder videos.</p>
		</article>
		<article class="plain-card" id="cost">
			<h3>Cost conversation</h3>
			<p>A public calculator would invent a price. Tell us the product and the timing, and we will reply with a range after we understand the work.</p>
			<p><a class="text-link" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Request a consultation <?php sovassa_icon('arrow'); ?></a></p>
		</article>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Related services', 'The topics these articles sit beside.', ''); ?>
		<div class="chips">
			<a class="chip" href="<?php echo esc_url(home_url('/seo/')); ?>">SEO</a>
			<a class="chip" href="<?php echo esc_url(home_url('/ai-automation/')); ?>">AI &amp; Automation</a>
			<a class="chip" href="<?php echo esc_url(home_url('/web-development/')); ?>">Web development</a>
			<a class="chip" href="<?php echo esc_url(home_url('/content-marketing/')); ?>">Content</a>
		</div>
	</div>
</section>
