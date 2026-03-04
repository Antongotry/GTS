/**
 * Mobile-only global fix for forced line breaks in small text blocks.
 * Replaces <br> with spaces to keep natural wrapping without merged words.
 */
(function() {
	'use strict';

	function replaceBreaks(node) {
		if (!node) {
			return;
		}

		var breaks = node.querySelectorAll('br');
		breaks.forEach(function(br) {
			br.replaceWith(document.createTextNode(' '));
		});
	}

	function applyFix() {
		if (!window.matchMedia('(max-width: 767px)').matches) {
			return;
		}

		var selectors = [
			'[class*="description"]',
			'[class*="subtitle"]',
			'[class*="lead"]',
			'[class*="feature-text"]',
			'[class*="-text"]',
			'.services-card-link'
		];

		var nodes = document.querySelectorAll(selectors.join(','));
		nodes.forEach(replaceBreaks);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyFix);
	} else {
		applyFix();
	}
})();

