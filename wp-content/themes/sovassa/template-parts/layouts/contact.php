<?php
/**
 * Contact page.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page   = $args['page'];
$config = sovassa_config();
sovassa_page_hero($page);
?>
<section class="section" id="enquiry">
	<div class="container split">
		<div>
			<?php sovassa_section_head('Business details', 'Where to reach us.', $config['contact_note']); ?>
			<ul class="checklist">
				<li><strong>Phone</strong> <a href="<?php echo esc_url('tel:' . $config['phone']); ?>"><?php echo esc_html($config['phone_display']); ?></a></li>
				<li><strong>Email</strong> <a href="<?php echo esc_url('mailto:' . $config['email']); ?>"><?php echo esc_html($config['email']); ?></a></li>
				<li><strong>Office</strong> <?php echo esc_html($config['office']); ?></li>
				<li><strong>Channels</strong> Phone, email, and this form are the ways we reply. Social profiles will be linked here when the company accounts are live.</li>
			</ul>
		</div>
		<form class="form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<?php sovassa_form_notice(); ?>
			<?php sovassa_form_hidden('contact'); ?>
			<div class="form-grid">
				<label><span>Name</span><input type="text" name="name" required autocomplete="name"></label>
				<label><span>Email</span><input type="email" name="email" required autocomplete="email"></label>
				<label><span>Phone</span><input type="tel" name="phone" autocomplete="tel"></label>
				<label><span>Company</span><input type="text" name="company" autocomplete="organization"></label>
			</div>
			<label>
				<span>Service</span>
				<select name="service">
					<option value="">Select a service</option>
					<?php foreach ($page['services'] as $service) : ?>
						<option><?php echo esc_html($service); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<div class="form-grid">
				<label><span>Timeline</span><input type="text" name="timeline" placeholder="For example, this quarter"></label>
				<label><span>Budget range</span><input type="text" name="budget" placeholder="Optional"></label>
			</div>
			<label><span>Project note</span><textarea name="message" required placeholder="What are you trying to change?"></textarea></label>
			<?php sovassa_consent_field(); ?>
			<button class="btn btn--primary" type="submit">Send message</button>
		</form>
	</div>
</section>
