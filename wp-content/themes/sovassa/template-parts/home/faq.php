<?php
/**
 * Homepage FAQ with live search and category filtering.
 * The same items feed the FAQPage structured data in inc/seo.php.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$items = $args['page']['faq'];

// Extract unique categories
$categories = array();
foreach ($items as $item) {
	if (!empty($item['cat']) && !in_array($item['cat'], $categories, true)) {
		$categories[] = $item['cat'];
	}
}
?>
<section class="hp-band hp-band--mist hp-faq-section" id="faq" aria-labelledby="hp-faq-title">
	<div class="hp-wrap">
		<?php sovassa_home_head('FAQ', 'Questions, answered plainly.', 'Everything you need to know about how we scope, build, deliver, and support.', 'hp-faq-title'); ?>

		<div class="hp-faq-toolbar" data-faq-toolbar>
			<div class="hp-faq-search">
				<svg class="icon hp-faq-search__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/>
					<path d="m20 20-3.5-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				</svg>
				<input
					class="hp-faq-search__input"
					id="hp-faq-search-input"
					type="search"
					placeholder="Search questions by keyword (e.g. cost, timeline, ownership, scope)..."
					aria-label="Search frequently asked questions"
					autocomplete="off">
				<button class="hp-faq-search__clear" id="hp-faq-search-clear" type="button" aria-label="Clear search" hidden>&times;</button>
			</div>

			<div class="hp-faq-filters" role="tablist" aria-label="FAQ categories">
				<button class="hp-faq-pill is-active" type="button" role="tab" data-filter="all" aria-selected="true">
					All Questions <span class="hp-faq-pill__count"><?php echo esc_html((string) count($items)); ?></span>
				</button>
				<?php foreach ($categories as $cat) : 
					$cat_count = 0;
					foreach ($items as $it) {
						if (isset($it['cat']) && $it['cat'] === $cat) $cat_count++;
					}
				?>
					<button class="hp-faq-pill" type="button" role="tab" data-filter="<?php echo esc_attr($cat); ?>" aria-selected="false">
						<?php echo esc_html($cat); ?> <span class="hp-faq-pill__count"><?php echo esc_html((string) $cat_count); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="hp-faq" id="hp-faq-list" data-faq-accordion>
			<?php foreach ($items as $i => $item) : 
				$cat = !empty($item['cat']) ? $item['cat'] : 'General';
			?>
				<details class="hp-faq__item" data-category="<?php echo esc_attr($cat); ?>"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary>
						<span class="hp-faq__q-block">
							<span class="hp-faq__category-badge"><?php echo esc_html($cat); ?></span>
							<span class="hp-faq__question"><?php echo esc_html($item['q']); ?></span>
						</span>
						<span class="hp-faq__indicator" aria-hidden="true">
							<svg class="icon icon--plus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
						</span>
					</summary>
					<div class="hp-faq__content">
						<p><?php echo esc_html($item['a']); ?></p>
					</div>
				</details>
			<?php endforeach; ?>

			<div class="hp-faq__empty" id="hp-faq-empty" hidden>
				<div class="hp-faq__empty-icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" class="icon" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
				</div>
				<h3>No questions matched your search</h3>
				<p>We couldn't find an answer matching "<span id="hp-faq-search-query"></span>". Have a specific question regarding your project scope or timeline?</p>
				<div class="hp-faq__empty-actions">
					<a class="hp-btn hp-btn--teal" href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer">Chat on WhatsApp</a>
					<a class="hp-btn hp-btn--ghost" href="<?php echo esc_url(home_url('/contact/')); ?>">Ask Us a Question</a>
				</div>
			</div>
		</div>
	</div>
</section>
