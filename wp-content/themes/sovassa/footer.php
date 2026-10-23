<?php
/**
 * Closing call to action and footer.
 *
 * @package Sovassa
 */

$config = sovassa_config();
// The front page ends with its own closing CTA section.
$quiet = is_page('thank-you') || is_front_page();

$footer_columns = array(
	array(
		'label' => 'Services',
		'url' => 'services',
		'links' => array(
			array('Web Development', 'web-development'),
			array('Mobile Apps', 'mobile-app-development'),
			array('UI/UX Design', 'ui-ux-design'),
			array('AI & Automation', 'ai-automation'),
			array('SEO', 'seo'),
			array('Digital Marketing', 'digital-marketing'),
			array('Social Media', 'social-media-marketing'),
			array('Google Ads', 'google-ads'),
			array('Content Marketing', 'content-marketing'),
		),
	),
	array(
		'label' => 'Solutions',
		'url' => 'solutions',
		'links' => array(),
	),
	array(
		'label' => 'Industries',
		'url' => 'industries',
		'links' => array(),
	),
	array(
		'label' => 'Company',
		'url' => 'about',
		'links' => array(
			array('About Us', 'about'),
			array('Work', 'work'),
			array('Insights', 'insights'),
			array('Technologies', 'technologies'),
			array('Careers', 'careers'),
			array('Contact', 'contact'),
		),
	),
);
$solutions_page = sovassa_page('solutions');
if ($solutions_page && !empty($solutions_page['items'])) {
	foreach ($solutions_page['items'] as $solution) {
		$footer_columns[1]['links'][] = array($solution['title'], '/solutions/#' . sanitize_title($solution['title']));
	}
}
$industries_page = sovassa_page('industries');
if ($industries_page && !empty($industries_page['items'])) {
	foreach ($industries_page['items'] as $industry) {
		$footer_columns[2]['links'][] = array($industry['title'], $industry['slug']);
	}
}
?>
</main>
<?php if (!$quiet): ?>
	<section class="cta-band cta-band--finale">
		<div class="container cta-band__inner">
			<div>
				<p class="eyebrow eyebrow--light"><span class="eyebrow__line" aria-hidden="true"></span> Start a
					conversation</p>
				<h2>Bring your next project into focus.</h2>
				<p>Book a consultation or send the brief you already have. We will reply with a clear next step.</p>
			</div>
			<div class="actions">
				<a class="btn btn--primary" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Start a Project
					<?php sovassa_icon('arrow'); ?></a>
				<a class="btn btn--inverse" href="<?php echo esc_url(home_url('/contact/')); ?>">Send us a message</a>
			</div>
		</div>
	</section>
<?php endif; ?>
<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="site-footer__brand">
			<a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg?ver=' . SOVASSA_VERSION); ?>"
					alt="Sovassa Technologies" width="1098" height="219" loading="lazy">
			</a>
			<p class="footer-note"><?php echo esc_html($config['tagline']); ?></p>
			<p class="footer-about">One team for websites, apps, AI, and the marketing that brings people to them.
				Working with businesses worldwide.</p>
			<?php
			$social = isset($config['social']) && is_array($config['social']) ? array_filter($config['social']) : array();
			if ($social):
				?>
				<ul class="social-links">
					<?php foreach ($social as $label => $url): ?>
						<?php if (!is_string($url) || '' === $url) {
							continue;
						} ?>
						<li>
							<a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer"
								aria-label="<?php echo esc_attr((string) $label); ?>">
								<?php sovassa_icon(strtolower((string) $label)); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php foreach ($footer_columns as $column): ?>
			<div class="site-footer__col">
				<p class="footer-label"><a
						href="<?php echo esc_url(sovassa_url($column['url'])); ?>"><?php echo esc_html($column['label']); ?></a>
				</p>
				<?php if ($column['links']): ?>
					<ul>
						<?php foreach ($column['links'] as $link): ?>
							<li><a href="<?php echo esc_url(sovassa_url($link[1])); ?>"><?php echo esc_html($link[0]); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="container site-footer__base">
		<p>&copy; <?php echo esc_html(gmdate('Y')); ?> Sovassa</p>
		<nav aria-label="Legal">
			<a href="<?php echo esc_url(home_url('/privacy/')); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url(home_url('/terms/')); ?>">Terms &amp; Conditions</a>
			<a href="<?php echo esc_url(home_url('/cookies/')); ?>">Cookie Policy</a>
			<?php if (!sovassa_plugin_active('surecookie')): ?>
				<button class="cookie-settings" type="button" data-cookie-settings>Cookie settings</button>
			<?php endif; ?>
			<a href="<?php echo esc_url(home_url('/copyright/')); ?>">Copyright / DMCA</a>
			<a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Start a Project</a>
		</nav>
		<div class="site-footer__badges">
			<a class="footer-badge-link"
				href="<?php echo esc_url(!empty($config['clutch_url']) ? $config['clutch_url'] : 'https://clutch.co/'); ?>"
				title="Sovassa Technologies on Clutch" target="_blank" rel="noopener noreferrer"
				aria-label="Sovassa on Clutch">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/badges/clutch-badge.svg?ver=' . SOVASSA_VERSION); ?>"
					alt="Clutch 5.0 Star Verified Agency" width="88" height="44" loading="lazy">
			</a>
			<a class="footer-badge-link"
				href="<?php echo esc_url(!empty($config['goodfirms_url']) ? $config['goodfirms_url'] : 'https://www.goodfirms.co/'); ?>"
				title="Sovassa Technologies on GoodFirms" target="_blank" rel="noopener noreferrer"
				aria-label="Sovassa on GoodFirms">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/badges/goodfirms-badge.svg?ver=' . SOVASSA_VERSION); ?>"
					alt="GoodFirms Top Rated Agency" width="88" height="44" loading="lazy">
			</a>
			<a class="dmca-badge"
				href="https://www.dmca.com/Protection/Status.aspx?ID=174838c6-23a6-4eeb-9552-041177438471"
				title="DMCA.com Protection Status" target="_blank" rel="noopener noreferrer">
				<img src="https://images.dmca.com/Badges/dmca-badge-w250-2x1-02.png?ID=174838c6-23a6-4eeb-9552-041177438471"
					alt="DMCA.com Protection Status" width="88" height="44" loading="lazy">
			</a>
		</div>
	</div>
</footer>
<?php
// SureCookie shows its own banner and preferences button, so the theme's bar would be a second one.
if (!sovassa_plugin_active('surecookie')):
	?>
	<form class="cookie-bar" id="cookie-bar" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
		<?php wp_nonce_field('sovassa_cookie', 'sovassa_cookie_nonce'); ?>
		<input type="hidden" name="action" value="sovassa_cookie">
		<p>Essential cookies stay on. Analytics stays off until you accept it. <a
				href="<?php echo esc_url(home_url('/cookies/')); ?>">Cookie policy</a></p>
		<div class="cookie-bar__actions">
			<button class="btn btn--ghost btn--sm" type="submit" name="choice" value="essential">Essential only</button>
			<button class="btn btn--primary btn--sm" type="submit" name="choice" value="all">Accept analytics</button>
		</div>
	</form>
	<script>
		if (document.cookie.indexOf("sovassa_cookie=") !== -1) {
			var cookieBar = document.getElementById("cookie-bar");
			if (cookieBar) cookieBar.hidden = true;
		}
	</script>
<?php endif; ?>
<div class="edge-dock">
	<a class="edge-dock__phone" href="<?php echo esc_url('tel:' . $config['phone']); ?>"
		aria-label="Call <?php echo esc_attr($config['phone_display']); ?>">
		<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
			<path fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
				d="M7 3.8h2.4l1.3 3.2-1.6 1a12 12 0 0 0 5.9 5.9l1-1.6 3.2 1.3V16a2 2 0 0 1-2.2 2A15.5 15.5 0 0 1 6 6a2 2 0 0 1 1-2.2Z" />
		</svg>
	</a>
	<a class="edge-dock__tab edge-dock__chat" aria-label="Chat with us on WhatsApp"
		href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer">
		<span class="edge-dock__label"><span>Chat With Us</span></span>
		<span class="edge-dock__mark">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<path fill="none" stroke="#111" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"
					d="M12 4.4a7.1 7.1 0 0 0-6.1 10.7L5.2 19l4.1-.9A7.1 7.1 0 1 0 12 4.4Z" />
				<path fill="none" stroke="#111" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"
					d="M9.3 10.1c.15 1.35 1.25 2.55 2.6 3.05.35.12.6 0 .75-.28l.35-.6c.1-.18.28-.2.46-.12l1.05.45c.18.08.28.26.2.44-.2.7-.78 1.2-1.48 1.28-1.4.1-3.3-1.05-4.15-2.7-.85-1.55-.5-2.95.1-3.6.28-.32.7-.42 1.05-.32.16.04.28.12.36.26l.5.95c.08.16.02.34-.1.46l-.32.32c-.12.14-.1.34.06.5Z" />
			</svg>
		</span>
	</a>
	<a class="edge-dock__tab edge-dock__ig" aria-label="Sovassa on Instagram"
		href="<?php echo esc_url($config['social']['Instagram']); ?>" target="_blank" rel="noopener noreferrer">
		<span class="edge-dock__label"><span>Instagram</span></span>
		<span class="edge-dock__mark">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<rect x="4.5" y="4.5" width="15" height="15" rx="4" fill="none" stroke="#fff" stroke-width="1.7" />
				<circle cx="12" cy="12" r="3.4" fill="none" stroke="#fff" stroke-width="1.7" />
				<circle cx="16.6" cy="7.5" r="0.9" fill="#fff" />
			</svg>
		</span>
	</a>
	<a class="edge-dock__tab edge-dock__fb" aria-label="Sovassa on Facebook"
		href="<?php echo esc_url($config['social']['Facebook']); ?>" target="_blank" rel="noopener noreferrer">
		<span class="edge-dock__label"><span>Facebook</span></span>
		<span class="edge-dock__mark">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<path fill="#fff"
					d="M14.2 20v-6.1h2.05l.3-2.38H14.2V10c0-.69.19-1.16 1.18-1.16h1.26V6.72c-.22-.03-.97-.1-1.84-.1-1.82 0-3.07 1.11-3.07 3.15v1.76H9.4v2.38h2.33V20h2.47Z" />
			</svg>
		</span>
	</a>
</div>
<a class="back-top" href="#main" aria-label="Back to top"><?php sovassa_icon('up'); ?></a>
<?php if (!is_page('get-a-quote') && !is_page('thank-you')) : ?>
<aside class="mobile-cta-bar" aria-label="Mobile quick actions">
	<a class="mobile-cta-bar__btn mobile-cta-bar__btn--whatsapp" href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer">
		<?php sovassa_icon('whatsapp'); ?>
		<span>WhatsApp</span>
	</a>
	<a class="mobile-cta-bar__btn mobile-cta-bar__btn--quote" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">
		<?php sovassa_icon('spark'); ?>
		<span>Scope Project</span>
	</a>
</aside>
<?php endif; ?>
<?php get_template_part('template-parts/components/audit-modal'); ?>
<?php wp_footer(); ?>
</body>

</html>