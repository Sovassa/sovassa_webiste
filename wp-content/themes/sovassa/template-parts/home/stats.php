<?php
/**
 * Results band: counters and review badges. Hidden until real figures are listed.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$stats  = $args['page']['proof']['stats'];
$badges = $args['page']['proof']['badges'];
if (!$stats && !$badges) {
	return;
}
?>
<section class="hp-band hp-band--dark" aria-labelledby="hp-stats-title">
	<div class="hp-wrap">
		<?php sovassa_home_head('Results so far', 'Small team. Measurable work.', '', 'hp-stats-title'); ?>
		<?php if ($stats) : ?>
			<div class="hp-counters hp-rise">
				<?php foreach ($stats as $stat) : ?>
					<div class="hp-counter"><b><span data-count="<?php echo esc_attr((string) (int) $stat['value']); ?>"><?php echo esc_html($stat['value']); ?></span><em><?php echo esc_html($stat['suffix']); ?></em></b><span><?php echo esc_html($stat['label']); ?></span></div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ($badges) : ?>
			<div class="hp-badges">
				<?php foreach ($badges as $badge) : ?>
					<a class="hp-badge" href="<?php echo esc_url($badge['url']); ?>" target="_blank" rel="noopener noreferrer"><b><?php echo esc_html($badge['name']); ?></b><?php echo esc_html($badge['text']); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
