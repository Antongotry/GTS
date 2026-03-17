(function () {
	'use strict';

	function initLanguageSelector() {
		var selectors = document.querySelectorAll('.language-selector');
		if (!selectors.length) return;

		var hoverQuery = window.matchMedia('(min-width: 769px) and (hover: hover) and (pointer: fine)');

		Array.prototype.forEach.call(selectors, function (selector) {
			var closeTimer = 0;
			var toggle = selector.querySelector('.language-selector__toggle');

			function clearCloseTimer() {
				if (!closeTimer) return;

				window.clearTimeout(closeTimer);
				closeTimer = 0;
			}

			function setOpenState(isOpen) {
				selector.classList.toggle('is-open', isOpen);

				if (toggle) {
					toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
				}
			}

			function openMenu() {
				if (!hoverQuery.matches) return;

				clearCloseTimer();
				setOpenState(true);
			}

			function closeMenu() {
				clearCloseTimer();
				setOpenState(false);
			}

			function scheduleClose() {
				if (!hoverQuery.matches) {
					closeMenu();
					return;
				}

				clearCloseTimer();
				closeTimer = window.setTimeout(function () {
					closeTimer = 0;
					setOpenState(false);
				}, 250);
			}

			if (toggle) {
				toggle.setAttribute('aria-haspopup', 'true');
				toggle.setAttribute('aria-expanded', 'false');
			}

			selector.addEventListener('mouseenter', openMenu);
			selector.addEventListener('mouseleave', scheduleClose);
			selector.addEventListener('focusin', openMenu);
			selector.addEventListener('focusout', function (event) {
				if (event.relatedTarget && selector.contains(event.relatedTarget)) {
					return;
				}

				scheduleClose();
			});

			if (typeof hoverQuery.addEventListener === 'function') {
				hoverQuery.addEventListener('change', function (event) {
					if (!event.matches) {
						closeMenu();
					}
				});
			} else if (typeof hoverQuery.addListener === 'function') {
				hoverQuery.addListener(function (event) {
					if (!event.matches) {
						closeMenu();
					}
				});
			}
		});
	}

	function initDesktopServicesMenu() {
		var trigger = document.querySelector('.menu-link--button');
		var item = trigger ? trigger.closest('.menu-item-has-children') : null;
		var submenu = item ? item.querySelector('.sub-menu') : null;

		if (!trigger || !item || !submenu) {
			return;
		}

		function setOpenState(isOpen) {
			item.classList.toggle('is-open', isOpen);
			trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		}

		trigger.addEventListener('click', function (event) {
			event.preventDefault();
			setOpenState(!item.classList.contains('is-open'));
		});

		item.addEventListener('focusout', function (event) {
			if (event.relatedTarget && item.contains(event.relatedTarget)) {
				return;
			}
			setOpenState(false);
		});

		document.addEventListener('click', function (event) {
			if (item.contains(event.target)) {
				return;
			}
			setOpenState(false);
		});

		document.addEventListener('keydown', function (event) {
			if ('Escape' !== event.key) {
				return;
			}

			setOpenState(false);
			trigger.blur();
		});
	}

	function syncHeaderMetrics() {
		var header = document.querySelector('.site-header');
		if (!header) return;

		var height = Math.ceil(header.getBoundingClientRect().height);
		if (height > 0) {
			document.documentElement.style.setProperty('--site-header-height', height + 'px');
		}

		var headerContainer = header.querySelector('.header-container');
		if (headerContainer) {
			var width = Math.round(headerContainer.getBoundingClientRect().width);
			if (width > 0) {
				document.documentElement.style.setProperty('--gts-header-width', width + 'px');
			}
		}
	}

	document.addEventListener('DOMContentLoaded', initLanguageSelector);
	document.addEventListener('DOMContentLoaded', initDesktopServicesMenu);
	document.addEventListener('DOMContentLoaded', syncHeaderMetrics);
	window.addEventListener('load', syncHeaderMetrics);
	window.addEventListener('resize', syncHeaderMetrics, { passive: true });

	if (typeof ResizeObserver !== 'undefined') {
		var header = document.querySelector('.site-header');
		if (header) {
			var observer = new ResizeObserver(syncHeaderMetrics);
			observer.observe(header);
			var headerContainer = header.querySelector('.header-container');
			if (headerContainer) {
				observer.observe(headerContainer);
			}
		}
	}
})();
