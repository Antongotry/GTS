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
		return rect.top <= 0 && rect.bottom >= window.innerHeight - 1;
	}

	// Check scroll boundaries
	function isAtTop() {
		return steps.scrollTop <= 0;
	}

	function isAtBottom() {
		return steps.scrollTop + steps.clientHeight >= steps.scrollHeight - 1;
	}

	// Smooth scroll animation for steps
	let stepScrollTarget = 0;
	let stepScrollRAF = null;

	const smoothStepScroll = () => {
		stepScrollRAF = null;
		const diff = stepScrollTarget - steps.scrollTop;
		steps.scrollTop += diff * 0.15;

		if (Math.abs(diff) > 0.5) {
			stepScrollRAF = window.requestAnimationFrame(smoothStepScroll);
		}
	};

	function scrollSteps(delta) {
		const maxScroll = steps.scrollHeight - steps.clientHeight;
		stepScrollTarget = Math.max(0, Math.min(steps.scrollTop + delta, maxScroll));

		if (!stepScrollRAF) {
			stepScrollRAF = window.requestAnimationFrame(smoothStepScroll);
		}
	}

	// Lock scroll to steps
	function lockScroll() {
		if (!isLocked && lenis) {
			isLocked = true;
			lenis.stop();
		}
	}

	// Unlock scroll back to page
	function unlockScroll() {
		if (isLocked && lenis) {
			isLocked = false;
			lenis.start();
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
			// Lock if not already locked
			if (!isLocked) {
				lockScroll();
			}

			// If locked, handle step scrolling
			if (isLocked) {
				// Check if we should unlock
				if ((scrollingDown && atBottom) || (scrollingUp && atTop)) {
					// Unlock and let page scroll
					unlockScroll();
					return;
				}

				// Scroll steps instead of page
				event.preventDefault();
				event.stopPropagation();
				scrollSteps(delta);
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
			if (!isLocked) {
				lockScroll();
			}

			if (isLocked) {
				if ((scrollingDown && atBottom) || (scrollingUp && atTop)) {
					unlockScroll();
					return;
				}

				event.preventDefault();
				scrollSteps(delta);
				touchStartY = currentY;
			}
		} else {
			if (isLocked) {
				unlockScroll();
			}
		}
	}

	// Listen to wheel and touch events with capture to intercept before Lenis
	window.addEventListener('wheel', handleWheel, { passive: false, capture: true });
	window.addEventListener('touchstart', handleTouchStart, { passive: true });
	window.addEventListener('touchmove', handleTouchMove, { passive: false });

	// Also check on scroll to handle edge cases
	window.addEventListener('scroll', () => {
		if (!isSectionFullyInView() && isLocked) {
			unlockScroll();
		}
	}, { passive: true });
}());
