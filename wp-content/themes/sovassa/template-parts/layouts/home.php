<?php
/**
 * Homepage layout.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
$work = sovassa_page('work');
$tech = sovassa_page('technologies');
$tech_names = array();
foreach ($tech['groups'] as $group) {
	foreach ($group['items'] as $name) {
		$tech_names[] = $name;
	}
}
?>
<section class="hero hero--film">
	<div class="hero__film" aria-hidden="true">
		<?php sovassa_brand_video('together', 'Product interfaces forming, then marketing and growth moving on the same path.'); ?>
	</div>
	<div class="container">
		<div class="hero__copy">
			<?php sovassa_eyebrow($page['eyebrow']); ?>
			<h1><?php echo esc_html($page['title']); ?></h1>
			<p class="hero__focus">
				A technology and marketing partner for
				<span class="hero__rotate" data-rotate="<?php echo esc_attr(implode('|', $page['rotate'])); ?>">
					<span class="hero__rotate-word"><?php echo esc_html($page['rotate'][0]); ?></span>
				</span>
			</p>
			<p class="lede"><?php echo esc_html($page['intro']); ?></p>
			<?php sovassa_default_actions(); ?>
			<div class="hero-pills">
				<a href="<?php echo esc_url(home_url('/services/#build')); ?>">Build</a>
				<a href="<?php echo esc_url(home_url('/services/#market')); ?>">Market</a>
				<a href="<?php echo esc_url(home_url('/solutions/')); ?>">Grow</a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="trust-row">
			<?php foreach ($page['trust'] as $item) : ?>
				<div class="trust-pill">
					<span class="icon-badge"><?php sovassa_icon($item['icon']); ?></span>
					<span><?php echo esc_html($item['label']); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('Why Sovassa', 'Delivery that keeps product and marketing in the same plan.', 'The model is simple on purpose. Build the thing, market it, and improve what the numbers and the team both notice.'); ?>
			<p class="note">Client metrics will be added only when they come from a completed engagement. This site will not invent them.</p>
			<ul class="checklist">
				<?php foreach ($page['why'] as $item) : ?>
					<li>
						<strong><?php echo esc_html($item['title']); ?></strong>
						<?php echo esc_html($item['text']); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<figure class="together-still">
			<picture>
				<source type="image/webp" srcset="<?php echo esc_url(get_template_directory_uri() . '/assets/images/together.webp?ver=' . SOVASSA_VERSION); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/together.jpg?ver=' . SOVASSA_VERSION); ?>" alt="Abstract product interfaces flowing into a marketing and growth path." width="1024" height="575">
			</picture>
		</figure>
	</div>
</section>

<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('What are you trying to achieve?', 'Start with the outcome, then open the service that fits.', 'Six common reasons companies contact Sovassa. Each one leads to a page with a specific scope.'); ?>
		<div class="goal-grid">
			<?php foreach ($page['goals'] as $goal) : ?>
				<a class="link-card" href="<?php echo esc_url(sovassa_url($goal['slug'])); ?>">
					<h3><?php echo esc_html($goal['title']); ?></h3>
					<p><?php echo esc_html($goal['text']); ?></p>
					<span class="text-link">Explore <?php sovassa_icon('arrow'); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php sovassa_section_head('Services', 'Three groups. One team when the work needs more than one.', 'Pick a service if you already know the brief. Open Solutions if you know the outcome and want a recommended mix.'); ?>
		<p>The work covers <a href="<?php echo esc_url(home_url('/web-development/')); ?>">web development services</a>, <a href="<?php echo esc_url(home_url('/mobile-app-development/')); ?>">app development</a>, <a href="<?php echo esc_url(home_url('/ui-ux-design/')); ?>">UI and UX design</a>, <a href="<?php echo esc_url(home_url('/ai-automation/')); ?>">AI automation</a>, and <a href="<?php echo esc_url(home_url('/digital-marketing/')); ?>">digital marketing services</a>. <a href="<?php echo esc_url(home_url('/content-marketing/')); ?>">Content strategy services</a> and <a href="<?php echo esc_url(home_url('/seo/')); ?>">SEO</a> sit with the same team.</p>
		<div class="bento">
			<a class="bento__card bento__card--build" href="<?php echo esc_url(home_url('/services/#build')); ?>">
				<span class="icon-badge"><?php sovassa_icon('code'); ?></span>
				<p class="link-card__kicker">Build</p>
				<h2>Websites, mobile products, applied AI, and the interface design that holds them together.</h2>
				<span class="text-link">Explore build <?php sovassa_icon('arrow'); ?></span>
			</a>
			<a class="bento__card bento__card--market" href="<?php echo esc_url(home_url('/services/#market')); ?>">
				<span class="icon-badge icon-badge--teal"><?php sovassa_icon('megaphone'); ?></span>
				<p class="link-card__kicker">Market</p>
				<h2>SEO, integrated marketing, social, paid search, and content that the website can carry.</h2>
				<span class="text-link">Explore market <?php sovassa_icon('arrow'); ?></span>
			</a>
			<a class="bento__card bento__card--grow" href="<?php echo esc_url(home_url('/solutions/')); ?>">
				<span class="icon-badge icon-badge--mint"><?php sovassa_icon('growth'); ?></span>
				<p class="link-card__kicker">Grow</p>
				<h2>Packaged outcomes for pipeline, launch, automation, and the months after go-live.</h2>
				<span class="text-link">Explore grow <?php sovassa_icon('arrow'); ?></span>
			</a>
		</div>
	</div>
</section>

<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Featured work', 'Engagement shapes, until named case studies exist.', 'These are the problems we are set up to take. They are not client results.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach (array_slice($work['items'], 0, 3) as $item) : ?>
				<article class="plain-card">
					<p class="link-card__kicker"><?php echo esc_html($item['service']); ?></p>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">View all work types <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php sovassa_section_head('Industries', 'A connected set of capabilities, adjusted to the market.', 'Each market here is one we can describe honestly. The list can grow when the work does.'); ?>
		<div data-switcher>
			<div class="switcher__nav" hidden>
				<?php foreach (sovassa_page('industries')['items'] as $item) : ?>
					<button type="button" data-switch="<?php echo esc_attr(sanitize_title($item['title'])); ?>"><?php echo esc_html($item['title']); ?></button>
				<?php endforeach; ?>
			</div>
			<div class="card-grid card-grid--3">
				<?php foreach (sovassa_page('industries')['items'] as $item) : ?>
					<a class="link-card" data-switch-item="<?php echo esc_attr(sanitize_title($item['title'])); ?>" href="<?php echo esc_url(sovassa_url($item['slug'])); ?>">
						<h3><?php echo esc_html($item['title']); ?></h3>
						<p><?php echo esc_html($item['challenge']); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Technology', 'A working ecosystem, not a wall of logos.', 'The tools below are ones we will actually propose. Partnerships are not implied.'); ?>
		<?php sovassa_marquee($tech_names, home_url('/technologies/')); ?>
	</div>
</section>

<?php sovassa_process($page['delivery'], 'How we work', 'From the first conversation to a system you can grow.', 'Every engagement follows the same spine, whether the output is a website, a campaign, or both.', '', '', 'about'); ?>

<?php sovassa_process($page['marketing'], 'Marketing process', 'Research, strategy, execution, then a report someone will read.', 'Marketing work uses a fifth step so optimization is not left as a slogan.', '', 'section--tint'); ?>

<section class="section section--navy section--results">
	<div class="container container--narrow">
		<?php sovassa_section_head('Proof', 'Names and numbers, when they are real.', 'Client results, quotes, and team profiles will be published only from a completed engagement someone is willing to share. None are public yet.'); ?>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">See the kinds of work we take on <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>

<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Insights', 'Fresh from the notebook.', 'Short articles on briefing work, search, automation, and content systems.'); ?>
		<div class="post-grid">
			<?php
			$insights = sovassa_insights_query(3);
			if ($insights->have_posts()) :
				while ($insights->have_posts()) :
					$insights->the_post();
					sovassa_post_card();
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p>Articles will appear here after the first publish.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<?php sovassa_faq($page['faq'], 'Questions before the first call'); ?>
