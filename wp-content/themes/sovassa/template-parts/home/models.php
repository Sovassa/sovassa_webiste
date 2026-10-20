<?php
/**
 * Engagement models.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section = $args['page']['models'];
?>
<section class="hp-band hp-band--mist" aria-labelledby="hp-models-title">
	<div class="hp-wrap">
		<?php sovassa_home_head($section['eyebrow'], $section['title'], $section['lede'], 'hp-models-title'); ?>
		<div class="hp-models hp-rise">
			<?php foreach ($section['items'] as $item) : ?>
				<article class="hp-model<?php echo $item['featured'] ? ' is-featured' : ''; ?>">
					<?php if ($item['featured']) : ?><span class="hp-model__flag">Most chosen</span><?php endif; ?>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p class="hp-model__for"><?php echo esc_html($item['for']); ?></p>
					<ul>
						<?php foreach ($item['points'] as $point) : ?>
							<li><?php echo esc_html($point); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="hp-btn <?php echo $item['featured'] ? 'hp-btn--blue' : 'hp-btn--line'; ?>" href="#contact"><?php echo esc_html($item['cta']); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
