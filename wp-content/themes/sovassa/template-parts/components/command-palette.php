<?php
/**
 * Global Command Palette (Cmd + K / Ctrl + K).
 *
 * @package Sovassa
 */
?>
<div id="command-palette" class="cmd-palette" hidden aria-hidden="true" role="dialog" aria-modal="true" aria-label="Command Palette">
	<div class="cmd-palette__backdrop" data-close-cmd></div>
	<div class="cmd-palette__window">
		<div class="cmd-palette__head">
			<span class="cmd-palette__search-icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
					<circle cx="11" cy="11" r="7"/>
					<path d="m20 20-3.5-3.5" stroke-linecap="round"/>
				</svg>
			</span>
			<input type="text" id="cmd-palette-input" class="cmd-palette__input" placeholder="Search pages, technical guides, case studies, or type an action..." autocomplete="off">
			<button type="button" class="cmd-palette__esc" data-close-cmd aria-label="Close command palette">
				<kbd>ESC</kbd>
			</button>
		</div>

		<div class="cmd-palette__body" id="cmd-palette-results">
			<!-- Quick Actions -->
			<div class="cmd-group" data-group="actions">
				<div class="cmd-group__title">⚡ Quick Actions</div>
				<a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>" class="cmd-item" data-title="Open Interactive Scope & Timeline Estimator">
					<span class="cmd-item__icon"><?php sovassa_icon('spark'); ?></span>
					<span class="cmd-item__body">
						<strong>Open Interactive Project Scope Estimator</strong>
						<small>Calculate weeks, milestone roadmaps &amp; budget tiers</small>
					</span>
					<span class="cmd-item__tag">Tool</span>
				</a>
				<button type="button" class="cmd-item" data-open-modal="audit" data-title="Request Free 15-Minute Technical Architecture Audit">
					<span class="cmd-item__icon"><?php sovassa_icon('code'); ?></span>
					<span class="cmd-item__body">
						<strong>Request 15-Minute Technical Architecture Audit</strong>
						<small>Independent code &amp; stack review from senior architect</small>
					</span>
					<span class="cmd-item__tag">Review</span>
				</button>
				<button type="button" class="cmd-item" data-open-modal="booking" data-title="Schedule 15-Minute Technical Discovery Call">
					<span class="cmd-item__icon"><?php sovassa_icon('spark'); ?></span>
					<span class="cmd-item__body">
						<strong>Schedule 15-Minute Technical Discovery Call</strong>
						<small>Meet our senior solutions engineering team · Zero sales fluff</small>
					</span>
					<span class="cmd-item__tag">Book Call</span>
				</button>
				<button type="button" class="cmd-item" id="cmd-item-copilot" data-title="Ask Sovassa AI Solutions Architect Copilot">
					<span class="cmd-item__icon"><?php sovassa_icon('spark'); ?></span>
					<span class="cmd-item__body">
						<strong>Ask Sovassa AI Solutions Architect</strong>
						<small>Interactive conversational assistant on stacks &amp; pricing</small>
					</span>
					<span class="cmd-item__tag">AI</span>
				</button>
				<a href="<?php echo esc_url(sovassa_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer" class="cmd-item" data-title="Chat on WhatsApp with Senior Team">
					<span class="cmd-item__icon"><?php sovassa_icon('whatsapp'); ?></span>
					<span class="cmd-item__body">
						<strong>Chat on WhatsApp with Senior Engineering Team</strong>
						<small>Instant technical consultation &amp; direct discussion</small>
					</span>
					<span class="cmd-item__tag">Direct</span>
				</a>
			</div>

			<!-- Core Services -->
			<div class="cmd-group" data-group="services">
				<div class="cmd-group__title">🛠️ Engineering Services</div>
				<a href="<?php echo esc_url(home_url('/web-development/')); ?>" class="cmd-item" data-title="Web Development SaaS Portals Next.js">
					<span class="cmd-item__icon"><?php sovassa_icon('code'); ?></span>
					<span class="cmd-item__body">
						<strong>Web Development &amp; SaaS Portals</strong>
						<small>Custom web platforms, Next.js, sub-second LCP</small>
					</span>
					<span class="cmd-item__tag">Service</span>
				</a>
				<a href="<?php echo esc_url(home_url('/mobile-app-development/')); ?>" class="cmd-item" data-title="Mobile App Development iOS Android Flutter React Native">
					<span class="cmd-item__icon"><?php sovassa_icon('layers'); ?></span>
					<span class="cmd-item__body">
						<strong>Mobile App Development</strong>
						<small>iOS, Android, Flutter &amp; React Native high-concurrency apps</small>
					</span>
					<span class="cmd-item__tag">Service</span>
				</a>
				<a href="<?php echo esc_url(home_url('/ai-automation/')); ?>" class="cmd-item" data-title="AI & Automation LLM Agents Pipelines">
					<span class="cmd-item__icon"><?php sovassa_icon('spark'); ?></span>
					<span class="cmd-item__body">
						<strong>AI &amp; Workflow Automation</strong>
						<small>Custom LLM agents, document pipelines, operational sync</small>
					</span>
					<span class="cmd-item__tag">Service</span>
				</a>
				<a href="<?php echo esc_url(home_url('/ui-ux-design/')); ?>" class="cmd-item" data-title="UI/UX Design Clickable Prototypes Systems">
					<span class="cmd-item__icon"><?php sovassa_icon('pen'); ?></span>
					<span class="cmd-item__body">
						<strong>UI/UX Design &amp; Clickable Prototypes</strong>
						<small>User research, Figma interactive prototypes, design systems</small>
					</span>
					<span class="cmd-item__tag">Service</span>
				</a>
			</div>

			<!-- Commercial Pillar Guides -->
			<div class="cmd-group" data-group="guides">
				<div class="cmd-group__title">📚 In-Depth Technical Architecture Guides</div>
				<a href="<?php echo esc_url(home_url('/telemedicine-app-development-guide/')); ?>" class="cmd-item" data-title="Telemedicine App Development Guide HIPAA WebRTC EHR">
					<span class="cmd-item__icon"><?php sovassa_icon('shield'); ?></span>
					<span class="cmd-item__body">
						<strong>Telemedicine App Development: Architecture &amp; HIPAA</strong>
						<small>WebRTC encrypted audio/video, FHIR/HL7 EHR &amp; cost breakdown</small>
					</span>
					<span class="cmd-item__tag">Guide</span>
				</a>
				<a href="<?php echo esc_url(home_url('/how-to-build-a-taxi-booking-app/')); ?>" class="cmd-item" data-title="How to Build a Taxi Booking App Driver Dispatch Geolocation">
					<span class="cmd-item__icon"><?php sovassa_icon('globe'); ?></span>
					<span class="cmd-item__body">
						<strong>How to Build an On-Demand Taxi Booking &amp; Dispatch App</strong>
						<small>Redis Geospatial, WebSocket driver telemetry &amp; surge pricing</small>
					</span>
					<span class="cmd-item__tag">Guide</span>
				</a>
				<a href="<?php echo esc_url(home_url('/multi-vendor-marketplace-development-guide/')); ?>" class="cmd-item" data-title="Multi-Vendor Marketplace Development Guide Escrow Stripe Connect">
					<span class="cmd-item__icon"><?php sovassa_icon('layers'); ?></span>
					<span class="cmd-item__body">
						<strong>Custom Multi-Vendor Marketplace Development Guide</strong>
						<small>Vendor onboarding, automated split escrow via Stripe Connect</small>
					</span>
					<span class="cmd-item__tag">Guide</span>
				</a>
				<a href="<?php echo esc_url(home_url('/how-much-does-it-cost-to-build-an-app/')); ?>" class="cmd-item" data-title="How Much Does It Cost to Build an App Pricing Budget">
					<span class="cmd-item__icon"><?php sovassa_icon('growth'); ?></span>
					<span class="cmd-item__body">
						<strong>How Much Does It Cost to Build an App in 2026?</strong>
						<small>Transparent pricing models, sprint milestones &amp; hidden fees</small>
					</span>
					<span class="cmd-item__tag">Guide</span>
				</a>
				<a href="<?php echo esc_url(home_url('/flutter-vs-react-native/')); ?>" class="cmd-item" data-title="Flutter vs React Native Mobile Comparison">
					<span class="cmd-item__icon"><?php sovassa_icon('code'); ?></span>
					<span class="cmd-item__body">
						<strong>Flutter vs React Native: Comprehensive Engineering Benchmark</strong>
						<small>Performance, GPU rendering, third-party libraries &amp; time-to-market</small>
					</span>
					<span class="cmd-item__tag">Guide</span>
				</a>
			</div>

			<!-- Architecture & Flagship Work -->
			<div class="cmd-group" data-group="work">
				<div class="cmd-group__title">🏆 Case Studies &amp; Architecture Explorer</div>
				<a href="<?php echo esc_url(home_url('/technologies/')); ?>" class="cmd-item" data-title="Technologies 7-Tier Architecture Explorer Stack">
					<span class="cmd-item__icon"><?php sovassa_icon('layers'); ?></span>
					<span class="cmd-item__body">
						<strong>Interactive 7-Tier Tech Stack Explorer</strong>
						<small>Explore frontend, backend, AI pipelines, databases &amp; cloud stacks</small>
					</span>
					<span class="cmd-item__tag">Architecture</span>
				</a>
				<a href="<?php echo esc_url(home_url('/work/#healthcare')); ?>" class="cmd-item" data-title="Healthcare Telehealth Case Study">
					<span class="cmd-item__icon"><?php sovassa_icon('shield'); ?></span>
					<span class="cmd-item__body">
						<strong>Telehealth &amp; Patient Booking Platform Showcase</strong>
						<small>3.2x consultation growth, -45% no-shows, HIPAA-ready</small>
					</span>
					<span class="cmd-item__tag">Case Study</span>
				</a>
				<a href="<?php echo esc_url(home_url('/work/#taxi')); ?>" class="cmd-item" data-title="Taxi Ride Hailing Case Study">
					<span class="cmd-item__icon"><?php sovassa_icon('globe'); ?></span>
					<span class="cmd-item__body">
						<strong>High-Concurrency Ride-Hailing Platform Showcase</strong>
						<small>&lt; 3s driver dispatch latency, 100k+ completed rides</small>
					</span>
					<span class="cmd-item__tag">Case Study</span>
				</a>
			</div>
		</div>

		<div class="cmd-palette__foot">
			<span class="cmd-hint"><kbd>↑</kbd><kbd>↓</kbd> to navigate</span>
			<span class="cmd-hint"><kbd>↵</kbd> to select</span>
			<span class="cmd-hint"><kbd>ESC</kbd> to dismiss</span>
		</div>
	</div>
</div>
