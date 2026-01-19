/**
 * Lenis Smooth Scrolling Initialization
 * Initializes Lenis for smooth scrolling on entire site (desktop only)
 */

(function() {
	// Check if we're on desktop (not mobile/tablet)
	function isDesktop() {
		return window.innerWidth >= 1024; // lg breakpoint
	}

	// Initialize Lenis only on desktop
	if (typeof Lenis !== 'undefined' && isDesktop()) {
		const lenis = new Lenis({
			duration: 1.2,
			easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
			direction: 'vertical',
			gestureDirection: 'vertical',
			smooth: true,
			mouseMultiplier: 1,
			smoothTouch: false,
			touchMultiplier: 2,
			infinite: false,
		});

		// Animation frame
		function raf(time) {
			lenis.raf(time);
			requestAnimationFrame(raf);
		}

		requestAnimationFrame(raf);

		// Make lenis available globally for GSAP integration on front page
		window.lenis = lenis;
	}
})();