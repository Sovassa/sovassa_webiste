<?php
/**
 * Interior pages, routed by slug to a layout.
 *
 * @package Sovassa
 */

get_header();
$page = sovassa_current_page();
if ($page && !empty($page['layout']) && 'home' !== $page['layout']) {
	get_template_part(
		'template-parts/layouts/' . $page['layout'],
		null,
		array('page' => $page)
	);
} elseif (have_posts()) {
	while (have_posts()) {
		the_post();
		echo '<article class="section"><div class="container">';
		the_title('<h1>', '</h1>');
		the_content();
		echo '</div></article>';
	}
} else {
	echo '<section class="section"><div class="container"><h1>Page not found</h1></div></section>';
}
get_footer();
