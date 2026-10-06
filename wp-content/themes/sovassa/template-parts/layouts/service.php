<?php
/**
 * Shared service detail layout.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
$slug = get_queried_object() instanceof WP_Post ? get_queried_object()->post_name : '';
$service_videos = array(
	'web-development'    => array('file' => 'web-development', 'label' => 'A page layout appearing in a browser, then in a narrower screen.'),
	'mobile-app-development' => array('file' => 'mobile-apps', 'label' => 'A phone screen, then a second screen.'),
	'digital-marketing'  => array('file' => 'digital-marketing', 'label' => 'A chart line drawing upward, without figures.'),
	'ai-automation'      => array('file' => 'ai-automation', 'label' => 'A repeated handoff becoming a workflow with a human review gate.'),
);
$film = isset($service_videos[$slug]) ? $service_videos[$slug] : null;
sovassa_page_hero($page, $film ? $film['file'] : '', $film ? $film['label'] : '');
?>
<?php if (!empty($page['detail']) || !empty($page['industry'])) : ?>
<section class="section section--tight">
	<div class="container container--narrow">
		<?php if (!empty($page['detail'])) : ?>
			<?php foreach ($page['detail'] as $paragraph) : ?>
				<p><?php echo esc_html($paragraph); ?></p>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (!empty($page['industry'])) : ?>
			<?php $market = sovassa_page($page['industry']); ?>
			<?php if ($market) : ?>
				<p><a class="text-link" href="<?php echo esc_url(sovassa_url($page['industry'])); ?>">How this shows up in <?php echo esc_html($market['nav_label']); ?> <?php sovassa_icon('arrow'); ?></a></p>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('The problem', $page['challenges_intro'], ''); ?>
		<div class="alt-rows">
			<?php foreach ($page['challenges'] as $index => $item) : ?>
				<article class="alt-row<?php echo $index % 2 ? ' alt-row--flip' : ''; ?>">
					<span class="alt-row__index"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
					<div>
						<h3><?php echo esc_html($item['title']); ?></h3>
						<p><?php echo esc_html($item['text']); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('What we deliver', 'The pieces this service is accountable for.', ''); ?>
		<div class="alt-rows">
			<?php foreach ($page['delivers'] as $index => $item) : ?>
				<article class="alt-row<?php echo $index % 2 ? ' alt-row--flip' : ''; ?>">
					<span class="alt-row__index"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
					<div>
						<h3><?php echo esc_html($item['title']); ?></h3>
						<p><?php echo esc_html($item['text']); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php if (!empty($page['offers'])) : ?>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Offers', 'The specific ways this service is scoped.', 'Each one can stand alone or sit inside a larger engagement.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['offers'] as $offer) : ?>
				<?php if (!empty($offer['slug'])) : ?>
					<a class="link-card" href="<?php echo esc_url(sovassa_url($offer['slug'])); ?>">
						<h3><?php echo esc_html($offer['title']); ?></h3>
						<p><?php echo esc_html($offer['text']); ?></p>
					</a>
				<?php else : ?>
					<article class="plain-card">
						<h3><?php echo esc_html($offer['title']); ?></h3>
						<p><?php echo esc_html($offer['text']); ?></p>
					</article>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>
<section class="section<?php echo empty($page['offers']) ? '' : ' section--tint'; ?>">
	<div class="container split">
		<div>
			<?php sovassa_section_head('Capabilities', 'Included in a typical engagement.', ''); ?>
			<ul class="checklist">
				<?php foreach ($page['capabilities'] as $item) : ?>
					<li><?php echo esc_html($item); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<?php sovassa_section_head('Stack', 'Tools we will actually discuss.', ''); ?>
			<div class="stack">
				<?php foreach ($page['stack'] as $item) : ?>
					<span><?php echo esc_html($item); ?></span>
				<?php endforeach; ?>
			</div>
			<p class="note" style="margin-top:18px"><?php echo esc_html($page['quality']); ?></p>
		</div>
	</div>
</section>
<?php
sovassa_process($page['process'], 'Process', 'How an engagement moves.', '');
sovassa_related($page['related']);
$work_match = array(
	'web-development'        => 'Web Development',
	'mobile-app-development' => 'Mobile Apps',
	'ai-automation'          => 'AI and automation',
	'seo'                    => 'SEO',
	'google-ads'             => 'Google Ads',
	'content-marketing'      => 'Content Marketing',
);
$service_slug = get_post_field('post_name', get_queried_object_id());
$matched_work = array();
if (isset($work_match[$service_slug])) {
	foreach (sovassa_page('work')['items'] as $item) {
		if ($item['service'] === $work_match[$service_slug]) {
			$matched_work[] = $item;
		}
	}
}
?>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Case studies', 'Proof for this service, when it exists.', 'We will not attach another company’s numbers to this page. A card appears here when the engagement matches this service.'); ?>
		<?php if ($matched_work) : ?>
			<div class="card-grid card-grid--3">
				<?php foreach ($matched_work as $item) : ?>
					<article class="plain-card">
						<p class="link-card__kicker">Illustrative engagement</p>
						<h3><?php echo esc_html($item['title']); ?></h3>
						<p><strong>Challenge.</strong> <?php echo esc_html($item['challenge']); ?></p>
						<p><strong>Solution.</strong> <?php echo esc_html($item['solution']); ?></p>
						<p><strong>Result.</strong> <?php echo esc_html($item['result']); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="note">No illustrative engagement is filed under this service yet. The work page still shows the kinds of projects Sovassa takes on.</p>
		<?php endif; ?>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">View all work types <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>
<?php
sovassa_faq($page['faq']);
