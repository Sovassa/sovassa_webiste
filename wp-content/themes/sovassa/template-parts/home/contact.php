<?php
/**
 * Closing call to action with a working enquiry form.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$section  = $args['page']['contact'];
$config   = sovassa_config();
$contact  = sovassa_page('contact');
$services = ($contact && !empty($contact['services'])) ? $contact['services'] : array();
?>
<section class="hp-band hp-band--dark" id="contact" aria-labelledby="hp-contact-title">
	<div class="hp-wrap hp-final">
		<div>
			<span class="hp-pill hp-pill--dark"><?php echo esc_html($section['eyebrow']); ?></span>
			<h2 id="hp-contact-title"><?php echo esc_html($section['title']); ?></h2>
			<p class="hp-final__text"><?php echo esc_html($section['text']); ?></p>
			<ul class="hp-final__lines">
				<li><span>Email</span><a href="<?php echo esc_url('mailto:' . $config['email']); ?>"><?php echo esc_html($config['email']); ?></a></li>
				<li><span>Phone and WhatsApp</span><a href="<?php echo esc_url('tel:' . $config['phone']); ?>"><?php echo esc_html($config['phone_display']); ?></a></li>
			</ul>
		</div>
		<form class="hp-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<h3><?php echo esc_html($section['form']); ?></h3>
			<?php sovassa_form_notice(); ?>
			<?php sovassa_form_hidden('contact'); ?>
			<div class="hp-form__row">
				<label for="hp-f-name">Name<input id="hp-f-name" type="text" name="name" required autocomplete="name" placeholder="Your name"></label>
				<label for="hp-f-email">Email<input id="hp-f-email" type="email" name="email" required autocomplete="email" placeholder="you@company.com"></label>
			</div>
			<label for="hp-f-service">Service
				<select id="hp-f-service" name="service">
					<option value="">Not sure yet</option>
					<?php foreach ($services as $service) : ?>
						<option><?php echo esc_html($service); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label for="hp-f-message">Project details<textarea id="hp-f-message" name="message" required placeholder="What are you trying to change?"></textarea></label>
			<?php sovassa_consent_field(); ?>
			<button class="hp-btn hp-btn--teal" type="submit">Send my request</button>
		</form>
	</div>
</section>
