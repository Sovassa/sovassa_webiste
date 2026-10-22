<?php
/**
 * Services explorer: a tab per service, each panel rendered server-side.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section = $args['page']['services'];
$icons   = array('web' => 'code', 'app' => 'layers', 'ux' => 'pen', 'ai' => 'spark', 'seo' => 'search', 'ads' => 'megaphone', 'social' => 'users', 'content' => 'chat');
?>
<section class="hp-band hp-band--mist" id="services" aria-labelledby="hp-services-title">
	<div class="hp-wrap">
		<?php sovassa_home_head($section['eyebrow'], $section['title'], $section['lede'], 'hp-services-title'); ?>
		<div class="hp-explorer" data-tabs>
			<div class="hp-tabs" role="tablist" aria-label="Services" aria-orientation="vertical">
				<?php foreach ($section['items'] as $i => $item) : ?>
					<button class="hp-tab" type="button" role="tab" id="hp-svc-tab-<?php echo esc_attr($item['icon']); ?>" aria-controls="hp-svc-<?php echo esc_attr($item['icon']); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"<?php echo 0 === $i ? '' : ' tabindex="-1"'; ?>>
						<span class="hp-tab__ic"><?php sovassa_icon($icons[$item['icon']]); ?></span>
						<span><?php echo esc_html($item['name']); ?><small><?php echo esc_html($item['sub']); ?></small></span>
					</button>
				<?php endforeach; ?>
			</div>
			<?php foreach ($section['items'] as $i => $item) : ?>
				<div class="hp-panel" role="tabpanel" id="hp-svc-<?php echo esc_attr($item['icon']); ?>" aria-labelledby="hp-svc-tab-<?php echo esc_attr($item['icon']); ?>"<?php echo 0 === $i ? '' : ' hidden'; ?>>
					<div class="hp-panel__content">
						<div class="hp-panel__kicker">
							<span class="hp-panel__tag"><?php echo esc_html($item['name']); ?></span>
							<span class="hp-panel__subtag"><?php echo esc_html($item['sub']); ?></span>
						</div>
						<h3><?php echo esc_html($item['title']); ?></h3>
						<p class="hp-panel__text"><?php echo esc_html($item['text']); ?></p>
						
						<div class="hp-panel__breakdown">
							<h4 class="hp-panel__h4">What We Deliver</h4>
							<ul class="hp-ticks">
								<?php foreach ($item['points'] as $point) : ?>
									<li><?php echo esc_html($point); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>

						<div class="hp-panel__tech-block">
							<h4 class="hp-panel__h4">Core Tech Stack</h4>
							<div class="hp-stack">
								<?php foreach ($item['stack'] as $tool) : ?>
									<span><?php echo esc_html($tool); ?></span>
								<?php endforeach; ?>
							</div>
						</div>

						<div class="hp-panel__actions">
							<a class="hp-btn hp-btn--blue" href="<?php echo esc_url(sovassa_url($item['slug'])); ?>">Explore <?php echo esc_html($item['name']); ?> <?php sovassa_icon('arrow'); ?></a>
							<a class="hp-btn hp-btn--ghost" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get an Estimate</a>
						</div>
					</div>
					<div class="hp-panel__media">
						<img src="<?php echo esc_url(sovassa_home_image($item['image'])); ?>" alt="<?php echo esc_attr($item['name']); ?>" width="960" height="717" loading="<?php echo 0 === $i ? 'eager' : 'lazy'; ?>">
						<div class="hp-panel__overlay">
							<span class="hp-panel__badge" aria-hidden="true"><?php sovassa_icon($icons[$item['icon']]); ?></span>
							<span class="hp-panel__live-chip"><span class="hp-live-indicator" aria-hidden="true"></span> Production Ready</span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
