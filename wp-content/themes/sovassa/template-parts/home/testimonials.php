<?php
/**
 * Client testimonials. Hidden until real, attributed quotes are listed.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$quotes = $args['page']['proof']['testimonials'];
if (!$quotes) {
	return;
}
?>
<section class="hp-band" aria-labelledby="hp-quotes-title">
	<div class="hp-wrap">
		<?php sovassa_home_head('Client stories', 'What clients say about working with us.', '', 'hp-quotes-title'); ?>
		<div class="hp-quotes hp-rise">
			<?php foreach ($quotes as $quote) : ?>
				<figure class="hp-quote">
					<blockquote><p>“<?php echo esc_html($quote['quote']); ?>”</p></blockquote>
					<figcaption class="hp-who">
						<?php if (!empty($quote['photo'])) : ?>
							<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $quote['photo']); ?>" alt="" width="44" height="44" loading="lazy">
						<?php else : ?>
							<i aria-hidden="true"><?php echo esc_html(strtoupper(substr($quote['name'], 0, 1))); ?></i>
						<?php endif; ?>
						<span><b><?php echo esc_html($quote['name']); ?></b><?php echo esc_html($quote['role']); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
