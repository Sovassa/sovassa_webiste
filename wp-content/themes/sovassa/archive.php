<?php
/**
 * Category and archive views.
 *
 * @package Sovassa
 */

get_header();
?>
<section class="page-hero">
	<div class="container">
		<?php sovassa_breadcrumbs(); ?>
		<?php sovassa_section_head('Insights', wp_strip_all_tags(get_the_archive_title()), 'Writing filed under this topic.', 'h1'); ?>
	</div>
</section>
<section class="section">
	<div class="container post-grid">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php sovassa_post_card(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<p>Nothing in this category yet.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
