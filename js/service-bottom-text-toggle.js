/**
 * Expand/collapse logic for service bottom text block.
 */
(function() {
	'use strict';

	function initBottomTextToggle(container) {
		var description = container.querySelector('.service-bottom-text__description--collapsible');
		var toggle = container.querySelector('.service-bottom-text__toggle');
		if (!description || !toggle) {
			return;
		}

		var preview = description.getAttribute('data-preview') || '';
		var full = description.getAttribute('data-full') || '';
		if (!preview || !full || preview === full) {
			return;
		}

		var expandLabel = toggle.getAttribute('data-expand-label') || 'Read more';
		var collapseLabel = toggle.getAttribute('data-collapse-label') || 'Show less';

		toggle.addEventListener('click', function() {
			var expanded = toggle.getAttribute('aria-expanded') === 'true';
			if (expanded) {
				description.textContent = preview;
				toggle.textContent = expandLabel;
				toggle.setAttribute('aria-expanded', 'false');
				return;
			}

			description.textContent = full;
			toggle.textContent = collapseLabel;
			toggle.setAttribute('aria-expanded', 'true');
		});
	}

	function init() {
		var containers = document.querySelectorAll('.service-bottom-text__container');
		containers.forEach(initBottomTextToggle);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();

