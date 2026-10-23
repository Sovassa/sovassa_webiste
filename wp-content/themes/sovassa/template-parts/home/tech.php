<?php
/**
 * Automated Ecosystem Technologies & Frameworks Ticker.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$ecosystem = array(
	array('name' => 'AWS Cloud', 'cat' => 'Infra'),
	array('name' => 'Next.js 14', 'cat' => 'Web'),
	array('name' => 'React', 'cat' => 'Frontend'),
	array('name' => 'Flutter', 'cat' => 'Mobile'),
	array('name' => 'React Native', 'cat' => 'Mobile'),
	array('name' => 'OpenAI & Claude', 'cat' => 'AI Agents'),
	array('name' => 'Python', 'cat' => 'Backend & AI'),
	array('name' => 'Node.js', 'cat' => 'API Engine'),
	array('name' => 'TypeScript', 'cat' => 'Type Safety'),
	array('name' => 'PostgreSQL', 'cat' => 'Database'),
	array('name' => 'Docker', 'cat' => 'DevOps'),
	array('name' => 'Stripe Payments', 'cat' => 'Fintech'),
	array('name' => 'Redis', 'cat' => 'Real-Time'),
	array('name' => 'Swift & Kotlin', 'cat' => 'Native OS'),
	array('name' => 'WordPress & Headless', 'cat' => 'CMS'),
	array('name' => 'Kubernetes', 'cat' => 'Clustering'),
);
?>
<section class="hp-band hp-band--tight hp-tech-section" aria-labelledby="hp-tech-title">
	<div class="hp-wrap">
		<div class="hp-head hp-head--small">
			<span class="hp-pill">Modern Engineering Ecosystem</span>
			<h2 id="hp-tech-title">Battle-Tested Technologies & Frameworks</h2>
			<p>We build on high-velocity, production-grade stacks proven to scale to millions of requests without architectural rework.</p>
		</div>
	</div>
	
	<!-- Infinite Marquee Ticker -->
	<div class="tech-marquee" aria-label="Ecosystem technologies ticker">
		<div class="tech-marquee__track">
			<div class="tech-marquee__content">
				<?php foreach ($ecosystem as $item) : ?>
					<div class="tech-pill">
						<span class="tech-pill__dot"></span>
						<strong class="tech-pill__name"><?php echo esc_html($item['name']); ?></strong>
						<span class="tech-pill__tag"><?php echo esc_html($item['cat']); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="tech-marquee__content" aria-hidden="true">
				<?php foreach ($ecosystem as $item) : ?>
					<div class="tech-pill">
						<span class="tech-pill__dot"></span>
						<strong class="tech-pill__name"><?php echo esc_html($item['name']); ?></strong>
						<span class="tech-pill__tag"><?php echo esc_html($item['cat']); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="hp-wrap">
		<p class="hp-tech__more">
			<a class="text-link" href="<?php echo esc_url(sovassa_url('technologies')); ?>">
				Explore our 7-tier architecture explorer <?php sovassa_icon('arrow'); ?>
			</a>
		</p>
	</div>
</section>

