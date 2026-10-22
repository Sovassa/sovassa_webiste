<?php
/**
 * Interactive Performance & Modernization Comparison Slider.
 * Demonstrates legacy generic builds vs. Sovassa engineered architecture.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */
?>
<section class="hp-band hp-compare-section" id="benchmark" aria-labelledby="hp-compare-title">
	<div class="hp-wrap">
		<?php
		sovassa_home_head(
			'Engineering Benchmark',
			'Legacy generic stack vs. Sovassa high-performance build',
			'Drag the slider to compare real-world performance, user retention, and architectural standards.',
			'hp-compare-title'
		);
		?>

		<div class="hp-compare-presets" role="group" aria-label="Comparison quick views">
			<button type="button" class="hp-compare-preset-btn" data-compare-set="10">View Legacy Stack</button>
			<button type="button" class="hp-compare-preset-btn is-active" data-compare-set="50">Split 50 / 50</button>
			<button type="button" class="hp-compare-preset-btn" data-compare-set="90">View Sovassa Stack</button>
		</div>

		<div class="hp-compare" data-compare-widget>
			<div class="hp-compare__screen" id="hp-compare-screen">
				<!-- Legacy Stack Pane (Background) -->
				<div class="hp-compare__pane hp-compare__pane--before" aria-hidden="true">
					<div class="hp-compare__inner">
						<div class="hp-compare__header">
							<span class="hp-compare__badge hp-compare__badge--danger">
								<span class="hp-compare__dot hp-compare__dot--danger"></span>
								Outdated Generic / Legacy Stack
							</span>
							<span class="hp-compare__tagline">Bloated plugins, fragile code, sluggish mobile UX</span>
						</div>

						<div class="hp-compare__metrics">
							<div class="hp-compare__metric hp-compare__metric--danger">
								<span class="hp-compare__metric-num">5.4s</span>
								<span class="hp-compare__metric-label">Largest Contentful Paint</span>
								<span class="hp-compare__metric-sub">Failing Core Web Vitals</span>
							</div>
							<div class="hp-compare__metric hp-compare__metric--danger">
								<span class="hp-compare__metric-num">34 / 100</span>
								<span class="hp-compare__metric-label">Lighthouse Mobile Score</span>
								<span class="hp-compare__metric-sub">Significant search penalty</span>
							</div>
							<div class="hp-compare__metric hp-compare__metric--danger">
								<span class="hp-compare__metric-num">4.8 MB</span>
								<span class="hp-compare__metric-label">Asset Weight & Scripts</span>
								<span class="hp-compare__metric-sub">72 unminified HTTP requests</span>
							</div>
							<div class="hp-compare__metric hp-compare__metric--danger">
								<span class="hp-compare__metric-num">1.2%</span>
								<span class="hp-compare__metric-label">Lead Conversion Rate</span>
								<span class="hp-compare__metric-sub">40%+ visitors bounce early</span>
							</div>
						</div>

						<div class="hp-compare__features">
							<div class="hp-compare__feature hp-compare__feature--bad">
								<span class="hp-compare__icon">✕</span>
								<span>Fragmented third-party plugins with frequent breaking updates</span>
							</div>
							<div class="hp-compare__feature hp-compare__feature--bad">
								<span class="hp-compare__icon">✕</span>
								<span>Brittle spaghetti JavaScript causing unpredictable mobile crashes</span>
							</div>
							<div class="hp-compare__feature hp-compare__feature--bad">
								<span class="hp-compare__icon">✕</span>
								<span>Zero CI/CD automation, manual FTP deployments, no test coverage</span>
							</div>
							<div class="hp-compare__feature hp-compare__feature--bad">
								<span class="hp-compare__icon">✕</span>
								<span>Vendor lock-in with closed proprietary modules</span>
							</div>
						</div>
					</div>
				</div>

				<!-- Sovassa Engineered Pane (Clipped Overlay) -->
				<div class="hp-compare__pane hp-compare__pane--after" id="hp-compare-after" style="width: 50%;">
					<div class="hp-compare__inner">
						<div class="hp-compare__header">
							<span class="hp-compare__badge hp-compare__badge--success">
								<span class="hp-compare__dot hp-compare__dot--success"></span>
								Sovassa High-Performance Architecture
							</span>
							<span class="hp-compare__tagline">Clean semantic code, sub-second paints, engineered conversions</span>
						</div>

						<div class="hp-compare__metrics">
							<div class="hp-compare__metric hp-compare__metric--success">
								<span class="hp-compare__metric-num">0.78s</span>
								<span class="hp-compare__metric-label">Largest Contentful Paint</span>
								<span class="hp-compare__metric-sub">100% Green Core Web Vitals</span>
							</div>
							<div class="hp-compare__metric hp-compare__metric--success">
								<span class="hp-compare__metric-num">99 / 100</span>
								<span class="hp-compare__metric-label">Lighthouse Mobile Score</span>
								<span class="hp-compare__metric-sub">SEO & ranking competitive edge</span>
							</div>
							<div class="hp-compare__metric hp-compare__metric--success">
								<span class="hp-compare__metric-num">134 KB</span>
								<span class="hp-compare__metric-label">Asset Weight & Scripts</span>
								<span class="hp-compare__metric-sub">Modern zero-bloat vanilla pipeline</span>
							</div>
							<div class="hp-compare__metric hp-compare__metric--success">
								<span class="hp-compare__metric-num">3.8x</span>
								<span class="hp-compare__metric-label">Pipeline Conversion Rate</span>
								<span class="hp-compare__metric-sub">Sub-second interactive engagement</span>
							</div>
						</div>

						<div class="hp-compare__features">
							<div class="hp-compare__feature hp-compare__feature--good">
								<span class="hp-compare__icon">✓</span>
								<span>Modern semantic architecture built for maximum speed and longevity</span>
							</div>
							<div class="hp-compare__feature hp-compare__feature--good">
								<span class="hp-compare__icon">✓</span>
								<span>Edge-cached assets with sub-second time-to-first-byte (TTFB)</span>
							</div>
							<div class="hp-compare__feature hp-compare__feature--good">
								<span class="hp-compare__icon">✓</span>
								<span>Automated CI/CD pipelines, regression testing, and security headers</span>
							</div>
							<div class="hp-compare__feature hp-compare__feature--good">
								<span class="hp-compare__icon">✓</span>
								<span>100% intellectual property ownership with clear, documented code</span>
							</div>
						</div>
					</div>
				</div>

				<!-- Draggable Divider Line & Thumb -->
				<div class="hp-compare__divider" id="hp-compare-divider" style="left: 50%;">
					<div class="hp-compare__thumb" aria-hidden="true">
						<svg viewBox="0 0 24 24" class="icon" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="8 7 3 12 8 17"></polyline>
							<polyline points="16 7 21 12 16 17"></polyline>
						</svg>
					</div>
					<div class="hp-compare__line"></div>
				</div>

				<!-- Accessible Range Control (Touch & Keyboard) -->
				<input
					class="hp-compare__range"
					id="hp-compare-range"
					type="range"
					min="0"
					max="100"
					value="50"
					step="1"
					aria-label="Comparison slider: Drag left to inspect Sovassa architecture, drag right for legacy stack">
			</div>

			<div class="hp-compare__hint">
				<span>← Drag slider or tap presets above to compare →</span>
			</div>
		</div>

		<div class="hp-compare__cards hp-rise">
			<div class="hp-compare__card">
				<div class="hp-compare__card-icon">⚡</div>
				<h3>Sub-Second Speed</h3>
				<p>Instant page loads decrease bounce rates and dramatically improve Google quality scores for organic search and paid ads.</p>
			</div>
			<div class="hp-compare__card">
				<div class="hp-compare__card-icon">🔒</div>
				<h3>100% IP & Code Ownership</h3>
				<p>Your team owns every asset, repository, and custom module. Zero proprietary lock-in or licensing surprises.</p>
			</div>
			<div class="hp-compare__card">
				<div class="hp-compare__card-icon">🚀</div>
				<h3>Engineered for Scale</h3>
				<p>Decoupled, modular code architecture designed to scale seamlessly from 1,000 to over 1,000,000 active monthly visitors.</p>
			</div>
		</div>

		<div class="hp-compare__banner">
			<div class="hp-compare__banner-content">
				<h3>Curious how your current website scores?</h3>
				<p>We provide a complimentary, in-depth architectural audit highlighting speed bottlenecks, security vulnerabilities, and conversion opportunities.</p>
			</div>
			<div class="hp-compare__banner-actions">
				<a class="hp-btn hp-btn--teal" href="<?php echo esc_url(home_url('/contact/#enquiry')); ?>">Request Free Audit</a>
				<a class="hp-btn hp-btn--ghost" href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer">Chat on WhatsApp</a>
			</div>
		</div>
	</div>
</section>
