<?php
/**
 * Industry tiles with photos, linking to each industry page.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section = $args['page']['industries'];
$market  = sovassa_page('industries');
$items   = ($market && !empty($market['items'])) ? $market['items'] : array();
?>
<section class="hp-band" id="industries" aria-labelledby="hp-industries-title">
	<div class="hp-wrap">
		<?php sovassa_home_head($section['eyebrow'], $section['title'], $section['lede'], 'hp-industries-title'); ?>
		<div class="hp-industries hp-rise">
			<?php foreach ($items as $item) : ?>
				<?php $image = isset($section['images'][$item['slug']]) ? $section['images'][$item['slug']] : 'team'; ?>
				<a class="hp-ind" href="<?php echo esc_url(sovassa_url($item['slug'])); ?>">
					<img src="<?php echo esc_url(sovassa_home_image($image)); ?>" alt="" width="720" height="538" loading="lazy">
					<span class="hp-ind__arrow" aria-hidden="true"><?php sovassa_icon('arrow'); ?></span>
					<span class="hp-ind__label"><b><?php echo esc_html($item['title']); ?></b></span>
				</a>
			<?php endforeach; ?>
			<a class="hp-ind hp-ind--cta" href="<?php echo esc_url(home_url('/contact/')); ?>">
				<img src="<?php echo esc_url(sovassa_home_image('team')); ?>" alt="" width="1100" height="619" loading="lazy">
				<span class="hp-ind__arrow" aria-hidden="true"><?php sovassa_icon('arrow'); ?></span>
				<span class="hp-ind__label"><b>Your industry</b><small>Talk to us</small></span>
			</a>
		</div>
	</div>
</section>
