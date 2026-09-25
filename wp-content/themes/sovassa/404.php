<?php
/**
 * Missing pages.
 *
 * @package Sovassa
 */

get_header();
?>
<section class="page-hero">
	<div class="container">
		<?php sovassa_section_head('404', 'That page is not on this site.', 'The address may have changed. Start from the homepage or the services list.', 'h1'); ?>
		<?php sovassa_default_actions('Back to services', 'services'); ?>
	</div>
</section>
<?php
get_footer();
