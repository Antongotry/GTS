/* global Lenis */

(function () {
	// Initialize Lenis for smooth scrolling
	if (window.Lenis && !window.gtsLenis) {
		window.gtsLenis = new Lenis({
			smoothWheel: true,
			smoothTouch: true,
			wheelMultiplier: 0.85,
			touchMultiplier: 1.1,
			lerp: 0.075,
		});

		const raf = (time) => {
			window.gtsLenis.raf(time);
			window.requestAnimationFrame(raf);
		};
		window.requestAnimationFrame(raf);
	}

	// Set correct viewport height CSS variable
	const setViewportHeight = () => {
		document.documentElement.style.setProperty('--gts-vh', `${window.innerHeight}px`);
	};

	setViewportHeight();
	window.addEventListener('resize', setViewportHeight);

	const section = document.querySelector('.how-it-works-block');
	const steps = document.querySelector('.how-it-works-steps');

	if (!section || !steps) {
		return;
	}

	const lenis = window.gtsLenis;
	let isLocked = false;

	// Check if section is fully in viewport
	function isSectionFullyInView() {
		const rect = section.getBoundingClientRect();
		// Block top is at or above viewport top, AND block bottom is at or below viewport bottom
		return rect.top <= 1 && rect.bottom >= window.innerHeight - 1;
	}

	// Check scroll boundaries
	function isAtTop() {
		return steps.scrollTop <= 1;
	}

	function isAtBottom() {
		return steps.scrollTop + steps.clientHeight >= steps.scrollHeight - 1;
	}

	// Lock scroll - disable page scroll completely
	function lockScroll() {
		if (!isLocked) {
			isLocked = true;
			// Stop Lenis
			if (lenis) {
				lenis.stop();
			}
			// Also block native scroll by adding overflow hidden to body
			document.body.style.overflow = 'hidden';
			document.documentElement.style.overflow = 'hidden';
		}
	}

	// Unlock scroll - re-enable page scroll
	function unlockScroll() {
		if (isLocked) {
			isLocked = false;
			// Start Lenis
			if (lenis) {
				lenis.start();
			}
			// Remove overflow hidden
			document.body.style.overflow = '';
			document.documentElement.style.overflow = '';
		}
	}

	// Handle wheel events
	function handleWheel(event) {
		const fullyInView = isSectionFullyInView();
		const delta = event.deltaY;
		const scrollingDown = delta > 0;
		const scrollingUp = delta < 0;
		const atTop = isAtTop();
		const atBottom = isAtBottom();

		// If section is fully in view
		if (fullyInView) {
			// Check if we need to unlock (reached edge of steps)
			if (isLocked) {
				if ((scrollingDown && atBottom) || (scrollingUp && atTop)) {
					// Unlock and allow page to scroll
					unlockScroll();
					return; // Let the event propagate to scroll the page
				}
			}

			// Lock if not already locked and steps have scroll room
			if (!isLocked) {
				const hasScrollRoom = steps.scrollHeight > steps.clientHeight;
				if (hasScrollRoom) {
					lockScroll();
				}
			}

			// If locked, scroll the steps
			if (isLocked) {
				event.preventDefault();
				event.stopPropagation();
				// Direct scroll - no animation needed, just scroll
				steps.scrollTop += delta;
			}
		} else {
			// Section not fully in view - ensure unlocked
			if (isLocked) {
				unlockScroll();
			}
		}
	}

	// Handle touch events
	let touchStartY = 0;

	function handleTouchStart(event) {
		touchStartY = event.touches[0].clientY;
	}

	function handleTouchMove(event) {
		const fullyInView = isSectionFullyInView();
		const currentY = event.touches[0].clientY;
		const delta = touchStartY - currentY;
		const scrollingDown = delta > 0;
		const scrollingUp = delta < 0;
		const atTop = isAtTop();
		const atBottom = isAtBottom();

		if (fullyInView) {
			if (isLocked) {
				if ((scrollingDown && atBottom) || (scrollingUp && atTop)) {
					unlockScroll();
					return;
				}
			}

			if (!isLocked) {
				const hasScrollRoom = steps.scrollHeight > steps.clientHeight;
				if (hasScrollRoom) {
					lockScroll();
				}
			}

			if (isLocked) {
				event.preventDefault();
				steps.scrollTop += delta;
				touchStartY = currentY;
			}
		} else {
			if (isLocked) {
				unlockScroll();
			}
		}
	}

	// Listen to wheel and touch events with capture to intercept FIRST
	window.addEventListener('wheel', handleWheel, { passive: false, capture: true });
	window.addEventListener('touchstart', handleTouchStart, { passive: true });
	window.addEventListener('touchmove', handleTouchMove, { passive: false });

	// Safety: unlock on scroll if section leaves viewport
	let scrollCheckTimeout = null;
	window.addEventListener('scroll', () => {
		if (scrollCheckTimeout) {
			return;
		}
		scrollCheckTimeout = setTimeout(() => {
			scrollCheckTimeout = null;
			if (!isSectionFullyInView() && isLocked) {
				unlockScroll();
			}
		}, 50);
	}, { passive: true });
}());
