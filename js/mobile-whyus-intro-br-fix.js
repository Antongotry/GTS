/**
 * Replace <br> with spaces in Why Us intro titles on mobile only.
 * Keeps desktop untouched and prevents merged words like "wordword".
 */
(function() {
	'use strict';

	function applyMobileWhyUsIntroBrFix() {
		if (!window.matchMedia('(max-width: 768px)').matches) {
			return;
		}

		var titles = document.querySelectorAll('.why-us-intro-title');
		titles.forEach(function(title) {
			var breaks = title.querySelectorAll('br');
			breaks.forEach(function(br) {
				br.replaceWith(document.createTextNode(' '));
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyMobileWhyUsIntroBrFix);
	} else {
		applyMobileWhyUsIntroBrFix();
	}
})();

