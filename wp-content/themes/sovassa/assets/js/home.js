(function () {
  "use strict";

  var reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

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
  document.querySelectorAll('[role="tablist"]').forEach(initTabs);

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
