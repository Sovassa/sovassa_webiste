<?php
/**
 * Legal and policy pages.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page);
?>
<section class="section">
	<div class="container container--narrow entry-list">
		<?php foreach ($page['sections'] as $section) : ?>
			<article class="plain-card">
				<h2><?php echo esc_html($section['title']); ?></h2>
				<p><?php echo esc_html($section['text']); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>
