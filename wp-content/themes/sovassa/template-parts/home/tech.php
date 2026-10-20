<?php
/**
 * Tools strip.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$tools = $args['page']['tech'];
?>
<section class="hp-band hp-band--tight" aria-labelledby="hp-tech-title">
	<div class="hp-wrap">
		<div class="hp-head hp-head--small">
			<span class="hp-pill">Technology</span>
			<h2 id="hp-tech-title">Tools we work with every day</h2>
		</div>
		<ul class="hp-tech">
			<?php foreach ($tools as $tool) : ?>
				<li><?php echo esc_html($tool); ?></li>
			<?php endforeach; ?>
		</ul>
		<p class="hp-tech__more"><a class="text-link" href="<?php echo esc_url(sovassa_url('technologies')); ?>">See our full stack <?php sovassa_icon('arrow'); ?></a></p>
	</div>
</section>
