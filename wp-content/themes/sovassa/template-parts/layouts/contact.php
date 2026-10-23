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
	<div class="container split split--contact">
		<div class="contact-panel">
			<?php sovassa_section_head('Business details', 'Where to reach us.', $config['contact_note']); ?>
			<div class="contact-panel__section">
				<h3 class="contact-subhead">HEADQUARTERS</h3>
				<div class="contact-channels">
					<div class="contact-details">
						<?php if (!empty($config['office'])) : ?>
							<div class="contact-item contact-item--address">
								<span class="contact-item__icon" aria-hidden="true"><?php sovassa_icon('pin'); ?></span>
								<div class="contact-item__body">
									<strong class="contact-item__title"><?php echo esc_html($config['name']); ?></strong>
									<p class="contact-item__text"><?php echo esc_html($config['office']); ?></p>
								</div>
							</div>
						<?php endif; ?>

						<div class="contact-item">
							<span class="contact-item__icon" aria-hidden="true"><?php sovassa_icon('mail'); ?></span>
							<div class="contact-item__body">
								<a class="contact-item__link" href="<?php echo esc_url('mailto:' . $config['email']); ?>">
									<?php echo esc_html($config['email']); ?>
								</a>
							</div>
						</div>

						<div class="contact-item">
							<span class="contact-item__icon" aria-hidden="true"><?php sovassa_icon('phone'); ?></span>
							<div class="contact-item__body">
								<a class="contact-item__link" href="<?php echo esc_url('tel:' . $config['phone']); ?>">
									<?php echo esc_html($config['phone_display']); ?>
								</a>
							</div>
						</div>

						<div class="contact-item">
							<span class="contact-item__icon contact-item__icon--wa" aria-hidden="true"><?php sovassa_icon('whatsapp'); ?></span>
							<div class="contact-item__body">
								<a class="contact-item__link" href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo esc_html($config['phone_display']); ?> <span class="contact-item__tag">WhatsApp</span>
								</a>
							</div>
						</div>
					</div>

					<?php
					$social = isset($config['social']) && is_array($config['social']) ? array_filter($config['social']) : array();
					if ($social) :
					?>
						<div class="contact-social">
							<ul class="contact-social__list">
								<?php foreach ($social as $label => $url) : ?>
									<?php if (!is_string($url) || '' === $url) continue; ?>
									<li>
										<a class="contact-social__link" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer">
											<span class="contact-social__icon" aria-hidden="true">
												<?php sovassa_icon(strtolower((string) $label)); ?>
											</span>
											<span class="contact-social__label"><?php echo esc_html((string) $label); ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php if (!empty($config['maps_url'])) : ?>
				<div class="contact-panel__section contact-map-section">
					<div class="contact-map-header">
						<h3 class="contact-subhead">SOVASSA ON GOOGLE MAPS</h3>
						<a class="contact-map-link" href="<?php echo esc_url($config['maps_url']); ?>" target="_blank" rel="noopener noreferrer">
							<span>Open in Maps</span>
							<svg viewBox="0 0 24 24" class="icon icon--sm" aria-hidden="true" focusable="false" style="width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2;"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
						</a>
					</div>
					<div class="contact-map-frame">
						<iframe
							src="<?php echo esc_url(!empty($config['maps_embed_url']) ? $config['maps_embed_url'] : 'https://maps.google.com/maps?cid=9043817202557150845&output=embed'); ?>"
							width="100%"
							height="210"
							style="border:0;"
							allowfullscreen=""
							loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"
							title="Sovassa Technologies Location Map">
						</iframe>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="contact-form-wrap">
			<div class="contact-booking-callout">
				<div class="contact-booking-callout__text">
					<span class="contact-booking-callout__badge"><?php sovassa_icon('spark'); ?> Fast Track</span>
					<h3>Prefer a 15-minute direct engineering call?</h3>
					<p>Book a slot directly with our senior solutions engineering team.</p>
				</div>
				<button type="button" class="btn btn--secondary btn--sm" data-open-modal="booking">
					<span>Schedule Discovery Call</span>
					<?php sovassa_icon('arrow'); ?>
				</button>
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
	</div>
</section>
