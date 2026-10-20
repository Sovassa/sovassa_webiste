<?php
/**
 * Homepage hero: promise, growth-plan field, and a photo of the work.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page    = $args['page'];
$capture = $page['capture'];
$stats   = $page['proof']['stats'];
$title   = $page['title'];
$mark    = isset($page['title_highlight']) ? $page['title_highlight'] : '';
$lead    = $mark && str_ends_with($title, $mark) ? substr($title, 0, -strlen($mark)) : $title;
?>
<section class="hp-hero" aria-labelledby="hp-hero-title">
	<div class="hp-wrap hp-hero__grid">
		<div class="hp-hero__copy">
			<span class="hp-pill hp-pill--dark"><?php echo esc_html($page['eyebrow']); ?></span>
			<h1 id="hp-hero-title"><?php echo esc_html($lead); ?><?php if ($mark && $lead !== $title) : ?><span class="hp-grad"><?php echo esc_html($mark); ?></span><?php endif; ?></h1>
			<p class="hp-lede"><?php echo esc_html($page['intro']); ?></p>
			<form class="hp-capture" method="get" action="<?php echo esc_url(home_url('/get-a-quote/')); ?>">
				<label class="screen-reader-text" for="hp-capture-input"><?php echo esc_html($capture['placeholder']); ?></label>
				<input id="hp-capture-input" type="text" name="brief" placeholder="<?php echo esc_attr($capture['placeholder']); ?>" autocomplete="url">
				<button class="hp-btn hp-btn--teal" type="submit"><?php echo esc_html($capture['button']); ?></button>
			</form>
			<p class="hp-capture__note"><b>Free</b> · <?php echo esc_html($capture['note']); ?></p>
			<?php if ($stats) : ?>
				<ul class="hp-chips">
					<?php foreach (array_slice($stats, 0, 3) as $stat) : ?>
						<li><b><?php echo esc_html($stat['value'] . $stat['suffix']); ?></b> <?php echo esc_html($stat['label']); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="hp-hero__visual">
			<div class="hp-hero__photo">
				<img src="<?php echo esc_url(sovassa_home_image('hero')); ?>" alt="A business website, its mobile app, and a dashboard of rising leads on one desk" width="1200" height="897" fetchpriority="high">
			</div>
			<?php foreach (array_slice($stats, 0, 2) as $i => $stat) : ?>
				<div class="hp-float hp-float--<?php echo 0 === $i ? 'a' : 'b'; ?>" aria-hidden="true"><small><?php echo esc_html($stat['label']); ?></small><b><?php echo esc_html($stat['value'] . $stat['suffix']); ?></b></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
