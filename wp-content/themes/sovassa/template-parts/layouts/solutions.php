<?php
/**
 * Solutions hub.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'solutions', 'A business problem packing into one product, marketing, and growth package.');
?>
<section class="section">
	<div class="container">
		<?php $lead = $page['items'][0]; ?>
		<article class="feature-lead" id="<?php echo esc_attr(sanitize_title($lead['title'])); ?>">
			<p class="link-card__kicker">Problem</p>
			<h2><?php echo esc_html($lead['title']); ?></h2>
			<p><?php echo esc_html($lead['problem']); ?></p>
			<p><strong>How Sovassa approaches it.</strong> <?php echo esc_html($lead['solution']); ?></p>
			<div class="chips">
				<?php foreach ($lead['services'] as $service) : ?>
					<span class="chip"><?php echo esc_html($service); ?></span>
				<?php endforeach; ?>
			</div>
		</article>
		<div class="card-grid card-grid--2">
		<?php foreach (array_slice($page['items'], 1) as $item) : ?>
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
	</div>
</section>
<section class="section section--tint">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('One engagement', 'Services stay visible inside the package.', $page['combine']); ?>
			<?php sovassa_default_actions('Review services', 'services'); ?>
		</div>
		<?php sovassa_page_still('solutions', 'A product interface, marketing channels, and a growth loop joined as one package.'); ?>
	</div>
</section>
