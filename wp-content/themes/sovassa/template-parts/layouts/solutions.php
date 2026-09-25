<?php
/**
 * Solutions hub.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container card-grid card-grid--2">
		<?php foreach ($page['items'] as $item) : ?>
			<article class="plain-card" id="<?php echo esc_attr(sanitize_title($item['title'])); ?>">
				<p class="link-card__kicker">Problem</p>
				<h3><?php echo esc_html($item['title']); ?></h3>
				<p><?php echo esc_html($item['problem']); ?></p>
				<p><strong>How Sovassa approaches it.</strong> <?php echo esc_html($item['solution']); ?></p>
				<div class="chips">
					<?php foreach ($item['services'] as $service) : ?>
						<span class="chip"><?php echo esc_html($service); ?></span>
					<?php endforeach; ?>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
<section class="section section--tint">
	<div class="container container--narrow">
		<?php sovassa_section_head('One engagement', 'Services stay visible inside the package.', $page['combine']); ?>
		<?php sovassa_default_actions('Review services', 'services'); ?>
	</div>
</section>
