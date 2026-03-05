(function () {
	'use strict';

	function syncHeaderMetrics() {
		var header = document.querySelector('.site-header');
		if (!header) return;

		var height = Math.ceil(header.getBoundingClientRect().height);
		if (height > 0) {
			document.documentElement.style.setProperty('--site-header-height', height + 'px');
		}

		var headerContainer = header.querySelector('.header-container');
		if (headerContainer) {
			var width = Math.round(headerContainer.getBoundingClientRect().width);
			if (width > 0) {
				document.documentElement.style.setProperty('--gts-header-width', width + 'px');
			}
		}
	}

	document.addEventListener('DOMContentLoaded', syncHeaderMetrics);
	window.addEventListener('load', syncHeaderMetrics);
	window.addEventListener('resize', syncHeaderMetrics, { passive: true });

	if (typeof ResizeObserver !== 'undefined') {
		var header = document.querySelector('.site-header');
		if (header) {
			var observer = new ResizeObserver(syncHeaderMetrics);
			observer.observe(header);
			var headerContainer = header.querySelector('.header-container');
			if (headerContainer) {
				observer.observe(headerContainer);
			}
		}
	}
})();
