/* global gsap, ScrollTrigger */

(function () {
	'use strict';

	// Set viewport height CSS variable
	const setViewportHeight = () => {
		document.documentElement.style.setProperty('--gts-vh', `${window.innerHeight}px`);
	};
	setViewportHeight();
	window.addEventListener('resize', setViewportHeight);

	// Wait for DOM and GSAP to be ready
	document.addEventListener('DOMContentLoaded', () => {
		// Check if GSAP and ScrollTrigger are available
		if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
			console.warn('GSAP or ScrollTrigger not loaded');
			return;
		}

		// Register ScrollTrigger plugin
		gsap.registerPlugin(ScrollTrigger);

		const section = document.querySelector('.how-it-works-block');
		const stepsContainer = document.querySelector('.how-it-works-steps');

		if (!section || !stepsContainer) {
			return;
		}

		const steps = stepsContainer.querySelectorAll('.how-it-works-step');
		if (steps.length === 0) {
			return;
		}

		// Calculate how much we need to scroll the cards
		// Total scroll = (number of cards - visible cards) * (card height + gap)
		const cardHeight = 320;
		const gap = 20;
		const totalCardsHeight = steps.length * cardHeight + (steps.length - 1) * gap;
		const visibleHeight = window.innerHeight;
		const scrollDistance = totalCardsHeight - visibleHeight + 100; // extra padding

		// Pin the section and scroll the cards
		ScrollTrigger.create({
			trigger: section,
			start: 'top top',
			end: `+=${scrollDistance}`,
			pin: true,
			pinSpacing: true,
			scrub: 1,
			onUpdate: (self) => {
				// Calculate scroll position for the cards container
				const progress = self.progress;
				const maxScroll = stepsContainer.scrollHeight - stepsContainer.clientHeight;
				stepsContainer.scrollTop = progress * maxScroll;
			},
		});

		// Refresh ScrollTrigger on resize
		window.addEventListener('resize', () => {
			ScrollTrigger.refresh();
		});
	});
}());
