<?php
/**
 * Technology ecosystem.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'technologies', 'Abstract system layers locking into one stack.');
?>
<?php
$tech_names = array();
foreach ($page['groups'] as $group) {
	foreach ($group['items'] as $name) {
		$tech_names[] = $name;
	}
}
?>
<section class="section section--tight">
	<div class="container">
		<?php sovassa_marquee($tech_names, home_url('/technologies/')); ?>
	</div>
</section>
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
<section class="section section--tint">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('The stack', 'Tools we are prepared to use.', 'Listing them is not a partnership claim. The project, the editors, and the team who will own it decide the final choice.'); ?>
		</div>
		<?php sovassa_page_still('technologies', 'Interface tiles, connected blocks, screens, and a cloud joined as one system.'); ?>
	</div>
</section>
