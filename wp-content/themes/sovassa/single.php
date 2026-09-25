<?php
/**
 * Single insight.
 *
 * @package Sovassa
 */

get_header();
while (have_posts()) :
	the_post();
	$categories = get_the_category();
	?>
	<article class="page-hero article">
		<div class="container container--narrow">
			<?php sovassa_breadcrumbs(); ?>
			<p class="eyebrow"><span class="eyebrow__line" aria-hidden="true"></span> <?php echo esc_html($categories ? $categories[0]->name : 'Insight'); ?></p>
			<h1><?php the_title(); ?></h1>
			<p class="lede"><?php echo esc_html(get_the_excerpt()); ?></p>
			<img class="wide-visual" src="<?php echo esc_url(sovassa_insight_image_uri()); ?>" alt="" width="1280" height="720">
		</div>
	</article>
	<div class="section section--tight">
		<div class="container container--narrow article__body">
			<?php the_content(); ?>
			<p><a class="text-link" href="<?php echo esc_url(home_url('/insights/')); ?>">Back to insights <?php sovassa_icon('arrow'); ?></a></p>
		</div>
	</div>
	<?php
endwhile;
get_footer();
