/* Madar Heights — interactions & motion (no dependencies) */
(function () {
    'use strict';

    var doc = document.documentElement;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Preloader ---------- */
    var preloader = document.getElementById('preloader');
    function hidePreloader() { if (preloader) preloader.classList.add('is-done'); }
    window.addEventListener('load', function () { setTimeout(hidePreloader, 350); });
    setTimeout(hidePreloader, 3000); // safety net

    /* ---------- Theme toggle ---------- */
    var toggle = document.getElementById('themeToggle');
    if (toggle) {
        toggle.addEventListener('click', function () {
            var next = doc.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            doc.setAttribute('data-theme', next);
            try { localStorage.setItem('mh-theme', next); } catch (e) {}
        });
    }

    /* ---------- Header / progress / back-to-top ---------- */
    var header = document.getElementById('header');
    var progress = document.getElementById('scrollProgress');
    var toTop = document.getElementById('toTop');
    function onScroll() {
        var y = window.scrollY;
        var max = document.body.scrollHeight - window.innerHeight;
        if (header) header.classList.toggle('is-scrolled', y > 40);
        if (progress) progress.style.width = (max > 0 ? (y / max) * 100 : 0) + '%';
        if (toTop) toTop.classList.toggle('is-visible', y > 600);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
    if (toTop) toTop.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });

    /* ---------- Mobile menu ---------- */
    var burger = document.getElementById('burger');
    var nav = document.getElementById('nav');
    function setNav(open) {
        nav.classList.toggle('is-open', open);
        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.classList.toggle('nav-open', open);
    }
    if (burger && nav) {
        burger.addEventListener('click', function (e) {
            e.stopPropagation();
            setNav(!nav.classList.contains('is-open'));
        });
        document.addEventListener('click', function (e) {
            if (nav.classList.contains('is-open') && !nav.contains(e.target)) setNav(false);
        });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setNav(false); });
        nav.querySelectorAll('.has-drop > a').forEach(function (a) {
            a.addEventListener('click', function (e) {
                if (window.innerWidth > 991) return;
                e.preventDefault();
                a.parentElement.classList.toggle('is-open');
            });
        });
        nav.querySelectorAll('.drop a, .nav__order, .nav__list > li:not(.has-drop) > a').forEach(function (a) {
            a.addEventListener('click', function () { setNav(false); });
        });
    }

    /* ---------- Scroll reveal ---------- */
    var revealEls = document.querySelectorAll('[data-reveal]');
    revealEls.forEach(function (el) {
        var d = el.getAttribute('data-delay');
        if (d) el.style.setProperty('--d', d + 'ms');
    });
    if ('IntersectionObserver' in window && !reduceMotion) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('is-in'); });
    }

    /* ---------- Counters ---------- */
    function animateCount(el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        var suffix = el.getAttribute('data-suffix') || '';
        if (reduceMotion) { el.textContent = target.toLocaleString('en') + suffix; return; }
        var start = null, dur = 2000;
        function step(ts) {
            if (!start) start = ts;
            var p = Math.min((ts - start) / dur, 1);
            var eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased).toLocaleString('en') + suffix;
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }
    var counters = document.querySelectorAll('[data-count]');
    if ('IntersectionObserver' in window) {
        var co = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) { animateCount(en.target); co.unobserve(en.target); }
            });
        }, { threshold: 0.5 });
        counters.forEach(function (el) { co.observe(el); });
    } else {
        counters.forEach(animateCount);
    }

    /* ---------- Typing rotator ---------- */
    var typed = document.querySelector('.typed');
    if (typed && !reduceMotion) {
        var words = JSON.parse(typed.getAttribute('data-words') || '[]');
        var wi = 0, ci = words[0] ? words[0].length : 0, deleting = true;
        function tick() {
            var word = words[wi];
            if (deleting) {
                ci--;
                typed.textContent = word.slice(0, ci);
                if (ci <= 0) { deleting = false; wi = (wi + 1) % words.length; return setTimeout(tick, 300); }
                return setTimeout(tick, 45);
            }
            word = words[wi];
            ci++;
            typed.textContent = word.slice(0, ci);
            if (ci >= word.length) { deleting = true; return setTimeout(tick, 2200); }
            setTimeout(tick, 85);
        }
        if (words.length > 1) setTimeout(tick, 2600);
    }

    /* ---------- Testimonials slider ---------- */
    document.querySelectorAll('[data-slider]').forEach(function (slider) {
        var track = slider.querySelector('.slider__track');
        var slides = track.children;
        var dotsBox = slider.querySelector('.slider__dots');
        var index = 0, timer = null;
        var isRtl = getComputedStyle(slider).direction === 'rtl';

        function perView() {
            var w = slides[0].getBoundingClientRect().width;
            return Math.max(1, Math.round(slider.getBoundingClientRect().width / w));
        }
        function pages() { return Math.max(1, slides.length - perView() + 1); }
        function renderDots() {
            dotsBox.innerHTML = '';
            for (var i = 0; i < pages(); i++) {
                var b = document.createElement('button');
                b.type = 'button';
                b.setAttribute('aria-label', 'الرأي ' + (i + 1));
                b.addEventListener('click', (function (n) { return function () { go(n); restart(); }; })(i));
                dotsBox.appendChild(b);
            }
        }
        function go(n) {
            var total = pages();
            index = (n + total) % total;
            var w = slides[0].getBoundingClientRect().width;
            track.style.transform = 'translateX(' + (isRtl ? 1 : -1) * index * w + 'px)';
            Array.prototype.forEach.call(dotsBox.children, function (d, i) { d.classList.toggle('is-active', i === index); });
        }
        function restart() {
            clearInterval(timer);
            if (!reduceMotion) timer = setInterval(function () { go(index + 1); }, 4500);
        }

        // swipe
        var sx = null;
        track.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', function (e) {
            if (sx === null) return;
            var dx = e.changedTouches[0].clientX - sx;
            if (Math.abs(dx) > 40) go(index + ((dx > 0) === isRtl ? 1 : -1));
            sx = null; restart();
        });
        slider.addEventListener('mouseenter', function () { clearInterval(timer); });
        slider.addEventListener('mouseleave', restart);

        var rt;
        window.addEventListener('resize', function () {
            clearTimeout(rt);
            rt = setTimeout(function () { renderDots(); go(Math.min(index, pages() - 1)); }, 150);
        });

        renderDots(); go(0); restart();
    });

    /* ---------- 3D tilt on service cards ---------- */
    if (!reduceMotion && window.matchMedia('(hover: hover)').matches) {
        document.querySelectorAll('[data-tilt]').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var r = card.getBoundingClientRect();
                var x = (e.clientX - r.left) / r.width - 0.5;
                var y = (e.clientY - r.top) / r.height - 0.5;
                card.style.transform = 'perspective(800px) rotateX(' + (-y * 8) + 'deg) rotateY(' + (x * 8) + 'deg) translateY(-6px)';
            });
            card.addEventListener('mouseleave', function () { card.style.transform = ''; });
        });
    }

    /* ---------- Hero parallax (orbit follows mouse slightly) ---------- */
    var visual = document.querySelector('.hero__visual .orbit');
    if (visual && !reduceMotion && window.matchMedia('(hover: hover)').matches) {
        document.querySelector('.hero').addEventListener('mousemove', function (e) {
            var x = (e.clientX / window.innerWidth - 0.5) * 20;
            var y = (e.clientY / window.innerHeight - 0.5) * 20;
            visual.style.transform = 'translate(' + x + 'px,' + y + 'px)';
        });
    }

    /* ---------- "اطلب الخدمة" buttons preselect the service ---------- */
    document.querySelectorAll('[data-pick-service]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var sel = document.querySelector('#booking select[name="service"]');
            if (sel) sel.value = btn.getAttribute('data-pick-service');
        });
    });

    /* ---------- Bring validation errors into view ---------- */
    var err = document.querySelector('.field__error');
    if (err) {
        var booking = document.getElementById('booking');
        if (booking) setTimeout(function () { booking.scrollIntoView({ behavior: 'smooth' }); }, 400);
    }
})();
