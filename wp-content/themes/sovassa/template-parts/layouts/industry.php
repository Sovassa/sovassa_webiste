<?php
/**
 * Industry detail page.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'industries', 'A product interface surrounded by market clusters for commerce, care, learning, and finance.');
?>
<section class="section">
	<div class="container split">
		<div>
			<?php sovassa_section_head('The problem', 'What usually gets in the way.', ''); ?>
			<p><?php echo esc_html($page['challenge']); ?></p>
		</div>
		<div>
			<?php sovassa_section_head('How we help', 'The work this market usually needs.', ''); ?>
			<p><?php echo esc_html($page['support']); ?></p>
		</div>
	</div>
</section>
<?php
$featured_case = null;
if (!empty($page['featured_case_id'])) {
	$work_page = sovassa_page('work');
	if ($work_page && !empty($work_page['items'])) {
		foreach ($work_page['items'] as $item) {
			if (isset($item['id']) && $item['id'] === $page['featured_case_id']) {
				$featured_case = $item;
				break;
			}
		}
	}
}
?>

<?php if ($featured_case) : ?>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Flagship Architecture', 'Engineered platform showcase for this industry.', 'A real-world breakdown of architectural challenges, technical solutions, and verified impact metrics.'); ?>
		<article class="showcase-lead" id="<?php echo esc_attr($featured_case['id']); ?>">
			<div class="showcase-lead__content">
				<span class="showcase-lead__tag"><?php echo esc_html($featured_case['industry'] . ' · ' . $featured_case['service']); ?></span>
				<h2 class="showcase-lead__title"><?php echo esc_html($featured_case['title']); ?></h2>
				
				<div class="showcase-narrative">
					<p><strong>Challenge.</strong> <?php echo esc_html($featured_case['challenge']); ?></p>
					<p><strong>Solution.</strong> <?php echo esc_html($featured_case['solution']); ?></p>
					<?php if (!empty($featured_case['result'])) : ?>
						<p><strong>Result.</strong> <?php echo esc_html($featured_case['result']); ?></p>
					<?php endif; ?>
				</div>

				<?php if (!empty($featured_case['metrics'])) : ?>
					<div class="showcase-metrics">
						<?php foreach ($featured_case['metrics'] as $metric) : ?>
							<div class="showcase-metric">
								<span class="showcase-metric__num"><?php echo esc_html($metric[0]); ?></span>
								<span class="showcase-metric__label"><?php echo esc_html($metric[1]); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="showcase-lead__footer">
					<span class="chip"><?php echo esc_html($featured_case['technology']); ?></span>
					<div class="btn-group">
						<a class="btn btn--primary btn--sm" href="<?php echo esc_url(home_url('/work/#' . $featured_case['id'])); ?>">View Full Case Study <?php sovassa_icon('arrow'); ?></a>
						<a class="btn btn--ghost btn--sm" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Estimate Similar Scope</a>
					</div>
				</div>
			</div>
			<div class="showcase-lead__shot">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $featured_case['image'] . '?ver=' . SOVASSA_VERSION); ?>"
					alt="<?php echo esc_attr($featured_case['title']); ?>"
					loading="lazy" width="800" height="500">
			</div>
		</article>
	</div>
</section>
<?php endif; ?>

<section class="section">
	<div class="container">
		<?php sovassa_section_head('In practice', 'What a useful engagement includes.', 'Named client results are not shown here. These are the pieces of work, not a case study.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['points'] as $point) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($point['title']); ?></h3>
					<p><?php echo esc_html($point['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php if (!empty($page['bridge']) && !empty($page['services'][0])) : ?>
	<?php $lead = sovassa_page($page['services'][0]); ?>
	<?php if ($lead) : ?>
<section class="section section--tight">
	<div class="container container--start">
		<p><?php echo esc_html($page['bridge']); ?> <a href="<?php echo esc_url(sovassa_url($page['services'][0])); ?>"><?php echo esc_html($lead['nav_label']); ?></a>.</p>
	</div>
</section>
	<?php endif; ?>
<?php endif; ?>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Related services', 'The capabilities that usually sit with this market.', 'Each one can be hired on its own. The mix is a recommendation, not a bundle you have to buy.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['services'] as $slug) : ?>
				<?php $service = sovassa_page($slug); ?>
				<?php if (!$service) { continue; } ?>
				<a class="link-card" href="<?php echo esc_url(sovassa_url($slug)); ?>">
					<h3><?php echo esc_html($service['nav_label']); ?></h3>
					<p><?php echo esc_html(isset($service['card']) ? $service['card'] : $service['intro']); ?></p>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php sovassa_faq($page['faq']); ?>
