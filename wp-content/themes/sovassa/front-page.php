<?php
/**
 * Front page.
 *
 * @package Sovassa
 */

get_header();
get_template_part(
	'template-parts/layouts/home',
	null,
	array('page' => sovassa_page('home'))
);
get_footer();
