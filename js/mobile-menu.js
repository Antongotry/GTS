/**
 * Mobile Menu - Sliding Doors Effect
 * 
 * When clicking Services:
 * - Main menu slides DOWN (back where it came from)
 * - Submenu slides in from TOP (mirror effect)
 */

(function() {
	'use strict';

	// Elements
	const hamburger = document.querySelector('.hamburger-button');
	const drawer = document.querySelector('.mobile-menu-drawer');
	const overlay = document.querySelector('.mobile-menu-overlay');
	const body = document.body;

	if (!hamburger || !drawer || !overlay) {
		return;
	}

	let isOpen = false;
	let isSubmenuOpen = false;

	// Open menu
	function openMenu() {
		isOpen = true;
		drawer.classList.add('is-active');
		overlay.classList.add('is-active');
		body.classList.add('mobile-menu-open');
		drawer.setAttribute('aria-hidden', 'false');
		hamburger.setAttribute('aria-expanded', 'true');
	}

	// Close menu completely
	function closeMenu() {
		isOpen = false;
		isSubmenuOpen = false;
		drawer.classList.remove('is-active', 'submenu-open');
		overlay.classList.remove('is-active');
		body.classList.remove('mobile-menu-open');
		drawer.setAttribute('aria-hidden', 'true');
		hamburger.setAttribute('aria-expanded', 'false');
	}

	// Open submenu (sliding doors effect)
	function openSubmenu() {
		isSubmenuOpen = true;
		drawer.classList.add('submenu-open');
	}

	// Close submenu (back to main)
	function closeSubmenu() {
		isSubmenuOpen = false;
		drawer.classList.remove('submenu-open');
	}

	// Toggle menu
	function toggleMenu() {
		isOpen ? closeMenu() : openMenu();
	}

	// Event: Hamburger click
	hamburger.addEventListener('click', function(e) {
		e.preventDefault();
		toggleMenu();
	});

	// Event: Overlay click
	overlay.addEventListener('click', closeMenu);

	// Event: Services button click
	const servicesBtn = drawer.querySelector('.mobile-submenu-trigger');
	if (servicesBtn) {
		servicesBtn.addEventListener('click', function(e) {
			e.preventDefault();
			openSubmenu();
		});
	}

	// Event: Back button click
	const backBtn = drawer.querySelector('.mobile-submenu-back');
	if (backBtn) {
		backBtn.addEventListener('click', function(e) {
			e.preventDefault();
			closeSubmenu();
		});
	}

	// Event: ESC key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && isOpen) {
			if (isSubmenuOpen) {
				closeSubmenu();
			} else {
				closeMenu();
			}
		}
	});

	// Swipe down to close
	let startY = 0;
	let currentY = 0;
	let isDragging = false;

	drawer.addEventListener('touchstart', function(e) {
		if (isSubmenuOpen) return;
		const rect = drawer.getBoundingClientRect();
		const touchY = e.touches[0].clientY - rect.top;
		if (touchY < 50) {
			startY = e.touches[0].clientY;
			isDragging = true;
			drawer.style.transition = 'none';
		}
	}, { passive: true });

	drawer.addEventListener('touchmove', function(e) {
		if (!isDragging) return;
		currentY = e.touches[0].clientY;
		const delta = currentY - startY;
		if (delta > 0) {
			drawer.style.transform = 'translateY(' + delta + 'px)';
		}
	}, { passive: true });

	drawer.addEventListener('touchend', function() {
		if (!isDragging) return;
		isDragging = false;
		drawer.style.transition = '';
		const delta = currentY - startY;
		if (delta > 80) {
			closeMenu();
		} else {
			drawer.style.transform = '';
		}
	}, { passive: true });

	// Close on resize to desktop
	window.addEventListener('resize', function() {
		if (window.innerWidth > 1024 && isOpen) {
			closeMenu();
		}
	});

})();
