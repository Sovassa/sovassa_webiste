(function () {
  'use strict';

  // Global GA4 micro-conversion helper compatible with Site Kit, GTM, and standalone gtag.js
  window.dataLayer = window.dataLayer || [];
  if (typeof window.gtag !== 'function') {
    window.gtag = function () {
      window.dataLayer.push(arguments);
    };
  }

  window.sovassaTrack = function (eventName, params) {
    try {
      params = params || {};
      if (typeof window.gtag === 'function') {
        window.gtag('event', eventName, params);
      } else if (window.dataLayer && typeof window.dataLayer.push === 'function') {
        var eventObj = { event: eventName };
        for (var key in params) {
          if (Object.prototype.hasOwnProperty.call(params, key)) {
            eventObj[key] = params[key];
          }
        }
        window.dataLayer.push(eventObj);
      }
    } catch (err) {
      // Graceful fallback
    }
  };

  var toggle = document.querySelector(".menu-toggle");
  var menu = document.getElementById("site-menu");
  var desktop = window.matchMedia("(min-width: 1181px)");

  function cancelClose(drop) {
    if (drop._closeTimer) {
      window.clearTimeout(drop._closeTimer);
      drop._closeTimer = null;
    }
  }

  function closeDrops(except) {
    document.querySelectorAll(".nav-drop").forEach(function (drop) {
      if (drop === except) return;
      cancelClose(drop);
      var button = drop.querySelector(":scope > button");
      var panel = drop.querySelector(":scope > .nav-panel");
      drop.classList.remove("is-open");
      if (button) button.setAttribute("aria-expanded", "false");
      if (panel) panel.hidden = true;
    });
  }

  document.querySelectorAll(".nav-drop").forEach(function (drop) {
    var button = drop.querySelector(":scope > button");
    var panel = drop.querySelector(":scope > .nav-panel");
    if (!button || !panel) return;
    function openDrop() {
      cancelClose(drop);
      closeDrops(drop);
      drop.classList.add("is-open");
      button.setAttribute("aria-expanded", "true");
      panel.hidden = false;
    }
    function shutDrop() {
      drop._closeTimer = null;
      drop.classList.remove("is-open");
      button.setAttribute("aria-expanded", "false");
      panel.hidden = true;
    }
    function scheduleClose() {
      cancelClose(drop);
      drop._closeTimer = window.setTimeout(shutDrop, 320);
    }
    button.addEventListener("click", function () {
      if (drop.classList.contains("is-open")) shutDrop();
      else openDrop();
    });
    drop.addEventListener("mouseenter", function () {
      if (desktop.matches) openDrop();
    });
    drop.addEventListener("mouseleave", function () {
      if (desktop.matches) scheduleClose();
    });
  });

  document.addEventListener("keydown", function (event) {
    if (event.key !== "Escape") return;
    closeDrops();
    if (toggle && toggle.getAttribute("aria-expanded") === "true") {
      toggle.setAttribute("aria-expanded", "false");
      document.body.classList.remove("nav-open");
      var label = toggle.querySelector(".menu-toggle__label");
      if (label) label.textContent = "Menu";
    }
  });
  document.addEventListener("click", function (event) {
    if (!event.target.closest(".nav-drop")) closeDrops();
  });

  if (toggle && menu) {
    toggle.addEventListener("click", function () {
      var open = toggle.getAttribute("aria-expanded") === "true";
      toggle.setAttribute("aria-expanded", open ? "false" : "true");
      document.body.classList.toggle("nav-open", !open);
      toggle.querySelector(".menu-toggle__label").textContent = open ? "Menu" : "Close";
      if (open) closeDrops();
    });
    menu.addEventListener("click", function (event) {
      if (event.target.closest("a")) {
        toggle.setAttribute("aria-expanded", "false");
        document.body.classList.remove("nav-open");
        toggle.querySelector(".menu-toggle__label").textContent = "Menu";
        closeDrops();
      }
    });
  }

  document.querySelectorAll("video.brand-video").forEach(function (video) {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      return;
    }
    function arm() {
      video.querySelectorAll("source[data-src]").forEach(function (source) {
        if (!source.getAttribute("src")) source.setAttribute("src", source.getAttribute("data-src"));
      });
      video.load();
      var play = video.play();
      if (play && play.catch) play.catch(function () {});
    }
    if (!("IntersectionObserver" in window)) {
      arm();
      return;
    }
    var margin = window.matchMedia("(max-width: 980px)").matches ? "0px" : "200px";
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        arm();
        observer.disconnect();
      });
    }, { rootMargin: margin });
    observer.observe(video);
  });

  var barTicking = false;
  function updateBar() {
    document.body.classList.toggle("is-scrolled", window.scrollY > 8);
    barTicking = false;
  }
  window.addEventListener("scroll", function () {
    if (barTicking) return;
    barTicking = true;
    window.requestAnimationFrame(updateBar);
  }, { passive: true });
  updateBar();

  var rotator = document.querySelector("[data-rotate]");
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (rotator && !reduce) {
    var words = rotator.getAttribute("data-rotate").split("|").filter(Boolean);
    var index = 0;
    var word = rotator.querySelector(".hero__rotate-word") || rotator;
    var swapping = false;
    function settle(next) {
      word.textContent = next;
      word.style.opacity = "1";
      swapping = false;
    }
    function cycleWord() {
      if (words.length < 2 || swapping) return;
      swapping = true;
      index = (index + 1) % words.length;
      var next = words[index];
      var done = false;
      function finish() {
        if (done) return;
        done = true;
        settle(next);
      }
      if (word.animate) {
        var fade = word.animate(
          [{ opacity: 1 }, { opacity: 0.15, offset: 0.45 }, { opacity: 1 }],
          { duration: 420, easing: "ease-in-out", fill: "none" }
        );
        window.setTimeout(function () {
          word.textContent = next;
        }, 180);
        fade.onfinish = finish;
      } else {
        word.textContent = next;
      }
      window.setTimeout(finish, 520);
    }
    window.setInterval(cycleWord, 2600);
  }

  var cookieBar = document.getElementById("cookie-bar");
  function cookieChoice() {
    var match = document.cookie.match(/(?:^|; )sovassa_cookie=([^;]*)/);
    return match ? decodeURIComponent(match[1]) : "";
  }
  function saveCookieChoice(value) {
    document.cookie = "sovassa_cookie=" + value + "; path=/; max-age=" + (60 * 60 * 24 * 180) + "; SameSite=Lax";
    if (cookieBar) cookieBar.hidden = true;
    if (value === "all") document.dispatchEvent(new CustomEvent("sovassa-consent"));
  }
  if (cookieBar) {
    if (cookieChoice()) cookieBar.hidden = true;
    cookieBar.addEventListener("submit", function (event) {
      var submitter = event.submitter;
      var choice = submitter && submitter.getAttribute("value") === "all" ? "all" : "essential";
      event.preventDefault();
      saveCookieChoice(choice);
    });
  }
  document.querySelectorAll("[data-cookie-settings]").forEach(function (button) {
    button.addEventListener("click", function () {
      if (cookieBar) cookieBar.hidden = false;
    });
  });

  document.querySelectorAll("[data-switcher]").forEach(function (root) {
    var nav = root.querySelector(".switcher__nav");
    var buttons = nav ? nav.querySelectorAll("[data-switch]") : [];
    var items = root.querySelectorAll("[data-switch-item]");
    if (!nav || !buttons.length || !items.length) return;
    function select(id) {
      var known = false;
      items.forEach(function (item) {
        if (item.getAttribute("data-switch-item") === id) known = true;
      });
      if (!known) id = buttons[0].getAttribute("data-switch");
      buttons.forEach(function (button) {
        var on = button.getAttribute("data-switch") === id;
        button.classList.toggle("is-active", on);
        button.setAttribute("aria-pressed", on ? "true" : "false");
      });
      items.forEach(function (item) {
        item.classList.toggle("is-current", item.getAttribute("data-switch-item") === id);
      });
    }
    buttons.forEach(function (button) {
      button.addEventListener("click", function () {
        var id = button.getAttribute("data-switch");
        select(id);
        if (typeof window.sovassaTrack === "function") {
          window.sovassaTrack("tab_switched", {
            event_category: "Engagement",
            tab_id: id,
            page_path: window.location.pathname
          });
        }
      });
    });
    root.classList.add("is-ready");
    nav.hidden = false;
    var hash = window.location.hash ? window.location.hash.slice(1) : "";
    select(hash || buttons[0].getAttribute("data-switch"));
  });

  document.querySelectorAll("[data-filter-group]").forEach(function (group) {
    var buttons = group.querySelectorAll("[data-filter]");
    var cards = document.querySelectorAll("[data-tags]");
    var groupName = group.getAttribute("data-filter-group") || "tech_stack";
    buttons.forEach(function (button) {
      button.addEventListener("click", function () {
        var filter = button.getAttribute("data-filter");
        buttons.forEach(function (item) { item.classList.remove("is-active"); });
        button.classList.add("is-active");
        cards.forEach(function (card) {
          var tags = (card.getAttribute("data-tags") || "").split("|");
          card.hidden = filter !== "all" && tags.indexOf(filter) === -1;
        });
        if (typeof window.sovassaTrack === "function") {
          window.sovassaTrack("filter_applied", {
            event_category: "Navigation",
            filter_group: groupName,
            filter_value: filter,
            page_path: window.location.pathname
          });
        }
      });
    });
  });

  // Direct Contact & Lead Generation Micro-Conversions
  document.addEventListener("click", function (event) {
    var link = event.target.closest('a[href^="tel:"], a[href*="wa.me"], a[href*="whatsapp.com"], a[href^="mailto:"]');
    if (link) {
      var href = link.getAttribute("href") || "";
      var method = "link";
      var destination = href;
      if (href.indexOf("tel:") === 0) {
        method = "phone";
        destination = href.replace("tel:", "");
      } else if (href.indexOf("wa.me") !== -1 || href.indexOf("whatsapp.com") !== -1) {
        method = "whatsapp";
      } else if (href.indexOf("mailto:") === 0) {
        method = "email";
        destination = href.replace("mailto:", "");
      }
      var locationTag = link.closest(".mobile-cta-bar") ? "mobile_dock" :
                        link.closest(".edge-dock") ? "edge_dock" :
                        link.closest(".site-header") ? "header" :
                        link.closest(".site-footer") ? "footer" : "content";
      if (typeof window.sovassaTrack === "function") {
        window.sovassaTrack("contact_click", {
          event_category: "Lead Generation",
          contact_method: method,
          contact_location: locationTag,
          destination: destination
        });
      }
      return;
    }

    // Key CTA clicks (Book Consultation, Scope Project, etc.)
    var cta = event.target.closest("a.btn, a.estimator-whatsapp, a.post-cta__btn");
    if (cta) {
      var ctaHref = cta.getAttribute("href") || "";
      var ctaText = (cta.textContent || "").trim().slice(0, 50);
      if (typeof window.sovassaTrack === "function") {
        window.sovassaTrack("cta_click", {
          event_category: "Engagement",
          cta_text: ctaText,
          cta_url: ctaHref,
          page_path: window.location.pathname
        });
      }
    }
  });

  var revealSelector = ".section .section-head, .section .link-card, .section .plain-card, .section .post-card, .section .role-card, .section .step, .section .checklist li, .section .faq__item, .section .bento__card, .section .alt-row, .section .feature-lead, .section .together-still, .section .split-still, [data-reveal]";
  function revealInView() {
    document.querySelectorAll(revealSelector).forEach(function (el) {
      if (el.classList.contains("is-shown")) return;
      var rect = el.getBoundingClientRect();
      if (rect.bottom < 80 || rect.top > window.innerHeight * 0.94) return;
      el.classList.add("is-shown");
    });
  }
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-shown");
        io.unobserve(entry.target);
      });
    }, { rootMargin: "80px 0px 80px 0px", threshold: 0 });
    document.querySelectorAll(revealSelector).forEach(function (el) { io.observe(el); });
  }
  revealInView();
  window.addEventListener("scroll", revealInView, { passive: true });

  document.querySelectorAll("[data-rail]").forEach(function (rail) {
    if (reduce || !("IntersectionObserver" in window)) {
      rail.classList.add("is-drawn");
      return;
    }
    var rails = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-drawn");
        rails.unobserve(entry.target);
      });
    }, { rootMargin: "0px 0px -20% 0px", threshold: 0 });
    rails.observe(rail);
  });

  // Modals Controller (Architecture Audit & 1-Click Discovery Booking)
  var auditModal = document.getElementById("audit-modal");
  var bookingModal = document.getElementById("booking-modal");

  function openAuditModal() {
    if (!auditModal) return;
    auditModal.classList.add("is-active");
    auditModal.setAttribute("aria-hidden", "false");
    document.body.classList.add("modal-open");
    var firstInput = auditModal.querySelector("input:not([type='hidden'])");
    if (firstInput) firstInput.focus();
    if (typeof window.sovassaTrack === "function") {
      window.sovassaTrack("audit_modal_opened", {
        event_category: "Lead Generation",
        source_url: window.location.pathname
      });
    }
  }

  function closeAuditModal() {
    if (!auditModal) return;
    auditModal.classList.remove("is-active");
    auditModal.setAttribute("aria-hidden", "true");
    if (!bookingModal || !bookingModal.classList.contains("is-active")) {
      document.body.classList.remove("modal-open");
    }
  }

  function openBookingModal() {
    if (!bookingModal) return;
    bookingModal.classList.add("is-active");
    bookingModal.setAttribute("aria-hidden", "false");
    document.body.classList.add("modal-open");
    var firstInput = bookingModal.querySelector("input:not([type='hidden'])");
    if (firstInput) firstInput.focus();
    if (typeof window.sovassaTrack === "function") {
      window.sovassaTrack("booking_modal_opened", {
        event_category: "Lead Generation",
        source_url: window.location.pathname
      });
    }
  }

  function closeBookingModal() {
    if (!bookingModal) return;
    bookingModal.classList.remove("is-active");
    bookingModal.setAttribute("aria-hidden", "true");
    if (!auditModal || !auditModal.classList.contains("is-active")) {
      document.body.classList.remove("modal-open");
    }
  }

  document.addEventListener("click", function (event) {
    var auditTrigger = event.target.closest('[data-open-modal="audit"]');
    if (auditTrigger) {
      event.preventDefault();
      openAuditModal();
      return;
    }
    var auditClose = event.target.closest('[data-close-modal="audit"]');
    if (auditClose) {
      event.preventDefault();
      closeAuditModal();
      return;
    }

    var bookingTrigger = event.target.closest('[data-open-modal="booking"]');
    if (bookingTrigger) {
      event.preventDefault();
      openBookingModal();
      return;
    }
    var bookingClose = event.target.closest('[data-close-modal="booking"]');
    if (bookingClose) {
      event.preventDefault();
      closeBookingModal();
      return;
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      if (auditModal && auditModal.classList.contains("is-active")) {
        closeAuditModal();
      }
      if (bookingModal && bookingModal.classList.contains("is-active")) {
        closeBookingModal();
      }
    }
  });

  var auditForm = document.getElementById("audit-form");
  if (auditForm) {
    auditForm.addEventListener("submit", function () {
      if (typeof window.sovassaTrack === "function") {
        window.sovassaTrack("generate_lead_attempt", {
          event_category: "Lead Generation",
          form_type: "technical_audit",
          page_path: window.location.pathname
        });
      }
    });
  }

  var bookingForm = document.getElementById("booking-form");
  if (bookingForm) {
    bookingForm.addEventListener("submit", function () {
      if (typeof window.sovassaTrack === "function") {
        window.sovassaTrack("generate_lead_attempt", {
          event_category: "Lead Generation",
          form_type: "calendar_discovery",
          page_path: window.location.pathname
        });
      }
    });
  }

  // Cursor-Following Glow for Inner Page Interactive Cards
  document.addEventListener("mousemove", function (e) {
    var innerCards = document.querySelectorAll(".tech-tier-card, .showcase-lead, .audit-callout-card, .plain-card, .link-card");
    innerCards.forEach(function (card) {
      var rect = card.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      card.style.setProperty("--mouse-x", x + "px");
      card.style.setProperty("--mouse-y", y + "px");
    });
  }, { passive: true });

  // Sovassa AI Solutions Architect Copilot Controller
  var aiTrigger = document.getElementById("ai-copilot-trigger");
  var aiDrawer = document.getElementById("ai-copilot-drawer");
  var aiClose = document.getElementById("ai-copilot-close");
  var aiForm = document.getElementById("ai-copilot-form");
  var aiInput = document.getElementById("ai-copilot-input");
  var aiMessages = document.getElementById("ai-copilot-messages");
  var aiChips = document.getElementById("ai-copilot-chips");

  var aiKnowledge = {
    mvp_cost: {
      text: "<p>Sovassa packages digital builds into <strong>transparent milestone stages</strong>:</p><ul><li><strong>Foundation MVP:</strong> $15,000 – $25,000 (4–6 weeks) — Core product, scalable database, and responsive frontend.</li><li><strong>Production Scale:</strong> $25,000 – $45,000 (6–10 weeks) — Multi-role auth, payments, dashboards, and automated APIs.</li><li><strong>Enterprise Platform:</strong> $45,000+ (2–4 months) — High concurrency, microservices, and compliance.</li></ul><p>Every engagement includes 100% IP ownership and a 30-day post-launch warranty.</p>",
      actions: [
        { label: "⚡ Configure in Scope Calculator", url: "/get-a-quote/" },
        { label: "💬 WhatsApp Us", url: "https://wa.me/917002862687", external: true }
      ]
    },
    telehealth: {
      text: "<p>Our <strong>Telehealth Architecture</strong> is engineered around strict HIPAA & HITECH compliance:</p><ul><li><strong>Video Consultations:</strong> WebRTC encrypted peer-to-peer streaming with turn server fallback.</li><li><strong>EHR Integration:</strong> HL7 & FHIR compliant patient record synchronization.</li><li><strong>Security:</strong> AES-256 data-at-rest and TLS 1.3 in-transit encryption with role-based practitioner access.</li></ul>",
      actions: [
        { label: "📖 Read Telehealth Pillar Guide", url: "/telemedicine-app-development-guide/" },
        { label: "🔍 View Healthcare Case Study", url: "/work/#healthcare" }
      ]
    },
    taxi: {
      text: "<p>Our <strong>On-Demand Mobility & Taxi Architecture</strong> handles real-time concurrency with sub-3s dispatch:</p><ul><li><strong>Geospatial Matching:</strong> Redis Geospatial & PostGIS radius queries.</li><li><strong>Real-Time Telemetry:</strong> WebSocket bi-directional driver-rider event streams.</li><li><strong>Dynamic Pricing:</strong> Automated surge pricing algorithm and split-fare payouts.</li></ul>",
      actions: [
        { label: "📖 Read Taxi Dispatch Guide", url: "/how-to-build-a-taxi-booking-app/" },
        { label: "🔍 View Taxi Case Study", url: "/work/#taxi" }
      ]
    },
    marketplace: {
      text: "<p>Our <strong>Multi-Vendor Marketplace Architecture</strong> supports seamless buyer & seller journeys:</p><ul><li><strong>Vendor Onboarding:</strong> Automated KYB identity checks and catalogue bulk-import.</li><li><strong>Escrow Payments:</strong> Automated split payouts via Stripe Connect Custom.</li><li><strong>Inventory:</strong> Real-time multi-warehouse stock sync and tracking.</li></ul>",
      actions: [
        { label: "📖 Read Marketplace Guide", url: "/multi-vendor-marketplace-development-guide/" },
        { label: "🔍 View Marketplace Case Study", url: "/work/#marketplace" }
      ]
    },
    process: {
      text: "<p>We engineer software through our <strong>4-Stage Delivery Blueprint</strong>:</p><ul><li><strong>1. Discovery & SRS Spec:</strong> Technical architecture diagrams and sprint roadmaps.</li><li><strong>2. Interactive UI/UX:</strong> Clickable Figma prototypes pressure-tested before code.</li><li><strong>3. Agile Sprints:</strong> Bi-weekly working staging demos with full testing.</li><li><strong>4. Launch & 30-Day SLA:</strong> Deployment to your cloud with 30-day bug warranty.</li></ul>",
      actions: [
        { label: "⚡ Scope Your Project", url: "/get-a-quote/" },
        { label: "📋 Request Architecture Audit", modal: "audit" }
      ]
    },
    audit: {
      text: "<p>Ready for an independent second opinion? You can request a <strong>Free 15-Minute Technical Architecture Audit</strong> with a senior solutions architect to evaluate your stack, database bottlenecks, or MVP feasibility.</p>",
      actions: [
        { label: "📋 Open Architecture Audit Form", modal: "audit" }
      ]
    },
    booking: {
      text: "<p>You can schedule a <strong>15-Minute Technical Discovery Call</strong> directly with our senior solutions engineering team. Zero sales fluff—we discuss real architecture, timeline feasibility, and sprint roadmaps.</p>",
      actions: [
        { label: "📅 Schedule 15-Min Discovery Call", modal: "booking" },
        { label: "💬 Instant WhatsApp Connect", url: "https://wa.me/917002862687", external: true }
      ]
    }
  };

  function toggleAiDrawer(open) {
    if (!aiDrawer || !aiTrigger) return;
    var isOpen = open !== undefined ? open : aiDrawer.hidden;
    aiDrawer.hidden = !isOpen;
    aiDrawer.setAttribute("aria-hidden", !isOpen ? "true" : "false");
    aiTrigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
    if (isOpen) {
      if (aiInput) aiInput.focus();
      if (typeof window.sovassaTrack === "function") {
        window.sovassaTrack("ai_copilot_opened", { page_path: window.location.pathname });
      }
    }
  }

  function appendAiMsg(html, sender, actions) {
    if (!aiMessages) return;
    var msg = document.createElement("div");
    msg.className = "ai-msg ai-msg--" + sender;
    var inner = '<div class="ai-msg__content">' + html + '</div>';
    if (actions && actions.length) {
      inner += '<div class="ai-msg__actions">';
      actions.forEach(function (act) {
        if (act.modal) {
          inner += '<button type="button" class="ai-cta-btn" data-open-modal="' + act.modal + '">' + act.label + '</button>';
        } else {
          var targetAttr = act.external ? ' target="_blank" rel="noopener noreferrer"' : '';
          inner += '<a class="ai-cta-btn" href="' + act.url + '"' + targetAttr + '>' + act.label + '</a>';
        }
      });
      inner += '</div>';
    }
    msg.innerHTML = inner;
    aiMessages.appendChild(msg);
    aiMessages.scrollTop = aiMessages.scrollHeight;
  }

  function handleAiQuery(key, customText) {
    var userText = customText || (key ? key.replace("_", " ").toUpperCase() : "");
    if (userText) {
      appendAiMsg('<p>' + userText + '</p>', 'user');
    }

    // Show typing indicator
    var typing = document.createElement("div");
    typing.className = "ai-typing";
    typing.innerHTML = '<span></span><span></span><span></span>';
    aiMessages.appendChild(typing);
    aiMessages.scrollTop = aiMessages.scrollHeight;

    setTimeout(function () {
      if (typing.parentNode) typing.parentNode.removeChild(typing);
      var response = aiKnowledge[key];
      if (!response) {
        var lower = (customText || "").toLowerCase();
        if (lower.indexOf("book") !== -1 || lower.indexOf("schedule") !== -1 || lower.indexOf("call") !== -1 || lower.indexOf("meet") !== -1 || lower.indexOf("calendar") !== -1) {
          response = aiKnowledge.booking;
        } else if (lower.indexOf("cost") !== -1 || lower.indexOf("price") !== -1 || lower.indexOf("how much") !== -1) {
          response = aiKnowledge.mvp_cost;
        } else if (lower.indexOf("health") !== -1 || lower.indexOf("doctor") !== -1 || lower.indexOf("hipaa") !== -1) {
          response = aiKnowledge.telehealth;
        } else if (lower.indexOf("taxi") !== -1 || lower.indexOf("driver") !== -1 || lower.indexOf("uber") !== -1) {
          response = aiKnowledge.taxi;
        } else if (lower.indexOf("market") !== -1 || lower.indexOf("ecommerce") !== -1 || lower.indexOf("store") !== -1) {
          response = aiKnowledge.marketplace;
        } else if (lower.indexOf("process") !== -1 || lower.indexOf("how you work") !== -1 || lower.indexOf("sprint") !== -1) {
          response = aiKnowledge.process;
        } else {
          response = {
            text: "<p>Thank you for asking! Sovassa specializes in custom web platforms, mobile apps (Flutter/React Native), AI automation pipelines, and technical growth. Would you like a transparent cost estimate or a 15-minute architecture audit?</p>",
            actions: [
              { label: "⚡ Interactive Scope Calculator", url: "/get-a-quote/" },
              { label: "📋 Request 15-Min Audit", modal: "audit" },
              { label: "💬 WhatsApp Senior Team", url: "https://wa.me/917002862687", external: true }
            ]
          };
        }
      }
      appendAiMsg(response.text, 'bot', response.actions);
      if (typeof window.sovassaTrack === "function") {
        window.sovassaTrack("ai_copilot_query", { query: customText || key });
      }
    }, 450);
  }

  if (aiTrigger) {
    aiTrigger.addEventListener("click", function () {
      toggleAiDrawer();
    });
  }

  if (aiClose) {
    aiClose.addEventListener("click", function () {
      toggleAiDrawer(false);
    });
  }

  if (aiChips) {
    aiChips.addEventListener("click", function (e) {
      var chip = e.target.closest(".ai-chip");
      if (!chip) return;
      var q = chip.getAttribute("data-query");
      var text = chip.textContent.trim();
      handleAiQuery(q, text);
    });
  }

  if (aiForm && aiInput) {
    aiForm.addEventListener("submit", function (e) {
      e.preventDefault();
      var val = aiInput.value.trim();
      if (!val) return;
      aiInput.value = "";
      handleAiQuery(null, val);
    });
  }

  // Global Command Palette (Cmd + K / Ctrl + K)
  var cmdPalette = document.getElementById("command-palette");
  var cmdInput = document.getElementById("cmd-palette-input");
  var cmdTrigger = document.getElementById("cmd-k-trigger");
  var cmdItems = cmdPalette ? Array.prototype.slice.call(cmdPalette.querySelectorAll(".cmd-item")) : [];
  var cmdGroups = cmdPalette ? Array.prototype.slice.call(cmdPalette.querySelectorAll(".cmd-group")) : [];
  var selectedCmdIdx = 0;

  function getVisibleCmdItems() {
    return cmdItems.filter(function (item) {
      return item.style.display !== "none";
    });
  }

  function setCmdSelected(idx) {
    var visible = getVisibleCmdItems();
    if (!visible.length) {
      selectedCmdIdx = -1;
      return;
    }
    if (idx < 0) idx = 0;
    if (idx >= visible.length) idx = visible.length - 1;
    selectedCmdIdx = idx;

    cmdItems.forEach(function (item) {
      item.classList.remove("is-selected");
    });
    var activeItem = visible[selectedCmdIdx];
    if (activeItem) {
      activeItem.classList.add("is-selected");
      activeItem.scrollIntoView({ block: "nearest" });
    }
  }

  function openCmdPalette() {
    if (!cmdPalette) return;
    cmdPalette.hidden = false;
    cmdPalette.classList.add("is-active");
    cmdPalette.setAttribute("aria-hidden", "false");
    document.body.classList.add("modal-open");
    if (cmdInput) {
      cmdInput.value = "";
      cmdInput.focus();
    }
    cmdItems.forEach(function (item) { item.style.display = ""; });
    cmdGroups.forEach(function (group) { group.style.display = ""; });
    setCmdSelected(0);

    if (typeof window.sovassaTrack === "function") {
      window.sovassaTrack("command_palette_opened", { page_path: window.location.pathname });
    }
  }

  function closeCmdPalette() {
    if (!cmdPalette) return;
    cmdPalette.classList.remove("is-active");
    cmdPalette.setAttribute("aria-hidden", "true");
    cmdPalette.hidden = true;
    if ((!auditModal || !auditModal.classList.contains("is-active")) &&
        (!bookingModal || !bookingModal.classList.contains("is-active"))) {
      document.body.classList.remove("modal-open");
    }
    selectedCmdIdx = -1;
  }

  function filterCmdPalette(q) {
    var query = (q || "").trim().toLowerCase();
    cmdGroups.forEach(function (group) {
      var itemsInGroup = Array.prototype.slice.call(group.querySelectorAll(".cmd-item"));
      var hasVisible = false;
      itemsInGroup.forEach(function (item) {
        var title = (item.getAttribute("data-title") || item.textContent || "").toLowerCase();
        if (!query || title.indexOf(query) !== -1) {
          item.style.display = "";
          hasVisible = true;
        } else {
          item.style.display = "none";
        }
      });
      group.style.display = hasVisible ? "" : "none";
    });
    setCmdSelected(0);
  }

  if (cmdTrigger) {
    cmdTrigger.addEventListener("click", function (e) {
      e.preventDefault();
      openCmdPalette();
    });
  }

  if (cmdPalette) {
    cmdPalette.addEventListener("click", function (e) {
      var closeBtn = e.target.closest("[data-close-cmd]");
      if (closeBtn || e.target.classList.contains("cmd-palette__backdrop")) {
        e.preventDefault();
        closeCmdPalette();
        return;
      }
      var item = e.target.closest(".cmd-item");
      if (item) {
        if (item.id === "cmd-item-copilot") {
          e.preventDefault();
          closeCmdPalette();
          toggleAiDrawer(true);
          return;
        }
        if (item.getAttribute("data-open-modal") === "audit") {
          e.preventDefault();
          closeCmdPalette();
          openAuditModal();
          return;
        }
        if (item.getAttribute("data-open-modal") === "booking") {
          e.preventDefault();
          closeCmdPalette();
          openBookingModal();
          return;
        }
        closeCmdPalette();
      }
    });

    if (cmdInput) {
      cmdInput.addEventListener("input", function () {
        filterCmdPalette(this.value);
      });
    }
  }

  document.addEventListener("keydown", function (e) {
    if ((e.metaKey || e.ctrlKey) && (e.key === "k" || e.key === "K")) {
      e.preventDefault();
      if (cmdPalette && !cmdPalette.hidden && cmdPalette.classList.contains("is-active")) {
        closeCmdPalette();
      } else {
        openCmdPalette();
      }
      return;
    }

    if (cmdPalette && !cmdPalette.hidden && cmdPalette.classList.contains("is-active")) {
      if (e.key === "Escape") {
        e.preventDefault();
        closeCmdPalette();
        return;
      }
      if (e.key === "ArrowDown") {
        e.preventDefault();
        setCmdSelected(selectedCmdIdx + 1);
        return;
      }
      if (e.key === "ArrowUp") {
        e.preventDefault();
        setCmdSelected(selectedCmdIdx - 1);
        return;
      }
      if (e.key === "Enter") {
        var visible = getVisibleCmdItems();
        if (visible[selectedCmdIdx]) {
          e.preventDefault();
          visible[selectedCmdIdx].click();
        }
        return;
      }
    }
  });
})();

// Article tables stack into cards on phones. Copy each column heading onto its
// cells so every value keeps its label once the header row is hidden.
document.querySelectorAll(".article__body table").forEach(function (table) {
  var labels = Array.prototype.map.call(table.querySelectorAll("thead th"), function (th) {
    return th.textContent.trim();
  });
  if (!labels.length) return;
  table.classList.add("is-labelled");
  table.querySelectorAll("tbody tr").forEach(function (row) {
    Array.prototype.forEach.call(row.children, function (cell, i) {
      if (labels[i]) cell.setAttribute("data-label", labels[i]);
    });
  });
});
