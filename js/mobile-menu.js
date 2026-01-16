/**
 * Mobile Menu Drawer
 * 
 * Bottom sheet style menu for tablet/mobile devices
 */

(function() {
	'use strict';

	const hamburgerButton = document.querySelector('.hamburger-button');
	const mobileMenuDrawer = document.querySelector('.mobile-menu-drawer');
	const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
	const body = document.body;

	if (!hamburgerButton || !mobileMenuDrawer || !mobileMenuOverlay) {
		return;
	}

	let isOpen = false;
	let startY = 0;
	let currentY = 0;
	let isDragging = false;

	/**
	 * Open the mobile menu
	 */
	function openMenu() {
		isOpen = true;
		mobileMenuDrawer.classList.add('is-active');
		mobileMenuOverlay.classList.add('is-active');
		mobileMenuDrawer.setAttribute('aria-hidden', 'false');
		mobileMenuOverlay.setAttribute('aria-hidden', 'false');
		body.classList.add('mobile-menu-open');
		hamburgerButton.setAttribute('aria-expanded', 'true');
	}

	/**
	 * Close the mobile menu
	 */
	function closeMenu() {
		isOpen = false;
		mobileMenuDrawer.classList.remove('is-active');
		mobileMenuOverlay.classList.remove('is-active');
		mobileMenuDrawer.setAttribute('aria-hidden', 'true');
		mobileMenuOverlay.setAttribute('aria-hidden', 'true');
		body.classList.remove('mobile-menu-open');
		hamburgerButton.setAttribute('aria-expanded', 'false');
		
		// Reset transform
		mobileMenuDrawer.style.transform = '';
	}

	/**
	 * Toggle menu state
	 */
	function toggleMenu() {
		if (isOpen) {
			closeMenu();
		} else {
			openMenu();
		}
	}

	// Hamburger button click
	hamburgerButton.addEventListener('click', function(e) {
		e.preventDefault();
		toggleMenu();
	});

	// Overlay click to close
	mobileMenuOverlay.addEventListener('click', closeMenu);

	// Close on Escape key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && isOpen) {
			closeMenu();
		}
	});

	// Touch drag to close (swipe down)
	const handle = mobileMenuDrawer.querySelector('.mobile-menu-handle');
	
	function handleTouchStart(e) {
		startY = e.touches[0].clientY;
		isDragging = true;
		mobileMenuDrawer.style.transition = 'none';
	}

	function handleTouchMove(e) {
		if (!isDragging) return;
		
		currentY = e.touches[0].clientY;
		const deltaY = currentY - startY;
		
		// Only allow dragging down
		if (deltaY > 0) {
			mobileMenuDrawer.style.transform = `translateY(${deltaY}px)`;
		}
	}

	function handleTouchEnd() {
		if (!isDragging) return;
		
		isDragging = false;
		mobileMenuDrawer.style.transition = '';
		
		const deltaY = currentY - startY;
		
		// If dragged more than 100px down, close the menu
		if (deltaY > 100) {
			closeMenu();
		} else {
			// Snap back
			mobileMenuDrawer.style.transform = '';
		}
	}

	if (handle) {
		handle.addEventListener('touchstart', handleTouchStart, { passive: true });
		handle.addEventListener('touchmove', handleTouchMove, { passive: true });
		handle.addEventListener('touchend', handleTouchEnd, { passive: true });
	}

	// Also allow dragging from the entire drawer
	mobileMenuDrawer.addEventListener('touchstart', function(e) {
		// Only start drag if touching the handle area (top 60px)
		const rect = mobileMenuDrawer.getBoundingClientRect();
		const touchY = e.touches[0].clientY - rect.top;
		if (touchY < 60) {
			handleTouchStart(e);
		}
	}, { passive: true });

	mobileMenuDrawer.addEventListener('touchmove', handleTouchMove, { passive: true });
	mobileMenuDrawer.addEventListener('touchend', handleTouchEnd, { passive: true });

	// Close menu on window resize (if transitioning to desktop)
	let resizeTimer;
	window.addEventListener('resize', function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {
			if (window.innerWidth > 1024 && isOpen) {
				closeMenu();
			}
		}, 100);
	});

})();
