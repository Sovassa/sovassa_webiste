<?php
/**
 * Process: four stage cards beside a photo for the selected stage.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section = $args['page']['process'];
?>
<section class="hp-band hp-band--mist" id="process" aria-labelledby="hp-process-title">
	<div class="hp-wrap">
		<?php sovassa_home_head($section['eyebrow'], $section['title'], '', 'hp-process-title'); ?>
		<div class="hp-process hp-rise" data-process>
			<ol class="hp-steps">
				<?php foreach ($section['steps'] as $i => $step) : ?>
					<li class="hp-step<?php echo 0 === $i ? ' is-on' : ''; ?>" data-step="<?php echo (int) $i; ?>">
						<span class="hp-step__no" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
						<h3><?php echo esc_html($step['title']); ?></h3>
						<p><?php echo esc_html($step['text']); ?></p>
						<span class="hp-step__get"><?php echo esc_html($step['get']); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
			<div class="hp-process__film" data-label="<?php echo esc_attr($section['steps'][0]['title']); ?>">
				<?php foreach ($section['steps'] as $i => $step) : ?>
					<img class="hp-slide<?php echo 0 === $i ? ' is-on' : ''; ?>" src="<?php echo esc_url(sovassa_home_image($step['image'])); ?>" alt="<?php echo esc_attr($step['alt']); ?>" width="960" height="717" loading="lazy">
				<?php endforeach; ?>
				<span class="hp-dots" aria-hidden="true"><?php foreach ($section['steps'] as $i => $step) : ?><i<?php echo 0 === $i ? ' class="is-on"' : ''; ?>></i><?php endforeach; ?></span>
			</div>
		</div>
	</div>
</section>
