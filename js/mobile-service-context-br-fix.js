/**
 * Replace <br> with spaces in service-context text on mobile only.
 * Prevents merged words like "stafftransportation".
 */
(function() {
	'use strict';

	function applyMobileServiceContextBrFix() {
		if (!window.matchMedia('(max-width: 768px)').matches) {
			return;
		}

		var nodes = document.querySelectorAll('.service-context-text');
		nodes.forEach(function(node) {
			var breaks = node.querySelectorAll('br');
			breaks.forEach(function(br) {
				br.replaceWith(document.createTextNode(' '));
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyMobileServiceContextBrFix);
	} else {
		applyMobileServiceContextBrFix();
	}
})();
