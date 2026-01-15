/* global Lenis */

(function () {
	if (window.Lenis && !window.gtsLenis) {
		window.gtsLenis = new Lenis({
			smoothWheel: true,
			smoothTouch: false,
		});

		const raf = (time) => {
			window.gtsLenis.raf(time);
			window.requestAnimationFrame(raf);
		};
		window.requestAnimationFrame(raf);
	}

	const setViewportHeight = () => {
		const vh = window.innerHeight * 0.01;
		document.documentElement.style.setProperty('--gts-vh', `${vh}px`);
	};

	setViewportHeight();
	window.addEventListener('resize', setViewportHeight);

	const section = document.querySelector('.how-it-works-block');
	const steps = document.querySelector('.how-it-works-steps');

	if (!section || !steps) {
		return;
	}

	function isSectionLocked() {
		const rect = section.getBoundingClientRect();
		const atBottom = rect.bottom <= window.innerHeight + 1;
		const inView = rect.top < window.innerHeight && rect.bottom > 0;
		return inView && atBottom && steps.scrollHeight > steps.clientHeight;
	}

	function handleWheel(event) {
		if (!isSectionLocked()) {
			return;
		}

		const delta = event.deltaY;
		const atTop = steps.scrollTop <= 0;
		const atBottom = steps.scrollTop + steps.clientHeight >= steps.scrollHeight - 1;

		if ((delta > 0 && !atBottom) || (delta < 0 && !atTop)) {
			event.preventDefault();
			steps.scrollTop += delta;
		}
	}

	let touchStartY = 0;

	function handleTouchStart(event) {
		if (!isSectionLocked()) {
			return;
		}
		touchStartY = event.touches[0].clientY;
	}

	function handleTouchMove(event) {
		if (!isSectionLocked()) {
			return;
		}

		const currentY = event.touches[0].clientY;
		const delta = touchStartY - currentY;
		const atTop = steps.scrollTop <= 0;
		const atBottom = steps.scrollTop + steps.clientHeight >= steps.scrollHeight - 1;

		if ((delta > 0 && !atBottom) || (delta < 0 && !atTop)) {
			event.preventDefault();
			steps.scrollTop += delta;
			touchStartY = currentY;
		}
	}

	window.addEventListener('wheel', handleWheel, { passive: false });
	window.addEventListener('touchstart', handleTouchStart, { passive: true });
	window.addEventListener('touchmove', handleTouchMove, { passive: false });
}());
