/**
 * Route fields autocomplete for transfer form (OSM via WP AJAX proxy).
 */
(function () {
	'use strict';

	function debounce(fn, wait) {
		var timer = null;
		return function () {
			var args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				fn.apply(null, args);
			}, wait);
		};
	}

	function init() {
		var form = document.getElementById('transfer-form');
		if (!form) {
			return;
		}

		var config = window.gtsTransferConfig || {};
		var ajaxUrl = config.ajaxUrl || '';
		var nonce = config.nonce || '';
		if (!ajaxUrl || !nonce) {
			return;
		}

		var fields = [
			{ name: 'from_country', type: 'country' },
			{ name: 'to_country', type: 'country' },
			{ name: 'from_city', type: 'city' },
			{ name: 'to_city', type: 'city' },
			{ name: 'from_address', type: 'address' },
			{ name: 'to_address', type: 'address' }
		];

		fields.forEach(function (fieldConfig) {
			var input = form.querySelector('input[name="' + fieldConfig.name + '"]');
			if (!input) {
				return;
			}

			var fieldWrap = input.closest('.transfer-field');
			if (!fieldWrap) {
				return;
			}

			var list = document.createElement('ul');
			list.className = 'transfer-autocomplete-list';
			list.setAttribute('role', 'listbox');
			list.hidden = true;
			fieldWrap.appendChild(list);

			var abortController = null;
			var activeIndex = -1;
			var items = [];

			function clearList() {
				activeIndex = -1;
				items = [];
				list.innerHTML = '';
				list.hidden = true;
			}

			function highlight(index) {
				var options = list.querySelectorAll('.transfer-autocomplete-option');
				options.forEach(function (option, optionIndex) {
					option.classList.toggle('is-active', optionIndex === index);
				});
			}

			function choose(item) {
				if (!item || !item.value) {
					return;
				}

				input.value = item.value;
				clearList();
				input.dispatchEvent(new Event('input', { bubbles: true }));
				input.dispatchEvent(new Event('change', { bubbles: true }));
			}

			function render(results) {
				items = Array.isArray(results) ? results : [];
				list.innerHTML = '';
				activeIndex = -1;

				if (!items.length) {
					list.hidden = true;
					return;
				}

				items.forEach(function (item, index) {
					var li = document.createElement('li');
					li.className = 'transfer-autocomplete-item';
					li.setAttribute('role', 'option');
					li.setAttribute('aria-selected', 'false');

					var button = document.createElement('button');
					button.type = 'button';
					button.className = 'transfer-autocomplete-option';
					button.textContent = item.label || item.value;
					button.addEventListener('mousedown', function (event) {
						event.preventDefault();
						choose(item);
					});

					button.addEventListener('mouseenter', function () {
						activeIndex = index;
						highlight(activeIndex);
					});

					li.appendChild(button);
					list.appendChild(li);
				});

				list.hidden = false;
			}

			var requestSuggestions = debounce(function (query) {
				if (abortController) {
					abortController.abort();
				}

				if (!query || query.length < 2) {
					clearList();
					return;
				}

				abortController = new AbortController();

				var formData = new FormData();
				formData.append('action', 'gts_address_suggestions');
				formData.append('nonce', nonce);
				formData.append('q', query);
				formData.append('type', fieldConfig.type);

				fetch(ajaxUrl, {
					method: 'POST',
					body: formData,
					signal: abortController.signal
				})
					.then(function (response) { return response.json(); })
					.then(function (json) {
						if (!json || !json.success || !json.data) {
							render([]);
							return;
						}
						render(json.data.suggestions || []);
					})
					.catch(function (error) {
						if (error && error.name === 'AbortError') {
							return;
						}
						render([]);
					});
			}, 250);

			input.addEventListener('input', function () {
				requestSuggestions(input.value.trim());
			});

			input.addEventListener('focus', function () {
				if (items.length) {
					list.hidden = false;
				}
			});

			input.addEventListener('keydown', function (event) {
				if (list.hidden || !items.length) {
					return;
				}

				if (event.key === 'ArrowDown') {
					event.preventDefault();
					activeIndex = (activeIndex + 1) % items.length;
					highlight(activeIndex);
					return;
				}

				if (event.key === 'ArrowUp') {
					event.preventDefault();
					activeIndex = activeIndex <= 0 ? items.length - 1 : activeIndex - 1;
					highlight(activeIndex);
					return;
				}

				if (event.key === 'Enter' && activeIndex >= 0) {
					event.preventDefault();
					choose(items[activeIndex]);
					return;
				}

				if (event.key === 'Escape') {
					clearList();
				}
			});

			input.addEventListener('blur', function () {
				setTimeout(function () {
					clearList();
				}, 120);
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
