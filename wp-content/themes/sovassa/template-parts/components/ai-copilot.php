<?php
/**
 * Sovassa AI Solutions Architect - Interactive Copilot Widget.
 *
 * @package Sovassa
 */
?>
<!-- Sovassa AI Copilot Floating Launcher -->
<div id="sovassa-ai-copilot" class="ai-copilot" aria-label="Sovassa AI Solutions Architect">
	<button id="ai-copilot-trigger" class="ai-copilot__trigger" type="button" aria-expanded="false"
		aria-controls="ai-copilot-drawer" aria-label="Open Sovassa AI Solutions Architect Assistant">
		<span class="ai-copilot__halo" aria-hidden="true"></span>
		<span class="ai-copilot__icon">
			<svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
				<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
					d="M12 3v4M12 17v4M4.9 6.5l2.8 2.8M16.3 14.7l2.8 2.8M3 12h4M17 12h4M4.9 17.5l2.8-2.8M16.3 9.3l2.8-2.8" />
			</svg>
		</span>
		<span class="ai-copilot__label">
			<strong>Ask Sovassa</strong>
		</span>
	</button>

	<!-- Conversational Glassmorphism Drawer -->
	<div id="ai-copilot-drawer" class="ai-copilot__drawer" hidden aria-hidden="true" role="dialog" aria-modal="true"
		aria-labelledby="ai-copilot-title">
		<div class="ai-copilot__header">
			<div class="ai-copilot__profile">
				<div class="ai-copilot__avatar">
					<svg viewBox="0 0 24 24" aria-hidden="true" width="22" height="22">
						<path fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
							d="M12 2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2 2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zM4 11a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8zM9 16h6" />
					</svg>
				</div>
				<div>
					<h3 id="ai-copilot-title" class="ai-copilot__name">Sovassa AI Solutions Architect</h3>
					<p class="ai-copilot__status"><span class="ai-copilot__dot"></span> Active · 2026 Production
						Intelligence</p>
				</div>
			</div>
			<button type="button" class="ai-copilot__close" id="ai-copilot-close" aria-label="Close AI Assistant">
				<svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18">
					<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
						d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<div class="ai-copilot__body" id="ai-copilot-messages">
			<!-- Welcoming Message -->
			<div class="ai-msg ai-msg--bot">
				<div class="ai-msg__content">
					<p>Hello! I am Sovassa's <strong>AI Solutions Architect</strong>. Whether you need stack
						recommendations, MVP pricing breakdowns, or want to explore our 4-stage sprint delivery, ask me
						anything below.</p>
				</div>
			</div>

			<!-- Prompt Suggestions -->
			<div class="ai-copilot__chips" id="ai-copilot-chips">
				<button type="button" class="ai-chip" data-query="mvp_cost">⚡ MVP Cost &amp; Timelines</button>
				<button type="button" class="ai-chip" data-query="booking">📅 Book 15-Min Discovery Call</button>
				<button type="button" class="ai-chip" data-query="telehealth">🏥 Telemedicine Architecture</button>
				<button type="button" class="ai-chip" data-query="taxi">🚕 Taxi Dispatch Stack</button>
				<button type="button" class="ai-chip" data-query="marketplace">🛍️ Multi-Vendor Escrow</button>
				<button type="button" class="ai-chip" data-query="process">🛠️ 4-Stage Sprint Blueprint</button>
				<button type="button" class="ai-chip" data-query="audit">📋 Free 15-Min Architecture Audit</button>
			</div>
		</div>

		<!-- Chat Input Bar -->
		<form class="ai-copilot__footer" id="ai-copilot-form">
			<input type="text" id="ai-copilot-input" class="ai-copilot__input"
				placeholder="Ask about stacks, costs, or architectures..." autocomplete="off">
			<button type="submit" class="ai-copilot__send" aria-label="Send question">
				<svg viewBox="0 0 24 24" aria-hidden="true" width="16" height="16">
					<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
						stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
				</svg>
			</button>
		</form>
	</div>
</div>