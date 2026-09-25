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
	<section class="cta-band">
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
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="Sovassa Technologies" width="126" height="96">
			</a>
			<p>Sovassa Technologies helps companies build digital products and market them as one connected effort.</p>
			<p class="footer-note"><?php echo esc_html($config['tagline']); ?></p>
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
			<a href="<?php echo esc_url(home_url('/copyright/')); ?>">Copyright / DMCA</a>
			<a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Free consultation</a>
		</nav>
	</div>
</footer>
<a class="back-top" href="#main">Top</a>
<?php wp_footer(); ?>
</body>
</html>
