/**
 * FAQ Accordion — кастомный аккордеон, плавное открытие/закрытие без багов
 * Управление только через JS, измерение высоты при каждом открытии
 */
(function () {
	'use strict';

	var DURATION_MS = 400;

	function restoreFaqIconSrc(scope) {
		var root = scope && scope.querySelectorAll ? scope : document;
		var icons = root.querySelectorAll('img.faq-item__icon[data-icon-src]');
		if (!icons.length) {
			return;
		}

		icons.forEach(function (icon) {
			var canonical = icon.getAttribute('data-icon-src');
			if (!canonical) {
				return;
			}

			var src = icon.getAttribute('src') || '';
			// Translation tools sometimes replace src with translated text.
			if (src.indexOf('chevron-down-faq.svg') === -1) {
				icon.setAttribute('src', canonical);
			}
		});
	}

	function observeFaqIconMutations() {
		if (typeof MutationObserver === 'undefined') {
			return;
		}

		var observer = new MutationObserver(function (mutations) {
			mutations.forEach(function (mutation) {
				if (mutation.type === 'attributes' && mutation.target && mutation.target.matches && mutation.target.matches('img.faq-item__icon[data-icon-src]')) {
					restoreFaqIconSrc(mutation.target.parentElement || document);
					return;
				}

				if (mutation.type === 'childList' && mutation.addedNodes && mutation.addedNodes.length) {
					mutation.addedNodes.forEach(function (node) {
						if (node && node.nodeType === 1) {
							restoreFaqIconSrc(node);
						}
					});
				}
			});
		});

		observer.observe(document.body, {
			childList: true,
			subtree: true,
			attributes: true,
			attributeFilter: ['src'],
		});
	}

	function initFaqAccordion() {
		restoreFaqIconSrc(document);

		var items = document.querySelectorAll('.faq-item[data-faq-item]');
		if (!items.length) return;

		items.forEach(function (item) {
			var btn = item.querySelector('.faq-item__summary');
			var wrapper = item.querySelector('.faq-item__content-wrapper');
			if (!btn || !wrapper) return;

			btn.addEventListener('click', function () {
				var isOpen = btn.getAttribute('aria-expanded') === 'true';

				if (isOpen) {
					closePanel();
				} else {
					openPanel();
				}
			});

			function openPanel() {
				// Временно раскрываем без анимации, чтобы измерить высоту
				wrapper.style.transition = 'none';
				wrapper.style.maxHeight = 'none';
				var height = wrapper.scrollHeight;
				// Сбрасываем в 0 и включаем transition
				wrapper.style.maxHeight = '0';
				wrapper.style.transition = '';
				// Принудительный reflow, чтобы браузер применил maxHeight: 0
				wrapper.offsetHeight;
				// В следующем кадре задаём целевую высоту — сработает transition
				requestAnimationFrame(function () {
					wrapper.style.maxHeight = height + 'px';
					btn.setAttribute('aria-expanded', 'true');
					item.classList.add('faq-item--open');
				});
			}

			function closePanel() {
				var currentHeight = wrapper.scrollHeight;
				wrapper.style.maxHeight = currentHeight + 'px';
				wrapper.offsetHeight;
				wrapper.style.maxHeight = '0';
				btn.setAttribute('aria-expanded', 'false');
				item.classList.remove('faq-item--open');
				setTimeout(function () {
					wrapper.style.maxHeight = ''; // сброс для следующего открытия
				}, DURATION_MS);
			}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initFaqAccordion);
		document.addEventListener('DOMContentLoaded', observeFaqIconMutations);
	} else {
		initFaqAccordion();
		observeFaqIconMutations();
	}
})();
