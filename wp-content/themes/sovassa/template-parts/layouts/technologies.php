<?php
/**
 * Technology ecosystem.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container" data-switcher data-switch-mode="hide">
		<div class="switcher__nav" hidden>
			<?php foreach ($page['groups'] as $group) : ?>
				<button type="button" data-switch="<?php echo esc_attr(sanitize_title($group['title'])); ?>"><?php echo esc_html($group['title']); ?></button>
			<?php endforeach; ?>
		</div>
		<?php foreach ($page['groups'] as $group) : ?>
			<div class="tech-group" data-switch-item="<?php echo esc_attr(sanitize_title($group['title'])); ?>">
				<h2><?php echo esc_html($group['title']); ?></h2>
				<div class="stack">
					<?php foreach ($group['items'] as $item) : ?>
						<span><?php echo esc_html($item); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
