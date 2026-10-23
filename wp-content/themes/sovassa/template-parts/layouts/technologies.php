<?php
/**
 * Technology ecosystem.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page = $args['page'];
sovassa_page_hero($page, 'technologies', 'Abstract system layers locking into one stack.');
?>
<?php
$tech_names = array();
foreach ($page['groups'] as $group) {
	if (!empty($group['tools'])) {
		foreach ($group['tools'] as $tool) {
			$tech_names[] = $tool['name'];
		}
	} elseif (!empty($group['items'])) {
		foreach ($group['items'] as $name) {
			$tech_names[] = $name;
		}
	}
}
?>
<section class="section section--tight">
	<div class="container">
		<?php sovassa_marquee($tech_names, home_url('/technologies/')); ?>
	</div>
</section>
<section class="section tech-explorer-section">
	<div class="container">
		<div class="tech-explorer__head">
			<span class="tech-explorer__pill">Enterprise Architecture</span>
			<h2 class="tech-explorer__title">Full-Stack Capability Matrix</h2>
			<p class="tech-explorer__lede">Filter our battle-tested engineering ecosystems by tier. Every framework and platform is selected for high concurrency, memory safety, and long-term maintainability.</p>
		</div>

		<!-- Interactive Tier Filters -->
		<div class="tech-filters" data-filter-group aria-label="Technology tiers">
			<button type="button" data-filter="all" class="is-active">All Stacks</button>
			<?php foreach ($page['groups'] as $group) : 
				$filter_slug  = !empty($group['slug']) ? $group['slug'] : sanitize_title($group['title']);
				$button_label = !empty($group['short_label']) ? $group['short_label'] : $group['title'];
			?>
				<button type="button" data-filter="<?php echo esc_attr($filter_slug); ?>"><?php echo esc_html($button_label); ?></button>
			<?php endforeach; ?>
		</div>

		<!-- Architecture Groups -->
		<div class="tech-groups-list">
			<?php foreach ($page['groups'] as $idx => $group) : 
				$group_slug = !empty($group['slug']) ? $group['slug'] : sanitize_title($group['title']);
				$count = !empty($group['tools']) ? count($group['tools']) : (!empty($group['items']) ? count($group['items']) : 0);
			?>
				<article class="tech-tier-card" data-tags="<?php echo esc_attr($group_slug); ?>">
					<div class="tech-tier-card__head">
						<div class="tech-tier-card__meta">
							<span class="tech-tier-card__index">Tier 0<?php echo (int) ($idx + 1); ?></span>
							<span class="tech-tier-card__count"><?php echo esc_html($count . ' Core Technologies'); ?></span>
						</div>
						<h3 class="tech-tier-card__title"><?php echo esc_html($group['title']); ?></h3>
						<?php if (!empty($group['tagline'])) : ?>
							<p class="tech-tier-card__tagline"><?php echo esc_html($group['tagline']); ?></p>
						<?php endif; ?>
					</div>

					<div class="tech-tools-grid">
						<?php if (!empty($group['tools'])) : ?>
							<?php foreach ($group['tools'] as $tool) : ?>
								<div class="tech-tool-item">
									<div class="tech-tool-item__top">
										<h4 class="tech-tool-item__name"><?php echo esc_html($tool['name']); ?></h4>
										<?php if (!empty($tool['badge'])) : ?>
											<span class="tech-tool-item__badge"><?php echo esc_html($tool['badge']); ?></span>
										<?php endif; ?>
									</div>
									<p class="tech-tool-item__desc"><?php echo esc_html($tool['desc']); ?></p>
								</div>
							<?php endforeach; ?>
						<?php elseif (!empty($group['items'])) : ?>
							<?php foreach ($group['items'] as $item) : ?>
								<div class="tech-tool-item">
									<h4 class="tech-tool-item__name"><?php echo esc_html($item); ?></h4>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section class="section section--tint">
	<div class="container split split--together">
		<div>
			<?php sovassa_section_head('The stack', 'Engineering tools chosen for longevity.', 'Every technology we select is battle-tested for high concurrency, security, and developer maintainability. No fragile dependencies. 100% IP ownership.'); ?>
			<div class="btn-group">
				<a class="btn btn--primary" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Estimate Tech Stack <?php sovassa_icon('arrow'); ?></a>
				<a class="btn btn--ghost" href="<?php echo esc_url(home_url('/work/')); ?>">See Stack in Action</a>
			</div>
		</div>
		<?php sovassa_page_still('technologies', 'Interface tiles, connected blocks, screens, and a cloud joined as one system.'); ?>
	</div>
</section>
