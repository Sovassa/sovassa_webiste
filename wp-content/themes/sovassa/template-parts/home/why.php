<?php
/**
 * Why one team: a bento grid.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section = $args['page']['why'];
$lead    = $section['lead'];
?>
<section class="hp-band" aria-labelledby="hp-why-title">
	<div class="hp-wrap">
		<?php sovassa_home_head($section['eyebrow'], $section['title'], '', 'hp-why-title'); ?>
		<div class="hp-bento hp-rise">
			<article class="hp-cell hp-cell--navy">
				<img src="<?php echo esc_url(sovassa_home_image('team')); ?>" alt="" width="1100" height="619" loading="lazy">
				<span class="hp-cell__label"><?php echo esc_html($lead['label']); ?></span>
				<div>
					<h3><?php echo esc_html($lead['title']); ?></h3>
					<p><?php echo esc_html($lead['text']); ?></p>
				</div>
				<div class="hp-flow">
					<?php foreach ($lead['flow'] as $i => $step) : ?>
						<?php if ($i) : ?><span class="hp-flow__arrow" aria-hidden="true">→</span><?php endif; ?>
						<span><?php echo esc_html($step); ?></span>
					<?php endforeach; ?>
				</div>
			</article>
			<?php foreach ($section['items'] as $item) : ?>
				<article class="hp-cell hp-cell--<?php echo esc_attr($item['style']); ?>">
					<span class="hp-cell__label"><?php echo esc_html($item['label']); ?></span>
					<div>
						<h3><?php echo esc_html($item['title']); ?></h3>
						<?php if ($item['text']) : ?><p><?php echo esc_html($item['text']); ?></p><?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
