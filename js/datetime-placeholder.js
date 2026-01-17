/**
 * DateTime Local Placeholder Handler
 * Manages placeholder visibility for datetime-local inputs on mobile devices
 */
(function() {
	'use strict';

	// Функция инициализации - вызывается при загрузке и когда DOM готов
	function initDateTimePlaceholders() {
		const datetimeInputs = document.querySelectorAll('input[type="datetime-local"]');

		datetimeInputs.forEach(function(input) {
			const placeholder = input.nextElementSibling;

			if (!placeholder || !placeholder.classList.contains('datetime-placeholder')) {
				return;
			}

			// Функция обновления видимости placeholder
			function updatePlaceholderVisibility(forceShow) {
				// Показать placeholder всегда, если поле пустое и не в фокусе
				if (forceShow || (input.value === '' && document.activeElement !== input)) {
					placeholder.style.opacity = '1';
					placeholder.style.display = 'block';
					placeholder.style.visibility = 'visible';
					input.classList.remove('has-value');
				} else {
					placeholder.style.opacity = '0';
					placeholder.style.display = 'none';
					if (input.value !== '') {
						input.classList.add('has-value');
					}
				}
			}

			// Инициализация - ПОКАЗАТЬ placeholder всегда если поле пустое
			// Принудительно показываем, игнорируя фокус при загрузке
			if (input.value === '') {
				placeholder.style.opacity = '1';
				placeholder.style.display = 'block';
				placeholder.style.visibility = 'visible';
				input.classList.remove('has-value');
			}

			// При изменении значения
			input.addEventListener('change', updatePlaceholderVisibility);

			// При вводе
			input.addEventListener('input', updatePlaceholderVisibility);

			// При фокусе - скрыть placeholder
			input.addEventListener('focus', function() {
				placeholder.style.opacity = '0';
				placeholder.style.display = 'none';
			});

			// При потере фокуса - показать если пустое
			input.addEventListener('blur', updatePlaceholderVisibility);

			// Также слушать событие при клике (для мобильных)
			input.addEventListener('click', function() {
				setTimeout(updatePlaceholderVisibility, 100);
			});
		});
	}

	// Запустить при загрузке DOM
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initDateTimePlaceholders);
	} else {
		// DOM уже загружен
		initDateTimePlaceholders();
	}

	// Также запустить с небольшой задержкой для надежности
	setTimeout(initDateTimePlaceholders, 100);
})();
