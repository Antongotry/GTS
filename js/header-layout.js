(function () {
	'use strict';

	function syncHeaderHeight() {
		var header = document.querySelector('.site-header');
		if (!header) return;

		var height = Math.ceil(header.getBoundingClientRect().height);
		if (height > 0) {
			document.documentElement.style.setProperty('--site-header-height', height + 'px');
		}
	}

	document.addEventListener('DOMContentLoaded', syncHeaderHeight);
	window.addEventListener('load', syncHeaderHeight);
	window.addEventListener('resize', syncHeaderHeight, { passive: true });

	if (typeof ResizeObserver !== 'undefined') {
		var header = document.querySelector('.site-header');
		if (header) {
			var observer = new ResizeObserver(syncHeaderHeight);
			observer.observe(header);
		}
	}
})();
