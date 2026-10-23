(function () {
  "use strict";

  var reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // Interactive Neural Particle Canvas in Hero
  function initHeroCanvas() {
    var canvas = document.getElementById("hero-neural-canvas");
    if (!canvas || reduce) return;
    var ctx = canvas.getContext("2d");
    if (!ctx) return;

    var width, height;
    var particles = [];
    var count = 35;
    var mouse = { x: -9999, y: -9999 };
    var active = true;

    function resize() {
      var rect = canvas.getBoundingClientRect();
      width = canvas.width = rect.width;
      height = canvas.height = rect.height;
    }
    resize();
    window.addEventListener("resize", resize, { passive: true });

    window.addEventListener("mousemove", function (e) {
      var rect = canvas.getBoundingClientRect();
      mouse.x = e.clientX - rect.left;
      mouse.y = e.clientY - rect.top;
    }, { passive: true });

    for (var i = 0; i < count; i++) {
      particles.push({
        x: Math.random() * (width || 800),
        y: Math.random() * (height || 500),
        vx: (Math.random() - 0.5) * 0.7,
        vy: (Math.random() - 0.5) * 0.7,
        radius: Math.random() * 1.8 + 1.2,
      });
    }

    function render() {
      if (!active) return;
      ctx.clearRect(0, 0, width, height);

      for (var i = 0; i < particles.length; i++) {
        var p = particles[i];
        p.x += p.vx;
        p.y += p.vy;

        if (p.x < 0 || p.x > width) p.vx *= -1;
        if (p.y < 0 || p.y > height) p.vy *= -1;

        // Subtle reaction to mouse
        var dx = mouse.x - p.x;
        var dy = mouse.y - p.y;
        var dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 130 && dist > 0) {
          p.x -= (dx / dist) * 0.6;
          p.y -= (dy / dist) * 0.6;
        }

        // Draw particle
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
        ctx.fillStyle = "rgba(20, 212, 212, 0.75)";
        ctx.fill();

        // Connect nearby particles
        for (var j = i + 1; j < particles.length; j++) {
          var p2 = particles[j];
          var d2 = Math.hypot(p.x - p2.x, p.y - p2.y);
          if (d2 < 120) {
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.lineTo(p2.x, p2.y);
            var alpha = (1 - d2 / 120) * 0.28;
            ctx.strokeStyle = "rgba(127, 180, 255, " + alpha + ")";
            ctx.lineWidth = 1;
            ctx.stroke();
          }
        }
      }
      requestAnimationFrame(render);
    }

    if ("IntersectionObserver" in window) {
      var heroObs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          active = entry.isIntersecting;
          if (active) requestAnimationFrame(render);
        });
      }, { threshold: 0.1 });
      heroObs.observe(canvas);
    } else {
      requestAnimationFrame(render);
    }
  }
  initHeroCanvas();

  // Cursor-Following Glow for Interactive Cards
  document.addEventListener("mousemove", function (e) {
    var cards = document.querySelectorAll(".hp-counter, .hp-badge, .tech-pill, .hp-post");
    cards.forEach(function (card) {
      var rect = card.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      card.style.setProperty("--mouse-x", x + "px");
      card.style.setProperty("--mouse-y", y + "px");
    });
  }, { passive: true });

  // Tabs: services explorer and case studies share one pattern.
  function initTabs(list) {
    var tabs = Array.prototype.slice.call(list.querySelectorAll('[role="tab"]'));
    function select(index, focus) {
      tabs.forEach(function (tab, i) {
        var on = i === index;
        tab.setAttribute("aria-selected", on ? "true" : "false");
        tab.tabIndex = on ? 0 : -1;
        var panel = document.getElementById(tab.getAttribute("aria-controls"));
        if (panel) panel.hidden = !on;
      });
      if (focus) tabs[index].focus();
    }
    tabs.forEach(function (tab, i) {
      tab.addEventListener("click", function () { select(i, false); });
      tab.addEventListener("keydown", function (e) {
        var keys = { ArrowDown: 1, ArrowRight: 1, ArrowUp: -1, ArrowLeft: -1 };
        if (e.key === "Home" || e.key === "End") {
          e.preventDefault();
          select(e.key === "Home" ? 0 : tabs.length - 1, true);
        } else if (keys[e.key]) {
          e.preventDefault();
          select((i + keys[e.key] + tabs.length) % tabs.length, true);
        }
      });
    });
  }
  document.querySelectorAll('[role="tablist"]:not(.hp-faq-filters)').forEach(initTabs);

  // FAQ: Live search and category filtering
  function initFaq() {
    var searchInput = document.getElementById("hp-faq-search-input");
    var searchClear = document.getElementById("hp-faq-search-clear");
    var filterPills = Array.prototype.slice.call(document.querySelectorAll(".hp-faq-pill"));
    var faqList = document.getElementById("hp-faq-list");
    var emptyState = document.getElementById("hp-faq-empty");
    var queryDisplay = document.getElementById("hp-faq-search-query");

    if (!faqList) return;

    var items = Array.prototype.slice.call(faqList.querySelectorAll(".hp-faq__item"));
    var activeCategory = "all";

    function applyFilter() {
      var query = searchInput ? searchInput.value.trim().toLowerCase() : "";
      var matchCount = 0;

      if (searchClear) {
        searchClear.hidden = query.length === 0;
      }

      items.forEach(function (item) {
        var category = item.getAttribute("data-category") || "";
        var question = (item.querySelector(".hp-faq__question") || {}).textContent || "";
        var answer = (item.querySelector(".hp-faq__content") || {}).textContent || "";

        var matchesCategory = activeCategory === "all" || category.toLowerCase() === activeCategory.toLowerCase();
        var matchesQuery = query === "" ||
          question.toLowerCase().indexOf(query) !== -1 ||
          answer.toLowerCase().indexOf(query) !== -1 ||
          category.toLowerCase().indexOf(query) !== -1;

        var isVisible = matchesCategory && matchesQuery;
        item.hidden = !isVisible;

        if (isVisible) {
          matchCount++;
          // If searching, auto-expand matching questions for instant readability
          if (query.length > 1) {
            item.open = true;
          }
        }
      });

      if (emptyState) {
        emptyState.hidden = matchCount > 0;
        if (queryDisplay) {
          queryDisplay.textContent = query || activeCategory;
        }
      }
    }

    filterPills.forEach(function (pill) {
      pill.addEventListener("click", function () {
        filterPills.forEach(function (p) {
          p.classList.remove("is-active");
          p.setAttribute("aria-selected", "false");
        });
        pill.classList.add("is-active");
        pill.setAttribute("aria-selected", "true");
        activeCategory = pill.getAttribute("data-filter") || "all";
        applyFilter();
      });
    });

    if (searchInput) {
      searchInput.addEventListener("input", applyFilter);
    }

    if (searchClear) {
      searchClear.addEventListener("click", function () {
        if (searchInput) {
          searchInput.value = "";
          searchInput.focus();
        }
        applyFilter();
      });
    }
  }
  initFaq();

  // Comparison slider: Legacy vs. Sovassa engineered architecture
  function initCompare() {
    var widget = document.querySelector("[data-compare-widget]");
    if (!widget) return;

    var screen = document.getElementById("hp-compare-screen");
    var range = document.getElementById("hp-compare-range");
    var after = document.getElementById("hp-compare-after");
    var divider = document.getElementById("hp-compare-divider");
    var presets = Array.prototype.slice.call(document.querySelectorAll(".hp-compare-preset-btn"));

    function setPosition(val) {
      val = Math.max(0, Math.min(100, parseFloat(val)));
      if (screen) {
        screen.style.setProperty("--pos", val + "%");
      }
      if (after) {
        after.style.clipPath = "inset(0 0 0 " + val + "%)";
      }
      if (divider) {
        divider.style.left = val + "%";
      }
      if (range) {
        range.value = String(val);
      }

      presets.forEach(function (btn) {
        var presetVal = parseFloat(btn.getAttribute("data-compare-set"));
        btn.classList.toggle("is-active", Math.abs(presetVal - val) < 12);
      });
    }

    if (range) {
      range.addEventListener("input", function () {
        setPosition(this.value);
      });
    }

    presets.forEach(function (btn) {
      btn.addEventListener("click", function () {
        var targetVal = parseFloat(btn.getAttribute("data-compare-set"));
        if (!isNaN(targetVal)) {
          setPosition(targetVal);
        }
      });
    });

    // Initialize at 50%
    setPosition(50);
  }
  initCompare();

  // Process: each stage card shows its photo. It advances on its own until someone picks a stage.
  var process = document.querySelector("[data-process]");
  if (process) {
    var steps = process.querySelectorAll(".hp-step");
    var slides = process.querySelectorAll(".hp-slide");
    var dots = process.querySelectorAll(".hp-dots i");
    var film = process.querySelector(".hp-process__film");
    var current = 0;
    var timer = null;
    var show = function (i) {
      current = i;
      steps.forEach(function (el, j) { el.classList.toggle("is-on", i === j); });
      slides.forEach(function (el, j) { el.classList.toggle("is-on", i === j); });
      dots.forEach(function (el, j) { el.classList.toggle("is-on", i === j); });
      var title = steps[i].querySelector("h3");
      if (film && title) film.setAttribute("data-label", title.textContent);
    };
    steps.forEach(function (step, i) {
      step.tabIndex = 0;
      step.addEventListener("click", function () { clearInterval(timer); show(i); });
      step.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") { e.preventDefault(); clearInterval(timer); show(i); }
      });
    });
    if (!reduce && slides.length > 1) {
      timer = setInterval(function () { show((current + 1) % slides.length); }, 3800);
    }
  }

  // Counters count up once when they come into view. The final number is already in the HTML.
  function countUp(el) {
    var end = parseInt(el.getAttribute("data-count"), 10);
    if (isNaN(end) || end <= 0) return;
    var start = null;
    requestAnimationFrame(function step(ts) {
      if (!start) start = ts;
      var k = Math.min(1, (ts - start) / 1200);
      el.textContent = String(Math.round(end * (1 - Math.pow(1 - k, 3))));
      if (k < 1) requestAnimationFrame(step);
    });
  }

  if ("IntersectionObserver" in window) {
    var seen = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-in");
        if (!reduce) entry.target.querySelectorAll("[data-count]").forEach(countUp);
        seen.unobserve(entry.target);
      });
    }, { threshold: 0.15 });
    document.querySelectorAll(".hp-rise").forEach(function (el) { seen.observe(el); });
  } else {
    document.querySelectorAll(".hp-rise").forEach(function (el) { el.classList.add("is-in"); });
  }
})();
