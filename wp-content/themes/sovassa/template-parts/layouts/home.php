<?php
/**
 * Homepage layout.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
$build = array('web-development', 'mobile-app-development', 'ai-automation', 'ui-ux-design');
$market = array('seo', 'digital-marketing', 'social-media-marketing', 'google-ads', 'content-marketing');
$work = sovassa_page('work');
$tech = sovassa_page('technologies');
?>
<section class="hero">
	<div class="container hero__grid">
		<div>
			<?php sovassa_eyebrow($page['eyebrow']); ?>
			<h1>
				<?php echo esc_html($page['title']); ?>
				<span class="hero__rotate" data-rotate="<?php echo esc_attr(implode('|', $page['rotate'])); ?>"><?php echo esc_html($page['rotate'][0]); ?></span>
			</h1>
			<p class="lede"><?php echo esc_html($page['intro']); ?></p>
			<?php sovassa_default_actions(); ?>
		</div>
		<div class="hero-panel">
			<article>
				<h2>Build</h2>
				<div class="chips">
					<?php foreach ($build as $slug) : ?>
						<?php $item = sovassa_page($slug); ?>
						<a class="chip" href="<?php echo esc_url(sovassa_url($slug)); ?>"><?php echo esc_html($item['nav_label']); ?></a>
					<?php endforeach; ?>
				</div>
			</article>
			<article>
				<h2>Market</h2>
				<div class="chips">
					<?php foreach ($market as $slug) : ?>
						<?php $item = sovassa_page($slug); ?>
						<a class="chip" href="<?php echo esc_url(sovassa_url($slug)); ?>"><?php echo esc_html($item['nav_label']); ?></a>
					<?php endforeach; ?>
				</div>
			</article>
			<article>
				<h2>Grow</h2>
				<div class="chips">
					<a class="chip" href="<?php echo esc_url(home_url('/solutions/')); ?>">Solutions</a>
					<a class="chip" href="<?php echo esc_url(home_url('/industries/')); ?>">Industries</a>
					<a class="chip" href="<?php echo esc_url(home_url('/work/')); ?>">Our work</a>
					<a class="chip" href="<?php echo esc_url(home_url('/technologies/')); ?>">Technologies</a>
				</div>
			</article>
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
	<div class="container">
		<img class="hero-visual" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/home-visual.webp'); ?>" alt="A website layout, a phone screen, and a rising chart in navy and teal." width="1600" height="900">
	</div>
</section>

<section class="section">
	<div class="container split">
		<div>
			<?php sovassa_section_head('Why Sovassa', 'Delivery that keeps product and marketing in the same plan.', 'The model is simple on purpose. Build the thing, market it, and improve what the numbers and the team both notice.'); ?>
			<p class="note">Client metrics will be added only when they come from a completed engagement. This site will not invent them.</p>
		</div>
		<ul class="checklist">
			<?php foreach ($page['why'] as $item) : ?>
				<li>
					<strong><?php echo esc_html($item['title']); ?></strong>
					<?php echo esc_html($item['text']); ?>
				</li>
			<?php endforeach; ?>
		</ul>
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
		<a class="tint-row tint-row--build" href="<?php echo esc_url(home_url('/services/#build')); ?>">
			<div class="tint-row__label"><span class="icon-badge"><?php sovassa_icon('code'); ?></span><h2>Build</h2></div>
			<p>Websites, mobile products, applied AI, and the interface design that holds them together.</p>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/pillar-build.webp'); ?>" alt="" width="960" height="640" loading="lazy">
		</a>
		<a class="tint-row tint-row--market" href="<?php echo esc_url(home_url('/services/#market')); ?>">
			<div class="tint-row__label"><span class="icon-badge icon-badge--teal"><?php sovassa_icon('megaphone'); ?></span><h2>Market</h2></div>
			<p>SEO, integrated marketing, social, paid search, and content that the website can carry.</p>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/pillar-market.webp'); ?>" alt="" width="960" height="640" loading="lazy">
		</a>
		<a class="tint-row tint-row--grow" href="<?php echo esc_url(home_url('/solutions/')); ?>">
			<div class="tint-row__label"><span class="icon-badge icon-badge--mint"><?php sovassa_icon('growth'); ?></span><h2>Grow</h2></div>
			<p>Packaged outcomes for pipeline, launch, automation, and the months after go-live.</p>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/pillar-grow.webp'); ?>" alt="" width="960" height="640" loading="lazy">
		</a>
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

<section class="section section--navy">
	<div class="container container--narrow">
		<?php sovassa_section_head('Results', 'Numbers only when they are real.', 'This site will not publish client logos, percentages, or testimonials until they come from a completed engagement the client is willing to share.'); ?>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">See the kinds of work we take on <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php sovassa_section_head('Industries', 'A connected set of capabilities, adjusted to the market.', 'We start with six industries we can describe honestly. The list can grow when the work does.'); ?>
		<div data-switcher>
			<div class="switcher__nav" hidden>
				<?php foreach (sovassa_page('industries')['items'] as $item) : ?>
					<button type="button" data-switch="<?php echo esc_attr(sanitize_title($item['title'])); ?>"><?php echo esc_html($item['title']); ?></button>
				<?php endforeach; ?>
			</div>
			<div class="card-grid card-grid--3">
				<?php foreach (sovassa_page('industries')['items'] as $item) : ?>
					<a class="link-card" data-switch-item="<?php echo esc_attr(sanitize_title($item['title'])); ?>" href="<?php echo esc_url(home_url('/industries/#' . sanitize_title($item['title']))); ?>">
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
		<div data-switcher data-switch-mode="hide">
			<div class="switcher__nav" hidden>
				<?php foreach ($tech['groups'] as $group) : ?>
					<button type="button" data-switch="<?php echo esc_attr(sanitize_title($group['title'])); ?>"><?php echo esc_html($group['title']); ?></button>
				<?php endforeach; ?>
			</div>
			<div class="stack">
				<?php foreach ($tech['groups'] as $group) : ?>
					<?php foreach (array_slice($group['items'], 0, 2) as $item) : ?>
						<a class="chip" data-switch-item="<?php echo esc_attr(sanitize_title($group['title'])); ?>" href="<?php echo esc_url(home_url('/technologies/')); ?>"><?php echo esc_html($item); ?></a>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php sovassa_process($page['delivery'], 'How we work', 'From the first conversation to a system you can grow.', 'Every engagement follows the same spine, whether the output is a website, a campaign, or both.', 'process'); ?>

<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Marketing process', 'Research, strategy, execution, then a report someone will read.', 'Marketing work uses a fifth step so optimization is not left as a slogan.'); ?>
		<ol class="steps steps--5">
			<?php foreach ($page['marketing'] as $index => $step) : ?>
				<li class="step">
					<span class="step__index"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
					<h3><?php echo esc_html($step['title']); ?></h3>
					<p><?php echo esc_html($step['text']); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<section class="section">
	<div class="container container--narrow">
		<?php sovassa_section_head('Testimonials', 'Client words, when a client wants them public.', 'Quotes will be added here only from a completed engagement, with the person’s name and company. None are published yet.'); ?>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php sovassa_section_head('Team', 'The people behind the work will be introduced properly.', 'Profiles, photos, and names will be added when teammates are ready to be public. Roles are not a substitute for that.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach (array('Strategy and delivery', 'Design and engineering', 'Marketing') as $role) : ?>
				<article class="role-card">
					<h3><?php echo esc_html($role); ?></h3>
					<p>A named owner in this area will be listed here. Until then, the consultation still reaches a person, not a queue.</p>
				</article>
			<?php endforeach; ?>
		</div>
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
