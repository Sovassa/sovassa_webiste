<?php
/**
 * About layout.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container">
		<?php sovassa_brand_video('process', 'Discover, Strategize, Build, and Grow in order.'); ?>
	</div>
</section>
<section class="section">
	<div class="container split">
		<div>
			<?php sovassa_section_head('Our story', 'Built for a familiar gap.', ''); ?>
			<?php foreach ($page['story'] as $paragraph) : ?>
				<p><?php echo esc_html($paragraph); ?></p>
			<?php endforeach; ?>
		</div>
		<div class="plain-card">
			<h3>Vision</h3>
			<p><?php echo esc_html($page['vision']); ?></p>
			<h3>Mission</h3>
			<p><?php echo esc_html($page['mission']); ?></p>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Build, Market, Grow', 'The idea we repeat, because the work depends on it.', 'Build is the product. Market is how the right people find it. Grow is the operating rhythm after launch.'); ?>
		<div class="card-grid card-grid--3">
			<article class="plain-card"><h3>Build</h3><p>Websites, applications, mobile products, AI workflows, and the design that makes them usable.</p></article>
			<article class="plain-card"><h3>Market</h3><p>SEO, content, social, and paid media aimed at the same offer the product describes.</p></article>
			<article class="plain-card"><h3>Grow</h3><p>Measurement, iteration, and solutions that combine the first two around a business result.</p></article>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Values', 'How we choose when the brief is ambiguous.', ''); ?>
		<div class="card-grid card-grid--2">
			<?php foreach ($page['values'] as $value) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($value['title']); ?></h3>
					<p><?php echo esc_html($value['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Working together', 'What a client should feel in the first month.', ''); ?>
		<div class="card-grid card-grid--2">
			<?php foreach ($page['with_clients'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Capabilities and team', 'What the company can do, and who will be named later.', 'Team photos and names will be added when people are ready to be public. Until then, every engagement still has a named owner.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['capabilities'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Why clients choose Sovassa', 'The practical reasons, not a slogan.', ''); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['why_choose'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Selected work', 'The shape of the work, until named proof exists.', 'These cards are not client results. Named case studies will replace them when a client is comfortable sharing the work.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach (array_slice(sovassa_page('work')['items'], 0, 3) as $item) : ?>
				<article class="plain-card">
					<p class="link-card__kicker"><?php echo esc_html($item['service']); ?></p>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['challenge']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">View all work types <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>
<?php sovassa_faq($page['faq']); ?>
