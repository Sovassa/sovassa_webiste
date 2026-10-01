<?php
/**
 * Search results.
 *
 * @package Sovassa
 */

get_header();
?>
<section class="page-hero">
	<div class="container">
		<?php
		$query = get_search_query();
		sovassa_section_head('Search', '' !== $query ? 'Results for “' . $query . '”' : 'Search the site', 'Pages and insights.', 'h1');
		?>
	</div>
</section>
<section class="section">
	<div class="container entry-list">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="plain-card">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p>Nothing matched that search. Try a service name, or <a href="<?php echo esc_url(home_url('/contact/')); ?>">send a message</a>.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
