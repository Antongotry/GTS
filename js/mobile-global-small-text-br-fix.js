/**
 * Mobile-only global fix for forced line breaks in small text blocks.
 * Replaces <br> with spaces to keep natural wrapping without merged words.
 */
(function() {
	'use strict';

	function isServiceContextPage() {
		var body = document.body;
		if (!body) {
			return false;
		}

		if (
			body.classList.contains('single-service') ||
			body.classList.contains('page-template-page-limousine-service') ||
			body.classList.contains('page-template-page-city-to-city')
		) {
			return true;
		}

		var path = (window.location && window.location.pathname ? window.location.pathname : '').toLowerCase();
		return (
			path.indexOf('/services/') === 0 ||
			path.indexOf('/limousine-service') === 0 ||
			path.indexOf('/city-to-city') === 0
		);
	}

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
		if (!isServiceContextPage()) {
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
