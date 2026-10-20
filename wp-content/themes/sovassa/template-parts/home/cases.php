<?php
/**
 * Case studies with tabs. Hidden until real, client-approved case studies are listed.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$cases = $args['page']['proof']['cases'];
if (!$cases) {
	return;
}
?>
<section class="hp-band hp-band--dark" id="work" aria-labelledby="hp-cases-title">
	<div class="hp-wrap">
		<?php sovassa_home_head('Case studies', 'Projects, and what changed after.', 'Each case shows the problem, what we built, and the numbers that moved.', 'hp-cases-title'); ?>
		<div class="hp-tabs hp-tabs--pills" role="tablist" aria-label="Case studies">
			<?php foreach ($cases as $i => $case) : ?>
				<button class="hp-ctab" type="button" role="tab" id="hp-case-tab-<?php echo (int) $i; ?>" aria-controls="hp-case-<?php echo (int) $i; ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"<?php echo 0 === $i ? '' : ' tabindex="-1"'; ?>><?php echo esc_html($case['tab']); ?></button>
			<?php endforeach; ?>
		</div>
		<?php foreach ($cases as $i => $case) : ?>
			<article class="hp-case" role="tabpanel" id="hp-case-<?php echo (int) $i; ?>" aria-labelledby="hp-case-tab-<?php echo (int) $i; ?>"<?php echo 0 === $i ? '' : ' hidden'; ?>>
				<div>
					<span class="hp-case__tag"><?php echo esc_html($case['tag']); ?></span>
					<h3><?php echo esc_html($case['title']); ?></h3>
					<p class="hp-case__text"><?php echo esc_html($case['text']); ?></p>
					<?php if (!empty($case['metrics'])) : ?>
						<div class="hp-metrics">
							<?php foreach ($case['metrics'] as $metric) : ?>
								<div><b><?php echo esc_html($metric[0]); ?></b><span><?php echo esc_html($metric[1]); ?></span></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<?php if (!empty($case['url'])) : ?>
						<a class="hp-btn hp-btn--teal" href="<?php echo esc_url($case['url']); ?>">Read the case study</a>
					<?php endif; ?>
				</div>
				<div class="hp-case__shot"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $case['image']); ?>" alt="<?php echo esc_attr($case['title']); ?>" loading="lazy"></div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
