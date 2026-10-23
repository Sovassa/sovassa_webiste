<?php
/**
 * Direct Calendar Booking Modal (Cal.com / 1-Click Discovery Scheduler).
 *
 * @package Sovassa
 */
?>
<div id="booking-modal" class="booking-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="booking-modal-title">
	<div class="booking-modal__backdrop" data-close-modal="booking"></div>
	<div class="booking-modal__dialog">
		<button type="button" class="booking-modal__close" data-close-modal="booking" aria-label="Close booking scheduler">
			<svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
				<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
			</svg>
		</button>
		
		<div class="booking-modal__header">
			<span class="booking-modal__pill"><?php sovassa_icon('spark'); ?> Direct Engineering Discovery</span>
			<h2 id="booking-modal-title">Schedule a 15-Minute Technical Discovery Call</h2>
			<p>Pick a time to meet directly with our senior solutions engineering team. Zero sales fluff—just practical architecture, feasibility, and sprint timeline discussions.</p>
		</div>

		<!-- Direct 1-Click Form / Slot Picker -->
		<form class="booking-modal__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="booking-form">
			<?php sovassa_form_hidden('audit'); ?>
			<input type="hidden" name="service" value="15-Minute Calendar Discovery Call">

			<div class="booking-form__grid">
				<div class="form-field">
					<label for="booking-name">Your Full Name <abbr title="Required">*</abbr></label>
					<input type="text" id="booking-name" name="name" required placeholder="e.g. Jordan Smith" autocomplete="name">
				</div>

				<div class="form-field">
					<label for="booking-email">Work Email <abbr title="Required">*</abbr></label>
					<input type="email" id="booking-email" name="email" required placeholder="jordan@company.com" autocomplete="email">
				</div>

				<div class="form-field">
					<label for="booking-time">Preferred Call Time Window <abbr title="Required">*</abbr></label>
					<select id="booking-time" name="timeline" required>
						<option value="Today / Tomorrow (Fast Track)">⚡ Today / Tomorrow (Fast Track)</option>
						<option value="This Week (Morning Slot 9am-12pm)">This Week (Morning Slot 9am–12pm)</option>
						<option value="This Week (Afternoon Slot 1pm-5pm)">This Week (Afternoon Slot 1pm–5pm)</option>
						<option value="Next Week">Next Week</option>
					</select>
				</div>

				<div class="form-field">
					<label for="booking-phone">Phone or WhatsApp <small>(For invite ping)</small></label>
					<input type="tel" id="booking-phone" name="phone" placeholder="+1 (555) 000-0000" autocomplete="tel">
				</div>

				<div class="form-field form-field--full">
					<label for="booking-message">What is the core focus of your project? <abbr title="Required">*</abbr></label>
					<textarea id="booking-message" name="message" rows="2" required placeholder="e.g. Web platform MVP, Telehealth video consultation, or mobile app dispatch..."></textarea>
				</div>

				<div class="form-field form-field--full">
					<label class="check">
						<input type="checkbox" name="consent" value="1" required checked>
						<span>I agree to Sovassa scheduling this technical discovery session. Read our <a href="<?php echo esc_url(home_url('/privacy/')); ?>">privacy policy</a>.</span>
					</label>
				</div>
			</div>

			<div class="booking-modal__footer">
				<button type="submit" class="btn btn--primary booking-submit-btn">
					<span>Confirm My 15-Minute Discovery Slot</span>
					<?php sovassa_icon('arrow'); ?>
				</button>
				<div class="booking-modal__alt">
					<span>Prefer immediate discussion?</span>
					<a href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer" class="booking-whatsapp-link">
						<?php sovassa_icon('whatsapp'); ?>
						<strong>Instant WhatsApp Connect</strong>
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
