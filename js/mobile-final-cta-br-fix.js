/**
 * Replace <br> with spaces in Final CTA descriptions on mobile only.
 * Keeps desktop formatting untouched and avoids merged words.
 */
(function() {
	'use strict';

	function applyMobileFinalCtaBrFix() {
		if (!window.matchMedia('(max-width: 768px)').matches) {
			return;
		}

		var nodes = document.querySelectorAll('.final-cta-description, .final-cta-item-description');
		nodes.forEach(function(node) {
			var breaks = node.querySelectorAll('br');
			breaks.forEach(function(br) {
				br.replaceWith(document.createTextNode(' '));
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyMobileFinalCtaBrFix);
	} else {
		applyMobileFinalCtaBrFix();
	}
})();
