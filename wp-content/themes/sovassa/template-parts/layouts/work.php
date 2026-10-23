<?php
/**
 * Work / Case Studies index page.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page    = $args['page'];
$filters = array('All' => 'all');
foreach ($page['items'] as $item) {
	if (!empty($item['service'])) {
		$filters[$item['service']] = $item['service'];
	}
	if (!empty($item['industry'])) {
		$filters[$item['industry']] = $item['industry'];
	}
}

sovassa_page_hero($page, 'work', 'A brief becoming a product interface connected to a marketing path.');

$flagships = array();
$general   = array();

foreach ($page['items'] as $item) {
	if (!empty($item['image'])) {
		$flagships[] = $item;
	} else {
		$general[] = $item;
	}
}
?>

<section class="section">
	<div class="container">
		<!-- Filter Pills -->
		<div class="filters" data-filter-group aria-label="Filter case studies">
			<?php foreach ($filters as $label => $value) : ?>
				<button type="button" data-filter="<?php echo esc_attr($value); ?>" class="<?php echo 'all' === $value ? 'is-active' : ''; ?>"><?php echo esc_html($label); ?></button>
			<?php endforeach; ?>
		</div>

		<!-- Flagship Platform Showcases -->
		<div class="showcases-list">
			<?php foreach ($flagships as $item) : 
				$tags = esc_attr($item['service'] . '|' . $item['industry'] . '|' . $item['technology']);
				$id_attr = !empty($item['id']) ? ' id="' . esc_attr($item['id']) . '"' : '';
			?>
				<article class="showcase-lead" data-tags="<?php echo $tags; ?>"<?php echo $id_attr; ?>>
					<div class="showcase-lead__content">
						<span class="showcase-lead__tag"><?php echo esc_html($item['industry'] . ' · ' . $item['service']); ?></span>
						<h2 class="showcase-lead__title"><?php echo esc_html($item['title']); ?></h2>
						
						<div class="showcase-narrative">
							<p><strong>Challenge.</strong> <?php echo esc_html($item['challenge']); ?></p>
							<p><strong>Solution.</strong> <?php echo esc_html($item['solution']); ?></p>
							<?php if (!empty($item['result'])) : ?>
								<p><strong>Result.</strong> <?php echo esc_html($item['result']); ?></p>
							<?php endif; ?>
						</div>

						<?php if (!empty($item['metrics'])) : ?>
							<div class="showcase-metrics">
								<?php foreach ($item['metrics'] as $metric) : ?>
									<div class="showcase-metric">
										<b class="showcase-metric__num"><?php echo esc_html($metric[0]); ?></b>
										<span class="showcase-metric__label"><?php echo esc_html($metric[1]); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<div class="showcase-lead__footer">
							<div class="chips">
								<span class="chip"><?php echo esc_html($item['service']); ?></span>
								<span class="chip"><?php echo esc_html($item['industry']); ?></span>
								<span class="chip"><?php echo esc_html($item['technology']); ?></span>
							</div>
							<a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>" class="btn btn--secondary btn--small">
								<span>Discuss This Project Type</span>
								<?php sovassa_icon('arrow'); ?>
							</a>
						</div>
					</div>

					<div class="showcase-lead__shot">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" width="1280" height="720" loading="lazy">
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<!-- Additional Engagement Scopes -->
		<?php if (!empty($general)) : ?>
			<div class="section-head" style="margin-top: 56px; margin-bottom: 28px;">
				<p class="eyebrow"><span class="eyebrow__line" aria-hidden="true"></span>Additional Scopes</p>
				<h2>More Client Delivery Patterns</h2>
				<p class="lede">Explore how we structure common technical and growth challenges across industries.</p>
			</div>

			<div class="card-grid card-grid--3">
				<?php foreach ($general as $item) : 
					$tags = esc_attr($item['service'] . '|' . $item['industry'] . '|' . $item['technology']);
				?>
					<article class="plain-card" data-tags="<?php echo $tags; ?>">
						<p class="link-card__kicker"><?php echo esc_html($item['service']); ?></p>
						<h3><?php echo esc_html($item['title']); ?></h3>
						<p><strong>Challenge.</strong> <?php echo esc_html($item['challenge']); ?></p>
						<p><strong>Solution.</strong> <?php echo esc_html($item['solution']); ?></p>
						<?php if (!empty($item['result']) && !str_starts_with($item['result'], 'A measured result will be published')) : ?>
							<p><strong>Result.</strong> <?php echo esc_html($item['result']); ?></p>
						<?php endif; ?>
						<div class="chips" style="margin-top: auto; padding-top: 14px;">
							<span class="chip"><?php echo esc_html($item['service']); ?></span>
							<span class="chip"><?php echo esc_html($item['industry']); ?></span>
							<span class="chip"><?php echo esc_html($item['technology']); ?></span>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- Closing Consultation Reassurance -->
<section class="section section--tint">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('Engagement Models', 'Built around your delivery milestones.', 'Whether launching a greenfield product from scratch or scaling an existing enterprise stack, Sovassa works with full transparency, zero bloat, and weekly demos.'); ?>
			<div style="margin-top: 24px;">
				<a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>" class="btn btn--primary">
					<span>Calculate Project Scope & Timeline</span>
					<?php sovassa_icon('arrow'); ?>
				</a>
			</div>
		</div>
		<?php sovassa_page_still('work', 'A product interface connected to a small set of marketing nodes.'); ?>
	</div>
</section>
