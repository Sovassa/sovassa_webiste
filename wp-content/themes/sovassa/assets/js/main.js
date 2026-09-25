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
    if (event.key === "Escape") closeDrops();
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
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        arm();
        observer.disconnect();
      });
    }, { rootMargin: "200px" });
    observer.observe(video);
  });

  var rotator = document.querySelector("[data-rotate]");
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (rotator && !reduce) {
    var words = rotator.getAttribute("data-rotate").split("|");
    var index = 0;
    window.setInterval(function () {
      index = (index + 1) % words.length;
      rotator.textContent = words[index];
    }, 2200);
  }

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
})();
