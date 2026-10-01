<?php
/**
 * Industries hub.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'industries', 'One product interface surrounded by different markets.');
?>
<section class="section">
	<div class="container" data-switcher>
		<div class="switcher__nav" hidden>
			<?php foreach ($page['items'] as $item) : ?>
				<button type="button" data-switch="<?php echo esc_attr(sanitize_title($item['title'])); ?>"><?php echo esc_html($item['title']); ?></button>
			<?php endforeach; ?>
		</div>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['items'] as $item) : ?>
				<article class="plain-card" id="<?php echo esc_attr(sanitize_title($item['title'])); ?>" data-switch-item="<?php echo esc_attr(sanitize_title($item['title'])); ?>">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><strong>Challenge.</strong> <?php echo esc_html($item['challenge']); ?></p>
					<p><strong>How we help.</strong> <?php echo esc_html($item['support']); ?></p>
					<p class="link-card__kicker"><?php echo esc_html($item['combination']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('Proof', 'Industry stories will be specific when the work is.', 'Until a client engagement in one of these markets is ready to share, the work page describes the shape of a project rather than a result.'); ?>
			<a class="btn btn--ghost" href="<?php echo esc_url(home_url('/work/')); ?>">See engagement types</a>
		</div>
		<?php sovassa_page_still('industries', 'A product interface surrounded by market clusters for commerce, care, learning, and finance.'); ?>
	</div>
</section>
<?php sovassa_faq($page['faq']); ?>
