(function () {
	'use strict';

	function isDesktopAdaptive() {
		return window.matchMedia('(min-width: 769px) and (max-width: 1480px)').matches;
	}

	function replaceBrWithSpaces(container) {
		if (!container) {
			return;
		}

		container.querySelectorAll('br').forEach(function (br) {
			br.replaceWith(document.createTextNode(' '));
		});
	}

	function applyDesktopWhyUsTextBrFix() {
		if (!isDesktopAdaptive()) {
			return;
		}

		document
			.querySelectorAll('.why-us-block .why-us-item-title, .why-us-block .why-us-item-description')
			.forEach(replaceBrWithSpaces);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyDesktopWhyUsTextBrFix);
	} else {
		applyDesktopWhyUsTextBrFix();
	}
})();
