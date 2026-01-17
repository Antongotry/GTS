/**
 * DateTime Local Placeholder Handler
 * Manages placeholder visibility for datetime-local inputs on mobile devices
 */
(function() {
	'use strict';

	const datetimeInputs = document.querySelectorAll('input[type="datetime-local"]');
	const placeholders = document.querySelectorAll('.datetime-placeholder');

	function updatePlaceholderVisibility(input) {
		const placeholder = input.nextElementSibling;
		
		if (!placeholder || !placeholder.classList.contains('datetime-placeholder')) {
			return;
		}

		// Скрыть placeholder если поле заполнено или в фокусе
		if (input.value !== '' || document.activeElement === input) {
			placeholder.style.opacity = '0';
		} else {
			placeholder.style.opacity = '1';
		}
	}

	// Инициализация для всех datetime-local полей
	datetimeInputs.forEach(function(input) {
		// Проверка при загрузке
		updatePlaceholderVisibility(input);

		// Проверка при изменении значения
		input.addEventListener('change', function() {
			updatePlaceholderVisibility(input);
		});

		// Проверка при вводе
		input.addEventListener('input', function() {
			updatePlaceholderVisibility(input);
		});

		// Скрыть при фокусе
		input.addEventListener('focus', function() {
			updatePlaceholderVisibility(input);
		});

		// Показать при потере фокуса (если пустое)
		input.addEventListener('blur', function() {
			updatePlaceholderVisibility(input);
		});
	});
})();