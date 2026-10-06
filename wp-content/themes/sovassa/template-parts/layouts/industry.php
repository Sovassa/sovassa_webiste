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
<section class="section section--tint">
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
	<div class="container container--narrow">
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
