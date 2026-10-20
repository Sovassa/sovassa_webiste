<?php
/**
 * Homepage FAQ. The same items feed the FAQPage structured data in inc/seo.php.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$items = $args['page']['faq'];
?>
<section class="hp-band" aria-labelledby="hp-faq-title">
	<div class="hp-wrap">
		<?php sovassa_home_head('FAQ', 'Questions, answered plainly.', '', 'hp-faq-title'); ?>
		<div class="hp-faq">
			<?php foreach ($items as $i => $item) : ?>
				<details<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary><?php echo esc_html($item['q']); ?></summary>
					<p><?php echo esc_html($item['a']); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
