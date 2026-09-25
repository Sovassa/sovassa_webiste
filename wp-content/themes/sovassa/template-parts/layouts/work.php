<?php
/**
 * Work index. Cards are illustrative, not client results.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page    = $args['page'];
$filters = array('All' => 'all');
foreach ($page['items'] as $item) {
	$filters[$item['service']]    = $item['service'];
	$filters[$item['industry']]   = $item['industry'];
	$filters[$item['technology']] = $item['technology'];
}
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container">
		<div class="filters" data-filter-group>
			<?php foreach ($filters as $label => $value) : ?>
				<button type="button" data-filter="<?php echo esc_attr($value); ?>" class="<?php echo 'all' === $value ? 'is-active' : ''; ?>"><?php echo esc_html($label); ?></button>
			<?php endforeach; ?>
		</div>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['items'] as $item) : ?>
				<article class="plain-card" data-tags="<?php echo esc_attr($item['service'] . '|' . $item['industry'] . '|' . $item['technology']); ?>">
					<p class="link-card__kicker">Illustrative engagement</p>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><strong>Challenge.</strong> <?php echo esc_html($item['challenge']); ?></p>
					<p><strong>Solution.</strong> <?php echo esc_html($item['solution']); ?></p>
					<p><strong>Result.</strong> <?php echo esc_html($item['result']); ?></p>
					<div class="chips">
						<span class="chip"><?php echo esc_html($item['service']); ?></span>
						<span class="chip"><?php echo esc_html($item['industry']); ?></span>
						<span class="chip"><?php echo esc_html($item['technology']); ?></span>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="note">No client names, logos, or performance numbers are shown here. Those will be added only from completed work.</p>
	</div>
</section>
