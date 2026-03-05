(function () {
	'use strict';

	var SELECTOR = '.why-us-block .why-us-item-title, .why-us-block .why-us-item-description';

	function isDesktopAdaptive() {
		return window.matchMedia('(min-width: 769px) and (max-width: 1480px)').matches;
	}

	function replaceBrWithSpaces(element) {
		if (!element || element.dataset.gtsBrFixed === '1') {
			return;
		}

		element.innerHTML = element.innerHTML.replace(/<br\s*\/?>/gi, ' ');
		element.dataset.gtsBrFixed = '1';
	}

	function applyDesktopWhyUsTextBrFix() {
		if (!isDesktopAdaptive()) {
			return;
		}

		document.querySelectorAll(SELECTOR).forEach(replaceBrWithSpaces);
	}

	function observeWhyUsMutations() {
		if (typeof MutationObserver === 'undefined') {
			return;
		}

		var observer = new MutationObserver(function () {
			applyDesktopWhyUsTextBrFix();
		});

		observer.observe(document.body, {
			childList: true,
			subtree: true,
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', applyDesktopWhyUsTextBrFix);
	} else {
		applyDesktopWhyUsTextBrFix();
	}

	window.addEventListener('load', applyDesktopWhyUsTextBrFix);
	window.addEventListener('resize', applyDesktopWhyUsTextBrFix, { passive: true });

	// Handle delayed DOM updates from plugins/cached fragments.
	setTimeout(applyDesktopWhyUsTextBrFix, 300);
	setTimeout(applyDesktopWhyUsTextBrFix, 1200);

	observeWhyUsMutations();
})();
