<?php
/**
 * Consultation / Interactive Quote Estimator page.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$page   = $args['page'];
$config = sovassa_config();
sovassa_page_hero($page);
?>
<section class="section section--tight">
	<div class="container">
		<div class="feature-frame">
			<?php sovassa_page_still('contact', 'Two interface panels joined by a single path.'); ?>
		</div>
	</div>
</section>

<!-- Interactive Project Scope & Timeline Estimator -->
<section class="section section--tint" id="quote">
	<div class="container quote-estimator-layout">
		<div class="quote-estimator__main">
			<div class="estimator-header">
				<span class="estimator-pill">Interactive Scope Calculator</span>
				<h2>Configure Your Project Scope</h2>
				<p>Select your platform and required architectural modules to instantly calculate an estimated delivery window, roadmap milestones, and scope tier.</p>
			</div>

			<!-- Step 1: Select Platform / Track -->
			<div class="estimator-step">
				<div class="estimator-step__head">
					<span class="step-num">1</span>
					<div>
						<h3 class="estimator-step__title">Select Your Primary Platform</h3>
						<p class="estimator-step__subtitle">Choose the core product discipline you want to start with:</p>
					</div>
				</div>
				<div class="track-cards" role="radiogroup" aria-label="Select Platform">
					<button type="button" class="track-card is-active" data-track="web" role="radio" aria-checked="true">
						<span class="track-card__icon"><?php sovassa_icon('code'); ?></span>
						<span class="track-card__body">
							<strong class="track-card__title">Web Platform</strong>
							<span class="track-card__desc">SaaS frontends, custom portals, high-conversion sites</span>
						</span>
						<span class="track-card__check"><?php sovassa_icon('check'); ?></span>
					</button>

					<button type="button" class="track-card" data-track="app" role="radio" aria-checked="false">
						<span class="track-card__icon"><?php sovassa_icon('layers'); ?></span>
						<span class="track-card__body">
							<strong class="track-card__title">Mobile Application</strong>
							<span class="track-card__desc">iOS, Android, native & Flutter cross-platform apps</span>
						</span>
						<span class="track-card__check"><?php sovassa_icon('check'); ?></span>
					</button>

					<button type="button" class="track-card" data-track="ai" role="radio" aria-checked="false">
						<span class="track-card__icon"><?php sovassa_icon('spark'); ?></span>
						<span class="track-card__body">
							<strong class="track-card__title">AI & Automation</strong>
							<span class="track-card__desc">Custom LLM agents, document pipelines, workflows</span>
						</span>
						<span class="track-card__check"><?php sovassa_icon('check'); ?></span>
					</button>

					<button type="button" class="track-card" data-track="ux" role="radio" aria-checked="false">
						<span class="track-card__icon"><?php sovassa_icon('pen'); ?></span>
						<span class="track-card__body">
							<strong class="track-card__title">UI/UX & Product Design</strong>
							<span class="track-card__desc">User journeys, clickable prototypes, design systems</span>
						</span>
						<span class="track-card__check"><?php sovassa_icon('check'); ?></span>
					</button>

					<button type="button" class="track-card" data-track="growth" role="radio" aria-checked="false">
						<span class="track-card__icon"><?php sovassa_icon('growth'); ?></span>
						<span class="track-card__body">
							<strong class="track-card__title">Full-Funnel Growth & SEO</strong>
							<span class="track-card__desc">Organic rankings, paid search ads, conversion lift</span>
						</span>
						<span class="track-card__check"><?php sovassa_icon('check'); ?></span>
					</button>
				</div>
			</div>

			<!-- Step 2: Architecture & Capabilities -->
			<div class="estimator-step">
				<div class="estimator-step__head">
					<span class="step-num">2</span>
					<div>
						<h3 class="estimator-step__title">Core Architectural Modules</h3>
						<p class="estimator-step__subtitle">Select anticipated functional modules (we adapt these during our review):</p>
					</div>
				</div>
				<div class="feature-chips" role="group" aria-label="Feature Scope">
					<button type="button" class="feature-chip" data-feature="auth" data-weeks="1" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">User Auth & Role Security</span>
					</button>
					<button type="button" class="feature-chip" data-feature="payments" data-weeks="1" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">Payment Gateway & Subscriptions</span>
					</button>
					<button type="button" class="feature-chip" data-feature="dashboard" data-weeks="1.5" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">Custom Admin Dashboard</span>
					</button>
					<button type="button" class="feature-chip" data-feature="api" data-weeks="1" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">REST / GraphQL Custom APIs</span>
					</button>
					<button type="button" class="feature-chip" data-feature="multilingual" data-weeks="0.5" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">Multilingual & Currency Localization</span>
					</button>
					<button type="button" class="feature-chip" data-feature="realtime" data-weeks="1" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">Real-Time Chat & Push Alerts</span>
					</button>
					<button type="button" class="feature-chip" data-feature="crm" data-weeks="0.5" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">CRM & Marketing Tool Sync</span>
					</button>
					<button type="button" class="feature-chip" data-feature="performance" data-weeks="0.5" aria-pressed="false">
						<span class="feature-chip__box"><?php sovassa_icon('check'); ?></span>
						<span class="feature-chip__text">Enterprise Speed & SEO Tuning</span>
					</button>
				</div>
			</div>

			<!-- Step 3: Target Launch Timeline -->
			<div class="estimator-step">
				<div class="estimator-step__head">
					<span class="step-num">3</span>
					<div>
						<h3 class="estimator-step__title">Target Launch Horizon</h3>
						<p class="estimator-step__subtitle">When are you aiming to go live?</p>
					</div>
				</div>
				<div class="horizon-options" role="radiogroup" aria-label="Target Launch Horizon">
					<button type="button" class="horizon-btn" data-horizon="urgent" role="radio" aria-checked="false">
						⚡ Fast-Track MVP (< 4–6 Wks)
					</button>
					<button type="button" class="horizon-btn is-active" data-horizon="standard" role="radio" aria-checked="true">
						🎯 Standard Build (6–10 Wks)
					</button>
					<button type="button" class="horizon-btn" data-horizon="enterprise" role="radio" aria-checked="false">
						🗓️ Comprehensive (2–4 Mos)
					</button>
					<button type="button" class="horizon-btn" data-horizon="planning" role="radio" aria-checked="false">
						🧭 Exploring Ahead
					</button>
				</div>
			</div>

			<!-- Step 4: Submission Form -->
			<form class="form estimator-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="quote-form">
				<?php sovassa_form_notice(); ?>
				<?php sovassa_form_hidden('quote'); ?>
				
				<!-- Hidden synced fields -->
				<input type="hidden" name="timeline" id="quote-timeline-input" value="This quarter">
				<input type="hidden" name="budget" id="quote-budget-input" value="A defined project">
				<div id="hidden-services-container">
					<input type="checkbox" name="services[]" value="Web development" checked style="display:none;">
				</div>

				<div class="estimator-step estimator-step--form">
					<div class="estimator-step__head">
						<span class="step-num">4</span>
						<div>
							<h3 class="estimator-step__title">Project Brief & Contact Information</h3>
							<p class="estimator-step__subtitle">A senior engineer reviews your brief and replies within 1 business day.</p>
						</div>
					</div>

					<div class="form-fields">
						<label>
							<span>What do you want to achieve? *</span>
							<input type="text" name="objective" id="quote-objective" required placeholder="e.g. Build a high-converting web platform with payment integration" value="<?php echo esc_attr(isset($_GET['brief']) ? sanitize_text_field(wp_unslash($_GET['brief'])) : ''); ?>">
						</label>

						<label>
							<span>Current website or competitor reference (optional)</span>
							<input type="url" name="website" placeholder="https://yourproduct.com">
						</label>

						<div class="form-grid">
							<label><span>Your Name *</span><input type="text" name="name" required autocomplete="name" placeholder="Full name"></label>
							<label><span>Work Email *</span><input type="email" name="email" required autocomplete="email" placeholder="name@company.com"></label>
							<label><span>Phone Number</span><input type="tel" name="phone" autocomplete="tel" placeholder="+91 or +1 phone"></label>
							<label><span>Company Name</span><input type="text" name="company" autocomplete="organization" placeholder="Company or project name"></label>
						</div>

						<label>
							<span>Additional notes or questions (optional)</span>
							<textarea name="message" placeholder="Tell us anything else: existing codebase, design references, target users, or key deadlines..."></textarea>
						</label>

						<?php sovassa_consent_field(); ?>

						<div class="estimator-form__actions">
							<button class="btn btn--primary btn--large" type="submit" id="quote-submit-btn">
								<span>Request Scope & Free Consultation</span>
								<?php sovassa_icon('arrow'); ?>
							</button>
							<p class="form-reassurance">
								<?php sovassa_icon('shield'); ?>
								<span>Strictly private. We reply with a substantive evaluation, never high-pressure sales sequences.</span>
							</p>
						</div>
					</div>
				</div>
			</form>
		</div>

		<!-- Live Sticky Estimator Summary Card -->
		<aside class="quote-estimator__aside">
			<div class="estimator-card" id="estimator-card">
				<div class="estimator-card__header">
					<span class="estimator-card__live-indicator"></span>
					<span class="estimator-card__badge">Live Estimate</span>
				</div>

				<div class="estimator-card__section">
					<span class="estimator-card__label">Estimated Delivery Horizon</span>
					<div class="estimator-card__metric" id="est-timeline-val">4 – 6 Weeks</div>
					<div class="estimator-card__sub" id="est-milestones-val">3 sprint milestones with working demos</div>
				</div>

				<div class="estimator-card__divider"></div>

				<div class="estimator-card__section">
					<span class="estimator-card__label">Recommended Scope Tier</span>
					<div class="estimator-card__tier" id="est-tier-val">Foundation MVP</div>
					<div class="estimator-card__features-count" id="est-features-val">0 Core Modules Selected</div>
				</div>

				<div class="estimator-card__divider"></div>

				<div class="estimator-card__breakdown">
					<span class="estimator-card__label">Included In Every Engagement</span>
					<ul class="estimator-perks">
						<li>
							<span class="perk-icon"><?php sovassa_icon('check'); ?></span>
							<span>Working software demo at each milestone</span>
						</li>
						<li>
							<span class="perk-icon"><?php sovassa_icon('check'); ?></span>
							<span>Full source code & asset ownership</span>
						</li>
						<li>
							<span class="perk-icon"><?php sovassa_icon('check'); ?></span>
							<span>Direct senior engineering point of contact</span>
						</li>
						<li>
							<span class="perk-icon"><?php sovassa_icon('check'); ?></span>
							<span>30-day post-launch warranty & bug fixes</span>
						</li>
					</ul>
				</div>

				<div class="estimator-card__footer">
					<p class="estimator-card__direct-note">Prefer direct consultation?</p>
					<a href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener" class="estimator-whatsapp">
						<?php sovassa_icon('whatsapp'); ?>
						<span>WhatsApp Senior Team</span>
					</a>
				</div>
			</div>
		</aside>
	</div>
</section>

<!-- What Happens After You Submit -->
<section class="section">
	<div class="container">
		<?php sovassa_section_head('After you submit', 'What happens next.', 'We read the brief before we suggest a meeting.'); ?>
		<div class="card-grid card-grid--3">
			<?php foreach ($page['after'] as $item) : ?>
				<article class="plain-card">
					<h3><?php echo esc_html($item['title']); ?></h3>
					<p><?php echo esc_html($item['text']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
