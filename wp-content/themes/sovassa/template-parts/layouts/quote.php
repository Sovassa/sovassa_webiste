<?php
/**
 * Consultation / quote page.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page   = $args['page'];
$config = sovassa_config();
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container">
		<?php sovassa_section_head('After you submit', 'What happens next.', 'We read the brief before we suggest a meeting.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['after'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint" id="quote">
	<div class="container split">
		<div>
			<?php sovassa_section_head('The brief', 'Enough detail for a useful reply.', 'Budget is optional. A clear objective matters more.'); ?>
			<p class="note">What you send stays in a private enquiry. We use it to respond, as described in the privacy note.</p>
			<p>Prefer the shorter form? <a href="<?php echo esc_url(home_url('/contact/')); ?>">Send a message</a> instead. <?php echo esc_html($config['contact_note']); ?></p>
		</div>
		<form class="form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<?php sovassa_form_notice(); ?>
			<?php sovassa_form_hidden('quote'); ?>
			<label><span>What do you want to achieve?</span><input type="text" name="objective" required></label>
			<fieldset>
				<legend class="field-label">Services you think you need</legend>
				<div class="checks">
					<?php foreach ($page['services'] as $service) : ?>
						<label class="check"><input type="checkbox" name="services[]" value="<?php echo esc_attr($service); ?>"><span><?php echo esc_html($service); ?></span></label>
					<?php endforeach; ?>
				</div>
			</fieldset>
			<label><span>Current website or product</span><input type="url" name="website" placeholder="https://"></label>
			<div class="form-grid">
				<label>
					<span>Timeline</span>
					<select name="timeline">
						<?php foreach ($page['timelines'] as $option) : ?>
							<option><?php echo esc_html($option); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<label>
					<span>Budget</span>
					<select name="budget">
						<?php foreach ($page['budgets'] as $option) : ?>
							<option><?php echo esc_html($option); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</div>
			<div class="form-grid">
				<label><span>Name</span><input type="text" name="name" required autocomplete="name"></label>
				<label><span>Email</span><input type="email" name="email" required autocomplete="email"></label>
				<label><span>Phone</span><input type="tel" name="phone" autocomplete="tel"></label>
				<label><span>Company</span><input type="text" name="company" autocomplete="organization"></label>
			</div>
			<label><span>Anything else</span><textarea name="message"></textarea></label>
			<?php sovassa_consent_field(); ?>
			<button class="btn btn--primary" type="submit">Request consultation</button>
		</form>
	</div>
</section>
