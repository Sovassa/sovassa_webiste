<?php
/**
 * About layout.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'about', 'Discover, Strategize, Build, and Grow in order.');
?>
<section class="section">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('Our story', 'Built for a familiar gap.', ''); ?>
			<?php foreach ($page['story'] as $paragraph): ?>
				<p><?php echo esc_html($paragraph); ?></p>
			<?php endforeach; ?>
		</div>
		<?php sovassa_page_still('about', 'A product interface connecting into a marketing and growth path.'); ?>
	</div>
</section>
<section class="section section--tight">
	<div class="container card-grid card-grid--2">
		<article class="plain-card">
			<h3>Vision</h3>
			<p><?php echo esc_html($page['vision']); ?></p>
		</article>
		<article class="plain-card">
			<h3>Mission</h3>
			<p><?php echo esc_html($page['mission']); ?></p>
		</article>
	</div>
</section>
<?php if (!empty($page['founders'])): ?>
	<section class="section section--founders-spotlight" id="founders">
		<div class="container">
			<div class="founders-spotlight__head">
				<span class="founders-spotlight__pill">Executive Leadership</span>
				<h2>The Brains Behind Sovassa Technologies</h2>
				<p class="founders-spotlight__intro">
					Founded by Simran Kaur and Sukhwinder Kaur with a singular thesis: uniting product architecture, design
					clarity, and commercial market growth under one disciplined roof.
				</p>
			</div>

			<div class="founders-spotlight__list">
				<?php foreach ($page['founders'] as $i => $founder):
					$img_slug = $founder['image'];
					$theme_dir = get_template_directory();
					$theme_uri = get_template_directory_uri();
					$has_webp = file_exists($theme_dir . '/assets/images/founders/' . $img_slug . '.webp');
					$has_jpg = file_exists($theme_dir . '/assets/images/founders/' . $img_slug . '.jpg');
					$has_png = file_exists($theme_dir . '/assets/images/founders/' . $img_slug . '.png');
					$svg_src = $theme_uri . '/assets/images/founders/' . $img_slug . '.svg';
					?>
					<article class="founder-profile">
						<div class="founder-profile__visual">
							<div class="founder-profile__media">
								<?php if ($has_webp || $has_jpg || $has_png): ?>
									<picture>
										<?php if ($has_webp): ?>
											<source
												srcset="<?php echo esc_url($theme_uri . '/assets/images/founders/' . $img_slug . '.webp'); ?>"
												type="image/webp">
										<?php endif; ?>
										<?php
										$fallback_img = $has_jpg ? ($theme_uri . '/assets/images/founders/' . $img_slug . '.jpg') : ($theme_uri . '/assets/images/founders/' . $img_slug . '.png');
										?>
										<img src="<?php echo esc_url($fallback_img); ?>"
											alt="<?php echo esc_attr($founder['name'] . ' – ' . $founder['role'] . ' at Sovassa Technologies'); ?>"
											width="682" height="1024" loading="lazy">
									</picture>
								<?php else: ?>
									<img src="<?php echo esc_url($svg_src); ?>"
										alt="<?php echo esc_attr($founder['name'] . ' – ' . $founder['role'] . ' at Sovassa Technologies'); ?>"
										width="682" height="1024" loading="lazy">
								<?php endif; ?>

								<div class="founder-profile__badge">
									<span class="founder-profile__badge-dot"></span>
									<?php echo esc_html($founder['role']); ?>
								</div>
							</div>
						</div>

						<div class="founder-profile__details">
							<div class="founder-profile__header">
								<h3 class="founder-profile__name"><?php echo esc_html($founder['name']); ?></h3>
								<p class="founder-profile__title"><?php echo esc_html($founder['role']); ?></p>
							</div>

							<?php if (!empty($founder['quote'])): ?>
								<blockquote class="founder-profile__quote">
									<svg class="founder-profile__quote-icon" viewBox="0 0 24 24" fill="currentColor"
										aria-hidden="true">
										<path
											d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
									</svg>
									<p><?php echo esc_html($founder['quote']); ?></p>
								</blockquote>
							<?php endif; ?>

							<p class="founder-profile__bio"><?php echo esc_html($founder['bio']); ?></p>

							<?php if (!empty($founder['pillars'])): ?>
								<div class="founder-profile__pillars">
									<?php foreach ($founder['pillars'] as $pillar): ?>
										<div class="founder-pill">
											<span class="founder-pill__dot"></span>
											<span><?php echo esc_html($pillar); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<div class="founder-profile__footer">
								<a class="founder-profile__cta text-link"
									href="<?php echo esc_url(home_url('/contact/#enquiry')); ?>">
									Connect with Leadership <?php sovassa_icon('arrow'); ?>
								</a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Build, Market, Grow', 'The idea we repeat, because the work depends on it.', 'Build is the product. Market is how the right people find it. Grow is the operating rhythm after launch.'); ?>
		<div class="card-grid card-grid--3">
			<article class="plain-card">
				<h3>Build</h3>
				<p>Websites, applications, mobile products, AI workflows, and the design that makes them usable.</p>
			</article>
			<article class="plain-card">
				<h3>Market</h3>
				<p>SEO, content, social, and paid media aimed at the same offer the product describes.</p>
			</article>
			<article class="plain-card">
				<h3>Grow</h3>
				<p>Measurement, iteration, and solutions that combine the first two around a business result.</p>
			</article>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Values', 'How we choose when the brief is ambiguous.', ''); ?>
		<div class="card-grid card-grid--2">
			<?php foreach ($page['values'] as $value): ?>
				<article class="plain-card">
					<h3><?php echo esc_html($value['title']); ?></h3>
					<p><?php echo esc_html($value['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Working together', 'What a client should feel in the first month.', ''); ?>
		<div class="card-grid card-grid--2">
			<?php foreach ($page['with_clients'] as $item): ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Capabilities and delivery', 'Multidisciplinary execution under one roof.', 'Working under our founders\' direct oversight, every engagement brings together specialized engineers, strategists, and designers.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['capabilities'] as $item): ?>
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
		<?php sovassa_section_head('Why clients choose Sovassa', 'The practical reasons, not a slogan.', ''); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['why_choose'] as $item): ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('Selected work', 'The shape of the work, until named proof exists.', 'These cards are not client results. Named case studies will replace them when a client is comfortable sharing the work.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach (array_slice(sovassa_page('work')['items'], 0, 3) as $item): ?>
				<article class="plain-card">
					<p class="link-card__kicker"><?php echo esc_html($item['service']); ?></p>
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['challenge']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<p><a class="text-link" href="<?php echo esc_url(home_url('/work/')); ?>">View all work types
				<?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>
<?php sovassa_faq($page['faq']); ?>