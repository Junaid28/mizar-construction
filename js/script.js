document.addEventListener('DOMContentLoaded', () => {
  const updateBackground = () => {
    document.body.classList.toggle('scrolled', window.scrollY > 200);
  };

  updateBackground();
  window.addEventListener('scroll', updateBackground);

  const animateCounter = (element) => {
    const target = Number(element.dataset.target) || 0;
    const suffix = element.dataset.suffix || '';
    let current = 0;
    const step = Math.max(1, Math.floor(target / 180));

    const update = () => {
      current += step;
      if (current >= target) {
        current = target;
      }
      const formatted = target >= 1000 ? `${Math.round(current / 1000)}${suffix}` : `${current}${suffix}`;
      element.textContent = formatted;
      if (current < target) {
        window.requestAnimationFrame(update);
      }
    };

    update();
  };

  const observer = new IntersectionObserver((entries, observerInstance) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const counter = entry.target.querySelector('.counter');
        if (counter && !counter.dataset.animated) {
          animateCounter(counter);
          counter.dataset.animated = 'true';
        }
        observerInstance.unobserve(entry.target);
      }
    });
  }, { threshold: 0.4 });

  document.querySelectorAll('.stat-card').forEach((card) => observer.observe(card));
});
(function () {
      // ── 1. Navbar shadow on scroll ──
      const navbar = document.querySelector('.navbar');
      window.addEventListener('scroll', function () {
        navbar.classList.toggle('scrolled', window.scrollY > 20);
      }, { passive: true });

      // ── 2. IntersectionObserver for scroll-triggered animations ──
      const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target); // fire once
          }
        });
      }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

      const animTargets = document.querySelectorAll(
        '.anim-fade-up, .anim-fade-left, .anim-fade-right, .anim-scale, .anim-fade'
      );
      animTargets.forEach(function (el) { observer.observe(el); });

      // ── 3. Animated counter for stat numbers ──
      function animateCounter(el) {
        const target = parseInt(el.dataset.target, 10);
        const suffix = el.dataset.suffix || '';
        const duration = 2000;
        const start = performance.now();

        function step(now) {
          const progress = Math.min((now - start) / duration, 1);
          // Ease out expo — snappy start, glides to exact end
          const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
          const current = Math.round(eased * target);
          el.textContent = current.toLocaleString() + suffix;
          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            // Guarantee exact final value
            el.textContent = target.toLocaleString() + suffix;
          }
        }
        requestAnimationFrame(step);
      }

      const counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
          }
        });
      }, { threshold: 0.5 });

      document.querySelectorAll('.counter').forEach(function (el) {
        counterObserver.observe(el);
      });

      // ── 4. Property image parallax on mouse move ──
      document.querySelectorAll('.property-card').forEach(function (card) {
        card.addEventListener('mousemove', function (e) {
          const rect = card.getBoundingClientRect();
          const x = ((e.clientX - rect.left) / rect.width - 0.5) * 8;
          const y = ((e.clientY - rect.top) / rect.height - 0.5) * 8;
          card.style.transform = 'translateY(-6px) rotateX(' + (-y) + 'deg) rotateY(' + x + 'deg)';
          card.style.perspective = '800px';
        });
        card.addEventListener('mouseleave', function () {
          card.style.transform = '';
          card.style.perspective = '';
        });
      });

    })();
  // Contact tag selection
      const contactTags = document.querySelectorAll('.contact-tag');
      const hiddenInput = document.getElementById('selected-interest');

      contactTags.forEach(function(tag) {
        tag.addEventListener('click', function() {
          // Remove active from all
          contactTags.forEach(function(t) {
            t.classList.remove('contact-tag--active');
            t.setAttribute('aria-pressed', 'false');
          });
          // Activate clicked tag
          tag.classList.add('contact-tag--active');
          tag.setAttribute('aria-pressed', 'true');
          // Store selected value
          if (hiddenInput) hiddenInput.value = tag.dataset.value;
        });
      });
