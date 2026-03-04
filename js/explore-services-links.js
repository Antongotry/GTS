/**
 * Explore services links behavior:
 * - Smooth scroll to #services-block when present.
 * - On tablet/mobile in service pages, footer button opens mobile menu Services submenu.
 */
(function() {
	'use strict';

	function isServicePage() {
		var body = document.body;
		if (!body) {
			return false;
		}

		return (
			body.classList.contains('single-service') ||
			body.classList.contains('page-template-page-limousine-service') ||
			body.classList.contains('page-template-page-city-to-city')
		);
	}

	function openMobileServicesSubmenu() {
		var drawer = document.querySelector('.mobile-menu-drawer');
		var hamburger = document.querySelector('.hamburger-button');
		var servicesTrigger = drawer ? drawer.querySelector('.mobile-submenu-trigger') : null;

		if (!drawer || !hamburger || !servicesTrigger) {
			return;
		}

		if (!drawer.classList.contains('is-active')) {
			hamburger.click();
		}

		window.setTimeout(function() {
			if (!drawer.classList.contains('submenu-open')) {
				servicesTrigger.click();
			}
		}, 80);
	}

	function handleClick(event) {
		var link = event.target.closest('a.btn-secondary, a.footer-button-secondary');
		if (!link) {
			return;
		}

		var href = (link.getAttribute('href') || '').trim();
		if ('#services-block' !== href) {
			return;
		}

		var isFooterButton = link.classList.contains('footer-button-secondary');
		var isMobileOrTablet = window.matchMedia('(max-width: 1024px)').matches;

		if (isFooterButton && isMobileOrTablet && isServicePage()) {
			event.preventDefault();
			openMobileServicesSubmenu();
			return;
		}

		var target = document.getElementById('services-block');
		if (target) {
			event.preventDefault();
			target.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	document.addEventListener('click', handleClick);
})();

