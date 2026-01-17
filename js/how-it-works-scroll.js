/* global gsap, ScrollTrigger, Lenis */

(function () {
	'use strict';

	// Set viewport height CSS variable
	const setViewportHeight = () => {
		document.documentElement.style.setProperty('--gts-vh', `${window.innerHeight}px`);
	};
	setViewportHeight();
	window.addEventListener('resize', setViewportHeight);

	// Wait for DOM to be ready
	document.addEventListener('DOMContentLoaded', () => {
		// Проверка является ли устройство мобильным (≤768px)
		// Используем тот же breakpoint что и в SCSS ($breakpoint-md: 768px)
		const isMobile = window.innerWidth <= 768;

		// На мобильных отключаем Lenis и ScrollTrigger - используем нативную прокрутку
		if (isMobile) {
			return;
		}

		// Check dependencies
		if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
			console.warn('GSAP or ScrollTrigger not loaded');
			return;
		}

		// Register ScrollTrigger plugin
		gsap.registerPlugin(ScrollTrigger);

		// Initialize Lenis for smooth scrolling (только на десктопе)
		let lenis = null;
		if (typeof Lenis !== 'undefined') {
			lenis = new Lenis({
				duration: 1.2,
				easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
				orientation: 'vertical',
				gestureOrientation: 'vertical',
				smoothWheel: true,
				wheelMultiplier: 1,
				touchMultiplier: 2,
				infinite: false,
			});

			// Connect Lenis to ScrollTrigger
			lenis.on('scroll', ScrollTrigger.update);

			// Use GSAP ticker for Lenis
			gsap.ticker.add((time) => {
				lenis.raf(time * 1000);
			});

			// Disable GSAP's lag smoothing for better sync
			gsap.ticker.lagSmoothing(0);

			// Store globally for debugging
			window.gtsLenis = lenis;
		}

		const section = document.querySelector('.how-it-works-block');
		const stepsContainer = document.querySelector('.how-it-works-steps');

		if (!section || !stepsContainer) {
			return;
		}

		const steps = stepsContainer.querySelectorAll('.how-it-works-step');
		if (steps.length === 0) {
			return;
		}

		// Calculate scroll distance based on cards
		const cardHeight = 320;
		const gap = 20;
		const totalCardsHeight = steps.length * cardHeight + (steps.length - 1) * gap;
		const visibleHeight = window.innerHeight;
		const scrollDistance = Math.max(0, totalCardsHeight - visibleHeight + 100);

		// Pin the section and scroll the cards
		ScrollTrigger.create({
			trigger: section,
			start: 'top top',
			end: `+=${scrollDistance}`,
			pin: true,
			pinSpacing: true,
			scrub: 1,
			onUpdate: (self) => {
				// Scroll the cards container based on scroll progress
				const progress = self.progress;
				const maxScroll = stepsContainer.scrollHeight - stepsContainer.clientHeight;
				if (maxScroll > 0) {
					stepsContainer.scrollTop = progress * maxScroll;
				}
			},
		});

		// Refresh ScrollTrigger on resize
		let resizeTimeout;
		window.addEventListener('resize', () => {
			clearTimeout(resizeTimeout);
			resizeTimeout = setTimeout(() => {
				ScrollTrigger.refresh();
			}, 250);
		});
	});
}());
