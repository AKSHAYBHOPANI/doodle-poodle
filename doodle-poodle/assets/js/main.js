/**
 * Doodle Poodle - front-end interactions.
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {

		/* ---- Mobile nav toggle ---- */
		var toggle = document.querySelector('.dp-nav-toggle');
		if (toggle) {
			toggle.addEventListener('click', function () {
				var open = document.body.classList.toggle('dp-nav-open');
				toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			});

			// Close nav when a link is clicked or when clicking the overlay.
			document.addEventListener('click', function (e) {
				if (!document.body.classList.contains('dp-nav-open')) {
					return;
				}
				var nav = document.querySelector('.dp-nav');
				var isLink = e.target.closest('.dp-nav a');
				var insideNav = e.target.closest('.dp-nav');
				var onToggle = e.target.closest('.dp-nav-toggle');
				if (isLink || (!insideNav && !onToggle)) {
					document.body.classList.remove('dp-nav-open');
					toggle.setAttribute('aria-expanded', 'false');
				}
			});
		}

		/* ---- Product tabs ---- */
		document.querySelectorAll('[data-dp-tabs]').forEach(function (group) {
			var tabs = group.querySelectorAll('.dp-tab');
			var panels = group.querySelectorAll('.dp-tabs__panel');
			tabs.forEach(function (tab) {
				tab.addEventListener('click', function () {
					var target = tab.getAttribute('data-tab');
					tabs.forEach(function (t) {
						var active = t === tab;
						t.classList.toggle('is-active', active);
						t.setAttribute('aria-selected', active ? 'true' : 'false');
					});
					panels.forEach(function (p) {
						p.classList.toggle('is-active', p.getAttribute('data-panel') === target);
					});
				});
			});
		});

		/* ---- Hero carousel ---- */
		document.querySelectorAll('[data-dp-carousel]').forEach(function (carousel) {
			var track = carousel.querySelector('.dp-carousel__track');
			var slides = carousel.querySelectorAll('.dp-carousel__slide');
			var dots = carousel.querySelectorAll('.dp-carousel__dot');
			var prev = carousel.querySelector('.dp-carousel__btn--prev');
			var next = carousel.querySelector('.dp-carousel__btn--next');
			var count = slides.length;
			if (!track || count < 2) {
				if (prev) { prev.style.display = 'none'; }
				if (next) { next.style.display = 'none'; }
				return;
			}

			var index = 0;
			var delay = parseInt(carousel.getAttribute('data-autoplay'), 10) || 0;
			var timer = null;

			function goTo(i) {
				index = (i + count) % count;
				track.style.transform = 'translateX(' + (-index * 100) + '%)';
				slides.forEach(function (s, n) { s.classList.toggle('is-active', n === index); });
				dots.forEach(function (d, n) {
					d.classList.toggle('is-active', n === index);
					d.setAttribute('aria-selected', n === index ? 'true' : 'false');
				});
			}

			function start() {
				if (delay > 0) { stop(); timer = setInterval(function () { goTo(index + 1); }, delay); }
			}
			function stop() { if (timer) { clearInterval(timer); timer = null; } }

			if (next) { next.addEventListener('click', function () { goTo(index + 1); start(); }); }
			if (prev) { prev.addEventListener('click', function () { goTo(index - 1); start(); }); }
			dots.forEach(function (dot) {
				dot.addEventListener('click', function () { goTo(parseInt(dot.getAttribute('data-index'), 10)); start(); });
			});

			carousel.addEventListener('mouseenter', stop);
			carousel.addEventListener('mouseleave', start);

			// Touch / swipe support.
			var startX = 0;
			carousel.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; stop(); }, { passive: true });
			carousel.addEventListener('touchend', function (e) {
				var diff = e.changedTouches[0].clientX - startX;
				if (Math.abs(diff) > 40) { goTo(index + (diff < 0 ? 1 : -1)); }
				start();
			}, { passive: true });

			goTo(0);
			start();
		});

		/* ---- Sticky header shadow on scroll ---- */
		var header = document.querySelector('.dp-header');
		if (header) {
			var onScroll = function () {
				header.classList.toggle('is-scrolled', window.scrollY > 10);
			};
			window.addEventListener('scroll', onScroll, { passive: true });
			onScroll();
		}
	});
})();
