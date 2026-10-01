<?php
/**
 * Careers.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'careers', 'Separate work panels joining into one piece of work.');
?>
<section class="section">
	<div class="container card-grid card-grid--3">
		<?php foreach ($page['why'] as $item) : ?>
			<article class="plain-card">
				<h3><?php echo esc_html($item['title']); ?></h3>
				<p><?php echo esc_html($item['text']); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Teams', 'Where a new person would sit.', ''); ?>
		<div class="card-grid card-grid--2">
			<?php foreach ($page['teams'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('Open roles', 'None are listed yet.', 'There is no active vacancy on this page. A general introduction is welcome if your work fits the teams above.'); ?>
			<p class="note">We will replace this note with specific roles, locations, and closing dates when a hire is actually open.</p>
		</div>
		<?php sovassa_page_still('careers', 'Glowing interface panels linked into one piece of work.'); ?>
	</div>
</section>
<section class="section section--tint">
	<div class="container">
		<?php sovassa_section_head('Culture', 'How the team is expected to work.', ''); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['culture'] as $item) : ?>
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
		<?php sovassa_section_head('What we can say about working here', 'Only the parts that are already true.', ''); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['benefits'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php sovassa_process($page['process'], 'Hiring', 'What happens after you write to us.', ''); ?>
<section class="section" id="apply">
	<div class="container split">
		<div>
			<?php sovassa_section_head('Introduce yourself', 'A short note is enough.', 'Tell us the work you want to do. We will reply if there is a conversation worth having.'); ?>
		</div>
		<form class="form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<?php sovassa_form_notice(); ?>
			<?php sovassa_form_hidden('application'); ?>
			<div class="form-grid">
				<label><span>Name</span><input type="text" name="name" required autocomplete="name"></label>
				<label><span>Email</span><input type="email" name="email" required autocomplete="email"></label>
			</div>
			<label><span>Work you want to do</span><input type="text" name="service" required></label>
			<label><span>Note</span><textarea name="message" required></textarea></label>
			<?php sovassa_consent_field(); ?>
			<button class="btn btn--primary" type="submit">Send introduction</button>
		</form>
	</div>
</section>
<?php sovassa_faq($page['faq']); ?>
