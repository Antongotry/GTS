/**
 * FAQ Accordion — плавное открытие/закрытие по высоте контента
 */
(function () {
	'use strict';

	function initFaqAccordion() {
		var items = document.querySelectorAll('.faq-item');
		if (!items.length) return;

		items.forEach(function (details) {
			var wrapper = details.querySelector('.faq-item__content-wrapper');
			if (!wrapper) return;

			details.addEventListener('toggle', function () {
				if (details.open) {
					wrapper.style.maxHeight = wrapper.scrollHeight + 'px';
				} else {
					wrapper.style.maxHeight = '0';
				}
			});

			// Изначально закрытые: явно 0 (на случай если CSS не применился)
			if (!details.open) {
				wrapper.style.maxHeight = '0';
			}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initFaqAccordion);
	} else {
		initFaqAccordion();
	}
})();
