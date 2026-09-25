<?php
/**
 * Services hub.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
$groups = array(
	'build'  => array('label' => 'Build', 'id' => 'build', 'class' => 'tint-row--build', 'icon' => 'code', 'slugs' => array('web-development', 'mobile-app-development', 'ai-automation', 'ui-ux-design'), 'title' => 'Products and websites with a job to do.', 'text' => 'We design and build the experience a customer or employee actually uses.'),
	'market' => array('label' => 'Market', 'id' => 'market', 'class' => 'tint-row--market', 'icon' => 'megaphone', 'slugs' => array('seo', 'digital-marketing', 'social-media-marketing', 'google-ads', 'content-marketing'), 'title' => 'Channels that can explain the same offer.', 'text' => 'Search, social, paid, and content are planned against the pages that receive them.'),
	'grow'   => array('label' => 'Grow', 'id' => 'grow', 'class' => 'tint-row--grow', 'icon' => 'growth', 'slugs' => array('solutions', 'industries'), 'title' => 'Outcomes that borrow from both sides.', 'text' => 'When the brief is a business result, we recommend a mix instead of a single service.'),
);
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container">
		<?php foreach ($groups as $group) : ?>
			<div class="tint-row <?php echo esc_attr($group['class']); ?>" id="<?php echo esc_attr($group['id']); ?>">
				<div class="tint-row__label">
					<span class="icon-badge"><?php sovassa_icon($group['icon']); ?></span>
					<h2><?php echo esc_html($group['label']); ?></h2>
				</div>
				<div class="chips">
					<?php foreach ($group['slugs'] as $slug) : ?>
						<?php $item = sovassa_page($slug); ?>
						<a class="chip" href="<?php echo esc_url(sovassa_url($slug)); ?>"><?php echo esc_html($item['nav_label']); ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php foreach ($groups as $group) : ?>
	<section class="section section--tint">
		<div class="container">
			<?php sovassa_section_head($group['label'], $group['title'], $group['text']); ?>
			<div class="card-grid card-grid--3">
				<?php foreach ($group['slugs'] as $slug) : ?>
					<?php $item = sovassa_page($slug); ?>
					<a class="link-card" href="<?php echo esc_url(sovassa_url($slug)); ?>">
						<h3><?php echo esc_html($item['nav_label']); ?></h3>
						<p><?php echo esc_html(isset($item['card']) ? $item['card'] : $item['intro']); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endforeach; ?>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('How the services meet', 'One customer journey, even when several people touch it.', ''); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['together'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Ways to work with us', 'Pick the commitment that matches the work.', ''); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['engagements'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
					<ul>
						<?php foreach ($item['points'] as $point) : ?>
							<li><?php echo esc_html($point); ?></li>
						<?php endforeach; ?>
					</ul>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Featured work', 'Engagement shapes connected to these services.', 'Named case studies will be added when a client engagement is ready to share. Until then, these describe the work, not a result.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach (array_slice(sovassa_page('work')['items'], 0, 3) as $item) : ?>
				<article class="plain-card">
					<p class="link-card__kicker"><?php echo esc_html($item['service']); ?></p>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><strong>Challenge.</strong> <?php echo esc_html($item['challenge']); ?></p>
					<p><strong>Solution.</strong> <?php echo esc_html($item['solution']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">View all work types <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>
<?php sovassa_faq($page['faq']); ?>
