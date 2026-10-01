(function () {
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
        select(button.getAttribute("data-switch"));
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
    buttons.forEach(function (button) {
      button.addEventListener("click", function () {
        var filter = button.getAttribute("data-filter");
        buttons.forEach(function (item) { item.classList.remove("is-active"); });
        button.classList.add("is-active");
        cards.forEach(function (card) {
          var tags = (card.getAttribute("data-tags") || "").split("|");
          card.hidden = filter !== "all" && tags.indexOf(filter) === -1;
        });
      });
    });
  });

  var revealSelector = ".section .section-head, .section .link-card, .section .plain-card, .section .post-card, .section .role-card, .section .step, .section .checklist li, .section .faq__item, .section .bento__card, .section .alt-row, .section .feature-lead, .section .together-still, .section .split-still";
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
})();
