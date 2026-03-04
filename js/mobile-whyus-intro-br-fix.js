/**
 * Replace <br> with spaces in Why Us intro titles on mobile only.
 * Keeps desktop untouched and prevents merged words like "wordword".
 */
(function() {
	'use strict';

	function replaceBreaksWithSpaces(selector) {
		var nodes = document.querySelectorAll(selector);
		nodes.forEach(function(node) {
			var breaks = node.querySelectorAll('br');
			breaks.forEach(function(br) {
				br.replaceWith(document.createTextNode(' '));
			});
		});
	}

	function applyMobileWhyUsIntroBrFix() {
		if (!window.matchMedia('(max-width: 768px)').matches) {
			return;
		}

		replaceBreaksWithSpaces('.why-us-intro-title');
		replaceBreaksWithSpaces('.why-us-intro-description');
		replaceBreaksWithSpaces('.why-us-item-title');
		replaceBreaksWithSpaces('.why-us-item-description');
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyMobileWhyUsIntroBrFix);
	} else {
		applyMobileWhyUsIntroBrFix();
	}
})();
