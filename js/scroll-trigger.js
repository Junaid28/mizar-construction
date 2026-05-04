/**
 * Smooth Scroll Trigger for AkhtarStudio.com
 * Uses GSAP + ScrollTrigger
 *
 * SETUP: Add these two scripts to your HTML <head> or before </body>:
 *
 * <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
 * <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
 * <script src="scroll-trigger.js"></script>
 *
 * Also add this CSS to your stylesheet (or in a <style> tag):
 * html { scroll-behavior: smooth; }
 */

(function () {
  "use strict";

  // ─── 1. Register Plugin ────────────────────────────────────────────────────
  gsap.registerPlugin(ScrollTrigger);

  // ─── 2. Scroll Progress Bar ────────────────────────────────────────────────
  const progressBar = document.createElement("div");
  progressBar.id = "scroll-progress";
  Object.assign(progressBar.style, {
    position: "fixed",
    top: "0",
    left: "0",
    width: "0%",
    height: "3px",
    background: "#000",        // ← change to your brand accent color
    zIndex: "9999",
    transition: "width 0.1s linear",
    pointerEvents: "none",
  });
  document.body.appendChild(progressBar);

  gsap.to(progressBar, {
    width: "100%",
    ease: "none",
    scrollTrigger: {
      trigger: document.body,
      start: "top top",
      end: "bottom bottom",
      scrub: 0.3,
      onUpdate: (self) => {
        progressBar.style.width = self.progress * 100 + "%";
      },
    },
  });

  // ─── 3. Helper: fade + slide up (generic) ─────────────────────────────────
  function revealUp(selector, options = {}) {
    const els = gsap.utils.toArray(selector);
    if (!els.length) return;
    els.forEach((el) => {
      gsap.from(el, {
        y: options.y ?? 50,
        opacity: 0,
        duration: options.duration ?? 0.9,
        ease: options.ease ?? "power3.out",
        delay: options.delay ?? 0,
        scrollTrigger: {
          trigger: el,
          start: options.start ?? "top 88%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  // ─── 4. Helper: stagger children ──────────────────────────────────────────
  function revealStagger(parentSelector, childSelector, options = {}) {
    const parents = gsap.utils.toArray(parentSelector);
    if (!parents.length) return;
    parents.forEach((parent) => {
      const children = parent.querySelectorAll(childSelector);
      if (!children.length) return;
      gsap.from(children, {
        y: options.y ?? 40,
        opacity: 0,
        duration: options.duration ?? 0.7,
        stagger: options.stagger ?? 0.12,
        ease: options.ease ?? "power2.out",
        scrollTrigger: {
          trigger: parent,
          start: options.start ?? "top 85%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  // ─── 5. Helper: scale-in for images ───────────────────────────────────────
  function revealScale(selector, options = {}) {
    const els = gsap.utils.toArray(selector);
    if (!els.length) return;
    els.forEach((el) => {
      gsap.from(el, {
        scale: options.scale ?? 0.92,
        opacity: 0,
        duration: options.duration ?? 1.0,
        ease: options.ease ?? "power2.out",
        scrollTrigger: {
          trigger: el,
          start: options.start ?? "top 90%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  // ─── 6. Helper: reveal from left / right ──────────────────────────────────
  function revealSide(selector, direction = "left", options = {}) {
    const els = gsap.utils.toArray(selector);
    if (!els.length) return;
    const xOffset = direction === "left" ? -60 : 60;
    els.forEach((el) => {
      gsap.from(el, {
        x: xOffset,
        opacity: 0,
        duration: options.duration ?? 0.9,
        ease: options.ease ?? "power3.out",
        scrollTrigger: {
          trigger: el,
          start: options.start ?? "top 88%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  // ─── 7. Hero / Above-the-fold animation ───────────────────────────────────
  // Runs immediately on page load (no scroll needed)
  function animateHero() {
    const heroSelectors = [
      "hero", "header", ".hero", ".hero-section",
      "#hero", "#header", "[data-hero]",
    ];
    const hero = heroSelectors.map(s => document.querySelector(s)).find(Boolean);
    if (!hero) return;

    const heroChildren = hero.querySelectorAll("h1, h2, p, a, button, img, .btn");
    if (heroChildren.length) {
      gsap.from(heroChildren, {
        y: 30,
        opacity: 0,
        duration: 0.8,
        stagger: 0.15,
        ease: "power3.out",
        delay: 0.2,
      });
    } else {
      gsap.from(hero, { opacity: 0, y: 20, duration: 1, ease: "power3.out" });
    }
  }

  // ─── 8. Parallax on any element with data-parallax ────────────────────────
  function setupParallax() {
    const els = gsap.utils.toArray("[data-parallax]");
    els.forEach((el) => {
      const speed = parseFloat(el.dataset.parallaxSpeed ?? "0.3");
      gsap.to(el, {
        y: () => el.offsetHeight * speed * -1,
        ease: "none",
        scrollTrigger: {
          trigger: el,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
        },
      });
    });
  }

  // ─── 9. Sticky navbar shrink on scroll ────────────────────────────────────
  function setupNavbar() {
    const navSelectors = ["nav", ".nav", ".navbar", "#navbar", "header nav"];
    const nav = navSelectors.map(s => document.querySelector(s)).find(Boolean);
    if (!nav) return;

    ScrollTrigger.create({
      start: "top -60",
      onEnter: () => nav.classList.add("scrolled"),
      onLeaveBack: () => nav.classList.remove("scrolled"),
    });

    // Inject minimal scrolled style if not already in CSS
    if (!document.querySelector("#nav-scroll-style")) {
      const style = document.createElement("style");
      style.id = "nav-scroll-style";
      style.textContent = `
        nav.scrolled, .nav.scrolled, .navbar.scrolled, #navbar.scrolled {
          box-shadow: 0 2px 20px rgba(0,0,0,0.08);
          background: rgba(255,255,255,0.95) !important;
          backdrop-filter: blur(8px);
          transition: all 0.3s ease;
        }
      `;
      document.head.appendChild(style);
    }
  }

  // ─── 10. Reveal lines (split text) — lightweight version ──────────────────
  function revealHeadlines() {
    const headings = gsap.utils.toArray("h1, h2, h3");
    headings.forEach((h) => {
      // skip hero headings (already animated above)
      if (h.closest(".hero, #hero, [data-hero], header")) return;
      gsap.from(h, {
        y: 24,
        opacity: 0,
        duration: 0.75,
        ease: "power3.out",
        scrollTrigger: {
          trigger: h,
          start: "top 90%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  // ─── 11. Wire Everything Up ───────────────────────────────────────────────
  function init() {
    animateHero();
    setupNavbar();
    setupParallax();
    revealHeadlines();

    // Common section / content patterns
    revealUp("section, .section", { y: 30, duration: 0.8 });
    revealUp("p, .subtitle, .description, .lead", { y: 25, duration: 0.7 });

    // Cards / grid items — stagger within parent
    revealStagger(
      ".cards, .grid, .services, .portfolio, .projects, .team, .work",
      ".card, .item, .service, .project, .member, article",
      { stagger: 0.1 }
    );

    // Images
    revealScale("img:not([data-no-anim]), .image, .media, .thumbnail, video");

    // Buttons / CTAs
    revealUp(".btn, .cta, button:not([data-no-anim]), a.button", { y: 20, duration: 0.6 });

    // Side reveals (add class manually or adapt selectors below)
    revealSide(".reveal-left, [data-reveal='left']", "left");
    revealSide(".reveal-right, [data-reveal='right']", "right");

    // Refresh ScrollTrigger after all images load (avoids position mismatches)
    window.addEventListener("load", () => ScrollTrigger.refresh());
  }

  // Run after DOM is ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
