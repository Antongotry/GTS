/**
 * Mobile drawer toggle for fleet archive filters.
 */
(function () {
	'use strict';

	function init() {
		var toggle = document.querySelector('.gts-fleet-filters-toggle');
		var filters = document.getElementById('gts-fleet-filters');
		var closeBtn = document.querySelector('.gts-fleet-filters__close');
		var overlay = document.querySelector('.gts-fleet-filters-overlay');

		if (!toggle || !filters || !overlay) {
			return;
		}

		function open() {
			document.body.classList.add('gts-filters-open');
			toggle.setAttribute('aria-expanded', 'true');
		}

		function close() {
			document.body.classList.remove('gts-filters-open');
			toggle.setAttribute('aria-expanded', 'false');
		}

		toggle.addEventListener('click', open);
		overlay.addEventListener('click', close);

		if (closeBtn) {
			closeBtn.addEventListener('click', close);
		}

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				close();
			}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
