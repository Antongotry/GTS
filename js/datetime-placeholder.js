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

			// При изменении значения - ВАЖНО для datetime-local
			input.addEventListener('change', function() {
				// Добавить класс has-value если есть значение
				if (input.value !== '') {
					input.classList.add('has-value');
				} else {
					input.classList.remove('has-value');
				}
				updatePlaceholderVisibility();
				// Повторная проверка с задержкой для надежности
				setTimeout(function() {
					if (input.value !== '') {
						input.classList.add('has-value');
					}
					updatePlaceholderVisibility();
				}, 200);
			});

			// При вводе
			input.addEventListener('input', function() {
				if (input.value !== '') {
					input.classList.add('has-value');
				} else {
					input.classList.remove('has-value');
				}
				updatePlaceholderVisibility();
			});

			// При фокусе - скрыть placeholder
			input.addEventListener('focus', function() {
				placeholder.style.opacity = '0';
				placeholder.style.display = 'none';
			});

			// При потере фокуса - показать если пустое, скрыть если заполнено
			input.addEventListener('blur', function() {
				if (input.value !== '') {
					input.classList.add('has-value');
				} else {
					input.classList.remove('has-value');
				}
				updatePlaceholderVisibility();
				// Повторная проверка после blur
				setTimeout(function() {
					if (input.value !== '') {
						input.classList.add('has-value');
					}
					updatePlaceholderVisibility();
				}, 100);
			});

			// Также слушать событие при клике (для мобильных и десктопа)
			input.addEventListener('click', function(e) {
				// На десктопе открываем календарь при клике на любое место input
				// Это обходит проблему когда webkit-datetime-edit блокирует клики
				if (input.type === 'datetime-local') {
					// Программно открываем календарь через focus и showPicker (если доступен)
					setTimeout(function() {
						input.focus();
						// Попытка открыть календарь программно (поддерживается в некоторых браузерах)
						if (input.showPicker) {
							try {
								input.showPicker();
							} catch (err) {
								// Если showPicker не поддерживается, просто focus
							}
						}
					}, 10);
				}
				
				setTimeout(function() {
					if (input.value !== '') {
						input.classList.add('has-value');
					}
					updatePlaceholderVisibility();
				}, 100);
			});

			// Дополнительный обработчик для области input (не только иконки)
			// Используем mousedown для более надежного срабатывания
			input.addEventListener('mousedown', function(e) {
				// Если клик не на иконке календаря (справа), открываем календарь
				const rect = input.getBoundingClientRect();
				const clickX = e.clientX - rect.left;
				const inputWidth = rect.width;
				
				// Если клик не в последних 30px (где иконка), открываем календарь
				if (clickX < inputWidth - 30) {
					e.preventDefault(); // Предотвращаем стандартное поведение
					setTimeout(function() {
						input.focus();
						if (input.showPicker) {
							try {
								input.showPicker();
							} catch (err) {
								// Если showPicker не поддерживается, просто focus
							}
						}
					}, 10);
				}
			});

			// Слушать событие при закрытии календаря (для десктопа)
			input.addEventListener('close', function() {
				setTimeout(function() {
					if (input.value !== '') {
						input.classList.add('has-value');
					}
					updatePlaceholderVisibility();
				}, 100);
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
