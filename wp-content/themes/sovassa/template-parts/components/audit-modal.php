<?php
/**
 * Technical Architecture Audit Modal / Slide-Out.
 *
 * @package Sovassa
 */
?>
<div id="audit-modal" class="audit-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="audit-modal-title">
	<div class="audit-modal__backdrop" data-close-modal="audit"></div>
	<div class="audit-modal__dialog">
		<button type="button" class="audit-modal__close" data-close-modal="audit" aria-label="Close audit request form">
			<svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
				<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
			</svg>
		</button>
		
		<div class="audit-modal__header">
			<span class="audit-modal__pill"><?php sovassa_icon('spark'); ?> 15-Minute Engineering Review</span>
			<h2 id="audit-modal-title">Request a Free Technical Architecture Audit</h2>
			<p>Speak directly with a senior solutions architect to evaluate your technical roadmap, code feasibility, cloud infrastructure, or MVP timeline with zero sales pressure.</p>
		</div>

		<form class="audit-modal__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="audit-form">
			<?php sovassa_form_hidden('audit'); ?>

			<div class="audit-form__grid">
				<div class="form-field">
					<label for="audit-name">Your Name <abbr title="Required">*</abbr></label>
					<input type="text" id="audit-name" name="name" required placeholder="e.g. Alex Miller" autocomplete="name">
				</div>

				<div class="form-field">
					<label for="audit-email">Work Email <abbr title="Required">*</abbr></label>
					<input type="email" id="audit-email" name="email" required placeholder="alex@company.com" autocomplete="email">
				</div>

				<div class="form-field">
					<label for="audit-phone">Phone / WhatsApp <small>(Optional)</small></label>
					<input type="tel" id="audit-phone" name="phone" placeholder="+1 (555) 000-0000" autocomplete="tel">
				</div>

				<div class="form-field">
					<label for="audit-website">Website or App URL <small>(If live)</small></label>
					<input type="url" id="audit-website" name="website" placeholder="https://example.com" autocomplete="url">
				</div>

				<div class="form-field form-field--full">
					<label for="audit-focus">Primary Bottleneck / Review Focus</label>
					<select id="audit-focus" name="service">
						<option value="New Product / MVP Architecture">New Product / MVP Architecture &amp; Scope</option>
						<option value="Code Performance &amp; Speed Optimization">Performance, Speed &amp; LCP Optimization</option>
						<option value="Mobile App Strategy (iOS / Android)">Mobile App Architecture (Flutter / React Native / Native)</option>
						<option value="AI &amp; Workflow Automation Pipeline">AI Integration &amp; Automation Workflows</option>
						<option value="Cloud Scaling, Database &amp; Security">Cloud Scaling, Database &amp; API Security</option>
						<option value="Full Architecture &amp; Code Review">Full Tech Stack &amp; Code Quality Review</option>
					</select>
				</div>

				<div class="form-field form-field--full">
					<label for="audit-message">Brief Note on What You Need Evaluated <abbr title="Required">*</abbr></label>
					<textarea id="audit-message" name="message" rows="3" required placeholder="Tell us a little about your project, current stack, or the key challenge you want reviewed..."></textarea>
				</div>

				<div class="form-field form-field--full audit-form__consent">
					<label class="check">
						<input type="checkbox" name="consent" value="1" required checked>
						<span>I agree that Sovassa Technologies can use these details to respond to this technical audit request. Read our <a href="<?php echo esc_url(home_url('/privacy/')); ?>">privacy policy</a>.</span>
					</label>
				</div>
			</div>

			<div class="audit-modal__footer">
				<button type="submit" class="btn btn--primary audit-submit-btn">
					<span>Request My Free 15-Min Audit</span>
					<?php sovassa_icon('arrow'); ?>
				</button>
				<p class="audit-modal__guarantee">🔒 Confidential &amp; NDA protected · No sales pitch · Direct engineer reply within 24h</p>
			</div>
		</form>
	</div>
</div>
