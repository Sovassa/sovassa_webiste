<?php
/**
 * Fallback loop.
 *
 * @package Sovassa
 */

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
