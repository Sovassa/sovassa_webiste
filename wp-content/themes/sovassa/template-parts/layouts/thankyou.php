<?php
/**
 * Thank-you state after a form submission.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
$sent = isset($_GET['sent']) ? sanitize_key(wp_unslash($_GET['sent'])) : '';
$copy = isset($page['messages'][$sent]) ? $page['messages'][$sent] : $page['intro'];
?>
<section class="page-hero">
	<div class="container">
		<?php sovassa_section_head($page['eyebrow'], $page['title'], $copy, 'h1'); ?>
		<div class="actions">
			<a class="btn btn--primary" href="<?php echo esc_url(home_url('/')); ?>">Back to the homepage</a>
			<a class="btn btn--ghost" href="<?php echo esc_url(home_url('/insights/')); ?>">Read insights</a>
		</div>
	</div>
</section>
