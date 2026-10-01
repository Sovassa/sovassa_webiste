<?php
/**
 * Closing call to action and footer.
 *
 * @package Sovassa
 */

$config = sovassa_config();
$quiet  = is_page('thank-you');
?>
</main>
<?php if (!$quiet) : ?>
	<section class="cta-band cta-band--finale">
		<div class="container cta-band__inner">
			<div>
				<p class="eyebrow eyebrow--light"><span class="eyebrow__line" aria-hidden="true"></span> Start a conversation</p>
				<h2>Bring your next project into focus.</h2>
				<p>Book a consultation or send the brief you already have. We will reply with a clear next step.</p>
			</div>
			<div class="actions">
				<a class="btn btn--primary" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a Free Consultation <?php sovassa_icon('arrow'); ?></a>
				<a class="btn btn--inverse" href="<?php echo esc_url(home_url('/contact/')); ?>">Send us a message</a>
			</div>
		</div>
	</section>
<?php endif; ?>
<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="site-footer__brand">
			<a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png?ver=' . SOVASSA_VERSION); ?>" alt="Sovassa Technologies" width="690" height="537">
			</a>
			<p>Sovassa Technologies helps companies build digital products and market them as one connected effort.</p>
			<p class="footer-note"><?php echo esc_html($config['tagline']); ?></p>
			<?php
			$social = isset($config['social']) && is_array($config['social']) ? array_filter($config['social']) : array();
			if ($social) :
				?>
				<ul class="social-links">
					<?php foreach ($social as $label => $url) : ?>
						<?php if (!is_string($url) || '' === $url) { continue; } ?>
						<li>
							<a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr((string) $label); ?>">
								<?php sovassa_icon(strtolower((string) $label)); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div>
			<h2>Company</h2>
			<ul>
				<li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
				<li><a href="<?php echo esc_url(home_url('/work/')); ?>">Case Studies</a></li>
				<li><a href="<?php echo esc_url(home_url('/careers/')); ?>">Careers</a></li>
				<li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
			</ul>
		</div>
		<div>
			<h2>Build</h2>
			<ul>
				<li><a href="<?php echo esc_url(home_url('/web-development/')); ?>">Web Development</a></li>
				<li><a href="<?php echo esc_url(home_url('/mobile-app-development/')); ?>">Mobile Apps</a></li>
				<li><a href="<?php echo esc_url(home_url('/ai-automation/')); ?>">AI &amp; Automation</a></li>
				<li><a href="<?php echo esc_url(home_url('/ui-ux-design/')); ?>">UI/UX Design</a></li>
			</ul>
		</div>
		<div>
			<h2>Market</h2>
			<ul>
				<li><a href="<?php echo esc_url(home_url('/seo/')); ?>">SEO</a></li>
				<li><a href="<?php echo esc_url(home_url('/digital-marketing/')); ?>">Digital Marketing</a></li>
				<li><a href="<?php echo esc_url(home_url('/social-media-marketing/')); ?>">Social Media</a></li>
				<li><a href="<?php echo esc_url(home_url('/google-ads/')); ?>">Google Ads</a></li>
				<li><a href="<?php echo esc_url(home_url('/content-marketing/')); ?>">Content Marketing</a></li>
			</ul>
		</div>
		<div>
			<h2>Contact</h2>
			<ul class="footer-contact">
				<li><span>Phone</span> <a href="<?php echo esc_url('tel:' . $config['phone']); ?>"><?php echo esc_html($config['phone_display']); ?></a></li>
				<li><span>WhatsApp</span> <a href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($config['phone_display']); ?></a></li>
				<li><span>Email</span> <a href="<?php echo esc_url('mailto:' . $config['email']); ?>"><?php echo esc_html($config['email']); ?></a></li>
				<li><span>Office</span> <?php echo esc_html($config['office']); ?></li>
			</ul>
		</div>
	</div>
	<div class="container site-footer__trust">
		<a class="dmca-badge" href="https://www.dmca.com/Protection/Status.aspx?ID=174838c6-23a6-4eeb-9552-041177438471" title="DMCA.com Protection Status" target="_blank" rel="noopener noreferrer">
			<img src="https://images.dmca.com/Badges/dmca-badge-w250-2x1-02.png?ID=174838c6-23a6-4eeb-9552-041177438471" alt="DMCA.com Protection Status" width="160" height="80">
		</a>
	</div>
	<div class="container site-footer__base">
		<p>&copy; <?php echo esc_html(gmdate('Y')); ?> Sovassa Technologies. All rights reserved.</p>
		<nav aria-label="Legal">
			<a href="<?php echo esc_url(home_url('/privacy/')); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url(home_url('/terms/')); ?>">Terms &amp; Conditions</a>
			<a href="<?php echo esc_url(home_url('/cookies/')); ?>">Cookie Policy</a>
			<button class="cookie-settings" type="button" data-cookie-settings>Cookie settings</button>
			<a href="<?php echo esc_url(home_url('/copyright/')); ?>">Copyright / DMCA</a>
			<a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Free consultation</a>
		</nav>
	</div>
</footer>
<form class="cookie-bar" id="cookie-bar" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
	<?php wp_nonce_field('sovassa_cookie', 'sovassa_cookie_nonce'); ?>
	<input type="hidden" name="action" value="sovassa_cookie">
	<p>Essential cookies stay on. Analytics stays off until you accept it. <a href="<?php echo esc_url(home_url('/cookies/')); ?>">Cookie policy</a></p>
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
<div class="edge-dock">
	<a class="edge-dock__phone" href="<?php echo esc_url('tel:' . $config['phone']); ?>" aria-label="Call <?php echo esc_attr($config['phone_display']); ?>">
		<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M7 3.8h2.4l1.3 3.2-1.6 1a12 12 0 0 0 5.9 5.9l1-1.6 3.2 1.3V16a2 2 0 0 1-2.2 2A15.5 15.5 0 0 1 6 6a2 2 0 0 1 1-2.2Z"/></svg>
	</a>
	<a class="edge-dock__tab edge-dock__chat" href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer">
		<span class="edge-dock__label"><span>Chat With Us</span></span>
		<span class="edge-dock__mark">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="none" stroke="#111" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" d="M12 4.4a7.1 7.1 0 0 0-6.1 10.7L5.2 19l4.1-.9A7.1 7.1 0 1 0 12 4.4Z"/><path fill="none" stroke="#111" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" d="M9.3 10.1c.15 1.35 1.25 2.55 2.6 3.05.35.12.6 0 .75-.28l.35-.6c.1-.18.28-.2.46-.12l1.05.45c.18.08.28.26.2.44-.2.7-.78 1.2-1.48 1.28-1.4.1-3.3-1.05-4.15-2.7-.85-1.55-.5-2.95.1-3.6.28-.32.7-.42 1.05-.32.16.04.28.12.36.26l.5.95c.08.16.02.34-.1.46l-.32.32c-.12.14-.1.34.06.5Z"/></svg>
		</span>
	</a>
	<a class="edge-dock__tab edge-dock__ig" href="<?php echo esc_url($config['social']['Instagram']); ?>" target="_blank" rel="noopener noreferrer">
		<span class="edge-dock__label"><span>Instagram</span></span>
		<span class="edge-dock__mark">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4.5" y="4.5" width="15" height="15" rx="4" fill="none" stroke="#fff" stroke-width="1.7"/><circle cx="12" cy="12" r="3.4" fill="none" stroke="#fff" stroke-width="1.7"/><circle cx="16.6" cy="7.5" r="0.9" fill="#fff"/></svg>
		</span>
	</a>
	<a class="edge-dock__tab edge-dock__fb" href="<?php echo esc_url($config['social']['Facebook']); ?>" target="_blank" rel="noopener noreferrer">
		<span class="edge-dock__label"><span>Facebook</span></span>
		<span class="edge-dock__mark">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="#fff" d="M14.2 20v-6.1h2.05l.3-2.38H14.2V10c0-.69.19-1.16 1.18-1.16h1.26V6.72c-.22-.03-.97-.1-1.84-.1-1.82 0-3.07 1.11-3.07 3.15v1.76H9.4v2.38h2.33V20h2.47Z"/></svg>
		</span>
	</a>
</div>
<a class="back-top" href="#main" aria-label="Back to top"><?php sovassa_icon('up'); ?></a>
<?php wp_footer(); ?>
</body>
</html>
