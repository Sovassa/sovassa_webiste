<?php
/**
 * Homepage layout. Each section lives in template-parts/home/.
 *
 * Proof sections (clients, stats, case studies, testimonials) render only when
 * the 'proof' block in inc/content/company.php holds real, approved content.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];

$sections = array('hero', 'clients', 'stats', 'services', 'industries', 'cases', 'process', 'why', 'models', 'testimonials', 'tech', 'insights', 'faq', 'contact');
foreach ($sections as $section) {
	get_template_part('template-parts/home/' . $section, null, array('page' => $page));
}
