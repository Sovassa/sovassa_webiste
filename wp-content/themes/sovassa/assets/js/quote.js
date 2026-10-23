/**
 * Interactive Project Scope & Timeline Estimator.
 *
 * @package Sovassa
 */
(function () {
	'use strict';

	var estimator = document.querySelector('.quote-estimator-layout');
	if (!estimator) return;

	var tracks = {
		web: {
			name: 'Web Platform',
			serviceName: 'Web development',
			minWeeks: 4,
			maxWeeks: 6,
			defaultTier: 'Foundation MVP',
			milestones: '3 sprint milestones with working demos'
		},
		app: {
			name: 'Mobile Application',
			serviceName: 'Mobile apps',
			minWeeks: 6,
			maxWeeks: 10,
			defaultTier: 'Product MVP',
			milestones: '4 sprint milestones with weekly TestFlight/APK builds'
		},
		ai: {
			name: 'AI & Automation',
			serviceName: 'AI and automation',
			minWeeks: 3,
			maxWeeks: 6,
			defaultTier: 'Automation Suite',
			milestones: '3 sprint milestones with model evaluation & integration'
		},
		ux: {
			name: 'UI/UX & Product Design',
			serviceName: 'UI/UX design',
			minWeeks: 2,
			maxWeeks: 4,
			defaultTier: 'Design Sprint',
			milestones: '2 sprint milestones with clickable Figma prototypes'
		},
		growth: {
			name: 'Full-Funnel Growth & SEO',
			serviceName: 'SEO',
			minWeeks: 4,
			maxWeeks: 8,
			defaultTier: 'Growth Retainer',
			milestones: 'Monthly growth sprints with transparent reporting'
		}
	};

	var featureNames = {
		auth: 'User Auth & Role Security',
		payments: 'Payment Gateway & Billing',
		dashboard: 'Custom Admin Dashboard',
		api: 'Custom REST / GraphQL APIs',
		multilingual: 'Multilingual & Localization',
		realtime: 'Real-Time Chat & Alerts',
		crm: 'CRM & Marketing Tool Sync',
		performance: 'Enterprise Speed & SEO Tuning'
	};

	var state = {
		track: 'web',
		features: [],
		horizon: 'standard'
	};

	var trackBtns = estimator.querySelectorAll('.track-card');
	var featureBtns = estimator.querySelectorAll('.feature-chip');
	var horizonBtns = estimator.querySelectorAll('.horizon-btn');

	var elTimeline = document.getElementById('est-timeline-val');
	var elMilestones = document.getElementById('est-milestones-val');
	var elTier = document.getElementById('est-tier-val');
	var elFeatures = document.getElementById('est-features-val');

	var inputTimeline = document.getElementById('quote-timeline-input');
	var inputBudget = document.getElementById('quote-budget-input');
	var servicesContainer = document.getElementById('hidden-services-container');
	var inputObjective = document.getElementById('quote-objective');
	var form = document.getElementById('quote-form');

	function recalculate() {
		var currentTrack = tracks[state.track] || tracks.web;
		var addedWeeks = 0;

		featureBtns.forEach(function (btn) {
			if (state.features.indexOf(btn.dataset.feature) !== -1) {
				addedWeeks += parseFloat(btn.dataset.weeks || 0.5);
			}
		});

		var minW = Math.round(currentTrack.minWeeks + addedWeeks * 0.75);
		var maxW = Math.round(currentTrack.maxWeeks + addedWeeks);

		if (state.horizon === 'urgent') {
			minW = Math.max(2, Math.round(minW * 0.75));
			maxW = Math.max(3, Math.round(maxW * 0.8));
		} else if (state.horizon === 'enterprise') {
			minW = Math.round(minW * 1.25);
			maxW = Math.round(maxW * 1.35);
		}

		var timelineStr = minW + ' – ' + maxW + ' Weeks';
		if (state.track === 'growth') {
			timelineStr = minW + ' – ' + maxW + ' Weeks (Agile Sprint)';
		}

		// Tier determination
		var tier = currentTrack.defaultTier;
		if (state.features.length >= 4 || state.horizon === 'enterprise') {
			tier = 'Enterprise Custom Build';
		} else if (state.features.length >= 2) {
			tier = 'Production Scale';
		}

		// Update UI elements with smooth transitions
		if (elTimeline) elTimeline.textContent = timelineStr;
		if (elMilestones) elMilestones.textContent = currentTrack.milestones;
		if (elTier) elTier.textContent = tier;
		if (elFeatures) {
			var count = state.features.length;
			elFeatures.textContent = count === 0
				? '0 Core Modules Selected'
				: (count === 1 ? '1 Architecture Module Included' : count + ' Architecture Modules Included');
		}

		// Sync hidden inputs
		if (inputTimeline) {
			var horizonLabels = {
				urgent: 'As soon as possible',
				standard: 'This quarter',
				enterprise: 'This half',
				planning: 'Planning ahead'
			};
			inputTimeline.value = horizonLabels[state.horizon] || 'This quarter';
		}

		if (inputBudget) {
			inputBudget.value = tier;
		}

		// Sync hidden services checkboxes
		if (servicesContainer) {
			var servicesHtml = '<input type="checkbox" name="services[]" value="' + currentTrack.serviceName + '" checked style="display:none;">';
			if (state.track === 'growth') {
				servicesHtml += '<input type="checkbox" name="services[]" value="Digital marketing" checked style="display:none;">';
			}
			state.features.forEach(function (f) {
				if (featureNames[f]) {
					servicesHtml += '<input type="checkbox" name="services[]" value="' + featureNames[f] + '" checked style="display:none;">';
				}
			});
			servicesContainer.innerHTML = servicesHtml;
		}
	}

	// Track selection
	trackBtns.forEach(function (btn) {
		btn.addEventListener('click', function () {
			trackBtns.forEach(function (b) {
				b.classList.remove('is-active');
				b.setAttribute('aria-checked', 'false');
			});
			btn.classList.add('is-active');
			btn.setAttribute('aria-checked', 'true');
			state.track = btn.dataset.track;
			recalculate();
			if (typeof window.sovassaTrack === 'function') {
				var currentTrack = tracks[state.track] || tracks.web;
				window.sovassaTrack('estimator_track_selected', {
					event_category: 'Estimator',
					track_id: state.track,
					track_name: currentTrack.name
				});
			}
		});
	});

	// Feature selection
	featureBtns.forEach(function (btn) {
		btn.addEventListener('click', function () {
			var feature = btn.dataset.feature;
			var idx = state.features.indexOf(feature);
			var action = 'add';
			if (idx === -1) {
				state.features.push(feature);
				btn.classList.add('is-active');
				btn.setAttribute('aria-pressed', 'true');
				action = 'add';
			} else {
				state.features.splice(idx, 1);
				btn.classList.remove('is-active');
				btn.setAttribute('aria-pressed', 'false');
				action = 'remove';
			}
			recalculate();
			if (typeof window.sovassaTrack === 'function') {
				window.sovassaTrack('estimator_module_toggled', {
					event_category: 'Estimator',
					module_id: feature,
					module_name: featureNames[feature] || feature,
					action: action,
					total_selected: state.features.length
				});
			}
		});
	});

	// Horizon selection
	horizonBtns.forEach(function (btn) {
		btn.addEventListener('click', function () {
			horizonBtns.forEach(function (b) {
				b.classList.remove('is-active');
				b.setAttribute('aria-checked', 'false');
			});
			btn.classList.add('is-active');
			btn.setAttribute('aria-checked', 'true');
			state.horizon = btn.dataset.horizon;
			recalculate();
			if (typeof window.sovassaTrack === 'function') {
				window.sovassaTrack('estimator_horizon_selected', {
					event_category: 'Estimator',
					horizon: state.horizon
				});
			}
		});
	});

	// Enforce objective clarity & track lead generation attempt on submit
	if (form && inputObjective) {
		form.addEventListener('submit', function () {
			var currentTrack = tracks[state.track] || tracks.web;
			var featuresSummary = state.features.length > 0
				? state.features.map(function (f) { return featureNames[f] || f; }).join(', ')
				: 'Standard core foundation';

			var customText = inputObjective.value.trim();
			var calculatedNote = ' [Selected: ' + currentTrack.name + ' | Modules: ' + featuresSummary + ' | Horizon: ' + state.horizon + ']';

			if (customText.indexOf('[Selected:') === -1) {
				inputObjective.value = (customText ? customText + ' —' : currentTrack.name + ' scoping request —') + calculatedNote;
			}

			if (typeof window.sovassaTrack === 'function') {
				window.sovassaTrack('generate_lead_attempt', {
					event_category: 'Lead Generation',
					track_id: state.track,
					track_name: currentTrack.name,
					modules_count: state.features.length,
					horizon: state.horizon
				});
			}
		});
	}

	// Initial calculation
	recalculate();
})();
