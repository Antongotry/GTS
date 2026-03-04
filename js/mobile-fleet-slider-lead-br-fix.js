/**
 * Replace <br> with spaces in fleet slider lead text on mobile only.
 */
(function() {
	'use strict';

	function applyMobileFleetSliderLeadBrFix() {
		if (!window.matchMedia('(max-width: 768px)').matches) {
			return;
		}

		var nodes = document.querySelectorAll('.fleet-slider-lead');
		nodes.forEach(function(node) {
			var breaks = node.querySelectorAll('br');
			breaks.forEach(function(br) {
				br.replaceWith(document.createTextNode(' '));
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyMobileFleetSliderLeadBrFix);
	} else {
		applyMobileFleetSliderLeadBrFix();
	}
})();
