<?php
/**
 * Posts index and fallback loop.
 *
 * The posts index is the Insights page. The front page stays on front-page.php.
 *
 * @package Sovassa
 */

$insights = sovassa_page('insights');
if (is_home() && !is_front_page() && $insights) {
	get_header();
	get_template_part(
		'template-parts/layouts/insights',
		null,
		array('page' => $insights)
	);
	get_footer();
	return;
}

get_header();
?>
<section class="page-hero">
	<div class="container">
		<?php sovassa_section_head('Insights', 'Latest writing', 'Notes from the Sovassa team.', 'h1'); ?>
	</div>
</section>
<section class="section">
	<div class="container post-grid">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php sovassa_post_card(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<p>No posts yet.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
